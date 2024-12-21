@include('front.includes.header')
<style type="text/css">
.wallet_apply{
    border: none;
    background-color: inherit;
    color: #0040E6;
}
</style>
<!-- Shop Cart Area -->
<section class="pt40 pb0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h2 class="title">Checkout</h2>
                    <!-- <p class="text mb-0">Give your visitor a smooth online experience with a solid UX design</p> -->
                </div>
            </div>
        </div>
    </div>
</section>

@php

    //echo "<pre>";print_r(Session::get('user'));echo "</pre>";

    $userdata = Session::get('user');

    if ($userdata != '') {
        $login_style = 'display:none';
        $form_sec = 'display:block';
    } else {
        $login_style = 'display:block';
        $form_sec = 'display:none';
    }
@endphp

<section class="our-login" style="padding-top: 0; {{ $login_style }}">
    <div class="container">

        <form action="{{ route('user_login') }}" id="category_form" method="post">
            @csrf
            <div class="row wow fadeInRight" data-wow-delay="300ms">
                <div class="col-xl-6 mx-auto">
                    <div class="log-reg-form search-modal form-style1 bgc-white p50 p30-sm default-box-shadow1 bdrs12">
                        <div class="mb30">
                            {{-- <h4>We're glad to see you again!</h4> --}}
                            {{-- <p class="text">Don't have an account? <a href="{{ url('Sign-Up') }}"
                                  class="text-thm">Sign
                                  Up!</a></p> --}}
                        </div>
                        <div class="mb20">
                            <label class="form-label fw600 dark-color">Email Address</label>
                            <input type="text" id="email" name="email" class="form-control"
                                placeholder="Enter Email Address">
                            <p class="form-error-text" id="email_error" style="color: red; margin-top: 10px;">
                            </p>
                        </div>
                        <div class="mb15">
                            <label class="form-label fw600 dark-color">Password</label>
                            <input type="password"id="password" name="password" class="form-control"
                                placeholder="Enter Password">
                            <p class="form-error-text" id="password_error" style="color: red; margin-top: 10px;">
                            </p>
                        </div>
                        <span id="contact_error_login" class="error alert-message valierror "
                            style="display: none;"></span>
                        <div class="checkbox-style1 d-block d-sm-flex align-items-center justify-content-between mb20">
                            <label class="custom_checkbox fz14 ff-heading">Remember me
                                <input type="checkbox" checked="checked">
                                <span class="checkmark"></span>
                            </label>
                            <a class="fz14 ff-heading" href="{{ url('forget-password') }}">Lost your password?</a>
                        </div>
                        <div class="d-grid mb20">
                            <button class="btn btn-primary mb-1" type="button" disabled id="spinner_button"
                                style="display: none;">

                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>

                                Loading...

                            </button>
                            <button type="button" class="ud-btn btn-thm" onclick="javascript:category_validation()"
                                id="submit_button">Submit</button>

                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="shop-checkout pt-0" style="{{ $form_sec }}">
    <div class="container">
        @php
            $userData = Session::get('user');
        @endphp
        @if (Cart::count() > 0)
            <form class="checkout-form" id="addressForm" name="addressForm" method="POST"
                action="{{ route('order_place') }}">
                @csrf
                <input type="hidden" name="wallet_amt_apply" id="wallet_amt_apply" value="">
                <div class="row wow fadeInUp" data-wow-delay="300ms">

                    <div class="col-md-7 col-lg-8">
                        <div class="checkout_form">
                            <h4 class="title mb30">Customer Details</h4>
                            <div class="checkout_coupon">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb25">
                                            <h6 class="mb15">First Name</h6>
                                            <input class="form-control" type="text" name="fname" id="fname"
                                                placeholder="Enter First Name"
                                                @if ($userData['name'] != '') value="{{ $userData['name'] }}" @endif>
                                            <p class="form-error-text" id="fname_error" style="color: red;"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb25">
                                            <h6 class="mb15">Last Name</h6>
                                            <input class="form-control" type="text" name="lname" id="lname"
                                                placeholder="Enter Last Name">
                                            <p class="form-error-text" id="lname_error" style="color: red;"></p>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb25">
                                            <h6 class="mb15">Country / Region <span style="color: red">*</span></h6>
                                            <div class="">
                                                <select class="form-control search_country" name="country" id="country"
                                                    onchange="ship_country_change(this.value);">
                                                    <option value="">Select Country / Region</option>
                                                    @if (isset($country))
                                                        @foreach ($country as $country_data)
                                                            <option value="{{ $country_data->id }}"
                                                                {{ $country_data->id == 22 ? 'selected' : '' }}>
                                                                {{ $country_data->country }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <p class="form-error-text" id="country_error" style="color: red;">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb25">
                                            <h6 class="mb15">House number / Street name <span
                                                    style="color: red">*</span></h6>
                                            <input class="form-control" type="text"
                                                placeholder="Enter House number and street name" name="address1"
                                                id="address1">
                                            <p class="form-error-text" id="address1_error" style="color: red;"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb25">
                                            <h6 class="mb15">Apartment, suite, unit, etc. <span
                                                    style="color: red">*</span></h6>
                                            <input class="form-control" name="optional" id="optional"
                                                type="text" placeholder="Enter Apartment, suite, unit, etc.">
                                            <p class="form-error-text" id="optional_error" style="color: red;"></p>

                                        </div>
                                    </div>
                                    <?php
                                    
                                    $defaultCountryId = 22;
                                    ?>
                                    <div class="col-lg-12" id="stateDiv"
                                        style="{{ $defaultCountryId == 22 ? 'display: none;' : '' }}">
                                        <div class="mb25">
                                            <h6 class="mb15">State</h6>
                                            <div class="">
                                                <span id="state_data">
                                                    <select class="form-control" name="state_name" id="state_name">
                                                        <option value="">Select State</option>
                                                    </select>
                                                </span>
                                                <p class="form-error-text" id="state_name_error" style="color: red;">
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb25">
                                            <h6 class="mb15">Town / City</h6>
                                            <div class="">
                                                <span id="city_data">
                                                    <select class="form-control" name="city" id="city">
                                                        <option value="">Select Town / City</option>

                                                    </select>
                                                </span>
                                                <p class="form-error-text" id="city_error" style="color: red;"></p>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-sm-12" id="zipcodeDiv">
                                        <div class="mb25">
                                            <h6 class="mb15">ZIP</h6>
                                            <input class="form-control" type="text" placeholder="Enter ZIP"
                                                name="zipcode" id="zipcode">
                                            {{-- <p class="form-error-text" id="zipcode_error" style="color: red;"></p> --}}
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb25">
                                            <h6 class="mb15">Phone <span style="color: red">*</span></h6>
                                            <input class="form-control" type="number" placeholder="Enter Phone"
                                                name="phone" id="phone"
                                                @if ($userData['mobile'] != '') value="{{ $userData['mobile'] }}" @endif>
                                            <p class="form-error-text" id="phone_error" style="color: red;"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb25">
                                            <h6 class="mb15">Email Address <span style="color: red">*</span></h6>
                                            <input class="form-control" type="email_ship"
                                                placeholder="Enter Email Address" name="email_ship" id="email_ship"
                                                @if ($userData['email'] != '') value="{{ $userData['email'] }}" @endif>
                                            <p class="form-error-text" id="email_ship_error" style="color: red;"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb25">
                                            <h4 class="mb15" class="mb15">Additional information</h4>
                                            <h6>Order Notes (optional)</h6>
                                            <textarea name="additional_message" id="additional_message" class="" rows="7"
                                                placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <div class="shop-sidebar ms-md-auto">
                            <div class="order_sidebar_widget mb30 default-box-shadow1">
                                <h4 class="title">Your Order</h4>
                                <ul class="p-0 mb-0">
                                    <li class="bdrb1 mb20">
                                        <h6>Package <span class="float-end">Subtotal</span></h6>
                                    </li>
                                    @if (Cart::count() > 0)
                                        @php
                                            $subtotal = 0;
                                        @endphp

                                        @foreach (Cart::content() as $items)
                                            @php

                                                if ($items->options->discount_type != '') {
                                                    if ($items->options->discount_type == 0) {
                                                        //percentage
                                                        $disc_price_new =
                                                            ($items->price * $items->options->discount) / 100;

                                                        $disc_price = $items->price - $disc_price_new;

                                                        $p_price = $disc_price;
                                                    } elseif ($items->options->discount_type == 1) {
                                                        $disc_price = $items->price - $items->options->discount;
                                                        $p_price = $disc_price;
                                                    } else {
                                                        $disc_price = '0';
                                                        $p_price = $items->price;
                                                    }
                                                } else {
                                                    $disc_price = '0';
                                                }
                                            @endphp

                                            @php
                                                if ($disc_price != '0') {
                                                    $price_tot = round($disc_price);
                                                } else {
                                                    $price_tot = round($items->price);
                                                }
                                            @endphp
                                            <li class="mb20">
                                                <p class="body-color">{{ $items->name }} x{{ $items->qty }} <span
                                                        class="float-end">AED {{ $price_tot * $items->qty }}</span>
                                                </p>
                                            </li>


                                            @php
                                                if ($items->qty >= 1) {
                                                    $subtotal += $items->qty * round($p_price);
                                                } else {
                                                    $subtotal += round($p_price);
                                                }
                                            @endphp
                                        @endforeach
                                    @endif

                                    @php
                                        $sub_total_round = round($subtotal);

                                        $coupon_discounted = 0;

                                        if (
                                            session('coupan_data.discount') != '' &&
                                            session('coupan_data.coupanvalue') == 0
                                        ) {
                                            $coupon_discounted = round(
                                                ($subtotal * session('coupan_data.discount')) / 100,
                                            );
                                        }

                                        if (
                                            session('coupan_data.discount') != '' &&
                                            session('coupan_data.coupanvalue') == 1
                                        ) {
                                            $coupon_discounted = session('coupan_data.discount');
                                        }
                                        $shippingcahrge = 0;

                                        $vatcharge = round(($subtotal * 5) / 100);
                                        // $vatcharge = 10;

                                        $order_total = round(
                                            $sub_total_round - $coupon_discounted + $shippingcahrge + $vatcharge,
                                        );

                                        session(['subtotal' => $sub_total_round]);
                                        session(['shippingcahrge' => $shippingcahrge]);
                                        session(['order_total' => $order_total]);
                                        session(['vatcharge' => $vatcharge]);
                                    @endphp

                                    @php

                                    $userId = Session::get('user')['userid'];
                                     $wallet_plus_amount = DB::table('front_user_wallet')
                                        ->where('refer_id', $userData['userid'])
                                        ->where('added_from',0)
                                        ->sum('wallet_amount');

                                    $wallet_minus_amount = DB::table('front_user_wallet')
                                        ->where('refer_id', $userData['userid'])
                                        ->where('added_from',1)
                                        ->sum('order_total');

                                    $plusAmountWallet = $wallet_plus_amount ?? 0;
                                    $minusAmountWallet = $wallet_minus_amount ?? 0;

                                    $total_wallet_amount = max($plusAmountWallet - $minusAmountWallet, 0);
                                    $total_wallet_amount_old = $wallet_plus_amount - $wallet_minus_amount;

                                    $walletDifferencePlus = 0;
                                    $walletDifferenceMinus = 0;

                                    if($total_wallet_amount == ''){
                                        $total_wallet_amount = 0;
                                    }

                                    $walletAmountDisplay = $total_wallet_amount;
                                    
                                    if($total_wallet_amount > $order_total){

                                        $walletDifferencePlus = $total_wallet_amount - $order_total;
                                        $walletDiscountApply = $order_total;
                                    }
                                    else{
                                        $walletDifferenceMinus = $order_total - $total_wallet_amount;
                                        $walletDiscountApply = $total_wallet_amount;
                                    }
                                   
                                    if (Session::get('walletdiscount') !== null && Session::get('walletdiscount') != ''){ 
                                            $walletDiscount = Session::get('walletdiscount');
                                            if($total_wallet_amount > $order_total){
                                                $order_total = 0;
                                                $walletAmountDisplay = $walletDifferencePlus;
                                            }
                                            if($order_total > $total_wallet_amount){
                                                $order_total = $order_total-$total_wallet_amount;
                                                $walletAmountDisplay = 0;
                                            }
                                    } else{  
                                        $walletDiscount = 0;
                                    } 
                                    @endphp


                                    {{-- <li class="mb20"><p class="body-color">Seo Books x 1 <span class="float-end">$67.00</span></p></li> --}}
                                    <li class=" bdrb1 mb15">
                                        <h6>Subtotal <span class="float-end">AED {{ $sub_total_round }}</span></h6>
                                    </li>
                                    @if ($shippingcahrge > 0)
                                        <li class=" bdrb1 mb15">
                                            <h6>Shipping <span class="float-end">AED {{ $shippingcahrge }}</span></h6>
                                        </li>
                                    @endif

                                    @if ($vatcharge > 0)
                                        <li class=" bdrb1 mb15">
                                            <h6>Tax 5%<span class="float-end">AED {{ $vatcharge }}</span></h6>
                                        </li>
                                    @endif
                                     <li class=" bdrb1 mb15">
                                        <h6>Wallet ( AED.{{ $total_wallet_amount }} )
                                            <!-- <button type="button" class="wallet_apply">Apply</button> -->
                                            @if($total_wallet_amount > 0)
                                            <button  onclick="apply_wallet_discount('{{ $order_total }}','{{ $total_wallet_amount }}');" type="button" class="wallet_apply">Apply</button>
                                            @endif

                                            <span class="float-end">AED {{ $walletDiscount }}</span></h6>
                                    </li>
                                    <li>
                                        <h6>Total <span class="float-end">AED {{ $order_total }}</span></h6>
                                    </li>
                                </ul>
                            </div>
                            <div class="payment_widget default-box-shadow1">
                                <h4 class="title">Payment</h4>
                                <div class="radio-element">
                                    {{-- <div class="form-check d-flex align-items-center mb15">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked="checked">
                <label class="form-check-label" for="flexRadioDefault1">Direct bank transfer</label>
              </div>
              <div class="pw-details">
                <p class="fz13 mb30">Make your payment directly into our bank account. Please use your Order ID as the payment reference.Your order will not be shipped until the funds have cleared in our account.</p>
              </div> --}}

              
                                    <div class="form-check d-flex align-items-center mb15">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="payment_type" value="1">
                                        <label class="form-check-label" for="payment_type">Cash on delivery</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center mb15">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="payment_type2" value="2">
                                        <label class="form-check-label" for="payment_type2">Online</label>
                                    </div>

                                    <p class="form-error-text" id="payment_error" style="color: red;"></p>
                                    {{-- <div class="form-check d-flex align-items-center">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                <label class="form-check-label" for="flexRadioDefault4">PayPal</label>
              </div> --}}
                                </div>
                            </div>
                            <div class="d-grid default-box-shadow2">
                                <button class="ud-btn btn-thm" type="button" onclick="place_order();">Place Order<i
                                        class="fal fa-arrow-right-long"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        @else
            <p>No Package in Checkout</p>
        @endif
    </div>
</section>
@include('front.includes.footer')

<script type="text/javascript">
    function category_validation() {

        var email = jQuery("#email").val();
        if (email == '') {
            jQuery('#email_error').html("Please Enter Email");
            jQuery('#email_error').show().delay(0).fadeIn('show');
            jQuery('#email_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#email').offset().top - 150
            }, 1000);
            return false;
        }

        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!filter.test(email)) {

            jQuery('#email_error').html("Please Enter Valid Email");
            jQuery('#email_error').show().delay(0).fadeIn('show');
            jQuery('#email_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#email').offset().top - 150
            }, 1000);
            return false;

        }
        var password = jQuery("#password").val();
        if (password == '') {

            jQuery('#password_error').html("Please Enter Password");
            jQuery('#password_error').show().delay(0).fadeIn('show');
            jQuery('#password_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#password').offset().top - 150
            }, 1000);
            return false;

        }

        $.ajax({
            type: "post",
            url: "{{ url('check_login') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "email": email,
                "password": password,

            },
            success: function(returndata) {
                if (returndata == 1) {

                    $('#spinner_button').show();

                    $('#submit_button').hide();

                    $('#category_form').submit();

                } else if (returndata == 2) {
                    // Code for status not equal to 1
                    $('#contact_error_login').html("Account is not active.");
                    $('#contact_error_login').show().delay(2000).fadeOut('show');
                    return false;
                } else {
                    jQuery('#contact_error_login').html(" Email OR Password Not Valid ");
                    jQuery('#contact_error_login').show().delay(0).fadeIn('show');
                    jQuery('#contact_error_login').show().delay(2000).fadeOut('show');
                    return false;

                }



            }
        });




    }

    function place_order() {

        var fname = $("#fname").val();
        if (fname == '') {
            $("#fname_error").html("Please Enter First Name.");
            $('#fname_error').show().delay(0).fadeIn('show');
            $('#fname_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#fname').offset().top - 150
            }, 1000);
            return false;
        }

        var lname = $("#lname").val();
        if (lname == '') {
            $("#lname_error").html("Please Enter Last Name.");
            $('#lname_error').show().delay(0).fadeIn('show');
            $('#lname_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#lname').offset().top - 150
            }, 1000);
            return false;
        }

        var country = $("#country").val();
        if (country == '') {
            $("#country_error").html("Please Select Country / Region.");
            $('#country_error').show().delay(0).fadeIn('show');
            $('#country_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#country').offset().top - 150
            }, 1000);
            return false;
        }

        var address1 = $("#address1").val();
        if (address1 == '') {
            $("#address1_error").html("Please Enter House number and street name.");
            $('#address1_error').show().delay(0).fadeIn('show');
            $('#address1_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#address1').offset().top - 150
            }, 1000);
            return false;
        }

        var optional = $("#optional").val();
        if (optional == '') {
            $("#optional_error").html("Please Enter Apartment, suite, unit, etc.");
            $('#optional_error').show().delay(0).fadeIn('show');
            $('#optional_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#optional').offset().top - 150
            }, 1000);
            return false;

        }

        // var city = $("#city").val();
        // if (city == '') {
        //     $("#city_error").html("Please Select Town / City.");
        //     $('#city_error').show().delay(0).fadeIn('show');
        //     $('#city_error').show().delay(2000).fadeOut('show');
        //     $('html, body').animate({
        //         scrollTop: $('#city').offset().top - 150
        //     }, 1000);
        //     return false;
        // }

        // var zipcode = $("#zipcode").val();
        // if (zipcode == '') {
        //     $("#zipcode_error").html("Please Enter Zipcode.");
        //     $('#zipcode_error').show().delay(0).fadeIn('show');
        //     $('#zipcode_error').show().delay(2000).fadeOut('show');
        //     $('html, body').animate({
        //         scrollTop: $('#zipcode').offset().top - 150
        //     }, 1000);
        //     return false;
        // }

        var phone = $("#phone").val();
        if (phone == '') {
            $("#phone_error").html("Please Enter Phone.");
            $('#phone_error').show().delay(0).fadeIn('show');
            $('#phone_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#phone').offset().top - 150
            }, 1000);
            return false;
        }
        if (phone != '') {
            // var filter = /^\d{7}$/;
            if (phone.length < 7 || phone.length > 15) {
                $("#phone_error").html("Please Enter Valid Phone.");
                $('#phone_error').show().delay(0).fadeIn('show');
                $('#phone_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#phone').offset().top - 150
                }, 1000);
                return false;
            }
        }

        var email_ship = $("#email_ship").val();
        if (email_ship == '') {
            $("#email_ship_error").html("Please Enter Email.");
            $('#email_ship_error').show().delay(0).fadeIn('show');
            $('#email_ship_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#email_ship').offset().top - 150
            }, 1000);
            return false;
        }

        var em1 = jQuery('#email_ship').val();
        var filter1 = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter1.test(em1)) {
            jQuery('#email_ship_error').html("Enter Valid Email");
            jQuery('#email_ship_error').show().delay(0).fadeIn('show');
            jQuery('#email_ship_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#email_ship').offset().top - 150
            }, 1000);
            return false;
        }


        var payment_method = $("input[name='payment_method']:checked").val();
        if (payment_method == '' || payment_method == undefined) {
            $("#payment_error").html("Please Select Payment method.");
            $('#payment_error').show().delay(0).fadeIn('show');
            $('#payment_error').show().delay(2000).fadeOut('show');
            return false;
        }

        $('#addressForm').submit();
    }

    function ship_country_change(country_id) {
        //alert(country_id);
        if (country_id == 22) {
            $('#zipcodeDiv').hide();
            $('#stateDiv').hide();


            var url = '{{ url('ship_state_change') }}';

            $.ajax({
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "country": country_id,
                    "state_id": '0',
                },
                success: function(msg) {
                    //alert(msg);
                    document.getElementById('city_data').innerHTML = msg;
                }

            });

        } else {
            $('#zipcodeDiv').show();
            $('#stateDiv').show();
        }
        var url = '{{ url('bill_state_change') }}';

        $.ajax({
            url: url,
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                "country_id": country_id
            },
            success: function(msg) {
                //alert(msg);
                document.getElementById('state_data').innerHTML = msg;
            }

        });


    }

    function ship_state_change(state_id) {
        //alert(country_id);

        var country = jQuery("#country").val();

        var url = '{{ url('ship_state_change') }}';

        $.ajax({
            url: url,
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                "country": country,
                "state_id": state_id,
            },
            success: function(msg) {
                //alert(msg);
                document.getElementById('city_data').innerHTML = msg;
            }

        });


    }

    function apply_wallet_discount(total_wallet_amount,userWalletamount) {

        $.ajax({
            type: 'POST',
            url: '{{ url("apply-wallet-dicount") }}',
            data: {
                "_token": "{{ csrf_token() }}",
                "total_wallet_amount": total_wallet_amount,
                "userWalletamount": userWalletamount
            },
            success: function(result) {
                if (result != '') {
                    window.location.href = "{{ url('checkout') }}";
                }
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        // Set the default country ID, you may get it from your backend if needed
        var defaultCountryId = 22;

        // Trigger the change event on page load
        $("#country").val(defaultCountryId).trigger('change');

        // You may also pass the default country ID to the ship_country_change function
        // ship_country_change(defaultCountryId);
    });
</script>
<script>
    $(document).ready(function() {
        $('.search_country').select2();
    });
</script>

