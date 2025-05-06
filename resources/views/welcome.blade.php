<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

  <!-- Styles / Scripts -->
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @else
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @endif
</head>

<style>
  .bg-custom {
    background: url('{{ asset("/images/backgrounds/spup-logo.png") }}') center/contain no-repeat;
    background-size: 40%;
  }
</style>

<body class="text-[#1b1b18] flex flex-col min-h-screen">
  <header class="w-full max-w-4xl mx-auto p-6 flex items-center justify-between">
    <span class="text-green-800 font-semibold text-2xl">St. Paul University Philippines</span>
    <nav class="space-x-2">
      @if (Route::has('login'))
      @auth
      <form method="POST" action="{{ route('logout') }}" class="inline-block">
        @csrf
        <button type="submit" class="px-5 py-2 text-gray-600 border border-green-700 hover:bg-yellow-400 hover:text-white rounded-md">
          Log In
        </button>
      </form>
      @else
      <a href="{{ route('login') }}" class="inline-block px-5 py-2 text-gray-600 border border-green-700 hover:bg-yellow-400 hover:text-white rounded-md">
        Sign In
      </a>
      @if (Route::has('register'))
      <a href="{{ route('register') }}" class="inline-block px-5 py-2 text-gray-600 border border-green-700 hover:bg-yellow-400 hover:text-white rounded-md">
        Create an Account
      </a>
      @endif
      @endauth
      @endif
    </nav>
  </header>

  <main class="bg-custom flex flex-col items-center justify-center flex-grow text-center relative">
    <div class="bg-white/60 backdrop-blur-sm absolute inset-0 w-full h-full"></div>
    <section class="relative z-10 max-w-5xl p-10 text-center">
      <h1 class="text-6xl font-extrabold text-gray-900 mb-6 tracking-tighter">GOOD MORAL APPLICATION</h1>
      <p class="text-xl text-gray-700 leading-relaxed mb-8">
        Upholding strong values and integrity is at the heart of our community.
        Join us in fostering a culture of ethical excellence and accountability.
      </p>
      <form method="POST" action="{{ route('logout') }}" class="inline-block">
        @csrf
        <button type="submit"
          class="px-8 py-4 bg-green-700 text-white text-lg font-medium rounded-lg shadow-md 
               hover:bg-green-800 hover:shadow-lg transform hover:scale-105 transition-all duration-300">
          Apply Now
        </button>
      </form>
    </section>

  </main>

  <footer class="bg-gray-200 text-center py-4">
    <p class="text-sm text-gray-600">© {{ date('Y') }} Good Moral Certification Portal. All rights reserved.</p>
  </footer>
</body>

</html>