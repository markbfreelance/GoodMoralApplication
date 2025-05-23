<!-- resources/views/psgOfficer/sidebar.blade.php -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
  class="w-64 bg-white text-dark min-h-screen fixed sm:relative left-0 transform transition-transform duration-300 sm:translate-x-0 z-10">
  <nav>
    <!-- Dashboard -->
    <a href="{{ route('prog_coor.dashboard') }}"
      class="gap-2 px-4 py-2 hover:bg-gray-700 hover:text-gray-300 relative h-20 items-center flex
           {{ request()->routeIs('PsgOfficer.PsgAddViolation') ? 'text-gray-700' : 'hover:bg-gray-700' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="h-10 w-10">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M3 9.75L12 4l9 5.75M4.5 10.5V19a1.5 1.5 0 001.5 1.5h3.75a.75.75 0 00.75-.75v-3.75a.75.75 0 01.75-.75h2.25a.75.75 0 01.75.75v3.75a.75.75 0 00.75.75H18a1.5 1.5 0 001.5-1.5v-8.5" />
      </svg>
      <span class="text-white">Dashboard</span>
    </a>

    <!-- Minor Violations -->
    <a href="{{ route('prog_coor.minor') }}"
      class="gap-2 h-20 items-center flex px-4 py-2 text-gray-700 hover:bg-gray-700 hover:text-gray-300">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="size-10">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 9v3.75m0 3.75h.008M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <span class="text-white">Minor Violations</span>
    </a>

    <!-- Major Violations -->
    <a href="{{ route('prog_coor.major') }}"
      class="gap-2 h-20 items-center flex px-4 py-2 text-gray-700 hover:bg-gray-700 hover:text-gray-300">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="size-10">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 9v3.75m0 3.75h.008M10.29 3.86L1.82 18a1.5 1.5 0 001.29 2.25h17.78a1.5 1.5 0 001.29-2.25L13.71 3.86a1.5 1.5 0 00-2.42 0z" />
      </svg>
      <span class="text-white">Major Violations</span>
    </a>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <a href="{{ route('logout') }}"
        class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-700 hover:text-red-600"
        onclick="event.preventDefault(); this.closest('form').submit();">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
          stroke="currentColor" class="w-10 h-10">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M18 15l3-3m0 0l-3-3m3 3H9" />
        </svg>
        <span class="text-white hover:text-red-600">LOGOUT</span>
      </a>
    </form>
  </nav>
</aside>
