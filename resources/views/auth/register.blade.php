<header class="w-full max-w-4xl mx-auto p-6 flex items-center justify-between">
  <div class="flex items-center">
    <img src="{{ asset('images/backgrounds/spup-logo.png') }}" alt="Logo" class="h-16 w-auto mr-4"> <!-- Adjust height as needed -->
    <span class="font-oldEnglish text-spupGreen text-2xl">
      St. Paul University Philippines
    </span>
  </div>

  <nav>
    @if (Route::has('login'))
    @auth
    <form method="POST" action="{{ route('logout') }}" class="inline-block">
      @csrf
      <button type="submit" class="px-5 py-2 text-gray-600 border border-green-700 hover:bg-yellow-400 hover:text-white rounded-md">
        Apply Now
      </button>
    </form>
    @else
    <a href="{{ route('login') }}" class="inline-block px-5 py-2 text-gray-600 font-medium hover:text-spupGold">
      Sign In
    </a>
    @if (Route::has('register'))
    <a href="{{ route('register') }}" class="inline-block px-5 py-2 text-gray-600 font-medium hover:text-spupGold">
      Create an Account
    </a>
    @endif
    @endauth
    @endif
  </nav>
</header>
<x-guest-layout>

  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="grid grid-cols-2 gap-4 -mt-20">
      <div>
        <!--First Name -->
        <div>
          <x-input-label for="fname" :value="__('First Name')" />
          <x-text-input id="fname"
            class="block mt-1 w-full uppercase focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100"
            type="text" name="fname" :value="old('fname')" required autofocus autocomplete="fname"
            placeholder="Enter First Name" />
          <x-input-error :messages="$errors->get('fname')" class="mt-2" />
        </div>

        <!-- Department -->
        <div class="mt-4">
          <x-input-label for="department" :value="__('Department')" />
          <select id="department" name="department" required
            class="block mt-1 w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100">
            <option value="" disabled selected>Select Department</option>
            <option value="SITE">SITE</option>
            <option value="SBAHM">SBAHM</option>
            <option value="SASTE">SASTE</option>
            <option value="SNAHS">SNAHS</option>
          </select>
          <x-input-error :messages="$errors->get('department')" class="mt-2" />
        </div>

        <!-- Course -->
        <div id="course-dropdown" class="mt-4 hidden">
          <x-input-label for="year_level" :value="__('Course')" />
          <select id="year_level" name="year_level" required
            class="block mt-1 w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100">
            <option value="" disabled selected>Select Course</option>
          </select>
          <x-input-error :messages="$errors->get('year_level')" class="mt-2" />
        </div>

        <script>
          const coursesByDepartment = @json($coursesByDepartment);

          document.getElementById('department').addEventListener('change', function() {
            const department = this.value;
            const courseDropdown = document.getElementById('course-dropdown');
            const courseSelect = document.getElementById('year_level');

            // Clear existing options
            courseSelect.innerHTML = '<option value="" disabled selected>Select Course</option>';

            if (coursesByDepartment[department]) {
              coursesByDepartment[department].forEach(course => {
                const option = document.createElement('option');
                option.value = course;
                option.textContent = course;
                courseSelect.appendChild(option);
              });

              courseDropdown.classList.remove('hidden');
            } else {
              courseDropdown.classList.add('hidden');
            }
          });
        </script>

        <!-- Account Type -->
        <div class="mt-4">
          <!-- Alpine.js for dynamic input toggling -->
          <x-input-label for="account_type" :value="__('Account Type')" />
          <select id="account_type" name="account_type"
            class="block mt-1 w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100"
            required x-data x-on:change="$dispatch('account-type-changed', $event.target.value)">
            <option value="" disabled selected>Select Account Type</option>
            <option value="student">Student</option>
            <option value="alumni">Alumni</option>
            <option value="psg_officer">PSG Officer</option>
          </select>
          <x-input-error :messages="$errors->get('account_type')" class="mt-2" />
        </div>
      </div>
      <div>
        <!-- Last Name -->
        <div>
          <x-input-label for="lname" :value="__('Last name')" />
          <x-text-input id="lname"
            class="block mt-1 w-full uppercase focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100"
            type="text" name="lname" :value="old('lname')" required autocomplete="lname" placeholder="Enter Last Name" />
          <x-input-error :messages="$errors->get('lname')" class="mt-2" />
        </div>
        <!-- Student ID  -->
        <div class="mt-4">
          <x-input-label for="student_id" :value="__('Student ID')" />
          <x-text-input id="student_id"
            class="block mt-1 w-full focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100"
            type="text" name="student_id" :value="old('student_id')" required autocomplete="student_id"
            placeholder="Enter Student ID" />
          <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
          <x-input-label for="email" :value="__('Email')" />
          <x-text-input id="email"
            class="block mt-1 w-full focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100"
            type="email" name="email" :value="old('email')" required autocomplete="username"
            placeholder="Entel Valid Email" />
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
      </div>
    </div>

    <!-- Password -->
        <div class="mt-4">
          <x-input-label for="password" :value="__('Password')" />

          <x-text-input id="password"
            class="block mt-1 w-full focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100"
            type="password" name="password" required autocomplete="new-password" placeholder="Enter Password" />

          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
          <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

          <x-text-input id="password_confirmation"
            class="block mt-1 w-full focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100"
            type="password" name="password_confirmation" required autocomplete="new-password"
            placeholder="Confirm Password" />

          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

    <div class="flex items-center justify-center mt-4">
      <a class="underline text-sm text-gray-600 hover:text-spupGold focus:outline-none focus:ring-0 focus:ring-offset-0"
        href="{{ route('login') }}">
        {{ __('Already registered?') }}
      </a>

      <x-primary-button class="ms-4 bg-green-700 hover:bg-green-900">
        {{ __('Register') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>