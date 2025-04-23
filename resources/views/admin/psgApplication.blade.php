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
    @include('admin.sidebar')

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
          <nav class="flex space-x-8 items-center">
            <!-- Pending Button -->
            <a href="{{ route('admin.psgApplication', ['status' => 'pending']) }}" class="px-6 py-3 bg-blue-600 text-white font-semibold text-sm rounded-md shadow-sm transition-all duration-300 ease-in-out hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 focus:outline-none 
       {{ request()->get('status') == 'pending' ? 'bg-blue-700 border-b-4 border-blue-800' : '' }}">
              Pending
            </a>

            <!-- Approved Button -->
            <a href="{{ route('admin.psgApplication', ['status' => 'approved']) }}" class="px-6 py-3 bg-green-600 text-white font-semibold text-sm rounded-md shadow-sm transition-all duration-300 ease-in-out hover:bg-green-700 focus:ring-2 focus:ring-green-400 focus:outline-none 
       {{ request()->get('status') == 'approved' ? 'bg-green-700 border-b-4 border-green-800' : '' }}">
              Approved
            </a>

            <!-- Rejected Button -->
            <a href="{{ route('admin.psgApplication', ['status' => 'rejected']) }}" class="px-6 py-3 bg-red-600 text-white font-semibold text-sm rounded-md shadow-sm transition-all duration-300 ease-in-out hover:bg-red-700 focus:ring-2 focus:ring-red-400 focus:outline-none 
       {{ request()->get('status') == 'rejected' ? 'bg-red-700 border-b-4 border-red-800' : '' }}">
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
                @if($application->status == '5')
                <span>Pending</span>
                @elseif($application->status == '1')
                <span>Approved</span>
                @else
                <span>Rejected</span>
                @endif
              </td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $application->created_at->format('Y-m-d') }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">
                @if($application->status == '5')
                <!-- Approve Form -->
                <form action="{{ route('admin.approvepsg', $application->student_id) }}" method="POST"
                  style="display:inline;">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="bg-green-500 text-white p-2 rounded-md">Approve</button>
                </form>

                <!-- Reject Form -->
                <form action="{{ route('admin.rejectpsg', $application->student_id) }}" method="POST"
                  style="display:inline;">
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