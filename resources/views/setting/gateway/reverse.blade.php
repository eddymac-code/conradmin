@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="my-4 p-2">
            <h2>Mpesa Settings</h2>
            <p class="lead">Here, you can reverse mpesa transactions for the hotel.</p>
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
                        <div class="card-header">Reverse Transaction</div>
                        <div class="card-body">
                            <div id="c2b_response"></div>
                            <form action="">
                                @csrf
                                <div class="form-group">
                                    <label for="transactionid">Transaction ID</label>
                                    <input type="text" name="transactionid" class="form-control" id="transactionid">
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" class="form-control" id="amount">
                                </div>
                                <button id="reverse" class="btn btn-primary mt-2">Reverse Transaction</button>
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
        document.getElementById('reverse').addEventListener('click', (event) => {
            event.preventDefault()

            const requestBody = {
                transactionid: document.getElementById('transactionid').value,
                amount: document.getElementById('amount').value,
            }

            axios.post('reversal', requestBody)
            .then((response) => {
                if(response.data){
                    document.getElementById('c2b_response').innerHTML = response.data.ResultDescription
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