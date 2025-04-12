<?php

namespace App\Http\Controllers;

use App\Models\HeadOSAApplication;
use App\Models\GoodMoralApplication;
use Illuminate\Http\Request;

class HeadOSAController extends Controller
{
  public function dashboard()
  {
    $applications = HeadOSAApplication::where('status', 'pending')->get();
    return view('headosa.dashboard', compact('applications'));
  }

  public function approve($id)
  {
    $application = HeadOSAApplication::findOrFail($id);
    $application->status = 'approved';
    $application->save();

    return redirect()->route('headosa.dashboard')->with('status', 'Application approved!');
  }

  public function reject($id)
  {
    $application = HeadOSAApplication::findOrFail($id);
    $application->status = 'rejected';
    $application->save();

    return redirect()->route('headosa.dashboard')->with('status', 'Application rejected!');
  }
}
