@include('front.includes.header')
<style>

        .backMobile {
            position: absolute;
            right: 15px;
            top: 10px;
        }
        .calendar-day.disabled {
        opacity: 0.5; /* Optional: Lowers opacity to enhance the disabled effect */
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
        height: 700px;
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
    #mobile_view_br{
        display: none !important; 
    }
    .need_cleaner .owl-stage-outer .owl-stage{
        padding-top : 8px !important; 
    }
    #when_would_you_start_slider {
    padding: 0 20px 0 25px;
    }

    #when_would_you_start_slider .owl-nav .owl-next {
        position: absolute;
        top: 28px;
        right: -8px;
    }
    #when_would_you_start_slider .owl-nav .owl-prev {
        position: absolute;
        top: 28px;
        left: -5px;
    }
    #when_would_you_start_slider .owl-theme .owl-nav [class*=owl-]:hover {
        background: transparent;
        color: unset;
        text-decoration: none;
    }
  /* Show the button on mobile screens (less than 768px wide) */
  @media only screen and (max-width: 768px) {
    
    /* .owl-carousel {
    padding-right: 10px; 
    } */
    .cleaning-mobile{
        margin-bottom: 0px !important;
    }
    #how_many_hours_need_cleaner_slider {
        padding:0 10px;
     }
     #how_many_cleaner_require_slider{
        padding:0 10px;
     }
     #how_many_hours_need_cleaner_slider .owl-nav {
        text-align: unset;
        margin: 0;
     }
     #how_many_hours_need_cleaner_slider .owl-nav .owl-next{
        float: right;
     }

     #how_many_cleaner_require_slider .owl-nav {
        text-align: unset;
        margin: 0;
     }
     #how_many_cleaner_require_slider .owl-nav .owl-next{
        float: right;
     }

    #when_would_you_start_slider {
    padding: 0 20px 0 25px;
    }

    #when_would_you_start_slider .owl-nav .owl-next {
        position: absolute;
        top: 28px;
        right: -8px;
    }
    #when_would_you_start_slider .owl-nav .owl-prev {
        position: absolute;
        top: 28px;
        left: -5px;
    }
    .owl-theme .owl-nav .disabled {
        opacity:unset;
        cursor: default;
    }

    .owl-theme .owl-nav [class*=owl-]:hover {
        background: transparent;
        color: unset;
        text-decoration: none;
    }

    .owl-item.active {
    width: auto !important;
    }

    .hour_input label{
        border-radius: 50px !important;
        padding: 2px 23px !important;
    }
    #mobile_view_br{
    display: block !important; 
    }
    #modal-digi{
        max-width: 100% !important;
    }
    .modal-dialog {
    max-width: 60%; /* Keep the width as needed */
    height: 700px; /* Height of the entire modal */
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
    .modal-body {
        height: 100%;
        max-height: calc(100% - 120px); /* Adjust for modal header and footer */
        overflow-y: auto; 
        -webkit-overflow-scrolling: touch; /* Enables smooth scrolling on iOS */
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
    .mobile-next{
    top: 20px !important;
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
        padding: 10px 20px;
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
        color: #0040E6;
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
        border: 2px solid #0040E6;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    /* Default button style */
    .checkbox-group label {
        background-color: #fff;
        color: #0040E6;
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
        /* display: inline-block; */
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
    .slider{
        /* padding: 0 20px 0 7px !important;  */
    }
    .hour_input label{
        border-radius: 50px;
        padding: 7px 25px;
    }
    .popular{
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
        box-shadow: 0 6px 15px #00000029;
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
        max-width: 50%;
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
        padding: 5px 0px 7px 67px;
        border-radius: 11px;
    }
    .fixed-title {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background-color: white; /* Adjust as needed */
        z-index: 1000; /* Ensure it stays above other content */
        padding: 0; /* Add padding if needed */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional shadow */
    }
    .step-fix {
        position: fixed;
        top: 144px !important; 
        left: 0;
        right: 0;
        background-color: white; /* Adjust as needed */
        z-index: 1000; /* Ensure it stays above other content */
        padding: 0 12px; /* Add padding if needed */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional shadow */
    }
    </style>
<section class="our-register">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 wow fadeInUp" data-  -delay="300ms">
                <div class="main-title">
                    <p class="step-p">Step 1 of 4</p>
                    <h2 class="title step-title">Service Details</h2>
                    <hr class="step-underline">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2">
            </div>
        <div class="col-lg-6">
                <form id="category_form_new" action="{{ route('book_now_order') }}" method="POST" class="mid_col">
                    @csrf

                    <input type="hidden" name="service_id" id="service_id" value="{{ $service_id }}">
                    <input type="hidden" name="subservice_id" id="subservice_id" value="{{ $subservice_id }}">
                <div class="tab1">

                    @php
                            $system_data = DB::table('system')->where('id',1)->first();
                            //echo"<pre>";print_r($system_data);echo"</pre>";exit;
                            if($system_data->weekly_percentage > 0 && $system_data->weekly_percentage != ''){
                                $weekly_discout = " ".$system_data->weekly_percentage."% off Per Visit ";
                                $weekly_discout_1 =$system_data->weekly_percentage;
                            }else{
                                $weekly_discout ="";
                                $weekly_discout_1 = "";
                            }
                            if($system_data->multiple_time_week > 0 && $system_data->multiple_time_week != ''){
                                $multiple_time_week_discout = " ".$system_data->multiple_time_week."% off Per Visit ";
                                $multiple_time_week_discout_1 =$system_data->multiple_time_week;
                            }else{
                                $multiple_time_week_discout ="";
                                $multiple_time_week_discout_1 = "";
                            }
                        @endphp


                    @if($subservice_id == 30 || $subservice_id == 28)
                    {{-- <div class="image">
                        <img src="https://servicemarket.imgix.net/dist/css/img/service/cleaning-maid-services/about-cleaning.jpg" width="100%">
                    </div> --}}

                    <h5 class="font-weight-bold h3">{{ $subservice_name }} </h5>
                    <p class="card-text"><span>Complete the booking form, and we'll match you with a top-notch cleaner to ensure your home sparkles with freshness and comfort.</span>
                        @if($subservice_id == 28)
                        <a href="javascript:void(0)" data-bs-toggle="modal" id="read_more" data-bs-target="#exampleModalLong_{{$subservice_id}}" style="text-decoration: underline;">
                            Read more about Our Home Cleaning Service includes.
                        </a>
                    @endif
                    </p>

                    <div class="form-group mb-3">
                        <label class="form-label fw500 dark-color " for="country">How many hours do you need your cleaner <span><br id="mobile_view_br"></span> to stay? 
                            @if($subservice_id == 28)
                            <span> 
                                <a style="cursor: pointer;" data-bs-toggle="modal" id="cleaner_stay" data-bs-target="#Learnmore_{{$subservice_id}}">
                                <i class="fa-solid fa-info" style="background: #ffda40;
                                border-radius: 50%;padding: 0;height: 29px;width: 31px;text-align:center;font-weight:1000;color:#000;"></i>
                                </span>
                           <span id="learn_more" style="font-weight:50;"> Learn more</span></a>@endif
                        </label>
                        <div class="radio-group need_cleaner owl-carousel owl-theme slider" style="display: inline-flex;" id="how_many_hours_need_cleaner_slider">
                            
                            
                            @php
                            $cleaning_price = DB::table('cleanin_subserviceprice')->Where('subservice_id',$subservice_id)->get()->toArray();
                            // echo"<pre>";print_r($cleaning_price[0]);echo"</pre>";
                            @endphp
                        <div class="hour_input items">
                            <input type="radio" id="how_many_hours_2" name="how_many_hours_should_they_stay" value="2" checked onclick="calculation()">
                            <label for="how_many_hours_2">2</label>
                            <p style="font-size: 9px; margin:0 0 0 14px;">AED {{$cleaning_price[0]->hourly_price}}/hr</p>
                        </div>
                    
                        <div class="hour_input items" >
                            <input type="radio" id="how_many_hours_3" name="how_many_hours_should_they_stay" value="3" onclick="calculation()">
                            <label for="how_many_hours_3">3</label>
                            <p style="font-size: 9px; margin:0 0 0 14px;">AED {{$cleaning_price[1]->hourly_price}}/hr</p>
                        </div>

                        <div class="hour_input items" style="position: relative;">
                            <span class="popular">Popular</span>
                            <input type="radio" id="how_many_hours_4" name="how_many_hours_should_they_stay" value="4" onclick="calculation()">
                            <label for="how_many_hours_4">4</label>
                            <p style="font-size: 9px; margin:0 0 0 14px;">AED {{$cleaning_price[2]->hourly_price}}/hr</p>
                        </div>

                        <div class="hour_input items">
                            <input type="radio" id="how_many_hours_5" name="how_many_hours_should_they_stay" value="5" onclick="calculation()">
                            <label for="how_many_hours_5">5</label>
                            <p style="font-size: 9px; margin:0 0 0 14px;">AED {{$cleaning_price[3]->hourly_price}}/hr</p>
                        </div>
                        <div class="hour_input items">
                            <input type="radio" id="how_many_hours_6" name="how_many_hours_should_they_stay" value="6" onclick="calculation()">
                            <label for="how_many_hours_6">6</label>
                            <p style="font-size: 9px; margin:0 0 0 14px;">AED {{$cleaning_price[4]->hourly_price}}/hr</p>
                        </div>
                        <div class="hour_input items">
                            <input type="radio" id="how_many_hours_7" name="how_many_hours_should_they_stay" value="7" onclick="calculation()">
                            <label for="how_many_hours_7">7</label>
                            <p style="font-size: 9px; margin:0 0 0 14px;">AED {{$cleaning_price[5]->hourly_price}}/hr</p>
                        </div>
                        <div class="hour_input items">
                            <input type="radio" id="how_many_hours_8" name="how_many_hours_should_they_stay" value="8" onclick="calculation()">
                            <label for="how_many_hours_8">8</label>
                            <p style="font-size: 9px; margin:0 0 0 14px;">AED {{$cleaning_price[6]->hourly_price}}/hr</p>
                        </div>
                        </div>
                        <p class="form-error-text" id="how_many_hours_should_they_stay_error" style="color: red; margin-top: 10px;">
                        </p>
                    </div>
                    

                    <div class="form-group mb-3">
                        <label class="form-label fw500 dark-color " for="country">How many cleaners do you require?</label>
                        <div class="radio-group hour_input owl-carousel owl-theme slider" id="how_many_cleaner_require_slider">

                            <div class="items">
                                <input type="radio" id="1" name="how_many_cleaners_do_you_need" value="1" checked onclick="calculation()">
                                <label for="1">1</label>
                            </div>
                            
                            <div class="items">
                                <input type="radio" id="2" name="how_many_cleaners_do_you_need" value="2" onclick="calculation()">
                                <label for="2">2</label>
                            </div>
                    
                            <div class="items">
                                <input type="radio" id="3" name="how_many_cleaners_do_you_need" value="3" onclick="calculation()">
                                <label for="3">3</label>
                            </div>

                            <div class="items">
                                <input type="radio" id="4" name="how_many_cleaners_do_you_need" value="4" onclick="calculation()">
                                <label for="4">4</label>
                            </div>

                            <div class="items">
                                <input type="radio" id="5" name="how_many_cleaners_do_you_need" value="5" onclick="calculation()">
                                <label for="5">5</label>
                            </div>

                            <div class="items">
                                <input type="radio" id="6" name="how_many_cleaners_do_you_need" value="6"  onclick="calculation()">
                                <label for="6">6</label>
                            </div>
                        </div>

                        <p class="form-error-text" id="how_many_cleaners_do_you_need_error" style="color: red; margin-top: 10px;">
                        </p>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw500 dark-color" for="country">How often do you need cleaning?</label>
                        
                        {{-- <select class="form-control" name="how_often_do_you_need_cleaning" id="how_often_do_you_need_cleaning" onchange="cleaning_change(this.value)">
                            <option value="">Select</option>
                            <option value="Once">Once </option>
                            <option value="Weekly">Weekly {{$weekly_discout}}</option>
                            <option value="Multiple times a week">Multiple times a week {{$multiple_time_week_discout}}</option>
                        </select> --}}
                        <div class="radio-group radio-checked">
                            <div class="button_weekly">
                            <input type="radio" id="cleaning_once" name="how_often_do_you_need_cleaning" value="Once" onclick="cleaning_change(this.value)" checked>
                            <label for="cleaning_once"><span style="font-weight:1000; ">ONCE</span>
                            <ul>
                                <li style="font-weight:500;">One Time Cleaning Session</li>
                            </ul>
                            </label>
                            </div>
                        
                            <div class="button_weekly">
                            <input type="radio" id="cleaning_weekly" name="how_often_do_you_need_cleaning" value="Weekly" onclick="cleaning_change(this.value)">
                            <label for="cleaning_weekly"><span><b>WEEKLY</b></span><span class="cleaning_weekly_new"><b>{{$weekly_discout}}</b></span>
                            <ul>
                                <li style="font-weight:500;">Get the same cleaner each time</li>
                                <li style="font-weight:500;">Easily manage your subscription</li>
                            </ul>
                            </label>
                            </div>
                        
                            <div class="button_weekly">
                            <input type="radio" id="cleaning_multiple_times" name="how_often_do_you_need_cleaning" value="Multiple times a week" onclick="cleaning_change(this.value)">
                            <label for="cleaning_multiple_times"><span><b>Multiple Times a Week</b></span><span class="cleaning_weekly_new"><b>{{$multiple_time_week_discout}}</b></span>
                            <ul>
                                <li style="font-weight:500;">Get the same cleaner each time</li>
                                <li style="font-weight:500;">Easily manage your subscription</li>
                            </ul>
                            </label>
                            </div>
                            <p class="form-error-text" id="how_often_do_you_need_cleaning_error" style="color: red; margin-top: 10px;">
                        </p>
                        </div>
                        

                    </div>

                    <div class="form-group mb-3" style="display: none" id="weekly_div">
                        <label class="form-label fw500 dark-color " for="country">Which days of the week do you want the service?</label>

                        <div class="checkbox-group">
                            <input type="checkbox" id="Monday"   name="which_day_of_the_week_do_you_want_the_service[]" value="Monday">
                            <label for="Monday">Monday</label>
                    
                            <input type="checkbox" id="Tuesday" name="which_day_of_the_week_do_you_want_the_service[]" value="Tuesday">
                            <label for="Tuesday">Tuesday</label>
                    
                            <input type="checkbox" id="Wednesday" name="which_day_of_the_week_do_you_want_the_service[]" value="Wednesday">
                            <label for="Wednesday">Wednesday</label>

                            <input type="checkbox" id="Thursday" name="which_day_of_the_week_do_you_want_the_service[]" value="Thursday">
                            <label for="Thursday">Thursday</label>

                            <input type="checkbox" id="Friday" name="which_day_of_the_week_do_you_want_the_service[]" value="Friday">
                            <label for="Friday">Friday</label>

                            <input type="checkbox" id="Saturday" name="which_day_of_the_week_do_you_want_the_service[]" value="Saturday">
                            <label for="Saturday">Saturday</label>

                            <input type="checkbox" id="Sunday" name="which_day_of_the_week_do_you_want_the_service[]" value="Sunday">
                            <label for="Sunday">Sunday</label>
                        </div>

                        <p class="form-error-text" id="which_day_of_the_week_do_you_want_the_service_error" style="color: red; margin-top: 10px;">
                        </p>

                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw500 dark-color cleaning-mobile" for="country">Need cleaning materials? </label>
                        <img src="{{ asset('public/site/images/dettol.png') }}" style="height: 25px;margin-right:-13px;">
                       <p class="dettol">Powered by Dettol</p>
                       <span><br id="mobile_view_br"></span>
                       <div>
                       @if($subservice_id == 28)
                            <span> 
                            <a style="cursor: pointer;" data-bs-toggle="modal" id="cleaner_stay" data-bs-target="#material_{{$subservice_id}}">
                            <i class="fa-solid fa-info" style="background: #ffda40;
                            border-radius: 50%;padding: 0;height: 29px;width: 31px;text-align:center;font-weight:1000;color:#000;"></i>
                            </span> <span> Learn more</span></a>@endif
                        </div>
                        <p style="font-size:13px;">An additional charge of AED 10/hr applies.</p>
                        <div class="radio-group">
                        <div class="material">
                            <input type="radio" id="do_you_need_yes" name="do_you_need_cleaning_material" value="Yes" onclick="calculation()">
                            <label for="do_you_need_yes">Yes</label>

                            <input type="radio" id="do_you_need_no" name="do_you_need_cleaning_material" value="No" onclick="calculation()" checked>
                            <label for="do_you_need_no">No</label>
                        </div>
                        </div>
                        <p class="form-error-text" id="do_you_need_cleaning_material_error" style="color: red; margin-top: 10px;">
                        </p>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw500 dark-color " for="country">Do you have any special instructions?</label>
                        <textarea name="any_special_instruction" id="any_special_instruction" placeholder="Example: You need a gate pass to enter the community, building code is #1234, etc."></textarea>

                        <p class="form-error-text" id="any_special_instruction_error" style="color: red; margin-top: 10px;">
                        </p>
                    </div>

                    @endif

                    @if($subservice_id == 29)
                        
                    <div class="image">
                        <img src="https://servicemarket.imgix.net/dist/css/img/service/deep-cleaning/deep-cleaning.jpg?auto=format&q=46" width="100%">
                    </div>

                    <h5 class="font-weight-bold h3">{{ $subservice_name }} </h5>
                    @php

                            //  echo '<pre>ddddddddddd';
                            // print_r(session('book_array_package_id'));
                            // echo '</pre>';

                        $book_array_package_id_session = session('book_array_package_id');

                        if($book_array_package_id_session != ''){
                            $book_array_package_id_session = $book_array_package_id_session;
                        }else{
                            $book_array_package_id_session = array();
                        }
                        $package_cat = DB::table('package_categories')
                                        ->where('service_id',$service_id)
                                        ->where('subservice_id',$subservice_id)
                                        ->get()->toArray();

                        //echo"<pre>";print_r($book_array_package_id_session);echo"</pre>";exit;
                    @endphp


                        <div class="form-group mb-3">
                            <div class="radio-group">
                                @if(!empty($package_cat))

                                    @foreach($package_cat as $package_cat_data)
                                        <input type="radio" id="{{ $package_cat_data->id }}" name="package_cat" value="{{ $package_cat_data->id }}" checked >
                                        <label for="{{ $package_cat_data->id }}">{{ $package_cat_data->name }}</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        @if(!empty($package_cat))

                            @foreach($package_cat as $package_cat_data)

                            @php
                                $package = DB::table('packages')
                                                ->where('service_id',$service_id)
                                                ->where('subservice_id',$subservice_id)
                                                ->where('packagecategory_id',$package_cat_data->id)
                                                ->get()->toArray();

                                //$package =array();

                                //echo"<pre>";print_r($package);echo"</pre>";
                            @endphp

                            <div class="form-group mb-3" >
                                @if(!empty($package))

                                @foreach($package as $package_data)
                                
                                    <h5>{{ $package_data->name }}</h5>
                                    <div class="row mb30">
                                        <div class="col-lg-6">
                                            AED {{ $package_data->price }}
                                        </div>
                                        <div class="col-lg-6">
                                            @if(in_array($package_data->id, $book_array_package_id_session))
                                            {{-- <button type="button" class="btn border border-primary rounded text-primary add-to-card px-3" id="nextBtn12"
                                            onclick="remove_to_cart('{{ $package_data->id }}')">Remove -</button> --}}
                                            {{ 'Already Added' }}
                                            @else
                                            <button type="button" class="btn border border-primary rounded text-primary add-to-card px-3" id="nextBtn12"
                                            onclick="add_to_cart_book('{{ $package_data->id }}')">Add +</button>

                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                            </div>
                            @endforeach
                        @endif
                            
                    @endif

                    <button type="button" class="ud-btn btn-thm default-box-shadow2 custome-black  mobile-hide" id="nextBtn12"
                                onclick="get_hide_show(2);">Next</button>
                </div>

                <div class="tab2" style="display:none">
                    <div class="form-group mb-3">
                    <label class="form-label fw500 dark-color " for="country">When would you like your service?</label>
                    <div class="calendar-input">
                        <p style="font-size:19px; font-weight:bold;" id="month_design" ></p>
                        <div class="calendar-container">
                           
                            <button class="scroll-arrow" id="scroll-left" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <rect fill="none" height="24" width="24"></rect>
                                    <g>
                                        <polygon points="17.77,3.77 16,2 6,12 16,22 17.77,20.23 9.54,12"></polygon>
                                    </g>
                                </svg>
                            </button>
                            <div class="dates-container" id="dates-container">
                                <div class="days-wrapper" id="days-wrapper"></div>
                            </div>
                            <button class="scroll-arrow" id="scroll-right" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                    <g>
                                        <path d="M0,0h24v24H0V0z" fill="none"></path>
                                    </g>
                                    <g>
                                        <polygon points="6.23,20.23 8,22 18,12 8,2 6.23,3.77 14.46,12"></polygon>
                                    </g>
                                </svg>
                            </button>
                        </div>

                        <p class="form-error-text" id="date_error" style="color: red; margin-top: 10px;">
                        </p>
                    </div>
                    </div>
                    <input type="hidden" name="date" id="date" value="">
                    <input type="hidden" name="month" id="month" value="">

                    <div class="form-group mb-3">
                        <label class="form-label fw500 dark-color " for="country">What time would you like us to start?</label>
                        <div class="radio-group owl-carousel owl-theme slider" id="when_would_you_start_slider">

                            @php
                                $timeslot = DB::table('time_slots')->orderBy('id','asc')->get()->toArray();
                                $i=1;
                            @endphp


                            @foreach($timeslot as  $timeslot_data)
                            <div class="surcharge-badge-timeslot items">

                                 @php
                                    $timeslot_service = DB::table('subservice_timeslot_price')->where('subservice_id',$subservice_id)->where('time_slot_id',$timeslot_data->id)->first();
                                   
                               
                                if($timeslot_service->price > 0){
                                    $timeslot_service_price = $timeslot_service->price;
                                    
                                }else{
                                    $timeslot_service_price = 0;
                                }

                                 @endphp

                                @if($timeslot_service_price > 0)
                                    <span>+ AED {{$timeslot_service_price}}</span>
                                @endif
                            <input type="radio" id="time{{$i}}" name="time_slot" data-name="{{$timeslot_data->name}}" onclick="timeslot_price('{{$timeslot_service_price}}','{{$timeslot_data->name}}');" value="{{$timeslot_data->id}}" >
                            <label class="labeltime" for="time{{$i}}" style="border-radius: 50px;">{{$timeslot_data->name}}</label>
                            </div>
                            @php
                                $i++;
                            @endphp
                            @endforeach

                          
                    
                            
                        </div>
                        <p class="form-error-text" id="time_slot_error" style="color: red; margin-top: 10px;">
                        </p>
                    </div>
 
                    <button type="button" class="ud-btn btn-thm default-box-shadow2 custome-black" id="nextBtn12"
                    onclick="get_hide_show(1);">Previous</button>

                    <button type="button" class="ud-btn btn-thm default-box-shadow2 custome-black mobile-hide" id="nextBtn12"
                                onclick="get_hide_show(3);">Next</button>

                               


                    
                </div>

                <div class="tab3" style="display:none">
                    <div class="form-group mb-3">
                        <label class="form-label fw500 dark-color " for="country">Where would you like your service?</label>
                        <p style="margin-top: -10px;font-size:14px;">Save your address details.</p>
                        <div class="radio-group">
                            <input type="radio" id="address_type_home" name="address_type" value="home"  checked>
                            <label for="address_type_home" style="border-radius: 50px;">Home</label>
                    
                            <input type="radio" id="address_type_office" name="address_type" value="office">
                            <label for="address_type_office" style="border-radius: 50px;">Office</label>

                            <input type="radio" id="address_type_other" name="address_type" value="other">
                            <label for="address_type_other" style="border-radius: 50px;">Other</label>
                        </div>
                        <p class="form-error-text" id="address_type_error" style="color: red; margin-top: 10px;">
                        </p>
                    </div>

                    <div class="form-group mb-3">
                        {{-- <label class="form-label fw500 dark-color " for="country">How often do you need cleaning?</label> --}}

                        <select class="form-control" name="city" id="city">
                            <option value="">Select City</option>
                            <option value="Dubai" selected>Dubai</option>
                            <option value="Abu Dhabhi">Abu Dhabhi</option>
                            <option value="Sharjah">Sharjah</option>
                        </select>

                        <p class="form-error-text" id="city_error" style="color: red; margin-top: 10px;">
                        </p>

                    </div>
                    <div class="form-group mb-3">
                        {{-- <label class="form-label fw500 dark-color " for="country">How often do you need cleaning?</label> --}}
                        <input type="text" name="area" id="area" class="form-control" placeholder="Enter Your Area">
                        <p class="form-error-text" id="area_error" style="color: red; margin-top: 10px;" ></p>

                    </div>

                    <div class="form-group mb-3">
                        {{-- <label class="form-label fw500 dark-color " for="country">How often do you need cleaning?</label> --}}
                        <input type="text" name="building_street_no" id="building_street_no" class="form-control" placeholder="Enter your building name and/or street">
                        <p class="form-error-text" id="building_street_no_error" style="color: red; margin-top: 10px;" ></p>

                    </div>

                    <div class="form-group mb-3">
                        {{-- <label class="form-label fw500 dark-color " for="country">How often do you need cleaning?</label> --}}
                        <input type="text" name="apartment_villa_no" id="apartment_villa_no" class="form-control" placeholder="Enter your apartment number & floor or villa number">
                        <p class="form-error-text" id="apartment_villa_no_error" style="color: red; margin-top: 10px;" ></p>

                    </div>

                    <button type="button" class="ud-btn btn-thm default-box-shadow2 custome-black" id="nextBtn12"
                                onclick="get_hide_show(2);">Previous</button>

                    <button type="button" class="ud-btn btn-thm default-box-shadow2 custome-black  mobile-hide" id="nextBtn12"
                                onclick="get_hide_show(4);">Next</button>
                   
                    </div>

                <div class="tab4" style="display:none">
                    
                    <div class="form-group mb-3">
                        <label class="form-label fw500 dark-color " for="country">How would you like to pay for your service?</label>
                        <p style="margin-top: -10px;font-size: 14px;">Please note cancellation or rescheduling fees may apply for last minute changes.</p>
                        <div class="radio-group payment-type"> 
                            <input type="radio" id="paymet_2" name="payment_type" value="ONLINE" checked>
                            <label for="paymet_2" style="border-radius: 50px;text-align: center;width:50%;">Online</label>
                            <img src="{{ asset('public/site/images/pay_logo_new.png') }}" style="height: 45px;margin-bottom:10px;">
                        </div>
                            {{-- <p>Payment will only be processed once the service is successfully completed.</p> --}}

                            <div class="radio-group payment-type">
                            <input type="radio" id="paymet_1" name="payment_type" value="COD" >
                            <label for="paymet_1" style="border-radius: 50px;text-align: center;width:50%;">Cash</label>
                            <p>+ AED 5 Cash handling charges will be applied.</p>
                        </div>
                       
                        
                        <p class="form-error-text" id="payment_type_error" style="color: red; margin-top: 10px;">
                        </p>
                    </div>

                    <button type="button" class="ud-btn btn-thm default-box-shadow2 custome-black" id="nextBtn12"
                    onclick="get_hide_show(3);">Previous</button>
                    

                    <button type="button" class="ud-btn btn-thm default-box-shadow2 custome-black mobile-hide" id="nextBtn12"
                                onclick="get_hide_show(5);">Next</button>
                </div>

                <div class="tab5" style="display:none">

                    <div class="form-content-main pb-0 pre-confirm-desc mt-4">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <h5 class="card-title mb-md-4">Please review your booking details and confirm your booking.</h5>
                            </div>
                        </div>
                    </div>

                    <div class="p-md-3 px-md-5">
                        <hr>
                        <div class="font-weight-bold h5">
                                Service Details
                        </div>

                        @if($subservice_id == 30 || $subservice_id == 28)

                        <div class="my-2">
                            <div class="d-flex justify-content-between">
                                <div>No. of Cleaners</div>
                                <div class="font-weight-bold sm-summary"><span id="cleaners_summary">1</span> Cleaner(s)</div>
                            </div>
                        </div>

                        <div class="my-2">
                            <div class="d-flex justify-content-between">
                                <div>No. of Hours</div>
                                <div class="font-weight-bold sm-summary"><span id="hours_summary">2</span> Hours</div>
                            </div>
                        </div>

                        <div class="my-2">
                            <div class="d-flex justify-content-between">
                                <div>Materials</div> 
                                <div class="font-weight-bold sm-summary"><span id="material_summary">No</span></div>
                            </div>
                        </div>

                        <div class="my-2">
                            <div class="d-flex justify-content-between">
                                <div>Frequency</div>
                                <div class="font-weight-bold sm-summary"><span id="frequency_summary">Once</span></div>
                            </div>
                        </div>

                        <div class="my-2" id="frequency_div_summary" style="display: none">
                            <div class="d-flex justify-content-between">
                                <div>Days of the week</div>
                                <div class="font-weight-bold sm-summary"><span id="frequency_summary_days">Once</span></div>
                            </div>
                        </div>

                        @endif

                        @if($subservice_id == 29)
                            @php
                                $subtotal = 0;
                            @endphp
                            @if (Cart::count() > 0)

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

                                    if ($disc_price != '0'){
                                        $package_price = $disc_price;
                                    }else{
                                        $package_price = $items->price;
                                    }
                                @endphp
                                    <div class="my-2">
                                        <div class="d-flex justify-content-between">
                                            <div>{{ $items->name }} * {{ $items->qty }}</div>
                                            <div class="font-weight-bold sm-summary" ><span id="frequency_summary">AED {{ $package_price }}</span></div>
                                        </div>
                                    </div>

                                    @php

                                        if ($items->qty >= 1) {
                                            $subtotal += $items->qty * round($p_price);
                                        } else {
                                            $subtotal += round($p_price);
                                        }

                                    @endphp
                                @endforeach
                            @endif
                        @endif


                        

                        <hr>

                        <div class="font-weight-bold h5">
                                Date &amp; Time
                        </div>

                        <div class="my-2" >
                            <div class="d-flex justify-content-between">
                                <div>Date & Time</div>
                                <div class="font-weight-bold sm-summary"><span id="frequency_summary_date"></span> at <span id="frequency_summary_timeslot"></span></div>
                            </div>
                        </div>

                        

                        <hr>

                        <div class="font-weight-bold h5">
                            Address
                        </div>

                        <div class="my-2">
                            <div class="d-flex justify-content-between">
                                <div>Address</div>
                                <div class="font-weight-bold sm-summary"><span id="frequency_summary_address"></span></div>
                            </div>
                        </div>

                        <hr>

                        <div class="font-weight-bold h5">
                            Payment Method
                        </div>

                        <div class="my-2">
                            <div class="d-flex justify-content-between">
                                <div>Payment Method</div>
                                <div class="font-weight-bold sm-summary"><span id="frequency_summary_payment_mode"></span></div>
                            </div>
                        </div>

                        <hr>

                        <div class="font-weight-bold h5">
                            Payment Details
                        </div>

                        <div class="my-2" >
                            <div class="d-flex justify-content-between">
                                <div>Service Charges</div>
                                <div class="font-weight-bold sm-summary"><span id="frequency_summary_service_charge"></span></div>
                            </div>
                        </div>

                         <div class="my-2" >
                            <div class="d-flex justify-content-between">
                                <div>Promo Discount</div>
                                <div class="font-weight-bold sm-summary" style="background-color:#FFD312;border-radius: 6px;
                                padding: 0 5px 0 5px;"><span id="frequency_summary_promo_discount"></span></div>
                            </div>
                        </div>

                        <div class="my-2" >
                            <div class="d-flex justify-content-between">
                                <div>Additional Charges</div>
                                <div class="font-weight-bold sm-summary"><span id="frequency_summary_additional_charge"></span></div>
                            </div>
                        </div>

                        <div class="my-2" >
                            <div class="d-flex justify-content-between " >
                                
                                <div>Timing fee</div>
                                <div class="font-weight-bold sm-summary"><span id="frequency_timing_charge_replace"></span></div>
                                
                            </div>
                        </div>

                        <div class="my-2" >
                            <div class="d-flex justify-content-between " >
                                
                                <div>Delivery charge</div>
                                <div class="font-weight-bold sm-summary"><span id="frequency_cod_charge_replace"></span></div>
                                
                            </div>
                        </div>

                        <!-- <div class="my-2" id="frequency_summary_cod_div" style="display: none" >
                            <div class="d-flex justify-content-between">
                                <div>Cash on Delivery charge</div>
                                <div class="font-weight-bold" style="max-width: 50%; text-align: right;"><span id="frequency_summary_cod_charge">0</span></div>
                            </div>
                        </div> -->

                        <div class="my-2" >
                            <div class="d-flex justify-content-between">
                                <div>Service Fee</div>
                                <div class="font-weight-bold sm-summary"><span id="frequency_summary_service_fee_charge"></span></div>
                            </div>
                        </div>

                        <div class="my-2" >
                            <div class="d-flex justify-content-between">
                                <div>Sub Total</div>
                                <div class="font-weight-bold sm-summary"><span id="frequency_summary_service_sub_total"></span></div>
                            </div>
                        </div>

                        <div class="my-2" >
                            <div class="d-flex justify-content-between">
                                <div>VAT (5%)</div>
                                <div class="font-weight-bold sm-summary"><span id="frequency_summary_service_vat"></span></div>
                            </div>
                        </div>

                        <hr>

                        

                        <div class="my-2" >
                            <div class="d-flex justify-content-between">
                                <div class="font-weight-bold h5">
                                    Total to pay
                                </div>
                                <div class="font-weight-bold" style="max-width: 50%; text-align: right;">
                                    <stong>AED<span id="frequency_summary_cross_amount" style="text-decoration: line-through;"></span></stong>
                                    <span id="frequency_summary_total_to_pay"></span></div>
                            </div>
                        </div>

                        

                    </div>
                    <button type="button" class="ud-btn btn-thm default-box-shadow2 custome-black" id="nextBtn12"
                    onclick="get_hide_show(4);">Previous</button>

                    <button class="btn btn-primary mb-1 book-now-web" type="button" disabled id="spinner_button" style="display: none;">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...</button>
                    <button type="button" class="ud-btn btn-thm default-box-shadow2 order_now custome-black book-now-web" id="nextBtn12" 
                                onclick="get_hide_show(6);">Book Now </button>
                </div>

                <input type="hidden" name="service_charge" id="service_charge" value="78">
                <input type="hidden" name="promo_discount" id="promo_discount" value="0">
                <input type="hidden" name="cleaning_discount_additional" id="cleaning_discount_additional" value="0">
                <input type="hidden" name="additional_charge" id="additional_charge" value="0">
                <input type="hidden" name="timing_charge" id="timing_charge" value="0">
                <input type="hidden" name="sub_total" id="sub_total" value="78">
                <input type="hidden" name="sub_total_time" id="sub_total_time" value="78">
                <input type="hidden" name="vat_total" id="vat_total" value="3.90">
                <input type="hidden" name="cod_charge" id="cod_charge" value="0">
                <input type="hidden" name="service_fee" id="service_fee" value="9">
                <input type="hidden" name="total_to_pay" id="total_to_pay" value="81.90">

                </form>
            </div>

            <div class="sticky-button">

            <button id="stickyButton" class="booking-summary" style="bottom:25px;">
                <div class="d-flex justify-content-between" style="color:#000;">
                <div class="font-weight-bold">
                <div style="font-size: 15px;margin-right:75px;text-decoration: line-through;">
                    AED 
                    <span id="frequency_summary_cross_amount_mobile" style="text-decoration: line-through;"></span>
                </div>
                <div style="font-size: 25px;">
                    AED 
                    <span id="total_to_pay_charge_replace_mobile"></span>
                    <i style="margin-left: 5px;" class="fa-solid fa-angle-up" id="aerrowicon"></i>
                </div>
            </div>
            </div>
            <p id="selected_weekly" style="margin-top:-10px; font-size: 17px; font-weight:1000;color: #000;" ></p>
            </button>
            
            

             
            <button type="button" class="ud-btn btn-thm default-box-shadow2 backMobile custome-black mobile-tab2 mobile-next " id="nextBtn12" style=""onclick="get_hide_show(2);">Next</button>

             <button type="button" class="ud-btn btn-thm default-box-shadow2 backMobile custome-black mobile-tab3 mobile-next" id="nextBtn12" style="display: none;"onclick="get_hide_show(3);">Next</button>                                                                                                
             <button type="button" class="ud-btn btn-thm default-box-shadow2 backMobile custome-black mobile-tab4 mobile-next" id="nextBtn12" style="display: none;"onclick="get_hide_show(4);">Next</button>                                                                                                
             <button type="button" class="ud-btn btn-thm default-box-shadow2 backMobile custome-black mobile-tab5 mobile-next" id="nextBtn12" style="display: none;"onclick="get_hide_show(5);">Next</button>
             
             <button class="btn btn-primary mb-1 backMobile spinner-mobile-tab6 mobile-next" type="button" disabled id="spinner_button" style="color: #0d6efd;background-color: #fff;border-color: #fff;top: 15px; display:none;">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...</button>
                <button type="button" class="ud-btn btn-thm default-box-shadow2 order_now custome-black backMobile mobile-tab6 mobile-next" id="nextBtn12" style="display: none;right:4px !important;" onclick="get_hide_show(6);">Book Now </button>

                <input type="hidden" name="service_fee" id="service_fee" value="9">
            </div>

            

            


            <div class="col-lg-3 " id="summary_div_left">

                <div  id="summary_div_left_package" class="last_col">
                <h3>Booking Summary</h3>
                <span class="underline"></span>
                <div class="font-weight-bold-summary h5">Service Details</div>

                @if($subservice_id == 30 || $subservice_id == 28)
                <div class="d-flex justify-content-between"><div>No. of Cleaners</div><div class="font-weight-bold sm-summary"><span id="cleaner_replace">1</span> Cleaner(s)</div></div>

                <div class="d-flex justify-content-between">
                    <div>No. of Hours</div>
                    <div class="font-weight-bold sm-summary"><span id="hour_replace">2</span> Hours</div>
                </div>

                <div class="d-flex justify-content-between">
                    <div>Materials</div>
                    <div class="font-weight-bold sm-summary"><span id="material_left_summary_replace">No</span></div>
                </div>

                <div class="d-flex justify-content-between">
                    <div>Frequency</div>
                    <div class="font-weight-bold sm-summary"><span id="frequency_left_summary_replace">Once</span></div>

                </div>

                <div class="d-flex justify-content-between" id="frequency_left_summary_div" style="display: none !important">
                    <div>Days of the week</div>
                    <div class="font-weight-bold sm-summary"><span id="frequency_days_left_summary_replace"></span></div>
                </div>
                <span class="underline"></span>

                @endif

                <div class="font-weight-bold-summary h5">Date & Time</div>
                <div class="d-flex justify-content-between"><div class="font-weight-bold sm-summary" style="margin-left:155px; margin-top:-30px;"> <span id="date_replace"></span> <span id="time_replace"></span></div></div>

                <div class="font-weight-bold-summary h5">Address</div>
                <div class="d-flex justify-content-between"><div class="font-weight-bold sm-summary" style="margin-left:155px; margin-top:-30px;"> <span id="address_replace"></span></div></div>
                <span class="underline"></span>
                

                    @php
                        //echo "<pre>";print_r(Cart::content());echo"</pre>";
                        $book_array_package_id = array();
                        $subtotal = 0;
                    @endphp

                @if($subservice_id == 29)

                    @if (Cart::count() > 0)

                        @foreach (Cart::content() as $items)
                        @php
                            $book_array_package_id[] = $items->id;
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

                            if ($disc_price != '0'){
                                $package_price = $disc_price;
                            }else{
                                $package_price = $items->price;
                            }

                        @endphp

                            <div class="d-flex justify-content-between">
                                <div>{{ $items->name }} * {{ $items->qty }} <a href="javascript:void(0)"
                                    onclick="remove_to_cart_book_now('{{ $items->rowId }}'); return false;"><span
                                        class="flaticon-delete"></span></a></div>
                                <div class="font-weight-bold sm-summary"><span id="frequency_left_summary_replace">AED {{ $package_price }}</span></div>
                            </div>

                            @php

                                if ($items->qty >= 1) {
                                    $subtotal += $items->qty * round($p_price);
                                } else {
                                    $subtotal += round($p_price);
                                }

                            @endphp

                        @endforeach

                        

                    @endif

                @endif

                @php

                    session(['book_array_package_id' => $book_array_package_id]);

                            //         echo '<pre>';
                            // print_r($book_array_package_id);
                            // echo '</pre>';
                @endphp

               

                <div class="font-weight-bold-summary h5">Payment Details</div>
                <div class="d-flex justify-content-between"><div>Service Charges</div><div class="font-weight-bold sm-summary"> AED <span id="service_charge_replace">{{ $subtotal }}</span></div></div>

                <div class="d-flex justify-content-between"><div>Promo Discount</div><div class="font-weight-bold sm-summary" style="background-color:#FFD312;border-radius: 6px;
                padding: 0px 5px 0px 5px;">-AED <span id="promo_dicount_replace">{{ $subtotal }}</span></div></div>

                <div class="d-flex justify-content-between"><div>Additional Charges</div><div class="font-weight-bold sm-summary"> AED <span id="additional_charge_replace">20.00</span></div></div>

                <div class="d-flex justify-content-between " >
                        
                        <div>Timing fee</div>
                        <div class="font-weight-bold sm-summary"> AED 
                            <span id="timing_charge_replace">0</span>
                        </div>
                       
                </div>

                <div class="d-flex justify-content-between " >
                        
                        <div>Delivery charge</div>
                        <div class="font-weight-bold sm-summary"> AED 
                            <span id="cod_charge_replace">0</span>
                        </div>
                       
                </div>

                <div class="d-flex justify-content-between"><div>Sub Total</div><div class="font-weight-bold sm-summary"> AED <span id="sub_total_replace">78.00</span></div></div>
                <div class="d-flex justify-content-between"><div>VAT (5%)</div><div class="font-weight-bold sm-summary"> AED <span id="vat_charge_replace">3.90</span></div></div>
                <span class="underline"></span>
                <div class="d-flex justify-content-between mt-2 is-r font-weight-bold-summary">
                <div  class="font-weight-bold-summary h5" style="font-size: 17px;">Total to pay</div>
                </div>
                <div class="left-summary-total">
                    <stong style="margin-left: 45px;">AED <span id="cross_amount" style="text-decoration: line-through;"></span></stong><br>
                    <strong style="font-size: 28px;margin-left: 16px;">AED <span id="total_to_pay_charge_replace">81.90</span></strong>
                </div>
                <p id="selected_weekly_left_summary" style="font-size: 17px; font-weight:1000;" ></p>
                
            </div>
            </div>

            <diV class="summary_div_left_mobile" id="summary_div_left_mobile" style="display: none;">
              
                <div class="summuryInner">

                    <button type="button" class="close closeBtn" id="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>

                @if($subservice_id == 30 || $subservice_id == 28)
                
                <div class="d-flex justify-content-between"><div>Service Charges</div><div class="font-weight-bold sm-summary"> AED <span id="service_charge_replace_mobile">{{ $subtotal }}</span></div></div>

                <div class="d-flex justify-content-between"><div>Promo Discount</div><div class="font-weight-bold sm-summary" style="background-color:#FFD312;border-radius: 6px;
                padding: 0px 5px 0px 5px;">-AED <span id="promo_dicount_replace_mobile">{{ $subtotal }}</span></div></div>

                <div class="d-flex justify-content-between " >
                                        
                    <div>Delivery charge</div>
                    <div class="font-weight-bold sm-summary"> AED 
                        <span id="cod_charge_replace_mobile">0</span>
                    </div>
                
                </div>

                <div class="d-flex justify-content-between " >
                        
                    <div>Timing fee</div>
                    <div class="font-weight-bold sm-summary"> AED 
                        <span id="timing_charge_replace_mobile">0</span>
                    </div>
                   
            </div>
                
                
                <div class="d-flex justify-content-between">
                        <div>Service Fee</div>
                        <div class="font-weight-bold sm-summary"><span id="frequency_summary_service_fee_charge_mobile">0</span></div>
                </div>

                <div class="d-flex justify-content-between"><div>Sub Total</div><div class="font-weight-bold sm-summary"> AED <span id="sub_total_replace_mobile">78.00</span></div></div>

                <div class="d-flex justify-content-between"><div>VAT (5%)</div><div class="font-weight-bold sm-summary"> AED <span id="vat_charge_replace_mobile">3.90</span></div></div>

                @endif
            </div>
        </div>
        </div>
        <input type="hidden" name="hour_charge_db" id="hour_charge_db" value="">
        <input type="hidden" name="cleaning_material_charge_db" id="cleaning_material_charge_db" value="">
    </div>
</section>
@include('front.includes.footer')



<div class="modal fade" id="exampleModalLong_{{$subservice_id}}"  tabindex="-1" aria-labelledby="materialTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="modal-digi" role="document">
      <div class="modal-content">
        <div class="modal-header" style="display:block;">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px;">
                    What our Home Cleaning Service Includes </h6>
                    <button type="button" class="close closeBtn" id="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>
        </button>
        </div>
        
        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
            <div>
                <p style="font-size: 15px; font-weight:100; margin-left:15px;">
                <span>Transform your living space into a sanctuary of cleanliness and comfort with our professional home cleaning services. Whether you need regular upkeep or deep cleaning, our experienced team ensures every nook and cranny shines, leaving you with more time to relax and enjoy your home.</span></p>
            </div>
            <h6 style="font-size: 18px; margin-left:15px;">Our Services Include:</h6>
            <ul style="list-style-type: disc; list-style: inherit;">
                <li style="list-style: inherit;">Thorough dusting and wiping of all surfaces</li>
                <li style="list-style: inherit;">Vacuuming and mopping of floors</li>
                <li style="list-style: inherit;">Cleaning and sanitizing bathrooms</li>
                <li style="list-style: inherit;">Kitchen cleaning: countertops, sinks, appliances</li>
                <li style="list-style: inherit;">Bedroom cleaning: bed-making, dusting, tidying</li>
                <li style="list-style: inherit;">Additional services: laundry, interior window cleaning, fridge and oven cleaning</li>
            </ul>
            <h6 style="margin-left: 15px;">Experience the convenience and peace of mind that comes with a meticulously cleaned home.</h6>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>



<div class="modal fade" id="Learnmore_{{$subservice_id}}"  tabindex="-1" aria-labelledby="LearnmoreTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="modal-digi" role="document">
      <div class="modal-content">
        <div class="modal-header" style="display:block;">
        <h6 class="modal-title" id="LearnmoreTitle" style="font-size: 20px;">
            How Long Should I book for ?</h6>
            <button type="button" class="close closeBtn" id="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        
        
        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
            <div>
                <p style="font-size: 15px; font-weight:100; margin-left:15px;">
                <span>Every home is different, but generally, an additional bedroom will add about an hour to your cleaning time. Below are our estimated durations for various home sizes:</span></p>
            </div>
            <table id="mobile-table" style="border:1px solid 
            #000;">
                <tr>
                    <th>Numbers of Bedrooms</th>
                    <th>Cleaning Time*</th>
                </tr>
                <tr>
                    <td>Studio</td>
                    <td>1.5-2 Hours</td>
                </tr>
                <tr>
                    <td>1 Bedroom</td>
                    <td>2-3 Hours</td>
                </tr>
                <tr>
                    <td>2 Bedroom</td>
                    <td>3-4 Hours</td>
                </tr>
                <tr>
                    <td>3 Bedroom</td>
                    <td>4-5 Hours</td>
                </tr>
                <tr>
                    <td>4 Bedroom</td>
                    <td>5-6 Hours</td>
                </tr>
                <tr>
                    <td>5 Bedroom</td>
                    <td>6-7 Hours</td>
                </tr>
            </table>
        
        <h6 style="margin-left: 15px;">*Standard cleaning covers general cleaning tasks, including surface wiping, dusting, sweeping, mopping, and vacuuming. For additional tasks such as oven or fridge cleaning, blinds wiping, or balcony cleaning, please allocate an extra 30-45 minutes per task.</h6>
       
            <h6><strong>For Larger homes or Vilas</strong> consider booking an additional hour.
            </h6>
            <p>Here is a checklist for standard cleaning. Discuss with your cleaner any specific requirements for your home:</p>
            <h6>Kitchen - 35 mins</h6>
            <ul style="list-style-type: disc; list-style: inherit;">
                <li style="list-style: inherit;">Wash dishes</li>
                <li style="list-style: inherit;">Clean sink, countertops, and kitchen appliances</li>
                <li style="list-style: inherit;">Wipe down cabinet fronts</li>
            </ul>

            <h6>Bathroom - 35 mins</h6>
            <ul style="list-style-type: disc; list-style: inherit;">
                <li style="list-style: inherit;">Scrub bathtub, shower, and toilet</li>
                <li style="list-style: inherit;">Clean sink and countertops</li>
                <li style="list-style: inherit;">Hang and fold towels</li>
                <li style="list-style: inherit;">Shine mirrors</li>
            </ul>

            <h6>Bedroom - 30 mins</h6>
            <ul style="list-style-type: disc; list-style: inherit;">
                <li style="list-style: inherit;">Make beds</li>
                <li style="list-style: inherit;">Tidy up and fold clothes</li>
                <li style="list-style: inherit;">Clean mirrors and dust surfaces</li>
            </ul>

            <h6>Living Areas - 45 mins</h6>
            <ul style="list-style-type: disc; list-style: inherit;">
                <li style="list-style: inherit;">Tidy and organize items</li>
                <li style="list-style: inherit;">Vacuum carpets and floors</li>
                <li style="list-style: inherit;">Dust furniture and all surfaces</li>
                <li style="list-style: inherit;">Clean light switches and door handles</li>
                <li style="list-style: inherit;">Wipe window sills</li>
                <li style="list-style: inherit;">Mop hard floors</li>
                <li style="list-style: inherit;">Empty trash bins</li>
            </ul>

            <h6>Additional Tasks - add 30-45 mins per task</h6>
            <ul style="list-style-type: disc; list-style: inherit;">
                <li style="list-style: inherit;">Laundry and ironing</li>
                <li style="list-style: inherit;">Change bed linens and pillowcases</li>
                <li style="list-style: inherit;">Clean interior windows</li>
                <li style="list-style: inherit;">Sweep and mop balcony/patio</li>
                <li style="list-style: inherit;">Clean inside cupboards</li>
                <li style="list-style: inherit;">Polish wood surfaces</li>
            </ul>

            <p>This comprehensive checklist ensures that your home is thoroughly cleaned. Tailor it to meet your specific needs and communicate any additional requests to your cleaning professional.</p>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>
  

<div class="modal fade" id="material_{{$subservice_id}}"  tabindex="-1" aria-labelledby="materialTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="modal-digi" role="document">
      <div class="modal-content">
        <div class="modal-header" style="display:block;">
         <button type="button" class="close closeBtn" id="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        
        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
            <h6 style="font-size: 18px; margin-left:15px;">Cleaning Equipment:</h6>
                <ul style="list-style-type: disc; list-style: inherit;">
                    <li style="list-style: inherit;">Vacuum cleaner (with appropriate attachments)</li>
                    <li style="list-style: inherit;">Mop and bucket</li>
                    <li style="list-style: inherit;">Broom and dustpan</li>
                    <li style="list-style: inherit;">Microfiber mops or cloths</li>
                    <li style="list-style: inherit;">Scrub brushes or sponges</li>
                    <li style="list-style: inherit;">Vacuum cleaner (with appropriate attachments)</li>
                </ul>
            <h6 style="font-size: 18px; margin-left:15px;">Cleaning Products:</h6>
            <ul style="list-style-type: disc; list-style: inherit;">
                <li style="list-style: inherit;">All-purpose cleaner</li>
                <li style="list-style: inherit;">Glass cleaner</li>
                <li style="list-style: inherit;">Disinfectant wipes or spray</li>
                <li style="list-style: inherit;">Bathroom cleaner</li>
                <li style="list-style: inherit;">Floor cleaner (suitable for the flooring type)</li>
                <li style="list-style: inherit;">Dusting spray or polish</li>
                <li style="list-style: inherit;">Toilet bowl cleaner</li>
                <li style="list-style: inherit;">Paper towels or cleaning rags</li>
                <li style="list-style: inherit;">Trash bags</li>
            </ul>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>
  


@php 
if($price_data != ''){
    $hourly_price = $price_data->hourly_price;
    $per_person_price = $price_data->per_person_price;
    $cleaning_material_price_per_hour = $price_data->cleaning_material_price_per_hour;
}else{
    $hourly_price = 0;
    $per_person_price = 0;
    $cleaning_material_price_per_hour = 0;
}
@endphp

<script>

        $("input[name='which_day_of_the_week_do_you_want_the_service[]']").on("change", function() {
            var selectedDays = [];
            $("input[name='which_day_of_the_week_do_you_want_the_service[]']:checked").each(function() {
                selectedDays.push($(this).val());
            });
            var selectedDaysStr = selectedDays.join(', ');
            $('#frequency_days_left_summary_replace').html(selectedDaysStr);
            //alert('Selected Days: ' + selectedDaysStr);
        });

        $("input[name='payment_type']").on("change", function() {
            var selectedValue = $("input[name='payment_type']:checked").val();

            if(selectedValue == 'COD'){
                var charge_payment = 5;
            }else{
                var charge_payment = 0;
            }
            $('#cod_charge').val(charge_payment);

            @php 
    if($subservice_id == 30 || $subservice_id == 28){
        @endphp
    calculation();
    @php 
    }else{
    @endphp
    calculation_book_now();
     @php 
    }
    @endphp
            //alert('Selected Payment Type: ' + selectedValue);
        });

       


    function cleaning_change(value){
        // alert(value);
        // if(value == "Weekly"){
            
        // }else{
            
        // }
        

        if(value == 'Multiple times a week'){
            // alert('in');
            $('#selected_weekly').text('For first visit only');
            $('#selected_weekly_left_summary').text('For first visit only');
            $("#weekly_div").css("display", "block");
            $("#frequency_left_summary_div").attr("style", "display: flex !important;");
        }else{
            // alert('out');
            $('#selected_weekly').text('');
            $('#selected_weekly_left_summary').text('');
            $("#weekly_div").css("display", "none");
            $("#frequency_left_summary_div").attr("style", "display: none !important;");
            $("input[name='which_day_of_the_week_do_you_want_the_service[]']").prop('checked', false);
            
        }

        
        $('#frequency_left_summary_replace').html(value);

        calculation();
    }

    function calculation(){
        const radios_1 = document.getElementsByName('how_many_cleaners_do_you_need');
        let how_many_cleaners_do_you_need_value = '';

        for (let i = 0; i < radios_1.length; i++) {
            if (radios_1[i].checked) {
                how_many_cleaners_do_you_need_value = radios_1[i].value;
                break;
            }
        }

        const radios_2 = document.getElementsByName('how_many_hours_should_they_stay');
        let how_many_hours_should_they_stay_value = '';

        for (let i = 0; i < radios_2.length; i++) {
            if (radios_2[i].checked) {
                how_many_hours_should_they_stay_value = radios_2[i].value;
                break;
            }
        }

        var service_id = '{{ $subservice_id }}';


        $.ajax({

            type: 'POST',
            url: '{{ url('get_price_cleaning ') }}',
            data: {

                "_token": "{{ csrf_token() }}",
                'service_id': service_id,
                'how_many_hours_should_they_stay_value': how_many_hours_should_they_stay_value,

            },

            success: function(msg) {

                var response_ajax = JSON.parse(msg);

                if (response_ajax.status === 'success') {
                   var hour_charge_db = response_ajax.hour_price;
                   var cleaning_material_charge_db = response_ajax.cleaning_material_price_per_hour;

                   $('#hour_charge_db').val(hour_charge_db);
                   $('#cleaning_material_charge_db').val(cleaning_material_charge_db);


                   var no_of_cleaners = how_many_cleaners_do_you_need_value;
                   var no_of_hours = how_many_hours_should_they_stay_value;

                   var calchrs = parseInt(no_of_hours);
                   if(calchrs > 0){
                        var calprice = calchrs * hour_charge_db;
                   }else{
                        var calprice = 0;
                   }

                   var percleanprice = (parseInt(calprice)) * no_of_cleaners;

                    const radios_3 = document.getElementsByName('do_you_need_cleaning_material');
                    let do_you_need_cleaning_material_value = '';

                    for (let i = 0; i < radios_3.length; i++) {
                        if (radios_3[i].checked) {
                            do_you_need_cleaning_material_value = radios_3[i].value;
                            break;
                        }
                    }
                    if(do_you_need_cleaning_material_value == 'No'){
                        var additional_charge = 0;
                    }else{
                        var additional_charge = (no_of_hours * cleaning_material_charge_db) * no_of_cleaners ;
                    }

                    
                    

                    if(response_ajax.promo_discount != 'null' && response_ajax.promo_discount > 0){

                        var discount = response_ajax.promo_discount;

                        if(response_ajax.promo_discount_type == 1){

                            var discount_amount = (percleanprice) * discount/100;

                        }else if(response_ajax.promo_discount_type == 0){
                            var discount_amount = parseInt(discount);
                        }else{
                            var discount_amount = 0;
                        }
                        // var promo_discount = 15;
                    }else{
                        var discount_amount = 0;
                    }

                    discount_amount = Math.round(discount_amount);

                    

                    var how_often_do_you_need_cleaning = $('input[name="how_often_do_you_need_cleaning"]:checked').val();

                    if(how_often_do_you_need_cleaning == 'Weekly'){


                        var discount_percentage_new = '{{$weekly_discout_1}}';
            
                        var cleaning_discount = '{{$weekly_discout_1}}';
                        var cleaning_discount_amount =(percleanprice) * cleaning_discount/100;
                        var percleanprice_new = parseInt(percleanprice) - parseInt(cleaning_discount_amount);

                        // var crossprice_discount = percleanprice * 5/100;
                        // var crossprice = percleanprice + crossprice_discount;

                        var cleaning_discount_additional =(additional_charge) * cleaning_discount/100;
                        // alert(additional_charge);
                        var additional_charge_new = parseInt(additional_charge) - parseInt(cleaning_discount_additional);
                        


                    }else if(how_often_do_you_need_cleaning == 'Multiple times a week'){

                        var cleaning_discount = '{{$multiple_time_week_discout_1}}';
                        var cleaning_discount_amount =(percleanprice) * cleaning_discount/100;
                        var percleanprice_new = parseInt(percleanprice) - parseInt(cleaning_discount_amount);

                        var discount_percentage_new = '{{$multiple_time_week_discout_1}}';

                        // var crossprice_discount = percleanprice * 5/100;
                        // var crossprice = percleanprice + crossprice_discount;

                        var cleaning_discount_additional =(additional_charge) * cleaning_discount/100;
                        var additional_charge_new = parseInt(additional_charge) - parseInt(cleaning_discount_additional);

                    }else{
                        var cleaning_discount = 0;
                        var cleaning_discount_amount = 0;
                        var cleaning_discount_additional = 0;
                        var percleanprice_new = parseInt(percleanprice) - parseInt(cleaning_discount_amount);
                        var discount_percentage_new = 0;
                        var additional_charge_new = parseInt(additional_charge) - parseInt(cleaning_discount_additional);
                    }

                  
                    var timing_charge = $('#timing_charge').val();

                    var cod_charge = $('#cod_charge').val();
                    
                    // sub_total = parseInt(sub_total) - parseInt(cleaning_discount_amount);
                    // alert(additional_charge);
                    var sub_total = parseInt(percleanprice_new) + parseInt(additional_charge_new) + parseInt(timing_charge) + parseInt(cod_charge) - parseInt(discount_amount);

                    var vat_total = (sub_total) * 5/100;

                    var service_fee = parseFloat($('#service_fee').val()) 

                    //  console.log(service_fee); // Check the result

                    var total_to_pay = sub_total + vat_total;

                    var percleanprice_new1 =parseFloat(percleanprice_new).toFixed(2);
                    var discount_amount =parseFloat(discount_amount).toFixed(2);
                    var additional_charge_new1 =parseFloat(additional_charge_new).toFixed(2);
                    var timing_charge =parseFloat(timing_charge).toFixed(2);
                    var cod_charge =parseFloat(cod_charge).toFixed(2);
                    var sub_total =parseFloat(sub_total).toFixed(2);
                    var vat_total =parseFloat(vat_total).toFixed(2);
                    var cross_price =parseFloat(crossprice).toFixed(2);
                    var total_to_pay =parseFloat(total_to_pay).toFixed(2);

                    var vat_amount = parseFloat(percleanprice)*5/100;

                    var crossprice_discount = parseInt(percleanprice)*discount_percentage_new /100;

                    var additional_charge_discount = parseInt(additional_charge)*discount_percentage_new /100;

                    // alert(additional_charge);

                    var crossprice_new = parseInt(sub_total) + parseInt(crossprice_discount) + parseFloat(discount_amount) + parseFloat(vat_amount) + Math.round(additional_charge_discount);

                 
                    var crossprice = parseFloat(percleanprice_new1).toFixed(2);

                    // alert(crossprice_discount);
                    // alert(percleanprice);
                    // alert(vat_amount);
                    // alert(crossprice);
                   
                    var dateSelected = $('#date').val();
                    var monthSelected = $('#month').val();
                    var currentDate = new Date();
                    var currentYear = currentDate.getFullYear();
                    var date = dateSelected + ' ' + monthSelected + ' ' + currentYear; 
                    // $('#frequency_summary_date').html(date); 


                    var time_slotSelected = document.querySelector('input[name="time_slot"]:checked');
                    //var selectedName = time_slotSelected.getAttribute('data-name');
                    // $('#frequency_summary_timeslot').html(selectedName);

                    
                    // $('#frequency_summary_address').html(address); 

                    // var service_fee = $('#service_fee').val();


                    $('#cleaner_replace').html(no_of_cleaners);
                    $('#material_left_summary_replace').html(do_you_need_cleaning_material_value);
                    $('#hour_replace').html(no_of_hours);
                    $('#service_charge_replace').html(percleanprice_new1);
                    $('#service_charge_replace_mobile').html(percleanprice_new1);
                    $('#frequency_summary_cross_amount_mobile').html(percleanprice_new1);
                    //$('#date_replace').html(date);
                    $('#cross_amount').html(crossprice);
                    $('#promo_dicount_replace').html(discount_amount);
                    $('#promo_dicount_replace_mobile').html(discount_amount);
                    $('#additional_charge_replace').html(additional_charge_new1);
                    $('#sub_total_replace').html(sub_total);
                    $('#sub_total_replace_mobile').html(sub_total);
                    $('#vat_charge_replace').html(vat_total);
                    $('#vat_charge_replace_mobile').html(vat_total);
                    $('#total_to_pay_charge_replace').html(total_to_pay);
                    $('#total_to_pay_charge_replace_mobile').html(total_to_pay);
                    // $('#service_fee_replace_charge_mobile').html(service_fee);
                    $('#timing_charge_replace').html(timing_charge);
                    $('#timing_charge_replace_mobile').html(timing_charge);
                    $('#frequency_timing_charge_replace').html(timing_charge);

                    $('#cod_charge_replace').html(cod_charge);
                    $('#cod_charge_replace_mobile').html(cod_charge);
                    $('#frequency_cod_charge_replace').html(cod_charge);

                    $('#service_charge').val(percleanprice_new1);
                    $('#promo_discount').val(discount_amount);
                    $('#cleaning_discount_additional').val(cleaning_discount_additional);
                    $('#additional_charge').val(additional_charge_new1);
                    $('#sub_total').val(sub_total);
                    $('#vat_total').val(vat_total);
                    $('#total_to_pay').val(total_to_pay);
                    




                  
                //    alert(percleanprice_new1);
                //    alert(additional_charge_new1);
                }
            }
        });

    }

    function timeslot_price(price,name){

        $('#time_replace').html(name);
        $('#frequency_summary_timeslot').html(name);

        $('#timing_charge').val(price);

        @php 
    if($subservice_id == 30 || $subservice_id == 28){
        @endphp
    calculation();
    @php 
    }else{
    @endphp
    calculation_book_now();
     @php 
    }
    @endphp
        
        
    }
@php 
    if($subservice_id == 30 || $subservice_id == 28){
        @endphp
    window.onload = calculation;
    @php 
    }

    if($subservice_id == 29){
        @endphp
    window.onload = calculation_book_now;
    @php 
    }
   @endphp

   function calculation_book_now(){

    //alert('here');

    @php
        $subtotal = 0;
        if (Cart::count() > 0){

            foreach (Cart::content() as $items){
                
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


                if ($items->qty >= 1) {
                    $subtotal += $items->qty * round($p_price);
                } else {
                    $subtotal += round($p_price);
                }
            }
            
        }

    @endphp

    //alert('{{ $subtotal }}');
        
        var additional_charge = 0;

        var timing_charge = $('#timing_charge').val();

        
        var cod_charge = $('#cod_charge').val();
        
        // sub_total = parseInt(sub_total) - parseInt(cleaning_discount_amount);

        //var sub_total = parseInt(percleanprice) + parseInt(additional_charge) + parseInt(timing_charge) + parseInt(cod_charge) - parseInt(discount_amount);

        var sub_total = parseInt('{{ $subtotal }}') + parseInt(additional_charge) + parseInt(timing_charge) + parseInt(cod_charge);

        var vat_total = (sub_total) * 5/100;

        var total_to_pay = sub_total + vat_total;



        

        $('#additional_charge_replace').html(additional_charge);
        $('#sub_total_replace').html(sub_total);
        $('#vat_charge_replace').html(vat_total);
        $('#total_to_pay_charge_replace').html(total_to_pay);
       
         $('#timing_charge_replace').html(timing_charge);
        $('#frequency_timing_charge_replace').html(timing_charge);

        $('#cod_charge_replace').html(cod_charge);
        $('#frequency_cod_charge_replace').html(cod_charge);

        
        $('#service_charge').val('{{ $subtotal }}');
        $('#additional_charge').val(additional_charge);
        $('#sub_total').val(sub_total);
        $('#vat_total').val(vat_total);
        $('#total_to_pay').val(total_to_pay);

   }



    function get_hide_show(id){

        if (id == 1) {

            $(".tab1").css("display", "block");
            $(".mobile-tab2").css("display", "inline-block");
            $(".mobile-tab3").css("display", "none");
            $(".mobile-tab4").css("display", "none");
            $(".mobile-tab5").css("display", "none");
            $(".mobile-tab6").css("display", "none");
            $(".tab2").css("display", "none");
            $(".tab3").css("display", "none");
            $(".tab4").css("display", "none");
            $(".tab5").css("display", "none");

            $(".step-p").text("Step 1 of 4");
            $(".step-title").text("Service Details");
        }

        if(id == 2){
            //alert(id);
         

            @php

                if($subservice_id == 30 || $subservice_id == 28){
            @endphp

            const radios = document.getElementsByName('how_often_do_you_need_cleaning');
            let selectedValue = null;
            
            // Loop through the radio buttons to find if any is checked
            for (const radio of radios) {
                if (radio.checked) {
                    selectedValue = radio.value;
                    break;
                }
            }

            //alert(selectedValue);

            if (selectedValue == null) {
                jQuery('#how_often_do_you_need_cleaning_error').html(
                    "Please Select How often do you need cleaning");
                jQuery('#how_often_do_you_need_cleaning_error').show().delay(0).fadeIn('show');
                jQuery('#how_often_do_you_need_cleaning_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#how_often_do_you_need_cleaning_error').offset().top - 150
                }, 1000);
                return false;
            }

            if(selectedValue == 'Multiple times a week'){
                var isChecked = $("input[name='which_day_of_the_week_do_you_want_the_service[]']:checked").length > 0;
                
                if (!isChecked) {
                    jQuery('#which_day_of_the_week_do_you_want_the_service_error').html(
                    "Kindly select two days at least");
                    jQuery('#which_day_of_the_week_do_you_want_the_service_error').show().delay(0).fadeIn('show');
                    jQuery('#which_day_of_the_week_do_you_want_the_service_error').show().delay(2000).fadeOut('show');
                    $('html, body').animate({
                        scrollTop: $('#which_day_of_the_week_do_you_want_the_service_error').offset().top - 150
                    }, 1000);
                    return false;
                }

                var isChecked_length = $("input[name='which_day_of_the_week_do_you_want_the_service[]']:checked").length;

                if(isChecked_length < 2){
                    jQuery('#which_day_of_the_week_do_you_want_the_service_error').html(
                    "Kindly select two days at least");
                    jQuery('#which_day_of_the_week_do_you_want_the_service_error').show().delay(0).fadeIn('show');
                    jQuery('#which_day_of_the_week_do_you_want_the_service_error').show().delay(2000).fadeOut('show');
                    $('html, body').animate({
                        scrollTop: $('#which_day_of_the_week_do_you_want_the_service_error').offset().top - 150
                    }, 1000);
                    return false;
                }
                //alert(isChecked);
               
            }


            // if (!timeSlot1Selected) {
            //     jQuery('#time_slot_error').html(
            //         "Please Select Time Slot");
            //     jQuery('#time_slot_error').show().delay(0).fadeIn('show');
            //     jQuery('#time_slot_error').show().delay(2000).fadeOut('show');
            //     $('html, body').animate({
            //         scrollTop: $('#time_slot_error').offset().top - 150
            //     }, 1000);
            //     return false;
            // }

            @php

               }
            @endphp

            $('html, body').animate({
                    scrollTop: $('.tab2').offset().top - 150
                }, 1000);

            $(".tab1").css("display", "none");
            $(".mobile-tab2").css("display", "none");
            $(".mobile-tab3").css("display", "inline-block");
            $(".mobile-tab4").css("display", "none");
            $(".mobile-tab5").css("display", "none");
            $(".mobile-tab6").css("display", "none");
            $(".tab2").css("display", "block");
            $(".tab3").css("display", "none");
            $(".tab4").css("display", "none");
            $(".tab5").css("display", "none");

            $(".step-p").text("Step 2 of 4");
            $(".step-title").text("Scheduling Your Service");
        }

        if(id == 3){

            var date = $('#date').val();
            if (date == '') {
                jQuery('#date_error').html(
                    "Please Select Date");
                jQuery('#date_error').show().delay(0).fadeIn('show');
                jQuery('#date_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#date_error').offset().top - 150
                }, 1000);
                return false;
            }
            const timeSlots = document.getElementsByName('time_slot');
            let timeSlotSelected = false;
            
            for (const timeSlot of timeSlots) {
                if (timeSlot.checked) {
                    timeSlotSelected = true;
                    break;
                }
            }

            if (!timeSlotSelected) {
                jQuery('#time_slot_error').html(
                    "Please Select Time Slot");
                jQuery('#time_slot_error').show().delay(0).fadeIn('show');
                jQuery('#time_slot_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#time_slot_error').offset().top - 150
                }, 1000);
                return false;
            }

            $('html, body').animate({
                    scrollTop: $('.tab4').offset().top - 150
                }, 1000);


            

            $(".tab1").css("display", "none");
            $(".tab2").css("display", "none");
            $(".mobile-tab2").css("display", "none");
            $(".mobile-tab3").css("display", "none");
            $(".mobile-tab4").css("display", "inline-block");
            $(".mobile-tab5").css("display", "none");
            $(".mobile-tab6").css("display", "none");
            $(".tab3").css("display", "block");
            $(".tab4").css("display", "none");
            $(".tab5").css("display", "none");

            $(".step-p").text("Step 3 of 4");
            $(".step-title").text("Your Location");
        }

        if(id == 4){

            var city = $('#city').val();
            if (city == '') {
                jQuery('#city_error').html(
                    "Please Select City");
                jQuery('#city_error').show().delay(0).fadeIn('show');
                jQuery('#city_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#city_error').offset().top - 150
                }, 1000);
                return false;
            }

            var area = $('#area').val();
            if (area == '') {
                jQuery('#area_error').html(
                    "Please Enter Your Area");
                jQuery('#area_error').show().delay(0).fadeIn('show');
                jQuery('#area_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#area_error').offset().top - 150
                }, 1000);
                return false;
            }

            var building_street_no = $('#building_street_no').val();
            if (building_street_no == '') {
                jQuery('#building_street_no_error').html(
                    "Please Enter Building Or Street No");
                jQuery('#building_street_no_error').show().delay(0).fadeIn('show');
                jQuery('#building_street_no_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#building_street_no_error').offset().top - 150
                }, 1000);
                return false;
            }

            var apartment_villa_no = $('#apartment_villa_no').val();
            if (apartment_villa_no == '') {
                jQuery('#apartment_villa_no_error').html(
                    "Please Enter Apartment / Villa No");
                jQuery('#apartment_villa_no_error').show().delay(0).fadeIn('show');
                jQuery('#apartment_villa_no_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#apartment_villa_no_error').offset().top - 150
                }, 1000);
                return false;
            }

            var citySelected = $('#city').val();
            var areaSelected = $('#area').val();
            var building_street_noSelected = $('#building_street_no').val();
            var apartment_villa_noSelected = $('#apartment_villa_no').val();

            var address = citySelected + ', ' + areaSelected + ', ' + building_street_noSelected + ', ' + apartment_villa_noSelected; 

            $('#address_replace').html(address);

            $("#summary_div_left").css("display", "block");

            $(".tab1").css("display", "none");
            $(".tab2").css("display", "none");
            $(".mobile-tab2").css("display", "none");
            $(".mobile-tab3").css("display", "none");
            $(".mobile-tab4").css("display", "none");
            $(".mobile-tab5").css("display", "inline-block");
            $(".mobile-tab6").css("display", "none");
            $(".tab3").css("display", "none");
            $(".tab4").css("display", "block");
            $(".tab5").css("display", "none");

            $(".step-p").text("Step 4 of 4");
            $(".step-title").text("Payment Information");

        }

        if(id == 5){

            
            var paymentTypeSelected = document.querySelector('input[name="payment_type"]:checked');

            //alert(paymentTypeSelected);

            if (!paymentTypeSelected) {
                jQuery('#payment_type_error').html(
                    "Please Payment Type");
                jQuery('#payment_type_error').show().delay(0).fadeIn('show');
                jQuery('#payment_type_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#payment_type_error').offset().top - 150
                }, 1000);
                return false;
            }

            @php

                if($subservice_id == 30 || $subservice_id == 28){
            @endphp

            var cleanersSelected = document.querySelector('input[name="how_many_cleaners_do_you_need"]:checked');
            $('#cleaners_summary').html(cleanersSelected.value);

            var hoursSelected = document.querySelector('input[name="how_many_hours_should_they_stay"]:checked');
            $('#hours_summary').html(hoursSelected.value);

            var materialSelected = document.querySelector('input[name="do_you_need_cleaning_material"]:checked');
            $('#material_summary').html(materialSelected.value);

            var frequenceSelected = $('#how_often_do_you_need_cleaning').val();
            $('#frequency_summary').html(frequenceSelected);

            if(frequenceSelected == 'Multiple times a week'){
                $("#frequency_div_summary").css("display", "block");

                var selectedDays = [];
                document.querySelectorAll('input[name="which_day_of_the_week_do_you_want_the_service[]"]:checked').forEach(function(checkbox) {
                    selectedDays.push(checkbox.value);
                });

                var selectedDays = selectedDays.join(',');
                $('#frequency_summary_days').html(selectedDays);

            }else{
                $("#frequency_div_summary").css("display", "none");
            }

            @php
                }
            @endphp

            var citySelected = $('#city').val();
            var areaSelected = $('#area').val();
            var building_street_noSelected = $('#building_street_no').val();
            var apartment_villa_noSelected = $('#apartment_villa_no').val();

            var address = citySelected + ', ' + areaSelected + ', ' + building_street_noSelected + ', ' + apartment_villa_noSelected; 
            $('#frequency_summary_address').html(address); 



            var dateSelected = $('#date').val();
            var monthSelected = $('#month').val();
            var currentDate = new Date();
            var currentYear = currentDate.getFullYear();
            var date = dateSelected + ' ' + monthSelected + ' ' + currentYear; 
            // $('#frequency_summary_date').html(date); 


            var time_slotSelected = document.querySelector('input[name="time_slot"]:checked');
            //var selectedName = time_slotSelected.getAttribute('data-name');
            //$('#frequency_summary_timeslot').html(selectedName);

            var payment_typeSelected = document.querySelector('input[name="payment_type"]:checked');
            if(payment_typeSelected.value == 'COD'){
                var payment_mode = 'Cash on Delivery';
                $("#frequency_summary_cod_div").attr("style", "display: block !important;");
            }else{
                $("#frequency_summary_cod_div").attr("style", "display: none !important;");
                var payment_mode = 'Online';
            }
            $('#frequency_summary_payment_mode').html(payment_mode);


            var service_charge = $('#service_charge').val();
            var additional_charge = $('#additional_charge').val();
            var cod_charge = $('#cod_charge').val();
            var service_fee = $('#service_fee').val();
            var timing_charge = $('#timing_charge').val();
           var promo_discount = $('#promo_discount').val(); 


            //var sub_total = parseInt(percleanprice) + parseInt(additional_charge) + parseInt(timing_charge) + parseInt(cod_charge) - parseInt(discount_amount);

            var sub_total = parseInt(service_charge) + parseInt(additional_charge) + parseInt(cod_charge) + parseInt(timing_charge) + parseInt(service_fee) - parseInt(promo_discount) ;

            var vat_charge = sub_total * 5 /100;

            var total_to_pay = sub_total + vat_charge;

            var sub_total = $('#sub_total').val(sub_total);
            var vat_total = $('#vat_total').val(vat_charge);
            var total_to_pay = $('#total_to_pay').val(total_to_pay);


            var sub_total = $('#sub_total').val();
            var vat_total = $('#vat_total').val();
            var total_to_pay = $('#total_to_pay').val();
           
            var sub_total =parseFloat(sub_total).toFixed(2);

            var total_to_pay =parseFloat(total_to_pay).toFixed(2);

            var service_fee =parseFloat(service_fee).toFixed(2);


            $('#frequency_summary_service_charge').html(service_charge);
            $('#frequency_summary_cross_amount').html(service_charge);
            $('#frequency_summary_cross_amount_mobile').html(service_charge);
            $('#frequency_summary_promo_discount').html(promo_discount);
            $('#frequency_summary_additional_charge').html(additional_charge);
            $('#frequency_summary_service_fee_charge').html(service_fee);
            $('#frequency_summary_service_fee_charge_mobile').html(service_fee);
            $('#frequency_summary_service_sub_total').html(sub_total);
            $('#frequency_summary_service_vat').html(vat_total);
            $('#frequency_summary_total_to_pay').html(total_to_pay);
            $('#total_to_pay_charge_replace_mobile').html(total_to_pay);
            $('#frequency_summary_cod_charge').html(cod_charge);


            $('#frequency_summary_cod_charge').html(cod_charge);
            
            
            

            $("#summary_div_left").css("display", "none");

            $(".tab1").css("display", "none");
            $(".tab2").css("display", "none");
            $(".tab3").css("display", "none");
            $(".tab4").css("display", "none");
            $(".tab5").css("display", "block");
            $(".mobile-tab2").css("display", "none");
            $(".mobile-tab3").css("display", "none");
            $(".mobile-tab4").css("display", "none");
            $(".mobile-tab5").css("display", "none");
            $(".mobile-tab6").css("display", "inline-block");
            $(".step-p").text("");
            $(".step-title").text("Service Details");

            }

            if(id == 6){
                // alert('test');

                $(".mobile-tab2").css("display", "none");
                $(".mobile-tab3").css("display", "none");
                $(".mobile-tab4").css("display", "none");
                $(".mobile-tab5").css("display", "none");
                $(".mobile-tab6").css("display", "none");
                $(".spinner-mobile-tab6").css("display", "block");
                $('#spinner_button').show();
                $('.order_now').hide();
                $('#category_form_new').submit();
            }
    }
    </script>

<script>
let scrollIndex = 0;
const daysToShow = 14; // The number of days being displayed
const visibleDays = 5; // Number of days visible at once in the container
const dayWidth = 70; // The width of each day element (adjust this as needed)
 // Function to add days to a date
 function addDays(date, days) {
    const result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}

// Function to format the date
function formatDate(date) {
    const dayNames = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    return {
        day: dayNames[date.getDay()],
        date: date.getDate(),
        month: monthNames[date.getMonth()],
        year: date.getFullYear()  
    };
}

// Function to update enabled/disabled calendar days
function updateCalendarDays() {
    const selectedDays = getSelectedDays();
    const calendarDays = document.querySelectorAll('.calendar-day');

    calendarDays.forEach(day => {
        const dayLabel = day.querySelector('.calendar-day-label').textContent;
        if (selectedDays.length === 0 || selectedDays.includes(dayLabel)) {
            day.classList.remove('disabled');
        } else {
            day.classList.add('disabled');
        }
    });
}

// Function to get selected checkboxes (weekdays)
function getSelectedDays() {
    const selectedCheckboxes = document.querySelectorAll('input[name="which_day_of_the_week_do_you_want_the_service[]"]:checked');
    const selectedDays = Array.from(selectedCheckboxes).map(checkbox => {
        switch (checkbox.value) {
            case 'Monday': return 'Mo';
            case 'Tuesday': return 'Tu';
            case 'Wednesday': return 'We';
            case 'Thursday': return 'Th';
            case 'Friday': return 'Fr';
            case 'Saturday': return 'Sa';
            case 'Sunday': return 'Su';
        }
    });
    return selectedDays;
}

// Generate the next 14 days in the calendar
const datesContainer = document.getElementById('dates-container');
const daysWrapper = document.getElementById('days-wrapper');
const scrollLeftBtn = document.getElementById('scroll-left');
const scrollRightBtn = document.getElementById('scroll-right');

const today = new Date();
for (let i = 0; i < daysToShow; i++) {
    const currentDate = addDays(today, i);
    const formattedDate = formatDate(currentDate);

    const dayDiv = document.createElement('div');
    dayDiv.classList.add('calendar-day');
    dayDiv.innerHTML = `
        <div class="calendar-day-label">${formattedDate.day}</div>
        <div class="calendar-date-label">${formattedDate.date}</div>
        ${formattedDate.day === 'Sa' || formattedDate.day === 'Su' ? '<div class="surcharge-badge-dayslot" style="position:relative;"><span>+ AED 5</span></div>' : ''}
    `;

    dayDiv.addEventListener('click', function() {
        if (!dayDiv.classList.contains('disabled')) {
            document.querySelectorAll('.calendar-day').forEach(day => day.classList.remove('is-selected'));
            dayDiv.classList.add('is-selected');
            // Update date and month somewhere in your form
            $('#date').val(formattedDate.date);
            $('#month').val(formattedDate.month);
            const date_new = formattedDate.date + ' ' + formattedDate.month + ' ' + formattedDate.year;
            $('#date_replace').html(date_new);
            $('#frequency_summary_date').html(date_new);
        }
    });

    daysWrapper.appendChild(dayDiv);
}
// Scroll left button click event
scrollLeftBtn.addEventListener('click', () => {
    if (scrollIndex > 0) {
        scrollIndex -= 1;
        updateVisibleDays();
    }
});

// Scroll right button click event
scrollRightBtn.addEventListener('click', () => {
    if (scrollIndex < daysToShow - visibleDays) {
        scrollIndex += 1;
        updateVisibleDays();
    }
});

// Function to handle checkbox changes and update the calendar
document.querySelectorAll('input[name="which_day_of_the_week_do_you_want_the_service[]"]').forEach(checkbox => {
    checkbox.addEventListener('change', updateCalendarDays);
});

// Initialize the calendar days
updateCalendarDays();

// Function to update the visible days when scrolling (if you need this)
// Function to update the visible days by translating the daysWrapper
function updateVisibleDays() {
    const offset = -scrollIndex * dayWidth; // Scroll amount based on the current index
    daysWrapper.style.transform = `translateX(${offset}px)`;
}

    function add_to_cart_book(package_id) {

        var qty = 1;

        $.ajax({

            type: 'POST',
            url: '{{ url('add_to_cart_book ') }}',
            data: {

                "_token": "{{ csrf_token() }}",
                'qty': qty,
                'package_id': package_id,

            },

            success: function(msg) {
                if (msg != 0) {
                    
                    //calculation_book_now();
                    $("#cart_div_form").load(location.href + " #cart_div_form");
                    $("#summary_div_left_package").load(location.href + " #summary_div_left_package");

                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                    // $(".addtocart-btn_" + package_id).hide();
                    // $(".loader-test_" + package_id).show();
                    // setTimeout(function() {
                    //     window.location.href = "{{ route('cart') }}";
                    //     $(".addtocart-btn_" + package_id).show();
                    //     $(".loader-test_" + package_id).hide();
                    // }, 2000);
                    return false;
                }
            }
        });

    }

    function remove_to_cart_book_now(rowId) {

var answer = window.confirm("Do you want to remove this Package from cart?");

if (answer) {
    var url = '{{ url('cart_remove_book_now') }}';
    $.ajax({
        url: url,
        type: 'post',
        data: {
            "_token": "{{ csrf_token() }}",
            "rowId": rowId
        },
        success: function(msg) {

            if (msg != '') {

                //calculation_book_now();
                $("#message_error").html("Package Removed From Cart");
                $('#message_error').show().delay(0).fadeIn('show');
                $('#message_error').show().delay(2000).fadeOut('show');
                $("#cart_div_form").load(location.href + " #cart_div_form");
                    $("#summary_div_left_package").load(location.href + " #summary_div_left_package");

                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                //  $("#header_cart").load(location.href + " #header_cart");
                // $("#header_cart_count").load(location.href + " #header_cart_count");
                return false;
            }

        }

    });
}
}

</script>
<script>
    function getCurrentMonthAndYear() {
        const now = new Date();
        const options = { month: 'long', year: 'numeric' }; 
        return now.toLocaleDateString('en-US', options);
    }
    document.getElementById('month').textContent = getCurrentMonthAndYear();
</script>
<script>
  document.getElementById('aerrowicon').addEventListener('click', function() {
    var summaryDiv = document.getElementById('summary_div_left_mobile');
    var aerrowIcon = document.getElementById('aerrowicon');
    var close = document.getElementById('close');
    
    // Toggle the 'open' class on click to slide the div up or down
    if (summaryDiv.classList.contains('open')) {
        summaryDiv.classList.remove('open');
        aerrowIcon.style.transition = 'transform 0.3s ease'; // Corrected style manipulation
        aerrowIcon.style.transform = 'rotate(0deg)'; // Corrected style manipulation
    } else {
        summaryDiv.classList.add('open');
        aerrowIcon.style.transition = 'transform 0.3s ease';
        aerrowIcon.style.transform = 'rotate(180deg)'; // Corrected style manipulation
    }
});
  document.getElementById('close').addEventListener('click', function() {
    var summaryDiv = document.getElementById('summary_div_left_mobile');
    var close = document.getElementById('close');
    
    // Toggle the 'open' class on click to slide the div up or down
    if (summaryDiv.classList.contains('open')) {
        summaryDiv.classList.remove('open');
    } 
});


$(document).ready(function(){
    $("#how_many_hours_need_cleaner_slider").owlCarousel({
        loop: false,          // Enables infinite looping
        margin: 5,          // Adjust the margin between items
        nav: true,
        dots:false,           // Show navigation buttons
        navText: ["<i class='fas fa-chevron-left'></i>", "<i class=' fas fa-chevron-right' ></i>"],
        responsive: {
            0: {
                items: 4
            },
            600: {
                items: 5
            },
            1000: {
                items: 8
            }
        }
    });
});

$(document).ready(function(){
    $("#how_many_cleaner_require_slider").owlCarousel({
        loop: false,          // Enables infinite looping
        margin: 5,          // Adjust the margin between items
        nav: true,
        dots:false,           // Show navigation buttons
        navText: ["<i class='fas fa-chevron-left'></i>", "<i class=' fas fa-chevron-right' ></i>"],
        responsive: {
            0: {
                items: 4
            },
            600: {
                items: 5
            },
            1000: {
                items: 8
            }
        }
    });
});

$(document).ready(function(){
    $("#when_would_you_start_slider").owlCarousel({
        loop: true,          // Enables infinite looping
        margin: 10,          // Adjust the margin between items
        nav: true,
        dots:false,           // Show navigation buttons
        navText: ['<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><rect fill="none" height="24" width="24"></rect><g><polygon points="17.77,3.77 16,2 6,12 16,22 17.77,20.23 9.54,12"></polygon></g></svg>', '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><g><path d="M0,0h24v24H0V0z" fill="none"></path></g><g><polygon points="6.23,20.23 8,22 18,12 8,2 6.23,3.77 14.46,12"></polygon></g></svg>'],
        responsive: {
            0: {
                items: 1.5
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
});
    </script>
   <script>
    $(document).ready(function() {
        var mainTitle = $('.mobilie_header_nav');
        var Step = $('.main-title');
        var categoryForm = $('#category_form_new'); // Change this selector to match your actual element
        var originalOffset = mainTitle.offset().top;

        $(window).scroll(function() {
            // Check if the window width is less than or equal to your desired mobile breakpoint
            if ($(window).width() <= 768) { // Adjust 768 to your preferred mobile width
                if ($(window).scrollTop() > originalOffset) {
                    categoryForm.css('margin-top', '380px');
                    mainTitle.addClass('fixed-title'); // Add fixed class and hide original
                    Step.addClass('step-fix'); // Add fixed class and hide original
                    Step.css({
                        'position': 'fixed',
                        'top': '0', // Adjust as needed
                        'width': '100%', // Ensure it stretches across the screen
                        'z-index': '1000' // Set a high z-index if necessary
                    });

                    // Add top margin to category_form_new to offset the fixed header
                   
                } else {
                    categoryForm.css('margin-top', '0');
                    mainTitle.removeClass('fixed-title'); // Remove fixed class and show original
                    Step.removeClass('step-fix'); // Remove fixed class and show original
                    Step.css({
                        'position': 'relative' // Reset to normal flow when not fixed
                    });

                    // Reset margin when header is not fixed
                   
                }
            } else {
                // Optionally, you can reset the styles for larger screens
                categoryForm.css('margin-top', '0');
                mainTitle.removeClass('fixed-title');
                Step.removeClass('step-fix');
                Step.css({
                    'position': 'relative' // Reset to normal flow for larger screens
                });

                // Reset margin for larger screens
              
            }
        });
    });
</script>

    

