<?php

namespace App\Http\Requests\Auth;

use App\Models\RoleAccount;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'email' => ['required', 'string', 'email', 'exists:role_account,email'], // ✅ Match DB column
      'password' => ['required', 'string'],
    ];
  }
  /**
   * Attempt to authenticate the request's credentials.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function authenticate(): void
  {
    $this->ensureIsNotRateLimited();

    $user = RoleAccount::where('email', strtolower($this->email))->first();

    // ✅ Check if user exists and status is 1 (Approved)
    if (!$user || $user->status != 1) {
      throw ValidationException::withMessages([
        'email' => $user ? 'Your account has not been approved yet.' : trans('auth.failed'),
      ]);
    }

    // ✅ Authenticate user
    if (!Auth::attempt([
      'email' => strtolower($this->email), // ✅ Match database column names
      'password' => $this->password,
    ], $this->boolean('remember'))) {
      RateLimiter::hit($this->throttleKey());

      throw ValidationException::withMessages([
        'email' => trans('auth.failed'),
      ]);
    }

    // ✅ Clear rate limiter
    RateLimiter::clear($this->throttleKey());
  }
  /**
   * Ensure the login request is not rate limited.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function ensureIsNotRateLimited(): void
  {
    if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
      return;
    }

    event(new Lockout($this));

    $seconds = RateLimiter::availableIn($this->throttleKey());

    throw ValidationException::withMessages([
      'email' => trans('auth.throttle', [
        'seconds' => $seconds,
        'minutes' => ceil($seconds / 60),
      ]),
    ]);
  }

  /**
   * Get the rate limiting throttle key for the request.
   */
  public function throttleKey(): string
  {
    return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
  }
}
