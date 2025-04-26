<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\GoodMoralApplication;
use App\Models\RoleAccount;
use App\Models\NotifArchive;
use App\Models\StudentViolation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\RoleCheck;

class ApplicationController extends Controller
{
  /**
   * Handle the application for a Good Moral Certificate.
   */
  use RoleCheck;

  public function __construct()
  {
    // Apply role check for all methods in this controller
    $this->checkRole(['student', 'alumni']);
  }

  public function dashboard()
  {
    $user = Auth::user();

    // Get the student record tied to this user
    $student = RoleAccount::where('id', $user->id)->first();

    if (!$student) {
      return redirect()->back()->with('error', 'Student record not found.');
    }

    $studentId = $student->student_id;
    $fullname = $student->fullname;
    $Violation = StudentViolation::where('student_id', $studentId)->get(); // fetches a collection

    return view('dashboard', compact('Violation', 'fullname'));
  }
  public function applyForGoodMoralCertificate(Request $request)
  {

    $prefix = 'REF'; // You can customize the prefix
    $timestamp = time(); // Current timestamp
    $randomString = Str::upper(Str::random(6)); // Random 6-character string
    $referenceNumber = $prefix . '-' . $timestamp . '-' . $randomString;

    // Validate the input
    $request->validate([
      'num_copies' => ['required', 'string', 'max:255'],
      'reason' => ['required', 'string', 'max:255'],
      'reason_other' => ['nullable', 'string', 'max:255'],
      'is_undergraduate' => ['nullable', 'in:yes,no'],
    ]);

    // Validate additional fields if the student is undergraduate
    if ($request->is_undergraduate === 'yes') {
      $request->validate([
        'last_course_year_level' => ['required', 'string', 'max:255'],
        'last_semester_sy' => ['required', 'string', 'max:255'],
      ]);
    } else if ($request->is_undergraduate === 'no') {
      $request->validate([
        'course_completed' => ['required', 'string', 'max:255'],
        'graduation_date' => ['required', 'date'],
      ]);
    } else {
      $request->validate([
        'last_course_year_level' => ['nullable', 'string', 'max:255'],
        'last_semester_sy' => ['nullable', 'string', 'max:255'],
        'course_completed' => ['nullable', 'string', 'max:255'],
        'graduation_date' => ['nullable', 'date'],
      ]);
    }

    // Get the student details from the authenticated user
    $roleAccount = Auth::user(); // Assuming the user is logged in via role_account
    $studentId = $roleAccount->student_id;
    $fullname = $roleAccount->fullname;
    $studentDepartment = $roleAccount->department;

    // Set the reason to 'Others' if selected and a custom reason is provided
    $selectedReason = $request->reason === 'Others' ? $request->reason_other : $request->reason;

    // Save the application in the database
    GoodMoralApplication::create([
      'number_of_copies' => $request->num_copies,
      'reference_number' => $referenceNumber,
      'fullname' => $fullname,
      'reason' => $selectedReason,
      'student_id' => $studentId,
      'department' => $studentDepartment,
      'course_completed' => $request->course_completed, // Allowing this to be null
      'graduation_date' => $request->graduation_date,
      'application_status' => null,
      'is_undergraduate' => $request->is_undergraduate === 'yes',
      'last_course_year_level' => $request->is_undergraduate === 'yes' ? $request->last_course_year_level : null,
      'last_semester_sy' => $request->is_undergraduate === 'yes' ? $request->last_semester_sy : null,
      'status' => 'pending',
    ]);

    NotifArchive::create([
      'number_of_copies' => $request->num_copies,
      'reference_number' => $referenceNumber,
      'fullname' => $fullname,
      'reason' => $selectedReason,
      'student_id' => $studentId,
      'department' => $studentDepartment,
      'course_completed' => $request->course_completed, // Allowing this to be null
      'graduation_date' => $request->graduation_date,
      'application_status' => null,
      'is_undergraduate' => $request->is_undergraduate === 'yes',
      'last_course_year_level' => $request->is_undergraduate === 'yes' ? $request->last_course_year_level : null,
      'last_semester_sy' => $request->is_undergraduate === 'yes' ? $request->last_semester_sy : null,
      'status' => '0',
    ]);

    // Redirect to the dashboard with a success message
    return redirect()->route('dashboard')->with('status', 'Application for Good Moral Certificate submitted successfully!');
  }
  public function notification()
  {
    // Fetch notifications for the authenticated user using the student_id
    $notifications = NotifArchive::where('student_id', Auth::user()->student_id) // Assuming student_id is stored in the users table
      ->orderBy('created_at', 'desc') // Optional: Order by latest notifications first
      ->get();

    // Return the view with the notifications
    return view('notification', compact('notifications'));
  }
}
