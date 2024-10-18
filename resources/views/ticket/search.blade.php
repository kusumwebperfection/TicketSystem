@extends('layouts/clientview')
@section('title', 'Create Ticket')
@section('breadcrumbs')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Create Ticket</li>
</ol>
@endsection
@section('content')
<section>
    <div class="container p-5 d-flex align-items-start">
        <ul class="nav nav-pills flex-column nav-pills  me-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link text-primary fw-semibold active position-relative" id="look-up-tab">
                    <span class="step">Step</span><br>
                    <span class="step_number">1</span><br>
                    Look up
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-primary fw-semibold position-relative" id="info-tab">
                    <span class="step">Step</span><br>
                    <span class="step_number">2</span><br>
                    Info
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-primary fw-semibold position-relative" id="ammount-tab">
                    <span class="step">Step</span><br>
                    <span class="step_number">3</span><br>
                    Amount
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-primary fw-semibold position-relative" id="payment-tab">
                    <span class="step">Step</span><br>
                    <span class="step_number">4</span><br>
                    Payment
                </button>
            </li>
            <li class="nav-item last" role="presentation">
                <button class="nav-link text-primary fw-semibold position-relative" id="reciept-tab">
                    <span class="step">Step</span><br>
                    <span class="step_number">5</span><br>
                    Receipt
                </button>
            </li>
        </ul>
        <div class="tab-content rounded-3 p-3  w-100" id="pills-tabContent">
            <div class="tab-pane fade show active" id="look-up" role="tabpanel" aria-labelledby="look-up-tab">
                <h2><i class="fa-regular fa-bell"></i> Baton Rouge City Court</h2>
                <form id="searchForm">
                    @csrf
                    <div class="mb-3">
                        <label for="citation_number" class="form-label">Search by Citation Number:</label>
                        <input type="text" class="form-control" id="citation_number" name="citation_number" placeholder="Citation Number">
                    </div>

                    <div class="fw-bold text-center ortext">OR</div>

                    <div class="mb-3">
                        <label for="first_name" class="form-label">Search by:</label>
                        <input type="text" class="form-control mb-2" name="first_name" id="first_name" placeholder="First Name">
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
                    </div>

                    <div class="fw-bold text-center ortext">OR</div>

                    <div class="mb-3">
                        <label for="license_plate" class="form-label">Search by:</label>
                        <input type="text" class="form-control" id="license_plate" name="license_plate" placeholder="License Plate Number">
                    </div>

                    <div class="bottom-buttons d-flex justify-content-between">
                        <div class="buttons d-flex mt-4">
                            <button type="reset" class="btn btn-secondary">Clear</button>
                            <button type="button" class="btn btn-danger" onclick="window.history.back()">Cancel</button>
                        </div>
                        <div class="button-next d-flex mt-4">
                            <button type="button" class="btn btn-primary" id="nextButton">Next</button>
                        </div>
                    </div>
                </form>

                <div id="searchResults" class="mt-4"></div>

               
               

            </div>
            <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                <h2><i class="fa-regular fa-user"></i> Confirm Your Information</h2>
                <p>Please confirm the following information in order to make a payment.</p>
                <div class="payment_info d-flex justify-content-between">
                    <div class="info-left">
                        <h2>Payment Information</h2>
                        <div id="ctl00_ContentPlaceHolder_step2Integrated">
                            <table style="margin-bottom:40px">
                                <tbody>
                                    <tr>
                                        <td id="ctl00_ContentPlaceHolder_step2NumberLabel1" class="label"></td>

                                        <td id="ctl00_ContentPlaceHolder_step2Number1"></td>

                                    </tr>
                                    <tr>
                                        <td id="ctl00_ContentPlaceHolder_step2NumberLabel2" class="label"></td>

                                        <td id="ctl00_ContentPlaceHolder_step2Number2"></td>

                                    </tr>
                                    <tr>
                                        <td id="ctl00_ContentPlaceHolder_step2NumberLabel3" class="label"></td>

                                        <td id="ctl00_ContentPlaceHolder_step2Number3"></td>

                                    </tr>
                                    <tr>
                                        <td class="label">Name:</td>
                                        <td id="step2Name" class="qa-step2-name"></td>

                                    </tr>
                                    <tr>
                                        <td class="label">Address:</td>
                                        <td id="ctl00_ContentPlaceHolder_step2Address" class="qa-step2-address">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="label">City, State:</td>
                                        <td id="ctl00_ContentPlaceHolder_step2State" class="qa-step2-citystate">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="label">Zip:</td>
                                        <td id="ctl00_ContentPlaceHolder_step2Zip" class="qa-step2-zip"></td>

                                    </tr>
                                </tbody>
                            </table>
                            <table>
                                <tbody>
                                    <tr id="ctl00_ContentPlaceHolder_multipleInfoPaymentContainer">
                                        <td style="padding-top:20px">
                                            <h3>We have found the following</h3>
                                            <div style="width:100%" class="style_select">
                                                <select name="ctl00$ContentPlaceHolder$multipleInfoPayment2"
                                                    id="multipleInfoPayment2" onchange="SetSelection()"
                                                    style="display:block" data-styled="skip"
                                                    class="qa-step2-cases"></select>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="info-right">
                        <h3>Review Payment</h3>
                        <div class="info-box">
                            <h5>Total:<span id="total_price_val"></span> </h5>
                            <h3>We found the following information</h3>
                        </div>
                    </div>
                </div>
                <div class="bottom-buttons d-flex justify-content-between">
                    <div class="buttons d-flex mt-4">
                        <button type="submit" class="btn" id="lookup_back_btn">Back</button>
                        <button type="submit" class="btn">Cancel</button>
                    </div>
                    <div class="button d-flex mt-4">
                        <button type="submit" class="btn payment-hsty">Payment History</button>
                        <button type="submit" class="btn next" id="next_payment_info">Next</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="ammount" role="tabpanel" aria-labelledby="ammount-tab">
    <h2><i class="fa-regular fa-credit-card"></i>Payment</h2>
    <p>Please review the payment amount.</p>
    <p>If you wish to pay only a portion of this amount, select partial payment and <br>enter the payment amount at this time.</p>
    
    <div class="payment-tab d-flex justify-content-between">
        <div class="payment_ack">
            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" value="" id="acknowledgeCheck">
                <label class="form-check-label" for="acknowledgeCheck">
                    I acknowledge that the third-party merchant processor for this payment will be Five Point Payments LLC. 
                    I acknowledge that the service fee will appear as a separate transaction on my card statement. All payments are final.
                </label>
            </div>
            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" value="" id="disputeCheck" checked>
                <label class="form-check-label" for="disputeCheck">
                    You hereby acknowledge and agree that this is a payment for a judicial-related charge that can in no way be disputed, charged back, refunded, or recalled. Should this charge be disputed by you without authority, you acknowledge and agree that you will be subject to civil and criminal penalties, including but not limited to jail time and fines up to $500 per instance, for civil recovery of all fees paid, plus service fees, plus costs, plus attorney fees, plus any incidental or associated damages.
                </label>
            </div>
        </div>

        <div class="payment_total">
            <div class="info_box">
                <hr>
                <br>
                <hr>
                <p>Payment Amount</p>
                
                <!-- Radio Button for Pay in Full -->
                <div class="form-check mt-4">
                    <input class="form-check-input" type="radio" name="payment_option" value="full" id="payInFull" checked>
                    <label class="form-check-label" for="payInFull">Pay in Full</label>
                </div>

                <!-- Radio Button for Partial Payment -->
                <div class="form-check mt-4">
                    <input class="form-check-input" type="radio" name="payment_option" value="partial" id="partialPayment">
                    <label class="form-check-label" for="partialPayment">Partial Payment</label>
                </div>

                <!-- Input field for Partial Payment -->
                <div id="partialPaymentInput" class="mt-2" style="display: none;">
                    <input type="text" placeholder="Enter partial payment amount" class="form-control">
                </div>

                <hr>
                <br>
                <hr>
                <p>Service Fee</p>
                <p>Total</p>
            </div>
        </div>
    </div>

    <div class="bottom-buttons d-flex justify-content-between">
        <div class="buttons d-flex mt-4">
            <button type="button" class="btn" id="clearBtn">Clear</button>
            <button type="button" class="btn" id="cancelBtn">Cancel</button>
        </div>
        <div class="button-next d-flex mt-4">
            <button type="button" class="continue_payment_btn" id="continuePaymentBtn">Continue Payment</button>
        </div>
    </div>
</div>


          <!-- HTML Structure for Tabs -->

<div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
    <h2><i class="fa-regular fa-credit-card"></i> Credit Card</h2>
    <p>Please enter the card information to be used for this payment. To receive an email copy of your receipt type your email address in the corresponding text box below.</p>
    
    <form id="payment-form">
        <div id="card-element"><!-- A Stripe Element will be inserted here. --></div>
        <div id="card-errors" role="alert"></div>
        <div class="contact-details d-flex">
            <div class="me-3">
                <input type="text" placeholder="Billing Zip" id="billing_zip">
            </div>
            <div class="me-3">
                <input type="text" placeholder="Email" id="email">
            </div>
            <div class="me-3">
                <input type="text" placeholder="Phone" id="phone">
            </div>
        </div>
        <div class="form-check mt-4">
            <input class="form-check-input" type="checkbox" value="" id="agreeToTerms">
            <label class="form-check-label" for="agreeToTerms">
                Agree to Terms
            </label>
        </div>
        <div class="bottom-buttons d-flex justify-content-between">
            <div class="buttons d-flex mt-4">
                <button type="button" class="btn" id="backButton">Back</button>
                <button type="button" class="btn" id="clearButton">Clear</button>
                <button type="button" class="btn" id="cancelButton">Cancel</button>
            </div>
            <div class="button d-flex mt-4">
                <button type="submit" class="btn payment-hsty" id="submitPayment">Submit Payment</button>
            </div>
        </div>
    </form>
</div>


<!-- JavaScript for Tab Navigation and Payment Processing -->
<script src="https://js.stripe.com/v3/"></script>
<script>
$(document).ready(function() {
    // Initialize Stripe
    const stripe = Stripe('pk_test_51OZ7C0SJ3O9KIwQxB61lqe21YTrpypU192hFMYVCdCklOZictUprquAgUTzW47iOr2GlohS4YY4rcdnGGIVIZdNS00SnCqeCnc'); // Replace with your public Stripe key
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element'); // Ensure you have this div in your payment tab

    // Handle tab navigation
    $('.continue_payment_btn').click(function() {
        if ($('#acknowledgeCheck').is(':checked')) {
            $('#ammount').removeClass('show active');
            $('#payment').addClass('show active');
        } else {
            alert('You must acknowledge the terms to continue.');
        }
    });

    $('.back_btn').click(function() {
        $('#payment').removeClass('show active');
        $('#ammount').addClass('show active');
    });

    // Handle Submit Payment button click
    $('.payment-hsty').click(async function(e) {
        e.preventDefault();

        if (!$('#agreeToTerms').is(':checked')) {
            alert('You must agree to the terms to continue.');
            return; // Stop execution if terms are not agreed to
        }

        // Create a payment method with Stripe
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
        });

        if (error) {
            // Display error.message in your UI.
            document.getElementById('card-errors').textContent = error.message;
        } else {
            // Gather additional input data
            const billingZip = $('#billing_zip').val();
            const email = $('#email').val();
            const phone = $('#phone').val();

            // Submit the payment method to your server
            $.ajax({
                type: 'POST',
                url: '{{ route("payment.process") }}', // Update this route according to your setup
                data: {
                    payment_method_id: paymentMethod.id,
                    billing_zip: billingZip,
                    email: email,
                    phone: phone,
                    _token: '{{ csrf_token() }}' // CSRF token for security
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        // Redirect or show confirmation
                        // Optionally hide this tab and show another tab
                        $('#payment').removeClass('show active');
                        $('#payment-tab').removeClass('show active'); 
                        $('#reciept-tab').addClass('show active'); 
                        $('#reciept').addClass('show active'); 
                         // Replace with your actual next tab ID
                    } else {
                        alert('Payment failed: ' + response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while processing your payment. Please try again.');
                }
            });
        }
    });
});
</script>


            <div class="tab-pane fade" id="reciept" role="tabpanel" aria-labelledby="reciept-tab">
                <h2><i class="fa-solid fa-file-invoice"></i> Receipt</h2>
                <p><span style="color: #c42227;">You made a payment of USD</span></p>
                <p>Below is a copy of your receipt. If you have any questions you can e-mail us at <a href="#"><span style="color: #c42227;">support@fivepointpayments.com.</span></a></p>

                <div class="d-flex">
                    <div class="row">
                        <div class="col-6">
                            <section id="payment_receipt">
                                <h3>Payment Information</h3>
                                <hr>
                                <div class="table_wrapper">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="label">Transaction Id:</td>
                                                <td style="font-weight:normal !important" class="qa-step5-transactionid"></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Payment Date:</td>
                                                <td style="font-weight:normal !important" class="qa-step5-paymentdate"></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Payment Method:</td>
                                                <td style="font-weight:normal !important">Credit Card</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="table_wrapper">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="label">Name:</td>
                                                <td style="font-weight:normal !important" class="qa-step5-name"></td>
                                            </tr>
                                            <tr>
                                                <td id="step4number1Label" class="label"></td>
                                                <td id="step4number1" style="font-weight:normal !important" class="qa-step5-label1"></td>
                                            </tr>
                                            <tr>
                                                <td id="step4number2Label" class="label"></td>
                                                <td id="step4number2" style="font-weight:normal !important" class="qa-step5-label2"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                        <div class="col-6">
                            <section id="cardholder_info">
                                <h3>Cardholder Information</h3>
                                <hr>
                                <div class="table_wrapper">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="label">Name:</td>
                                                <td style="font-weight:normal !important" class="qa-step5-cardholdername"></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Billing Zip Code:</td>
                                                <td style="font-weight:normal !important" class="qa-step5-zip"></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Card Number:</td>
                                                <td style="font-weight:normal !important" class="qa-step5-number">XXXX XXXX XXXX </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table_wrapper">
                                    <table>

                                        <tbody>
                                            <tr>
                                                <td class="label">Payment Amount:</td>
                                                <td style="font-weight:normal !important" class="qa-step5-amount"></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Service Fee:</td>
                                                <td style="font-weight:normal !important"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="table_wrapper">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="label">Total Charges:</td>
                                                <td><strong> <span id="ctl00_ContentPlaceHolder_partial_payment_asterisk" style="display:none">*</span></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <input type="hidden" class="qa-step5-charge" value="">
                                <input type="hidden" class="qa-step5-fee" value="">
                                <input type="hidden" class="qa-step5-total" value="">
                            </section>

                        </div>
                    </div>

                </div>
                <div class="printControlDiv d-flex mt-4">
                    <div class="me-3">
                        <p><i class="fa-solid fa-print"></i> Print</p>
                    </div>
                    <div class="me-3">
                        <p><i class="fa-regular fa-envelope"></i> Email</p>
                    </div>
                    <div class="me-3">
                        <p><i class="fa-solid fa-phone"></i> Text</p>
                    </div>
                    <div class="me-3">
                        <p><i class="fa-solid fa-download"></i> Download PDF</p>
                    </div>
                </div>
                <div class="bottom-buttons d-flex justify-content-between">
                    <div class="">
                        <button type="submit" class="btn"></button>
                        <button type="submit" class="btn"></button>
                        <button type="submit" class="btn"></button>
                    </div>
                    <div class="button d-flex mt-4">
                        <button type="submit" class="btn finish-payment">Finish Payment</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</section>
@endsection