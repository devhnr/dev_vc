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
    <section class="our-login mt120">

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

                      
                        <!-- <pre> -->
                        <h4 style="    margin: 0;">Order No: {{$orders->order_id}}</h4>
                        <div class="purchases_bottom_part">
                            <div class="purchases_item_box">
                               <div class="row">  

                                                                                                 
                                    <div class="col-md-7">
                                         @foreach($orders->items as $item)
                                                                        <div class="puchases_item_inner">
                                        <ul class="purchaseul">
                                            {{-- <li class="purchaseli purchaseli_mob_left">
                                                <div class="purchase_img">
                                                <a href="#"> 
                                                     @if($item->image != '')
                                                        <img src="{{ url('public/upload/packages/large/' . $item->image) }}" width="100%">
                                                        @else
                                                        <img src="{{ url('public/upload/packages/large/no-image.png') }}" width="50px" height="50px">
                                                    @endif
                                                </a>
                                                </div>
                                            </li> --}}
                                            <li class="purchaseli purchaseli_mob_right">
                                                <div class="purchase_info">
                                                <a href="#"><h5>{{$item->package_item_name}}</h5></a>
                                                    

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
                                                        
                                                        <p>Ordered On: @php
                                        $order_date = strtotime( $orders->created_at);
                                         echo $mysqldate = date( 'F d, Y', $order_date );
                                        @endphp   </p>
                                                
                                                </div>
                                            </li>

                                        </ul>
                                        
                                    </div>
                                    @endforeach
                                </div>
                            
                                <div class="col-md-5">
                                  <div class="ship_to_info_detail">
                                    <div class="col-md-12">
                                        <h4>Ship To</h4>
                                        <p>{{$orders->first_name}} {{$orders->last_name}}</p>
                                        <p>
                                            @if($orders->address1 != '')
                                                {{$orders->address1}},
                                            @endif 

                                            @if($orders->address2 != '')
                                                {{$orders->address2}},
                                            @endif
                                         <br> @if($orders->city != '')
                                                {{ Helper::cityname($orders->city)}},
                                            @endif
                                            @if($orders->state != '')
                                                {{ Helper::state_name($orders->state)}}-
                                            @endif

                                            @if($orders->zipcode != '')
                                                {{$orders->zipcode}},
                                            @endif
                                            <br>
                                            @if($orders->country != '')
                                                {{ Helper::countryname($orders->country)}}
                                            @endif
                                        </p>
                                    </div>
                                 </div>

                                </div>
                                
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

