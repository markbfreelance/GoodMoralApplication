<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Application Status & Notifications') }}
    </h2>
  </x-slot>

  <div class="flex">
    <!-- Sidebar -->
    @include('sidebar') <!-- This includes the sidebar -->

    <div class="py-12 flex-1">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            <!-- Application Notification List (Floating Cards) -->
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
                      @elseif($notification->status == '0')
                        border-yellow-500 border
                      @elseif($notification->status == '1')
                        border-green-500 border
                      @elseif($notification->status == '2')
                        border-green-500 border                      
                    
                      @endif
                    ">
                  <div class="flex justify-between items-center">
                    <h5 class="text-lg font-semibold text-gray-800">{{ $notification->title }}</h5>
                    <span class="text-sm text-gray-500">{{ $notification->created_at->format('M d, Y') }}</span>
                  </div>

                  <p class="mt-2 text-gray-600"><strong>Reference Number:</strong> {{ $notification->ref_num }}</p>
                  <p class="mt-2 text-gray-600"><strong>Message:</strong> {{ $notification->notif }}</p>

                  <div class="mt-4">
                    <span class="px-3 py-1 text-sm font-semibold text-white rounded-full 
                          @if($notification->status == 'approved')
                            bg-green-500
                          @elseif($notification->status == '0')
                            bg-yellow-500
                          @elseif($notification->status == '1')
                            bg-green-500
                          @elseif($notification->status == '2')
                            bg-green-500                          
                          @else
                            bg-gray-500
                          @endif
                        ">
                      @if($notification->status == '0')
                      Your violation is now with the Admistrator.
                      @elseif($notification->status == '1')
                      Your application has been resolved.
                      @elseif($notification->status == '2')
                      Your application has been approved by the Dean.
                      @else
                      {{ ucfirst($notification->status) }}
                      @endif
                    </span>
                  </div>

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