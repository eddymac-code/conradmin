@extends('layouts.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="my-4 p-2">
            <h2>Settings</h2>
            <p class="lead">Here, you can edit general settings for the hotel.</p>
        </div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <form action="{{ route('settings.edit') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <div class="row">
                <div class="col-md-6">
                    <label for="name" class="form-label">Hotel Name</label>
                    <input type="text" name="hotel_name" class="form-control" 
                    value="{{ \App\Models\Setting::where('setting_key', 'hotel_name')->first()->setting_value }}">
                </div>
                <div class="col-md-6">
                    <label for="address" class="form-label">Hotel Address</label>
                    <input type="text" name="hotel_address" class="form-control" 
                    value="{{ \App\Models\Setting::where('setting_key', 'hotel_address')->first()->setting_value }}">
                </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                <div class="col-md-6">
                    <label for="country" class="form-label">Hotel Country</label>
                    <input type="text" name="hotel_country" class="form-control" 
                    value="{{ \App\Models\Setting::where('setting_key', 'hotel_country')->first()->setting_value }}">
                </div>
                <div class="col-md-6">
                    <label for="city" class="form-label">Hotel City</label>
                    <input type="text" name="hotel_city" class="form-control" 
                    value="{{ \App\Models\Setting::where('setting_key', 'hotel_city')->first()->setting_value }}">
                </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                <div class="col-md-6">
                    <label for="pcode" class="form-label">Hotel Post Code</label>
                    <input type="text" name="hotel_zip" class="form-control" 
                    value="{{ \App\Models\Setting::where('setting_key', 'hotel_zip')->first()->setting_value }}">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Hotel Email</label>
                    <input type="text" name="hotel_email" class="form-control" 
                    value="{{ \App\Models\Setting::where('setting_key', 'hotel_email')->first()->setting_value }}">
                </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                <div class="col-md-6">
                    <label for="web" class="form-label">Hotel Website</label>
                    <input type="text" name="hotel_website" class="form-control" 
                    value="{{ \App\Models\Setting::where('setting_key', 'hotel_website')->first()->setting_value }}">
                </div>
                <div class="col-md-6">
                    <label for="pin" class="form-label">Hotel KRA Pin</label>
                    <input type="text" name="hotel_pin" class="form-control" 
                    value="{{ \App\Models\Setting::where('setting_key', 'hotel_pin')->first()->setting_value }}">
                </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                <div class="col-md-6">
                    <label for="currency" class="form-label">Currency</label>
                    <input type="text" name="hotel_currency" class="form-control" 
                    value="{{ \App\Models\Setting::where('setting_key', 'hotel_currency')->first()->setting_value }}">
                </div>
                <div class="col-md-6">
                    <label for="symbol" class="form-label">Currency Symbol</label>
                    <input type="text" name="currency_symbol" class="form-control" 
                    value="{{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}">
                </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                <div class="col-md-6">
                    <label for="position" class="form-label">Currency Position</label>
                    <select class="form-select" name="currency_position" aria-label="Select currency position">
                    <option> --Select-- </option>
                    <option value="left" @if( \App\Models\Setting::where(
                        'setting_key', 'currency_position')->first()->setting_value == 'left') selected @endif>
                        Left
                    </option>
                    <option value="right" @if( \App\Models\Setting::where(
                        'setting_key', 'currency_position')->first()->setting_value == 'right') selected @endif>
                        Right
                    </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" name="hotel_logo" class="form-control">
                </div>
                </div>
                @if( \App\Models\Setting::where('setting_key', 'hotel_logo')->first()->setting_value !== '')
                <div class="col-md-6 float-end py-2 px-4">
                    <img style="height:50px;width:50px" class="rounded" 
                    src="{{ asset('/storage/images/general/'. \App\Models\Setting::where('setting_key', 'hotel_logo')->first()->setting_value) }}" alt="">
                </div>
                <div class="clearfix"></div>
                @endif
            </div>
            <button type="submit" class="mb-3 btn btn-primary float-end">Update</button>
            </form>
        </div>
      </div><!-- /.container -->
    </section>
    <!-- /.content -->
  </div>
@endsection