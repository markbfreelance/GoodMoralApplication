<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeanApplication;
use App\Models\SecOSAApplication;
use App\Models\GoodMoralApplication;
use App\Models\NotifArchive;
use Illuminate\Support\Facades\Auth;
use App\Traits\RoleCheck;
use App\Models\StudentViolation;
use App\Models\Violation;
use App\Models\HeadOSAApplication;

class ProgramCoordinatorController extends Controller
{
  use RoleCheck;

  public function __construct()
  {
    // Apply role check for all methods in this controller
    $this->checkRole(['prog_coor']);
  }

  public function dashboard()
  {
    return view('prog_coor.dashboard'); // Ensure this view exists
  }
  public function minor()
  {
    return view('prog_coor.minor'); // Ensure this view exists
  }

  public function major()
  {
    $userDepartment = Auth::user()->department;

    $students = StudentViolation::where('department', $userDepartment)
      ->orderBy('updated_at', 'asc') // oldest first
      ->paginate(10);

    return view('prog_coor.major', compact('students'));
  }

  public function CoorMajorSearch(Request $request)
  {
    $query = StudentViolation::query();

    if ($request->filled('ref_num')) {
      $query->where('ref_num', 'like', '%' . $request->ref_num . '%');
    }
    if ($request->filled('student_id')) {
      $query->where('student_id', 'like', '%' . $request->student_id . '%');
    }
    if ($request->filled('last_name')) {
      $query->where('last_name', 'like', '%' . $request->last_name . '%');
    }
    $students = $query->paginate(10); // Get paginated results
    return view('prog_coor.major', compact('students'));
  }
}
