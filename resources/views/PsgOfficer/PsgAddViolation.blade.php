<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center space-x-4">
      <img src="/images/backgrounds/spup-logo.png" alt="Admin Picture" class="w-16 h-16 rounded-md object-cover">
      <span class="text-2xl">
        Add Violation
      </span>
    </div>
  </x-slot>
  <hr class="h-1 bg-spupGreen border-0">
  <hr class="h-1 bg-spupGold border-0">

  <div x-data="{ sidebarOpen: false }" class="flex">

    <!-- Sidebar Toggle Button (Positioned Below Header) -->
    <div class="sm:hidden w-full bg-gray-100 border-b border-gray-300 py-2 flex justify-between px-4">
      <button @click="sidebarOpen = !sidebarOpen"
        class="bg-gray-800 text-white p-2 rounded-md">
        ☰ Menu
      </button>
    </div>

    <!-- Sidebar -->
    @include('PsgOfficer.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-4">
      @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-md mt-4">
        {{ session('success') }}
      </div>
      @endif
      <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4">Add Violator</h3>
        <!-- Form -->
        <form method="POST" action="{{ route('registerviolation') }}" class="space-y-4">
          @csrf
          <div class="mt-4">
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input
              id="first_name"
              class="block mt-1 w-full focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100"
              type="text"
              name="first_name" required
              :value="old('first_name')"
              required autofocus autocomplete="first_name"
              placeholder="Enter Firstname" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
          </div>

          <div class="mt-4">
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input
              id="last_name"
              class="block mt-1 w-full focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100"
              type="text"
              name="last_name"
              :value="old('last_name')"
              required autocomplete="last_name"
              placeholder="Enter Last Name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
          </div>

          <div class="mt-4">
            <x-input-label for="student_id" :value="__('Student ID')" />
            <x-text-input
              id="student_id"
              class="block mt-1 w-full focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100"
              type="text"
              name="student_id"
              required autocomplete="student_id"
              placeholder="Enter Student ID" />
            <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
          </div>

          <div class="mt-4">
            <x-input-label for="department" :value="__('Department')" />
            <select
              id="department"
              name="department"
              class="block mt-1 w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100"
              required>
              <option value="" disabled selected>Select Department</option>
              <option value="SITE">SITE</option>
              <option value="SASTE">SASTE</option>
              <option value="SBAHM">SBAHM</option>
              <option value="SNAHS">SNAHS</option>
            </select>
            <x-input-error :messages="$errors->get('department')" class="mt-2" />
          </div>

          <div x-data="{ showExtraInput: false }" class="mt-4">
            <x-input-label for="violation" :value="__('Violation Type')" />
            <select
              id="violation"
              name="violation"
              @change="showExtraInput = ($event.target.value === 'Others')"
              class="block mt-1 w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100"
              required
              x-on:change="$dispatch('account-type-changed', $event.target.value)">

              <option value="" disabled selected>Select Violation Type</option>
              @foreach ($violations as $violation)
              <option value="{{ $violation->offense_type }}|{{ $violation->description }}">
                {{ $violation->description }}
              </option>
              @endforeach

              <option value="Others">Others</option>
            </select>
            <x-input-error :messages="$errors->get('violation')" class="mt-2" />
            <!-- Extra Input Field (Only visible when "PSG Officer" is selected) -->
            <div x-show="showExtraInput" class="mt-4">
              <select
                id="OtherType"
                name="OtherType"
                class="block mt-1 w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100">
                <option value="" disabled selected>Select Violation Type</option>
                <option value="minor">Minor</option>
                <option value="major">Major</option>
              </select>
            </div>

            <div x-show="showExtraInput" class="mt-4">
              <x-input-label for="others" :value="__('Violation')" />
              <x-text-input
                id="others"
                class="block mt-1 w-full focus:border-spupGreen focus:ring-1 focus:ring-spupGreen focus:ring-opacity-100"
                type="text"
                name="others"
                placeholder="Enter Violation" />
              <x-input-error :messages="$errors->get('others')" class="mt-2" />
            </div>

          </div>

          <!-- Submit Button -->
          <button type="submit"
            class="mt-4 px-4 py-2 bg-spupGreen text-white rounded hover:bg-green-900">
            Submit
          </button>
        </form>
      </div>
    </main>

  </div>
</x-app-layout>