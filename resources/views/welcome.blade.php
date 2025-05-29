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

  .mainBg {
    background: url('{{ asset("/images/backgrounds/mainBg3.jpg") }}') top right no-repeat;
    background-size: cover;
    background-repeat: no-repeat;
  }
</style>

<body class="text-[#1b1b18] flex flex-col min-h-screen mainBg">
  <header class="w-full max-w-7xl mx-auto p-6 flex items-center justify-between">
    <div class="flex items-center">
      <img src="{{ asset('images/backgrounds/spup-logo.png') }}" alt="Logo" class="h-16 w-auto mr-4"> <!-- Adjust height as needed -->
      <span class="font-oldEnglish text-spupGreen text-2xl">
        St. Paul University Philippines
      </span>
    </div>

    <nav>
      @if (Route::has('login'))
      @auth
      <form method="POST" action="{{ route('logout') }}" class="inline-block">
        @csrf
        <button type="submit" class="px-5 py-2 text-gray-600 font-medium hover:text-spupGold">
          Apply Now
        </button>
      </form>
      @else
      <a href="{{ route('login') }}" class="inline-block px-5 py-2 text-gray-600 font-medium hover:text-spupGold">
        Sign In
      </a>
      @if (Route::has('register'))
      <a href="{{ route('register') }}" class="inline-block px-5 py-2 text-gray-600 font-medium hover:text-spupGold">
        Create an Account
      </a>
      @endif
      @endauth
      @endif
    </nav>
  </header>

  <main class="w-full flex-grow flex flex-col items-center justify-center text-center">
    <section class="relative z-10 max-w-3xl px-6 py-12 text-center">
      <h1 class="text-5xl md:text-6xl font-bold text-gray-900 tracking-tight mb-6">
        Good Moral Application
      </h1>
      <p class="text-lg md:text-xl text-gray-700 mb-6 leading-relaxed">
        Upholding strong values and integrity is at the heart of our community.
        Join us in fostering a culture of ethical excellence and accountability.
      </p>
      <p class="text-xl font-semibold text-gray-600 italic mb-10">
        Caritas. Veritas. Scientia.
      </p>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
          class="px-8 py-3 text-white bg-spupGreen hover:bg-spupGold transition-all duration-300 ease-in-out text-lg font-medium rounded-md shadow-md">
          Apply Now
        </button>
      </form>
    </section>
  </main>

  <footer class="bg-gray-200 text-center py-2">
    <p class="text-xs text-gray-600">© {{ date('Y') }} Good Moral Certification Portal. All rights reserved.</p>
  </footer>
</body>

</html>