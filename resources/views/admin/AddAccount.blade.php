<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center space-x-4">
      <img src="/images/backgrounds/spup-logo.png" alt="Admin Picture" class="w-16 h-16 rounded-md object-cover">
      <span class="text-2xl">
        Add Account
      </span>
    </div>
  </x-slot>
  <hr class="h-1 bg-spupGreen border-0">
  <hr class="h-1 bg-spupGold border-0">

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
    <main class="flex-1 p-4">
      @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 p-2 rounded-md mt-4">
        {{ session('success') }}
      </div>
      @endif
      <div class="bg-white shadow-sm sm:rounded-lg">
        <h3 class="text-lg font-semibold mb-4">Add Account</h3>
        <!-- Form -->
        <form method="POST" action="{{ route('registeraccount') }}" class="mb-4 p-4 bg-white shadow-md rounded-lg space-y-6">
          @csrf

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <!-- Account Type -->
            <div>
              <label for="account_type" class="block text-gray-700 font-medium mb-1">Account Type</label>
              <select id="account_type" name="account_type"
                class="w-full p-2 border border-gray-300 rounded-md"
                required
                x-data
                x-on:change="showExtraInput = ($event.target.value === 'psg_officer')"
                x-init="$watch('account_type', value => showExtraInput = (value === 'psg_officer'))">
                <option value="" disabled selected>Select Account Type</option>
                <option value="dean" {{ old('account_type') == 'dean' ? 'selected' : '' }}>Dean</option>
                <option value="sec_osa" {{ old('account_type') == 'sec_osa' ? 'selected' : '' }}>Moderator</option>
                <option value="registar" {{ old('account_type') == 'registar' ? 'selected' : '' }}>Registar</option>
                <option value="prog_coor" {{ old('account_type') == 'prog_coor' ? 'selected' : '' }}>Program Coordinator</option>
              </select>
              <x-input-error :messages="$errors->get('account_type')" class="mt-1" />
            </div>

            <!-- Department -->
            <div x-data="{ showOther: false }">
              <label for="department" class="block text-gray-700 font-medium mb-1">Department</label>
              <select id="department" name="department"
                class="w-full p-2 border border-gray-300 rounded-md"
                x-on:change="showOther = $event.target.value === 'Others'"
                required>
                <option value="" disabled selected>Select Department</option>
                <option value="SITE" {{ old('department') == 'SITE' ? 'selected' : '' }}>SITE</option>
                <option value="SASTE" {{ old('department') == 'SASTE' ? 'selected' : '' }}>SASTE</option>
                <option value="SBAHM" {{ old('department') == 'SBAHM' ? 'selected' : '' }}>SBAHM</option>
                <option value="SNAHS" {{ old('department') == 'SNAHS' ? 'selected' : '' }}>SNAHS</option>
                <option value="Others" {{ old('department') == 'Others' ? 'selected' : '' }}>Others</option>
              </select>
              <div x-show="showOther" class="mt-2">
                <label for="other_department" class="block text-gray-700 font-medium mb-1">Please specify other department</label>
                <input
                  type="text"
                  name="other_department"
                  id="other_department"
                  class="w-full p-2 border border-gray-300 rounded-md"
                  placeholder="Please specify..."
                  value="{{ old('other_department') }}" />
              </div>
              <x-input-error :messages="$errors->get('department')" class="mt-1" />
            </div>

            <!-- Student ID (only if PSG Officer) -->
            <div x-data="{ showExtraInput: false }" x-show="showExtraInput" x-cloak>
              <label for="student_id" class="block text-gray-700 font-medium mb-1">Student ID</label>
              <input
                type="text"
                id="student_id"
                name="student_id"
                placeholder="Enter Student ID"
                class="w-full p-2 border border-gray-300 rounded-md"
                value="{{ old('student_id') }}" />
              <x-input-error :messages="$errors->get('student_id')" class="mt-1" />
            </div>

            <!-- Full Name -->
            <div>
              <label for="fullname" class="block text-gray-700 font-medium mb-1">Full Name</label>
              <input
                type="text"
                id="fullname"
                name="fullname"
                required
                placeholder="Surname, Firstname"
                class="w-full p-2 border border-gray-300 rounded-md"
                value="{{ old('fullname') }}" />
              <x-input-error :messages="$errors->get('fullname')" class="mt-1" />
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
              <input
                type="email"
                id="email"
                name="email"
                required
                placeholder="Enter Email"
                class="w-full p-2 border border-gray-300 rounded-md"
                value="{{ old('email') }}" />
              <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div>
              <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
              <input
                type="password"
                id="password"
                name="password"
                required
                placeholder="Enter Password"
                class="w-full p-2 border border-gray-300 rounded-md" />
              <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div>
              <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirm Password</label>
              <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                required
                placeholder="Confirm Password"
                class="w-full p-2 border border-gray-300 rounded-md" />
              <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

          </div>

          <button type="submit" class="mt-4 bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800">
            Submit
          </button>
        </form>

        <div class="bg-white p-6 shadow-md rounded-lg">
          <h3 class="text-lg font-semibold mb-4">List of Accounts</h3>

          <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
              <thead class="bg-gray-800 text-white">
                <tr>
                  <th class="py-3 px-6 text-left">Fullname</th>
                  <th class="py-3 px-6 text-left">Email</th>
                  <th class="py-3 px-6 text-left">Department</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($students as $student)
                <tr class="border-b hover:bg-gray-100">
                  <td class="py-3 px-6">{{ $student->fullname }}</td>
                  <td class="py-3 px-6">{{ $student->email }}</td>
                  <td class="py-3 px-6">{{ $student->department }}</td>

                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="mt-4">
          {{ $students->links() }}
        </div>

      </div>
    </main>

  </div>
</x-app-layout>