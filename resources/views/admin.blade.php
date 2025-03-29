<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Admin Dashboard
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          {{ __("You're logged in!") }}
        </div>

        <!-- Logout Form -->
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="mt-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
            Logout
          </button>
        </form>

      </div>
    </div>
  </div>
</x-app-layout>