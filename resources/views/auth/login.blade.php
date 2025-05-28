<header class="w-full max-w-4xl mx-auto p-6 flex items-center justify-between">
  <span style="font-family: 'Old English Text MT Std', serif; font-size: 2rem; color: green;">
    St. Paul University Philippines
  </span>
  <nav class="space-x-2">
    @if (Route::has('login'))
    @auth
    <a href="{{ url('/dashboard') }}"
      class="inline-block px-5 py-2 text-gray-600 border border-green-700 hover:bg-yellow-400 hover:text-white rounded-md">
      Go to Dashboard
    </a>
    @else
    <a href="{{ route('login') }}"
      class="inline-block px-5 py-2 text-gray-600 border border-green-700 hover:bg-yellow-400 hover:text-white rounded-md">
      Sign In
    </a>
    @if (Route::has('register'))
    <a href="{{ route('register') }}"
      class="inline-block px-5 py-2 text-gray-600 border border-green-700 hover:bg-yellow-400 hover:text-white rounded-md">
      Create an Account
    </a>
    @endif
    @endauth
    @endif
  </nav>
</header>
<x-guest-layout>
  <!-- Session Status -->


  <form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div>
      <x-auth-session-status class="mb-4" :status="session('status')" />
      <x-input-label for="account_type" :value="__('Seclect Account Type')" />
      <select id="account_type" name="account_type"
        class="block mt-1 w-full border-gray-300 focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100 rounded-md shadow-sm">
        <option value="" disabled selected>Select Account Type</option>
        <option value="admin">Administrator</option>
        <option value="registrar">Registrar</option>
        <option value="sec_osa">Moderator</option>
        <option value="dean">Dean</option>
        <option value="prog_coor">Program Coordinator</option>
        <option value="psg_officer">PSG Officer</option>
        <option value="alumni">Alumni</option>
        <option value="student">Student</option>

      </select>
      <x-input-error :messages="$errors->get('account_type')" class="mt-2" />
    </div>

    <div class="mt-4">
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email"
        class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
        type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
        placeholder="Enter Email" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" />

      <x-text-input id="password"
        class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
        type="password" name="password" required autofocus autocomplete="current-password"
        placeholder="Enter Password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
      <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox"
          class="rounded border-gray-300 text-green-700 shadow-sm focus:ring-green-700" name="remember">
        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
      </label>
    </div>

    <div class="flex items-center justify-end mt-4">
      @if (Route::has('password.request'))
      <a class="underline text-sm text-gray-600 hover:text-yellow-800 focus:outline-none focus:ring-0 focus:ring-offset-0"
        href="{{ route('password.request') }}">
        {{ __('Forgot your password?') }}
      </a>
      @endif

      <x-primary-button class="ms-3 bg-green-700 hover:bg-green-900">
        {{ __('Log in') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>