<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          Welcome, {{ $fullname }}
        </div>


        <!-- Show Success Message if Application is Submitted -->
        @if(session('status'))
      <div class="alert alert-success mt-4 p-4 bg-green-500 text-white rounded">
        {{ session('status') }}
      </div>
    @endif
        <div class="p-6">
          <form method="POST" action="{{ route('apply.good_moral_certificate') }}">
            @csrf

            <!-- Purpose Field -->
            <div class="mt-4">
              <x-input-label for="purpose" :value="__('Purpose')" />
              <x-text-input id="purpose"
                class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
                type="text" name="purpose" :value="old('purpose')" required autocomplete="purpose"
                placeholder="Enter Purpose" />
              <x-input-error :messages="$errors->get('purpose')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Apply for Good Moral Certificate
              </button>
            </div>
          </form>
        </div>
        <!-- Apply for Good Moral Certificate Button -->
        {{-- Check if the user has any violations --}}
        <div class="p-6">
          <h3 class="text-lg font-semibold mb-4 text-red-600">You have existing violation(s).</h3>

          {{-- Show the violation(s) in a table --}}
          <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead>
              <tr class="text-left border-b bg-gray-100">
                <th class="py-2 px-4">Offense Type</th>
                <th class="py-2 px-4">Description</th>
                <th class="py-2 px-4">Date Committed</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($Violation as $violation)
          <tr class="border-b">
          <td class="py-2 px-4">{{ $violation->offense_type }}</td>
          <td class="py-2 px-4">{{ $violation->violation}}</td>
          <td class="py-2 px-4">{{ $violation->created_at->format('M d, Y') }}</td>
          </tr>
        @endforeach
            </tbody>
          </table>
        </div>



      </div>
    </div>
  </div>
</x-app-layout>