@extends('layouts.client-2')

@section('content')
    <div class="pg-landing">
        <img src={{ asset("images/contacts1.jpg") }} alt="logo" class="logo">
        <div class="content">
            <h2>Contact Us</h2>
            <p>
                {!! $page->content !!}
            </p>
        </div>
        <div class="overlay"></div>
    </div>
    <div class="contact-pane">
        <div class="col-12 col-sm-12 col-lg-6 col-md-6">
            <div class="contacts__tab">
                <p><strong>Main Hotel Contacts</strong></p>
                <p><strong>Email :</strong> {{ \App\Models\Setting::where('setting_key', 'hotel_email')->first()->setting_value }}</p>
                <p><strong>Phone :</strong> {{ \App\Models\Setting::where('setting_key', 'hotel_phone')->first()->setting_value }}</p>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-lg-6 col-md-6">
            <div class="contacts__tab">
                <p><strong>Complaints and Suggestions</strong></p>
                <p><strong>Email :</strong> {{ \App\Models\Setting::where('setting_key', 'hotel_email')->first()->setting_value }}</p>
                <p><strong>Phone :</strong> {{ \App\Models\Setting::where('setting_key', 'hotel_phone')->first()->setting_value }}</p>
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

        scrollToContent();
        function scrollToContent() {
            window.addEventListener('DOMContentLoaded', function () {
                setTimeout(function () {
                var section = document.getElementById('maincontent');
                section.scrollIntoView();
                }, 3000);
            });
        }
    </script>
@endsection