<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center space-x-4">
      <img src="/images/backgrounds/spup-logo.png" alt="Admin Picture" class="w-16 h-16 rounded-md object-cover">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Registrar
      </h2>
    </div>
  </x-slot>

  <div class="flex">
    <!-- Sidebar Toggle Button (Positioned Below Header) -->
    <div class="sm:hidden w-full bg-gray-100 border-b border-gray-300 py-2 flex justify-between px-4">
      <button id="sidebarToggle" class="bg-gray-800 text-white p-2 rounded-md">
        ☰ Menu
      </button>
    </div>

    <!-- Sidebar -->
    @include('registrar.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-4">
      <!-- Date and Search -->
      <div class="flex flex-wrap justify-between items-center mb-6">
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
        <div class="flex justify-between">
          <h3 class="text-lg font-semibold mb-4">Good Moral Certificate Applications</h3>

          @if(session('status'))
          <div class="bg-green-500 text-white p-4 rounded-md mb-4">
            {{ session('status') }}
          </div>
          @endif

          <!-- Filter for records per page -->
          <div class="mb-4 flex items-center">
            <form action="{{ url()->current() }}" method="GET" class="flex items-center">
              <label for="recordsPerPage" class="mr-2 text-sm font-medium text-gray-700">Show</label>
              <select
                name="perPage"
                id="recordsPerPage"
                class="border border-gray-300 rounded-md p-2 text-sm w-20"
                onchange="this.form.submit()">
                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
              </select>
              <span class="ml-2 text-sm text-gray-700">entries</span>
            </form>
          </div>
        </div>

        <table class="min-w-full bg-white border border-gray-300 rounded-lg table-fixed border-collapse">
          <thead>
            <tr class="text-left border-b bg-gray-100">
              <th class="w-1/5 border border-gray-300 px-6 py-3 text-sm font-semibold text-black">Student ID</th>
              <th class="w-1/5 border border-gray-300 px-6 py-3 text-sm font-semibold text-black">Name</th>
              <th class="w-1/5 border border-gray-300 px-6 py-3 text-sm font-semibold text-black">Department</th>
              <th class="w-1/5 border border-gray-300 px-6 py-3 text-sm font-semibold text-black">Status</th>
              <th class="w-1/5 border border-gray-300 px-6 py-3 text-sm font-semibold text-black">Action</th>
            </tr>
          </thead>
          <tbody>
            @if($applications->isEmpty())
            <tr>
              <td colspan="5" class="text-center py-4 text-gray-500">No applications available.</td>
            </tr>
            @else
            @foreach($applications as $application)
            <tr class="border-b">
              <td class="w-1/5 border border-gray-300 px-6 py-4 text-sm text-gray-600">{{ $application->student->student_id }}</td>
              <td class="w-1/5 border border-gray-300 px-6 py-4 text-sm text-gray-600">{{ $application->student->fullname }}</td>
              <td class="w-1/5 border border-gray-300 px-6 py-4 text-sm text-gray-600">{{ $application->student->department }}</td>
              <td class="w-1/5 border border-gray-300 px-6 py-4 text-sm text-gray-600">{{ ucfirst($application->status) }}</td>

              <!-- hidden fields -->
              <td class="px-6 py-4 text-sm text-gray-600" hidden>{{ $application->created_at->format('Y-m-d') }}</td>
              <td class="px-6 py-4 text-sm text-gray-600" hidden>{{ $application->reason }}</td>
              <td class="px-6 py-4 text-sm text-gray-600" hidden>{{ $application->course_completed }}</td>
              <td class="px-6 py-4 text-sm text-gray-600" hidden>{{ $application->graduation_date }}</td>
              <td class="px-6 py-4 text-sm text-gray-600" hidden>
                {{ $application->graduation_date ?? 'N/A' }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-600" hidden>
                {{ $application->is_undergraduate ? $application->is_undergraduate : 'N/A' }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-600" hidden>
                {{ $application->last_course_year_level ?? 'N/A' }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-600" hidden>
                {{ $application->last_semester_s ?? 'N/A' }}
              </td>
              <!-- /hidden -->

              <!-- Actions -->
              <td class="px-6 py-4 text-sm text-gray-600 align-middle border border-gray-300">
                <div class="flex flex-col sm:flex-row w-full gap-2">
                  <!-- Details Button -->
                  <div class="w-full sm:flex-1">
                    <button
                      data-application='@json($application)'
                      onclick="openModal(this)"
                      class="w-full bg-blue-500 text-white py-2 px-4 rounded-md text-sm text-center">
                      Details
                    </button>
                  </div>

                  @if($application->status == 'pending')
                  <!-- Approve Button -->
                  <div class="w-full sm:flex-1">
                    <form action="{{ route('registrar.approve', $application->id) }}" method="POST">
                      @csrf
                      @method('PATCH')
                      <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded-md text-sm">
                        Approve
                      </button>
                    </form>
                  </div>

                  <!-- Reject Button -->
                  <div class="w-full sm:flex-1">
                    <form action="{{ route('registrar.reject', $application->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="w-full bg-red-500 text-white py-2 px-4 rounded-md text-sm">
                        Reject
                      </button>
                    </form>
                  </div>
                  @else
                  <!-- No Action -->
                  <div class="w-full sm:flex-1">
                    <span class="block text-center text-gray-500 py-2 bg-gray-100 rounded-md">No action</span>
                  </div>
                  @endif
                </div>
              </td>

            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
        <!-- Force the pagination to be visible for debugging -->
        <div class="mt-4 align-middle">
          {{ $applications->links() }}
        </div>
      </div>

    </main>
  </div>

  <!-- Modal -->
  <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg max-w-lg w-full">
      <h3 class="text-xl font-semibold mb-4">Application Details</h3>
      <p><strong>Full Name:</strong> <span id="modalFullName"></span></p>
      <p><strong>Reference Number:</strong> <span id="modalrefnum"></span></p>
      <p><strong>Number of Copies:</strong> <span id="modalnumcop"></span></p>
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
      document.getElementById('modalFullName').innerText = application.student.fullname;
      document.getElementById('modalrefnum').innerText = application.reference_number;
      document.getElementById('modalnumcop').innerText = application.number_of_copies;
      document.getElementById('modalStatus').innerText = application.status;
      document.getElementById('modalReason').innerText = application.reason;
      document.getElementById('modalCourseCompleted').innerText = application.course_completed ?? 'N/A';
      document.getElementById('modalGraduationDate').innerText = application.graduation_date ?? 'N/A';
      document.getElementById('modalUndergraduate').innerText = (application.is_undergraduate !== null && application.is_undergraduate !== 0) ? 'Yes' : 'N/A';
      document.getElementById('modalLastCourseYearLevel').innerText = application.last_course_year_level ?? 'N/A';
      document.getElementById('modalLastSemesterSY').innerText = application.last_semester_s ?? 'N/A';
    }


    // Close the modal
    function closeModal() {
      document.getElementById('modal').classList.add('hidden');
    }
  </script>
</x-app-layout>