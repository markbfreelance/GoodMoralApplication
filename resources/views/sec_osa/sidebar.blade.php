<!-- resources/views/admin/sidebar.blade.php -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
  class="w-64 bg-white text-dark min-h-screen fixed sm:relative left-0 transform transition-transform duration-300 sm:translate-x-0 z-10">
  <nav>
    <!-- Dashboard -->
    <a href="{{ route('sec_osa.dashboard') }}"
      class="gap-2 h-20 items-center flex px-4 py-2 {{ request()->routeIs('sec_osa.dashboard') ? 'bg-gray-700 text-white' : 'text-gray-700 hover:bg-gray-700 hover:text-gray-300' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-10 w-10 inline-block">
        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
      </svg>
      <span class="text-white">Dashboard</span>
    </a>

    <!-- Applications -->
    <a href="{{ route('sec_osa.application') }}"
      class="gap-2 h-20 items-center flex px-4 py-2 {{ request()->routeIs('sec_osa.application') ? 'bg-gray-700 text-white' : 'text-gray-700 hover:bg-gray-700 hover:text-gray-300' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
      </svg>
      <span class="text-white whitespace-nowrap">Applications</span>
    </a>

    <!-- Minor Violations -->
    <a href="{{ route('sec_osa.minor') }}"
      class="gap-2 h-20 items-center flex px-4 py-2 {{ request()->routeIs('sec_osa.minor') ? 'bg-gray-700 text-white' : 'text-gray-700 hover:bg-gray-700 hover:text-gray-300' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="size-10">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 9v3.75m0 3.75h.008M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <span class="text-white">Minor Violations</span>
    </a>

    <!-- Major Violations -->
    <a href="{{ route('sec_osa.major') }}"
      class="gap-2 h-20 items-center flex px-4 py-2 {{ request()->routeIs('sec_osa.major') ? 'bg-gray-700 text-white' : 'text-gray-700 hover:bg-gray-700 hover:text-gray-300' }}">
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
        <x-icon-logout class="w-10 h-10" />
        <span class="text-white hover:text-red-600">LOGOUT</span>
      </a>
    </form>
  </nav>
</aside>