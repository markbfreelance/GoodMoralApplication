<?php

namespace App\Http\Controllers;

use App\Models\GoodMoralApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
  /**
   * Handle the application for a Good Moral Certificate.
   */
  public function applyForGoodMoralCertificate(Request $request)
  {
    // Get the student_id from the authenticated user (role account)
    $roleAccount = Auth::user(); // Assuming the user is logged in via role_account
    $studentId = $roleAccount->student_id;
    $fullname = $roleAccount->fullname;
    $studentDepartment = $roleAccount->department;

    // Save the application in the database
    GoodMoralApplication::create([
      'fullname' => $fullname,
      'student_id' => $studentId,
      'department' => $studentDepartment,
      'status' => 'pending', // Set default status as 'pending'
    ]);

    // Redirect to the student's dashboard with a success message
    return redirect()->route('dashboard')->with('status', 'Application for Good Moral Certificate submitted successfully!');
  }
}
