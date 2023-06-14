@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="my-4 p-2">
            <h2>Mpesa Settings</h2>
            <p class="lead">Here, you can check Transaction Status for the hotel.</p>
        </div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="row">
                <div class="col-sm-8 mx-auto">
                    <div class="row">
                        <div class="col">
                          <a href="{{ route('gateway.settings') }}" class="text-primary fw-bold">Home</a>
                        </div>
                        <div class="col">
                          <a href="{{ route('b2c') }}" class="text-primary fw-bold">Simulate B2C</a>
                        </div>
                        <div class="col">
                          <a href="{{ route('reverse') }}" class="text-primary fw-bold">Reverse Transaction</a>
                        </div>
                        <div class="col">
                          <a href="{{ route('trans-stat') }}" class="text-primary fw-bold">Check Transaction Status</a>
                        </div>
                        <div class="col">
                            <a href="{{ route('stk') }}" class="text-primary fw-bold">STK Push</a>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header">Transaction Status Check</div>
                        <div class="card-body">
                            <div id="c2b_response"></div>
                            <form action="">
                                @csrf
    
                                <div class="form-group">
                                    <label for="transactionid">Transaction ID</label>
                                    <input type="text" name="transactionid" class="form-control" id="transactionid">
                                </div>
                                <button id="status" class="btn btn-primary mt-2">Check Transaction</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div><!-- /.container -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
  @section('footer-scripts')
      <script>
        document.getElementById('status').addEventListener('click', (event) => {
            event.preventDefault()

            const requestBody = {
                transactionid: document.getElementById('transactionid').value
            }

            axios.post('check-status', requestBody)
            .then((response) => {
                if(response.data.Result){
                    document.getElementById('c2b_response').innerHTML = response.data.Result.ResultDesc
                } else {
                    document.getElementById('c2b_response').innerHTML = response.data.errorMessage
                }
            })
            .catch((error) => {
                console.log(error);
            })
        })
      </script>
  @endsection