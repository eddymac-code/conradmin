@extends('layouts.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="my-4 p-2">
            <h2>Mpesa Settings</h2>
            <p class="lead">Here, you can edit Mpesa Gateway settings for the hotel.</p>
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
                        <div class="card-header">
                            Obtain Access Token
                        </div>
                        <div class="card-body">
                            <h4 id="access_token" class="my-2"></h4>
                            <button id="getAccessToken" class="btn btn-primary">Request Access Token</button>
                        </div>
                    </div>
    
                    <div class="card mt-5">
                        <div class="card-header">
                            Register URLs
                        </div>
                        <div class="card-body">
                            <div id="response"></div>
                            <button id="registerURLS" class="btn btn-primary">Register URLs</button>
                        </div>
                    </div>
    
                    <div class="card mt-5">
                        <div class="card-header">
                            Simulate Transaction
                        </div>
                        <div class="card-body">
                            <div id="c2b_response"></div>
                            <form action="">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" id="amount" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="account">Account</label>
                                    <input type="text" name="account" id="account" class="form-control">
                                </div>
                            </form>
                            <button id="simulate" class="btn btn-primary mt-2">Simulate Payment</button>
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
        document.getElementById('getAccessToken').addEventListener('click', (event) => {
            event.preventDefault()
            axios.post('/get-token', {})
            .then((response) => {
                console.log(response.data);
                document.getElementById('access_token').innerHTML = response.data
            })
            .catch((error) => {
                console.log(error);
            })
        });


        document.getElementById('registerURLS').addEventListener('click', (event) => {
            event.preventDefault()

            axios.post('register-urls', {})
            .then((response) => {
                if(response.data.ResponseDescription){
                    document.getElementById('response').innerHTML = response.data.ResponseDescription
                } else {
                    document.getElementById('response').innerHTML = response.data.errorMessage
                }
                console.log(response.data);
            })
            .catch((error) => {
                console.log(error);
            })

        });

        document.getElementById('simulate').addEventListener('click', (event) => {
            event.preventDefault()

            const requestBody = {
                amount: document.getElementById('amount').value,
                account: document.getElementById('account').value
            }

            axios.post('/simulate', requestBody)
            .then((response) => {
                if(response.data.ResponseDescription){
                    document.getElementById('c2b_response').innerHTML = response.data.ResponseDescription
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