<!-- resources/views/admin/sidebar.blade.php -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
  class="w-64 bg-white text-dark min-h-screen fixed sm:relative left-0 transform transition-transform duration-300 sm:translate-x-0 z-10">
  <nav>
    <!-- Dashboard -->
    <a href="{{ route('admin.dashboard') }}"
      class="gap-2 px-4 py-2 hover:bg-gray-700 hover:text-gray-300 relative h-20 items-center flex
           {{ request()->routeIs('admin.dashboard') ? 'text-gray-700' : 'hover:bg-gray-700' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-10 w-10 inline-block">
        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
      </svg>
      <span class="text-white">Dashboard</span>
    </a>

    <!-- Good Moral Application -->
    <a href="{{ route('admin.Application') }}" class="gap-2 h-20 items-center flex px-4 py-2 text-gray-700 hover:bg-gray-700 hover:text-gray-300">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
      </svg>
      <span class="text-white whitespace-nowrap">Good Moral Applications</span>
    </a>

    <!-- Add Account -->
    <a href="{{ route('admin.AddAccount') }}" class="gap-2 h-20 items-center flex px-4 py-2 text-gray-700 hover:bg-gray-700 hover:text-gray-300">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
      </svg>
      <span class="text-white">ADD Account</span>
    </a>

    <!-- Add Violation -->
    <a href="{{ route('admin.AddViolation') }}" class="gap-2 h-20 items-center flex px-4 py-2 text-gray-700 hover:bg-gray-700 hover:text-gray-300">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
      </svg>
      <span class="text-white">ADD Violation</span>
    </a>

    <!-- PSG Application -->
    <a href="{{ route('admin.psgApplication') }}" class="gap-2 h-20 items-center flex px-4 py-2 text-gray-700 hover:bg-gray-700 hover:text-gray-300">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
      </svg>
      <span class="text-white">PSG Application</span>
    </a>
    <a href="{{ route('admin.GMAApporvedByRegistrar') }}" class="gap-2 h-20 items-center flex px-4 py-2 text-gray-700 hover:bg-gray-700 hover:text-gray-300">
      <!-- Icon for Good Moral Application Approve/Reject -->
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.25a1.75 1.75 0 1 1-1.75-1.75A1.75 1.75 0 0 1 12 4.25zM18 8.25a1.75 1.75 0 1 1-1.75-1.75A1.75 1.75 0 0 1 18 8.25zM6 8.25a1.75 1.75 0 1 1-1.75-1.75A1.75 1.75 0 0 1 6 8.25zM18 12.25a1.75 1.75 0 1 1-1.75-1.75A1.75 1.75 0 0 1 18 12.25zM6 12.25a1.75 1.75 0 1 1-1.75-1.75A1.75 1.75 0 0 1 6 12.25zM12 12.25a1.75 1.75 0 1 1-1.75-1.75A1.75 1.75 0 0 1 12 12.25zM18 16.25a1.75 1.75 0 1 1-1.75-1.75A1.75 1.75 0 0 1 18 16.25zM6 16.25a1.75 1.75 0 1 1-1.75-1.75A1.75 1.75 0 0 1 6 16.25zM12 16.25a1.75 1.75 0 1 1-1.75-1.75A1.75 1.75 0 0 1 12 16.25z" />
      </svg>
      <span class="text-white">Good Moral Application Approve/Reject</span>
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