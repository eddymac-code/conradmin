@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Room Details</h2>
            <p class="lead">Reservation for Room No {{ $roomReservation->room->number }}.</p>
        </div>
        
        <div class="my-2">
            <a href="{{ route('rooms.reservations') }}" class="btn btn-info float-md-end">Go Back</a>
        </div>
        <div class="clearfix"></div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        @if (session('alert'))
            <div class="p-2 my-2 rounded bg-danger text-white text-center fw-bold">
                {{ session('alert') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="card" style="width: 24rem;">
                @if($roomReservation->room->image)
                <img src="{{ asset('storage/images/rooms/'.$roomReservation->room->image) }}" style="background-color:lightgray;max-height: 50vh;object-fit:cover" class="card-img-top" alt="{{ $roomReservation->room->image }} image">
                @endif
                <div class="card-body">
                  <h5 class="card-title">Reference: {{ $roomReservation->reference_number }}</h5>
                  <p class="card-text">Check In: {{ $roomReservation->check_in }} {{ $roomReservation->time_in }}</p>
                  <p class="card-text">Check Out: {{ $roomReservation->check_out }} {{ $roomReservation->time_out }}</p>
                  <p class="card-text">Income: {{ $roomReservation->total_cost }}</p>
                  <div class="mb-2">
                    <p class="card-text">
                        Status: 
                    @if ($roomReservation->status === 0)
                        <span class="badge bg-warning">UNGUARANTEED</span>
                    @else
                        @if($roomReservation->status === 3)
                            <span class="badge bg-danger">CANCELLED</span>
                        @else
                            <span class="badge bg-success">GUARANTEED</span>
                        @endif
                    @endif
                    </p>
                  </div>
                  @if ($roomReservation->status === 0 || $roomReservation->status === 1)
                  @can('reservations.update')
                    <form class="d-inline" action="{{ route('rooms.reservations.cancel', $roomReservation) }}" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger">Cancel</button>
                    </form>
                    @endcan
                  @endif
                  @if ($roomReservation->status === 0)
                  @can('reservations.update')
                    <form class="d-inline" action="{{ route('rooms.reservations.guarantee', $roomReservation) }}" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary">Guarantee</button>
                    </form>
                  @endcan                     
                  @else
                      @if ($roomReservation->status === 3)
                      @can('reservations.delete')
                        <form class="d-inline" action="{{ route('rooms.reservations.delete', $roomReservation) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                      @endcan
                      {{--@else
                       @can('reservations.update')
                        <form class="d-inline" action="{{ route('rooms.reservations.unguarantee', $roomReservation) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" title="This returns the reservation to unsecured/unguaranteed" class="btn btn-warning">Unguarantee</button>
                        </form>
                      @endcan --}}
                      @endif
                  @endif
                </div>
              </div>
        </div>
    </div>
@endsection