<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Admin Dashboard
    </h2>
  </x-slot>

  <div x-data="{ sidebarOpen: false, showEditModal: false, selectedViolation: {} }" class="flex">

    <!-- Sidebar Toggle Button (Positioned Below Header) -->
    <div class="sm:hidden w-full bg-gray-100 border-b border-gray-300 py-2 flex justify-between px-4">
      <button @click="sidebarOpen = !sidebarOpen" class="bg-gray-800 text-white p-2 rounded-md">
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
        <a href="{{ route('admin.Application') }}" class="block px-4 py-2 hover:bg-gray-700">Good Moral Application Monitoring</a>
        <a href="{{ route('admin.AddAccount') }}" class="block px-4 py-2 hover:bg-gray-700">Add Account</a>
        <a href="{{ route('admin.AddViolation') }}" class="block px-4 py-2 hover:bg-gray-700 
   {{ request()->routeIs('admin.AddViolation') ? 'bg-gray-700 text-white' : 'text-gray-300' }}">
          Add Violation
        </a>
        <a href="{{ route('admin.psgApplication') }}" class="block px-4 py-2 hover:bg-gray-700">PSG Application</a>
        <a href="{{ route('admin.GMAApporvedByRegistrar') }}" class="block px-4 py-2 hover:bg-gray-700"> Good Moral Application Approve/Reject</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 sm:px-8 lg:px-12">
      @if(session('status'))
      <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-md mt-4">
        {{ session('status') }}
      </div>
      @endif
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
            <select id="offense_type" name="offense_type" required
              class="block mt-1 w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100">
              <option value="" disabled selected>Select Offense Type</option>
              <option value="major">Major</option>
              <option value="minor">Minor</option>
            </select>
            <x-input-error :messages="$errors->get('offense_type')" class="mt-2" />
          </div>
          <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />

            <x-text-input id="description"
              class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
              type="text" name="description" required :value="old('description')" autofocus autocomplete="description"
              placeholder="Add Description" />

            <x-input-error :messages="$errors->get('description')" class="mt-2" />
          </div>


          <!-- Submit Button -->
          <button type="submit" class="mt-4 px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800">
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
                  <th class="py-3 px-6 text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($violations as $violation)
                <tr class="text-left border-b">

                  <td class="py-3 px-6">

                    @if($violation->offense_type == 'major')
                    Major
                    @elseif($violation->offense_type == 'minor')
                    Minor
                    @endif
                  </td>

                  <td class="py-3 px-6">{{ $violation->description }}</td>
                  <td>
                    <button @click="selectedViolation = {{ $violation }}, showEditModal = true" type="button"
                      class="bg-blue-500 text-white p-2 rounded-md mr-2">
                      Edit
                    </button>

                    <!-- Reject Form -->
                    <form action="{{ route('admin.deleteViolation', $violation->id) }}" method="POST"
                      style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="bg-red-500 text-white p-2 rounded-md">Delete</button>
                    </form>
                  </td>
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
      <!-- Edit Modal -->
      <div x-show="showEditModal" x-cloak
        class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div @click.away="showEditModal = false" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">

          <h2 class="text-lg font-semibold mb-4">Edit Violation</h2>

          <form method="POST" :action="'/admin/violation/update/' + selectedViolation . id">
            @csrf
            @method('PATCH')

            <!-- Offense Type -->
            <div class="mb-4">
              <label for="offense_type" class="block text-sm font-medium text-gray-700">Offense Type</label>
              <select name="offense_type" id="offense_type" x-model="selectedViolation.offense_type"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                <option value="major">Major</option>
                <option value="minor">Minor</option>
              </select>
            </div>

            <!-- Description -->
            <div class="mb-4">
              <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
              <input type="text" name="description" id="description" x-model="selectedViolation.description"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
                required>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-2">
              <button type="button" @click="showEditModal = false" class="px-4 py-2 bg-gray-300 rounded-md">
                Cancel
              </button>
              <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                Save Changes
              </button>
            </div>
          </form>
        </div>
      </div>

    </main>

  </div>
</x-app-layout>