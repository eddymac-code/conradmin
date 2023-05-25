<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ \App\Models\Setting::where('setting_key', 'hotel_name')->first()->setting_value }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/conrad.ico') }}">
    @vite(['resources/css/client.css','resources/js/client.js'])
</head>
<body>
    <div class="contact-tab">
        <div class="hotel-brand">
          <h2>{{ App\Models\Setting::where('setting_key', 'hotel_name')->first()->setting_value }}</h2>
        </div>
        <ul class="contact-menu">
            <li><i class="fa fa-thin fa-globe"></i> {{ App\Models\Setting::where('setting_key', 'hotel_address')->first()->setting_value }}</li>
            <li><i class="fa fa-thin fa-envelope"></i> {{ App\Models\Setting::where('setting_key', 'hotel_email')->first()->setting_value }}</li>
            <li><i class="fa fa-thin fa-phone-volume"></i> {{ App\Models\Setting::where('setting_key', 'hotel_phone')->first()->setting_value }}</li>
        </ul>
    </div>
    <nav class="navbar">
        <div class="navbar__logo">
          <a href="{{ route('client.home') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
          </a>
        </div>
        {{-- <ul class="navbar__menu">
          <li><a href="#">Home</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Contact Us</a></li>
        </ul> --}}
    </nav>
      
    @yield('landing')

    <div id="maincontent">
      <nav class="newnav">
        <ul>
          <li><a class="nav-link" href="{{ route('client.home') }}">Overview</a></li>
          <li><a class="nav-link" href="{{ route('client.rooms') }}">Rooms</a></li>
          <li><a class="nav-link" href="{{ route('client.restaurantbar') }}">Restaurant and Bars</a></li>
          <li><a class="nav-link" href="{{ route('client.conferences') }}">Conference Facilities</a></li>
          <li><a class="nav-link" href="{{ route('client.funfitness') }}">Fun and Fitness</a></li>
          <li><a class="nav-link" href="{{ route('client.openairevents') }}">Open Air Events</a></li>
          <li><a class="nav-link" href="{{ route('client.contacts') }}">Contact Us</a></li>
        </ul>
      </nav>
      {{-- <select class="mobilenav" name="" id="">
        <a class="mobi-link" href="{{ route('client.home') }}">Overview</a>
        <a class="mobi-link" href="{{ route('client.rooms') }}">Rooms</a>
        <a class="mobi-link" href="{{ route('client.restaurantbar') }}">Restaurant and Bars</a>
        <a class="mobi-link" href="{{ route('client.conferences') }}">Conference Facilities</a>
        <a class="mobi-link" href="{{ route('client.funfitness') }}">Fun and Fitness</a>
        <a class="mobi-link" href="{{ route('client.openairevents') }}">Open Air Events</a>
        <a class="mobi-link" href="{{ route('client.contacts') }}">Contact Us</a>
      </select> --}}
      <div class="mobilenav">
        <p id="activeMobileLinkSpace" onclick="expandOnMobile()"></p>
        <!-- Navigation links (hidden by default) -->
        <div id="mobileLinks">
          <a class="mobi-link" href="{{ route('client.home') }}">Overview</a>
          <a class="mobi-link" href="{{ route('client.rooms') }}">Rooms</a>
          <a class="mobi-link" href="{{ route('client.restaurantbar') }}">Restaurant and Bars</a>
          <a class="mobi-link" href="{{ route('client.conferences') }}">Conference Facilities</a>
          <a class="mobi-link" href="{{ route('client.funfitness') }}">Fun and Fitness</a>
          <a class="mobi-link" href="{{ route('client.openairevents') }}">Open Air Events</a>
          <a class="mobi-link" href="{{ route('client.contacts') }}">Contact Us</a>
        </div>
      </div>
      @yield('content')
    </div>

    <footer>
      <div class="footer-content">
        <div class="blue-div">
          <div class="maincontent">
            Some Links Here
          </div>
        </div>
        <div class="remaining-div">
          <p>&copy; <span id="year"></span> {{ App\Models\Setting::where('setting_key', 'hotel_name')->first()->setting_value }}</p>
        </div>
      </div>
    {{-- </footer>

    <footer id="mainfooter">
      <div class="footer-links">
        Some Links here
      </div>
      <div class="footer-info">
        <p>&copy; <span id="year"></span> {{ App\Models\Setting::where('setting_key', 'hotel_name')->first()->setting_value }}</p>
      </div>
    </footer> --}}
  @yield('footer-scripts')
  <script>
    /* Toggle between showing and hiding the navigation menu links when the user clicks on the hamburger menu / bar icon */
    function expandOnMobile() {
      var x = document.getElementById("mobileLinks");
      if (x.style.display === "block") {
        x.style.display = "none";
      } else {
        x.style.display = "block";
      }
    }

    assignActiveMStatus();

function assignActiveMStatus() {
  document.addEventListener("DOMContentLoaded", function () {
    var links = document.querySelectorAll(".mobi-link");
    var currentUrl = window.location.href;

    for (var i = 0; i < links.length; i++) {
      var link = links[i];
      if (link.href === currentUrl) {
        link.classList.add("active-mlink");
        document.getElementById('activeMobileLinkSpace').innerHTML = "<i class='fa fa-bars'></i> " + link.innerHTML;
        break;
      }
    }
  });
}
  </script>
</body>
</html>