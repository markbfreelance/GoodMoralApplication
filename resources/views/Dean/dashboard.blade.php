<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center space-x-4">
      <img src="/images/backgrounds/spup-logo.png" alt="Admin Picture" class="w-16 h-16 rounded-md object-cover">
      <span class="font-oldEnglish text-spupGreen text-3xl tracking-widest">
        Dean
      </span>
    </div>
  </x-slot>
  <hr class="h-1 bg-spupGreen border-0">
  <hr class="h-1 bg-spupGold border-0">

  <div x-data="{ sidebarOpen: false }" class="flex">

    <!-- Sidebar Toggle Button -->
    <div class="sm:hidden w-full bg-gray-100 border-b border-gray-300 py-2 flex justify-between px-4">
      <button @click="sidebarOpen = !sidebarOpen"
        class="bg-gray-800 text-white p-2 rounded-md">
        ☰ Menu
      </button>
    </div>

    <!-- Sidebar -->
    @include('dean.sidebar')

    <!-- Main Content -->
    <main :class="sidebarOpen ? 'ml-64' : 'ml-0'" class="flex-1 p-4 transition-all duration-300">
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

      <!-- SITE Applications Overview -->
      @if ($department === 'SITE')
      <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 2xl:grid-cols-5 gap-4 mb-4">
        @foreach ($programs as $program)
        <div style="background-color: #730073;" class="text-white p-6 rounded-xl shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="flex items-center space-x-4">
            <div class="flex flex-col items-center justify-center h-24 w-24 rounded-full text-white text-2xl font-black" style="background-color: #a64ca6;">
              <span>{{ $program['abbr1'] }}</span>
              <span>{{ $program['abbr2'] }}</span>
            </div>
            <div class="flex flex-col justify-center h-full">
              <div class="text-7xl font-bold">{{ $program['count'] }}</div>
              <div class="text-xl text-gray-300">Total Applicants</div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif

      <!-- SNAHS Applications Overview -->
      @if ($department === 'SNAHS')
      <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 2xl:grid-cols-6 gap-4 mb-4">
        @foreach ($programs as $program)
        <div style="background-color: #de0f3f;" class="text-white p-6 rounded-xl shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="flex items-center space-x-4">
            <div class="flex flex-col items-center justify-center h-20 w-20 rounded-full text-white text-2xl font-black" style="background-color: #f34a6b;">
              <span>{{ $program['abbr1'] }}</span>
              <span>{{ $program['abbr2'] }}</span>
            </div>
            <div class="flex flex-col justify-center h-full">
              <div class="text-6xl font-bold">{{ $program['count'] }}</div>
              <div class="text-base text-gray-300 whitespace-nowrap">Total Applicants</div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif

      <!-- SBAHM Applications Overview -->
      @if ($department === 'SBAHM')
      <!-- First Row -->
      <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4 mb-4">
        @foreach ($programsRow1 as $program)
        <div style="background-color: #096735;" class="text-white p-6 rounded-xl shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="flex items-center space-x-4">
            <div class="flex flex-col items-center justify-center h-24 w-24 rounded-full text-white text-2xl font-black" style="background-color: #2e8c5d;">
              <span>{{ $program['abbr1'] }}</span>
              <span>{{ $program['abbr2'] }}</span>
            </div>
            <div class="flex flex-col justify-center h-full">
              <div class="text-7xl font-bold">{{ $program['count'] }}</div>
              <div class="text-xl text-gray-300">Total Applicants</div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Second Row -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 mb-4">
        @foreach ($programsRow2 as $program)
        <div style="background-color: #096735;" class="text-white p-6 rounded-xl shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="flex items-center space-x-4">
            <div class="flex flex-col items-center justify-center h-24 w-24 rounded-full text-white text-2xl font-black" style="background-color: #2e8c5d;">
              <span>{{ $program['abbr1'] }}</span>
              <span>{{ $program['abbr2'] }}</span>
            </div>
            <div class="flex flex-col justify-center h-full">
              <div class="text-7xl font-bold">{{ $program['count'] }}</div>
              <div class="text-xl text-gray-300">Total Applicants</div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif

      <!-- SASTE Applications Overview -->
      @if ($department === 'SASTE')
      <!-- First Row -->
      <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4 mb-4">
        @foreach ($programsRow1 as $program)
        <div style="background-color: #003865;" class="text-white p-6 rounded-xl shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="flex items-center space-x-4">
            <div class="flex flex-col items-center justify-center h-24 w-24 rounded-full text-white text-2xl font-black" style="background-color: #3d5c77;">
              <span>{{ $program['abbr1'] }}</span>
              <span>{{ $program['abbr2'] }}</span>
            </div>
            <div class="flex flex-col justify-center h-full">
              <div class="text-7xl font-bold">{{ $program['count'] }}</div>
              <div class="text-xl text-gray-300">Total Applicants</div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Second Row -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 mb-4">
        @foreach ($programsRow2 as $program)
        <div style="background-color: #003865;" class="text-white p-6 rounded-xl shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="flex items-center space-x-4">
            <div class="flex flex-col items-center justify-center h-24 w-24 rounded-full text-white text-2xl font-black" style="background-color: #3d5c77;">
              <span>{{ $program['abbr1'] }}</span>
              <span>{{ $program['abbr2'] }}</span>
            </div>
            <div class="flex flex-col justify-center h-full">
              <div class="text-7xl font-bold">{{ $program['count'] }}</div>
              <div class="text-xl text-gray-300">Total Applicants</div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif

      <!-- Charts Section -->
      @php
      $total = $minorpending + $minorcomplied;
      // Calculate the percentages for Pending and Complied
      $pendingPercent = $total > 0 ? ($minorpending / $total) * 100 : 0;
      $compliedPercent = 100 - $pendingPercent;
      // Prepare the dash array for the SVG donut chart
      $dashArray = $pendingPercent . ' ' . $compliedPercent;
      @endphp

      <div class="grid grid-cols-1 lg:grid-cols-3 2xl:grid-cols-4 gap-4 mb-4">
        <!-- Pie Chart Minor Offenses -->
        <div class="bg-white p-4 rounded-xl shadow">
          <span class="font-normal text-lg border-b-2 mb-4">Minor Offenses</span>
          <div class="flex justify-center">
            <svg viewBox="0 0 120 120" class="w-48 h-48" preserveAspectRatio="xMidYMid meet">
              <!-- Background circle -->
              <circle
                cx="60" cy="60" r="45"
                fill="none"
                stroke="#e5e7eb"
                stroke-width="20" />
              <!-- Data circle -->
              <circle
                cx="60" cy="60" r="45"
                fill="none"
                stroke="#f87171"
                stroke-width="25"
                stroke-dasharray="{{ $dashArray }}"
                stroke-dashoffset="25"
                transform="rotate(-90 60 60)" />
            </svg>
          </div>
          <div class="text-sm text-center mt-2">
            <div class="text-red-500">Pending: {{ number_format($pendingPercent, 1) }}%</div>
            <div>Complied: {{ number_format($compliedPercent, 1) }}%</div>
          </div>
        </div>
        <!-- Overall Report Offenses -->
        <div class="lg:col-span-2 2xl:col-span-3 flex min-h-full">
          <!-- Inside: two equal width boxes -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
            <!-- Box 1 -->
            <div class="bg-gray-100 p-4 rounded-xl outline-1 outline outline-gray-400 flex flex-col justify-between">
              <span class="text-lg mb-2">Overall Report on Major Offenses</span>
              <div class="text-center flex-grow">[Placeholder for content]</div>
            </div>
            <!-- Box 2 -->
            <div class="bg-gray-100 p-4 rounded-xl outline-1 outline outline-gray-400 flex flex-col justify-between">
              <span class="text-lg mb-2">Overall Report on Minor Offenses</span>
              <div class="text-center flex-grow">[Placeholder for content]</div>
            </div>
          </div>
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
      <div class="grid grid-cols-1 lg:grid-cols-3 2xl:grid-cols-4 gap-4 mb-6">
        <!-- Pie Chart Minor Offenses -->
        <div class="bg-white p-4 rounded-xl shadow">
          <span class="font-normal text-lg border-b-2 mb-4">Major Offenses</span>
          <div class="flex justify-center">
            <svg viewBox="0 0 120 120" class="w-48 h-48" preserveAspectRatio="xMidYMid meet">
              <!-- Background circle -->
              <circle
                cx="60" cy="60" r="45"
                fill="none"
                stroke="#e5e7eb"
                stroke-width="20" />
              <!-- Data circle -->
              <circle
                cx="60" cy="60" r="45"
                fill="none"
                stroke="#f87171"
                stroke-width="25"
                stroke-dasharray="{{ $dashArray }}"
                stroke-dashoffset="25"
                transform="rotate(-90 60 60)" />
            </svg>
          </div>
          <div class="text-sm text-center mt-2">
            <div class="text-red-500">Pending: {{ number_format($pendingPercent, 1) }}%</div>
            <div>Complied: {{ number_format($compliedPercent, 1) }}%</div>
          </div>
        </div>
        <!-- Overall Report Offenses -->
        <div class="lg:col-span-2 2xl:col-span-3 flex min-h-full">
          <!-- Inside: two equal width boxes -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
            <!-- Box 1 -->
            <div class="bg-gray-100 p-4 rounded-xl outline-1 outline outline-gray-400 flex flex-col justify-between">
              <span class="text-lg mb-2">Minor Violations</span>
              <div class="text-center flex-grow">[Placeholder for content]</div>
            </div>
            <!-- Box 2 -->
            <div class="bg-gray-100 p-4 rounded-xl outline-1 outline outline-gray-400 flex flex-col justify-between">
              <span class="text-lg mb-2">Officers Application</span>
              <div class="text-center flex-grow">[Placeholder for content]</div>
            </div>
          </div>
        </div>
      </div>



  </div>
  </main>
  </div>
</x-app-layout>