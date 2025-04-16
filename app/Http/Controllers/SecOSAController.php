<?php

namespace App\Http\Controllers;

use App\Models\SecOSAApplication;
use App\Traits\RoleCheck;
class SecOSAController extends Controller
{

  use RoleCheck;

  public function __construct()
  {
    // Apply role check for all methods in this controller
    $this->checkRole(['sec_osa']);
  }
  public function dashboard()
  {
    $applications = SecOSAApplication::where('status', 'pending')->get();
    return view('sec_osa.dashboard', compact('applications'));
  }

  public function approve($id)
  {
    $application = SecOSAApplication::findOrFail($id);
    $application->status = 'approved';
    $application->save();

    return redirect()->route('sec_osa.dashboard')->with('status', 'Application approved!');
  }

  public function reject($id)
  {
    $application = SecOSAApplication::findOrFail($id);
    $application->status = 'rejected';
    $application->save();

    return redirect()->route('sec_osa.dashboard')->with('status', 'Application rejected!');
  }
}
