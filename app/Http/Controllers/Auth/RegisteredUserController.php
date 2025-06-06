<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StudentRegistration;
use App\Models\RoleAccount;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Violation;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   */
  public function create()
  {
    $coursesByDepartment = [
      'SITE' => ['BSIT', 'BLIS', 'BS ENSE', 'BS CpE', 'BSCE'],
      'SBAHM' => ['BSA', 'BSE', 'BSBAMM', 'BSBA MFM', 'BSBA MOP', 'BSMA', 'BSHM', 'BSTM', 'BSPDMI'],
      'SASTE' => ['BAELS', 'BS Psych', 'BS Bio', 'BSSW', 'BSPA', 'BS Bio MB', 'BSEd', 'BEEd', 'BPEd'],
      'SNAHS' => ['BSN', 'BSPh', 'BSMT', 'BSPT', 'BSRT'],
    ];

    return view('auth.register', compact('coursesByDepartment'));
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'fname' => ['required', 'string', 'max:255'],
      'lname' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:student_registrations,email'],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
      'department' => ['required', 'string',  'in:SITE,SBAHM,SASTE,BEU,SNAHS'],
      'student_id' => ['required', 'string', 'max:20', 'unique:student_registrations'],
      'account_type' => ['required', 'string', 'max:255'],
      'year_level' => ['required', 'string', 'max:50'],
    ]);
    if ($request->account_type !== 'psg_officer') {
      $user = StudentRegistration::create([
        'fname' => $request->fname,
        'lname' => $request->lname,
        'email' => $request->email,
        'department' => $request->department,
        'password' => Hash::make($request->password), // Always hash passwords
        'student_id' => $request->student_id,
        'status' => "1",
        'account_type' => $request->account_type,
        'year_level' => $request->year_level,
      ]);

      $user1 = RoleAccount::create([
        'fullname' => $request->fname . "," . $request->lname,
        'department' => $request->department,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Always hash passwords
        'student_id' => $request->student_id,
        'status' => "1",
        'account_type' => $request->account_type,
      ]);

      return redirect(route('login'))->with('status', 'Your account was succesfully created.');
    } else {
      $user = StudentRegistration::create([
        'fname' => $request->fname,
        'lname' => $request->lname,
        'email' => $request->email,
        'department' => $request->department,
        'password' => Hash::make($request->password), // Always hash passwords
        'student_id' => $request->student_id,
        'status' => "5",
        'account_type' => $request->account_type,
        'year_level' => $request->year_level,
      ]);

      $user1 = RoleAccount::create([
        'fullname' => $request->fname . "," . $request->lname,
        'department' => $request->department,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Always hash passwords
        'student_id' => $request->student_id,
        'status' => "5",
        'account_type' => $request->account_type,
      ]);

      return redirect(route('login'))->with('status', 'Your account is pending approval. Please wait for further instructions.');
    }
  }
}
