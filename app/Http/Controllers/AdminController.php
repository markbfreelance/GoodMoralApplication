<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViolationNotif;
use App\Models\GoodMoralApplication;
use App\Models\StudentViolation;
use App\Models\RoleAccount;
use App\Models\StudentRegistration;
use App\Models\Violation;
use App\Models\ArchivedRoleAccount;
use App\Models\HeadOSAApplication;
use App\Models\DeanApplication;
use App\Traits\RoleCheck;
use App\Models\NotifArchive;
use App\Models\SecOSAApplication;

class AdminController extends Controller
{
  use RoleCheck;

  public function __construct()
  {
    // Apply role check for all methods in this controller
    $this->checkRole('admin');
  }
  public function dashboard()
  {
    //Applicants per department
    $site = GoodMoralApplication::where('department', 'SITE')->count();
    $saste = GoodMoralApplication::where('department', 'SASTE')->count();
    $sbahm = GoodMoralApplication::where('department', 'SBAHM')->count();
    $snahs = GoodMoralApplication::where('department', 'SNAHS')->count();

    //For Pie Chart stats
    $minorpending = StudentViolation::where('status', '!=', 2)->where('offense_type', 'minor')->count();
    $minorcomplied = StudentViolation::where('status', '=', 2)->where('offense_type', 'minor')->count();
    $majorpending = StudentViolation::where('status', '!=', 2)->where('offense_type', 'major')->count();
    $majorcomplied = StudentViolation::where('status', '=', 2)->where('offense_type', 'major')->count();
    //Pageinate
    $violationpage = Violation::paginate(10);
    return view('admin.dashboard', compact('site', 'sbahm', 'saste', 'snahs', 'minorpending', 'minorcomplied', 'majorpending', 'majorcomplied', 'violationpage'));
  }

  public function create(Request $request)
  {
    $validated = $request->validate([
      'offense_type' => ['required', 'in:minor,major'],
      'description' => ['required', 'string', 'max:255'],
    ]);

    Violation::create([
      'offense_type' => $validated['offense_type'],
      'description' => $validated['description'],
    ]);
    $violations = Violation::paginate(10);
    return redirect()->back()->with('success', 'Violation successfully recorded.');
  }
  public function AddViolationDashboard()
  {

    $violations = Violation::get();
    $violationpage = Violation::paginate(10);
    return view('admin.AddViolation', compact('violations', 'violationpage'));
  }

  public function applicationDashboard()
  {
    $applications = GoodMoralApplication::get();

    return view('admin.Application', compact('applications'));
  }
  public function search(Request $request)
  {
    $query = GoodMoralApplication::query();

    if ($request->filled('department')) {
      $query->where('department', 'like', '%' . $request->department . '%');
    }
    if ($request->filled('student_id')) {
      $query->where('student_id', 'like', '%' . $request->student_id . '%');
    }
    if ($request->filled('fullname')) {
      $query->where('fullname', 'like', '%' . $request->fullname . '%');
    }
    $applications = $query->paginate(10); // Get paginated results
    return view('admin.Application', compact('applications'));
  }
  public function psgApplication(Request $request)
  {
    $status = $request->get('status'); // Get the filter status from the URL

    // Apply filter based on status
    if ($status == 'approved') {
      $applications = RoleAccount::where('status', '1')->where('account_type', 'psg_officer')->get();
    } elseif ($status == 'rejected') {
      $applications = ArchivedRoleAccount::where('status', '3')->where('account_type', 'psg_officer')->get(); // Default to Pending
    } else {
      $applications = RoleAccount::where('status', '5')->where('account_type', 'psg_officer')->get();
    }

    return view('admin.psgApplication', compact('applications'));
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
    return redirect()->route('admin.psgApplication')->with('status', 'Application rejected and moved to archive.');
  }


  public function approvepsg($student_id)
  {
    $application = RoleAccount::where('student_id', $student_id)->firstOrFail();
    $application->status = '1';
    $applicationStudent = StudentRegistration::where('student_id', $student_id)->firstOrFail();
    $applicationStudent->status = '1';
    $applicationStudent->save();
    $application->save();

    return redirect()->route('admin.psgApplication')->with('status', 'Application approved.');
  }
  public function deleteViolation($id)
  {
    // Retrieve the application from the RoleAccount table
    $application = Violation::where('id', $id)->firstOrFail();
    // Delete the original application from the RoleAccount table
    $application->delete();
    $violations = Violation::get();
    $violationpage = Violation::paginate(10);
    $status = 'Violation Deleted Successfully.';
    // Redirect with a success message
    return redirect()->route('admin.AddViolation')->with(compact('violations', 'violationpage', 'status'));
  }
  public function updateViolation(Request $request, $id)
  {
    $violation = Violation::findOrFail($id);
    $violation->offense_type = $request->offense_type;
    $violation->description = $request->description;
    $violation->save();

    return redirect()->route('admin.AddViolation')->with('success', 'Violation updated successfully.');
  }

  public function GMAApporvedByRegistrar()
  {
    $applications = HeadOSAApplication::where('status', 'pending')->get();
    return view('admin.GMAApporvedByRegistrar', compact('applications'));
  }

  public function rejectGMA($id)
  {
    // Find the HeadOSAApplication and update its status to 'rejected'
    $application = HeadOSAApplication::findOrFail($id);
    $application->status = 'rejected';
    $application->save();

    // Assuming you want to update the 'GoodMoralApplication' using the same student_id
    $student_id = $application->student_id;

    // Retrieve the GoodMoralApplication for the same student
    $goodMoralApplication = GoodMoralApplication::where('student_id', $student_id)->first();

    if ($goodMoralApplication) {
      // Update the application status for GoodMoralApplication
      $goodMoralApplication->application_status = 'Rejected by Administrator';
      $goodMoralApplication->save();
    }

    NotifArchive::create([
      'number_of_copies' => $application->number_of_copies,
      'reference_number' => $application->reference_number,
      'fullname' => $application->fullname,
      'reason' => $application->reason,
      'student_id' => $goodMoralApplication->student_id,
      'department' =>  $goodMoralApplication->department,
      'course_completed' =>  $application->course_completed,  // Allowing this to be null
      'graduation_date' => $application->graduation_date,
      'application_status' => null,
      'is_undergraduate' => $application->is_undergraduate,
      'last_course_year_level' => $application->last_course_year_level,
      'last_semester_sy' => $application->last_semester_sy,
      'status' => '-2',
    ]);

    return redirect()->route('admin.GMAApporvedByRegistrar')->with('status', 'Application rejected!');
  }

  public function approveGMA($id)
  {
    // 1. Find the application
    $application = HeadOSAApplication::findOrFail($id);

    // 2. Update the status to 'approved'
    $application->status = 'approved';
    $application->save();

    $student_id = $application->student_id;

    // Retrieve the GoodMoralApplication for the same student
    $goodMoralApplication = GoodMoralApplication::where('student_id', $student_id)->first();
    if ($goodMoralApplication) {
      // Update the application status for GoodMoralApplication
      $goodMoralApplication->application_status = 'Approve by Administrator';
      $goodMoralApplication->save();
    }

    // 3. Get the student from role_account
    $student = $application->student;

    if (!$student) {
      return redirect()->route('admin.GMAApporvedByRegistrar')->with('error', 'Student not found.');
    }

    // 4. Create the head_osa_application record for the single Head OSA
    SecOSAApplication::create([
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
      'status' => '2',
    ]);

    return redirect()->route('admin.GMAApporvedByRegistrar')->with(
      'status',
      'Application approved and ready to print'
    );
  }
  public function violation()
  {
    $students = StudentViolation::orderBy('updated_at', 'asc') // oldest first
      ->paginate(10);

    return view('admin.violation', compact('students'));
  }

  public function markDownloaded($id)
  {
    $violation = StudentViolation::findOrFail($id);
    $violation->downloaded = true;
    $violation->save();

    return back()->with('success', 'Marked as downloaded.');
  }

  public function closeCase($id)
  {
    $violation = StudentViolation::findOrFail($id);
    $violation->status = '2'; // or 2, or whatever means "closed"
    $violation->save();

    ViolationNotif::create([
      'ref_num' => $violation->ref_num,
      'student_id' => $violation->student_id,
      'status' => 1,  // or whatever initial status you want
      'notif' => "Violation was solve with case number: $violation->ref_num ",
    ]);

    return back()->with('success', 'Case closed successfully.');
  }

  public function violationsearch(Request $request)
  {
    $query = StudentViolation::query();

    if ($request->filled('ref_num')) {
      $query->where('ref_num', 'like', '%' . $request->ref_num . '%');
    }
    if ($request->filled('student_id')) {
      $query->where('student_id', 'like', '%' . $request->student_id . '%');
    }
    if ($request->filled('last_name')) {
      $query->where('last_name', 'like', '%' . $request->last_name . '%');
    }
    if ($request->filled('offense_type')) {
      $query->where('offense_type', $request->offense_type);
    }
    $students = $query->paginate(10); // Get paginated results
    return view('admin.violation', compact('students'));
  }
}
