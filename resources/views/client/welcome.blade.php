@extends('layouts.client')

@section('landing')
    <div class="slider">
        <img src="{{ asset('img/room1.jpg') }}" alt="Image 1">
        <img src="{{ asset('img/restaurant1.jpg') }}" alt="Image 2">
        <img src="{{ asset('img/office1.jpg') }}" alt="Image 3">
        <img src="{{ asset('img/swimming1.jpg') }}" alt="Image 4">
        <div class="overlay"></div>
        <div class="text">
            <p>Experience our awesome services.</p>
        </div>
    </div>
    {{-- <div class="buttons">
        <button class="prev">Prev</button>
        <button class="next">Next</button>
    </div> --}}
    {{-- <div id="firstpagecalc"></div> --}}
@endsection

@section('content')
    <div class="content-box mb-6" id="content-box">
        {!! $page->content !!}
    </div>
    <span id="toggleButton" onclick="toggleContent()">Read More...</span>
    <hr>
    <div class="my-5">
        <div class="row">
            <div>
                <h3>Absolute comfort and value, away from the city's hustle and bustle.</h3>
                <a class="float-right text-danger" href="{{ route('client.rooms') }}">See More >>></a>
                <div class="clearfix"></div>
            </div>
            @foreach (\App\Models\RoomType::all() as $roomType)
            <div class="col-md-4 d-flex">
                <div class="card">
                    @if($roomType->image)
                    <img src="{{ asset('storage/images/rooms/types/'.$roomType->image) }}" style="height:200px;object-fit:cover" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body d-flex flex-column align-center">
                    <h5 class="card-title">{{ $roomType->name }}</h5>
                    <p class="card-text">{{ $roomType->description ?? '' }}</p>
                    <div class="mb-2">
                        <p class="card-text">Amenities</p>
                        <p>
                        @foreach ($roomType->amenities as $amenity)
                            <img style="width:20px" src="{{ asset('storage/images/rooms/amenities/'.$amenity->image) }}" title="{{ $amenity->name }}" data-bs-toggle="popover" data-bs-content="" data-bs-trigger="hover" alt="">
                        @endforeach
                        </p>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div> 
    <hr>
    <div class="my-5">
        <div class="row">
            <div>
                <h3>Bars and Restaurants</h3>
                <a class="float-right text-danger" href="{{ route('client.restaurantbar') }}">See More >>></a>
                <div class="clearfix"></div>
            </div>            
                @php
                    $hall = \App\Models\ConferenceFacility::where('id', 1)->first();
                @endphp
            <div class="col-md-6">
                <img style="width:30rem" src="{{ asset('storage/images/conference_facilities/'. $hall->image) }}" alt="{{ $hall->name}} {{  __('Image') }}">
            </div>
            <div class="col-md-6">
                <p class="lead">
                    You can never go wrong with our house specials in our bars and restaurant. With good
                    company and ambient music, we make sure your dining and drinking experience a dream. 
                </p>
            </div>
        </div>
    </div>
    <hr>
    <div class="my-5">
        <div class="row">
            <div>
                <h3>The finest meeting point in Kajiado County</h3>
                <a class="float-right text-danger" href="{{ route('client.conferences') }}">See More >>></a>
                <div class="clearfix"></div>
            </div>            
                @php
                    $hall = \App\Models\ConferenceFacility::first();
                @endphp
            <div class="col-md-6">
                <img style="width:30rem" src="{{ asset('storage/images/conference_facilities/'. $hall->image) }}" alt="{{ $hall->name}} {{  __('Image') }}">
            </div>
            <div class="col-md-6">
                <p class="lead">
                    Our fully-equipped conference facilities and working spaces, coupled with some amenities and dedicated staff, 
                    will ensure that all your meetings and work needs are taken care of.
                </p>
            </div>
        </div>
    </div>
    <hr>
    <div class="my-5">
        <div class="row">
            <div>
                <h3>Keep fit and active during your stay.</h3>
                <a class="float-right text-danger" href="{{ route('client.funfitness') }}">See More >>></a>
                <div class="clearfix"></div>
            </div>            
                @php
                    $gym = \App\Models\Gym::first();
                @endphp
            <div class="col-md-6">
                <img style="width:30rem" src="{{ asset('storage/images/gyms/'. $gym->image) }}" alt="{{ $gym->name}} {{  __('Image') }}">
            </div>
            <div class="col-md-6">
                <p class="lead">
                    Our gym is well-equipped and has dedicated staff, who ensure your safety and fitness,
                    with programs targeted at guests and the general public.
                </p>
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