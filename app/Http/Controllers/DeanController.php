<?php

namespace App\Http\Controllers;

use App\Models\DeanApplication;
use App\Models\SecOSAApplication;

class DeanController extends Controller
{
  public function dashboard()
  {
    $applications = DeanApplication::where('status', 'pending')->get();
    return view('dean.dashboard', compact('applications'));
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
    $application = DeanApplication::findOrFail($id);

    // 2. Update the status to 'approved'
    $application->status = 'approved';
    $application->save();

    // 3. Get the student from role_account
    $student = $application->student;

    if (!$student) {
      return redirect()->route('dean.dashboard')->with('error', 'Student not found.');
    }

    // 4. Create the head_osa_application record for the single Head OSA
    SecOSAApplication::create([
      'student_id' => $student->student_id,
      'status' => 'pending', // Default status
    ]);

    return redirect()->route('dean.dashboard')->with('status', 'Application approved and forwarded to Office of Student Affairs.');
  }

  public function reject($id)
  {
    $application = DeanApplication::findOrFail($id);
    $application->status = 'rejected';
    $application->save();

    return redirect()->route('dean.dashboard')->with('status', 'Application rejected!');
  }
}
