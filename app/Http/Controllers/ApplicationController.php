<?php

namespace App\Http\Controllers;

use App\Models\GoodMoralApplication;
use App\Models\RoleAccount;
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

    $request->validate([
      'purpose' => ['required', 'string', 'max:255'],
      'reason' => ['required', 'string', 'max:255'],
      'reason_other' => ['nullable', 'string', 'max:255'],
    ]);

    // Get the student_id from the authenticated user (role account)
    $roleAccount = Auth::user(); // Assuming the user is logged in via role_account
    $studentId = $roleAccount->student_id;
    $fullname = $roleAccount->fullname;
    $studentDepartment = $roleAccount->department;
    $purpose = $request->purpose;
    $selectedReason = $request->reason === 'Others'
      ? $request->reason_other
      : $request->reason;

    // Save the application in the database
    GoodMoralApplication::create([
      'fullname' => $fullname,
      'purpose' => $purpose,
      'reason' => $selectedReason,
      'student_id' => $studentId,
      'department' => $studentDepartment,
      'status' => 'pending',
    ]);

    // Redirect to the student's dashboard with a success message
    return redirect()->route('dashboard')->with('status', 'Application for Good Moral Certificate submitted successfully!');
  }
}
