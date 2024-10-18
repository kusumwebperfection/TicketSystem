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
    url: '{{ route("ticket.search") }}',
    data: formData,
    success: function(response) {

        // Check if there are tickets in the response
        if (response.tickets && response.tickets.length > 0) {
            let fullNameText = '';
            let selectOptions = '';

            // Loop through the tickets to build options and names
            response.tickets.forEach(function(ticket, index) {
                // Add the option for the citation number, mark the first one as selected
                selectOptions += `<option value="${ticket.citation_number}" data-firstname="${ticket.firstname}" data-lastname="${ticket.lastname}" data-price="${ticket.Price}" ${index === 0 ? 'selected' : ''}>
                                    ${ticket.citation_number}
                                  </option>`;

                // Only show the first ticket's details by default
                if (index === 0) {
                    fullNameText = `${ticket.firstname} ${ticket.lastname}`;
                    let price = parseFloat(ticket.Price);
                    let totalPrice = price * 1.10; // Add 10%

                    // Populate name and total details
                    $('#step2Name').text(fullNameText); // Full Name
                    $('#total_price_val').text(`$${totalPrice.toFixed(2)}`); // Total Amount
                }
            });

            // Populate the <select> with citation numbers
            $('#multipleInfoPayment2').html(selectOptions);

            // Change event for citation number selection
            $('#multipleInfoPayment2').change(function() {
                // Get selected option
                let selectedOption = $(this).find('option:selected');

                // Retrieve associated data attributes
                let firstname = selectedOption.data('firstname');
                let lastname = selectedOption.data('lastname');
                let price = parseFloat(selectedOption.data('price'));
                let totalPrice = price * 1.10; // Add 10%

                // Update name and total amount in the UI
                $('#step2Name').text(`${firstname} ${lastname}`); // Update Full Name
                $('#total_price_val').text(`$${totalPrice.toFixed(2)}`); // Update Total Amount
            });
        } else {
            $('#searchResults').html('<div class="alert alert-info">No tickets found.</div>');
        }

        $('#look-up').removeClass('active'); // Hide look-up tab content
        $('#info').addClass('show active'); // Show info tab content
        $('#look-up-tab').removeClass('active'); // Remove active class from look-up tab
        $('#info-tab').addClass('show active'); // Add active class to info tab
        $('#lookup_back_btn').click(
            function(){
                $('#look-up').addClass('show active');
                $('#info').removeClass('active');
                $('#look-up-tab').addClass('show active');
                $('#info-tab').removeClass('active');
            });

        $('#next_payment_info').click(
            function(){
                $('#info').removeClass('active');
                $('#ammount-tab').addClass('show active');
                $('#info-tab').removeClass('active');
                $('#ammount').addClass('show active');
            });
    },
    error: function(xhr) {
        // Handle error response
        $('#searchResults').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
    }
});


        });
    });

    $('input[name="payment_option"]').change(function() {
        if ($(this).val() === 'partial') {
            $('#partialPaymentInput').show(); // Show input for partial payment
        } else {
            $('#partialPaymentInput').hide(); // Hide input if full payment is selected
        }
    });

    // Check if the acknowledgment checkbox is checked when clicking continue
    $('#continuePaymentBtn').click(function() {
        if ($('#acknowledgeCheck').is(':checked')) {
            // Proceed with continuing payment
            alert('Proceeding to the next step...');

            // Optionally hide this tab and show another tab
            // For example, show a "Confirmation" tab (add your logic here)
            $('#ammount-tab').removeClass('show active'); // Hide the current tab
            $('#payment-tab').addClass('show active'); // Show the next tab (replace with your actual next tab ID)
            $('#ammount').removeClass('active');
            $('#payment').addClass('show active');
        
        } else {
            alert('You must acknowledge the terms to continue.');
        }
    });

    // Optionally trigger the change event on page load to set the initial state
    $('input[name="payment_option"]:checked').trigger('change');

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