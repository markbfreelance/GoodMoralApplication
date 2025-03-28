<x-guest-layout>
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div>
      <x-input-label for="fname" :value="__('First Name')" />
      <x-text-input id="fname" class="block mt-1 w-full" type="text" name="fname" :value="old('fname')" required autofocus autocomplete="fname" placeholder="Enter First Name" />
      <x-input-error :messages="$errors->get('fname')" class="mt-2" />
    </div>
    <!-- -->
    <div class="mt-4">
      <x-input-label for="lname" :value="__('Last name')" />
      <x-text-input id="lname" class="block mt-1 w-full" type="text" name="lname" :value="old('lname')" required autocomplete="lname" placeholder="Enter Last Name" />
      <x-input-error :messages="$errors->get('lname')" class="mt-2" />
    </div>

    <!-- Account Type -->
    <div class="mt-4">
      <x-input-label for="account_type" :value="__('Account Type')" />

      <!-- Alpine.js for dynamic input toggling -->
      <select id="account_type" name="account_type"
        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        required x-data x-on:change="$dispatch('account-type-changed', $event.target.value)">
        <option value="" disabled selected>Select Account Type</option>
        <option value="student">Student</option>
        <option value="psg_officer">PSG Officer</option>
      </select>

      <x-input-error :messages="$errors->get('account_type')" class="mt-2" />
    </div>

    <!-- Additional inputs (shown only if PSG Officer is selected) -->
    <div class="mt-4" x-data="{ show: false }" x-on:account-type-changed.window="show = ($event.detail === 'psg_officer')">
      <template x-if="show">
        <div>
          <x-input-label for="organization" :value="__('Organization')" />
          <x-text-input id="organization" class="block mt-1 w-full" type="text" name="organization" placeholder="Enter Organization" />
          <x-input-error :messages="$errors->get('organization')" class="mt-2" />
        </div>
      </template>
    </div>
    <!-- Student ID  -->
    <div class="mt-4">
      <x-input-label for="student_id" :value="__('Student ID')" />
      <x-text-input id="student_id" class="block mt-1 w-full" type="number" name="student_id" 
        :value="old('student_id')" required autocomplete="student_id" placeholder="Enter Student ID" />
      <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
    </div>

    <!-- Year level  -->
    <div class="mt-4">
      <x-input-label for="year_level" :value="__('Year Level')" />
      <x-text-input id="year_level" class="block mt-1 w-full" type="text" name="year_level" :value="old('year_level')" required placeholder="Year / Course " />
      <x-input-error :messages="$errors->get('year_level')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Entel Valid Email" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" />

      <x-text-input id="password" class="block mt-1 w-full"
        type="password"
        name="password"
        required autocomplete="new-password" placeholder="Enter Password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
      <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

      <x-text-input id="password_confirmation" class="block mt-1 w-full"
        type="password"
        name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />

      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
      <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
        {{ __('Already registered?') }}
      </a>

      <x-primary-button class="ms-4">
        {{ __('Register') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>