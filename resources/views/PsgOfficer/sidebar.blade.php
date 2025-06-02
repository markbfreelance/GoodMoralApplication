<!-- resources/views/psgOfficer/sidebar.blade.php -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
  class="w-64 bg-spupGreen text-dark min-h-screen fixed sm:relative left-0 transform transition-transform duration-300 sm:translate-x-0 z-10">
  <nav>
    <!-- Dashboard -->
    <a href="{{ route('PsgOfficer.dashboard') }}"
      class="gap-2 px-4 py-2 hover:bg-gray-800 hover:text-spupGold relative h-20 items-center flex {{ request()->routeIs('PsgOfficer.dashboard') ? 'bg-gray-800 text-spupGold' : 'text-white hover:bg-gray-800 hover:text-spupGold' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-10 w-10 inline-block">
        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
      </svg>
      Dashboard
    </a>

    <!-- Add Violator -->
    <a href="{{ route('PsgOfficer.PsgAddViolation') }}"
      class="gap-2 px-4 py-2 hover:bg-gray-700 hover:text-gray-300 relative h-20 items-center flex
           {{ request()->routeIs('PsgOfficer.PsgAddViolation') ? 'bg-gray-800 text-spupGold' : 'text-white hover:bg-gray-800 hover:text-spupGold' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-10 w-10 inline-block">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
      Add Violator
    </a>

    <!-- Violator -->
    <a href="{{ route('PsgOfficer.Violator') }}"
      class="gap-2 px-4 py-2 hover:bg-gray-700 hover:text-gray-300 relative h-20 items-center flex
           {{ request()->routeIs('PsgOfficer.Violator') ? 'bg-gray-800 text-spupGold' : 'text-white hover:bg-gray-800 hover:text-spupGold' }}">
      <!-- New SVG Icon -->
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2.25C6.72 2.25 2.25 6.72 2.25 12s4.47 9.75 9.75 9.75 9.75-4.47 9.75-9.75S17.28 2.25 12 2.25zM12 17.25a5.25 5.25 0 1 1 0-10.5 5.25 5.25 0 0 1 0 10.5z" />
      </svg>
      Violator
    </a>


    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <a href="{{ route('logout') }}"
        class="flex h-20 items-center gap-2 px-4 py-2 text-sm text-white hover:bg-gray-800 hover:text-red-600"
        onclick="event.preventDefault(); this.closest('form').submit();">
        <x-icon-logout class="w-10 h-10" />
        LOGOUT
      </a>
    </form>
  </nav>
</aside>