<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"content="">
    <meta name="description" content="">
    <!-- <meta name="CreativeLayers" content="ATFN"> -->
    <!-- css file -->
    <link rel="stylesheet" href="{{ asset('public/site/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/site/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/site/css/ace-responsive-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('public/site/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('public/site/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('public/site/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/site/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/site/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('public/site/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('public/site/css/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('public/site/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/site/css/ud-custom-spacing.css') }}">
    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="{{ asset('public/site/css/responsive.css') }}">
    <!-- Title -->
    <title>VendorsCity</title>
    <!-- Favicon -->
    <meta property="og:site_name" content="Vendors City">
    <meta property="og:title" content="Vendors City" />
    <meta property="og:description" content="" />
    <meta property="og:image" itemprop="image" content="{{ asset('public/site/images/v-cfavicon.png') }}">
    <meta property="og:type" content="website" />

    <link href="{{ asset('public/site/images/v-cfavicon.png') }}" sizes="128x128" rel="shortcut icon"
        type="image/x-icon" />
    <link href="{{ asset('public/site/images/v-cfavicon.png') }}" sizes="128x128" rel="shortcut icon" />
    <!-- Apple Touch Icon -->
    <link href="{{ asset('public/site/images/v-cfavicon.png') }}" sizes="60x60" rel="apple-touch-icon">
    <link href="{{ asset('public/site/images/v-cfavicon.png') }}" sizes="72x72" rel="apple-touch-icon">
    <link href="{{ asset('public/site/images/v-cfavicon.png') }}" sizes="114x114" rel="apple-touch-icon">
    <link href="{{ asset('public/site/images/v-cfavicon.png') }}" sizes="180x180" rel="apple-touch-icon">


    <!-- Select2 CSS -->

    <link rel="stylesheet" href="{{ asset('public/site/css/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('public/site/css/customstyle.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link href="https://db.onlinewebfonts.com/c/060fd297f19446447a9a1325ad5b889b?family=SF+Pro+Rounded"
        rel="stylesheet">
    <style>
        .valierror {
            background-color: #ee2e34;
            border-color: #ee2e34;
            color: #fff;
        }

        .alert-message {
            background-size: 40px 40px;
            background-image: linear-gradient(135deg, rgba(255, 255, 255, .05) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .05) 50%, rgba(255, 255, 255, .05) 75%, transparent 75%, transparent);
            /* box-shadow: inset 0 -1px 0 rgb(255 255 255 / 40%); */
            width: 100%;
            border: 0px solid;
            color: #fff;
            padding: 10px;

            animation: animate-bg 5s linear infinite;
            display: block;
            margin-bottom: 5px;
            top: 0;
            z-index: 9999;
        }

        .successmain {
            background-color: #0040E6;
            border-color: #0040E6;
        }

        .size_active {
            background: #ABABAB;
            color: #000;
            border: 1px solid #09c6ab !important;
        }

        .color_active {
            border: 1px solid #09c6ab !important;
        }

        .alert-message_cart {
            background-size: 40px 40px;
            background-image: linear-gradient(135deg, rgba(255, 255, 255, .05) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .05) 50%, rgba(255, 255, 255, .05) 75%, transparent 75%, transparent);
            width: 100%;
            border: 0px solid;
            color: #000;
            padding: 10px;
            animation: animate-bg 5s linear infinite;
        }

        .topalert_cart {
            z-index: 9999;
            text-align: center;
            padding: 10px;
            font-size: 18px;
            color: #fff !important;
            position: fixed;
            top: 0px;
        }

        .successcart {
            background-color: #09c6ab;
            border-color: #09c6ab;
        }

        @media (min-width: 992px) {
            .navbar-expand-lg .navbar-collapse {
                display: flex !important;
                flex-basis: auto;
                float: right;
            }
        }

        .contact_successmain {
            background-color: #09c6ab;
            border-color: #09c6ab;
            z-index: 9999999;
            position: absolute;
        }

        .contact_successmain1 {
            background-color: #09c6ab;
            border-color: #09c6ab;
            z-index: 9999999;
            /*position: absolute;*/
        }

        .ui-menu {
            z-index: 3500 !important;
        }

        .ad-tag {
            position: absolute;
            left: initial;
            right: 12px;
            top: 4%;
        }

        a:hover,
        .btn:hover {
            color: #0a58ca
        }

        #get_button {
            background-color: #0040E6;
            border-radius: 30px;
            margin-top: 10px;

        }

        #get_button {
            font-size: 13px;
            font-family: var(--title-font-family);
            font-weight: 500;
            height: 40px;
            padding: 1px 13px !important;
        }

        #gets_button {
            font-size: 15px;
            font-family: var(--title-font-family);
            font-weight: 500;
            height: 40px;
            padding: 5px 100px !important;
        }

        #mega-menu {
            cursor: pointer;
            height: 40px !important;
            line-height: 40px !important;
            max-width: 150px;
        }

        .mega-menu-custom {
            margin-top: 6px;
        }

        #mega-menu .drop-menu {
            height: auto;
            width: 250px !important;
            padding: 0;
        }

        .hover_effect_add {
            padding-left: 2px !important;
            padding-top: 0 !important;
        }

        .hover_effect_add a {
            padding: 20px 20px !important;
            /* margin-right: 13px !important; */
        }

        .hover_effect_add a:hover {
            border-left: 2px solid #0040E6 !important;
            background: #F0EFEC;
        }

        .hover_effect_add .cat-title {
            margin-bottom: 0 !important;
        }

        .select2-container .select2-selection--single {
            height: 45px !important;
            padding: 7px 0px 0px 0px;

        }
        header.nav-innerpage-style .ace-responsive-menu .sub-menu li:hover {
            background-color: #F0EFEC;
            border-left: 2px solid #0a58ca;
        }
        header.nav-innerpage-style .ace-responsive-menu .sub-menu li {
            border-left: 2px solid transparent;
            padding: 0 10px;
            width: auto;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -ms-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }
        .ace-responsive-menu > li > a > .arrow:before {
            margin-left: 5px;
        }
    </style>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body>
    <div class="wrapper ovh">
        <div id="message_succsess" class="successmain alert-message topalert"
            style="text-align: center;display: none; position: fixed;"></div>
        <div id="message_error" class="valierror alert-message topalert"
            style="display:none;text-align: center;
            position: fixed;"></div>

        <div id="message_error" class="valierror alert-message topalert"
            style="display:none;text-align: center;
                    position: fixed;"></div>

        <div class="preloader"></div>

        <!-- Main Header Nav -->
        <header class="header-nav nav-innerpage-style bg-transparent zi9 position-relative main-menu border-0">
            <!-- Ace Responsive Menu -->
            <nav class="posr">
                <div class="container posr menu_bdrt1">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto px-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="logos">
                                    <a class="header-logo logo2" href="{{ url('/') }}"><img style="max-width: 150px;"
                                            src="{{ asset('public/site/images/VC-FULL-COLOR.png') }}"
                                            alt="Header Logo"></a>
                                </div>
                                @php
                                    // $service_data = DB::table('services')->orderBy('set_order')->get();
                                    $service_data = DB::table('services')
                                        ->where('is_active', 0)
                                        ->orderBy('set_order')
                                        ->get();

                                @endphp
                                <div class="home1_style">
                                    <div id="mega-menu" class="mega-menu-custom">
                                        <a class="btn-mega fw500 text-white" href="#"><span
                                                class="pl30 pl10-xl pr5 fz15 vam flaticon-menu"></span> Categories</a>
                                        @if ($service_data != '')
                                            <ul class="menu ps-0">
                                                @foreach ($service_data as $service)
                                                    <li>
                                                        <a class="dropdown"
                                                            href="{{ url('service/' . $service->page_url) }}">
                                                            {{-- <span
                                                                class="menu-icn flaticon-developer"></span> --}}
                                                            <span
                                                                class="menu-title">{{ $service->servicename }}</span>
                                                        </a>

                                                        @php

                                                            $subservice_data = DB::table('subservices')
                                                                ->where('serviceid', $service->id)
                                                                ->orderBy('set_order')
                                                                ->get();

                                                        @endphp

                                                        <div
                                                            class="drop-menu d-flex justify-content-between hover_effect_add">
                                                            @if ($subservice_data != '' && count($subservice_data) > 0)
                                                            <div class="one-third " style="width: 100%;display: block;">
                                                                    @foreach ($subservice_data as $subservice)
                                                                        <a
                                                                            href="{{ url('package-lists/' . $subservice->page_url) }}">
                                                                            <div class="h6 cat-title">
                                                                                {{ $subservice->subservicename }}
                                                                            </div>
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            @endif

                                                            {{-- <a id="get_button"
                                                                href="{{ url('enquiry/' . $service->id) }}"
                                                                class="ud-btn btn-thm2 add-joining">

                                                                Get Free Quotes

                                                            </a> --}}

                                                            {{-- <a id="get_button"
                                                                href="{{ route('enquiry', ['id' => 0, 'service_id' => $service->id]) }}"
                                                                class="ud-btn btn-thm2 add-joining">

                                                                Get Free Quotes

                                                            </a> --}}


                                                            {{-- <a href="">
                                                                <div class="h6 cat-title">
                                                                    Top 10 Vendors
                                                                </div>
                                                            </a> --}}



                                                        </div>

                                                    </li>
                                                @endforeach


                                            </ul>
                                        @endif
                                    </div>
                                </div>
                                <!-- Responsive Menu Structure-->
                                <ul class="ace-responsive-menu" data-menu-style="horizontal">
                                    <li class="visible_list"> <a class="list-item" href="{{ url('/') }}"><span
                                                class="title">Home</span></a>
                                        <!-- Level Two-->


                                    </li>




                                    <li class="visible_list"> <a class="list-item "
                                            href="{{ url('/services') }}">Services</a>
                                    </li>

                                    <li class="visible_list"> <a class="list-item "
                                            href="{{ url('/our-vendors') }}">Our Vendors</a>

                                    </li>
                                    <li class="visible_list"> <a class="list-item "
                                            href="{{ url('/blog') }}">Blogs</a>

                                    </li>
                                    {{-- <li class="visible_list"> <a class="list-item " href="#">Get Free Quote</a>
                                    </li> --}}
                                    <li> <a class="list-item " href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-auto px-0 resfix">
                            <div class="d-flex align-items-center">
                                <a class="login-info" data-bs-toggle="modal" href="#exampleModalToggle"
                                    role="button"><span class="flaticon-loupe"></span></a>
                                <a class="login-info mx10-lg mx30" href="{{ url('/become-vendor') }}"><span
                                        class="d-none d-xl-inline-block">Become a</span> Vendor</a>
                                @php
                                    $userData = Session::get('user');
                                    // $userData = Session::get('user');
                                @endphp
                                @if ($userData == '')
                                    {{-- <a class="login-info mr10-lg mr30" href="{{ url('Sign-Up') }}">Registration</a> --}}
                                    {{-- <a class="login-info mr10-lg mr30" href="{{ route('Sign-in') }}">Log
                                        in</a> --}}

                                        <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">
                                            <li class="visible_list"> <a style="padding-left: 0;" class="list-item" href="#"><span class="title">Login</span></a>
                                              <!-- Level Two-->
                                              <ul>
                                                <li><a href="{{ route('Sign-in') }}">Customer Login</a></li>
                                                <li><a href="{{ url('/login') }}">Vendor Login</a></li>
                                              </ul>
                                            </li> 
                                        </ul>
                                @else
                                    {{-- <a class="login-info mr10-lg mr30" href="{{ route('user_signout') }}">Log out</a> --}}

                                    <a class="login-info mr10-lg mr30" href="{{ url('my-account') }}"> <i
                                            class="fa-regular fa-user text-thm2 pe-2 vam"></i></a>
                                @endif


                               {{-- <a class="ud-btn btn-thm2 add-joining" href="{{ url('/services') }}">Book Now!</a>--}}
                                <a class="ud-btn btn-thm2 add-joining ml10" href="{{ url('/cart') }}" style="
    padding: 5px 18px !important;
"><span class="fa-solid fa-cart-shopping  "></span> Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Search Modal -->
        <div class="search-modal">
            <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
                aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="fal fa-xmark"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="popup-search-field search_area">
                                <input type="text" class="form-control border-0"
                                    placeholder="What service are you looking for today?">
                                <label><span class="far fa-magnifying-glass"></span></label>
                                <button class="ud-btn btn-thm" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hiddenbar-body-ovelay"></div>

        <!-- Mobile Nav  -->
        <div id="page" class="mobilie_header_nav stylehome1">
            <div class="mobile-menu">
                <div class="header bdrb1">
                    <div class="menu_and_widgets">
                        <div class="mobile_menu_bar d-flex justify-content-between align-items-center">
                            <a class="mobile_logo" href="{{ url('/') }}"><img style="max-width: 150px;"
                                    src="{{ asset('public/site/images/VC-FULL-COLOR.png') }}" alt=""></a>
                            <div class="right-side text-end">
                                <!-- <a class="" href="page-login.html">join</a> -->
                                <a class="menubar ml30" href="#menu"><img
                                        src="{{ asset('public/site/images/mobile-dark-nav-icon.svg') }}"
                                        alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="posr">
                        <div class="mobile_menu_close_btn"><span class="far fa-times"></span></div>
                    </div>
                </div>
            </div>
            <!-- /.mobile-menu -->
            <nav id="menu" class="">
                <ul>
                    @if ($service_data != '')


                        <li><span>Categories</span>
                            <ul>
                                @foreach ($service_data as $service)
                                    @php

                                        $subservice_data = DB::table('subservices')
                                            ->where('serviceid', $service->id)
                                            ->orderBy('id', 'DESC')
                                            ->get();

                                    @endphp
                                    <li><span>{{ $service->servicename }}</span>
                                        @if ($subservice_data != '' && count($subservice_data) > 0)
                                            <ul>
                                                @foreach ($subservice_data as $subservice)
                                                    <li><a
                                                            href="{{ url('package-lists/' . $subservice->page_url) }}">{{ $subservice->subservicename }}</a>
                                                    </li>
                                                @endforeach
                                                <!-- <li><a href="page-service-v2.html">Service v2</a></li>
                                    <li><a href="page-service-v3.html">Service v3</a></li>
                                    <li><a href="page-service-v4.html">Service v4</a></li>
                                    <li><a href="page-service-v5.html">Service v5</a></li>
                                    <li><a href="page-service-v6.html">Service v6</a></li>
                                    <li><a href="page-service-v7.html">Service v7</a></li>
                                    <li><a href="page-service-all.html">Service All</a></li>
                                    <li><a href="page-service-single.html">Service Single</a></li>
                                    <li><a href="page-service-single-v1.html">Single V1</a></li>
                                    <li><a href="page-service-single-v2.html">Single V2</a></li> -->
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach

                            </ul>
                        </li>

                    @endif
                    <li><a class="list-item" href="{{ url('/') }}"><span>Home</span></a></li>
                    <li><a class="list-item" href="{{ url('/vendor-database') }}"><span>Vendor Database</span></a>
                    </li>
                    <li><a class="list-item" href="{{ url('/services') }}"><span>Services</span></a></li>
                    <li><a class="list-item" href="{{ url('/become-vendor') }}"><span>Become a Vendor</a></li>

                    @php
                        $userData = Session::get('user');
                        // $userData = Session::get('user');
                    @endphp

                    @if ($userData == '')
                        {{-- <li><a class="list-item" href="{{ route('Sign-Up.create') }}"><span>Log in</span></a></li> --}}
                        <li><span>Login</span>
                            <ul>
                                <li><a href="{{ route('Sign-in') }}">Customer Login</a></li>
                                <li><a href="{{ url('/login') }}">Vendor Login</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a class="list-item" href="{{ url('user_signout') }}"><span>Log out</span></a></li>
                    @endif
                    <li><a class="list-item" href="{{ url('/services') }}"><span>Book Now</span></a></li>
                    <li><a class="list-item" href="{{ url('/cart') }}"><span>Cart</span></a></li>

                    <!--  <li><span>Users</span>
                        <ul>
                            <li><span>Dashboard</span>
                                <ul>
                                    <li><a href="page-dashboard.html">Dashboard</a></li>
                                    <li><a href="page-dashboard-proposal.html">Proposal</a></li>
                                    <li><a href="page-dashboard-save.html">Saved</a></li>
                                    <li><a href="page-dashboard-message.html">Message</a></li>
                                    <li><a href="page-dashboard-reviews.html">Reviews</a></li>
                                    <li><a href="page-dashboard-invoice.html">Invoice</a></li>
                                    <li><a href="page-dashboard-payouts.html">Payouts</a></li>
                                    <li><a href="page-dashboard-statement.html">Statement</a></li>
                                    <li><a href="page-dashboard-manage-service.html">Manage Service</a></li>
                                    <li><a href="page-dashboard-add-service.html">Add Services</a></li>
                                    <li><a href="page-dashboard-manage-jobs.html">Manage Jobs</a></li>
                                    <li><a href="page-dashboard-manage-project.html">Manage Project</a></li>
                                    <li><a href="page-dashboard-create-project.html">Create Project</a></li>
                                    <li><a href="page-dashboard-profile.html">My Profile</a></li>
                                </ul>
                            </li>
                            <li><span>Employee</span>
                                <ul>
                                    <li><a href="page-employee-v1.html">Employee V1</a></li>
                                    <li><a href="page-employee-v2.html">Employee V2</a></li>
                                    <li><a href="page-employee-single.html">Employee Single</a></li>
                                </ul>
                            </li>
                            <li><span>Freelancer</span>
                                <ul>
                                    <li><a href="page-freelancer-v1.html">Freelancer V1</a></li>
                                    <li><a href="page-freelancer-v2.html">Freelancer V2</a></li>
                                    <li><a href="page-freelancer-v3.html">Freelancer V3</a></li>
                                    <li><a href="page-freelancer-list-v1.html">List V1</a></li>
                                    <li><a href="page-freelancer-list-v2.html">List V2</a></li>
                                    <li><a href="page-freelancer-list-v3.html">List V3</a></li>
                                    <li><a href="page-freelancer-single.html">Freelancer Single</a></li>
                                    <li><a href="page-freelancer-single-v1.html">Single V1</a></li>
                                    <li><a href="page-freelancer-single-v2.html">Single V2</a></li>
                                </ul>
                            </li>
                            <li><a href="page-become-seller.html">Become Seller</a></li>
                        </ul>
                    </li>
                    <li><span>Pages</span>
                        <ul>
                            <li><span>About</span>
                                <ul>
                                    <li><a href="page-about.html">About v1</a></li>
                                    <li><a href="page-about-v2.html">About v2</a></li>
                                </ul>
                            </li>
                            <li><span>Shop</span>
                                <ul>
                                    <li><a href="page-shop.html">List</a></li>
                                    <li><a href="page-shop-single.html">Single</a></li>
                                    <li><a href="page-shop-cart.html">Cart</a></li>
                                    <li><a href="page-shop-checkout.html">Checkout</a></li>
                                    <li><a href="page-shop-order.html">Order</a></li>
                                </ul>
                            </li>
                            <li><a href="page-contact.html">Contact</a></li>
                            <li><a href="page-error.html">404</a></li>
                            <li><a href="page-faq.html">Faq</a></li>
                            <li><a href="page-help.html">Help</a></li>
                            <li><a href="page-invoice.html">Invoices</a></li>
                            <li><a href="page-login.html">Login</a></li>
                            <li><a href="page-pricing.html">Pricing</a></li>
                            <li><a href="page-register.html">Register</a></li>
                            <li><a href="page-terms.html">Terms</a></li>
                            <li><a href="page-ui-element.html">UI Elements</a></li>
                        </ul>
                    </li>
                    <li><span>Blog</span>
                        <ul>
                            <li><a href="page-blog-v1.html">List V1</a></li>
                            <li><a href="page-blog-v2.html">List V2</a></li>
                            <li><a href="page-blog-v3.html">List V3</a></li>
                            <li><a href="page-blog-single.html">Single</a></li>
                        </ul>
                    </li> -->
                    <!-- Only for Mobile View -->
                </ul>
            </nav>
        </div>

        <div class="body_content">
