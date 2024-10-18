<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
    <link rel="stylesheet" href="{{asset("/assets/css/style.css")}}">
    <link rel="stylesheet" href="{{asset("/assets/css/search/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("/assets/css/search/all.min.css")}}">

</head>
<body>
    <header>
        <div class="container">
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                         <img src="{{ asset('assets/img/logo.png')}}" alt="" width="200px" height="auto" class="d-inline-block align-text-top">
                    </a>
                    <a class="navbar-brand" href="{{url('/search')}}">
                    Search
                    </a>
                    <a class="navbar-brand" href="{{url('/')}}">
                  Create a ticket
                    </a>
                    <div class="d-flex">
                        <img src="{{ asset('assets/img/logo.png')}}" alt="" width="200px" height="auto" class="d-inline-block align-text-top">
                    </div>
                </div>
            </nav>
        </div>
    </header>
    @yield('content')
    <footer>
        <script src="{{asset('/assets/css/search/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('/assets/css/search/popper.min.js')}}"></script>
        <script src="{{asset('/assets/css/search/bootstrap.min.js')}}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
    $(document).ready(function() {
        $('#nextButton').click(function(event) {
            // Prevent default form submission
            event.preventDefault();

            // Clear previous results
            $('#searchResults').empty();

            // Collect form data
            var citationNumber = $('#citation_number').val().trim();
            var firstName = $('#first_name').val().trim();
            var lastName = $('#last_name').val().trim();
            var licensePlate = $('#license_plate').val().trim();

            // Validate that at least one of the required fields is filled
            if (!citationNumber && !(firstName || lastName) && !licensePlate) {
                $('#searchResults').html('<div class="alert alert-warning">Please fill in at least one of the required fields: Citation Number, or both First Name and Last Name, or License Plate Number.</div>');
                return; // Stop the function if validation fails
            }

            var formData = {
                citation_number: citationNumber,
                first_name: firstName,
                last_name: lastName,
                license_plate: licensePlate,
                _token: $('input[name="_token"]').val() // CSRF token
            };
            console.log(formData);

            // AJAX request
            $.ajax({
                type: 'POST',
                url: '{{  route("ticket.search") }}',
                data: formData,
                success: function(response) {
                    // Assume response contains first_name, last_name, price
                    var price = parseFloat(response.price);
                    var totalPrice = price * 1.10; // Add 10%
                    
                    // Fill the response into the info tab
                    $('#step2Name').text(response.first_name + ' ' + response.last_name); // Full Name
                   // $('#ctl00_ContentPlaceHolder_step2NumberLabel1').text('Price:');
                   // $('#ctl00_ContentPlaceHolder_step2Number1').text(`$${price.toFixed(2)}`); // Price
                    $('#ctl00_ContentPlaceHolder_step2NumberLabel2').text('Total Amount (including 10%):');
                    $('#ctl00_ContentPlaceHolder_step2Number2').text(`$${totalPrice.toFixed(2)}`); // Total Amount
                    
                    // Hide look-up tab and show info tab
                    $('#look-up').removeClass('show active'); // Hide look-up tab content
                    $('#info').addClass('show active'); // Show info tab content
                    $('#look-up-tab').removeClass('active'); // Remove active class from look-up tab
                    $('#info-tab').addClass('active'); // Add active class to info tab

                    // Show the amount tab if everything is okay
                   // $('#ammount').removeClass('fade').addClass('show active'); // Show amount tab
                   // $('#ammount-tab').addClass('active'); // Add active class to amount tab

                    // Optionally, you can include logic to confirm if the user is okay with the total price
                },
                error: function(xhr) {
                    // Handle error response
                    $('#searchResults').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                }
            });
        });
    });
</script>


        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p>Copyright © 2024 FivePoint Payments, LLC</p>
                </div>
                <div class="col-lg-6">
                    <p>For search errors, contact the court at 225-389-5279.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>