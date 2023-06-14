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
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    @vite(['resources/css/client.css','resources/js/client.js'])
    @vite(['resources/css/searchform.css', 'resources/js/searchform.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
        <div class="footer-links">
          <div class="maincontent">
            <div class="text-center">Links</div>
            <div class="d-flex">
              <div class="flex-grow-1 p-4 fs-6">
                <h5>Attributions</h5>
                <ul class="list-unstyled">
                  {{-- <li><a class="text-decoration-none text-white" href="#">Link 1</a></li>
                  <li><a class="text-decoration-none text-white" href="#">Link 2</a></li> --}}
                  <li>
                    <div class="dropdown">
                      <a class="text-decoration-none text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Icons
                      </a>
                    
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" target="_blank" href="https://www.flaticon.com/free-icons/house-things" title="house things icons">House things icons created by Freepik - Flaticon</a>
                        <li><a class="dropdown-item" target="_blank" href="https://www.flaticon.com/free-icons/vault" title="vault icons">Vault icons created by Smashicons - Flaticon</a>
                        <li><a class="dropdown-item" target="_blank" href="https://www.flaticon.com/free-icons/wifi" title="wifi icons">Wifi icons created by Freepik - Flaticon</a>
                        <li><a class="dropdown-item" target="_blank" href="https://www.flaticon.com/free-icons/hair-dryer" title="hair dryer icons">Hair dryer icons created by 88 Cloud - Flaticon</a>
                        <li><a class="dropdown-item" target="_blank" href="https://www.flaticon.com/free-icons/coffee-machine" title="coffee machine icons">Coffee machine icons created by Freepik - Flaticon</a>
                        <li><a class="dropdown-item" target="_blank" href="https://www.flaticon.com/free-icons/smart-tv" title="smart tv icons">Smart tv icons created by kerismaker - Flaticon</a>
                        <li><a class="dropdown-item" target="_blank" href="https://www.flaticon.com/free-icons/iron" title="iron icons">Iron icons created by Those Icons - Flaticon</a>
                        <li><a class="dropdown-item" target="_blank" href="https://www.flaticon.com/free-icons/shower" title="shower icons">Shower icons created by Freepik - Flaticon</a>
                        <li><a class="dropdown-item" target="_blank" href="https://www.flaticon.com/free-icons/bathroom" title="bathroom icons">Bathroom icons created by Smashicons - Flaticon</a>
                        <li><a class="dropdown-item" target="_blank" href="https://www.flaticon.com/free-icons/fridge" title="fridge icons">Fridge icons created by Freepik - Flaticon</a>
                        <li><a class="dropdown-item" target="_blank" href="https://www.flaticon.com/free-icons/desk" title="desk icons">Desk icons created by Freepik - Flaticon</a>
                        <li><a class="dropdown-item" target="_blank" href="https://www.flaticon.com/free-icons/air-conditioning" title="air conditioning icons">Air conditioning icons created by srip - Flaticon</a>
                        <li><a class="dropdown-item" target="_blank" href="https://www.flaticon.com/free-icons/bathrobe" title="bathrobe icons">Bathrobe icons created by AmethystDesign - Flaticon</a>
                        <li><a class="dropdown-item" target="_blank" href="https://www.flaticon.com/free-icons/slippers" title="slippers icons">Slippers icons created by Freepik - Flaticon</a>
                      </ul>
                    </div>
                  </li>
                  <!-- Add more links here -->
                </ul>
              </div>
              {{-- <div class="flex-grow-1 p-4">
                <h3>Column 2</h3>
                <ul class="list-unstyled">
                  <li><a href="#">Link 1</a></li>
                  <li><a href="#">Link 2</a></li>
                  <!-- Add more links here -->
                </ul>
              </div> --}}
              <!-- Add more columns here -->
            </div>
          </div>
        </div>
        <div class="footer-info">
          <p>&copy; <span id="year"></span> {{ App\Models\Setting::where('setting_key', 'hotel_name')->first()->setting_value }}</p>
        </div>
      </div>
    </footer>
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
    var currentIdentifier = currentUrl.split('/')[3];

    // console.log(currentIdentifier);

    for (var i = 0; i < links.length; i++) {
      var link = links[i];
      var linkIdentifier = link.href.split('/')[3];
      // console.log(linkIdentifier);
      if (linkIdentifier === currentIdentifier) {
        link.classList.add("active-mlink");
        document.getElementById('activeMobileLinkSpace').innerHTML = "<i class='fa fa-bars'></i> " + link.innerHTML;
        break;
      }
    }
  });
}

    function increment(inputId) {
      var inputElement = document.getElementById(inputId);
      inputElement.stepUp();
    }
    
    function decrement(inputId) {
      var inputElement = document.getElementById(inputId);
      inputElement.stepDown();
    }

    // window.onscroll = function() {
    //   var stickyDiv = document.querySelector('.toStick');
    //   var distanceFromTop = stickyDiv.offsetTop;
      
    //   if (window.pageYOffset > distanceFromTop) {
    //     stickyDiv.classList.add("sticky-active");
    //   } else {
    //     stickyDiv.classList.remove("sticky-active");
    //   }
    // };
  </script>
</body>
</html>