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
                            <h5>asdfghjkl;</h5>
                            <h3>We found the following information</h3>
                        </div>
                    </div>
                </div>
                <div class="bottom-buttons d-flex justify-content-between">
                    <div class="buttons d-flex mt-4">
                        <button type="submit" class="btn">Back</button>
                        <button type="submit" class="btn">Cancel</button>
                    </div>
                    <div class="button d-flex mt-4">
                        <button type="submit" class="btn payment-hsty">Payment History</button>
                        <button type="submit" class="btn next">Next</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="ammount" role="tabpanel" aria-labelledby="ammount-tab">
                <h2><i class="fa-regular fa-credit-card"></i>Payment</h2>
                <p>Please review the payment amount.</p>
                <p>If you wish to pay only a portion of this amount, select partial payment and <br>enter the
                    payment amount at this time.</p>
                <div class="payment-tab d-flex justify-content-between">
                    <div class="payment_ack">
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                I acknowledge that the third party merchant processor for this payment will be Five
                                Point Payments LLC. I acknowledge that the service fee will appear as a separate
                                transaction on my card statement.
                                All payments are final

                            </label>
                        </div>
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                You hereby acknowledge and agree that this is a payment for a judicial related
                                charge that can in no way be disputed, charged back, refunded or recalled. Should
                                this charge be disputed by you without authority, you acknowledge and agree that you
                                will be subject to civil and criminal penalties, including but not limited to, jail
                                time and fines up to $500 per instance, for civil recovery of all fees paid, plus
                                service fees, plus costs, plus attorney fees, plus any incidental or associated
                                damages.
                            </label>
                        </div>
                    </div>
                    <div class="payment_total">
                        <div class="info_box">
                            <hr>
                            <br>
                            <hr>
                            <p>Payment Amount</p>
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Pay in full
                                </label>
                            </div>
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Partial Payment
                                </label>
                            </div>
                            <input type="text">
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
                        <button type="submit" class="btn">Clear</button>
                        <button type="submit" class="btn">Cancel</button>
                    </div>
                    <div class="button-next d-flex mt-4">
                        <button type="submit" class="btn">Continue Payment</button>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                <h2><i class="fa-regular fa-credit-card"></i> Credit Card</h2>
                <p>Please enter the card information to be used for this payment. To receive an email copy of your
                    receipt type your email address in the corresponding text box below.</p>
                <section id="payment_details">
                    <table style="margin-bottom:20px;">
                        <tbody>
                            <tr>
                                <td>
                                    <span id="ctl00_ContentPlaceHolder_lblCardInformationDescription"
                                        class="instructions">Please enter the card information to be used for this
                                        payment.</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <div class="row">


                            <div class="card-nmbr d-flex">
                                <div class="col-6">
                                    <input type="text" placeholder="Card Number">
                                </div>
                                <div class="col-3 me-3">
                                    <select name="ctl00$ContentPlaceHolder$expiration_month" id="expiration_month"
                                        onchange="SetMonthSelection()" data-styled="skip"
                                        class="qa-step4-month placeholderTextboxStep4">
                                        <option value="">M</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select name="ctl00$ContentPlaceHolder$expiration_year" id="expiration_year"
                                        onchange="SetYearSelection()" data-styled="skip" class="qa-step4-year">
                                        <option value="0">Y</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                        <option value="2034">2034</option>
                                        <option value="2035">2035</option>
                                        <option value="2036">2036</option>
                                        <option value="2037">2037</option>
                                        <option value="2038">2038</option>
                                        <option value="2039">2039</option>
                                        <option value="2040">2040</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-grp-name d-flex">
                                <div class="col-6">
                                    <input type="text" placeholder="Name on Card">
                                </div>
                                <div class="col-3 me-3">
                                    <select name="ctl00$ContentPlaceHolder$rcbCreditCardType" id="rcbCreditCardType"
                                        onchange="SetTypeSelection()" data-styled="skip"
                                        class="qa-step4-type placeholderTextboxStep4">
                                        <option value="">Card Type</option>
                                        <option value="Amex">Amex</option>
                                        <option value="Discover">Discover</option>
                                        <option value="MasterCard">MasterCard</option>
                                        <option value="Visa">Visa</option>
                                    </select>
                                </div>
                                <div class=" col-3 form_group_cvv">
                                    <input type="text" placeholder="CVV">
                                </div>
                            </div>
                        </div>



                        <div class="contact-details d-flex">
                            <div class="me-3">
                                <input type="text" placeholder="Billing Zip">
                            </div>
                            <div class="me-3">
                                <input type="text" placeholder="Email" class="me-3">
                            </div>
                            <div class="me-3">
                                <input type="text" placeholder="phone">
                            </div>

                        </div>



                </section>
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Agree to Terms
                    </label>
                </div>
                <div class="bottom-buttons d-flex justify-content-between">
                    <div class="buttons d-flex mt-4">
                        <button type="submit" class="btn">Back</button>
                        <button type="submit" class="btn">Clear</button>
                        <button type="submit" class="btn">Cancel</button>
                    </div>
                    <div class="button d-flex mt-4">
                        <button type="submit" class="btn payment-hsty">Submit Payment</button>
                    </div>
                </div>
            </div>

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