<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class AuthenticatedSessionController extends Controller
{
  /**
   * Display the login view.
   */
  public function create(): View
  {
    return view('auth.login');
  }

  /**
   * Handle an incoming authentication request.
   */
  public function store(LoginRequest $request): RedirectResponse
  {
    $request->authenticate();

    $request->session()->regenerate();

    $user = Auth::user();

    // Check if selected account_type matches the user's actual account_type
    if ($request->input('account_type') !== $user->account_type) {
      Auth::logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect()->route('login')->withErrors([
        'email' => 'Login failed: You selected the wrong account type.',
      ]);
    }

    return redirect()->intended($this->redirectBasedOnRole($user));
  }
  protected function isRoleAllowed($user): bool
  {
    return in_array($user->account_type, [
      'admin',
      'psg_officer',
      'dean',
      'registrar',
      'head_osa',
      'sec_osa',
      'student',
      'alumni'
    ]);
  }
  /**
   * Redirect based on the user's role.
   */
  protected function redirectBasedOnRole($user)
  {
    return match ($user->account_type) {
      'admin' => route('admin.dashboard'),
      'psg_officer' => route('PsgOfficer.dashboard'),
      'dean' => route('dean.dashboard'),
      'registrar' => route('registrar.dashboard'),
      'head_osa' => route('head_osa.dashboard'),
      'sec_osa' => route('sec_osa.dashboard'),
      'alumni' => route('dashboard'),
      'student' => route('dashboard'),
      'prog_coor' => route('prog_coor.dashboard'),
      default => route('destroy'), // fallback if unknown role
    };
  }

  /**
   * Destroy an authenticated session.
   */
  public function destroy(Request $request): RedirectResponse
  {
    Session::flush();
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
