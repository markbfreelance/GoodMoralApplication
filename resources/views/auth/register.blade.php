<x-guest-layout>
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div>
      <x-input-label for="fname" :value="__('First Name')" />
      <x-text-input
        id="fname"
        class="block mt-1 w-full uppercase focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
        type="text"
        name="fname"
        :value="old('fname')"
        required autofocus autocomplete="fname"
        placeholder="Enter First Name" />
      <x-input-error :messages="$errors->get('fname')" class="mt-2" />
    </div>
    <!-- -->
    <div class="mt-4">
      <x-input-label for="lname" :value="__('Last name')" />
      <x-text-input
        id="lname"
        class="block mt-1 w-full uppercase focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
        type="text" name="lname"
        :value="old('lname')"
        required autocomplete="lname"
        placeholder="Enter Last Name" />
      <x-input-error :messages="$errors->get('lname')" class="mt-2" />
    </div>

    <div class="mt-4">
      <x-input-label for="department" :value="__('Department')" />
      <select
        id="department"
        name="department"
        required
        class="block mt-1 w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100">
        <option value=""  disabled selected>Select Department</option>
        <option value="SITE">SITE</option>
        <option value="SBAHM">SBAHM</option>
        <option value="SASTE">SASTE</option>
        <option value="BEU">BEU</option>
        <option value="SNAHS">SNAHS</option>
      </select>
      <x-input-error :messages="$errors->get('department')" class="mt-2" />
    </div>

    <!-- Account Type -->
    <div class="mt-4">
      <!-- Alpine.js for dynamic input toggling -->
      <x-input-label for="account_type" :value="__('Account Type')" />
      <select
        id="account_type"
        name="account_type"
        class="block mt-1 w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
        required
        x-data
        x-on:change="$dispatch('account-type-changed', $event.target.value)">
        <option value="" disabled selected>Select Account Type</option>
        <option value="student">Student</option>
        <option value="alumni">Alumni</option>
        <option value="psg_officer">PSG Officer</option>
      </select>
      <x-input-error :messages="$errors->get('account_type')" class="mt-2" />
    </div>

    <!-- Student ID  -->
    <div class="mt-4">
      <x-input-label for="student_id" :value="__('Student ID')" />
      <x-text-input
        id="student_id"
        class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
        type="text"
        name="student_id"
        :value="old('student_id')"
        required autocomplete="student_id"
        placeholder="Enter Student ID" />
      <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
    </div>

    <!-- Year level  -->
    <div class="mt-4">
      <x-input-label for="year_level" :value="__('Year Level')" />
      <x-text-input
        id="year_level"
        class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
        type="text"
        name="year_level"
        :value="old('year_level')"
        required placeholder="Year / Course" />
      <x-input-error :messages="$errors->get('year_level')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input
        id="email"
        class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
        type="email"
        name="email"
        :value="old('email')"
        required autocomplete="username"
        placeholder="Entel Valid Email" />
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
        required autocomplete="new-password"
        placeholder="Enter Password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
      <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

      <x-text-input
        id="password_confirmation"
        class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
        type="password"
        name="password_confirmation"
        required autocomplete="new-password"
        placeholder="Confirm Password" />

      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
      <a class="underline text-sm text-gray-600 hover:text-yellow-800 focus:outline-none focus:ring-0 focus:ring-offset-0" href="{{ route('login') }}">
        {{ __('Already registered?') }}
      </a>

      <x-primary-button class="ms-4 bg-green-700 hover:bg-green-900">
        {{ __('Register') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>