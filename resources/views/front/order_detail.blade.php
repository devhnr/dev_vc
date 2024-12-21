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

                   
             <div class="my_purchases_box_section">
          
                                                <div class="my_purchases_box_inner custom-back-g-white">

                      
                        <!-- <pre> -->
                        {{-- <h4 style="margin: 0;">Order No: {{$orders->format_order_id}}</h4> --}}
                        
                        <div class="purchases_bottom_part">
                            <div class="purchases_item_box">
                                
                                <div class="col-md-7">
                                    <p class="invoice-details" style="text-align: end">
                                        <strong>Order:</strong> #{{ $orders->format_order_id }} <br>
                                        <strong>Issued:</strong>
                                        @php
                                            $order_date = strtotime($orders->created_at);
                                            echo $mysqldate = date('l, F d, Y', $order_date);

                                        @endphp
                                    </p>
                                </div>   
                               <div class="row">  
                               
                                <div class="col-md-2">
                                  <div class="to_info_detail">
                                    <div class="col-md-12">
                                        <h4>Name</h4>
                                        <p>{{$orders->user_name}}</p>
                                        
                                    </div>
                                 </div>


                                </div>
                                <div class="col-md-3">
                                  <div class="to_info_detail">
                                    <div class="col-md-12">
                                        <h4>Email ID</h4>
                                        <p>{{$orders->user_email}}</p>
                                        
                                    </div>
                                 </div>


                                </div>
                                <div class="col-md-2">
                                  <div class="to_info_detail">
                                    <div class="col-md-12">
                                        <h4>MobileNo</h4>
                                        <p>{{$orders->user_mobile}}</p>
                                        
                                    </div>
                                 </div>


                                </div>
                                @foreach($orders->items as $item)
                                <div class="col-md-2">
                                  <div class="to_info_detail">
                                    <div class="col-md-12">
                                        <h4>Service</h4>
                                        <p>{{$item->service_name}}</p>
                                        
                                    </div>
                                 </div>
                                 @endforeach


                                </div>

                                <div class="col-md-3">
                                  <div class="ship_to_info_detail">
                                    <div class="col-md-12">
                                        <h4>Ship To</h4>
                                       
                                    </div>
                                 </div>

                                </div>
                               
                                       
                                                                                        
                                    
                                  
                                
                            
                               
                                
                               </div>
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
                                             
                                            </li>

                                           

                                        </ul>
                                        
                                    </div>
                                    @endforeach
                                  
                                </div>




                                @if($orders->order_from  != 1)
                                <div class="invoice-item invoice-table-wrap">
                                    <div class="row">
                                        <strong class="customer-text" style="font-size: 18px;color:#272b41;">Order Summary</strong>
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="invoice-table table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            {{-- <th class="text-center">Package Image</th> --}}
                                                            <th class="text-center">Package Name</th>
                                                            <th class="text-center">Service</th>
                                                            <th class="text-center">Sub Service</th>
                                                            <th class="text-center">Moving Date</th>
        
                                                            <th class="text-center">Price</th>
                                                            <th class="text-center">Quantity</th>
                                                            <th class="text-center">Totals</th>
                                                            <th class="text-center">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $sub_total = 0;
                                                        @endphp
                                                        @foreach ($orders->items as $item)
                                                            @php
                                                                /*echo "<pre>";print_r($item);echo "</pre>"; */
                                                            @endphp
                                                            <tr>
                                                                {{-- <td class="text-center">
                                                                    @if ($item->image != '')
                                                                        <img src="{{ url('public/upload/packages/large/' . $item->image) }}"
                                                                            width="50px" height="50px">
                                                                    @else
                                                                        <img src="{{ url('public/upload/packages/large/no-image.png') }}"
                                                                            width="50px" height="50px">
                                                                    @endif
                                                                </td> --}}
                                                                <td class="text-center">{{ $item->package_item_name }}</td>
        
                                                                <td class="text-center">{{ $item->service_name }}</td>
        
                                                                <td class="text-center">{{ $item->subservice_name }}</td>
        
                                                                <td>
                                                                    @php
                                                                    if($orders->moving_date != ''){
                                                                        $moving_date = strtotime( $orders->moving_date);
                                                                     echo $mysqldate = date( 'F d, Y', $moving_date );
                                                                    }else{
                                                                        echo "-";
                                                                    }
                                                                    
                                                                    @endphp
                                                                </td>
        
                                                                @php
        
                                                                    if (
                                                                        $item->product_discount_amount != 0 &&
                                                                        $item->product_discount_amount != ''
                                                                    ) {
                                                                        $product_item_price = $item->product_discount_amount;
                                                                    } else {
                                                                        $product_item_price = $item->package_item_price;
                                                                    }
                                                                @endphp
        
                                                                <td class="text-center">{{ $orders->order_currency }}
                                                                    {{ $product_item_price }}</td>
                                                                <td class="text-center">{{ $item->package_quantity }}</td>
                                                                @php
        
                                                                    $total = $product_item_price * $item->package_quantity;
                                                                    $sub_total += $total;
                                                                @endphp
                                                                <td class="text-end">{{ $orders->order_currency }}
                                                                    {{ $total }}</td>
        
                                                                <td class="text-end">
        
                                                                    @if($item->is_return == 1)
                                                                        {{ 'Canceled' }}
        
                                                                    @else
        
                                                                        {{'-'}}
                                                                    @endif
        
                                                                        </td>
                                                            </tr>
                                                        @endforeach
        
        
        
        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
        
                                        <div class="col-md-6 col-xl-4 ms-auto">
                                            <div class="table-responsive">
                                                <table class="invoice-table-two table">
                                                    <tbody>
                                                        <tr>
                                                            <th>Subtotal:</th>
                                                            <td><span>{{ $orders->order_currency }} {{ $sub_total }}</span></td>
                                                        </tr>
                                                        @if ($orders->coupondiscount != '' && $orders->coupondiscount != 0)
                                                            <tr>
                                                                <th>Discount:</th>
                                                                <td><span>{{ $orders->order_currency }}
                                                                        {{ $orders->coupondiscount }}</span></td>
                                                            </tr>
                                                        @endif
        
                                                        @if ($orders->shippingcost != '' && $orders->shippingcost != 0)
                                                            <tr>
                                                                <th>Shipping:</th>
                                                                <td><span>{{ $orders->order_currency }}
                                                                        {{ $orders->shippingcost }}</span></td>
                                                            </tr>
                                                        @endif
        
                                                        @if ($orders->vatcharge != '' && $orders->vatcharge != 0)
                                                            <tr>
                                                                <th>VAT 5% :</th>
                                                                <td><span>{{ $orders->order_currency }}
                                                                        {{ $orders->vatcharge }}</span></td>
                                                            </tr>
                                                        @endif
        
                                                        <tr>
                                                            <th>Total Amount:</th>
                                                            <td><span>{{ $orders->order_currency }}
                                                                    {{ $orders->order_total }}</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
        
        
                                @if($orders->order_from  == 1)
        
                                <div class="invoice-item invoice-table-wrap">
                                    <div class="row">
                                        <strong class="customer-text" style="font-size: 18px;color:#272b41;">Order Summary</strong>
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="invoice-table table table-bordered">
                                                    <thead>
                                                        
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $sub_total = 0;
                                                        @endphp
                                                        @foreach ($orders->items as $item)
                                                            @php
                                                                /*echo "<pre>";print_r($item);echo "</pre>"; */
        
                                                                if($item->how_often_do_you_need_cleaning != ''){
        
                                                                    $order_item_package_data = array();
                                                                 }else{
                                                                    $order_item_package_data = DB::table('ci_order_item_packages')
                                                                                            ->where('order_id',$item->order_id)
                                                                                            ->where('order_item_id',$item->id)
                                                                                            ->get()->toArray();
                                                                 }
                                                            @endphp
        
        
        
                                                            <tr>
                                                                                                                    
                                                                <td class="text-center">Service Type</td>
        
                                                                <td class="text-end">{!! Helper::subservicename(strval($item->subservice_id)) !!}  </td>
                                                            </tr>
        
                                                            @if($item->how_often_do_you_need_cleaning != '')
                                                            <tr>
                                                                
                                                                <td class="text-center">No. of Cleaners</td>
        
                                                                <td class="text-end"> {{ $item->how_many_cleaners_do_you_need  }} </td>
                                                            </tr>
        
                                                            <tr>                                                       
                                                                <td class="text-center">No. of Hours</td>
                                                                <td class="text-end"> {{ $item->how_many_hours_should_they_stay  }} </td>
                                                            </tr>
        
                                                            <tr>                                                       
                                                                <td class="text-center">Frequency</td>
                                                                <td class="text-end"> {{ $item->how_often_do_you_need_cleaning  }} </td>
                                                            </tr>
                                                            @if($item->which_day_of_the_week_do_you_want_the_service != '')
                                                            <tr>                                                       
                                                                <td class="text-center">Days of the week</td>
                                                                <td class="text-end"> {{ $item->which_day_of_the_week_do_you_want_the_service  }} </td>
                                                            </tr>
                                                            @endif
                                                            <tr>                                                       
                                                                <td class="text-center">Materials</td>
                                                                <td class="text-end"> {{ $item->do_you_need_cleaning_material  }} </td>
                                                            </tr>
                                                            @endif
        
                                                            @if(!empty($order_item_package_data))
        
                                                            <tr>                                                       
                                                                <td class="text-center">Services</td>
                                                                <td class="text-end"> 
                                                                    @foreach($order_item_package_data as $package_data)
                                                                        {!! $package_data->package_item_name !!} * {!! $package_data->package_quantity !!}<br>
                                                                    @endforeach
                                                                </td>
                                                            </tr>
        
                                                            @endif
        
        
                                                            <tr>                                                       
                                                                <td class="text-center">Date</td>
                                                                <td class="text-end"> {{ $item->bookingdate}} {{ $item->month}} {{ $item->bookingyear}}</td>
                                                            </tr>
                                                            <tr>                                                       
                                                                <td class="text-center">Start Time</td>
                                                                <td class="text-end"> {!! Helper::timeslotname(strval($item->time_slot)) !!} </td>
                                                            </tr>
                                                            <tr>                                                       
                                                                <td class="text-center">Address</td>
                                                                <td class="text-end"> {{ $item->city}} , {{ $item->area}} , {{ $item->building_street_no}} , {{ $item->apartment_villa_no}}   </td>
                                                            </tr>
                                                        @endforeach
        
        
        
        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
        
                                        <div class="col-md-6 col-xl-4 ms-auto">
                                            <div class="table-responsive">
                                                <table class="invoice-table-two table">
                                                    <tbody>
                                                        <tr>
                                                            <th>Service Charges:</th>
                                                            <td><span>{{ $orders->service_charge }}</span></td>
                                                        </tr>
        
                                                        <tr>
                                                            <th>Promo Discount :</th>
                                                            <td><span>{{ $orders->promo_discount }}</span></td>
                                                        </tr>
        
                                                        <tr>
                                                            <th>Additional Charges:</th>
                                                            <td><span>{{ $orders->additional_charge }}</span></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th>Timing fee:</th>
                                                            <td><span>{{ $orders->timing_charge }}</span></td>
                                                        </tr>
                                                        @if($orders->cod_charge > 0)
                                                        <tr>
                                                            <th>Delivery charge:</th>
                                                            <td><span>{{ $orders->cod_charge }}</span></td>
                                                        </tr>
                                                        @endif
        
                                                        <tr>
                                                            <th>Service Fee:</th>
                                                            <td><span>{{ $orders->service_fee }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Sub Total:</th>
                                                            <td><span>{{ $orders->sub_total }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th>VAT (5%):</th>
                                                            <td><span>{{ $orders->vatcharge }}</span></td>
                                                        </tr>
        
                                                        <tr>
                                                            <th>Total Amount:</th>
                                                            <td><span>{{ $orders->order_total }}</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                   @endif                   
                                

                            </div>
                        </div>


                    


                    </div>
                                                            

               
                                </div>

                               

                   
                   
                </div>
            </div>
            
        </div>
    </section>
</div>


@include('front.includes.footer')

