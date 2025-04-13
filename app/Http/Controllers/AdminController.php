<?php

namespace App\Http\Controllers;

use App\Models\GoodMoralApplication;
use App\Models\HeadOSAApplication;

class AdminController extends Controller
{
  public function dashboard()
  {
    $site = GoodMoralApplication::where('department', 'SITE')->count();
    $saste = GoodMoralApplication::where('department', 'SASTE')->count();
    $sbahm = GoodMoralApplication::where('department', 'SBAHM')->count();
    $snahs = GoodMoralApplication::where('department', 'SNAHS')->count();
    $beu = GoodMoralApplication::where('department', 'BEU')->count();
    return view('admin.dashboard', compact('site', 'sbahm', 'saste', 'beu','snahs'));
  }
}
