<?php

namespace App\Http\Controllers;

use App\Models\GoodMoralApplication;
use Illuminate\Http\Request;

class HeadOSAController extends Controller
{
  /**
   * Show the Head OSA dashboard with pending applications.
   *
   * @return \Illuminate\View\View
   */
  public function dashboard()
  {
    // Get all pending applications (you can modify this logic if needed)
    $applications = GoodMoralApplication::where('status', 'approved')->get();

    // Return the view with the list of applications
    return view('head_osa.dashboard', compact('applications'));
  }

  /**
   * Approve a Good Moral Certificate application by Head OSA.
   *
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function approve($id)
  {
    // Find the application by its ID
    $application = GoodMoralApplication::findOrFail($id);

    // Update the application status to 'approved' by Head OSA
    $application->status = 'approved_by_head_osa';
    $application->save();

    // Redirect back to the dashboard with a success message
    return redirect()->route('head_osa.dashboard')->with('status', 'Application approved by Head OSA!');
  }

  /**
   * Reject a Good Moral Certificate application by Head OSA.
   *
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function reject($id)
  {
    // Find the application by its ID
    $application = GoodMoralApplication::findOrFail($id);

    // Update the application status to 'rejected' by Head OSA
    $application->status = 'rejected_by_head_osa';
    $application->save();

    // Redirect back to the dashboard with a rejection message
    return redirect()->route('head_osa.dashboard')->with('status', 'Application rejected by Head OSA.');
  }
}
