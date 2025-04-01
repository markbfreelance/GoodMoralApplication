<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      PSG Officer Dashboard
    </h2>
  </x-slot>

  <div x-data="{ sidebarOpen: false }" class="flex">

    <!-- Sidebar Toggle Button (Positioned Below Header) -->
    <div class="sm:hidden w-full bg-gray-100 border-b border-gray-300 py-2 flex justify-between px-4">
      <button @click="sidebarOpen = !sidebarOpen"
        class="bg-gray-800 text-white p-2 rounded-md">
        ☰ Menu
      </button>
    </div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'"
      class="w-64 bg-gray-800 text-white min-h-screen fixed sm:relative left-0 transform transition-transform duration-300 sm:translate-x-0">

      <div class="p-4 text-lg font-bold border-b border-gray-700">
        PSG Officer Dashboard
      </div>

      <nav class="mt-4">
        <a class="block px-4 py-2 hover:bg-gray-700">Application</a>                        
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 sm:px-8 lg:px-12">
      <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold">Statistics Section</h3>
        <p>Data and analytics go here.</p>
      </div>
    </main>
  </div>
</x-app-layout>