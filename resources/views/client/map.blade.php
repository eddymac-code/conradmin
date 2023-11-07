@extends('layouts.client-2')

@section('content')
<div class="map-content">
    <h2><strong>How to get to {{ \App\Models\Setting::where('setting_key', 'hotel_name')->first()->setting_value }} : Map</strong></h2>
    <iframe class="map-lg" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.4416513552055!2d36.951395309178274!3d-1.5051795984743677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182fa1d8924f14af%3A0xbddf56a4a265f0c2!2sConrad%20Resort!5e0!3m2!1sen!2ske!4v1684667781909!5m2!1sen!2ske" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
@endsection