<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
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

  <main class="w-full flex-grow flex flex-col items-center justify-center text-center">
    {{ $slot }}
  </main>
  <footer class="bg-gray-200 text-center py-2">
    <p class="text-xs text-gray-600">© {{ date('Y') }} Good Moral Certification Portal. All rights reserved.</p>
  </footer>
</body>


</html>