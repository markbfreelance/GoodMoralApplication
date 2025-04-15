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
        <a href="{{ route('admin.dashboard') }}"
          class="block px-4 py-2 hover:bg-gray-700 
   {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : 'text-gray-300' }}">
          Dashboard
        </a>
        <a href="{{ route('admin.Application') }}" class="block px-4 py-2 hover:bg-gray-700">Good Moral Application</a>
        <a href="{{ route('admin.AddAccount') }}" class="block px-4 py-2 hover:bg-gray-700">Add Account</a>
        <a href="{{ route('admin.AddViolation') }}" class="block px-4 py-2 hover:bg-gray-700">Add Violation</a>
        <a href="{{ route('admin.psgApplication') }}" class="block px-4 py-2 hover:bg-gray-700">PSG Application</a>
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


      </div>


      <!-- Charts Section -->
      @php
      $total = $minorpending + $minorcomplied;
      // Calculate the percentages for Pending and Complied
      $pendingPercent = $total > 0 ? ($minorpending / $total) * 100 : 0;
      $compliedPercent = 100 - $pendingPercent;
      // Prepare the dash array for the SVG donut chart
      $dashArray = $pendingPercent . ' ' . $compliedPercent;
      @endphp

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow">
          <h3 class="font-semibold mb-2 text-center">Minor Offenses</h3>

          <!-- Donut Chart SVG -->
          <div class="flex justify-center">
            <svg viewBox="0 0 36 36" class="w-24 h-24">
              <!-- Background circle -->
              <circle
                cx="18" cy="18" r="16"
                fill="none"
                stroke="#e5e7eb"
                stroke-width="4" />
              <!-- Data circle -->
              <circle
                cx="18" cy="18" r="16"
                fill="none"
                stroke="#f87171"
                stroke-width="4"
                stroke-dasharray="{{ $dashArray }}"
                stroke-dashoffset="25"
                transform="rotate(-90 18 18)" />
            </svg>
          </div>

          <div class="text-sm text-center mt-2">
            <div class="text-red-500">Pending: {{ number_format($pendingPercent, 1) }}%</div>
            <div>Complied: {{ number_format($compliedPercent, 1) }}%</div>
          </div>
        </div>



        <div class="lg:col-span-2 bg-white p-4 rounded shadow">
          <h3 class="font-semibold mb-2">Overall Report on Major Offenses</h3>
          <div class="text-center">[Line Chart Placeholder]</div>
        </div>
      </div>

      @php
      $total = $majorpending + $majorcomplied;
      // Calculate the percentages for Pending and Complied
      $pendingPercent = $total > 0 ? ($majorpending / $total) * 100 : 0;
      $compliedPercent = 100 - $pendingPercent;
      // Prepare the dash array for the SVG donut chart
      $dashArray = $pendingPercent . ' ' . $compliedPercent;
      @endphp

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow">
          <h3 class="font-semibold mb-2 text-center">Minor Offenses</h3>

          <!-- Donut Chart SVG -->
          <div class="flex justify-center">
            <svg viewBox="0 0 36 36" class="w-24 h-24">
              <!-- Background circle -->
              <circle
                cx="18" cy="18" r="16"
                fill="none"
                stroke="#e5e7eb"
                stroke-width="4" />
              <!-- Data circle -->
              <circle
                cx="18" cy="18" r="16"
                fill="none"
                stroke="#f87171"
                stroke-width="4"
                stroke-dasharray="{{ $dashArray }}"
                stroke-dashoffset="25"
                transform="rotate(-90 18 18)" />
            </svg>
          </div>

          <div class="text-sm text-center mt-2">
            <!-- Show the calculated percentages, not the raw values -->
            <div class="text-red-500">Pending: {{ number_format($pendingPercent, 1) }}%</div>
            <div>Complied: {{ number_format($compliedPercent, 1) }}%</div>
          </div>
        </div>

        <div class="lg:col-span-2 bg-white p-4 rounded shadow">
          <h3 class="font-semibold text-xl text-center mb-4">Minor Violations</h3>

          <!-- Chart Grid Background -->
          <div class="relative h-64 border-l border-b border-gray-300">
            <!-- Horizontal Grid Lines -->
            @for ($i = 1; $i <= 5; $i++)
              <div class="absolute inset-x-0 border-t border-dashed border-gray-200" style="bottom: {{ $i * 20 }}%;">
          </div>
          @endfor

          <!-- Vertical Bar Groups (by year) -->
          <div class="flex justify-around items-end h-full px-4">
            <!-- 2021 -->
            <div class="flex flex-col items-center space-y-1">
              <div class="flex items-end space-x-1 h-48">
                <div class="bg-red-500 w-6" style="height: 60%"></div>
                <div class="bg-yellow-500 w-6" style="height: 40%"></div>
                <div class="bg-green-500 w-6" style="height: 80%"></div>
                <div class="bg-blue-500 w-6" style="height: 30%"></div>
                <div class="bg-purple-500 w-6" style="height: 50%"></div>
              </div>
              <span class="text-xs mt-1">2021</span>
            </div>

            <!-- 2022 -->
            <div class="flex flex-col items-center space-y-1">
              <div class="flex items-end space-x-1 h-48">
                <div class="bg-red-500 w-6" style="height: 30%"></div>
                <div class="bg-yellow-500 w-6" style="height: 70%"></div>
                <div class="bg-green-500 w-6" style="height: 50%"></div>
                <div class="bg-blue-500 w-6" style="height: 90%"></div>
                <div class="bg-purple-500 w-6" style="height: 60%"></div>
              </div>
              <span class="text-xs mt-1">2022</span>
            </div>

            <!-- 2023 -->
            <div class="flex flex-col items-center space-y-1">
              <div class="flex items-end space-x-1 h-48">
                <div class="bg-red-500 w-6" style="height: 40%"></div>
                <div class="bg-yellow-500 w-6" style="height: 60%"></div>
                <div class="bg-green-500 w-6" style="height: 30%"></div>
                <div class="bg-blue-500 w-6" style="height: 80%"></div>
                <div class="bg-purple-500 w-6" style="height: 70%"></div>
              </div>
              <span class="text-xs mt-1">2023</span>
            </div>

            <!-- 2024 -->
            <div class="flex flex-col items-center space-y-1">
              <div class="flex items-end space-x-1 h-48">
                <div class="bg-red-500 w-6" style="height: 50%"></div>
                <div class="bg-yellow-500 w-6" style="height: 20%"></div>
                <div class="bg-green-500 w-6" style="height: 90%"></div>
                <div class="bg-blue-500 w-6" style="height: 60%"></div>
                <div class="bg-purple-500 w-6" style="height: 40%"></div>
              </div>
              <span class="text-xs mt-1">2024</span>
            </div>
          </div>
        </div>

        <!-- Legend -->
        <div class="flex justify-center gap-4 mt-4 text-sm text-gray-700">
          <div><span class="inline-block w-3 h-3 bg-red-500 mr-1"></span>Engineering</div>
          <div><span class="inline-block w-3 h-3 bg-yellow-500 mr-1"></span>Business</div>
          <div><span class="inline-block w-3 h-3 bg-green-500 mr-1"></span>Education</div>
          <div><span class="inline-block w-3 h-3 bg-blue-500 mr-1"></span>IT</div>
          <div><span class="inline-block w-3 h-3 bg-purple-500 mr-1"></span>Nursing</div>
        </div>
      </div>



      <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold mb-2">Officers Application</h3>
        <div class="text-center">[Bar Chart Placeholder]</div>
      </div>
  </div>
  </main>
  </div>
</x-app-layout>