<?php

namespace App\Http\Controllers;

use App\Models\SecOSAApplication;
use App\Traits\RoleCheck;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentViolation;
use App\Models\Violation;

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
    //Applicants per department
    $site = SecOSAApplication::where('department', 'SITE')->count();
    $saste = SecOSAApplication::where('department', 'SASTE')->count();
    $sbahm = SecOSAApplication::where('department', 'SBAHM')->count();
    $snahs = SecOSAApplication::where('department', 'SNAHS')->count();

    //For Pie Chart stats
    $minorpending = StudentViolation::where('status', 'pending')->where('offense_type', 'minor')->count();
    $minorcomplied = StudentViolation::where('status', 'complied')->where('offense_type', 'minor')->count();
    $majorpending = StudentViolation::where('status', 'pending')->where('offense_type', 'major')->count();
    $majorcomplied = StudentViolation::where('status', 'complied')->where('offense_type', 'major')->count();
    //Pageinate
    $violationpage = Violation::paginate(10);

    $applications = SecOSAApplication::where('status', 'pending')->get();
    return view('sec_osa.dashboard', compact('applications','site', 'sbahm', 'saste', 'snahs', 'minorpending', 'minorcomplied', 'majorpending', 'majorcomplied', 'violationpage'));
  }

  public function application()
  {
    $applications = SecOSAApplication::get();

    return view('sec_osa.Application', compact('applications'));
  }

  public function approve($id)
  {
    $application = SecOSAApplication::findOrFail($id);
    $sec_osa = Auth::user();
    $application->status = 'approved' . $sec_osa->fullname;
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
