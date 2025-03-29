<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div>
      <x-input-label for="account_type" :value="__('Seclect Account Type')" />
      <select id="account_type"
        name="account_type"
        class="block mt-1 w-full border-gray-300 focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100 rounded-md shadow-sm">
        <option value="" disabled selected>Select Acoount Type</option>
        <option value="admin">Administrator</option>
        <option value="registar">Registar</option>
        <option value="dean">Dean</option>
        <option value="psg_officer">PSG Officer</option>
        <option value="alumni">Alumni</option>
        <option value="student">Student</option>

      </select>
      <x-input-error :messages="$errors->get('account_type')" class="mt-2" />
    </div>

    <div class="mt-4">
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input
        id="email"
        class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
        type="email"
        name="email"
        :value="old('email')"
        required autofocus autocomplete="username"
        placeholder="Enter Email" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" />

      <x-text-input
        id="password"
        class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
        type="password"
        name="password"
        required autofocus autocomplete="current-password"
        placeholder="Enter Password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
      <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-700 shadow-sm focus:ring-green-700" name="remember">
        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
      </label>
    </div>

    <div class="flex items-center justify-end mt-4">
      @if (Route::has('password.request'))
      <a class="underline text-sm text-gray-600 hover:text-yellow-800 focus:outline-none focus:ring-0 focus:ring-offset-0" href="{{ route('password.request') }}">
        {{ __('Forgot your password?') }}
      </a>
      @endif

      <x-primary-button class="ms-3 bg-green-700 hover:bg-green-900">
        {{ __('Log in') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>