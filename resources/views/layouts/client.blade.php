<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ \App\Models\Setting::where('setting_key', 'hotel_name')->first()->setting_value }}</title>

    @vite('resources/js/client.js')
</head>
<body>
    <div class="contact-tab">
        <ul class="contact-menu">
            <li><i class="fa fa-thin fa-globe"></i> {{ App\Models\Setting::where('setting_key', 'hotel_address')->first()->setting_value }}</li>
            <li><i class="fa fa-thin fa-envelope"></i> {{ App\Models\Setting::where('setting_key', 'hotel_email')->first()->setting_value }}</li>
            <li><i class="fa fa-thin fa-phone-volume"></i> {{ App\Models\Setting::where('setting_key', 'hotel_phone')->first()->setting_value }}</li>
        </ul>
    </div>
    <nav class="navbar">
        <div class="navbar__logo">
          <a href="#">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
          </a>
        </div>
        <ul class="navbar__menu">
          <li><a href="#">Home</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Contact Us</a></li>
        </ul>
    </nav>
      
    @yield('content')
</body>
</html>