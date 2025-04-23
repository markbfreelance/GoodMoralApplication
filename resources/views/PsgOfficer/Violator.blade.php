<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
  </x-slot>

  <div x-data="{ sidebarOpen: false }" class="flex min-h-screen">
    <!-- Sidebar -->
    @include('PsgOfficer.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-6 bg-gray-100 min-h-screen">
      <!-- Flash Message -->
      @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-md mt-4">
        {{ session('success') }}
      </div>
      @endif

      <!-- Search Form -->
      <form method="GET" action="{{ route('psgsearch') }}" class="mb-4 p-4 bg-white shadow-md rounded-lg">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div>
            <label for="student_id" class="block text-gray-700 font-medium">Student ID</label>
            <input type="text" id="student_id" name="student_id" class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('student_id', request('student_id')) }}" placeholder="Enter Student ID">
          </div>
          <div>
            <label for="first_name" class="block text-gray-700 font-medium">First Name</label>
            <input type="text" id="first_name" name="first_name" class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('first_name', request('first_name')) }}" placeholder="Enter First Name">
          </div>
          <div>
            <label for="last_name" class="block text-gray-700 font-medium">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('last_name', request('last_name')) }}" placeholder="Enter Last Name">
          </div>
        </div>
        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Search</button>
      </form>

      <!-- Violators Table -->
      <div class="bg-white p-6 shadow-md rounded-lg">
        <h3 class="text-lg font-semibold mb-4">List of Violators</h3>
        @if ($students->isEmpty())
        <div class="text-center py-4 text-gray-500">No student violations found.</div>
        @else
        <div class="overflow-x-auto">
          <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead class="bg-gray-800 text-white">
              <tr>
                <th class="py-3 px-6 text-left">Student ID</th>
                <th class="py-3 px-6 text-left">First Name</th>
                <th class="py-3 px-6 text-left">Last Name</th>
                <th class="py-3 px-6 text-left">Violation Details</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($students as $student)
              <tr class="border-b hover:bg-gray-100">
                <td class="py-3 px-6">{{ $student->student_id }}</td>
                <td class="py-3 px-6">{{ $student->first_name }}</td>
                <td class="py-3 px-6">{{ $student->last_name }}</td>
                <td class="py-3 px-6">{{ $student->offense_type.': '.$student->violation}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- Pagination -->
        <div class="mt-4">
          {{ $students->links() }}
        </div>
        @endif
      </div>
    </main>
  </div>
</x-app-layout>