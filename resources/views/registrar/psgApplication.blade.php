<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Registrar Dashboard
    </h2>
  </x-slot>

  <div x-data="{ sidebarOpen: false }" class="flex">
    <!-- Sidebar Toggle Button (Positioned Below Header) -->
    <div class="sm:hidden w-full bg-gray-100 border-b border-gray-300 py-2 flex justify-between px-4">
      <button @click="sidebarOpen = !sidebarOpen" class="bg-gray-800 text-white p-2 rounded-md">
        ☰ Menu
      </button>
    </div>

    <!-- Sidebar -->
    @include('registrar.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-6 sm:px-8 lg:px-12">
      <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4">PSG Account Applications</h3>

        @if(session('status'))
        <div class="bg-gray-500 text-white p-4 rounded-md mb-4">
          {{ session('status') }}
        </div>
        @endif

        <!-- Navigation Bar to Filter by Status -->

        <div class="mb-8">
          <nav class="flex items-center space-x-4 border border-white/20 rounded-md p-2 bg-white/5 shadow-sm">
            <!-- Pending -->
            <a href="{{ route('registrar.psgApplication', ['status' => 'pending']) }}"
              class="flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-md transition-all duration-300 border border-white/20
       {{ request()->get('status') == 'pending' ? 'bg-blue-600 text-white border-blue-700' : 'text-blue-300 hover:bg-blue-700/20' }}">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
              </svg>
              Pending
            </a>

            <!-- Admin Approval -->
            <a href="{{ route('registrar.psgApplication', ['status' => 'pendingAtAdmin']) }}"
              class="flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-md transition-all duration-300 border border-white/20
  {{ request()->get('status') == 'pendingAtAdmin' ? 'bg-yellow-500 text-white border-yellow-600' : 'text-yellow-300 hover:bg-yellow-700/20' }}">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 2" />
              </svg>
              Admin Approval
            </a>

            <!-- Approved -->
            <a href="{{ route('registrar.psgApplication', ['status' => 'approved']) }}"
              class="flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-md transition-all duration-300 border border-white/20
       {{ request()->get('status') == 'approved' ? 'bg-green-600 text-white border-green-700' : 'text-green-300 hover:bg-green-700/20' }}">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
              </svg>
              Approved
            </a>

            <!-- Rejected -->
            <a href="{{ route('registrar.psgApplication', ['status' => 'rejected']) }}"
              class="flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-md transition-all duration-300 border border-white/20
       {{ request()->get('status') == 'rejected' ? 'bg-red-600 text-white border-red-700' : 'text-red-300 hover:bg-red-700/20' }}">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
              Rejected
            </a>
          </nav>
        </div>




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
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Applied On</th>
              <th class="px-6 py-3 text-sm font-medium text-gray-500">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($applications as $application)
            <tr class="border-b">
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->student_id }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->department }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->fullname }}</td>
              <td>
                @if($application->status == '4')
                <span>Pending</span>
                @elseif($application->status == '5')
                <span> Pending For Admin Approval</span>
                @elseif($application->status == '1')
                <span>Approved</span>
                @else
                <span>Rejected</span>
                @endif
              </td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->created_at->format('Y-m-d') }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-600">
                @if($application->status == '4')
                <!-- Approve Form -->
                <form action="{{ route('registrar.approvepsg', $application->student_id) }}"
                  method="POST" style="display:inline;">
                  @csrf
                  @method('PATCH')
                  <button type="submit"
                    class="bg-green-500 text-white p-2 rounded-md">Approve</button>
                </form>

                <!-- Reject Form -->
                <form action="{{ route('registrar.rejectpsg', $application->student_id) }}"
                  method="POST" style="display:inline;">
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