<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center space-x-4">
      <img src="/images/backgrounds/spup-logo.png" alt="Admin Picture" class="w-16 h-16 rounded-md object-cover">
      <span class="font-oldEnglish text-spupGreen text-3xl tracking-widest">
        PSG
      </span>
    </div>
  </x-slot>
  <hr class="h-1 bg-spupGreen border-0">
  <hr class="h-1 bg-spupGold border-0">

  <div x-data="{ sidebarOpen: false }" class="flex">

    <!-- Sidebar Toggle Button (Positioned Below Header) -->
    <div class="sm:hidden w-full bg-gray-100 border-b border-gray-300 py-2 flex justify-between px-4">
      <button @click="sidebarOpen = !sidebarOpen"
        class="bg-gray-800 text-white p-2 rounded-md">
        ☰ Menu
      </button>
    </div>

    <!-- Sidebar -->
    @include('PsgOfficer.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-4">
      <div class="bg-white shadow-sm sm:rounded-lg p-2">
        <h3 class="text-lg font-semibold">Statistics Section</h3>
        <p>Data and analytics go here.</p>
      </div>
    </main>
  </div>
</x-app-layout>