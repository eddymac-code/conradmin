@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="my-4 p-2">
            <h2> Add Payment</h2>
            <p class="lead">Add payment for reservation: <span class="fw-bold text-primary">{{ $roomReservation->reference_number }}</span></p>
        </div>
        @if (session('message'))
            <div class="p-2 my-2 rounded bg-success text-white text-center fw-bold">
                {{ session('message') }}
            </div> 
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div> 
        @endif
        <div class="p-2">
            <div class="col-md-6">
                <form action="{{ route('rooms.reservations.payment', [$room, $roomReservation]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <h3>Add Payment</h3>
                    </div>
                    <div class="form-group mb-3">
                        <label for="method" class="form-label">Payment Method</label>
                        <select name="method" id="method" class="form-select">
                            <option value=""> --Select-- </option>
                            <option value="mobile">M-Pesa</option>
                            <option value="cash">Cash</option>
                        </select>
                    </div>
                    <div class="form-group mb-3" id="next-div">
                        <label for="method" class="form-label">Confirmation</label>
                        {{-- Input here --}}
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer-scripts')
<script>
    // Get the select element
    const methodSelect = document.getElementById('method');

    // Get the next div element
    const nextDiv = document.getElementById('next-div');

    // Add an event listener for the change event
    methodSelect.addEventListener('change', function() {
        // Clear the content of the next div
        nextDiv.innerHTML = '';

        // Get the selected option value
        const selectedValue = methodSelect.value;

        // Check the selected value and update the next div accordingly
        if (selectedValue === 'mobile') {
            // Create a div element for phone number
            const div = document.createElement('div');
            div.classList.add('form-group', 'mb-3');

            // Create a label for the phone number input
            const label = document.createElement('label');
            label.textContent = 'Phone Number';
            label.setAttribute('for', 'number');
            label.classList.add('form-label');

            // Create an input element for the phone number
            const input = document.createElement('input');
            input.type = 'number';
            input.name = 'phone_number';
            input.id = 'number';
            input.classList.add('form-control');

            // Append the label and input to the div
            div.appendChild(label);
            div.appendChild(input);

            // Append the div to the next div
            nextDiv.appendChild(div);
        } else if (selectedValue === 'cash') {
            // Create a div element for cash confirmation
            const div = document.createElement('div');
            div.classList.add('mb-3', 'form-check');

            // Create an input element for the cash confirmation checkbox
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.classList.add('form-check-input');
            checkbox.name = 'cash_confirm';
            checkbox.id = 'cashConfirm';

            // Create a label for the checkbox
            const label = document.createElement('label');
            label.classList.add('form-check-label');
            label.setAttribute('for', 'cashConfirm');
            label.textContent = 'Have you confirmed cash Payment? (For guaranteeing the reservation)';

            // Append the checkbox and label to the div
            div.appendChild(checkbox);
            div.appendChild(label);

            // Append the div to the next div
            nextDiv.appendChild(div);
        }
    });
</script>
@endsection