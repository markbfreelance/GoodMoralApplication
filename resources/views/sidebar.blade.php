<!-- resources/views/admin/sidebar.blade.php -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
  class="w-64 bg-white text-dark min-h-screen fixed sm:relative left-0 transform transition-transform duration-300 sm:translate-x-0 z-10">
  <nav>
    <a href="{{ route('dashboard') }}"
      class="gap-2 h-20 items-center flex px-4 py-2 {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-white' : 'text-gray-700 hover:bg-gray-700 hover:text-gray-300' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke-width="1.5" stroke="currentColor" class="size-10">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M6.75 3a.75.75 0 00-.75.75v16.5a.75.75 0 001.216.588l5.284-4.088a.75.75 0 01.9 0l5.284 4.088a.75.75 0 001.216-.588V3.75a.75.75 0 00-.75-.75h-12z" />
      </svg>
      <span class="text-white">Application</span>
    </a>

    <a href="{{ route('notification') }}"
      class="gap-2 h-20 items-center flex px-4 py-2 {{ request()->routeIs('notification') ? 'bg-gray-700 text-white' : 'text-gray-700 hover:bg-gray-700 hover:text-gray-300' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke-width="1.5" stroke="currentColor" class="size-10">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 2C9.79 2 8 3.79 8 6v5.26a6.94 6.94 0 00-1.7.96L5 13v3h14v-3l-1.3-1.78a6.94 6.94 0 00-1.7-.96V6c0-2.21-1.79-4-4-4z" />
      </svg>
      <span class="text-white">Application Notifications</span>
    </a>

    <a href="{{ route('notificationViolation') }}"
      class="gap-2 h-20 items-center flex px-4 py-2 text-gray-700 hover:bg-gray-700 hover:text-gray-300">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="size-10">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 2c.414 0 .75.336.75.75v1.5a.75.75 0 01-1.5 0v-1.5C11.25 2.336 11.586 2 12 2zM4.222 5.636a.75.75 0 011.06 0l1.06 1.06a.75.75 0 11-1.06 1.06l-1.06-1.06a.75.75 0 010-1.06zM19.778 5.636a.75.75 0 010 1.06l-1.06 1.06a.75.75 0 11-1.06-1.06l1.06-1.06a.75.75 0 011.06 0zM12 6.75a5.25 5.25 0 015.25 5.25v3.75H6.75v-3.75A5.25 5.25 0 0112 6.75zM6.75 18a.75.75 0 000 1.5h10.5a.75.75 0 000-1.5H6.75z" />
      </svg>
      <span class="text-white">Notification Violations</span>
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