<?php

namespace App\Http\Controllers;

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
    return view('prog_coor.major'); // Ensure this view exists
  }
}
