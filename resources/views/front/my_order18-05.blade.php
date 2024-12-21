@include('front.includes.header')

<style type="text/css">
    
.myaccount-tab-list {
    display: block;
    margin-right: 30px;
    border: 1px solid #EEEEEE;
}

.nav {
    
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}

.myaccount-tab-list a {
    font-weight: 500;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 14px 20px;

    border-bottom: 1px solid #EEEEEE;
}

.my_purchases_box_section .my_purchases_box_inner {
    display: table;
    width: 100%;
}
.my_purchases_box_section .custom-back-g-white {
    background: #fafafa;
    padding: 40px 15px;
    margin-bottom: 30px;
}

.my_purchases_box_section .my_purchases_box_inner .purchases_top_part {
    display: table;
    width: 100%;
    padding-bottom: 30px;
    border-bottom: 1px solid #cecece;
}

.my_purchases_box_section .track_order {
    text-align: right;
}

.my_purchases_box_section .track_order a {
    text-decoration: none;
    display: inline-block;
    font-weight: 700;
    font-size: 14px;
    color: #282828;
    border: 1px solid #cecece;
    padding: 10px 20px;
    vertical-align: middle;
}


.purchases_item_box .puchases_item_inner ul.purchaseul li.purchaseli.purchaseli_mob_left {
    width: 30%;
    float: left;
}

.purchases_item_box .puchases_item_inner ul.purchaseul li.purchaseli {
    margin: 0;
    padding: 0;
    list-style: none;
    vertical-align: top;
    margin-right: 17px;
    margin-bottom: 40px;
}

.my_purchases_box_section .my_purchases_box_inner .purchases_bottom_part {
    display: table;
    width: 100%;
    padding-top: 30px;
}

</style>


<div class="body_content">
    <!-- Our LogIn Area -->
    <section class="our-login">

        <div class="container">
            <div class="row">
                <div class="col-lg-4">

                    @include('front.account_sidebar')
                </div>

                <div class="col-lg-8">

                    @php

                    $i = 1;

                     //echo "<pre>";print_r($orders_list);echo"</pre>";

                     if (isset($orders_list) and count($orders_list)) {

                        foreach ($orders_list as $key => $orders) {



                    @endphp

                    <div class="my_purchases_box_section">
                 
                    <div class="my_purchases_box_inner custom-back-g-white">

                        <div class="purchases_top_part">
                            <div class="row">
                            <div class="col-md-2 col-sm-6 col-xs-6">
                                <div class="nsp_order_no_ship">
                                    <h6>Order No.</h6>
                                    <p>{{$orders->order_id}}</p>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-6">
                                <div class="nsp_order_no_ship">
                                    <h6>Order Placed</h6>
                                    
                                    <p>@php
                                        $order_date = strtotime( $orders->created_at);
                                         echo $mysqldate = date( 'F d, Y', $order_date );
                                        @endphp
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-6">
                                <div class="nsp_order_no_ship">
                                    <h6>Total</h6>
                                    <p>{{ $orders->order_currency}} {{number_format($orders->order_total);}}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="nsp_order_no_ship">
                                    <h6>Ship To</h6>
                                    <p>{{$orders->user_name}}</p>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="track_order">
                                    <!--<a href="#">Track Order</a>-->
                                    <a href="{{ url('order-detail') }}">Detail</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- <pre> -->
                        <div class="purchases_bottom_part">
                            <div class="purchases_item_box">
                            <div class="row">  
                                 @foreach($orders->items as $item)
                                  <div class="col-md-6">
                                    <div class="puchases_item_inner">
                                        <ul class="purchaseul">
                                           
                                               {{--  <div class="purchase_img">
                                                    <a href="#">
                                                         @if($item->image != '')
                                                        <img src="{{ url('public/upload/packages/large/' . $item->image) }}" width="100%">
                                                        @else
                                                        <img src="{{ url('public/upload/packages/large/no-image.png') }}" width="50px" height="50px">
                                                    @endif
                                                    </a>
                                                </div>
                                                --}}
                                            
                                            <li class="purchaseli purchaseli_mob_right">
                                                <div class="purchase_info">
                                                    <a href="#">
                                                        <h5>{{$item->package_item_name}}</h5>
                                                    </a>
                                                    @php

                                                    if($item->product_discount_amount != 0 && $item->product_discount_amount != ''){
                                                        $product_item_price = $item->product_discount_amount;
                                                    }else{
                                                        $product_item_price = $item->package_item_price;
                                                    }
                                                @endphp

                                                    <span class="price">{{ $orders->order_currency}}  {{$product_item_price}}</span>

                                                    <div class="size_color_qty">
                                                        <ul style="padding-left: 0rem; !important">
                                                            
                                                            <li>Qty: {{$item->package_quantity}}</li>
                                                        </ul>
                                                    </div>
                                                    <!--                                                     <span class="main-price discounted old"><span class="money">&#8377;
                                                            </span></span>
                                                     -->
                                                                                                                                                                                                                                                                                                                        
                                                  
                                                    
                                                    <p>Ordered On: @php
                                        $order_date = strtotime( $orders->created_at);
                                         echo $mysqldate = date( 'F d, Y', $order_date );
                                        @endphp   </p>

                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div> 

                                @endforeach
                                               
                               </div>
                            </div>
                        </div>
                    </div>
                                                      

               
                </div>

                @php } } @endphp
                   
                </div>
            </div>
            
        </div>
    </section>
</div>


@include('front.includes.footer')

<script>
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
</script>
