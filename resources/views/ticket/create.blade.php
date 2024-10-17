
@extends('layouts/clientview')
@section('title', 'Create Ticket')
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Create Ticket</li>
    </ol>
@endsection
@section('content')
<div class="container w-50">
    <div class="mt-4">
        <h2>Create Ticket</h2>
    </div>


<form role="form" method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row mt-5">
        <div class="col-md-6 mb-3">
        <input id="firstname" type="text" placeholder="Firstname" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
            @error('firstname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
        <input id="lastname" type="text" placeholder="Lastname" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
            @error('lastname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
        <input id="citation-number" type="text" placeholder="Citation Number" class="form-control @error('citation_number') is-invalid @enderror" name="citation_number" value="{{ old('citation_number') }}" required autocomplete="citation_number" autofocus>
            @error('citation_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
        <input id="license-plate-number" type="text" placeholder="License Plate Number" class="form-control @error('license_plate_number') is-invalid @enderror" name="license_plate_number" value="{{ old('license_plate_number') }}" required autocomplete="license_plate_number" autofocus>
            @error('license_plate_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
        <input id="total-amount-owed" type="text" placeholder="Total Amount Owed" class="form-control @error('total_amount_owed') is-invalid @enderror" name="total_amount_owed" value="{{ old('total_amount_owed') }}" required autocomplete="total_amount_owed" autofocus>
            @error('total_amount_owed')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
        <input class="form-control @error('ticket_pic') is-invalid @enderror" name="ticket_pic" type="file" id="ticket-pic" accept="image/*">
            @error('ticket_pic')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        
    </div>
    <div class="row justify-content-center">
    <div class="text-center col-md-4">
        <button type="submit" class="btn bg-gradient-dark w-80 my-4 mb-2">Submit Ticket</button>
    </div>
  </div>
</form>
</div>
@if (session('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 3000, // Duration in milliseconds
            gravity: "top", // `top` or `bottom`
            position: 'right', // `left`, `center` or `right`
            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Background color
            stopOnFocus: true, // Prevents dismissing of toast on hover
            onClick: function(){} // Callback after click
        }).showToast();
    </script>
@endif
@endsection