<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoodMoralApplication;
use App\Models\RoleAccount;
use App\Models\StudentRegistration;
use App\Models\ArchivedRoleAccount;
use App\Models\HeadOSAApplication;
use App\Models\NotifArchive;
use App\Traits\RoleCheck;
use Illuminate\Support\Facades\Auth;

class RegistrarController extends Controller
{
  /**
   * Show the registrar dashboard with pending applications.
   *
   * @return \Illuminate\View\View
   */

  use RoleCheck;

  public function __construct()
  {
    // Apply role check for all methods in this controller
    $this->checkRole(['registrar']);
  }

  public function dashboard()
  {
    // Get the 'perPage' parameter from the request, default to 10 if not provided
    $perPage = request()->get('perPage', 10);

    // Paginate the applications based on the 'perPage' value
    $applications = GoodMoralApplication::where('status', 'pending')->paginate($perPage);

    return view('registrar.dashboard', compact('applications'));
  }


  /**
   * Approve a Good Moral Certificate application.
   *
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function approve($id)
  {
    // 1. Find the application
    $application = GoodMoralApplication::findOrFail($id);

    // 2. Update the status to 'approved'
    $registrar = Auth::user();
    $application->status = 'approved';
    $application->application_status = 'Approved By Registrar' . $registrar->fullname;
    $application->save();

    // 3. Get the student from role_account
    $student = $application->student;

    if (!$student) {
      return redirect()->route('registrar.dashboard')->with('error', 'Student not found.');
    }

    // 4. Create the head_osa_application record for the single Head OSA
    HeadOSAApplication::create([
      'number_of_copies' => $application->number_of_copies,
      'reference_number' => $application->reference_number,
      'student_id' => $student->student_id,
      'fullname' => $student->fullname,
      'department' => $student->department,
      'reason' => $application->reason,
      'course_completed' => $application->course_completed, // New field
      'graduation_date' => $application->graduation_date,   // New field
      'is_undergraduate' => $application->is_undergraduate, // New field
      'last_course_year_level' => $application->last_course_year_level, // New field
      'last_semester_sy' => $application->last_semester_sy,  // New field
      'status' => 'pending', // Default status
    ]);

    NotifArchive::create([
      'number_of_copies' => $application->number_of_copies,
      'reference_number' => $application->reference_number,
      'fullname' => $application->fullname,
      'reason' => $application->reason,
      'student_id' => $student->student_id,
      'department' =>  $student->department,
      'course_completed' =>  $application->course_completed,  // Allowing this to be null
      'graduation_date' => $application->graduation_date,
      'application_status' => null,
      'is_undergraduate' => $application->is_undergraduate,
      'last_course_year_level' => $application->last_course_year_level,
      'last_semester_sy' => $application->last_semester_sy,
      'status' => '1',
    ]);


    return redirect()->route('registrar.dashboard')->with('status', 'Application approved and forwarded to Office of Student Affairs.');
  }

  /**
   * Reject a Good Moral Certificate application.
   *
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function reject($id)
  {
    // Find the application by its ID
    $application = GoodMoralApplication::findOrFail($id);
    $registrar = Auth::user();
    // Update the application status to 'rejected'
    $application->status = 'rejected';
    $application->application_status = 'Rejected By Registrar' . $registrar->fullname;
    $application->save();


    $application = GoodMoralApplication::findOrFail($id);
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
      'status' => '-1',
    ]);

    // Redirect back to the dashboard with a rejection message
    return redirect()->route('registrar.dashboard')->with('status', 'Application rejected.');
  }

  public function psgApplication(Request $request)
  {
    $status = $request->get('status'); // Get the filter status from the URL

    // Apply filter based on status
    if ($status == 'approved') {
      $applications = RoleAccount::where('status', '1')->where('account_type', 'psg_officer')->get();
    } elseif ($status == 'rejected') {
      $applications = ArchivedRoleAccount::where('status', '3')->where('account_type', 'psg_officer')->get();
    } elseif ($status == 'pendingAtAdmin') {
      $applications = RoleAccount::where('status', '5')->where('account_type', 'psg_officer')->get();
    } else {
      $applications = RoleAccount::where('status', '4')->where('account_type', 'psg_officer')->get();
    }

    return view('registrar.psgApplication', compact('applications'));
  }

  public function rejectpsg($student_id)
  {
    // Retrieve the application from the RoleAccount table
    $application = RoleAccount::where('student_id', $student_id)->firstOrFail();

    // Prepare the data to be transferred to the new table
    $archivedApplication = new ArchivedRoleAccount();
    $archivedApplication->student_id = $application->student_id;
    $archivedApplication->fullname = $application->fullname;
    $archivedApplication->department = $application->department;
    $archivedApplication->status = '3'; // Rejected status
    $archivedApplication->account_type = $application->account_type;
    $archivedApplication->created_at = $application->created_at; // Ensure you keep the created_at
    $archivedApplication->updated_at = $application->updated_at; // Same for updated_at
    // Add any other fields you need to transfer
    $archivedApplication->save();

    // Delete the original application from the RoleAccount table
    $application->delete();
    $id = $application->student_id;
    // Delete the original registraton from the registration table
    $registration = StudentRegistration::where('student_id', $id)->firstOrFail();
    $registration->delete();


    // Redirect with a success message
    return redirect()->route('registrar.psgApplication')->with('status', 'Application rejected and moved to archive.');
  }

  public function approvepsg($student_id)
  {
    $application = RoleAccount::where('student_id', $student_id)->firstOrFail();
    $application->status = '5';
    $applicationStudent = StudentRegistration::where('student_id', $student_id)->firstOrFail();
    $applicationStudent->status = '5';
    $applicationStudent->save();
    $application->save();

    return redirect()->route('registrar.psgApplication')->with('status', 'Application approved.');
  }
}
