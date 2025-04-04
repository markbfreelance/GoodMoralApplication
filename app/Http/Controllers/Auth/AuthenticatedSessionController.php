<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
    $request = Auth::user();

    return redirect()->intended($this->redirectBasedOnRole($request));
  }

  protected function redirectBasedOnRole($request)
  {
    switch ($request->account_type) {
      case 'admin':
        return route('admin.dashboard');
      case 'psg_officer':
        return route('PsgOfficer.dashboard');
      case 'dean':
        return route('Dean.dashboard');
      case 'registrar':
        return route('registrar.dashboard');
      case 'alumni':
        return route('dashboard');
      case 'student':
        return route('dashboard');
      default:
        return route('logout'); // Default route if role is not found
    }
  }

  /**
   * Destroy an authenticated session.
   */
  public function destroy(Request $request): RedirectResponse
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
