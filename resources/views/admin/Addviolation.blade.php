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
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700">Dashboard</a>
        <a href="{{ route('admin.Application') }}" class="block px-4 py-2 hover:bg-gray-700">Good Moral Application</a>
        <a href="{{ route('admin.AddAccount') }}" class="block px-4 py-2 hover:bg-gray-700">Add Account</a>
        <a href="{{ route('admin.AddViolation') }}"
          class="block px-4 py-2 hover:bg-gray-700 
   {{ request()->routeIs('admin.AddViolation') ? 'bg-gray-700 text-white' : 'text-gray-300' }}">
          Add Violation
        </a>
        <a href="{{ route('admin.psgApplication') }}" class="block px-4 py-2 hover:bg-gray-700">PSG Application</a>
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
        <h3 class="text-lg font-semibold mb-4">Add Violation</h3>
        <!-- Form -->
        <form method="POST" action="{{ route('RegisterViolation') }}" class="space-y-4">
          @csrf

          <div class="mt-4">
            <x-input-label for="offense_type" :value="__('Offense Type')" />
            <select
              id="offense_type"
              name="offense_type"
              required
              class="block mt-1 w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100">
              <option value="" disabled selected>Select Offense Type</option>
              <option value="major">Major</option>
              <option value="minor">Minor</option>
            </select>
            <x-input-error :messages="$errors->get('offense_type')" class="mt-2" />
          </div>
          <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />

            <x-text-input
              id="description"
              class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
              type="text"
              name="description" required
              :value="old('description')"
              autofocus autocomplete="description"
              placeholder="Add Description" />

            <x-input-error :messages="$errors->get('description')" class="mt-2" />
          </div>


          <!-- Submit Button -->
          <button type="submit"
            class="mt-4 px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800">
            Submit
          </button>
        </form>
        <div class="bg-white p-6 shadow-md rounded-lg">
          <h3 class="text-lg font-semibold mb-4">List of Violation</h3>
          @if ($violations->isEmpty())
          <div class="text-center py-4 text-gray-500">No student violations found.</div>
          @else
          <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
              <thead>
                <tr class="text-left border-b">
                  <th class="py-3 px-6 text-left">Offense Type</th>
                  <th class="py-3 px-6 text-left">Description</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($violations as $violation)
                <tr class="text-left border-b">
                  <td class="py-3 px-6">{{ $violation->offense_type }}</td>
                  <td class="py-3 px-6">{{ $violation->description }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- Pagination -->
          <div class="mt-4">
            {{ $violationpage->links() }}
          </div>
          @endif
        </div>
      </div>
    </main>

  </div>
</x-app-layout>