<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Moderator Dashboard
    </h2>
  </x-slot>

  <div class="flex">
    <!-- Sidebar Toggle Button (Positioned Below Header) -->
    <div class="sm:hidden w-full bg-gray-100 border-b border-gray-300 py-2 flex justify-between px-4">
      <button id="sidebarToggle" class="bg-gray-800 text-white p-2 rounded-md">
        ☰ Menu
      </button>
    </div>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-gray-800 text-white min-h-screen fixed sm:relative left-0 transform transition-transform duration-300 sm:translate-x-0">
      <div class="p-4 text-lg font-bold border-b border-gray-700">
        Moderator Dashboard
      </div>
      <nav class="mt-4">
        <a href="{{ route('sec_osa.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('sec_osa.dashboard') ? 'bg-gray-700 text-white' : 'text-gray-300' }}">
          Application
        </a>
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

              <!-- hidden -->
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
              <!-- hidden -->

              <!-- Actions -->
              <td class="px-6 py-4 text-sm text-gray-600">
                <!-- View Details Button -->
                <button
                  data-application='@json($application)'
                  onclick="openModal(this)"
                  class="bg-blue-500 text-white p-2 rounded-md">
                  View Details
                </button>
                @if($application->status == 'pending')
                <!-- Approve -->
                <form action="{{ route('dean.approve', $application->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="bg-green-500 text-white p-2 rounded-md">Approve</button>
                </form>

                <!-- Reject -->
                <form action="{{ route('dean.reject', $application->id) }}" method="POST" style="display:inline;">
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

  <!-- Modal -->
  <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg max-w-lg w-full">
      <h3 class="text-xl font-semibold mb-4">Application Details</h3>
      <p><strong>Full Name:</strong> <span id="modalFullName"></span></p>
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