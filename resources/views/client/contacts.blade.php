@extends('layouts.client')

@section('landing')
    <div class="pagelanding">
        <img src="{{ asset('img/contacts1.jpg') }}" alt="Image 1">
        <div class="overlay"></div>
        <div class="text">
            <p>Please, talk to us.</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="content-box" id="content-box">
        {!! $page->content !!}
    </div>
    <span id="toggleButton" onclick="toggleContent()">Read More...</span>
    <hr>
    <div class="row">
        <div class="col-6">
            <div class="contacts__tab">
                <p><strong>Main Hotel Contacts</strong></p>
                <p><strong>Email :</strong> {{ \App\Models\Setting::where('setting_key', 'hotel_email')->first()->setting_value }}</p>
                <p><strong>Phone :</strong> {{ \App\Models\Setting::where('setting_key', 'hotel_phone')->first()->setting_value }}</p>
            </div>
        </div>
        <div class="col-6">
            <div class="contacts__tab">
                <p><strong>Complaints and Suggestions</strong></p>
                <p><strong>Email :</strong> {{ \App\Models\Setting::where('setting_key', 'hotel_email')->first()->setting_value }}</p>
                <p><strong>Phone :</strong> {{ \App\Models\Setting::where('setting_key', 'hotel_phone')->first()->setting_value }}</p>
            </div>
        </div>

        <hr>
        <div class="col-12">
            <p><strong>How to get to {{ \App\Models\Setting::where('setting_key', 'hotel_name')->first()->setting_value }} : Map</strong></p>
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.4416513552055!2d36.951395309178274!3d-1.5051795984743677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182fa1d8924f14af%3A0xbddf56a4a265f0c2!2sConrad%20Resort!5e0!3m2!1sen!2ske!4v1684667781909!5m2!1sen!2ske" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <hr>

        <div class="col-12">
            <p><strong>Check us out online</strong></p>
            <div class="social-links">
                <a href="#" title="Facebook" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" title="Instagram" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" title="LinkedIn" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
                <a href="#" title="Pinterest" target="_blank"><i class="fa-brands fa-pinterest"></i></a>
                <a href="#" title="YouTube" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                <a href="#" title="Twitter" target="_blank"><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        function toggleContent() {
            var content = document.getElementById("content-box");
            var toggleButton = document.getElementById("toggleButton");

            if (content.classList.contains("expanded")) {
                content.classList.remove("expanded");
                toggleButton.innerHTML = "Read More...";
            } else {
                content.classList.add("expanded");
                toggleButton.innerHTML = "Read Less";
            }
        }
    </script>
@endsection