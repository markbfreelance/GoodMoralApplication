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

            <!-- Reason of Application (Radio Buttons) -->
            <div class="mt-6">
              <x-input-label :value="__('Reason of Application (check one only)')" />
              <div class="mt-2 space-y-2">

                <label class="flex items-center">
                  <input type="radio" name="reason" value="Transfer to another school" required class="text-green-600">
                  <span class="ml-2">Transfer to another school</span>
                </label>

                <label class="flex items-center">
                  <input type="radio" name="reason" value="Employment" required class="text-green-600">
                  <span class="ml-2">Employment</span>
                </label>

                <label class="flex items-center">
                  <input type="radio" name="reason" value="Scholarship" required class="text-green-600">
                  <span class="ml-2">Scholarship</span>
                </label>

                <label class="flex items-center">
                  <input type="radio" name="reason" value="Board Examination" required class="text-green-600">
                  <span class="ml-2">Board Examination</span>
                </label>

                <label class="flex items-center">
                  <input type="radio" name="reason" value="Government examination" required class="text-green-600">
                  <span class="ml-2">Government examination</span>
                </label>

                <label class="flex items-center">
                  <input type="radio" name="reason" value="VISA/Passport application" required class="text-green-600">
                  <span class="ml-2">VISA/Passport application</span>
                </label>

                <label class="flex items-center">
                  <input type="radio" name="reason" value="PSG Election" required class="text-green-600">
                  <span class="ml-2">PSG Election</span>
                </label>

                <label class="flex items-center">
                  <input type="radio" name="reason" value="Cross enrollment" required class="text-green-600">
                  <span class="ml-2">Cross enrollment</span>
                </label>

                <label class="flex items-center">
                  <input type="radio" name="reason" value="Others" required class="text-green-600" id="reasonOthers">
                  <span class="ml-2">Others (please specify)</span>
                </label>

                <!-- Input for 'Others' -->
                <input type="text" name="reason_other" id="reasonOtherInput" class="mt-1 block w-full" placeholder="Please specify..." disabled>
              </div>

              <x-input-error :messages="$errors->get('reason')" class="mt-2" />
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
        <!-- Violation Section -->
        <div class="p-6">
          @if ($Violation->isEmpty())
          <h3 class="text-lg font-semibold text-green-600">You have no existing violations. </h3>
          @else
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
                <td class="py-2 px-4">{{ $violation->violation }}</td>
                <td class="py-2 px-4">{{ $violation->created_at->format('M d, Y') }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript (Inline) -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const otherRadio = document.getElementById('reasonOthers');
      const otherInput = document.getElementById('reasonOtherInput');
      const allRadios = document.querySelectorAll('input[name="reason"]');

      allRadios.forEach(radio => {
        radio.addEventListener('change', function() {
          if (otherRadio.checked) {
            otherInput.disabled = false;
            otherInput.required = true;
          } else {
            otherInput.disabled = true;
            otherInput.required = false;
            otherInput.value = '';
          }
        });
      });
    });
  </script>
</x-app-layout>