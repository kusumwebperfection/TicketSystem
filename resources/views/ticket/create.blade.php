@extends('layouts/clientview')
@section('content')
<form role="form" method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
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
        <input id="citation-number" type="text" placeholder="Citation Number" class="form-control @error('citation-number') is-invalid @enderror" name="citation-number" value="{{ old('citation-number') }}" required autocomplete="citation-number" autofocus>
            @error('citation-number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
        <input id="license-plate-number" type="text" placeholder="License Plate Number" class="form-control @error('license-plate-number') is-invalid @enderror" name="license-plate-number" value="{{ old('license-plate-number') }}" required autocomplete="license-plate-number" autofocus>
            @error('license-plate-number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
        <input id="total-amount-owed" type="text" placeholder="Total Amount Owed" class="form-control @error('total-amount-owed') is-invalid @enderror" name="total-amount-owed" value="{{ old('total-amount-owed') }}" required autocomplete="total-amount-owed" autofocus>
            @error('total-amount-owed')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
        <input class="form-control @error('ticket-pic') is-invalid @enderror" name="ticket-pic" type="file" id="ticket-pic" accept="image/*">
            @error('ticket-pic')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        
    </div>
    <div class="row justify-content-center">
    <div class="text-center col-md-4">
        <button type="submit" class="btn bg-gradient-dark w-80 my-4 mb-2">Sign up</button>
    </div>
  </div>
</form>
@endsection