<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center space-x-4">
      <img src="/images/backgrounds/spup-logo.png" alt="Admin Picture" class="w-16 h-16 rounded-md object-cover">
      <span class="text-2xl">
        Minor Violations
      </span>
    </div>
  </x-slot>
  <hr class="h-1 bg-spupGreen border-0">
  <hr class="h-1 bg-spupGold border-0">

  <div x-data="{ sidebarOpen: false }" class="flex min-h-screen">
    <!-- Sidebar -->
    @include('sec_osa.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-4 bg-gray-100 min-h-screen">
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
                <th class="py-3 px-6 text-left">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($students as $student)
              <tr class="border-b hover:bg-gray-100">
                <td class="py-3 px-6">{{ $student->student_id }}</td>
                <td class="py-3 px-6">{{ $student->first_name }}</td>
                <td class="py-3 px-6">{{ $student->last_name }}</td>
                <td class="py-3 px-6">{{ $student->offense_type.': '.$student->violation}}</td>
                <td class="py-3 px-6">


                  @if ($student->status == 0)
                  <form action="" method="POST" enctype="multipart/form-data" class="mt-2">
                    @csrf
                    <div x-data="{ fileName: '' }" class="space-y-2">
                      <!-- File input styled as a button -->
                      <label class="cursor-pointer inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
                        <span>Browse</span>
                        <input
                          type="file"
                          name="document"
                          class="hidden"
                          @change="fileName = $event.target.files[0]?.name || ''">
                      </label>

                      <!-- Show file name if selected -->
                      <div x-show="fileName" class="text-sm text-gray-600">
                        Selected: <span class="font-semibold" x-text="fileName"></span>
                      </div>

                      <!-- Submit button only shows if file is selected -->
                      <button
                        type="submit"
                        x-show="fileName"
                        class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                        Upload
                      </button>
                    </div>
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