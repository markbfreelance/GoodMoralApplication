<?php

namespace App\Http\Controllers;

use App\Models\DeanApplication;

class DeanController extends Controller
{
  public function dashboard()
  {
    $applications = DeanApplication::where('status', 'pending')->get();
    return view('dean.dashboard', compact('applications'));
  }

  public function approve($id)
  {
    $application = DeanApplication::findOrFail($id);
    $application->status = 'approved';
    $application->save();

    return redirect()->route('dean.dashboard')->with('status', 'Application approved!');
  }

  public function reject($id)
  {
    $application = DeanApplication::findOrFail($id);
    $application->status = 'rejected';
    $application->save();

    return redirect()->route('dean.dashboard')->with('status', 'Application rejected!');
  }
}
