<?php

namespace App\Http\Controllers;

use App\Models\DeanApplication;
use App\Models\HeadOSAApplication;

class HeadOSAController extends Controller
{
  public function dashboard()
  {
    $applications = HeadOSAApplication::where('status', 'pending')->get();
    return view('head_osa.dashboard', compact('applications'));
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
    $application = HeadOSAApplication::findOrFail($id);

    // 2. Update the status to 'approved'
    $application->status = 'approved';
    $application->save();

    // 3. Get the student from role_account
    $student = $application->student;

    if (!$student) {
      return redirect()->route('head_osa.dashboard')->with('error', 'Student not found.');
    }

    // 4. Create the head_osa_application record for the single Head OSA
    DeanApplication::create([
      'student_id' => $student->student_id,
      'status' => 'pending', // Default status
    ]);

    return redirect()->route('head_osa.dashboard')->with('status', 'Application approved and forwarded to Dean.');
  }

  public function reject($id)
  {
    $application = HeadOSAApplication::findOrFail($id);
    $application->status = 'rejected';
    $application->save();

    return redirect()->route('head_osa.dashboard')->with('status', 'Application rejected!');
  }
}
