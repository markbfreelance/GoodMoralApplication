<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center space-x-4">
      <img src="/images/backgrounds/spup-logo.png" alt="Admin Picture" class="w-16 h-16 rounded-md object-cover">
      <span class="text-2xl">
        Approve/Reject Applications
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
    @include('admin.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-4">
      <div class="flex flex-wrap justify-between items-center mb-6 p-2">
        <div class="flex items-center gap-2 font-medium text-base text-gray-500">
          <label>Select period:</label>
          <input type="date" class="border-gray-500 rounded-lg">
          <input type="date" class="border-gray-500 rounded-lg">
        </div>
        <div class="flex items-center gap-2 mt-2 sm:mt-0">
          <!-- search -->
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-gray-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
          </svg>
          <input type="text" placeholder="Search..." class="border-none bg-gray-100 px-2 py-1">
          <div class="h-8 border border-gray-500 mx-4"></div>
          <!-- filter -->
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-gray-500 ms-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
          </svg>
          <button class="bg-gray-100 pe-4">Filter</button>
        </div>
      </div>

      <hr class="bg-gray-700">
      <div class="bg-white shadow-sm sm:rounded-lg p-6 mt-4">
        <form method="GET" action="{{ route('adminApplicationSearch') }}" class="mb-4 p-4 bg-white shadow-md rounded-lg" hidden>
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
        <div class="bg-gray-500 text-white p-4 rounded-md mb-4">
          {{ session('status') }}
        </div>
        @endif

        @if($applications->isEmpty())
        <p>No applications available.</p>
        @else
        <table class="min-w-full bg-white border border-gray-300 rounded-lg table-fixed border-collapse">
          <thead>
            <tr class="text-left border-b bg-gray-100">
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Student ID</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Department</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Full Name</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Status</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Reason</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Applied On</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Action</th>
            </tr>
          </thead>
          <tbody>

            @foreach($applications as $application)

            <tr class="border-b">
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->student_id }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->department }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->fullname }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->status }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->reason }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->created_at->format('Y-m-d') }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">
                <button
                  data-application='@json($application)'
                  onclick="openModal(this)"
                  class="bg-blue-500 text-white p-2 rounded-md">
                  View Details
                </button>
                @if($application->status == 'pending')
                <!-- Approve -->
                <form action="{{ route('admin.approveGMA', $application->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="bg-green-500 text-white p-2 rounded-md">Approve</button>
                </form>

                <!-- Reject -->
                <form action="{{ route('admin.rejectGMA', $application->id) }}" method="POST" style="display:inline;">
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
  <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg max-w-lg w-full">
      <h3 class="text-xl font-semibold mb-4">Application Details</h3>
      <p><strong>Full Name:</strong> <span id="modalFullName"></span></p>
      <p><strong>Reference number:</strong> <span id="modalrefnum"></span></p>
      <p><strong>Number of copies:</strong> <span id="modalnumcop"></span></p>
      <p><strong>Status:</strong> <span id="modalStatus"></span></p>
      <p><strong>Reason:</strong> <span id="modalReason"></span></p>
      <p><strong>Course Completed:</strong> <span id="modalCourseCompleted"></span></p>
      <p><strong>Graduation Date:</strong> <span id="modalGraduationDate"></span></p>
      <p><strong>Undergraduate:</strong> <span id="modalUndergraduate"></span></p>
      <p><strong>Last Course Year Level:</strong> <span id="modalLastCourseYearLevel"></span></p>
      <p><strong>Last Semester SY:</strong> <span id="modalLastSemesterSY"></span></p>

      <div class="mt-4 flex justify-end">
        <button onclick="closeModal()" class="bg-gray-500 text-white p-2 rounded-md">Close</button>
      </div>
    </div>
  </div>

  <script>
    // Open the modal and populate it with data
    function openModal(button) {
      const application = JSON.parse(button.getAttribute('data-application'));
      document.getElementById('modal').classList.remove('hidden');
      document.getElementById('modalFullName').innerText = application.fullname;
      document.getElementById('modalrefnum').innerText = application.reference_number;
      document.getElementById('modalnumcop').innerText = application.number_of_copies;
      document.getElementById('modalStatus').innerText = application.status;
      document.getElementById('modalReason').innerText = application.reason;
      document.getElementById('modalCourseCompleted').innerText = application.course_completed ?? 'N/A';
      document.getElementById('modalGraduationDate').innerText = application.graduation_date ?? 'N/A';
      document.getElementById('modalUndergraduate').innerText = (application.is_undergraduate !== null && application.is_undergraduate !== 0) ? 'Yes' : 'N/A';
      document.getElementById('modalLastCourseYearLevel').innerText = application.last_course_year_level ?? 'N/A';
      document.getElementById('modalLastSemesterSY').innerText = application.last_semester_sy ?? 'N/A';
    }


    // Close the modal
    function closeModal() {
      document.getElementById('modal').classList.add('hidden');
    }
  </script>
</x-app-layout>