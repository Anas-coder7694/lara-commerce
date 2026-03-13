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
    <body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900">

    <!-- Header -->
        <!-- header section strats -->
    <header class="header_section" style="width:100%; background-color:#111; padding:15px 40px;">
  <nav style="display:flex; justify-content:space-between; align-items:center;">

    <!-- Logo -->
    <a href="index.html" style="text-decoration:none; color:white; font-size:24px; font-weight:bold;">
      Creatics
    </a>

    <!-- User Options -->
    <div class="user_option" style="display:flex; align-items:center; gap:20px;">

      @if(Auth::check())
      <a href="{{ route('dashboard') }}" style="color:white; text-decoration:none; display:flex; align-items:center; gap:5px;">
        <i class="fa fa-user" aria-hidden="true"></i>
        <span>Dashboard</span>
      </a>
      @else
      <a href="{{ route('login') }}" style="color:white; text-decoration:none; display:flex; align-items:center; gap:5px;">
        <i class="fa fa-user" aria-hidden="true"></i>
        <span>Login</span>
      </a>

      <a href="{{ route('register') }}" style="color:white; text-decoration:none; display:flex; align-items:center; gap:5px;">
        <i class="fa fa-user" aria-hidden="true"></i>
        <span>Sign up</span>
      </a>
      @endif

      


    </div>
  </nav>
</header>

    <!-- Main Content -->
    <div class="min-h-screen flex flex-col items-center pt-10">

        <!-- Logo -->
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <!-- Auth Card -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4 mt-10">
        <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </footer>

</body>
</html>
