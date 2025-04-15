<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoodMoralApplication;
use App\Models\StudentViolation;
use App\Models\Violation;
use App\Models\HeadOSAApplication;

class AdminController extends Controller
{
  public function dashboard()
  {
    //Applicants per department
    $site = GoodMoralApplication::where('department', 'SITE')->count();
    $saste = GoodMoralApplication::where('department', 'SASTE')->count();
    $sbahm = GoodMoralApplication::where('department', 'SBAHM')->count();
    $snahs = GoodMoralApplication::where('department', 'SNAHS')->count();

    //For Pie Chart stats
    $minorpending = StudentViolation::where('status', 'pending')->where('offense_type', 'minor')->count();
    $minorcomplied = StudentViolation::where('status', 'complied')->where('offense_type', 'minor')->count();
    $majorpending = StudentViolation::where('status', 'pending')->where('offense_type', 'major')->count();
    $majorcomplied = StudentViolation::where('status', 'complied')->where('offense_type', 'major')->count();
    //Pageinate
    $violationpage = Violation::paginate(10);
    return view('admin.dashboard', compact('site', 'sbahm', 'saste', 'snahs', 'minorpending', 'minorcomplied','majorpending','majorcomplied', 'violationpage'));
  }

  public function create(Request $request)
  {
    $validated = $request->validate([
      'offense_type' => ['required', 'in:minor,major'],
      'description' => ['required', 'string', 'max:255'],
    ]);

    Violation::create([
      'offense_type' => $validated['offense_type'],
      'description' => $validated['description'],
    ]);
    $violations = Violation::paginate(10);
    return redirect()->back()->with('success', 'Violation successfully recorded.');
  }
  public function AddViolationDashboard()
  {
    $violations = Violation::get();
    $violationpage = Violation::paginate(10);
    return view('admin.AddViolation', compact('violations', 'violationpage'));
  }
}
