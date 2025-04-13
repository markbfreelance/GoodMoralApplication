<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Admin Dashboard
    </h2>
  </x-slot>

  <div x-data="{ sidebarOpen: false }" class="flex">

    <!-- Sidebar Toggle Button -->
    <div class="sm:hidden w-full bg-gray-100 border-b border-gray-300 py-2 flex justify-between px-4">
      <button @click="sidebarOpen = !sidebarOpen"
        class="bg-gray-800 text-white p-2 rounded-md">
        ☰ Menu
      </button>
    </div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
      class="w-64 bg-gray-800 text-white min-h-screen fixed sm:relative left-0 transform transition-transform duration-300 sm:translate-x-0 z-10">
      <div class="p-4 text-lg font-bold border-b border-gray-700">
        Admin Panel
      </div>
      <nav class="mt-4">
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700">Dashboard</a>
        <a href="{{ route('admin.Application') }}" class="block px-4 py-2 hover:bg-gray-700">Application</a>
        <a href="{{ route('admin.AddAccount') }}" class="block px-4 py-2 hover:bg-gray-700">Add Account</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main :class="sidebarOpen ? 'ml-64' : 'ml-0'" class="flex-1 p-4 transition-all duration-300">
      <!-- Date and Search -->
      <div class="flex flex-wrap justify-between items-center mb-6">
        <div class="flex items-center gap-2">
          <label class="text-sm font-medium">Select period:</label>
          <input type="date" class="border rounded px-2 py-1">
          <span class="mx-1">to</span>
          <input type="date" class="border rounded px-2 py-1">
        </div>
        <div class="flex gap-2 mt-2 sm:mt-0">
          <input type="text" placeholder="Search..." class="border rounded px-2 py-1">
          <button class="bg-gray-200 px-3 py-1 rounded">Filter</button>
        </div>
      </div>

      <!-- College Applications Overview -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-900 text-white p-4 rounded shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="text-2xl font-bold">{{ $saste }}</div>
          <div>Total Applicants - SASTE</div>
        </div>

        <div class="bg-green-900 text-white p-4 rounded shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="text-2xl font-bold">{{ $sbahm }}</div>
          <div>Total Applicants - SBAHM</div>
        </div>

        <div class="bg-purple-800 text-white p-4 rounded shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="text-2xl font-bold">{{ $site }}</div>
          <div>Total Applicants - SITE</div>
        </div>

        <div class="bg-red-600 text-white p-4 rounded shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="text-2xl font-bold">{{ $snahs }}</div>
          <div>Total Applicants - SNAHS</div>
        </div>

        <div class="bg-yellow-600 text-white p-4 rounded shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="text-2xl font-bold">{{ $beu }}</div>
          <div>Total Applicants - BEU</div>
        </div>
      </div>


      <!-- Charts Section -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow">
          <h3 class="font-semibold mb-2">Minor Offenses</h3>
          <div class="text-center">[Donut Chart Placeholder]</div>
          <div class="text-sm text-center mt-2">
            <div>Pending: 63.8%</div>
            <div>Complied: 36.2%</div>
          </div>
        </div>

        <div class="lg:col-span-2 bg-white p-4 rounded shadow">
          <h3 class="font-semibold mb-2">Overall Report on Major Offenses</h3>
          <div class="text-center">[Line Chart Placeholder]</div>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded shadow">
          <h3 class="font-semibold mb-2">Major Offenses</h3>
          <div class="text-center">[Donut Chart Placeholder]</div>
          <div class="text-sm text-center mt-2">
            <div>Pending: 31.4%</div>
            <div>Complied: 68.6%</div>
          </div>
        </div>

        <div class="bg-white p-4 rounded shadow">
          <h3 class="font-semibold mb-2">Minor Violations</h3>
          <div class="text-center">[Bar Chart Placeholder]</div>
        </div>

        <div class="bg-white p-4 rounded shadow">
          <h3 class="font-semibold mb-2">Officers Application</h3>
          <div class="text-center">[Bar Chart Placeholder]</div>
        </div>
      </div>
    </main>
  </div>
</x-app-layout>