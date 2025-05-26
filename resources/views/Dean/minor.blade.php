<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center space-x-4">
      <img src="https://placehold.co/40x40" alt="Admin Picture" class="w-16 h-16 rounded-md object-cover">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Hello Program Dean, {{ Auth::user()->department ?? 'Unknown Department' }}
      </h2>
    </div>
  </x-slot>

  <div x-data="{ sidebarOpen: false }" class="flex min-h-screen">
    <!-- Sidebar -->
    @include('dean.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-6 bg-gray-100 min-h-screen">
      <!-- Flash Message -->
      @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-md mt-4">
        {{ session('success') }}
      </div>
      @endif

      <!-- Search Form -->
      <form method="GET" action="{{ route('DeanMinorSearch') }}" class="mb-4 p-4 bg-white shadow-md rounded-lg">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div>
            <label for="student_id" class="block text-gray-700 font-medium">Student ID</label>
            <input type="text" id="student_id" name="student_id" class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('student_id', request('student_id')) }}" placeholder="Enter Student ID">
          </div>
          <div>
            <label for="ref_num" class="block text-gray-700 font-medium">Reference Number</label>
            <input type="text" id="ref_num" name="ref_num" class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('ref_num', request('ref_num')) }}" placeholder="Enter Reference Number">
          </div>
          <div>
            <label for="last_name" class="block text-gray-700 font-medium">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('last_name', request('last_name')) }}" placeholder="Enter Last Name">
          </div>
        </div>
        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Search</button>
        <a href="{{ route('dean.minor') }}" class="mt-4 inline-block bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Clear</a>

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
                <th class="py-3 px-6 text-left">Reference Number</th>
                <th class="py-3 px-6 text-left">Student ID</th>
                <th class="py-3 px-6 text-left">First Name</th>
                <th class="py-3 px-6 text-left">Last Name</th>
                <th class="py-3 px-6 text-left">Violation Details</th>
                <th class="py-3 px-6 text-left">Status</th>
                <th class="py-3 px-6 text-left">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($students as $student)
              <tr class="border-b hover:bg-gray-100">
                <td class="py-3 px-6">
                  @if ($student->ref_num)
                  {{ $student->ref_num }}
                  @else
                  <span class="text-gray-400 italic">No Reference Numbet yet</span>
                  @endif
                </td>
                <td class="py-3 px-6">{{ $student->student_id }}</td>
                <td class="py-3 px-6">{{ $student->first_name }}</td>
                <td class="py-3 px-6">{{ $student->last_name }}</td>
                <td class="py-3 px-6">{{ $student->offense_type.': '.$student->violation}}</td>
                <td class="py-3 px-6">
                  @if ($student->status == 0)
                  <span class="text-yellow-500 font-semibold">Pending</span>
                  @elseif ($student->status == 2)
                  <span class="text-gray-500 font-semibold">Resolved</span>
                  @else
                  <span class="text-blue-500 font-semibold">In Progress</span>
                  @endif
                </td>

                <td class="py-3 px-6">
                  @if ($student->status != 0)
                  <span class="text-blue-600 font-semibold italic">Already Approved and Submitted to Admin</span>
                  @else
                 <form action="{{ route('dean.violation.approve', $student->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                      class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition block text-center w-full">
                      Approve
                    </button>
                  </form>
                  @endif
                </td>


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