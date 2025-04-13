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

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   */
  public function create(): View
  {
    return view('auth.register');
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
      'account_type' => ['required', 'string', 'in:student,alumni'],
      'year_level' => ['required', 'string', 'max:50'],
    ]);
    
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
      'fullname' => $request->fname.",".$request->lname,
      'department' => $request->department,
      'email' => $request->email,
      'password' => Hash::make($request->password), // Always hash passwords
      'student_id' => $request->student_id,
      'status' => "1",
      'account_type' => $request->account_type,
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
  }
}
