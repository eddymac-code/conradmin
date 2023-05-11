@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Rooms</h2>
            <p class="lead">Info for all hotel rooms at a glance.</p>
        </div>
        
        <div class="my-2">
            <a href="{{ route('rooms.create') }}" class="btn btn-primary float-md-end">Add Room</a>
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
                    <th scope="col">TYPE</th>
                    <th scope="col">NUMBER</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                    @if ($rooms->count() < 1)
                        <tr>
                           <td colspan="6" class="text-center">No Rooms here yet</td> 
                        </tr>
                    @else
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($rooms as $room)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td><span class="fw-bold">{{ $room->roomType->name }}</span></td>
                                <td><span class="fw-bold">{{ $room->number }}</span></td>
                                <td>
                                    <span class="fw-bold">
                                        @if (\App\Models\Setting::where('setting_key', 'currency_position')->first()->setting_value == 'left')
                                            {{ \App\Models\Setting::where('setting_key', 'hotel_currency')->first()->setting_value }} {{ number_format($room->price, 2) }}
                                        @else
                                            {{ number_format($room->price, 2) }} {{ \App\Models\Setting::where('setting_key', 'hotel_currency')->first()->setting_value }}
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    @if ($room->status == '0')
                                        <span class="badge bg-primary">AVAILABLE</span>
                                    @else
                                        <span class="badge bg-success">OCCUPIED</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bars"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="{{ route('rooms.show', $room) }}">View</a></li>
                                          <li><a class="dropdown-item" href="{{ route('rooms.edit', $room) }}">Edit</a></li>
                                          <li>
                                            <form action="{{ route('rooms.delete', $room) }}" method="post">
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
                {{ $rooms->links() }}
              </div>
        </div>
    </div>
@endsection