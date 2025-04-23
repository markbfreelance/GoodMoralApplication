<!-- resources/views/psgOfficer/sidebar.blade.php -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
  class="w-64 bg-white text-dark min-h-screen fixed sm:relative left-0 transform transition-transform duration-300 sm:translate-x-0 z-10">
  <nav>
    <!-- Add Violator -->
    <a href="{{ route('PsgOfficer.PsgAddViolation') }}"
      class="gap-2 px-4 py-2 hover:bg-gray-700 hover:text-gray-300 relative h-20 items-center flex
           {{ request()->routeIs('PsgOfficer.PsgAddViolation') ? 'text-gray-700' : 'hover:bg-gray-700' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-10 w-10 inline-block">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
      <span class="text-white">Add Violator</span>
    </a>

    <!-- Violator -->
    <a href="{{ route('PsgOfficer.Violator') }}"
      class="gap-2 h-20 items-center flex px-4 py-2 text-gray-700 hover:bg-gray-700 hover:text-gray-300">
      <!-- New SVG Icon -->
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2.25C6.72 2.25 2.25 6.72 2.25 12s4.47 9.75 9.75 9.75 9.75-4.47 9.75-9.75S17.28 2.25 12 2.25zM12 17.25a5.25 5.25 0 1 1 0-10.5 5.25 5.25 0 0 1 0 10.5z" />
      </svg>
      <span class="text-white">Violator</span>
    </a>


    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <a href="{{ route('logout') }}"
        class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-700 hover:text-red-600"
        onclick="event.preventDefault(); this.closest('form').submit();">
        <x-icon-logout class="w-10 h-10" />
        <span class="text-white hover:text-red-600">LOGOUT</span>
      </a>
    </form>
  </nav>
</aside>