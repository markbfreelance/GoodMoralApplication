<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Admin Dashboard
    </h2>
  </x-slot>

  <div x-data="{ sidebarOpen: false }" class="flex">

    <!-- Sidebar Toggle Button (Positioned Below Header) -->
    <div class="sm:hidden w-full bg-gray-100 border-b border-gray-300 py-2 flex justify-between px-4">
      <button @click="sidebarOpen = !sidebarOpen"
        class="bg-gray-800 text-white p-2 rounded-md">
        ☰ Menu
      </button>
    </div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
      class="w-64 bg-gray-800 text-white min-h-screen fixed sm:relative left-0 transform transition-transform duration-300 sm:translate-x-0">

      <div class="p-4 text-lg font-bold border-b border-gray-700">
        Admin Panel
      </div>

      <nav class="mt-4">
        <a class="block px-4 py-2 hover:bg-gray-700 
   {{ request()->routeIs('PsgOfficer.PsgAddViolation') ? 'bg-gray-700 text-white' : 'text-gray-300'}}">
          Add Violator
        </a>
        <a href="{{ route('PsgOfficer.Violator') }}" class="block px-4 py-2 hover:bg-gray-700"> Violator</a>

      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 sm:px-8 lg:px-12">
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
              class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
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
              class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
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
              class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
              type="text"
              name="student_id"
              required autocomplete="student_id"
              placeholder="Enter Student ID" />
            <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
          </div>

          <div x-data="{ showExtraInput: false }" class="mt-4">
            <x-input-label for="violation" :value="__('Violation Type')" />
            <select
              id="violation"
              name="violation"
              @change="showExtraInput = ($event.target.value === 'Others')"
              class="block mt-1 w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
              required
              x-on:change="$dispatch('account-type-changed', $event.target.value)">

              <option value="" disabled selected>Select Violation Type</option>
              <option value="Haircut/punky hair">A - Haircut/punky hair (Male)</option>
              <option value="Dyed hair">B - Dyed hair (Male/Female)</option>
              <option value="Unprescribed undergarment">C - Unprescribed undergarment (Male/Female)</option>
              <option value="Unprescribed shoes (Male/Female)">D - Unprescribed shoes (Male/Female)</option>
              <option value="Long/short skirt (female)">E - Long/short skirt (female)</option>
              <option value="Being noisy along corridors">F - Being noisy along corridors</option>
              <option value="Not wearing of ID properly">G - Not wearing of ID properly</option>
              <option value="Earring (male)/tounge ring (male/female)">H - Earring (male)/tounge ring (male/female)</option>
              <option value="Wearing of cap inside the campus">I - Wearing of cap inside the campus</option>
              <option value="Others">Others</option>
            </select>

            <x-input-error :messages="$errors->get('violation')" class="mt-2" />

            <!-- Extra Input Field (Only visible when "PSG Officer" is selected) -->
            <div x-show="showExtraInput" class="mt-4">
              <x-input-label for="others" :value="__('Violation')" />
              <x-text-input
                id="others"
                class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
                type="text"
                name="others"
                placeholder="Enter Violation" />
              <x-input-error :messages="$errors->get('others')" class="mt-2" />
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit"
            class="mt-4 px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800">
            Submit
          </button>
        </form>
      </div>
    </main>

  </div>
</x-app-layout>