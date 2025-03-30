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


class RegisteredAccountController extends Controller
{
  public function create(): View
  {
    return view('auth.admin.AdminAccount')->with('success', 'Account successfully created!');
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'fullname' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:role_account,email'],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
      'student_id' => ['nullable', 'string', 'max:20', 'unique:role_account,student_id'],
      'account_type' => ['required', 'string', 'in:dean,psg_officer,registar,moderator'],
    ]);

    $user = RoleAccount::create([
      'fullname' => $request->fullname,
      'email' => $request->email,
      'password' => Hash::make($request->password), // Always hash passwords
      'student_id' => $request->student_id,
      'status' => "1",
      'account_type' => $request->account_type,
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect()->route('admin.AddAccount')->with('success', 'Account successfully created!');
  }
}
