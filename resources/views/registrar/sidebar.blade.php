<!-- resources/views/admin/sidebar.blade.php -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
  class="w-64 bg-spupGreen text-dark min-h-screen fixed sm:relative left-0 transform transition-transform duration-300 sm:translate-x-0 z-10">
  <nav>
    <!-- Dashboard -->
    <!-- Application -->
    <a href="{{ route('registrar.dashboard') }}"
      class="gap-2 h-20 items-center flex px-4 py-2 {{ request()->routeIs('registrar.dashboard') ? 'bg-spupGold text-spupGreen' : 'text-gray-700 hover:bg-gray-700 hover:text-gray-300' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
      </svg>
      <span class="text-goldSpup">Dashboard</span>
    </a>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <a href="{{ route('logout') }}"
        class="flex items-center gap-2 px-4 py-2 text-sm text-white hover:bg-spupGold hover:text-red-600"
        onclick="event.preventDefault(); this.closest('form').submit();">
        <x-icon-logout class="w-10 h-10" />
        <span class="text-white hover:text-red-600">LOGOUT</span>
      </a>
    </form>
  </nav>
</aside>