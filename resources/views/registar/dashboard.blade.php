<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Registrar Dashboard
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
        Registrar Dashboard
      </div>

      <nav class="mt-4">
        <a href="{{ route('registar.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700">Applications</a>
      </nav>

      <!-- Logout Button -->
      <form method="POST" action="{{ route('logout') }}" class="mt-6">
        @csrf
        <button type="submit" class="w-full bg-gray-800 text-white p-2 rounded-md">Logout</button>
      </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 sm:px-8 lg:px-12">
      <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4">Good Moral Certificate Applications</h3>

        @if(session('status'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-4">
          {{ session('status') }}
        </div>
        @endif

        @if($applications->isEmpty())
        <p>No applications available.</p>
        @else
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
          <thead>
            <tr class="text-left border-b">
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Student ID</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Full Name</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Status</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Applied On</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($applications as $application)
            <tr class="border-b">
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->student->student_id }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->student->fullname }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ ucfirst($application->status) }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->created_at->format('Y-m-d') }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">
                @if($application->status == 'pending')
                <!-- Approve Form -->
                <form action="{{ route('registar.approve', $application->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="bg-green-500 text-white p-2 rounded-md">Approve</button>
                </form>

                <!-- Reject Form -->
                <form action="{{ route('registar.reject', $application->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="bg-red-500 text-white p-2 rounded-md">Reject</button>
                </form>
                @else
                <span class="text-gray-500">No action available</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif
      </div>
    </main>
  </div>
</x-app-layout>