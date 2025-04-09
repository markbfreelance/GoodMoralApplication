<?php

namespace App\Http\Controllers;

use App\Models\GoodMoralApplication;
use Illuminate\Http\Request;

class RegistarController extends Controller
{
  /**
   * Show the registar dashboard with pending applications.
   *
   * @return \Illuminate\View\View
   */
  public function dashboard()
  {
    // Get all pending applications
    $applications = GoodMoralApplication::where('status', 'pending')->get();

    // Return the view with the list of applications
    return view('registar.dashboard', compact('applications'));
  }

  /**
   * Approve a Good Moral Certificate application.
   *
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function approve($id)
  {
    // Find the application by its ID
    $application = GoodMoralApplication::findOrFail($id);

    // Update the application status to 'approved'
    $application->status = 'approved';
    $application->save();

    // Redirect back to the dashboard with a success message
    return redirect()->route('registar.dashboard')->with('status', 'Application approved successfully!');
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
    return redirect()->route('registar.dashboard')->with('status', 'Application rejected.');
  }
}
