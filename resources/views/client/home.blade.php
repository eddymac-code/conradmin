@extends('layouts.client-2')

@section('content')
<div class="landing">
    <div class="intro-content">
        <img src={{ asset("images/Conrad-em-clr.png") }} alt="logo" class="logo">
        <p>Best accommodation in the Nairobi Metropolitan Area.</p>
    </div>
    <div class="overlay"></div>
</div>

<div class="booking-area">
    <form>
        <div class="date-input">
            <label>Checkin and Checkout</label><br>
            <input class="date" name="daterange" autocomplete="off">
        </div>
        <!-- <div class="date-input">
            <label>Checkout</label><br>
            <input class="date" id="datepicker-out" name="checkout" autocomplete="off">
        </div> -->
        <div class="p-over">
            <label for="">Occupancy</label><br>
            <input type="text" class="occupancy" name="occupancy" id="guestsInput" readonly>
            <div class="p-over-content">
                <div class="p-over-row">
                    <span class="p-over-label">Adults:</span>
                    <div class="p-over-value">
                        <button id="adultsDecrement">-</button>
                        <span id="adultsCount">1</span>
                        <button id="adultsIncrement">+</button>
                    </div>
                </div>
                <div class="p-over-row">
                    <span class="p-over-label">Children:</span>
                    <div class="p-over-value">
                        <button id="childrenDecrement">-</button>
                        <span id="childrenCount">0</span>
                        <button id="childrenIncrement">+</button>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <button class="booking-btn" type="submit">Check Availability</button>
        </div>
    </form>
</div>

<div class="intro-txt">
    <h2>Deep in the heart of Kitengela</h2>
    <p>
        Situated in the heart of Kajiado County, just 20 minutes from Jomo Kenyatta International Airport via the
        Express Way, at an exclusive location with a lot of serenity and with panoramic views of the plains, Conrad
        Resort Kitengela is a tranquil enclave on the doorstep of the Nairobi Metropolitan area.
    </p>
</div>

<div class="showcase-head">
    <h2>Features</h2>
    <div class="showcase">
        <div class="card">
            <img src="{{ asset('images/restaurant1.jpg') }}" alt="">
            <div class="card-info">
                <h3>Enjoy Spectacular Accommodation</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa quas, nesciunt repellat earum
                    facilis
                    voluptate incidunt ex neque tempore tempora inventore reiciendis sit fuga quia autem accusantium
                    sapiente quae! Ipsam adipisci dolores, voluptatum sed aut earum a corporis doloribus eius.
                </p>
            </div>
            <div class="card-footer">
                <a href="">Read More >>></a>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('images/lounge1.jpg') }}" alt="">
            <div class="card-info">
                <h3>Enjoy Spectacular Accommodation</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa quas, nesciunt repellat earum
                    facilis
                    voluptate incidunt ex neque tempore tempora inventore reiciendis sit fuga quia autem accusantium
                    sapiente quae! Ipsam adipisci dolores, voluptatum sed aut earum a corporis doloribus eius.
                </p>
            </div>
            <div class="card-footer">
                <a href="">Read More >>></a>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('images/conference1.jpg') }}" alt="">
            <div class="card-info">
                <h3>Enjoy Spectacular Accommodation</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa quas, nesciunt repellat earum
                    facilis
                    voluptate incidunt ex neque tempore tempora inventore reiciendis sit fuga quia autem accusantium
                    sapiente quae! Ipsam adipisci dolores, voluptatum sed aut earum a corporis doloribus eius.
                </p>
            </div>
            <div class="card-footer">
                <a href="">Read More >>></a>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('images/grounds1.jpg') }}" alt="">
            <div class="card-info">
                <h3>Enjoy Spectacular Accommodation</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa quas, nesciunt repellat earum
                    facilis
                    voluptate incidunt ex neque tempore tempora inventore reiciendis sit fuga quia autem accusantium
                    sapiente quae! Ipsam adipisci dolores, voluptatum sed aut earum a corporis doloribus eius.
                </p>
            </div>
            <div class="card-footer">
                <a href="">Read More >>></a>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('images/bar1.jpg') }}" alt="">
            <div class="card-info">
                <h3>Enjoy Spectacular Accommodation</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa quas, nesciunt repellat earum
                    facilis
                    voluptate incidunt ex neque tempore tempora inventore reiciendis sit fuga quia autem accusantium
                    sapiente quae! Ipsam adipisci dolores, voluptatum sed aut earum a corporis doloribus eius.
                </p>
            </div>
            <div class="card-footer">
                <a href="">Read More >>></a>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('images/room1.jpg') }}" alt="">
            <div class="card-info">
                <h3>Enjoy Spectacular Accommodation</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa quas, nesciunt repellat earum
                    facilis
                    voluptate incidunt ex neque tempore tempora inventore reiciendis sit fuga quia autem accusantium
                    sapiente quae! Ipsam adipisci dolores, voluptatum sed aut earum a corporis doloribus eius.
                </p>
            </div>
            <div class="card-footer">
                <a href="">Read More >>></a>
            </div>
        </div>
    </div>
    <!-- Next and previous buttons -->
    <a class="prev" id="back">&#10094;</a>
    <a class="next" id="forward">&#10095;</a>
</div>

<div class="room-showcase">
    <img src="{{ asset('images/room1.jpg') }}" alt="">
    <div class="book-card">
        <img src="{{ asset('images/Conrad-em-clr.png') }}" alt="logo" class="logo">
        <h2>Awesome Stays On This Side</h2>
        <p>Enjoy picture perfect views as you unwind in our state of the art rooms and packed with a variety of
            amenities</p>
        <a href="{{ route('client.rooms.available') }}">Reserve</a>
    </div>
</div>

<div class="dark-separator"></div>

<div class="gym-showcase text-black font-bold">
    <div class="column">
        <h2 class="text-xl">Conrad Resort Fitness</h2>
        <img src="{{ asset('images/gym1.jpg') }}" alt="">
    </div>
    <div class="column">
        <img src="{{ asset('images/swimming2.jpg') }}" alt="Img">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, voluptatum debitis corporis,
            recusandae
            amet at, doloribus odio fuga nulla et quos assumenda? Quis aut esse amet similique. Commodi, at
            cumque?
        </p>
        <a href="{{ route('client.funfitness') }}">Explore</a>
    </div>
</div>

<div class="bottom-showcase">

    <div class="overlay"></div>
</div>
@endsection