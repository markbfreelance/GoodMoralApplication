<x-guest-layout>
  <div class="mb-4 text-sm text-gray-600">
    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
  </div>

  <form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <!-- Password -->
    <div>
      <x-input-label for="password" :value="__('Password')" />

      <x-text-input id="password"
        class="block mt-1 w-full focus:border-green-700 focus:ring-1 focus:ring-green-700 focus:ring-opacity-100"
        type="password"
        name="password"
        required
        autocomplete="current-password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="flex justify-end mt-4">
      <x-primary-button class="bg-green-700 hover:bg-green-900">
        {{ __('Confirm') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>