<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conrad Resort</title>
    <link rel="icon" type="image/x-icon" href={{ asset("images/Conrad-icon.ico") }}>
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js', 'resources/css/client-2.css', 'resources/js/client-2.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>
    <div class="navbar">
        <a href="javascript:void(0);" class="icon" id="toggleMenu">
            <i class="fa fa-bars"></i>
        </a>
        <a class="nav-brand" href="{{ route('client.home') }}">{{ \App\Models\Setting::where('setting_key', 'hotel_name')->first()->setting_value ?? 'Home' }}</a>
    </div>
    <div id="menu" class="menu-overlay">
        <div class="menu-overlay-content">
            <a href="{{ route('client.home') }}">Home</a>
            <a href="{{ route('client.rooms') }}">Accommodation</a>
            <a href="{{ route('client.restaurantbar') }}">Restaurant</a>
            <a href="{{ route('client.conferences') }}">Conferences</a>
            <a href="{{ route('client.funfitness') }}">Fun & Fitness</a>
            <a href="{{ route('client.openairevents') }}">Open Air Events</a>
            <a href="{{ route('client.contacts') }}">Contact</a>
        </div>
    </div>
    
    @yield('content')

    <footer>
        <div class="f-content">
            <img src="{{ asset('images/Conrad-em-clr.png') }}" alt="logo" class="logo">
            <div class="footer-links">
                <h2>Resort Info</h2>
                <ul>
                    <li><a>About Us</a></li>
                    <li><a href="{{ route('client.map') }}">Sitemap</a></li>
                    <li><a>Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h2>terms and conditions</h2>
                <ul>
                    <li><a>Privacy Policy</a></li>
                    <li><a>Bookings and Cancellations</a></li>
                    <li><a>Website Terms</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h2>Dexis Capital</h2>
                <ul>
                    <li><a>About</a></li>
                    <li><a>Careers</a></li>
                    <li><a>Link</a></li>
                </ul>
            </div>
            <button class="accordion">Resort Info</button>
            <div class="footer-panel">
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="{{ route('client.map') }}">Sitemap</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>

            <button class="accordion">Terms and Conditions</button>
            <div class="footer-panel">
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Bookings and Cancellations</a></li>
                    <li><a href="#">Website Terms</a></li>
                </ul>
            </div>

            <button class="accordion">Dexis Capital</button>
            <div class="footer-panel">
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Link</a></li>
                </ul>
            </div>
        </div>
        <div class="light-separator"></div>
        <div class="footer-bottom">
            <div class="social-links">
                <a href="#" title="Facebook" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" title="Instagram" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" title="LinkedIn" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
                <a href="#" title="YouTube" target="_blank"><i class="fa-brands fa-youtube"></i></a>
            </div>
            <div class="footer-copyright">
                <p><span id="year"></span> &copy; All Rights reserved</p>
            </div>
        </div>
    </footer>

    @yield('footer-scripts')

    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <script src="pikaday.js"></script>
    <script>
        var checkin = new Pikaday({ field: document.getElementById('datepicker-in') });
        var checkout = new Pikaday({ field: document.getElementById('datepicker-out') });

        document.getElementById('toggleMenu').addEventListener('click', function() {
            var navMenu = document.getElementById('menu');
            navMenu.classList.toggle('active');
        });

        function openMenu() {
            document.getElementById("menu").style.width = "100%";
        }

        function closeMenu() {
            // document.getElementById("menu").style.width = "0%";
            document.getElementById("menu").classList.remove('active');
        }

        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            /* Toggle between adding and removing the "active" class,
            to highlight the button that controls the panel */
            this.classList.toggle("active");

            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
            panel.style.display = "none";
            } else {
            panel.style.display = "block";
            }
        });
        }
    </script>
</body>

</html>