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

.tab-container {
      background: white;
      border-radius: 0.5rem;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
      /* max-width: 600px; */
      margin: 0 auto;
      /* padding: 1rem; */
    }
    .nav-tabs{
        width: 100%;

    }
    .nav-item{
      width: 50%;
    }
    .nav-tabs .nav-link {
      font-weight: 600;
      color: #212529;
      border: none;
      border-bottom: 2px solid transparent;
      padding: 1rem 1.25rem;
      font-size: 1rem;
      width: 100%;
    }
    .nav-tabs .nav-link.active {
      color: #0040E6;
      border-color: #0040E6;
    }
    .appointment-card {
      border: 1px solid #e2e8f0;
      border-radius: 0.375rem;
      padding: 1rem 1.25rem;
      margin-top: 1rem;
    }
    .appointment-header {
      font-weight: 700;
      margin-bottom: 0.25rem;
      color: #000;
    }
    .appointment-time {
      font-size: 0.875rem;
      color: #6c757d;
      margin-bottom: 0.5rem;
    }
    .appointment-user {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-weight: 700;
      margin-bottom: 0.25rem;
      font-size: 0.9rem;
      color: #000;
    }
    .appointment-user svg {
      width: 20px;
      height: 20px;
      color: #0040E6;
    }
    .star-rating {
      color: #f0ad4e;
      font-weight: 600;
      margin-left: 0.25rem;
      user-select: none;
    }
    .status-completed {
      background-color: #d1e7dd;
      color: #0f5132;
      font-weight: 600;
      font-size: 0.75rem;
      padding: 0.25rem 0.5rem;
      border-radius: 0.5rem;
      float: right;
      user-select: none;
    }
    .upcoming{
    background-image: url(https://deax38zvkau9d.cloudfront.net/prod/assets/static/group-2.jpg?f=webp);
    background-size: contain;
    height: 400px;
    background-repeat: no-repeat;
    }
    .upcoming p{
        color: #000;
    text-align: center;
    }
    .badge-style {
    display: inline-flex;
    align-items: center;
    background-color: #e8f8ff;
    color: #0040E6;
    font-weight: 500;
    font-size: 14px;
    padding: 4px 10px;
    border-radius: 6px;
    margin-top: 5px;
}
.verified-user {
    display: flex;
    align-items: center;
    font-weight: 500;
    color: #333;
    font-size: 14px;
    margin-top: 8px;
}

.verified-user i {
    font-size: 18px;
    color: #0040E6;
    background-color: #e8f8ff;
    border-radius: 50%;
    padding: 4px;
}
/* Custom pagination styling */
.custom-pagination .shadow-sm {
    box-shadow: none !important;
}

.custom-pagination .inline-flex {
    gap: 0.25rem !important;
}

.custom-pagination .px-2 {
    padding-left: 0.5rem !important;
    padding-right: 0.5rem !important;
}

.custom-pagination .py-2 {
    padding-top: 0.25rem !important;
    padding-bottom: 0.25rem !important;
}

.custom-pagination .w-5 {
    width: 1rem !important;
}

.custom-pagination .h-5 {
    height: 1rem !important;
}

.custom-pagination .text-sm {
    font-size: 15px !important;
    line-height: 2rem !important;
}

.custom-pagination .px-4 {
    padding-left: 0.75rem !important;
    padding-right: 0.75rem !important;
}
/* Custom pagination container */
.custom-pagination nav {
    display: flex;
    justify-content: space-between; /* This will push children to opposite sides */
    align-items: center;
    width: 100%;
    padding: 0.5rem 0;
}

/* Ensure all pagination elements stay in one row */
.custom-pagination .flex.items-center.justify-between {
    display: flex;
    flex-wrap: nowrap;
    align-items: center;
    width: 100%;
    overflow-x: auto;
    padding-bottom: 5px; /* Prevents cutting off */
}

/* Pagination elements container */
.custom-pagination .hidden.sm\:flex-1 {
    display: flex !important;
    /* justify-content: flex-end !important; */
    /* align-items: center !important; */
    gap: 22rem !important;
    width: 100% !important;
}

/* Page number items */
.custom-pagination .relative.z-0.inline-flex {
    margin-left: auto;
}

/* Prevent wrapping */
.custom-pagination .inline-flex {
   gap: 0.25rem !important;
}

/* Adjust icon buttons */
.custom-pagination .px-2.py-2 {
    padding: 0.25rem 0.5rem !important;
}

/* Make sure the "Showing X-Y of Z" text doesn't break layout */
.custom-pagination .text-sm.text-gray-700 {
    white-space: nowrap;
    margin-right: auto; 
    padding-left: 0.5rem; 
}

.custom-pagination .flex.justify-between.flex-1.sm\:hidden {
    display: none !important;
}


.mar-btn{
    margin-bottom: 60px;
}
section{
    padding: 0px 0px; !important;
}

</style>

<div class="body_content">
    <!-- Our LogIn Area -->
    <section class="our-login mt120">
        <div class="container mar-btn">
            <div class="row">
                <div class="col-lg-4">
                    @include('front.account_sidebar')
                </div>

                <div class="col-lg-8">
                    <div class="tab-container">
                        <ul class="nav nav-tabs" role="tablist" id="appointmentTabs">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $activeTab == 'upcoming' ? 'active' : '' }}" id="upcoming-tab"
                                   href="?tab=upcoming" role="tab">Upcoming</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $activeTab == 'past' ? 'active' : '' }}" id="past-tab"
                                   href="?tab=past" role="tab">Past</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-3" id="appointmentTabsContent">
                            {{-- Upcoming Tab --}}
                            <div class="tab-pane fade {{ $activeTab == 'upcoming' ? 'show active' : '' }}" id="upcoming" role="tabpanel">
                                @if(count($upcomingOrders))
                                    @foreach($upcomingOrders as $orders)
                                        @php
                                            $latest_end_date = null;
                                            foreach ($orders->items as $item) {
                                                if (!empty($item->end_date)) {
                                                    $end = date('Y-m-d', strtotime($item->end_date));
                                                    if (!$latest_end_date || $end > $latest_end_date) {
                                                        $latest_end_date = $end;
                                                    }
                                                }
                                            }
                                        @endphp

                                        <a href="{{ url('order-detail/'.$orders->order_id) }}" class="appointment-card-link">
                                            <div class="appointment-card">
                                                <div class="appointment-header">
                                                    {!! Helper::subservicename($orders->items[0]->subservice_id) !!}
                                                    <span class="status-completed">Confirmed</span>
                                                </div>
                                                <div class="appointment-time">
                                                    {{ date('M d, Y', strtotime($latest_end_date)) }},
                                                    {!! Helper::timeslotname($orders->items[0]->time_slot) !!}
                                                </div>

                                                @if(!empty($orders->items[0]->how_often_do_you_need_cleaning))
                                                    <div class="order-type badge-style">
                                                        <i class="fas fa-retweet me-1"></i>
                                                        {{ $orders->items[0]->how_often_do_you_need_cleaning }}
                                                    </div>
                                                @endif

                                                <div class="appointment-user verified-user">
                                                    <i class="fas fa-user-circle me-2"></i>
                                                    <span>{!! Helper::cleanername_new($orders->items[0]->cleaner_id) !!}</span>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach

                                    <div class="mt-3 mb-4 custom-pagination">
                                        {{ $upcomingOrders->appends(['tab' => 'upcoming'])->links() }}
                                    </div>
                                @else
                                    <div class="no-upcoming-wrapper text-center">
                                        <img src="{{ asset('public/images/no-upcoming.png') }}" alt="No Upcoming Appointments" style="max-width: 300px; margin-top: 20px;">
                                        <p class="mt-3">You don't have any upcoming appointments.</p>
                                    </div>
                                @endif
                            </div>

                            {{-- Past Tab --}}
                            <div class="tab-pane fade {{ $activeTab == 'past' ? 'show active' : '' }}" id="past" role="tabpanel">
                                @if(count($pastOrders))
                                    @foreach($pastOrders as $orders)
                                        @php
                                            $latest_end_date = null;
                                            foreach ($orders->items as $item) {
                                                if (!empty($item->end_date)) {
                                                    $end = date('Y-m-d', strtotime($item->end_date));
                                                    if (!$latest_end_date || $end > $latest_end_date) {
                                                        $latest_end_date = $end;
                                                    }
                                                }
                                            }
                                        @endphp

                                        <a href="{{ url('order-detail/'.$orders->order_id) }}" class="appointment-card-link">
                                            <div class="appointment-card">
                                                <div class="appointment-header">
                                                    {!! Helper::subservicename($orders->items[0]->subservice_id) !!}
                                                    <span class="status-completed">Completed</span>
                                                </div>
                                                <div class="appointment-time">
                                                    {{ date('M d, Y', strtotime($latest_end_date)) }},
                                                    {!! Helper::timeslotname($orders->items[0]->time_slot) !!}
                                                </div>

                                                @if(!empty($orders->items[0]->how_often_do_you_need_cleaning))
                                                    <div class="order-type badge-style">
                                                        <i class="fas fa-retweet me-1"></i>
                                                        {{ $orders->items[0]->how_often_do_you_need_cleaning }}
                                                    </div>
                                                @endif

                                                <div class="appointment-user verified-user">
                                                    <i class="fas fa-user-circle me-2"></i>
                                                    <span>{!! Helper::cleanername_new($orders->items[0]->cleaner_id) !!}</span>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach

                                    <div class="mt-3 mb-4 custom-pagination">
                                        {{ $pastOrders->appends(['tab' => 'past'])->links() }}
                                    </div>
                                @else
                                    <div class="no-upcoming-wrapper text-center">
                                        <img src="{{ asset('public/images/no-upcoming.png') }}" alt="No past appointments available" style="max-width: 300px; margin-top: 20px;">
                                        <p class="mt-3">No past appointments available.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@include('front.includes.footer')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab') || 'upcoming';
        const triggerEl = document.querySelector(`#${tab}-tab`);
        if (triggerEl) {
            new bootstrap.Tab(triggerEl).show();
        }
    });
</script>

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
