<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeanApplication;
use App\Models\SecOSAApplication;
use App\Models\GoodMoralApplication;
use App\Models\NotifArchive;
use Illuminate\Support\Facades\Auth;
use App\Traits\RoleCheck;
use App\Models\StudentViolation;
use App\Models\Violation;
use App\Models\HeadOSAApplication;
use Illuminate\Support\Str;
use App\Models\ViolationNotif;

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
    //Applicants per course
    $bsit = GoodMoralApplication::where('course_completed', 'BSIT')->count();
    $blis = GoodMoralApplication::where('course_completed', 'BLIS')->count();
    $bsce = GoodMoralApplication::where('course_completed', 'BSCE')->count();
    $bscpe = GoodMoralApplication::where('course_completed', 'BSENSE')->count();
    $bsense = GoodMoralApplication::where('course_completed', 'BSCpE')->count();

    $bsn = GoodMoralApplication::where('course_completed', 'BSN')->count();
    $bsph = GoodMoralApplication::where('course_completed', 'BSPh')->count();
    $bsmt = GoodMoralApplication::where('course_completed', 'BSMT')->count();
    $bspt = GoodMoralApplication::where('course_completed', 'BSPT')->count();
    $bsrt = GoodMoralApplication::where('course_completed', 'BSRT')->count();
    $bsm = GoodMoralApplication::where('course_completed', 'BSM')->count();

    $bsa = GoodMoralApplication::where('course_completed', 'BSA')->count();
    $bse = GoodMoralApplication::where('course_completed', 'BSE')->count();
    $bsbamm = GoodMoralApplication::where('course_completed', 'BSBAMM')->count();
    $bsbamfm = GoodMoralApplication::where('course_completed', 'BSBAMFM')->count();
    $bsbamop = GoodMoralApplication::where('course_completed', 'BSBAMOP')->count();
    $bsma = GoodMoralApplication::where('course_completed', 'BSMA')->count();
    $bshm = GoodMoralApplication::where('course_completed', 'BSHM')->count();
    $bstm = GoodMoralApplication::where('course_completed', 'BSTM')->count();
    $bspdmi = GoodMoralApplication::where('course_completed', 'BSPDMI')->count();

    $baels = GoodMoralApplication::where('course_completed', 'BAELS')->count();
    $bspsych = GoodMoralApplication::where('course_completed', 'BSPsych')->count();
    $bsbio = GoodMoralApplication::where('course_completed', 'BSBio')->count();
    $bssw = GoodMoralApplication::where('course_completed', 'BSSW')->count();
    $bsbpa = GoodMoralApplication::where('course_completed', 'BSBPA')->count();
    $bsbiomb = GoodMoralApplication::where('course_completed', 'BSBioMB')->count();
    $bsed = GoodMoralApplication::where('course_completed', 'BSEd')->count();
    $beed = GoodMoralApplication::where('course_completed', 'BEEd')->count();
    $bped = GoodMoralApplication::where('course_completed', 'BPEd')->count();

    $SITEprograms = [
      ['abbr1' => 'BS', 'abbr2' => 'IT', 'count' => $bsit],
      ['abbr1' => 'BL', 'abbr2' => 'IS', 'count' => $blis],
      ['abbr1' => 'BS', 'abbr2' => 'CE', 'count' => $bsce],
      ['abbr1' => 'BS', 'abbr2' => 'CpE', 'count' => $bscpe],
      ['abbr1' => 'BS', 'abbr2' => 'ENSE', 'count' => $bsense],
    ];

    $SNAHSprograms = [
      ['abbr1' => 'BS', 'abbr2' => 'N', 'count' => $bsn],
      ['abbr1' => 'BS', 'abbr2' => 'Ph', 'count' => $bsph],
      ['abbr1' => 'BS', 'abbr2' => 'MT', 'count' => $bsmt],
      ['abbr1' => 'BS', 'abbr2' => 'PT', 'count' => $bspt],
      ['abbr1' => 'BS', 'abbr2' => 'RT', 'count' => $bsrt],
      ['abbr1' => 'BS', 'abbr2' => 'M', 'count' => $bsm],
    ];

    $SBAHMprograms = [
      ['abbr1' => 'BS', 'abbr2' => 'A', 'count' => $bsa],
      ['abbr1' => 'BS', 'abbr2' => 'E', 'count' => $bse],
      ['abbr1' => 'BSBA', 'abbr2' => 'MM', 'count' => $bsbamm],
      ['abbr1' => 'BSBA', 'abbr2' => 'MFM', 'count' => $bsbamfm],
      ['abbr1' => 'BSBA', 'abbr2' => 'MOP', 'count' => $bsbamop],
      ['abbr1' => 'BS', 'abbr2' => 'MA', 'count' => $bsma],
      ['abbr1' => 'BS', 'abbr2' => 'HM', 'count' => $bshm],
      ['abbr1' => 'BS', 'abbr2' => 'TM', 'count' => $bstm],
      ['abbr1' => 'BS', 'abbr2' => 'PDMI', 'count' => $bspdmi],
    ];
    $SBAHMfirstRow = array_slice($SBAHMprograms, 0, 4);
    $SBAHMsecondRow = array_slice($SBAHMprograms, 4, 5);

    $SASTEprograms = [
      ['abbr1' => 'BA', 'abbr2' => 'ELS', 'count' => $bsa],
      ['abbr1' => 'BS', 'abbr2' => 'Psych', 'count' => $bse],
      ['abbr1' => 'BS', 'abbr2' => 'Bio', 'count' => $bsbamm],
      ['abbr1' => 'BS', 'abbr2' => 'SW', 'count' => $bsbamfm],
      ['abbr1' => 'BS', 'abbr2' => 'PA', 'count' => $bsbamop],
      ['abbr1' => 'BS', 'abbr2' => 'Bio MB', 'count' => $bsma],
      ['abbr1' => 'BS', 'abbr2' => 'Ed', 'count' => $bshm],
      ['abbr1' => 'BE', 'abbr2' => 'Ed', 'count' => $bstm],
      ['abbr1' => 'B', 'abbr2' => 'PEd', 'count' => $bspdmi],
    ];
    $SASTEfirstRow = array_slice($SASTEprograms, 0, 4);
    $SASTEsecondRow = array_slice($SASTEprograms, 4, 5);

    $dean = Auth::user();
    $department = $dean->department;

    $programs = [];
    $programsRow1 = [];
    $programsRow2 = [];

    if ($department === 'SITE') {
      $programs = $SITEprograms;
    } elseif ($department === 'SNAHS') {
      $programs = $SNAHSprograms;
    } elseif ($department === 'SBAHM') {
      $programsRow1 = $SBAHMfirstRow;
      $programsRow2 = $SBAHMsecondRow;
    } elseif ($department === 'SASTE') {
      $programsRow1 = $SASTEfirstRow;
      $programsRow2 = $SASTEsecondRow;
    }

    //For Pie Chart stats
    $minorpending = StudentViolation::where('status', '!=', 2)->where('offense_type', 'minor')->count();
    $minorcomplied = StudentViolation::where('status', '=', 2)->where('offense_type', 'minor')->count();
    $majorpending = StudentViolation::where('status', '!=', 2)->where('offense_type', 'major')->count();
    $majorcomplied = StudentViolation::where('status', '=', 2)->where('offense_type', 'major')->count();
    //Pageinate
    $violationpage = Violation::paginate(10);
    return view('dean.dashboard', compact(
      'minorpending',
      'minorcomplied',
      'majorpending',
      'majorcomplied',
      'violationpage',
      'SITEprograms',
      'SNAHSprograms',
      'SBAHMprograms',
      'SASTEprograms',
      'SBAHMfirstRow',
      'SBAHMsecondRow',
      'SASTEfirstRow',
      'SASTEsecondRow',
      'department',
      'programs',
      'programsRow1',
      'programsRow2',
    ));
  }

  public function application()
  {
    // Access the authenticated dean
    $dean = Auth::user();

    // Fetch pending applications assigned to the dean's department
    $applications = DeanApplication::where('status', 'pending')
      ->where('department', $dean->department) // Filtering by department
      ->with('student') // Eager load the related student data
      ->get();

    return view('dean.application', [
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

    HeadOSAApplication::create([
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

    return back()->with('status', 'Application approved and forwarded to Office of Student Affairs.');
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
  public function major()
  {
    $userDepartment = Auth::user()->department;

    $students = StudentViolation::where('department', $userDepartment)
      ->where('offense_type', 'major')
      ->orderBy('updated_at', 'asc') // oldest first
      ->paginate(10);

    return view('dean.major', compact('students'));
  }
  public function DeanMajorSearch(Request $request)
  {
    $userDepartment = Auth::user()->department;

    $query = StudentViolation::where('department', $userDepartment)
      ->where('offense_type', 'major');

    if ($request->filled('ref_num')) {
      $query->where('ref_num', 'like', '%' . $request->ref_num . '%');
    }
    if ($request->filled('student_id')) {
      $query->where('student_id', 'like', '%' . $request->student_id . '%');
    }
    if ($request->filled('last_name')) {
      $query->where('last_name', 'like', '%' . $request->last_name . '%');
    }
    $students = $query->paginate(10); // Get paginated results
    return view('dean.major', compact('students'));
  }

  public function minor()
  {
    $userDepartment = Auth::user()->department;

    $students = StudentViolation::where('department', $userDepartment)
      ->where('offense_type', 'minor')
      ->orderBy('updated_at', 'asc') // oldest first
      ->paginate(10);

    return view('dean.minor', compact('students'));
  }
  public function DeanMinorSearch(Request $request)
  {
    $userDepartment = Auth::user()->department;

    $query = StudentViolation::where('department', $userDepartment)
      ->where('offense_type', 'minor');

    if ($request->filled('ref_num')) {
      $query->where('ref_num', 'like', '%' . $request->ref_num . '%');
    }
    if ($request->filled('student_id')) {
      $query->where('student_id', 'like', '%' . $request->student_id . '%');
    }
    if ($request->filled('last_name')) {
      $query->where('last_name', 'like', '%' . $request->last_name . '%');
    }
    $students = $query->paginate(10); // Get paginated results
    return view('dean.minor', compact('students'));
  }

  public function deanviolationapprove($id)
  {
    $userDepartment = Auth::user()->department;

    $violation = StudentViolation::findOrFail($id);
    $date = date('Ymd');
    do {
      $unique = strtoupper(Str::random(6));  // 6 random uppercase letters/numbers
      $caseNumber = "CASE-{$date}-{$unique}";
      $exists = StudentViolation::where('ref_num', $caseNumber)->exists();
    } while ($exists);
    $violation->ref_num = $caseNumber;
    $violation->status = "1";

    $violation->save();
    ViolationNotif::create([
      'ref_num' => $caseNumber,
      'student_id' => $violation->student_id,
      'status' => 0,  // initial status
      'notif' => "Approve the proceedings by Dean, with case number: $caseNumber",
    ]);

    return back()->with('success', "Approve the proceedings with Case number: {$caseNumber}");
  }
}
