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
</style>

<body class="text-[#1b1b18] flex flex-col min-h-screen">

  <main class="bg-custom flex flex-col items-center justify-center flex-grow text-center relative">
    <div class="bg-white/60 backdrop-blur-sm absolute inset-0 w-full h-full"></div>
    <div class="relative z-10 max-w-5xl p-10 text-center">
    {{ $slot }}
    </div>

  </main>
</body>


</html>