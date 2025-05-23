<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center space-x-4">
      <img src="/images/backgrounds/spup-logo.png" alt="Admin Picture" class="w-16 h-16 rounded-md object-cover">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Program Coordinator
      </h2>
    </div>
  </x-slot>

  <div class="flex">
    <div class="sm:hidden w-full bg-gray-100 border-b border-gray-300 py-2 flex justify-between px-4">
      <button id="sidebarToggle" class="bg-gray-800 text-white p-2 rounded-md">☰ Menu</button>
    </div>

    @include('prog_coor.sidebar')

    <main class="flex-1 p-4">
      <div class="flex flex-wrap justify-between items-center mb-6">
        <div class="flex items-center gap-2 font-medium text-base text-gray-500">
          <label>Select period:</label>
          <input type="date" class="border-gray-500 rounded-lg">
          <input type="date" class="border-gray-500 rounded-lg">
        </div>
        <div class="flex items-center gap-2 mt-2 sm:mt-0">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-gray-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
          </svg>
          <input type="text" placeholder="Search..." class="border-none bg-gray-100 px-2 py-1">
          <div class="h-8 border border-gray-500 mx-4"></div>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-gray-500 ms-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
          </svg>
          <button class="bg-gray-100 pe-4">Filter</button>
        </div>
      </div>
      <hr class="bg-gray-700">

      <div class="bg-white shadow-sm sm:rounded-lg p-6 mt-4">
        <div class="flex justify-between">
          <h3 class="text-lg font-semibold mb-4">Good Moral Certificate Applications</h3>

          <div class="mb-4 flex items-center">
            <form action="#" method="GET" class="flex items-center">
              <label for="recordsPerPage" class="mr-2 text-sm font-medium text-gray-700">Show</label>
              <select
                name="perPage"
                id="recordsPerPage"
                class="border border-gray-300 rounded-md p-2 text-sm w-20">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
              </select>
              <span class="ml-2 text-sm text-gray-700">entries</span>
            </form>
          </div>
        </div>

        <table class="min-w-full bg-white border border-gray-300 rounded-lg table-fixed border-collapse">
          <thead>
            <tr class="text-left border-b bg-gray-100">
              <th class="w-1/5 border border-gray-300 px-6 py-3 text-sm font-semibold text-black">Student ID</th>
              <th class="w-1/5 border border-gray-300 px-6 py-3 text-sm font-semibold text-black">Name</th>
              <th class="w-1/5 border border-gray-300 px-6 py-3 text-sm font-semibold text-black">Department</th>
              <th class="w-1/5 border border-gray-300 px-6 py-3 text-sm font-semibold text-black">Status</th>
              <th class="w-1/5 border border-gray-300 px-6 py-3 text-sm font-semibold text-black">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b">
              <td class="border border-gray-300 px-6 py-4 text-sm text-gray-600">2023123456</td>
              <td class="border border-gray-300 px-6 py-4 text-sm text-gray-600">Juan Dela Cruz</td>
              <td class="border border-gray-300 px-6 py-4 text-sm text-gray-600">Engineering</td>
              <td class="border border-gray-300 px-6 py-4 text-sm text-gray-600">Pending</td>
              <td class="border border-gray-300 px-6 py-4 text-sm text-gray-600">
                <div class="flex flex-col sm:flex-row gap-2">
                  <button class="bg-blue-500 text-white py-2 px-4 rounded-md text-sm">Details</button>
                  <button class="bg-green-500 text-white py-2 px-4 rounded-md text-sm">Approve</button>
                  <button class="bg-red-500 text-white py-2 px-4 rounded-md text-sm">Reject</button>
                </div>
              </td>
            </tr>
            <tr class="border-b">
              <td class="border border-gray-300 px-6 py-4 text-sm text-gray-600">2023111122</td>
              <td class="border border-gray-300 px-6 py-4 text-sm text-gray-600">Maria Santos</td>
              <td class="border border-gray-300 px-6 py-4 text-sm text-gray-600">Health Sciences</td>
              <td class="border border-gray-300 px-6 py-4 text-sm text-gray-600">Approved</td>
              <td class="border border-gray-300 px-6 py-4 text-sm text-gray-600">
                <span class="block text-center text-gray-500 py-2 bg-gray-100 rounded-md">No action</span>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="mt-4 align-middle">
          <p class="text-sm text-gray-500">Showing 1 to 2 of 2 entries</p>
        </div>
      </div>
    </main>
  </div>
</x-app-layout>
