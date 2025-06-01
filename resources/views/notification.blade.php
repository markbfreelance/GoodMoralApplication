<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center space-x-4">
      <img src="/images/backgrounds/spup-logo.png" alt="Admin Picture" class="w-16 h-16 rounded-md object-cover">
      <span class="text-2xl">
        Application Status & Notifications
      </span>
    </div>
  </x-slot>
  <hr class="h-1 bg-spupGreen border-0">
  <hr class="h-1 bg-spupGold border-0">

  <div class="flex">
    <!-- Sidebar -->
    @include('sidebar')

    <div class="py-12 flex-1">
      <div class="sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <h3 class="text-lg font-semibold text-gray-700">Your Application Status</h3>

            <!-- Display application status -->
            <div class="mt-4">
              @if(session('status'))
              <div class="alert alert-success mt-4 p-4 bg-green-500 text-white rounded">
                {{ session('status') }}
              </div>
              @endif
            </div>

            <!-- Application Notification List -->
            <div class="mt-6 space-y-4">
              <h4 class="text-xl font-medium text-gray-600">Notifications</h4>

              @if($notifications->isEmpty())
              <p class="text-gray-500 mt-2">You have no new notifications at the moment.</p>
              @else
              <div class="space-y-4">
                @foreach ($notifications as $notification)
                <div class="p-4 bg-white shadow-lg rounded-lg 
                    @if($notification->status == 'approved')
                      border-green-500 border
                    @elseif(in_array($notification->status, ['0','1','3']))
                      border-yellow-500 border
                    @elseif(in_array($notification->status, ['2','4']))
                      border-green-500 border
                    @elseif(in_array($notification->status, ['-1','-2','-3']))
                      border-red-500 border
                    @else
                      border-gray-300 border
                    @endif
                  ">
                  <div class="flex justify-between items-center">
                    <h5 class="text-lg font-semibold text-gray-800">{{ $notification->title }}</h5>
                    <span class="text-sm text-gray-500">{{ $notification->created_at->format('M d, Y') }}</span>
                  </div>

                  <p class="mt-2 text-gray-600"><strong>Reference Number:</strong> {{ $notification->reference_number }}</p>
                  <p class="mt-2 text-gray-600"><strong>Reason:</strong> {{ $notification->reason }}</p>
                  <p class="mt-2 text-gray-600"><strong>Message:</strong> {{ $notification->message }}</p>

                  <div class="mt-4">
                    <span class="px-3 py-1 text-sm font-semibold text-white rounded-full 
                        @switch($notification->status)
                          @case('approved') bg-green-500 @break
                          @case('0') bg-yellow-500 @break
                          @case('1') bg-yellow-500 @break
                          @case('2') bg-green-500 @break
                          @case('3') bg-yellow-500 @break
                          @case('4') bg-green-500 @break
                          @case('-1') bg-red-500 @break
                          @case('-2') bg-red-500 @break
                          @case('-3') bg-red-500 @break
                          @default bg-gray-500
                        @endswitch
                      ">
                      @switch($notification->status)
                      @case('0') Your application is now with the registrar. @break
                      @case('-1') Your application has been rejected by the registrar. @break
                      @case('-2') Your application has been rejected by the Administrator . @break
                      @case('-3') Your application has been rejected by the Dean. @break
                      @case('1') Your application has been approved by the registrar. @break
                      @case('2') Your application has been approved by the Administrator . @break
                      @case('3') Your application has been approved by the Dean. @break
                      @case('4') Your application is now ready for pick up. @break
                      @default {{ ucfirst($notification->status) }}
                      @endswitch
                    </span>
                  </div>

                  {{-- Upload receipt document if status is 4 and no receipt exists --}}
                  @if($notification->status == '2')
                  @php
                  $receipt = $receipts[$notification->reference_number] ?? null;
                  @endphp

                  @if($receipt && $receipt->document_path)
                  <div class="mt-4 text-green-700 font-medium">
                    ✅ Receipt already uploaded.
                  </div>
                  @else
                  <form action="{{ route('receipt.upload') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <input type="hidden" name="reference_num" value="{{ $notification->reference_number }}">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Receipt Document</label>
                    <input type="file" name="document_path" required
                      class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 
                                 file:rounded-full file:border-0 file:text-sm file:font-semibold 
                                 file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    <button type="submit" class="mt-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                      Upload
                    </button>
                  </form>
                  @endif
                  @endif

                </div>
                @endforeach
              </div>
              @endif
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>