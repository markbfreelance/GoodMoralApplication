<?php

namespace App\Http\Controllers;

use App\Models\GoodMoralApplication;
use App\Models\HeadOSA;
use App\Models\HeadOSAApplication;
use Illuminate\Http\Request;

class RegistrarController extends Controller
{
  /**
   * Show the registrar dashboard with pending applications.
   *
   * @return \Illuminate\View\View
   */
  public function dashboard()
  {
    // Get all pending applications
    $applications = GoodMoralApplication::where('status', 'pending')->get();

    // Return the view with the list of applications
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
    $application->status = 'approved';
    $application->save();

    // 3. Get the student from role_account
    $student = $application->student;

    if (!$student) {
      return redirect()->route('registrar.dashboard')->with('error', 'Student not found.');
    }

    // 4. Create the head_osa_application record for the single Head OSA
    HeadOSAApplication::create([
      'application_id' => $application->id,
      'student_id' => $student->student_id,
      'status' => 'pending', // Default status
    ]);

    return redirect()->route('registrar.dashboard')->with('status', 'Application approved and forwarded to Head OSA.');
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

    // Update the application status to 'rejected'
    $application->status = 'rejected';
    $application->save();

    // Redirect back to the dashboard with a rejection message
    return redirect()->route('registrar.dashboard')->with('status', 'Application rejected.');
  }
}
