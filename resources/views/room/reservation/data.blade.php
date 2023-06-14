@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Rooms</h2>
            <p class="lead">Info for all hotel reservations at a glance.</p>
        </div>
        
        <div class="my-2">
            <a href="{{ route('rooms') }}" class="btn btn-primary float-md-end">View Available Rooms</a>
        </div>
        <div class="clearfix"></div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">REFERENCE</th>
                    <th scope="col">SOURCE</th>
                    <th scope="col">ROOM</th>
                    <th scope="col">GUEST</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                    @if ($reservations->count() < 1)
                        <tr>
                           <td colspan="7" class="text-center">No Reservations here yet</td> 
                        </tr>
                    @else
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($reservations as $reservation)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td><span class="fw-bold">{{ $reservation->reference_number }}</span></td>
                                <td><span class="fw-bold">{{ $reservation->source }}</span></td>
                                <td><span class="fw-bold">{{ $reservation->room->number }}</span></td>
                                <td><span class="fw-bold">{{ $reservation->guest_name }}</span></td>
                                <td>
                                    @if ($reservation->status === 0)
                                        <span class="badge bg-warning">UNGUARANTEED</span>
                                    @else
                                        @if($reservation->status === 3)
                                            <span class="badge bg-danger">CANCELLED</span>
                                        @else
                                            <span class="badge bg-success">GUARANTEED</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bars"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="{{ route('rooms.reservations.show', $reservation) }}">View</a></li>
                                          <li><a class="dropdown-item" href="{{ route('rooms.reservations.edit', $reservation) }}">Edit</a></li>
                                          <li>
                                            <form action="{{ route('rooms.reservations.delete', $reservation) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-decoration-none" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                          </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
              </table>
              <div class="d-flex">
                {{ $reservations->links() }}
              </div>
        </div>
    </div>
@endsection