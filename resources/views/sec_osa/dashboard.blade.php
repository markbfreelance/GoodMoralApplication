<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center space-x-4">
      <img src="/images/backgrounds/spup-logo.png" alt="Admin Picture" class="w-16 h-16 rounded-md object-cover">
      <span class="font-oldEnglish text-spupGreen text-3xl tracking-widest">
        Moderator
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
    @include('sec_osa.sidebar')

    <!-- Main Content -->
    <main :class="sidebarOpen ? 'ml-64' : 'ml-0'" class="flex-1 p-4 transition-all duration-300">
      <!-- Date and Search -->
      <!-- <div class="flex flex-wrap justify-between items-center mb-6">
        <div class="flex items-center gap-2 font-medium text-base text-gray-500">
          <label>Select period:</label>
          <input type="date" class="border-gray-500 rounded-lg">
          <input type="date" class="border-gray-500 rounded-lg">
        </div>
        <div class="flex items-center gap-2 mt-2 sm:mt-0">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-gray-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
          </svg>
          <input type="text" placeholder="Search..." class="border-none bg-gray-100 px-2 py-1">
          <div class="h-8 border border-gray-500 mx-4"></div>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-gray-500 ms-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
          </svg>
          <button class="bg-gray-100 pe-4">Filter</button>
        </div>
      </div>
      <hr class="bg-gray-700"> -->

      <!-- College Applications Overview -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 2xl:grid-cols-4 gap-4 mb-4">
        <!-- SASTE -->
        <div style="background-color: #083259;" class="text-white p-4 rounded-xl shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="flex items-center space-x-4">
            <img src="/images/deptLogos/logoSASTE.png" alt="SASTE Logo" class="h-28 object-contain" />
            <div>
              <div class="text-7xl font-bold">{{ $saste }}</div>
              <div class="text-xl text-gray-300">Total Applicants</div>
            </div>
          </div>
        </div>

        <!-- SBAHM -->
        <div style="background-color: #096735;" class="text-white p-4 rounded-xl shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="flex items-center space-x-4">
            <img src="/images/deptLogos/logoSBAHM.png" alt="SBAHM Logo" class="h-28 object-contain" />
            <div>
              <div class="text-7xl font-bold">{{ $sbahm }}</div>
              <div class="text-xl text-gray-300">Total Applicants</div>
            </div>
          </div>
        </div>

        <!-- SITE -->
        <div style="background-color: #730073;" class="text-white p-4 rounded-xl shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="flex items-center space-x-4">
            <img src="/images/deptLogos/logoSITE.png" alt="SITE Logo" class="h-28 object-contain" />
            <div>
              <div class="text-7xl font-bold">{{ $site }}</div>
              <div class="text-xl text-gray-300">Total Applicants</div>
            </div>
          </div>
        </div>

        <!-- SNAHS -->
        <div style="background-color: #de0f3f;" class="text-white p-4 rounded-xl shadow hover:shadow-lg hover:scale-105 transition-transform duration-200">
          <div class="flex items-center space-x-4">
            <img src="/images/deptLogos/logoSNAHS.png" alt="SNAHS Logo" class="h-28 object-contain" />
            <div>
              <div class="text-7xl font-bold">{{ $snahs }}</div>
              <div class="text-xl text-gray-300">Total Applicants</div>
            </div>
          </div>
        </div>
      </div>


      <!-- Charts Section -->
      <div class="grid grid-cols-1 lg:grid-cols-3 2xl:grid-cols-4 gap-4 mb-4">
        <div class="space-y-4">
          <!-- Pie Chart Minor Offenses -->
          <div class="bg-white p-4 rounded-xl shadow">
            <span class="font-normal text-lg border-b-2 mb-4">Minor Offenses</span>
            <div class="flex justify-center">
              <svg viewBox="0 0 120 120" class="w-40 h-40" preserveAspectRatio="xMidYMid meet">
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

          <!-- Pie Chart Major Offenses -->
          <div class="bg-white p-4 rounded-xl shadow">
            <span class="font-normal text-lg border-b-2 mb-4">Major Offenses</span>
            <div class="flex justify-center">
              <svg viewBox="0 0 120 120" class="w-40 h-40" preserveAspectRatio="xMidYMid meet">
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
                  stroke-dasharray="{{ $majorDashArray }}"
                  stroke-dashoffset="25"
                  transform="rotate(-90 60 60)" />
              </svg>
            </div>
            <div class="text-sm text-center mt-2">
              <div class="text-red-500">Pending: {{ number_format($majorPendingPercent, 1) }}%</div>
              <div>Complied: {{ number_format($majorCompliedPercent, 1) }}%</div>
            </div>
          </div>
        </div>

        <!-- Overall Report Offenses -->
        <div class="lg:col-span-2 2xl:col-span-3 flex min-h-full">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">

            <!-- Box 1: Major Offenses -->
            <div class="w-full bg-white rounded-lg shadow-sm p-6 flex flex-col">
              <div class="flex justify-between pb-4 mb-4 border-b border-gray-200">
                <span class="text-gray-900">Overall Report on Major Offenses</span>
              </div>
              <div class="flex items-end justify-between w-full h-full gap-4">
                @php
                $maxMajor = max($majorCounts);
                $minHeight = 10;
                $colors = ['bg-[#730073]', 'bg-[#083259]', 'bg-[#096735]', 'bg-[#DE0F3F]'];
                @endphp

                @foreach ($departments as $index => $dept)
                @php
                $count = $majorCounts[$dept] ?? 0;
                $heightPx = $maxMajor > 0 ? max(($count / $maxMajor) * 350, $minHeight) : 0;
                $colorClass = $colors[$index % count($colors)];
                @endphp

                <div class="flex flex-col items-center flex-1 mx-8">
                  <div
                    class="{{ $colorClass }} w-full rounded-t-md transition-all duration-500"
                    style="height: {{ $heightPx }}px"
                    title="{{ $dept }}: {{ $count }} major offenses">
                  </div>
                  <span class="mt-2 font-medium text-gray-700 text-center">{{ $dept }}</span>
                  <span class="text-sm text-gray-900">{{ $count }}</span>
                </div>
                @endforeach
              </div>
            </div>

            <!-- Box 2: Minor Offenses -->
            <div class="w-full bg-white rounded-lg shadow-sm p-6 flex flex-col">
              <div class="flex justify-between pb-4 mb-4 border-b border-gray-200">
                <span class="text-gray-900">Overall Report on Minor Offenses</span>
              </div>

              <div class="flex items-end w-full h-full gap-4">
                @php
                $maxMinor = max($minorCounts);
                $minHeight = 10;
                $colors = ['bg-[#730073]', 'bg-[#083259]', 'bg-[#096735]', 'bg-[#DE0F3F]'];
                @endphp

                @foreach ($departments as $index => $dept)
                @php
                $count = $minorCounts[$dept] ?? 0;
                $heightPx = $maxMinor > 0 ? max(($count / $maxMinor) * 350, $minHeight) : 0;
                $colorClass = $colors[$index % count($colors)];
                @endphp

                <div class="flex flex-col items-center flex-1 mx-8">
                  <div
                    class="{{ $colorClass }} w-full rounded-t-md transition-all duration-500"
                    style="height: {{ $heightPx }}px"
                    title="{{ $dept }}: {{ $count }} minor offenses">
                  </div>
                  <span class="mt-2 font-medium text-gray-700 text-center">{{ $dept }}</span>
                  <span class="text-sm text-gray-900">{{ $count }}</span>
                </div>
                @endforeach
              </div>
            </div>

          </div>
        </div>
      </div>
    </main>
  </div>
</x-app-layout>