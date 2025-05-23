<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Admin Dashboard
    </h2>
  </x-slot>

  <div x-data="{ sidebarOpen: false }" class="flex">

    <!-- Sidebar Toggle Button (Positioned Below Header) -->
    <div class="sm:hidden w-full bg-gray-100 border-b border-gray-300 py-2 flex justify-between px-4">
      <button @click="sidebarOpen = !sidebarOpen" class="bg-gray-800 text-white p-2 rounded-md">
        ☰ Menu
      </button>
    </div>

    <!-- Sidebar -->
    @include('admin.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-6 sm:px-8 lg:px-12">
      @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-md mt-4">
        {{ session('success') }}
      </div>
      @endif
      <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4">Add Account</h3>
        <!-- Form -->
        <form method="POST" action="{{ route('registeraccount') }}" class="space-y-4">
          @csrf

          <div x-data="{ showExtraInput: false }" class="mt-4">
            <x-input-label for="account_type" :value="__('Account Type')" />

            <select id="account_type" name="account_type"
              @change="showExtraInput = ($event.target.value === 'psg_officer')"
              class="block mt-1 w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
              required x-on:change="$dispatch('account-type-changed', $event.target.value)">

              <option value="" disabled selected>Select Account Type</option>
              <option value="dean">Dean</option>
              <option value="sec_osa">Moderator</option>
              <option value="registar">Registar</option>
              <option value="prog_coor">Program Coordinator</option>
            </select>

            <x-input-error :messages="$errors->get('account_type')" class="mt-2" />

            <!-- Department -->
            <div x-data="{ showExtraInput: false }" class="mt-4">
              <x-input-label for="department" :value="__('Department')" />

              <select id="department" name="department"
                @change="showExtraInput = ($event.target.value === 'Others')"
                class="block mt-1 w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
                required x-on:change="$dispatch('department-changed', $event.target.value)">

                <option value="" disabled selected>Select Department</option>
                <option value="SITE">SITE</option>
                <option value="SASTE">SASTE</option>
                <option value="SBAHM">SBAHM</option>
                <option value="SNAHS">SNAHS</option>
              </select>

              <div x-show="showExtraInput" class="mt-2">
                <x-input-label for="other_department" :value="__('Please specify other department')" />
                <input type="text" name="other_department" id="other_department" class="mt-1 block w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100" placeholder="Please specify..." />
              </div>

              <x-input-error :messages="$errors->get('department')" class="mt-2" />
            </div>



            <!-- Extra Input Field (Only visible when "PSG Officer" is selected) -->
            <div x-show="showExtraInput" class="mt-4">
              <x-input-label for="student_id" :value="__('Student ID')" />
              <x-text-input id="student_id"
                class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
                type="text" name="student_id" :value="old('student_id')" autocomplete="student_id"
                placeholder="Enter Student ID" />
              <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
            </div>
          </div>


          <div class="mt-4">
            <x-input-label for="fullname" :value="__('Full Name')" />
            <x-text-input id="fullname"
              class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
              type="text" name="fullname" required :value="old('fullname')" required autofocus autocomplete="fullname"
              placeholder="Surname, Firstname" />
            <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
          </div>

          <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email"
              class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
              type="email" name="email" :value="old('email')" required autocomplete="username"
              placeholder="Enter Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>

          <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password"
              class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
              type="password" name="password" required autocomplete="new-password" placeholder="Enter Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>

          <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation"
              class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
              type="password" name="password_confirmation" required autocomplete="new-password"
              placeholder="Confirm Password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
          </div>

          <!-- Submit Button -->
          <button type="submit" class="mt-4 px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800">
            Submit
          </button>
        </form>
      </div>
    </main>

  </div>
</x-app-layout>