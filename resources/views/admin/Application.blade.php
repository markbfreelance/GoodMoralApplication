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
        <a href="{{ route('admin.Application') }}"
          class="block px-4 py-2 hover:bg-gray-700 
   {{ request()->routeIs('admin.Application') ? 'bg-gray-700 text-white' : 'text-gray-300' }}">
          Good Moral Application Monitoring
        </a>
        <a href="{{ route('admin.AddAccount') }}" class="block px-4 py-2 hover:bg-gray-700">Add Account</a>
        <a href="{{ route('admin.AddViolation') }}" class="block px-4 py-2 hover:bg-gray-700">Add Violation</a>
        <a href="{{ route('admin.psgApplication') }}" class="block px-4 py-2 hover:bg-gray-700">PSG Application</a>
        <a href="{{ route('admin.GMAApporvedByRegistrar') }}" class="block px-4 py-2 hover:bg-gray-700"> Good Moral Application Approve/Reject</a>
      </nav>
    </aside>
    <!-- Main Content -->
    <main class="flex-1 p-6 sm:px-8 lg:px-12">
      <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <form method="GET" action="{{ route('adminApplicationSearch') }}" class="mb-4 p-4 bg-white shadow-md rounded-lg">
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
              <label for="student_id" class="block text-gray-700 font-medium">Student ID</label>
              <input type="text" id="student_id" name="student_id" class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('student_id', request('student_id')) }}" placeholder="Enter Student ID">
            </div>
            <div>
              <label for="department" class="block text-gray-700 font-medium">Department</label>
              <input type="text" id="department" name="department" class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('department', request('department')) }}" placeholder="Enter  Department">
            </div>
            <div>
              <label for="fullname" class="block text-gray-700 font-medium">Last Name</label>
              <input type="text" id="fullname" name="fullname" class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('fullname', request('fullname')) }}" placeholder="Enter Name">
            </div>
          </div>
          <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Search</button>
        </form>
        <h3 class="text-lg font-semibold mb-4">Good Moral Applications</h3>

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
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Department</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Full Name</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Status</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Purpose</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Applied On</th>
            </tr>
          </thead>
          <tbody>

            @foreach($applications as $application)

            <tr class="border-b">
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->student_id }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->department }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->fullname }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->application_status }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->reason }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->created_at->format('Y-m-d') }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">
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