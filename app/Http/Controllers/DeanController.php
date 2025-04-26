<?php

namespace App\Http\Controllers;

use App\Models\DeanApplication;
use App\Models\SecOSAApplication;
use App\Models\GoodMoralApplication;
use App\Models\NotifArchive;
use Illuminate\Support\Facades\Auth;
use App\Traits\RoleCheck;

class DeanController extends Controller
{
  /**
   * Show the dashboard with pending applications.
   *
   * @return \Illuminate\View\View
   */
  use RoleCheck;

  public function __construct()
  {
    // Apply role check for all methods in this controller
    $this->checkRole(['dean']);
  }
  public function dashboard()
  {
    // Access the authenticated dean
    $dean = Auth::user();

    // Fetch pending applications assigned to the dean's department
    $applications = DeanApplication::where('status', 'pending')
      ->where('department', $dean->department) // Filtering by department
      ->with('student') // Eager load the related student data
      ->get();

    return view('dean.dashboard', [
      'applications' => $applications,
      'department' => $dean->department, // pass department to view
    ]);
  }

  /**
   * Approve a Dean application.
   *
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function approve($id)
  {
    // Retrieve the application
    $application = DeanApplication::findOrFail($id);

    // Check if the logged-in dean has permission to approve the application
    $this->authorizeApplication($application);

    // Prevent approving already approved applications
    if ($application->status == 'approved') {
      return redirect()->route('dean.dashboard')->with('error', 'This application has already been approved.');
    }

    // Update the application status to 'approved'
    $application->status = 'approved';
    $application->save();

    // Create SecOSA application if it doesn't already exist
    $student = $application->student;
    if (!$student) {
      return redirect()->route('dean.dashboard')->with('error', 'Student not found.');
    }

    // Prevent creating duplicate SecOSAApplication
    if (SecOSAApplication::where('student_id', $student->student_id)->exists()) {
      return redirect()->route('dean.dashboard')->with('error', 'SecOSA application already exists for this student.');
    }
    $dean = Auth::user();
    $student_id = $application->student_id;

    // Retrieve the GoodMoralApplication for the same student
    $goodMoralApplication = GoodMoralApplication::where('student_id', $student_id)->first();
    if ($goodMoralApplication) {
      // Update the application status for GoodMoralApplication
      $goodMoralApplication->application_status = 'Approved by Dean:' . $dean->fullname;
      $goodMoralApplication->save();
    }

    SecOSAApplication::create([
      'number_of_copies' => $application->number_of_copies,
      'reference_number' => $application->reference_number,
      'student_id' => $student->student_id,
      'department' => $student->department,
      'reason' => $application->reason,
      'fullname' => $application->fullname,
      'course_completed' => $application->course_completed, // New field
      'graduation_date' => $application->graduation_date,   // New field
      'is_undergraduate' => $application->is_undergraduate, // New field
      'last_course_year_level' => $application->last_course_year_level, // New field
      'last_semester_sy' => $application->last_semester_sy,  // New field
      'status' => 'pending',
    ]);
    NotifArchive::create([
      'number_of_copies' => $application->number_of_copies,
      'reference_number' => $application->reference_number,
      'fullname' => $application->fullname,
      'reason' => $application->reason,
      'student_id' => $application->student_id,
      'department' =>  $application->department,
      'course_completed' =>  $application->course_completed,  // Allowing this to be null
      'graduation_date' => $application->graduation_date,
      'application_status' => null,
      'is_undergraduate' => $application->is_undergraduate,
      'last_course_year_level' => $application->last_course_year_level,
      'last_semester_sy' => $application->last_semester_sy,
      'status' => '3',
    ]);

    return redirect()->route('dean.dashboard')->with('status', 'Application approved and forwarded to Office of Student Affairs.');
  }

  /**
   * Reject a Dean application.
   *
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function reject($id)
  {
    // Retrieve the application
    $application = DeanApplication::findOrFail($id);

    // Check if the logged-in dean has permission to reject the application
    $this->authorizeApplication($application);

    // Prevent rejecting already rejected applications
    if ($application->status == 'rejected') {
      return redirect()->route('dean.dashboard')->with('error', 'This application has already been rejected.');
    }
    $dean = Auth::user();
    $student_id = $application->student_id;

    // Retrieve the GoodMoralApplication for the same student
    $goodMoralApplication = GoodMoralApplication::where('student_id', $student_id)->first();
    if ($goodMoralApplication) {
      // Update the application status for GoodMoralApplication
      $goodMoralApplication->application_status = 'Rejected by Dean:' . $dean->fullname;
      $goodMoralApplication->save();
    }

    // Update the application status to 'rejected'
    $application->status = 'rejected';
    $application->save();

    NotifArchive::create([
      'number_of_copies' => $goodMoralApplication->number_of_copies,
      'reference_number' => $goodMoralApplication->reference_number,
      'fullname' => $goodMoralApplication->fullname,
      'reason' => $goodMoralApplication->reason,
      'student_id' => $goodMoralApplication->student_id,
      'department' =>  $goodMoralApplication->department,
      'course_completed' =>  $goodMoralApplication->course_completed,  // Allowing this to be null
      'graduation_date' => $goodMoralApplication->graduation_date,
      'application_status' => null,
      'is_undergraduate' => $goodMoralApplication->is_undergraduate,
      'last_course_year_level' => $goodMoralApplication->last_course_year_level,
      'last_semester_sy' => $goodMoralApplication->last_semester_sy,
      'status' => '-3',
    ]);

    return redirect()->route('dean.dashboard')->with('status', 'Application rejected!');
  }

  /**
   * Authorize that the logged-in dean can approve/reject the application.
   *
   * @param  \App\Models\DeanApplication  $application
   * @return void
   */
  protected function authorizeApplication($application)
  {
    $dean = Auth::user();

    // Check if the application belongs to the logged-in dean's department
    if ($application->department !== $dean->department) {
      return redirect()->route('dean.dashboard')->with('error', 'Unauthorized access to application.');
    }
  }
}
