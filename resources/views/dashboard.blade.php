<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="flex">
    <!-- Sidebar -->
    @include('sidebar')

    <div class="py-12 flex-1">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            Welcome, {{ $fullname }}
          </div>

          @if(session('status'))
          <div class="alert alert-success mt-4 p-4 bg-green-500 text-white rounded">
            {{ session('status') }}
          </div>
          @endif

          <div class="p-6">
            @if ($Violation->isEmpty())
            <form method="POST" action="{{ route('apply.good_moral_certificate') }}">
              @csrf
              <div class="mt-4">
                <x-input-label for="num_copies" :value="__('Number of Copies')" />
                <x-text-input id="num_copies"
                  class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
                  type="number" name="num_copies" required :value="old('num_copies')" autofocus autocomplete="num_copies"
                  placeholder="Enter number of copies" min="1" />
                <x-input-error :messages="$errors->get('num_copies')" class="mt-2" />
              </div>

              <!-- Reason of Application -->
              <div class="mt-6">
                <x-input-label :value="__('Reason of Application (check one only)')" />
                <div class="mt-2 space-y-2">
                  @foreach([
                    'Transfer to another school',
                    'Employment',
                    'Scholarship',
                    'Board Examination',
                    'Government examination',
                    'VISA/Passport application',
                    'PSG Election',
                    'Cross enrollment'
                    ] as $reason)
                  <label class="flex items-center">
                    <input type="radio" name="reason" value="{{ $reason }}" required class="text-green-600">
                    <span class="ml-2">{{ $reason }}</span>
                  </label>
                  @endforeach

                  <label class="flex items-center">
                    <input type="radio" name="reason" value="Others" required class="text-green-600" id="reasonOthers">
                    <span class="ml-2">Others (please specify)</span>
                  </label>

                  <input type="text" name="reason_other" id="reasonOtherInput" class="mt-1 block w-full"
                    placeholder="Please specify..." disabled>
                </div>
                <x-input-error :messages="$errors->get('reason')" class="mt-2" />
              </div>

              @php
              $accountType = Auth::user()->account_type;
              @endphp

              @if ($accountType === 'alumni')
              <!-- Date of Graduation -->
              <div class="mt-6">
                <x-input-label for="graduation_date" :value="__('Date of Graduation')" />
                <x-text-input id="graduation_date" name="graduation_date" type="date" class="mt-1 block w-full"
                  :value="old('graduation_date')" />
                <x-input-error :messages="$errors->get('graduation_date')" class="mt-2" />
              </div>

              <!-- Course Completed -->
              <div class="mt-6">
                <x-input-label for="course_completed" :value="__('Course Completed')" />
                <x-text-input id="course_completed" name="course_completed" type="text" class="mt-1 block w-full"
                  :value="old('course_completed')" />
                <x-input-error :messages="$errors->get('course_completed')" class="mt-2" />
              </div>
              @elseif ($accountType === 'student')
              <div class="mb-6">
                <x-input-label for="last_course_year_level"
                  :value="__('Course of Last School Attended in SPUP (Bachelor of Arts/Science in Social Work)')" />
                <x-text-input id="last_course_year_level" name="last_course_year_level" type="text"
                  class="mt-1 block w-full" :value="old('last_course_year_level')" />
                <x-input-error :messages="$errors->get('last_course_year_level')" class="mt-2" />
              </div>

              <div>
                <x-input-label for="last_semester_sy"
                  :value="__('Semester and School Year of Last Attendance in SPUP (First/Second Semester of 2000-2001)')" />
                <x-text-input id="last_semester_sy" name="last_semester_sy" type="text" class="mt-1 block w-full"
                  :value="old('last_semester_sy')" />
                <x-input-error :messages="$errors->get('last_semester_sy')" class="mt-2" />
              </div>
              @endif

              <!-- Submit Button -->
              <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                  Apply for Good Moral Certificate
                </button>
              </div>
            </form>
            @else
            <div class="p-4 bg-red-100 text-red-700 rounded">
              You are not allowed to request a Good Moral Certificate due to existing violation(s).
            </div>
            @endif
          </div>

          <!-- Violations Section -->
          <div class="p-6">
            @if ($Violation->isEmpty())
            <h3 class="text-lg font-semibold text-green-600">You have no existing violations.</h3>
            @else
            <h3 class="text-lg font-semibold mb-4 text-red-600">You have existing violation(s).</h3>
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
  </div>

  <!-- JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const otherRadio = document.getElementById('reasonOthers');
      const otherInput = document.getElementById('reasonOtherInput');
      const allRadios = document.querySelectorAll('input[name="reason"]');

      allRadios.forEach(radio => {
        radio.addEventListener('change', function () {
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
