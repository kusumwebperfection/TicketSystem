<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Optional: Include your CSS -->
</head>
<body>
    <div class="container">
        <h1>{{ $message }}</h1>
        <p>Your payment was processed successfully.</p>
        
        <h2>Payment Details:</h2>
        <ul>
            <li><strong>Amount:</strong> ${{ $details['amount'] }}</li>
            <li><strong>Currency:</strong> {{ $details['currency'] }}</li>
            <li><strong>Transaction ID:</strong> {{ $details['transaction_id'] }}</li> <!-- Show transaction ID if available -->
        </ul>

        <a href="{{ route('home') }}" class="btn btn-primary">Go to Home</a>
    </div>
</body>
</html>
