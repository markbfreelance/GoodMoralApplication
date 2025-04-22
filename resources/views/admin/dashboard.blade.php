<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center space-x-4">
      <img src="https://placehold.co/40x40" alt="Admin Picture" class="w-16 h-16 rounded-md object-cover">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Hello Admin
      </h2>
    </div>
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
      class="w-64 bg-white text-dark min-h-screen fixed sm:relative left-0 transform transition-transform duration-300 sm:translate-x-0 z-10">
      <nav>

        <!-- dashboard -->
        <a href="{{ route('admin.dashboard') }}"
          class="gap-2 px-4 py-2 hover:bg-gray-700 hover:text-gray-300 relative h-20 items-center flex
          {{ request()->routeIs('admin.dashboard') ? 'text-gray-700' : 'hover:bg-gray-700' }}">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-10 w-10 inline-block">
            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
          </svg>
          <span class="text-white">Dashboard</span>
        </a>

        <!-- good moral application -->
        <a href="{{ route('admin.Application') }}" class="gap-2 h-20 items-center flex px-4 py-2 text-gray-700 hover:bg-gray-700 hover:text-gray-300">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
          </svg>
          <span class="text-white whitespace-nowrap">Good Moral Applications</span>
        </a>

        <!-- add account -->
        <a href="{{ route('admin.AddAccount') }}" class="gap-2 h-20 items-center flex px-4 py-2 text-gray-700 hover:bg-gray-700 hover:text-gray-300">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
          </svg>
          <span class="text-white">ADD Account</span>
        </a>

        <!-- add violation -->
        <a href="{{ route('admin.AddViolation') }}" class="gap-2 h-20 items-center flex px-4 py-2 text-gray-700 hover:bg-gray-700 hover:text-gray-300">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
          </svg>
          <span class="text-white">ADD Violation</span>
        </a>

        <!-- PSG application -->
        <a href="{{ route('admin.psgApplication') }}" class="gap-2 h-20 items-center flex px-4 py-2 text-gray-700 hover:bg-gray-700 hover:text-gray-300">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
          </svg>
          <span class="text-white">PSG Application</span>
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a href="{{ route('logout') }}"
            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-700 hover:text-red-600"
            onclick="event.preventDefault(); this.closest('form').submit();">
            <x-icon-logout class="w-10 h-10" />
            {{ __('') }}
            <span class="text-white hover:text-red-600">LOGOUT</span>
          </a>
        </form>

      </nav>
    </aside>

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

      <!-- College Applications Overview -->
      <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div style="background-color: #083259;" class="text-white p-4 rounded shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="flex items-center space-x-4">
            <img src="/images/deptLogos/logoSASTE.png" alt="SASTE Logo" class="h-36 object-contain" />
            <div>
              <div class="text-8xl font-bold">{{ $saste }}</div>
              <div class="text-xl text-gray-300">Total Applicants</div>
            </div>
          </div>
        </div>

        <div style="background-color: #096735;" class="text-white p-4 rounded shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="flex items-center space-x-4">
            <img src="/images/deptLogos/logoSBAHM.png" alt="SBAHM Logo" class="h-36 object-contain" />
            <div>
              <div class="text-8xl font-bold">{{ $sbahm }}</div>
              <div class="text-xl text-gray-300">Total Applicants</div>
            </div>
          </div>
        </div>

        <!-- SITE -->
        <div style="background-color: #730073;" class="text-white p-4 rounded shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="flex items-center space-x-4">
            <img src="/images/deptLogos/logoSITE.png" alt="SITE Logo" class="h-36 object-contain" />
            <div>
              <div class="text-8xl font-bold">{{ $site }}</div>
              <div class="text-xl text-gray-300">Total Applicants</div>
            </div>
          </div>
        </div>

        <!-- SNAHS -->
        <div style="background-color: #de0f3f;" class="text-white p-4 rounded shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="flex items-center space-x-4">
            <img src="/images/deptLogos/logoSNAHS.png" alt="SNAHS Logo" class="h-36 object-contain" />
            <div>
              <div class="text-8xl font-bold">{{ $snahs }}</div>
              <div class="text-xl text-gray-300">Total Applicants</div>
            </div>
          </div>
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