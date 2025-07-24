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


/* New Css */
.card-rounded {
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .profile-img {
      width: 50px;
      height: 50px;
      background: #f0f0f0;
      border-radius: 50%;
    }
    .rating-star {
      color: #fbb034;
    }
    .status-completed {
      color: green;
      font-weight: 600;
    }

    hr {background-color: currentColor;}
.option-row {
      padding: 0 16px 12px 12px;
      /* border-bottom: 1px solid #e0e0e0; */
      display: flex;
      align-items: center;
      justify-content: space-between;
      cursor: pointer;
    }
    .option-row:hover {
      background-color: #f9f9f9;
    }
    .option-label {
      display: flex;
      align-items: center;
      font-size: 16px;
    }
    .option-label span {
      margin-right: 8px;
    font-size: 27px;
    transform: rotate(90deg);
    color: #000;
    }
    .arrow-icon {
      font-size: 18px;
    }
    .bookagain{
            margin: 0;
    color: #000000de;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    font-size: 18px;
    letter-spacing: 0;
    }

    .text-primary{
        font-size: 22px;
    font-style: normal;
    font-weight: 700;
    letter-spacing: 0;
    line-height: 32px;
    }

    .option-row .arrow-icon::after {
  content: '\276F'; /* Unicode for › (› = U+276F = &#10147;) */
  font-size: 18px;
  display: inline-block;
}
.text-muted {
    color: #000000de !important;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    font-size: 18px;
    letter-spacing: 0;
}

 .arrow-icongethelp::after {
  content: '\276F'; /* Unicode for › (› = U+276F = &#10147;) */
  font-size: 18px;
  display: inline-block;
}

.get-help-card a{
    padding: 0 16px !important;
}

.booking_detail{
    padding: 1rem 1.5rem;
}
.booking_detail h5{
    color: #000000de;
    font-size: 22px;
    font-style: normal;
    font-weight: 700;
    letter-spacing: 0;
    line-height: 32px;
}

.booking_detail ul li {
    align-items: center !important;
    justify-content: space-between !important;
    display: flex;
    margin-bottom: 0.75rem;
}

.booking_detail ul li strong {
    font-size: 16px;
    letter-spacing: .1px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    color: #00000061 !important;
}

.booking_detail .status-completed{
        font-size: 16px;
    letter-spacing: .1px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    color: #49a361 !important;
}

.booking_detail  .right{
    font-size: 16px;
    letter-spacing: .1px;
    color: #000000de;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
}

.booking_detail .showMore {
       font-size: 14px;
    line-height: 20px;
    font-style: normal;
    font-weight: 600;
    letter-spacing: 0;
}




.booking_detail_popup{
    
}
.booking_detail_popup.card-rounded{
    box-shadow: inherit;
}

.booking_detail_popup.card{
    border: inherit;
}

.booking_detail_popup ul li {
    align-items: center !important;
    justify-content: space-between !important;
    display: flex;
    margin-bottom: 0.75rem;
}

.booking_detail_popup ul li strong {
    font-size: 16px;
    letter-spacing: .1px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    color: #00000061 !important;
}


.booking_detail_popup  .right{
    font-size: 16px;
    letter-spacing: .1px;
    color: #000000de;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
}

.modal-dialog {
    max-width: 35%;
    height: auto !important;
    max-height: 70% !important;
}

.modal-content {
    border-radius: 1.3rem;
}

.closeBtn {
    background: none;
    font-size: 50px;
    color: #000;
    border: none;
    /* position: absolute; */
    right: 0;
    top: 0;
    margin: 0;
    padding: 0;
    width: 30px;
}

.modal-title {
    font-size: 20px;
    color: #000000;
    font-weight: bold;
}
.instruction-box {
      padding: 12px 0;
      border-radius: 8px;
      font-size: 14px;
    }

.instruction-box {
      font-size: 14px;
    }
    .instruction-box strong {
      color: #000000de;
        font-style: normal;
        font-weight: 400;
        line-height: 24px;
        font-size: 18px;
        letter-spacing: 0;
        margin-left: 2%;
    }

    .instruction-box p {
          font-size: 16px;
    letter-spacing: .1px;
    color: #000000de;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    display: -webkit-box;
    overflow: hidden;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    }

    .card-section-price-detail {
      border: 1px solid #e0e0e0;
      border-radius: 12px;
      padding: 16px;
      background-color: #fff;
      margin-top: 20px;
    }
    
    .payment-method img {
      height: 20px;
      margin-right: 4px;
    }


    .price_detail{
    padding: 1rem 1.5rem;
}
.price_detail h5{
    color: #000000de;
    font-size: 22px;
    font-style: normal;
    font-weight: 700;
    letter-spacing: 0;
    line-height: 32px;
}

.price_detail ul li {
    align-items: center !important;
    justify-content: space-between !important;
    display: flex;
    margin-bottom: 0.75rem;
}

.price_detail ul li strong {
    font-size: 16px;
    letter-spacing: .1px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    color: #00000061 !important;
}

.price_detail .status-completed{
        font-size: 16px;
    letter-spacing: .1px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    color: #49a361 !important;
}

.price_detail  .right{
    font-size: 16px;
    letter-spacing: .1px;
    color: #000000de;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
}

.receipt-link a {
      display: flex;
      justify-content: space-between;
      align-items: center;
      
    }
    .receipt-link i {
      font-size: 12px;
    }
    .receipt-icon {
      font-size: 18px;
      margin-right: 8px;
    }
    .receipt-label {
      display: flex;
      align-items: center;
      font-size: 14px;
    }

    .option-row-receipt {
     
      align-items: center;
      justify-content: space-between;
      cursor: pointer;
    }
    .option-row-receipt .option-row-receipt:hover {
      background-color: #f9f9f9;
    }
    .option-row-receipt .option-label {
      display: flex;
      align-items: center;
      font-size: 16px;
    }
    .option-row-receipt .option-label span {
      margin-right: 8px;
    font-size: 27px;
    transform: inherit;
    color: #000;
    }
    .option-row-receipt .arrow-icon {
      font-size: 18px;
    }

    .option-row-receipt .arrow-icongethelp::after {
    content: '\276F';
    font-size: 18px;
    display: inline-block;
}
.rating-card {
      border: 1px solid #e0e0e0;
      border-radius: 12px;
      background-color: #fff;
      padding: 16px;
      margin-top: 20px;
    }
    .rating-title {
          color: #000000de;
    font-size: 22px;
    font-style: normal;
    font-weight: 700;
    letter-spacing: 0;
    line-height: 32px;
    display: flex
;
    align-items: center;
    }
    .rating-title i {
      font-size: 18px;
      margin-right: 8px;
    }
    .rating-subtext {
          font-size: 16px;
    letter-spacing: .1px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    color: #00000061 !important;
    }
    .stars i {
      color: #fbc02d;
      font-size: 18px;
      margin-left: 2px;
    }
status-popup {
  background: white;
  border-radius: 10px;
  font-family: sans-serif;
  padding: 20px 0px;
}

.status-header {
  display: flex;
  justify-content: space-between;
  font-weight: bold;
  font-size: 16px;
  margin-bottom: 20px;
}

.close-btn {
  font-size: 24px;
  cursor: pointer;
}

.status-steps {
  list-style: none;
  padding: 0;
  margin: 0;
}

.status-steps li {
  display: flex;
  align-items: flex-start;
  margin-bottom: 20px;
  position: relative;
  color: #aaa;
}

.status-steps li .icon-circle {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background: #ccc !important;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  margin-right: 10px;
  flex-shrink: 0;
}

.status-steps li .status-text {
  flex-grow: 1;
}

.status-steps li .status-title {
  font-weight: bold;
  margin-bottom: 3px;
}

.status-steps li .status-desc {
  font-size: 13px;
  color: #666;
}

.status-steps li.active {
  color: #00AEEF;
}

.status-steps li.active .icon-circle {
  background: #00AEEF !important;
}

.status-steps li.active::after{
    background: #00AEEF !important;
}

.status-steps li:not(:last-child)::after {
  content: "";
  position: absolute;
  left: 14px;
  top: 30px;
  width: 2px;
  height: 40px;
  background: #ccc;
}

.status-steps li.active ~ li .icon-circle {
  background: #e0e0e0;
}
#edit_instruction_btn{
    background-color: #0040E6;
    color: #fff;
    width: 100%;
}
#whatsapp_Button{
  background-color: #0040E6;
    color: #fff;
    width: 100%;
}
.help_que_popup{
  padding: 10px !important;
}
.status-desc.hide {
    display: none;
}
.status-desc.show {
    display: block;
}
#getHelpModal .modal-content{
    padding: 20px !important;
}
.help-que-modal{
  padding: 0px 10px !important;
}
.edit-icon{
  font-weight: 300;
  font-size: 20px;
}
.white-text{
  color: #fff;
}
#cancel_order_btn.btn:hover{
 color: #fff !important;
}
#submit_order_btn.btn:hover{
  color: #fff !important;
}

</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


<div class="body_content">
    <!-- Our LogIn Area -->
    <section class="our-login mt120">

        <div class="container">
            <div class="row">
                <div class="col-lg-4">

                    @include('front.account_sidebar')
                </div>

                <div class="col-lg-8">

                    <div class="card card-rounded p-3 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                    <div>
                        @if($orders->dateorder_status == "upcoming")
                        @php
                          if($orders->order_status == "P") {
                                $statusText = "Confirmed";
                                $statusColor = "";
                            } elseif($orders->order_status == "PA") {
                                $statusText = "Vendor Assigned";
                                $statusColor = "";
                            } elseif($orders->order_status == "CO") {
                                $statusText = "Completed";
                                $statusColor = "";
                            } elseif($orders->order_status == "CL") {
                                $statusText = "Cancelled";
                                $statusColor = "red";
                            }
                            else {
                             $statusText = "Unknown";
                            }
                        @endphp

                        <span class="text-primary fw-bold">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-status="{{ $statusText }}" {{ $statusText != 'Cancelled' ? 'data-bs-toggle=modal data-bs-target=#ConfirmModal' : '' }} class="text-primary showMore"  style="color: {{ $statusColor }} !important;">{{$statusText}} ></a>
                        </span>

                        <p class="mb-1 text-muted">Thank you. We'll match you with a top-rated Professional.  </p>

                        @else 
                        
                        @php
                          if($orders->order_status == "P") {
                                $statusText = "Confirmed";
                                $statusColor = "";
                            } elseif($orders->order_status == "PA") {
                                $statusText = "Vendor Assigned";
                                $statusColor = "";
                            } elseif($orders->order_status == "CO") {
                                $statusText = "Completed";
                                $statusColor = "";
                            } elseif($orders->order_status == "CL") {
                                $statusText = "Cancelled";
                                $statusColor = "red";
                            }
                            else {
                             $statusText = "Unknown";
                            }
                        @endphp
                        <span class="text-primary fw-bold">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-status="{{ $statusText }}" {{ $statusText != 'Cancelled' ? 'data-bs-toggle=modal data-bs-target=#CompleteModal' : '' }} class="text-primary showMore"  style="color: {{ $statusColor }} !important;">{{$statusText}} ></a>
                        </span>
                        <p class="mb-1 text-muted">We hope you're satisfied. We look forward to </br> serving you again. 💙</p>

                        @endif

                    </div>
                    @if(isset($orders->dateorder_status) && $orders->dateorder_status == "upcoming")
                        <div class="text-end">
                            <div class="profile-img mb-1 mx-auto">
                                <img src="{{ asset('public/site/images/confirm.png') }}" alt="Profile Image" class="img-fluid rounded-circle">
                            </div>
                        </div>
                    @else
                        @php
                            $cleanerIds = [];
                            if (!empty($orders->items[0]->cleaner_id)) {
                                $cleanerIds = explode(',',$orders->items[0]->cleaner_id);
                            }
                        @endphp

                        @if(count($cleanerIds) == 1)
                            @php
                               $cleanerId = trim($cleanerIds[0]);
                           
                                $cleaner_data = DB::table('users')->where('id', $cleanerId)->first();

                                // echo"<pre>";print_r($cleanerId);echo"</pre>";
                            @endphp

                            @if($cleaner_data)
                            <div class="text-center">
                                <div class="profile-img mb-1 mx-auto">
                                    <img src="{{ asset('public/upload/cleaners/large/' . $cleaner_data->profile_image) }}" alt="Profile Image" class="img-fluid rounded-circle">
                                </div>
                                <div><small class="text-muted">{{ $cleaner_data->name }}</small></div>
                                <div class="rating-star" style="color: gold;">★ 4.4 (5490)</div>
                            </div>
                            @endif
                        @endif
                    @endif

                   
                    </div>
                     
                     @if($orders->dateorder_status == "past")
                     <hr>
                     <div class="option-row">
                        <div class="option-label">
                        <span>&#8635;</span> 
                        {{-- <p class="bookagain">Book again</p> --}}
                        <a class="bookagain" href="{{ url('/booknow/'.$orders->items[0]->service_id.'/'.$orders->items[0]->subservice_id) }}" >Book again </a>
                        </div>
                        <div class="arrow-icon"></div> 
                    </div>
                    @endif

                </div>

                <!-- Get Help Button -->
                @php
                  $subserviceId = $orders->items[0]->subservice_id; 

                  $help = DB::table('help')
                    ->whereRaw("FIND_IN_SET(?, subservice)", [$subserviceId])
                    ->get();
                @endphp

                @if(count($help) > 0)
                <div class="card card-rounded p-3 mb-4 get-help-card">
                    
                      <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#getHelpModal" class="d-flex align-items-center justify-content-between text-decoration-none text-muted">Get Help
                        <div class="arrow-icongethelp"></div>
                    </a>
                </div>
                @endif

                <!-- Booking Details -->
                <div class="card card-rounded mb-4  booking_detail">
                   @php
                          if($orders->order_status == "P") {
                                $statusText = "Confirmed";
                                $statusColor = "";
                            } elseif($orders->order_status == "PA") {
                                $statusText = "Vendor Assigned";
                                $statusColor = "";
                            } elseif($orders->order_status == "CO") {
                                $statusText = "Completed";
                                $statusColor = "";
                            } elseif($orders->order_status == "CL") {
                                $statusText = "Cancelled";
                                $statusColor = "red";
                            }
                            else {
                             $statusText = "Unknown";
                            }
                        @endphp
                    <h5 class="mb-3">Booking Details</h5>
                    <ul class="list-unstyled mb-3">
                    <li><strong>Status:</strong> <span class="status-completed" style="color: {{ $statusColor }} !important;">{{ $statusText }}</span></li>
                    <li><strong>Reference Code:</strong> <span class="right">{{ $orders->format_order_id }}</span></li>

                    <li><strong>Service:</strong> <span class="right">{!! Helper::subservicename($orders->items[0]->subservice_id) !!}</span></li>

                    <li><strong>Date & Time:</strong> <span class="right">{{ $orders->items[0]->bookingdate }} {{ $orders->items[0]->month }} {{ $orders->items[0]->bookingyear }}, {!!  Helper::timeslotname($orders->items[0]->time_slot) !!}</span></li>

                    @php
                    $package_data = DB::table('ci_order_item_packages')->where('order_id', $orders->order_id)->get();
                    $filteredPackages = $package_data->filter(function($item) {
                        return $item->subservice_id != 28;
                    });
                    @endphp

                    @if($filteredPackages->isNotEmpty())
                        <li>
                            <strong>Service Details:</strong>
                            <span class="right">
                                @foreach($filteredPackages as $data)
                                    {!! Helper::packages_enquiry($data->package_id) !!}<br>
                                @endforeach
                            </span>
                        </li>
                    @endif


                    <li><strong></strong> <span class="right "><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#bookingDetailsModal" class="text-primary showMore">Show more</a> </span></li>
                    </ul>
                    
                    @if($orders->items[0]->any_special_instruction)
                    <hr>
                    <div class="instruction-box ">
                    <div class="d-flex align-items-center mb-3">
                     <i class="fa-regular fa-pen edit-icon"></i>
                    <strong>Instructions</strong>
                    </div>
                    <p>{{ $orders->items[0]->any_special_instruction }}</p>
                    </div>
                    @endif
                    @if($orders->dateorder_status == "upcoming" && $orders->order_status != "CL" && $orders->order_status != "CO")
                    <hr>
                    <div class="option-row-receipt">
                     <a href="javascript:void(0)" data-bs-toggle="modal"     data-bs-target="#Edit_instruction_Modal" class="d-flex align-items-center justify-content-between text-decoration-none text-muted">
                        <div class="option-label">
                         <span> <i class="fa-regular fa-pen-to-square edit-icon"></i>
                        </span> 
                        <p class="bookagain">Edit My instruction</p>
                        </div>
                        <div class="arrow-icongethelp"></div>
                        </a>
                    </div>
                    <hr>
                    <div class="option-row-receipt">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#EditbookingModal" class="d-flex align-items-center justify-content-between text-decoration-none text-muted">
                        <div class="option-label">
                        <span>
                         
                          <i class="fa-regular fa-gear edit-icon"></i>
                       </span> 
                        <p class="bookagain">Edit This Booking</p>
                        </div>
                        <div class="arrow-icongethelp"></div>
                    </a>
                    </div>
                    @endif


            </div>


            <div class="card card-rounded  price_detail mb-4">
                    <h5 class="mb-3">Price Details</h5>
                    <ul class="list-unstyled mb-3">
                    @if(isset($orders))
                   <li><strong>Service Charge :</strong> <span class="right">AED {{ $orders->service_charge }}</span></li>
                   <li><strong>COD Charge:</strong> <span class="right">AED {{ $orders->cod_charge }}</span></li>
                    <li><strong>Discount:</strong> <span class="right">-AED {{ $orders->coupondiscount }}</span></li>
                    <li><strong>Service Fee:</strong> <span class="right">AED {{ $orders->service_fee }}</span></li>
                     <li><strong>Subtotal:</strong> <span class="right">AED {{ $orders->sub_total }}</span></li>
                    <li><strong>VAT Charge:</strong> <span class="right">AED {{ $orders->vatcharge }}</span></li>
                    <li><strong>Total (Inc. VAT):</strong> <span class="right">AED {{ $orders->order_total }}</span></li>
                    <li><strong>Payment Method:</strong> <span class="right">
                        @if($orders->paymentmode == 1)
                        COD
                        @else
                        Online
                        @endif
                    </span></li>

                    @endif
                    </ul>
                    

                    @if($orders->dateorder_status == "past")
                    <hr>
                    <div class="option-row-receipt">
                        <a href="#" class="d-flex align-items-center justify-content-between text-decoration-none text-muted">
                        <div class="option-label">
                        <span>🧾</span> <!-- Unicode for the rotate arrow -->
                        <p class="bookagain">Show Receipt </p>
                        </div>
                        <div class="arrow-icongethelp"></div>
                    </a>

                         <!-- Unicode for right arrow -->
                    </div>
                    @endif
                    
                 
                </div>
                 @if($orders->dateorder_status == "past")
                   <div class="rating-card d-flex justify-content-between align-items-center">
                        <div>
                        <div class="rating-title">
                            <i class="bi bi-stars"></i> You Rated Rana Gohar
                        </div>
                        <div class="rating-subtext mt-1">Your Rating</div>
                        </div>
                        <div class="stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
        </div>
    </section>
</div>


@include('front.includes.footer')


{{-- Show more popup start --}}
@if(isset($orders))
<div class="modal fade" id="bookingDetailsModal" tabindex="-1" aria-labelledby="bookingDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content ">
    
      <div class="modal-header">
        <h5 class="modal-title" id="bookingDetailsModalLabel">Booking Details</h5>
       <button type="button" class="close closeBtn" id="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
      </div>
      <div class="modal-body">
        <div class="card card-rounded booking_detail_popup">
            <ul class="list-unstyled mb-3">

            <li><strong>Reference Code:</strong> <span class="right">{{ $orders->format_order_id }}</span></li>

            <li><strong>Service:</strong> <span class="right">{!! Helper::subservicename($orders->items[0]->subservice_id) !!}</span></li>

                @php
                $package_data = DB::table('ci_order_item_packages')->where('order_id', $orders->order_id)->get();
                $filteredPackages = $package_data->filter(function($item) {
                    return $item->subservice_id != 28;
                });
            @endphp

            @if($filteredPackages->isNotEmpty())
                <li>
                    <strong>Service Details:</strong>
                    <span class="right">
                        @foreach($filteredPackages as $data)
                            {!! Helper::packages_enquiry($data->package_id) !!}<br>
                        @endforeach
                    </span>
                </li>
            @endif

            <li><strong>Date & Time:</strong> <span class="right">{{ $orders->items[0]->bookingdate }} {{ $orders->items[0]->month }} {{ $orders->items[0]->bookingyear }}, {!!  Helper::timeslotname($orders->items[0]->time_slot) !!}</span></li>

            @if($orders->items[0]->subservice_id == 28)
            <li><strong>Frequency:</strong> <span class="right">{{ $orders->items[0]->how_often_do_you_need_cleaning }}</span></li>
            @endif

            <li><strong>Address:</strong> <span class="right">{{ $orders->items[0]->apartment_villa_no }}, {{ $orders->items[0]->building_street_no }}, {{ $orders->items[0]->area }}, {{ $orders->items[0]->city }}</span></li>

            </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

{{-- Show more popup end --}}

{{-- Edit this booking popup start --}}

@if(isset($orders))
<div class="modal fade" id="EditbookingModal" tabindex="-1" aria-labelledby="EditbookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content ">
    
      <div class="modal-header">
        <h5 class="modal-title" id="EditbookingModalLabel">Edit This Booking</h5>
       <button type="button" class="close closeBtn" id="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
      </div>
      <div class="modal-body">
        <div class="edit_booking_popup">
              <ul class="list-unstyled mb-3">
                <div class="option-row-receipt">
                    <li>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Edit_address_Modal" class="d-flex align-items-center justify-content-between text-decoration-none text-muted">
                        <div class="option-label">
                        <p class="bookagain">Change Address</p>
                        </div>
                        <div class="arrow-icongethelp"></div>
                    </a>
                </li>
                </div>
                </ul>
                </div>
                <hr>
           @php
            $date = $orders->items[0]->bookingdate;     
            $monthName = $orders->items[0]->month;      
            $year = $orders->items[0]->bookingyear;     

            $fullDateStr = $date . ' ' . $monthName . ' ' . $year; 
            $bookingDate = \Carbon\Carbon::createFromFormat('d F Y', $fullDateStr);
            $today = \Carbon\Carbon::today();
        @endphp
          @if($bookingDate->gt($today))
           <div class="edit_booking_popup">
            <ul class="list-unstyled mb-3">
                <div class="option-row-receipt">
                    <li>
                    <div class="d-flex align-items-center justify-content-between text-decoration-none text-muted">
                        <div class="option-label">
                        <a href="{{ route('reschedule',$orders->order_id) }}" class="bookagain">Reschedule</a> 
                        </div>
                        <div class="arrow-icongethelp"></div>
                      </div>
                    </li>
                </div>
            </ul>
            </div>
            <hr>
            @endif

           <div class="edit_booking_popup">
            <ul class="list-unstyled mb-3">
                <div class="option-row-receipt">
                    <li>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Edit_cancel_Modal" class="d-flex align-items-center justify-content-between text-decoration-none text-muted">
                        <div class="option-label">
                        <p class="bookagain">Cancel</p>
                        </div>
                        <div class="arrow-icongethelp"></div>
                    </a>
                </li>
                </div>
            </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

 {{-- Edit this booking popup end --}}

 

<!-- Edit_address_Modal Start-->
@if(isset($orders))
<div class="modal fade" id="Edit_address_Modal" tabindex="-1" aria-labelledby="Edit_address_ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold">Edit Address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>

      <form id="update_address_form" action="{{ route('update-address') }}" method="POST">
        @csrf
        <input type="hidden" name="order_id" value="{{ $orders->order_id }}">

        <div class="modal-body pt-2 pb-0">
          <div class="mb-2">
           <select class="form-control form-select" name="city" id="city">
                            <option value="">Select City</option>
                           <option value="Dubai" {{ $orders->items[0]->city == 'Dubai' ? 'selected' : '' }}>Dubai</option>
                          <option value="Abu Dhabhi" {{ $orders->items[0]->city == 'Abu Dhabhi' ? 'selected' : '' }}>Abu Dhabhi</option>
                          <option value="Sharjah" {{ $orders->items[0]->city == 'Sharjah' ? 'selected' : '' }}>Sharjah</option>
                        </select>
            <p class="alert alert-danger d-none mt-2" id="edit_city_message"></p>
          </div>

          <div class="mb-2">
          <input type="text" name="area" id="area" class="form-control" placeholder="Enter Your Area" value="{{ $orders->items[0]->area }}">
            <p class="alert alert-danger d-none mt-2" id="edit_area_message"></p>
          </div>

          <div class="mb-2">
          <input type="text" name="building_street_no" id="building_street_no" class="form-control" placeholder="Enter your building name and/or street" value="{{ $orders->items[0]->building_street_no }}">
            <p class="alert alert-danger d-none mt-2" id="edit_building_street_no_message"></p>
          </div>
          
          <div class="mb-2">
         <input type="text" name="apartment_villa_no" id="apartment_villa_no" class="form-control" placeholder="Enter your apartment number &amp; floor or villa number" value="{{ $orders->items[0]->apartment_villa_no }}">
            <p class="alert alert-danger d-none mt-2" id="edit_apartment_villa_no_message"></p>
          </div>

          <div class="text-center mt-3 mb-3">
            <input 
              type="button" 
              class="btn px-5 py-2 rounded-pill"
              id="edit_instruction_btn" 
              value="Update"
              onclick="Update_address();">
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
@endif

<!-- Edit_address_Modal End-->

 

<!-- Edit_cancel_Modal Start-->
@if(isset($orders))
<div class="modal fade" id="Edit_cancel_Modal" tabindex="-1" aria-labelledby="Edit_cancel_ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold">Cancel Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <div class="modal-body">
        <form action="{{ route('cancel-order') }}" id="cancel_form" method="POST">
          @csrf
        <input type="hidden" name="order_id" id="order_id" value="{{ $orders->order_id}}">
        <p class="text-center fw-bold" style="font-size: 17px;">Are you sure you want to cancel this order?</p>
        <div class="text-center">
        <input type="button" class="btn btn-danger white-text" id="cancel_order_btn" data-bs-dismiss="modal" value="Cancel">
        <input type="button" class="btn btn-primary white-text" id="submit_order_btn" value="Submit" onclick="cancel_order()">
        </div>
        </form>
      </div>

     

    </div>
  </div>
</div>
@endif

<!-- Edit_cancel_Modal End-->

<!-- Confirm Status Modal -->
<div class="modal fade" id="ConfirmModal" tabindex="-1" aria-labelledby="ConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="ConfirmModalLabel">Learn What Is Next</h5>
        <button type="button" class="close closeBtn" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      

      <div class="modal-body">
        <div class="status-popup">
           @php
            use Carbon\Carbon;
            use Illuminate\Support\Str;

            date_default_timezone_set('Asia/Dubai');

            $status = $orders->order_status;
            $statusFlow = ['P', 'PA', 'OTW', 'IP', 'CO'];
            $currentStep = array_search($status, $statusFlow);

            if ($status !== 'CO' && $status !== 'CL' && $status !== 'P' && !empty($orders->items[0]->time_slot)) {
                $timeSlot = Helper::timeslotname($orders->items[0]->time_slot);
                $slotParts = explode(' - ', $timeSlot);

                if (count($slotParts) == 2) {
                    // Get custom booking date from order
                    $day = $orders->items[0]->bookingdate;
                    $monthName = $orders->items[0]->month;
                    $year = $orders->items[0]->bookingyear;

                    // Convert month name to number
                    $monthNumber = Carbon::parse("1 " . $monthName)->month; // e.g., July => 7

                    // Format date string as Y-m-d
                    $customDate = Carbon::createFromDate($year, $monthNumber, $day)->format('Y-m-d');

                    $slotStart = Carbon::parse($customDate . ' ' . $slotParts[0]);
                    $slotEnd   = Carbon::parse($customDate . ' ' . $slotParts[1]);
                    $now       = Carbon::now('Asia/Dubai');

                    if ($now->between($slotStart, $slotEnd)) {
                        $status = 'IP'; // In Progress
                    } elseif ($now->greaterThan($slotEnd)) {
                        $status = 'IP'; // Completed
                    } elseif ($now->greaterThanOrEqualTo($slotStart->subHours(2))) {
                        $status = 'OTW'; // On the Way
                    } else {
                        $status = 'PA'; // Professional Assigned
                    }

                    $currentStep = array_search($status, $statusFlow);
                }
            }
            @endphp


            <ul class="status-steps">
                @php
                    $steps = [
                    ['label' => 'Confirmed', 'icon' => '<i class="fa-solid fa-check"></i>', 'desc' => 'Your booking is confirmed! Sit back while we get things ready.'],

                    ['label' => 'Vendor Assigned', 'icon' => '<i class="fa-solid fa-user"></i>', 'desc' => 'We’ve matched you with a trusted vendor — you’re in good hands.'],
                    ['label' => 'On the way', 'icon' => '<i class="fa-solid fa-truck"></i>', 'desc' => 'The vendor is on their way to your location. Get ready!'],
                    ['label' => 'In progress', 'icon' => '<i class="fa-solid fa-spinner"></i>', 'desc' => 'Work is currently underway. We’ll keep you posted!'],
                    ['label' => 'Completed', 'icon' => '<i class="fa-solid fa-check-circle"></i>', 'desc' => 'All done! We hope you’re satisfied with the service.'],
                    ];
                @endphp

             @foreach($steps as $index => $step)
              <li class="{{ $index <= $currentStep ? 'active' : '' }}">
                  <div class="icon-circle">{!! $step['icon'] !!}</div>
                  <div class="status-text">
                      <div class="status-title">{{ $step['label'] }}</div>

                      {{-- Only show description for the current step --}}
                      @if($step['desc'])
                          <div class="status-desc" style="{{ $index === $currentStep ? '' : 'display: none;' }}">
                              {{ $step['desc'] }}
                          </div>
                      @endif
                  </div>
              </li>
          @endforeach

            </ul>
        </div>
      </div>

    </div>
  </div>
</div>


{{-- Status Modal End --}}


<!-- complete Status Modal -->
<div class="modal fade" id="CompleteModal" tabindex="-1" aria-labelledby="CompleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="CompleteModalLabel">Learn What Is Next</h5>
        <button type="button" class="close closeBtn" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      

      <div class="modal-body">
        <div class="status-popup">
            @php

            date_default_timezone_set('Asia/Dubai');

            $status = $orders->order_status;
            $statusFlow = ['P', 'PA', 'OTW', 'IP', 'CO'];
            $currentStep = array_search($status, $statusFlow);

            if ($status !== 'CO' && $status !== 'CL' && $status !== 'P' && !empty($orders->items[0]->time_slot)) {
                $timeSlot = Helper::timeslotname($orders->items[0]->time_slot);
                $slotParts = explode(' - ', $timeSlot);

                if (count($slotParts) == 2) {
                    // Get custom booking date from order
                    $day = $orders->items[0]->bookingdate;
                    $monthName = $orders->items[0]->month;
                    $year = $orders->items[0]->bookingyear;

                    // Convert month name to number
                    $monthNumber = Carbon::parse("1 " . $monthName)->month; // e.g., July => 7

                    // Format date string as Y-m-d
                    $customDate = Carbon::createFromDate($year, $monthNumber, $day)->format('Y-m-d');

                    $slotStart = Carbon::parse($customDate . ' ' . $slotParts[0]);
                    $slotEnd   = Carbon::parse($customDate . ' ' . $slotParts[1]);
                    $now       = Carbon::now('Asia/Dubai');

                    if ($now->between($slotStart, $slotEnd)) {
                        $status = 'IP'; // In Progress
                    } elseif ($now->greaterThan($slotEnd)) {
                        $status = 'IP'; // Completed
                    } elseif ($now->greaterThanOrEqualTo($slotStart->subHours(2))) {
                        $status = 'OTW'; // On the Way
                    } else {
                        $status = 'PA'; // Professional Assigned
                    }

                    $currentStep = array_search($status, $statusFlow);
                }
            }
            @endphp

            <ul class="status-steps">
                @php
                    $steps = [
                    ['label' => 'Confirmed', 'icon' => '<i class="fa-solid fa-check"></i>', 'desc' => 'Your booking is confirmed! Sit back while we get things ready.'],

                    ['label' => 'Vendor Assigned', 'icon' => '<i class="fa-solid fa-user"></i>', 'desc' => 'We’ve matched you with a trusted vendor — you’re in good hands.'],
                    ['label' => 'On the way', 'icon' => '<i class="fa-solid fa-truck"></i>', 'desc' => 'The vendor is on their way to your location. Get ready!'],
                    ['label' => 'In progress', 'icon' => '<i class="fa-solid fa-spinner"></i>', 'desc' => 'Work is currently underway. We’ll keep you posted!'],
                    ['label' => 'Completed', 'icon' => '<i class="fa-solid fa-check-circle"></i>', 'desc' => 'All done! We hope you’re satisfied with the service.'],
                    ];
                @endphp

              @foreach($steps as $index => $step)
              <li class="{{ $index <= $currentStep ? 'active' : '' }}">
                  <div class="icon-circle">{!! $step['icon'] !!}</div>
                  <div class="status-text">
                      <div class="status-title">{{ $step['label'] }}</div>

                      {{-- Only show description for the current step --}}
                      @if($step['desc'])
                          <div class="status-desc" style="{{ $index === $currentStep ? '' : 'display: none;' }}">
                              {{ $step['desc'] }}
                          </div>
                      @endif
                  </div>
               </li>
             @endforeach
            </ul>
        </div>
      </div>

    </div>
  </div>
</div>


{{-- complete Modal End --}}


<!-- Edit_instruction_Modal Start-->
@if(isset($orders))
<div class="modal fade" id="Edit_instruction_Modal" tabindex="-1" aria-labelledby="Edit_instruction_ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold">Edit instructions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>

      <form id="update_instruction_form" action="{{ route('update-instruction') }}" method="POST">
        @csrf
        <input type="hidden" name="order_id" value="{{ $orders->order_id }}">

        <div class="modal-body pt-2 pb-0">
          <div class="mb-2">
            <textarea 
              class="form-control rounded shadow-sm" 
              id="edit_instruction" 
              name="edit_instruction" 
              rows="4" 
              cols="50" 
              placeholder="Enter your instruction here..." 
             
            >{{ $orders->items[0]->any_special_instruction }}</textarea>
            <p class="alert alert-danger d-none mt-2" id="edit_instruction_message"></p>
          </div>

          <div class="text-center mt-3 mb-3">
            <input 
              type="button" 
              class="btn px-5 py-2 rounded-pill"
              id="edit_instruction_btn" 
              value="Update"
              onclick="Update_instruction();">
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
@endif

<!-- Edit_instruction_Modal End-->


<!-- getHelpModal Start-->
@if(isset($orders))

@php
  $subserviceId = $orders->items[0]->subservice_id; 

  $help = DB::table('help')
    ->whereRaw("FIND_IN_SET(?, subservice)", [$subserviceId])
    ->get();
@endphp

<!-- Help Modal -->
<div class="modal fade" id="getHelpModal" tabindex="-1" aria-labelledby="getHelpModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold ">Appointment Help</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      @foreach ($help as $data)
      <div class="help_que_popup">
        <ul class="list-unstyled mb-3">
          <div class="option-row-receipt">
            <li>
              <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#help_que_Modal_{{ $data->id }}" class="d-flex align-items-center justify-content-between text-decoration-none text-muted">
                <div class="option-label">
                  <p class="bookagain">{{ $data->question }}</p>
                </div>
                <div class="arrow-icongethelp"></div>
              </a>
            </li>
          </div>
        </ul>
      </div>
      @endforeach

    </div>
  </div>
</div>

<!-- Dynamic Answer Modals for Each Question -->
@foreach ($help as $data)
<div class="modal fade" id="help_que_Modal_{{ $data->id }}" tabindex="-1" aria-labelledby="helpQueModalLabel_{{ $data->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content help-que-modal">
      
      <div class="modal-header border-0 pb-0">
       
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <div class="modal-body">
        <h6 class="modal-title fw-bold mb-3">{{ $data->question }}</h6>

        <p>{{ $data->answers }}</p>

         <div class="text-center mt-3 mb-3">
          @if($data->appointment == 1)
            <a href="{{ url('/order-detail/'.$orders->order_id) }}" class="btn px-5 py-2 rounded-pill" id="edit_instruction_btn"  >APPOINTMENT DETAILS</a>
            @endif
          </div>
          <div class="text-center mt-3 mb-3">
          @if($data->ticket == 1)

             <a href="https://web.whatsapp.com/send?phone=971502827864" target="_blank" id="whatsapp_Button" class="btn px-5 py-2 rounded-pill" > CREATE SUPPORT TICKET </a>
          @endif
        </div>
      </div>
      
    </div>
  </div>
</div>
@endforeach

@endif


<!-- getHelpModal End-->


{{-- help_que_Modal_Stat --}}




{{-- help_que_Modal_End --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('whatsapp_Button')?.addEventListener('click', function () {
      const phoneNumber = "971502827864"; // Replace with your WhatsApp number
      const message = "Hello, I need support regarding my order."; // Your default message

      window.open(`https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`, '_blank');
    });
  });
</script>

<script>
function Update_instruction() {
    const instruction = $('#edit_instruction').val().trim();

    if (instruction === "") {
        $('#edit_instruction_message')
            .removeClass('d-none')
            .text('Please enter instruction');
        $('html, body').animate({
            scrollTop: $('#edit_instruction').offset().top - 150
        }, 500);
        setTimeout(() => {
            $('#edit_instruction_message').addClass('d-none').text('');
        }, 3000);
        return false;
    }
    $('#update_instruction_form').submit();
}

function Update_address(){

  const city = $('#city').val().trim();

    if (city === "") {
        $('#edit_city_message')
            .removeClass('d-none')
            .text('Please Select City');
        $('html, body').animate({
            scrollTop: $('#city').offset().top - 150
        }, 500);
        setTimeout(() => {
            $('#edit_city_message').addClass('d-none').text('');
        }, 3000);
        return false;
    }

  const area = $('#area').val().trim();

    if (area === "") {
        $('#edit_area_message')
            .removeClass('d-none')
            .text('Please Enter Area');
        $('html, body').animate({
            scrollTop: $('#area').offset().top - 150
        }, 500);
        setTimeout(() => {
            $('#edit_area_message').addClass('d-none').text('');
        }, 3000);
        return false;
    }

  const building_street_no = $('#building_street_no').val().trim();

    if (building_street_no === "") {
        $('#edit_building_street_no_message')
            .removeClass('d-none')
            .text('Please Enter Building Street No');
        $('html, body').animate({
            scrollTop: $('#building_street_no').offset().top - 150
        }, 500);
        setTimeout(() => {
            $('#edit_building_street_no_message').addClass('d-none').text('');
        }, 3000);
        return false;
    }

  const apartment_villa_no = $('#apartment_villa_no').val().trim();

    if (apartment_villa_no === "") {
        $('#edit_apartment_villa_no_message')
            .removeClass('d-none')
            .text('Please Enter Apartment Villa No');
        $('html, body').animate({
            scrollTop: $('#apartment_villa_no').offset().top - 150
        }, 500);
        setTimeout(() => {
            $('#edit_apartment_villa_no_message').addClass('d-none').text('');
        }, 3000);
        return false;
    }

    $('#update_address_form').submit();

}

function cancel_order(){
  $('#cancel_form').submit();
}
</script>