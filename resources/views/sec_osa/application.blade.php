<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center space-x-4">
      <img src="https://placehold.co/40x40" alt="Admin Picture" class="w-16 h-16 rounded-md object-cover">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Hello Moderator
      </h2>
    </div>
  </x-slot>

  <div class="flex">
    <!-- Sidebar Toggle Button -->
    <div class="sm:hidden w-full bg-gray-100 border-b border-gray-300 py-2 flex justify-between px-4">
      <button id="sidebarToggle" class="bg-gray-800 text-white p-2 rounded-md">
        ☰ Menu
      </button>
    </div>

    <!-- Sidebar -->
    @include('sec_osa.sidebar')

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
          <svg xmlns="http://www.w3.org/2000/svg" class="size-7 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
          </svg>
          <input type="text" placeholder="Search..." class="border-none bg-gray-100 px-2 py-1">
          <div class="h-8 border border-gray-500 mx-4"></div>
          <svg xmlns="http://www.w3.org/2000/svg" class="size-7 text-gray-500 ms-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
          </svg>
          <button class="bg-gray-100 pe-4">Filter</button>
        </div>
      </div>

      <!-- Flash Messages -->
      @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-4">
          {{ session('success') }}
        </div>
      @endif

      @if(session('pdf_url'))
        <script>
          window.addEventListener('load', function () {
            window.open("{{ session('pdf_url') }}", '_blank');
          });
        </script>
      @endif

      <!-- Applications Table -->
      <div class="bg-white shadow-sm sm:rounded-lg p-6 mt-4">
        <h3 class="text-lg font-semibold mb-4">Good Moral Certificate Applications</h3>

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
                <th class="px-6 py-3 text-sm font-medium text-gray-500">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($applications as $application)
              <tr class="border-b">
                <td class="px-6 py-4 text-sm text-gray-600">{{ $application->student->student_id }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $application->student->department }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $application->student->fullname }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ ucfirst($application->status) }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">
                  <button data-application='@json($application)' onclick="openModal(this)"
                    class="bg-blue-500 text-white p-2 rounded-md">View Details</button>

                  @if(!empty($application->receipt?->document_path))
                    <form action="{{ route('sec_osa.approve', $application->id) }}" method="POST" class="inline">
                      @csrf
                      @method('PATCH')
                      <button type="submit" class="bg-green-500 text-white p-2 rounded-md ml-2">Print</button>
                    </form>

                    <a href="{{ asset('storage/' . $application->receipt->document_path) }}" target="_blank" 
                       class="bg-indigo-600 text-white p-2 rounded-md ml-2 inline-block">
                      View Receipt
                    </a>
                  @else
                    <span class="ml-4 text-gray-500 italic">No document uploaded</span>
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

  <!-- Modal -->
  <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
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

  <!-- Modal Script -->
  <script>
    function openModal(button) {
      const app = JSON.parse(button.getAttribute('data-application'));
      document.getElementById('modal').classList.remove('hidden');
      document.getElementById('modalFullName').innerText = app.student.fullname;
      document.getElementById('modalrefnum').innerText = app.reference_number ?? 'N/A';
      document.getElementById('modalnumcop').innerText = app.number_of_copies ?? 'N/A';
      document.getElementById('modalStatus').innerText = app.status;
      document.getElementById('modalReason').innerText = app.reason ?? 'N/A';
      document.getElementById('modalCourseCompleted').innerText = app.course_completed ?? 'N/A';
      document.getElementById('modalGraduationDate').innerText = app.graduation_date ?? 'N/A';
      document.getElementById('modalUndergraduate').innerText = (app.is_undergraduate) ? 'Yes' : 'N/A';
      document.getElementById('modalLastCourseYearLevel').innerText = app.last_course_year_level ?? 'N/A';
      document.getElementById('modalLastSemesterSY').innerText = app.last_semester_sy ?? 'N/A';
    }

    function closeModal() {
      document.getElementById('modal').classList.add('hidden');
    }
  </script>
</x-app-layout>
