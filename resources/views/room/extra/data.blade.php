@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2>Room Extra</h2>
            <p class="lead">Here, you will find all room extra e.g Cots, Extra Beddings</p>
        </div>
        <div class="my-2">
            <a href="{{ route('rooms.extras.create') }}" class="btn btn-primary float-md-end">Add Room Extra</a>
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
                    <th scope="col">NAME</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                    @if ($roomExtras->count() < 1)
                        <tr>
                           <td colspan="5" class="text-center">No Room Extras here yet</td> 
                        </tr>
                    @else
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($roomExtras as $extra)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td><span class="fw-bold">{{ $extra->name }}</span></td>
                                <td><span class="fw-bold">{{ App\Models\Setting::where('setting_key', 'hotel_currency')->first()->setting_value }} {{ number_format($extra->price, 2) }}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bars"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                          {{-- <li><a class="dropdown-item" href="{{ route('rooms.extras.show', $extra) }}">View</a></li> --}}
                                          <li><a class="dropdown-item" href="{{ route('rooms.extras.edit', $extra) }}">Edit</a></li>
                                          <li>
                                            <form action="{{ route('rooms.extras.delete', $extra) }}" method="post">
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
        </div>
    </div>
@endsection