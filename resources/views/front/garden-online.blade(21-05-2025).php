@include('front.includes.header')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
<style>
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
    .backMobile {
        position: absolute;
        right: 15px;
        top: 10px;
    }
    .radio-group input[type="radio"] {
    display: none;
    }
    .sticky-button {
    display: none !important;
    position: fixed;
    bottom: 0px;
    right: 0;
    z-index: 1000;
    height: 81px;
    background-color: #fff;
    color: #fff;
    font-size: 23px;

  }
  .booking-summary{
    position: fixed;
    bottom: 7px;
    /* right: 146px; */
    z-index: 1000;
    height: 50px;
    background-color: #fff;
    color: #fff;
    font-size: 23px;
    border: none;
    padding: 0;
    margin: 0;
  }
  .modal-dialog{
    max-width: 60%;
  }
  .mobile-next{
    top: 20px !important;
  }
  /* Show the button on mobile screens (less than 768px wide) */
  @media only screen and (max-width: 768px) {
    .hour_input .items{
        margin-left: 30px;
    }
    #modal-digi{
        max-width: 100% !important;
    }
   .sticky-button {
      display: block !important;
    }
    .mobile-hide{
        display: none !important;
    }
    #summary_div_left{
        display: none !important;
    }
    #summary_div_left_mobile {
        display: none;
        position: fixed;
        bottom: -100%; /* Initially hide the div outside the viewport */
        right: 0;
        width: 100%;
        transition: all 0.3s ease-in-out; /* Smooth transition effect */
        z-index: 99999; /* Make sure it stays on top */
    }
    .book-now-web{
        display:none !important;
    }
    #learn_more{
        font-weight: 50 !important;
    }
    #mobile-table{
        width:100% !important;
    }
    #nextBtn12{
        background-color : #0040E6 !important;
        border:none !important;
    }

    #summary_div_left_mobile.open {
        display: block !important;
        bottom: 0; /* Slide up into view */
        background: #fff;
        bottom: 81px;
        /* padding-top: 121px; */
        padding:0 0 68px !important;
        height: 100%;
        background: rgba(0, 0, 0, .7)
    }
    .summuryInner {
        background: #fff;
        position: absolute;
        bottom: 0;
        width: 100%;
        padding: 70px 10px 10px;
    }

    .closeBtn {
            background: none;
            font-size: 50px;
            color: #000;
            border: none;
            position: absolute;
            right: 0;
            top: 0;
            margin: 0;
            padding: 0;
            width: 30px;
    }
    
}


table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 50%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }

  
    /* Style the labels to look like buttons */
    .radio-group label {
        display: inline-block;
        padding: 10px 20px !important;
        margin: 5px;
        border: 2px solid #0040E6;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        /* width: 100%;
        text-align: center; */
    }
    

    /* Default button style */
    .radio-group label {
        background-color: #fff;
        color: #007bff;
    }


    .radio-checked input[type="radio"] + label {
        color: #000;
        /* outline: grey; */
    }
    /* Change style when radio button is checked */
    .radio-checked input[type="radio"]:checked + label {
        background-color: #0040E6;
        color: #fff;
    }
    .radio-group input[type="radio"]:checked + label {
        background-color: #0040E6;
        color: #fff;
    }

    /* Change style on hover */
    .radio-group label:hover {
        background-color: #e0e0e0;
    }
    .labeltime {
        width: 100%;
        text-align: center;
        padding: 10px !important;
        margin: 0 !important;
    }

    /* Optional: Add active class for better styling control */
    .radio-group label:active {
        background-color: #d0d0d0;
    }

    /* Hide the checkboxes */
    .checkbox-group input[type="checkbox"] {
        display: none;
    }

    /* Style the labels to look like buttons */
    .checkbox-group label {
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        border: 2px solid #007bff;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    /* Default button style */
    .checkbox-group label {
        background-color: #fff;
        color: #007bff;
    }

    /* Change style when checkbox is checked */
    .checkbox-group input[type="checkbox"]:checked + label {
        background-color: #0040E6;
        color: #fff;
    }

    /* Change style on hover */
    .checkbox-group label:hover {
        background-color: #e0e0e0;
    }

    /* Optional: Add active class for better styling control */
    .checkbox-group label:active {
        background-color: #d0d0d0;
    }

    .calendar-input {
        width: 100%;
        text-align: center;
    }
    .calendar-container {
        display: flex;
        align-items: center;
        /* justify-content: center; */
        margin-top: 20px;
    }
    .scroll-arrow {
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        outline: none;
        border: none;
        padding: 0;
        background-color: transparent;
        position: relative;
    }
    .dates-container {
        display: flex;
        overflow: hidden;
        width: 100%; 
        padding-top: 15px;
    }
    .days-wrapper {
        display: flex;
        transition: transform 0.3s ease;
    }
    .calendar-day {
        flex: 0 0 auto;
        width: 43px;
        height: 75px;
        text-align: center;
        padding: 10px;
        border: 1px solid #ddd;
        margin: 0 10px;
        border-radius: 50px;
        cursor: pointer;
        border: 2px solid #0040E6;
    }
    .calendar-day.is-selected {
        background-color: #0040E6;
        color: white;
    }
    .calendar-day-label, .calendar-date-label {
        display: block;
    }
    .surcharge-badge {
        color: red;
    }
    .surcharge-badge-timeslot{
        color: red;
        padding-top: 20px;
/*        display: inline-block;*/
    }

    .surcharge-badge-timeslot span{
        position: absolute;
        left: 0;
        right: 0;
        margin-left: auto;
        margin-right: auto;
        width: 75px;
        text-align: center;
        background: #ffda40;
        padding: 0px 5px;
        color: #000;
        top: 3px;
        border-radius: 10px;
    }
    .surcharge-badge-dayslot{
        color: red;
        width: 30%;
        display: inline-block;
    }
    .surcharge-badge-dayslot span{
        position: relative;
        top: -83px;
        right: 24px; 
        background: #ffda40;
        padding: 2px 3px;
        color: #000;
        white-space: nowrap;
        font-size: 13px;
        border-radius: 8px;

    }
    .button_weekly label{
        width: 83% !important;
        padding: 0 20px;
        padding-top: 10px;

    @media (max-width: 768px) {
    width: 100% !important;
   
    }
    }
    .button_weekly ul li{
        list-style-type: "- " !important;
        margin-left: -20px;
    }
 
    .hour_input label{
        border-radius: 50px;
        padding: 7px 28px;
        width: 95%;
        text-align: center; 
    }
    .hour_input span{
        position: absolute;
        left: 0;
        right: 0;
        margin-left: 3%;
        margin-right: auto;
        width: 62px;
        text-align: center;
        background: #ffda40;
        padding: 0px 5px;
        color: #000;
        top: -12%;
        border-radius: 10px;
        font-weight: 1000;
    }
    .material label{
        border-radius: 50px;
        padding: 12px 24px;
    }
    .fw500 {
    font-weight: 1000;
    font-size: 16px;
    }
    .cleaning_weekly_new{
        color:#222222;
        float: right;
        background-color:#ffda40;
        padding: 0 4px 0 4px;
        border-radius: 7px;
        font-size:13px;
    }
    .dettol{
        display: contents;"
    }
    .mid_col{
        box-shadow: 0 6px 15px #00000029;
        padding: 13px 13px 13px 13px;
        border-radius: 10px;
    }
    .last_col{
        box-shadow: 0px 6px 15px #00000029;
        /* box-shadow: 0 0 10px 2px rgba(0,0,0,0.1); */
        padding: 13px 13px 13px 13px;
        border-radius: 10px;
    }
    .last_col h3{
        text-align: center;
    }
    .underline{
        border: 1px solid #707070;
        border-style: dashed;
        color: #707070;
        display: inline-block;
        width: 100%;
        margin: 10px 0
    }
    .step-underline{
        border: 1px solid #707070;
        color: #707070;
        width: 206%;
        display: inline-block;
    }
    .font-weight-bold-summary{
        font-weight: 1000;
    }
    .payment-type{
        display:inline;
    }
    /* .payment-li{
        width: 100% !important;
    } */
    .sm-summary{
        max-width: 60%;
        text-align: right;
        color:#0040E6;
    }
    .step-p{
        margin:0  0 -10px 34%;
        font-size:21px;
    }
    .step-title{
        margin-left: 34%;
    }
    .custome-black{
        background-color: #000 !important;
        border: 2px solid #000 !important;
        color: #ffffff;
        border-radius: 50px;
        padding: 7px 40px 7px 40px;
    }
    .custome-black:hover {
        border: 2px solid #000 !important;
       background-color: #000 !important;
    }
    .custome-black:hover:before{
        background-color: #000 !important;
    }
    .left-summary-total{
        background-color :#0040E6;
        color: #fff;
        padding: 13px 0px;
        border-radius: 11px;
    }
    .left-summary-without-cross-total{
        background-color :#0040E6;
        color: #fff;
        padding: 16px 0px 7px 67px;
        border-radius: 11px;
    }
    .main-title{
        margin-bottom: 25px;
    }
    .firstBlur {
  /* margin:50px 20px 0; */
  padding:20px;
  position:relative;
}

/* === CSS FILTER EFFECTS === */
.firstBlur.modalBlur > *:not(.modal) {
  -webkit-filter: blur(7px) !important;
}
.firstBlur.modalDesaturate > *:not(.modal) {
  -webkit-filter: saturate(0%) !important;
}
/* === SOFTEN THE MODAL BACKDROP SO THE EFFECT IS MORE VISIBLE === */
.modal-backdrop {
  opacity: 0.65; 
  filter: alpha(opacity=65) !important;
}
.selected-color-label-display{display: none !important;}
.moving-in-out-painting-show{display: none !important;}
.additional-charges-display{display: none !important;}
.selected-ceilings-label-display{display: none !important;}
.summary-movein-out-service-show{display: none !important;}
.summary-paint-rooms-hide{display: none !important;}
.summary-paint-walls-hide{display: none !important;}
.mobile-total-price-btn{display: none !important;}

.qoute-summary-rooms{display: none !important;}
.qoute-summary-walls{display: none !important;}


/* VCSS */
.first-edit{position: relative;}
.first-edit-anch{position: absolute;top: auto;text-decoration: underline;left: 93%;bottom: 15%;}


.spinner_button{
    background-color: #000 !important;
    border: 2px solid #000 !important;
    color: #ffffff;
    border-radius: 50px;
    padding: 7px 40px 7px 40px;
}


    </style>
<section class="our-register">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 wow fadeInUp" data-  -delay="300ms">
                <div class="main-title">
                    {{-- <p class="step-p">Step 1 of 4</p> --}}
                    <h2 class="title step-title">Booking Summary</h2>
                    <hr class="step-underline">
                    {{-- <p class="paragraph">Give your visitor a smooth online experience with a solid UX design</p> --}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-1">
            </div>
        <div class="col-lg-6">
                <form id="category_form_new" action="{{ route('book-now-garden-order') }}" method="POST" class="mid_col">
                    @csrf
                    <input type="hidden" name="service" id="service" value="{{ $service_id }}">
                    <input type="hidden" name="subservice" id="subservice" value="{{ $subservice_id }}">
                    <input type="hidden" name="size_of_home_id" id="size_of_home_id" value="">

                <div class="tab1">

                {{-- For Gardening --}}

                @if($subservice_id == 78 || $subservice_id == 77)

                @if($subservice_id == 78)
                  <div class="image">
                        <img src="https://servicemarket.com/_next/image?url=%2Fdist%2Fcss%2Fimg%2Fservice%2Fgardening-companies%2Fgardening-companies.jpg&w=1920&q=75" width="100%">
                    </div>
                @elseif( $subservice_id == 77)
                    <div class="image">
                        <img src="https://servicemarket.com/_next/image?url=%2Fdist%2Fcss%2Fimg%2Fservice%2Fpest-control-companies%2Fpest-control.jpg&w=1920&q=75" width="100%">
                    </div>
                @endif

                @if($subservice_id == 78)
                <h5 class="font-weight-bold h3">Get quotes for your {{ $subservice_name }} Services </h5>
                    <p class="card-text"><span>Get up to 5 free quotes from top companies by filling out this short form.</span><br/>
                   
                        <a href="javascript:void(0)" data-bs-toggle="modal" id="read_more" data-bs-target="#GardeningModal_{{$subservice_id}}" style="text-decoration: underline;">
                            Read more
                        </a>
                    </p>
                @endif

                @if($subservice_id == 77)
                <h5 class="font-weight-bold h3">Get quotes for your {{ $subservice_name }} Services </h5>
                    <p class="card-text"><span>Get up to 5 free quotes from top companies by filling out this short form.</span><br/>
                   
                        <a href="javascript:void(0)" data-bs-toggle="modal" id="read_more" data-bs-target="#MousePestModal_{{$subservice_id}}" style="text-decoration: underline;">
                            Read more
                        </a>
                    </p>
                @endif

                @if($subservice_id == 78)
                    <div class="form-group mb-3">
                        <label class="form-label fw500 dark-color" for="country">Which service do you need quotes for?</label>
                        <select class="form-control searches_drop form-select"
                            id="service_type"
                            name="service_type" onchange="garden_calculation();">
                                @php
                                $GardeningService = array(
                                                    "General gardening and maintenance",
                                                    "Annual gardening contract",
                                                    "Gazebos, decks and porches",
                                                    "General gardening and maintenance",
                                                    "Grass and artificial lawns",
                                                    "Landscaping",);
                                @endphp
                            <option value="">Select Service Type</option>
                            @foreach ($GardeningService as $garden)
                            <option value="{{ $garden }}">
                                {{ $garden }}
                            </option>
                            @endforeach
                        </select>
                        <p style="color:red;" id="service_type_error"></p>
                    </div>
            @endif
                    <div class="form-group mb-3">
                        <label class="form-label fw500 dark-color" for="country">When do you need the service?</label> <br>
                        <input type="text" name="service_date" id="service_date" class="form-control" placeholder="Service Date" onchange="garden_calculation();">
                        <p style="color:red;" id="service_date_error"></p>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw500 dark-color" for="country">Which city do you need the service?</label> <br>
                        <select class="form-control searches_drop form-select"
                            id="city"
                            name="city">
                            <option value="">Select City</option>
                            @foreach ($city_data as $data)
                            <option value="{{ $data->id }}">
                                {{ $data->name }}
                            </option>
                            @endforeach
                        </select>
                        <p style="color:red;" id="city_error"></p>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw500 dark-color" for="country">Where do you need the service?</label> <br>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address">
                        <p style="color:red;" id="address_error"></p>
                    </div>

                   

                    <div class="form-group mb-3">
                        <label class="form-label fw500 dark-color"
                        for="country">What is the type of the unit you live in?</label><br>
                        <div class="radio-group size-of-home-tab1 owl-carousel owl-theme slider" id="live-type-slider" style="display: inline-flex;">  
                            @php
                                $form_attributes_data = DB::table('form_attributes')->where('form_id',$form_fileds_data->id)->get();

                                // echo"<pre>";print_r($form_fileds_data);echo"</pre>";exit;
                            @endphp
                            @foreach($form_attributes_data as $attributes_data)

                            @if(!($subservice_id == 78 && $attributes_data->form_option == 'Warehouse'))

                            <div class="hour_input items">
                            <input type="radio" id="type-of-home-{{ $attributes_data->id }}" name="type_of_home" value="{{ $attributes_data->form_option }}" onclick="type_of_homeGarden('{{ $attributes_data->form_option }}');">
                            <label for="type-of-home-{{ $attributes_data->id }}">{{ $attributes_data->form_option }}</label>
                            </div>
                            
                            @endif

                            @endforeach
                        </div>
                        <p style="color:red;" id="type_of_home_error"></p>
                    </div>

                    @foreach($form_attributes_data as $attributes_data)

                    @php
                        if($attributes_data->form_option == "Apartment"){
                            $form_option = "Apartment";
                        }elseif ($attributes_data->form_option == "Villa") {
                            $form_option = "Villa";
                        }elseif ($attributes_data->form_option == "Warehouse") {
                            $form_option = "Warehouse";
                        }elseif($attributes_data->form_option == "Office") {
                            $form_option = "Office";
                        }else{
                            $form_option = "Other";
                        }
                    @endphp
                    <div class="form-group main-garden-home-{{ $attributes_data->form_option }} {{  $form_option }}" style="display: none;">
                        <label class="form-label fw500 dark-color"
                        for="country">What is the size of your home?</label><br>
                        <div class="radio-group size-of-home-tab1 owl-carousel owl-theme slider" id="size-of-home-slider" style="display: inline-flex;">

                            @php
                             $more_form_attributes = DB::table('more_form_attributes')->where('form_id',$form_fileds_data->id)->where('attr_id',$attributes_data->id)->get();
                            @endphp
                            
                            @foreach($more_form_attributes as $more_attributes_data)
                            <div class="hour_input items">
                                <input type="radio" id="{{ $more_attributes_data->id }}" name="size_of_home_1" value="{{ $more_attributes_data->more_form_option }}">
                                <label for="{{ $more_attributes_data->id }}">{{ $more_attributes_data->more_form_option }}</label>
                                <p style="font-size: 9px; margin-left:14px;"></p>
                            </div>

                            @endforeach
                           
                         
                        </div>
                    </div>
                    @endforeach

                    <p style="color:red;" id="size_of_home_1_error"></p>

                    <div class="form-group mb-3">
                        <label class="form-label fw500 dark-color " for="country">Please describe the job in as much detail as possible (Optional)</label>
                        <textarea name="describe_your_requirements" id="describe_your_requirements" placeholder="If you have any other requirements, feel free to describe them here in as much detail as you want. Or just leave us a message to call you if its easier to explain on the phone"></textarea>

                        <p class="form-error-text" id="describe_your_requirements_error" style="color: red; margin-top: 10px;">
                        </p>
                    </div>

                @endif

                <button class="btn btn-primary mb-1 book-now-web spinner_button" type="button" disabled id="spinner_button" style="display: none;">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...</button>
                    <button type="button" class="ud-btn btn-thm default-box-shadow2 order_now custome-black book-now-web" id="book_now_garden" 
                    onclick="book_garden()">Get a Quote</button>
                </div>

            </form>
            </div>

            <div class="sticky-button">

                    <div class="d-flex justify-content-between" style="color:#000;">
                            
                        <i style="margin-left: 50%; margin-top:19px;" class="fa-solid fa-angle-up" id="aerrowicon"></i>

                        <button class="btn btn-primary mb-1 backMobile spinner-mobile-tab6 spinner_button" type="button" disabled id="spinner_button" style="color: #0d6efd;background-color: #fff;border-color: #fff;top: 15px; display:none;">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...</button>

                        <button type="button" class="ud-btn btn-thm default-box-shadow2 order_now custome-black backMobile mobile-tab6 mobile-booknow-btn" id="book_now_garden" onclick="book_garden();">Book Now </button>

                    </div>
            </div>

            
            <div class="col-lg-4" id="summary_div_left">
                <div  id="summary_div_left_package" class="last_col">
                <h3>Summary</h3>
                <span class="underline"></span>
                <div class="font-weight-bold-summary h5">Service Details</div>

                @if($subservice_id == 78 || $subservice_id == 77)

                @if($subservice_id == 78)
                <div class="d-flex justify-content-between">
                    <div>Service Type</div>
                    <div class="font-weight-bold sm-summary" id="left_service_type"></div>
                </div>
                @endif

                <div class="d-flex justify-content-between">
                    <div>Date</div>
                    <div class="font-weight-bold sm-summary" id="left_service_date"></div>
                </div>

                <div class="d-flex justify-content-between">
                    <div>Address</div>
                    <div class="font-weight-bold sm-summary" id="left_address"></div>
                </div>
                <span class="underline"></span>
                @endif
            </div>
        </div>

        {{-- For mobile view Start--}}
        <div class="summary_div_left_mobile" id="summary_div_left_mobile" style="display: none;">
                <div class="summuryInner">
                     <button type="button" class="close closeBtn" id="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                @if($subservice_id == 78 || $subservice_id == 77)
                <h3>Summary</h3>
                <span class="underline"></span>
                <div class="font-weight-bold-summary h5">Service Details</div>

                @if($subservice_id == 78)
                    <div class="d-flex justify-content-between">
                        <div>Service Type</div>
                        <div class="font-weight-bold sm-summary" id="mobile_left_service_type"></div>
                    </div>
                @endif

                    <div class="d-flex justify-content-between">
                        <div>Date</div>
                        <div class="font-weight-bold sm-summary" id="mobile_left_service_date"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>Address</div>
                        <div class="font-weight-bold sm-summary" id="mobile_left_address"></div>
                    </div>
                @endif
            </div>
        </div>

         {{-- For mobile view End--}}

       
    </div>
</section>
@include('front.includes.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>





{{-- For Gardening Read more Popup Start --}}
<div class="modal fade" id="GardeningModal_{{$subservice_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div id="modal-digi" class="modal-dialog" role="document" style="">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;">
                    How to use this service: </h5>
                    <button type="button" class="close" id="close" data-bs-dismiss="modal" aria-label="Close" style="background: none; font-size: 50px; color: #000; border: none;">
                        <span aria-hidden="true">&times;</span>
                        </button>
            </div>

        <div class="row">
            <div class="col-md-6">
            <img src="https://servicemarket.com/_next/image?url=%2Fdist%2Fcss%2Fimg%2Fservice%2Fgardening-companies%2Fgardening-companies.jpg&w=640&q=75" style="width: 100%; padding:5%;">
           </div>

           <div class="col-md-6">

            <ul style="list-style-type: disc; list-style: inherit;">
                <li style="list-style: inherit;">Fill out this short form, and our professional companies will submit their best quote for your request.</li>
                <li style="list-style: inherit;">You will receive the quotes over email, and can view them anytime in your User account, under My Quotes.</li>
                <li style="list-style: inherit;">Compare your quotes and user reviews, choose the company of your choice, and contact them directly to book a service.</li>
                <li style="list-style: inherit;">All companies on our platform are licensed and vetted through hundreds of genuine customer reviews.</li>
            </ul>

           </div>

        </div>

        </div>
    </div>
</div>

{{-- For Gardening Read more Popup End --}}

{{-- For Mouse and pest Read more Popup Start --}}
<div class="modal fade" id="MousePestModal_{{$subservice_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div id="modal-digi" class="modal-dialog" role="document" style="">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;">
                    How to use this service: </h5>
                    <button type="button" class="close" id="close" data-bs-dismiss="modal" aria-label="Close" style="background: none; font-size: 50px; color: #000; border: none;">
                        <span aria-hidden="true">&times;</span>
                        </button>
            </div>

        <div class="row">
            <div class="col-md-6">
            <img src="https://servicemarket.com/_next/image?url=%2Fdist%2Fcss%2Fimg%2Fservice%2Fpest-control-companies%2Fpest-control.jpg&w=1920&q=75" style="width: 100%; padding:5%;">
           </div>

           <div class="col-md-6">

            <ul style="list-style-type: disc; list-style: inherit;">
                <li style="list-style: inherit;">Fill out this short form, and our professional companies will submit their best quote for your request.</li>
                <li style="list-style: inherit;">You will receive the quotes over email, and can view them anytime in your User account, under My Quotes.</li>
                <li style="list-style: inherit;">Compare your quotes and user reviews, choose the company of your choice, and contact them directly to book a service.</li>
                <li style="list-style: inherit;">All companies on our platform are licensed and vetted through hundreds of genuine customer reviews.</li>
            </ul>

           </div>

        </div>

        </div>
    </div>
</div>

{{-- For Mouse pest Read more Popup End --}}


<div class="modal fade login-form-modal" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="true" data-keyboard="true">
    <div class="modal-dialog user-modal-dialog">
        <div class="modal-content details-modal-content">
          <div class="modal-header details-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">Your Details</h5>
            <button type="button" class="btn-close d-none" data-dismiss="modal" aria-label="Close"></button>
          </div> 
          <div class="modal-body">
            <form class="form-horizontal details-form" id="userDetailForm" method="POST" action="{{ route('user-detail-login') }}">
                @csrf
              <input type="hidden" name="action" id="action" value="user-detail-form">
              <input type="hidden" name="redirectUrl" value="{{ $redirectUrl }}">
              <input type="hidden" name="service_id" id="service_id" value="{{ $service_id }}">
              <input type="hidden" name="subservice_id" id="subservice_id" value="{{ $subservice_id }}">
              <div class="form-group mb-2">
                <label for="user-name">Your Name</label>
                <input type="text" placeholder="Enter Your Name" class="input-field" name="name" id="user-name">
                <p id="name-error" style="display: none;color:red;"></p>
              </div>
              <div class="form-group mb-2">
                <label for="user-name">Your Phone Number</label>
                <input type="hidden" name="country_code" id="country_code" value="">
                <input type="text" class="input-field" name="phone" id="user-phone-number" placeholder="Mobile No" onkeypress="return validateNumber(event)">
                
                 
                 <p id="phone-error" style="display: none;color:red;"></p>
              </div>
              <div class="form-group mb-2">
                <label for="user-name">Your Email</label>
                 <input type="email" class="input-field" name="email" id="user-email" placeholder="Your Email Address">
                 <p id="email-error" style="display: none;color:red;"></p>
              </div>
             
              <div class="col-md-12 text-center">
                <button type="button" class="ud-btn btn-thm default-box-shadow2 detail-continue-btn" onclick="javascript:userPopupLoginForm()" id="submit_button">Continue</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>


<script>

function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if (key < 48 || key > 57) {
        return false;
    } else {
        return true;
    }
}
@if(Session::get('user') =="")
$(document).ready(function() {
  $('#exampleModalLong').modal({
    backdrop: 'static',  // Prevent closing on clicking outside
    keyboard: false       // Prevent closing with ESC key
  }).modal('show');      // Show the modal on page load
});

$(document).ready(function() {
    $('#exampleModalLong').modal('show'); // Show the modal on page load
  });
@endif

const phoneInputField = document.querySelector("#user-phone-number"); // flagphone
const phoneInput = window.intlTelInput(phoneInputField, {
  initialCountry: "ae",  // UAE flag and country code (+971) as default
  separateDialCode: true, // Separate country code from the number field
  autoPlaceholder: "aggressive",
  utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
});

// Function to get the selected country code
function getCountryCode() {
  const countryData = phoneInput.getSelectedCountryData();
  const countryCode = countryData.dialCode; // Get the dial code (country code)
  console.log(countryCode); // Example: "+971" for UAE
  return countryCode;
}

    function userPopupLoginForm(){

        var name = $('#user-name').val();
        if (name == '') {
            jQuery('#name-error').html("Please enter a your name");
            jQuery('#name-error').show().delay(0).fadeIn('show');
            jQuery('#name-error').show().delay(2000).fadeOut('show');
            return false;
        }

        var email = $('#user-email').val();
        if (email == '') {
            jQuery('#email-error').html("Please enter a your email");
            jQuery('#email-error').show().delay(0).fadeIn('show');
            jQuery('#email-error').show().delay(2000).fadeOut('show');
            return false;
        }

        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(email)) {

            jQuery('#email-error').html("Please Enter Valid Email");
            jQuery('#email-error').show().delay(0).fadeIn('show');
            jQuery('#email-error').show().delay(2000).fadeOut('show');
            return false;

        }

        var mobile = jQuery("#user-phone-number").val();
        if (mobile == '') {

            jQuery('#phone-error').html("Please Enter Mobile No");
            jQuery('#phone-error').show().delay(0).fadeIn('show');
            jQuery('#phone-error').show().delay(2000).fadeOut('show');
            return false;

        }
        if (mobile != '') {
            // var filter = /^\d{7}$/;
            if (mobile.length < 7 || mobile.length > 15) {
                jQuery('#phone-error').html("Please Enter Valid Mobile Number");
                jQuery('#phone-error').show().delay(0).fadeIn('show');
                jQuery('#phone-error').show().delay(2000).fadeOut('show');
                return false;
            }
        }

       const selectedCountryCode = getCountryCode();
       $("#country_code").val(selectedCountryCode);
       

        $("#userDetailForm").submit();


    }

$(document).ready(function(){
    $("#size-of-home-slider").owlCarousel({
        loop: false,          // Enables infinite looping
        margin: 0,          // Adjust the margin between items
        nav: false,
        dots:false,           // Show navigation buttons
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 6
            }
        }
    });
});

$(document).ready(function(){
    $("#size-of-villa-slider").owlCarousel({
        loop: false,          // Enables infinite looping
        margin: 0,          // Adjust the margin between items
        nav: false,
        dots:false,           // Show navigation buttons
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 6
            }
        }
    });
});

$(document).ready(function(){
    $("#size-of-warehouse-slider").owlCarousel({
        loop: false,          // Enables infinite looping
        margin: 0,          // Adjust the margin between items
        nav: false,
        dots:false,           // Show navigation buttons
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
});

$(document).ready(function(){
    $("#live-type-slider").owlCarousel({
        loop: false,          // Enables infinite looping
        margin: 0,          // Adjust the margin between items
        nav: false,
        dots:false,           // Show navigation buttons
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });
});


    function type_of_homeGarden(value) {

        if(value == 'Apartment'){
            $('.main-garden-home-'+ value).show();
            $('.Villa').hide();
            $('.Warehouse').hide();
            $('.Office').hide();
            $('.Other').hide();
        }else if(value == 'Villa'){
            $('.main-garden-home-'+ value).show();
            $('.Apartment').hide();
            $('.Warehouse').hide();
            $('.Office').hide();
            $('.Other').hide();
        }else if(value == 'Warehouse'){
            $('.main-garden-home-'+ value).show();
            $('.Apartment').hide();
            $('.Villa').hide();
            $('.Office').hide();
            $('.Other').hide();
        }else{
            $('.Apartment').hide();
            $('.Villa').hide();
            $('.Warehouse').hide();
            $('.Office').hide();
            $('.Other').hide();

        }
            $('.main-garden-home-' + value + ' input[type="radio"], .garden-villa-div input[type="radio"]').prop('checked', false);
        }

    $(function() {
            $('#service_date').datepicker({
                format: 'dd-mm-yyyy', // Ensure this format matches backend expectation
                autoclose: true,
                todayHighlight: true
            }).on('changeDate', function(e) {
                $(this).datepicker('hide'); // Hide datepicker after selection
            });
        });

function garden_calculation(){

        let service_type = $('#service_type').val();
        let service_date = $('#service_date').val();

        $('#left_service_type').html(service_type);
        $('#mobile_left_service_type').html(service_type);
        $('#left_service_date').html(service_date);
        $('#mobile_left_service_date').html(service_date);
    }

    $(document).ready(function () {
            $('#address').on('input', function () {
                var address = $(this).val();
                $('#left_address').text(address);
                $('#mobile_left_address').text(address);
            });
        });

function validateSizeOfHome() {

   
    var type_of_home_size = document.getElementsByName('size_of_home_1');
    var selected = false;

    // Loop through radio buttons to check if one is selected
    for (var i = 0; i < type_of_home_size.length; i++) {
        if (type_of_home_size[i].checked) {
            selected = true;
            break;
        }
    }

    if (!selected) {
        jQuery('#size_of_home_1_error').html("Please Select Size of Home");
        jQuery('#size_of_home_1_error').show().delay(0).fadeIn('show');
        jQuery('#size_of_home_1_error').show().delay(2000).fadeOut('show');
        $('html, body').animate({
            scrollTop: $('#size_of_home_1_error').offset().top - 150
        }, 1000);
        return false;
    }
    
    return true;
  
}

  

        function book_garden(){

        var subservice_id = jQuery('#subservice').val();
            // alert('here');
            if(subservice_id == 78){
            var service_type = $('#service_type').val();
            if (service_type == '') {
                jQuery('#service_type_error').html("Please Select the type of Service");
                jQuery('#service_type_error').show().delay(0).fadeIn('show');
                jQuery('#service_type_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#service_type_error').offset().top - 150
                }, 1000);
                return false;
            } 
        }

            var service_date = $('#service_date').val();
            if (service_date == '') {
                jQuery('#service_date_error').html("Please Select the Service Date");
                jQuery('#service_date_error').show().delay(0).fadeIn('show');
                jQuery('#service_date_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#service_date_error').offset().top - 150
                }, 1000);
                return false;
            } 

            var city = $('#city').val();
            if (city == '') {
                jQuery('#city_error').html("Please Select City");
                jQuery('#city_error').show().delay(0).fadeIn('show');
                jQuery('#city_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#city_error').offset().top - 150
                }, 1000);
                return false;
            } 

            var address = $('#address').val();
            if (address == '') {
                jQuery('#address_error').html("Please Enter Address");
                jQuery('#address_error').show().delay(0).fadeIn('show');
                jQuery('#address_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#address_error').offset().top - 150
                }, 1000);
                return false;
            } 
            var type_of_home = document.querySelector('input[name="type_of_home"]:checked');
                if (type_of_home) {
                    type_of_home = type_of_home.value;
                } else {
                    type_of_home = ''; 
                }

                if (type_of_home == "") {
                    jQuery('#type_of_home_error').html("Please Select Type of Home");
                    jQuery('#type_of_home_error').show().delay(0).fadeIn('show');
                    jQuery('#type_of_home_error').show().delay(2000).fadeOut('show');
                    $('html, body').animate({
                        scrollTop: $('#type_of_home_error').offset().top - 150
                    }, 1000);
                    return false;
                }
    

                if (type_of_home === "Apartment" || type_of_home === "Villa" || type_of_home === "Warehouse") {
                    if (!validateSizeOfHome()) {
                        return false;
                    }
                }

            $('#category_form_new').submit();
            $('#book_now_garden').hide();
            $('#spinner_button').show();

    }
</script>

<script>
     // Arrow Icon Click Event
     document.getElementById('aerrowicon').addEventListener('click', function () {
                var summaryDiv = document.getElementById('summary_div_left_mobile');
                var aerrowIcon = document.getElementById('aerrowicon');
                
                // Toggle the 'open' class on click to slide the div up or down
                if (summaryDiv.classList.contains('open')) {
                    summaryDiv.classList.remove('open');
                    aerrowIcon.style.transition = 'transform 0.3s ease'; // Smooth transition
                    aerrowIcon.style.transform = 'rotate(0deg)'; // Reset rotation
                } else {
                    summaryDiv.classList.add('open');
                    aerrowIcon.style.transition = 'transform 0.3s ease'; // Smooth transition
                    aerrowIcon.style.transform = 'rotate(180deg)'; // Rotate icon
                }
            });

            // Close Button Click Event
            document.getElementById('close').addEventListener('click', function () {
                var summaryDiv = document.getElementById('summary_div_left_mobile');
                var aerrowIcon = document.getElementById('aerrowicon');

                // Close the div and reset the arrow icon
                if (summaryDiv.classList.contains('open')) {
                    summaryDiv.classList.remove('open');
                    aerrowIcon.style.transition = 'transform 0.3s ease'; // Smooth transition
                    aerrowIcon.style.transform = 'rotate(0deg)'; // Reset rotation
                }
            });

</script>
<script>
    $(document).ready(function(){
        $('input[name="type_of_home"]').on('change', function(){

            const type_of_home = $('input[name="type_of_home"]:checked').val();
            let selectedId;

             if (type_of_home === "Office") {
                selectedId = 69;
            } else if (type_of_home === "Other") {
                selectedId = 70;
            } else {
                selectedId = "";
            }

            $('#size_of_home_id').val(selectedId);
        });
    });

    $(document).ready(function(){
        $('input[name="size_of_home_1"]').on('change', function(){
            let selectedId = $(this).attr('id');
            $('#size_of_home_id').val(selectedId);
        });
    });
</script>


    

