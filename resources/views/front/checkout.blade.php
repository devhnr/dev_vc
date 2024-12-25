@include('front.includes.header')
<style type="text/css">
.wallet_apply{
    border: none;
    background-color: inherit;
    color: #0040E6;
}
.wallet_cancel{
    border: none;
    background-color: inherit;
    color: #0040E6;
}
.modal-dialog{
    max-width: 60%;
     height: 700px; 
     overflow: auto;

  }
@media only screen and (max-width: 768px){
#modal-digi{
 max-width: 100% !important;   
}
}
</style>
<!-- Shop Cart Area -->
<section class="pt40 pb0 mt120">
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
                <input type="hidden" name="apply_button" id="apply_button" value="0">
                <input type="hidden" name="cancel_button" id="cancel_button" value="1">
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
                                            <h6 class="mb15">Country<span style="color: red">*</span></h6>
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
                                    <div class="col-lg-12">
                                        <div class="mb25">
                                            <h6 class="mb15">Emirate<span style="color: red">*</span></h6>
                                            <div class="">
                                                <select class="form-control search_emirate" name="emirate" id="emirate">
                                                    <option value="">Select Emirate</option>
                                                    <option value="Dubai" selected>Dubai</option>
                                                    <option value="Abu Dhabi">Abu Dhabi</option>
                                                </select>
                                                <p class="form-error-text" id="emirate_error" style="color: red;">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb25">
                                            <h6 class="mb15">Area<span
                                                    style="color: red">*</span></h6>
                                            <input class="form-control" type="text"
                                                placeholder="Enter Area" name="area"
                                                id="area">
                                            <p class="form-error-text" id="area_error" style="color: red;"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb25">
                                            <h6 class="mb15">Street<span
                                                    style="color: red">*</span></h6>
                                            <input class="form-control" type="text"
                                                placeholder="Enter Street" name="address1"
                                                id="address1">
                                            <p class="form-error-text" id="address1_error" style="color: red;"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb25">
                                            <h6 class="mb15">Apartment/Villa no<span
                                                    style="color: red">*</span></h6>
                                            <input class="form-control" name="optional" id="optional"
                                                type="text" placeholder="Enter Apartment/Villa no">
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
                                                {{-- <span id="state_data">
                                                    <select class="form-control" name="state_name" id="state_name">
                                                        <option value="">Select State</option>
                                                    </select>
                                                </span> --}}
                                                <input class="form-control" type="state" name="state" id="state" placeholder="Enter State">
                                                <p class="form-error-text" id="state_name_error" style="color: red;">
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12" style="display: none">
                                        <div class="mb25">
                                            <h6 class="mb15">Town / City</h6>
                                            <div class="">
                                                {{-- <span id="city_data">
                                                    <select class="form-control" name="city" id="city">
                                                        <option value="">Select Town / City</option>
                                                    </select>
                                                </span> --}}
                                                <input class="form-control" type="text" name="city" id="city" placeholder="Enter City">
                                                <p class="form-error-text" id="city_error" style="color: red;"></p>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-sm-12" id="zipcodeDiv" style="display: none">
                                        <div class="mb25">
                                            <h6 class="mb15">ZIP</h6>
                                            <input class="form-control" type="text" placeholder="Enter ZIP"
                                                name="zipcode" id="zipcode">
                                            {{-- <p class="form-error-text" id="zipcode_error" style="color: red;"></p> --}}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb25">
                                            <h6 class="mb15">Phone <span style="color: red">*</span></h6>
                                            <input class="form-control" type="number" placeholder="Enter Phone"
                                                name="phone" id="phone"
                                                @if ($userData['mobile'] != '') value="{{ $userData['mobile'] }}" @endif>
                                            <p class="form-error-text" id="phone_error" style="color: red;"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
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
                                            <h6 class="mb15">When would you like to move?<span style="color: red">*</span></h6>
                                        
                                        <input type="date" id="moving_date" name="moving_date" class="form-control"
                                            placeholder="Enter When Would You like to move?">
                                        <p class="form-error-text" id="moving_date_error" style="color: red; margin-top: 10px;">
                                        </p>
                                    </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb25">
                                            <h4 class="mb15" class="mb15">Additional information</h4>
                                            {{-- <h6>Order Notes (optional)</h6> --}}
                                            <textarea name="additional_message" id="additional_message" class="" rows="7"
                                                placeholder="Please detail your job as much as you can."></textarea>
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
                                            // echo"<pre>";print_r($items);echo"</pre>";
                                            // $pacakges_data = DB::table('packages')->where('id',$items->id)->first();

                                            // echo"<pre>";print_r($pacakges_data);echo"</pre>";

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
                                                <p class="body-color">{{ $items->name }} x{{ $items->qty }}
                                                <span class="float-end">AED {{ $price_tot * $items->qty }}</span>
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
                                        ->sum('wallet_amount');

                                    // echo"<pre>";print_r($wallet_plus_amount);echo"</pre>";
                                    // echo"<pre>";print_r($wallet_minus_amount);echo"</pre>";

                                    $plusAmountWallet = $wallet_plus_amount ?? 0;
                                    $minusAmountWallet = $wallet_minus_amount ?? 0;

                                    $total_wallet_amount = max($plusAmountWallet - $minusAmountWallet, 0);
                                    $total_wallet_amount_old = $wallet_plus_amount - $wallet_minus_amount;

                                    // echo"<pre>";print_r($total_wallet_amount);echo"</pre>";
                                    // echo"<pre>";print_r($total_wallet_amount_old);echo"</pre>";
                                    

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

                                  

                                    //   echo"<pre>";print_r(Session::get('walletdiscount'));echo"</pre>";  
                                   
                                    if (Session::get('walletdiscount') !== null && Session::get('walletdiscount') != 0 && $total_wallet_amount < $order_total) { 
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

                                    // echo"<pre>";print_r($order_total);echo"</pre>";
                                   

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
                                            
                                            <button id="cancel_wallet_discount" onclick="cancelWalletDiscount('{{ $order_total }}','{{ $total_wallet_amount }}');" type="button" class="wallet_cancel" style="display: none;">Cancel</button>

                                            @endif

                                            <span class="float-end" id="walletr_amount_display">- AED 0</span></h6>
                                    </li>
                                    <li>
                                        <h6>Total <span class="float-end" id="order_grand_total">AED {{ $order_total }}</span></h6>
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
                            <div class="payment_widget default-box-shadow1">
                                @foreach (Cart::content() as $items)
                                @php
                                $pacakges_data = DB::table('packages')->where('id',$items->id)->first();
                                @endphp
                               
                                <input type="checkbox" class="form-check-lable" id="term_condition_checkbox" name="term_condition_checkbox"> 
                                <a style="border-bottom:1px solid 
                                #000;margin-left: 10px;" id="popup" data-bs-toggle="modal" data-bs-target="#exampleModalLong_{{$items->id}}"> I agree to the terms and conditions</a>
                                <p class="form-error-text" id="term_condition_checkbox_error" style="color: red; margin-top: 10px;">
                                @endforeach
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

!-- Modal -->
@foreach (Cart::content() as $items)
@php
$pacakges_data = DB::table('packages')->where('id',$items->id)->first();
@endphp  
<div class="modal fade" id="exampleModalLong_{{$items->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document" id="modal-digi">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Terms and Conditions 
            <span style="font-size: 15px;font-weight: 100;">
            <br>{!! Helper::subservicename($pacakges_data->subservice_id) !!}  & {{$pacakges_data->title}} {{$pacakges_data->sub_title}}</span></h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" 
        style="border-radius: 50%;width: 35px;height: 35px;background-color: #707070;font-size: 38px;color: #fff;border: none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <h5 style="ul li : list-style: inherit;">{!!html_entity_decode ($pacakges_data->term_condition) !!}</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
        <!-- Add data-id to identify the item -->
        <button type="button" class="btn btn-primary agree-btn" data-id="{{$items->id}}">Agree</button>
      </div>
    </div>
  </div>
</div>
@endforeach



<!-- jQuery Script -->
<script>
  $(document).ready(function(){
    // Event listener for Agree button
    $('.agree-btn').on('click', function() {
      // Check the checkbox
      $('#term_condition_checkbox').prop('checked', true);
      
      // Close the modal (Bootstrap 5)
      let modalId = $(this).data('id');
      $('#exampleModalLong_' + modalId).modal('hide');
    });
  });
</script>


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
            $("#country_error").html("Please Select Country");
            $('#country_error').show().delay(0).fadeIn('show');
            $('#country_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#country').offset().top - 150
            }, 1000);
            return false;
        }

        var emirate = $("#emirate").val();
        if (emirate == '') {
            $("#emirate_error").html("Please Select Emirate.");
            $('#emirate_error').show().delay(0).fadeIn('show');
            $('#emirate_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#emirate').offset().top - 150
            }, 1000);
            return false;
        }

        var area = $("#area").val();
        if (area == '') {
            $("#area_error").html("Please Enter Area.");
            $('#area_error').show().delay(0).fadeIn('show');
            $('#area_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#area').offset().top - 150
            }, 1000);
            return false;
        }

        var address1 = $("#address1").val();
        if (address1 == '') {
            $("#address1_error").html("Please Enter Street.");
            $('#address1_error').show().delay(0).fadeIn('show');
            $('#address1_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#address1').offset().top - 150
            }, 1000);
            return false;
        }

        var optional = $("#optional").val();
        if (optional == '') {
            $("#optional_error").html("Please Enter Apartment/Villa no.");
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

        var moving_date = $("#moving_date").val();
        if (moving_date == '') {
            $("#moving_date_error").html("Please Select When Would You like to move?");
            $('#moving_date_error').show().delay(0).fadeIn('show');
            $('#moving_date_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#moving_date').offset().top - 150
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

        var term_condition_checkbox = $("input[name='term_condition_checkbox']:checked").val();
        if (term_condition_checkbox == '' || term_condition_checkbox == undefined) {
            $("#term_condition_checkbox_error").html("Please Checked the Terms and Condition Checkbox.");
            $('#term_condition_checkbox_error').show().delay(0).fadeIn('show');
            $('#term_condition_checkbox_error').show().delay(2000).fadeOut('show');
            return false;
        }

        // var term_condition_checkbox = $("#term_condition_checkbox").val();
        // if (term_condition_checkbox == '') {
        //     $("#term_condition_checkbox_error").html("Please Checked the Terms and Condition Checkbox");
        //     $('#').show().delay(0).fadeIn('show');
        //     $('#term_condition_checkbox_error').show().delay(2000).fadeOut('show');
        //     $('html, body').animate({
        //         scrollTop: $('#term_condition_checkbox').offset().top - 150
        //     }, 1000);
        //     return false;
        // }

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

        // alert(total_wallet_amount);
        // alert(userWalletamount);return false;
           
                $.ajax({
                    type: 'POST',
                    url: '{{ url("apply-wallet-dicount") }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "total_wallet_amount": total_wallet_amount,
                        "userWalletamount": userWalletamount
                    },
                    success: function (result) {
            if (result !== '') {
                let UserWalletAmount;

                if (@json(Session::get('user_wallet_amount')) !== "") {
                    UserWalletAmount = parseFloat(userWalletamount);
                    // alert(UserWalletAmount); return false;
                }else{
                    UserWalletAmount = parseFloat(@json(Session::get('user_wallet_amount')));
                    // alert(UserWalletAmount); return false;
                }

                // alert(UserWalletAmount);return false;

                let order_total = parseFloat(@json(Session::get('order_total')));

                let updatedTotal = parseFloat(result);

                // Calculate the new order total after applying wallet amount
                let order_total_new1;

                if (UserWalletAmount >= order_total) {
                    order_total_new1 = 0; // Wallet covers the entire order
                    document.getElementById("payment_type").checked = true;
                    UserWalletAmount = order_total;
                } else {
                    order_total_new1 = order_total - UserWalletAmount; // Remaining amount to be paid
                }
                 // Update the wallet amount display
                 $('#walletr_amount_display').text(`- AED ${UserWalletAmount.toFixed(2)}`);
                // Update the displayed order grand total
                $('#order_grand_total').text(`AED ${order_total_new1.toFixed(2)}`);
                $('#apply_button').val(1);
                $('#cancel_button').val(1);
                document.querySelector('.wallet_apply').style.display = 'none';
                document.querySelector('.wallet_cancel').style.display = 'inline-block';
               
            }
        }

    });
}
function cancelWalletDiscount(orderTotal, userWalletAmount) {
    // AJAX to revert the applied discount
    $.ajax({
        type: 'POST',
        url: '{{ url("cancel-wallet-dicount") }}',
        data: {
            "_token": "{{ csrf_token() }}",
            "orderTotal": orderTotal,
            "userWalletAmount": userWalletAmount
        },
        success: function (result) {
            if (result !== '') {
                // Reset the displayed order total to the original value
                let originalOrderTotal = parseFloat(orderTotal);
                $('#cancel_button').val(0);
                $('#apply_button').val(0);
                $('#order_grand_total').text(`AED ${originalOrderTotal.toFixed(2)}`);
            
                // Reset the wallet amount display
                $('#walletr_amount_display').text('');

                // Hide the cancel button and show the apply button again
                document.querySelector('.wallet_apply').style.display = 'inline-block';
                document.querySelector('.wallet_cancel').style.display = 'none';

                
            }
        }
    });
}
</script>

<script>

document.addEventListener('DOMContentLoaded', () => {
    const dateInput = document.getElementById('moving_date');
    
    // Get tomorrow's date
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    // Format the date to yyyy-mm-dd
    const yyyy = tomorrow.getFullYear();
    const mm = String(tomorrow.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    const dd = String(tomorrow.getDate()).padStart(2, '0');
    const minDate = `${yyyy}-${mm}-${dd}`;
    
    // Set the min attribute
    dateInput.setAttribute('min', minDate);
});

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

