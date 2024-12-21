@include('front.includes.header')
<style type="text/css">
    .funfact_one.at-home2-hero .timer,
    .funfact_one.at-home2-hero span {
        color: #000
    }
</style>
<style type="text/css">
    .home11-hero-img .iconbox-small1 {
        padding: 10px;
        bottom: 90px;
        left: -90px;
    }

    .home_slider_padding {
        padding-bottom: 80px
    }

    .home_slider_padding .home11-hero-content .title {
        line-height: 54px;
        margin-bottom: 20px;
    }

    .home_slider_padding p {
        margin-bottom: 0 !important
    }

    .iconbox-small1 {
        background-color: #eee;
    }

    .home11-hero-img .iconbox-small2 {
        padding: 0 15px 0 0;
        right: 0;
    }

    .iconbox-small2 {
        background-color: #eee;
    }

    .subservice_image_sec .list-thumb {
        padding: 10px;
    }

    .subservice_image_sec .list-thumb img {
        border-radius: 20px;
    }

    .services_banner_image img {
        width: 100%
    }

    .services_banner_text h2 {
        font-size: 54px;
        width: 80%;
    }

    a:hover {
        color: #0040E6
    }

    @media only screen and (max-width: 600px) {

        .home_slider_padding .home11-hero-content .title {
            line-height: normal;
        }

        .home11-hero-content .title {
            font-size: 27px;
        }

        .hero-home11 {
            padding-top: 20px !important;
        }

        .home_slider_padding {
            padding-bottom: 0px;
        }

        .home11-hero-img .iconbox-small2 {
            top: 56%;
        }

        .home11-hero-img .iconbox-small1 {
            bottom: 7px;
            left: 0;
        }

        .home_slider_padding {
            padding-bottom: 0
        }

        .home11-hero-img img {
            width: 100%
        }

        .section2 {
            padding-top: 20px !important
        }

        .section3 .heading2 {
            font-size: 35px;
            line-height: normal;
            padding-top: 20px;
        }

        .funfact_one_borderleft {
            border-left: inherit;
            margin-bottom: 13px !important;
        }

        .sectionmarque1 {
            margin: 16px 0 !important;
        }

        .services_banner_text h2 {
            font-size: 40px;
            width: 100%;
            line-height: normal;
            margin-bottom: 10px !important;
        }

        .mm-navbar {
            position: relative;
        }

        .section2 .custom_box {
            height: auto;
        }

        .custom_slider_width .owl-item {
            width: auto !important;
            text-align: center;
        }

        .our-about .mb30-lg {
            margin-bottom: 0px !important;
        }

        .our-about {
            padding-top: 20px !important;
        }

        .we_do_heading {
            font-size: 47px;
            line-height: 53px;
        }

        .bgc-thm3 {
            padding: 30px 0;
        }
    }
</style>


<section class="hero-home11 pt70 pb0">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6 col-xl-6 mb30-md home_slider_padding">
                <div class="home11-hero-content">

                    <h2 class="title animate-up-2">The best in class services, right at your doorstep.</h2>
                    <p class="text animate-up-3">The best in class services, right at your doorstep.
                        out of your time and cost</p>
                    <p class="text animate-up-3"><span class="flaticon-user custom_icon"> </span> 15,000+ Customers |
                        <span class="flaticon-star custom_icon"> </span>Rated 4.8 out of 5 | <span
                            class="flaticon-call custom_icon"> </span>Live Customer Support
                    </p>
                </div>
                <div
                    class="advance-search-tab bgc-white p10 bdrs4-sm bdrs60 banner-btn position-relative zi1 animate-up-3 mt20 mb20">
                    <div class="row">
                        <div class="col-md-5 col-lg-6 col-xl-6">
                            <div class="advance-search-field mb10-sm">
                                <form action="{{ url('search-package') }}" method="get" id="search_banner"
                                    class="form-search position-relative">
                                    @csrf
                                    <div class="box-search">
                                        <span class="icon far fa-magnifying-glass"></span>
                                        <input class="form-control" type="text" name="search"
                                            placeholder="What are you looking for?">
                                        <div class="search-suggestions">
                                            <h6 class="fz14 ml30 mt25 mb-3">Popular Search</h6>
                                            <div class="box-suggestions">
                                                <ul class="px-0 m-0 pb-4">
                                                    <li>
                                                        <div class="info-product">
                                                            <div class="item_title">mobile app development</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="info-product">
                                                            <div class="item_title">mobile app builder</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="info-product">
                                                            <div class="item_title">mobile legends</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="info-product">
                                                            <div class="item_title">mobile app ui ux design</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="info-product">
                                                            <div class="item_title">mobile game app development</div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="info-product">
                                                            <div class="item_title">mobile app design</div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-3">

                            <div class="bselect-style1 bdrl1 bdrn-sm">
                                <select class="selectpicker" data-width="100%">
                                    <option>Choose Services</option>
                                    @if ($service != '')
                                        @foreach ($service as $service_data)
                                            <option data-tokens="{{ $service_data->servicename }}"
                                                value="{{ $service_data->id }}">{{ $service_data->servicename }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>
                        <div class="col-md-3 col-lg-2 col-xl-3">
                            <div class="text-center text-xl-start">
                                <button class="ud-btn btn-thm w-100 bdrs60" type="button"
                                    onclick="search_banner()">Search</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt20 animate-up-4">
                    <div class="col-xl-12">
                        <p class="animate-up-2 ff-heading mt0 mb15">Frequently searched</p>
                        <div class="home9-tags d-md-flex align-items-center animate-up-4">
                            <a class="bdrs60 mb-2 mb-md-0" href="">Relocation</a>
                            <a class="bdrs60 mb-2 mb-md-0" href="">Home Cleaning </a>
                            <a class="bdrs60 mb-2 mb-md-0" href="">Women’s Salon</a>
                            <a class="bdrs60 mb-2 mb-md-0" href="">Lab At Home</a>

                        </div>
                    </div>

                </div>

            </div>
            <div class="col-lg-6">
                <div class="home11-hero-img text-center text-xxl-end">
                    <img class="bdrs20" src="{{ asset('public/site/images/about/about-1.png') }}" alt="">
                    <div
                        class="iconbox-small1 text-start d-flex wow fadeInRight default-box-shadow4 bounce-x animate-up-1">
                        <!-- <span class="icon flaticon-badge"></span> -->
                        <div class="details pl20">
                            <img class="bdrs20" src="{{ asset('public/site/images/customer.png') }}" alt="">
                        </div>
                    </div>
                    <div
                        class="iconbox-small2 text-start d-flex wow fadeInLeft default-box-shadow4 bounce-y animate-up-2">
                        <!-- <span class="icon flaticon-security"></span> -->
                        <div class="details pl20">
                            Top-rated professionals
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Need something -->
<section class="our-features pb40 pb30-md pt150 section2" style="display:none;">
    <div class="container wow fadeInUp">
        <!-- <div class="row">
          <div class="col-lg-12">
            <div class="main-title">
              <h2>Need something done?</h2>
              <p class="text">Most viewed and all-time top-selling services</p>
            </div>
          </div>
        </div> -->
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="iconbox-style1 at-home5 p-23 custom_box">
                    <div class="icon before-none section_2_icon"><span class="flaticon-cv section_2flaticon"></span>
                    </div>
                    <div class="details">
                        <h4 class="title mt10 mb-3">500+ Services Offered</h4>
                        <p class="text">Explore our best in class services and widest range of home services.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="iconbox-style1 at-home5 p-23 custom_box">
                    <div class="icon before-none section_2_icon"><span
                            class="flaticon-web-design section_2flaticon"></span></div>
                    <div class="details">
                        <h4 class="title mt10 mb-3">100% Quality Assurance</h4>
                        <p class="text">Top quality from verified vendors,with your orders protected from payment to
                            completion.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="iconbox-style1 at-home5 p-23 custom_box">
                    <div class="icon before-none section_2_icon"><span
                            class="flaticon-secure section_2flaticon"></span>
                    </div>
                    <div class="details">
                        <h4 class="title mt10 mb-3">Top-Rated Professionals</h4>
                        <p class="text">Our professionals are reliable & well-trained, with an average rating of 4.78
                            out of 5!</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="iconbox-style1 at-home5 p-23 custom_box">
                    <div class="icon before-none section_2_icon"><span
                            class="flaticon-customer-service section_2flaticon"></span></div>
                    <div class="details">
                        <h4 class="title mt10 mb-3">Same-Day Availability</h4>
                        <p class="text">Book in less than 60 seconds, and even select same-day slots.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mx-auto know_more_btn">
                <a href="#" class="ud-btn btn-thm2">View All Services</a>
            </div>
        </div>
    </div>
</section>

<section class="pt0-lg pb0-lg pb0 section3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-xl-7 wow fadeInRight">
                <div class="cta-style6 mb30-sm">
                    <h2 class="cta-title mb25 heading2">Explore millions of<br>
                        offerings tailored to<br>
                        your specific needs</h2>

                </div>
            </div>
            <div class="col-lg-5 col-xl-5 wow fadeInRight">
                <div class="row">
                    <div class="col-6">
                        <div class="funfact_one funfact_one_borderleft mb40">
                            <div class="details">
                                <ul class="ps-0 mb-0 d-flex">
                                    <li>
                                        <div class="timer text_blue">50</div>
                                    </li>
                                    <li><span class="text_blue">+</span></li>
                                </ul>
                                <p class="mb-0">services</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="funfact_one funfact_one_borderleft mb40">
                            <div class="details">
                                <ul class="ps-0 mb-0 d-flex">
                                    <li>
                                        <div class="timer text_blue">2000</div>
                                    </li>
                                    <li><span class="text_blue">+</span></li>
                                </ul>
                                <p class="mb-0">verified vendors</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="funfact_one funfact_one_borderleft mb40">
                            <div class="details">
                                <ul class="ps-0 mb-0 d-flex">
                                    <li>
                                        <div class="timer text_blue">5000</div>
                                    </li>
                                    <li><span class="text_blue">+</span></li>
                                </ul>
                                <p class="mb-0">happy customers</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="funfact_one funfact_one_borderleft mb40">
                            <div class="details">
                                <ul class="ps-0 mb-0 d-flex">
                                    <li>
                                        <div class="timer text_blue">5</div>
                                    </li>
                                    <li><span class="text_blue">+</span></li>
                                </ul>
                                <p class="mb-0">countries
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-12 mt50">
                <div class="row wow fadeInUp">
                    <div class="col-lg-12">
                        <div
                            class="slider-outer-dib vam_nav_style dots_none slider-4-grid owl-carousel owl-theme custom_slider_width">
                            <div class="item">
                                <div class="iconbox-style1 bdr1 default-box-shadow1">
                                    <div class="icon"><img class="bdrs20"
                                            src="{{ asset('public/site/images/localmoving.png') }}"
                                            alt=""></span></div>
                                    <div class="details mt20">
                                        <!-- <p class="text mb5">1.853 skills</p> -->
                                        <h5 class="title text_blue">Local Moving</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="iconbox-style1 bdr1 default-box-shadow1">
                                    <div class="icon"><img class="bdrs20"
                                            src="{{ asset('public/site/images/womanssalon.png') }}"
                                            alt=""></span></div>
                                    <div class="details mt20">
                                        <!-- <p class="text mb5">1.853 skills</p> -->
                                        <h5 class="title text_blue">Women's Salon</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="iconbox-style1 bdr1 default-box-shadow1">
                                    <div class="icon"><img class="bdrs20"
                                            src="{{ asset('public/site/images/womensspa.png') }}"
                                            alt=""></span></div>
                                    <div class="details mt20">
                                        <!-- <p class="text mb5">1.853 skills</p> -->
                                        <h5 class="title text_blue">Women's Spa</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="iconbox-style1 bdr1 default-box-shadow1">
                                    <div class="icon"><img class="bdrs20"
                                            src="{{ asset('public/site/images/furniturecleaning.png') }}"
                                            alt=""></span></div>
                                    <div class="details mt20">
                                        <!-- <p class="text mb5">1.853 skills</p> -->
                                        <h5 class="title text_blue">Furniture Cleaning</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="iconbox-style1 bdr1 default-box-shadow1">
                                    <div class="icon"><img class="bdrs20"
                                            src="{{ asset('public/site/images/labathome.png') }}"
                                            alt=""></span></div>
                                    <div class="details mt20">
                                        <!-- <p class="text mb5">1.853 skills</p> -->
                                        <h5 class="title text_blue">Lab At Home</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="iconbox-style1 bdr1 default-box-shadow1">
                                    <div class="icon"><img class="bdrs20"
                                            src="{{ asset('public/site/images/mensgrooming.png') }}"
                                            alt=""></span></div>
                                    <div class="details mt20">
                                        <!-- <p class="text mb5">1.853 skills</p> -->
                                        <h5 class="title text_blue">Men's Grooming</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="iconbox-style1 bdr1 default-box-shadow1">
                                    <div class="icon"><img class="bdrs20"
                                            src="{{ asset('public/site/images/accleaning.png') }}"
                                            alt=""></span></div>
                                    <div class="details mt20">
                                        <!-- <p class="text mb5">1.853 skills</p> -->
                                        <h5 class="title text_blue">A/C Cleaning</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="iconbox-style1 bdr1 default-box-shadow1">
                                    <div class="icon"><img class="bdrs20"
                                            src="{{ asset('public/site/images/homecleaning.png') }}"
                                            alt=""></span></div>
                                    <div class="details mt20">
                                        <!-- <p class="text mb5">1.853 skills</p> -->
                                        <h5 class="title text_blue">Home Cleaning</h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <a href="#" class="ud-btn btn-thm2">Book Now</a>
                </div>
            </div> --}}

        </div>
    </div>

</section>

<section class="bgc-thm2 container pb0 pt0 mb30 mt50 sectionmarque1">
    <div class="container">
        <div class="row align-items-center custom_marquee">


            <marquee width="100%" direction="left">| 15,000+ Customers | <span class="flaticon-star custom_icon">
                </span>Rated 4.8 out of 5 | <span class="flaticon-call custom_icon"> </span>Live Customer Support |
                15,000+ Customers | <span class="flaticon-star custom_icon"> </span>Rated 4.8 out of 5 | <span
                    class="flaticon-call custom_icon"> </span>Live Customer Support | 15,000+ Customers | <span
                    class="flaticon-star custom_icon"> </span>Rated 4.8 out of 5 | <span
                    class="flaticon-call custom_icon"> </span>Live Customer Support | 15,000+ Customers | <span
                    class="flaticon-star custom_icon"> </span>Rated 4.8 out of 5 | <span
                    class="flaticon-call custom_icon"> </span>Live Customer Support | 15,000+ Customers | <span
                    class="flaticon-star custom_icon"> </span>Rated 4.8 out of 5 | <span
                    class="flaticon-call custom_icon"> </span>Live Customer Support | 15,000+ Customers | <span
                    class="flaticon-star custom_icon"> </span>Rated 4.8 out of 5 | <span
                    class="flaticon-call custom_icon"> </span>Live Customer Support |
            </marquee>

        </div>
    </div>
</section>





@if ($service != '')
    <section class="pb90 pb20-md">


        @foreach ($service as $service_data)
            @php
                $subservice_data = DB::table('subservices')
                    ->where('serviceid', $service_data->id)
                    ->orderBy('id', 'DESC')
                    ->get();

            @endphp

            @php
                // echo"<pre>";print_r($service_data);echo"</pre>";
            @endphp
            @if ($subservice_data != '' && count($subservice_data) > 0)
                <div class="container">
                    <div class="row align-items-center wow fadeInUp" data-wow-delay="00ms">
                        <div class="col-lg-9">
                            <div class="main-title">
                                <h2 class="title">{{ $service_data->servicename }}</h2>
                                {{-- <p class="paragraph">Get some Inspirations from 1800+ skills</p> --}}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="text-start text-lg-end mb-4 mb-lg-2">
                                <a class="ud-btn2 ud-btn btn-thm2" href="page-blog-v1.html">View All</a>
                            </div>
                        </div>
                    </div>

                    @if ($subservice_data != '')
                        <div class="row wow fadeInUp" data-wow-delay="300ms">
					  <div class="dots_none slider-dib-sm slider-5-grid vam_nav_style owl-theme owl-carousel">
                            @foreach ($subservice_data as $subservice)
                                <div class="subservice_image_sec">
								
                            <div class="item">

                                    <div class="listing-style1 bdrs12 default-box-shadow1">
                                        <div class="list-thumb">
                                            <a href="{{ url('package-lists/' . $subservice->page_url) }}">
                                                <img class="w-100"
                                                    src="{{ asset('public/upload/subservice/large/' . $subservice->image) }}"
                                                    alt="" height="120px">
                                            </a>
                                        </div>
                                        <div class="list-content">
                                            <div class="list-meta">
                                                <a class="d-flex align-items-center"
                                                    href="{{ url('package-lists/' . $subservice->page_url) }}">

                                                    <span>
                                                        <h5 class="fz14 mb-1">{{ $subservice->subservicename }}</h5>

                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
									 </div> 
                                </div>
                            @endforeach
							</div>

                        </div>
                    @endif

                    @if (
                        $service_data->title1 != '' ||
                            $service_data->banner_url != '' ||
                            $service_data->title2 != '' ||
                            $service_data->image != '')
                        <section class="our-about bgc-thm2 container pb0 pt0 mb30">
                            <div class="container">
                                <div class="row align-items-center">

                                    <div class="col-xl-5 offset-xl-1 services_banner_text">
                                        <div class="position-relative wow fadeInLeft" data-wow-delay="300ms">
                                            @if ($service_data->title1 != '')
                                                <h4 class="">{{ $service_data->title1 }}</h4>
                                            @endif

                                            @if ($service_data->title2 != '')
                                                <h2 class=" mb35">{{ $service_data->title2 }}</h2>
                                            @endif

                                            @if ($service_data->banner_url != '')
                                                <a href="{{ $service_data->banner_url }}" class="ud-btn btn-thm">Best
                                                    Deals</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="position-relative mb30-lg">

                                            <div class="about-img wow fadeInRight services_banner_image"
                                                data-wow-delay="300ms">
                                                @if ($service_data->image != '')
                                                    <img class=""
                                                        src="{{ asset('public/upload/service/large/' . $service_data->image) }}"
                                                        alt="">
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif

                </div>
            @endif
        @endforeach

    </section>
@endif

<section class="pb90 pb30-md pt-0">
    <div class="container">
        <div class="row align-items-center wow fadeInUp" data-wow-delay="00ms">
            <div class="col-lg-6">
                <div class="main-title2">
                    <h2 class="title we_do_heading">We do the work,<br>so that you can chill.</h2>

                </div>
            </div>
            <div class="col-lg-6">

                <p class="paragraph we_cut_out_paragraph">We cut out the unnecessary steps with our easy to order
                    process that makes your to-do-lists for your home easy,
                    fast, and stress-free.
                </p>

            </div>
        </div>

    </div>
</section>

<section class="our-about bgc-thm2 container pb0 pt0 mb30">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-xl-5 offset-xl-1">
                <div class="position-relative wow fadeInLeft" data-wow-delay="300ms">
                    <h2 class="mb35">Step 1</h2>
                    <h2 class=" mb35">Find your<br class="d-none d-lg-block"> required service</h2>

                    <div class="list-style2 light-style">
                        <ul class="mb30">
                            <li><i class="far fa-check fa-check-custom"></i>500+ listed services</li>
                            <li><i class="far fa-check fa-check-custom"></i>Same day availability</li>
                            <li><i class="far fa-check fa-check-custom"></i>Trusted professionals</li>
                            <li><i class="far fa-check fa-check-custom"></i>5000+ happy customers</li>
                        </ul>
                    </div>
                    <a href="#" class="ud-btn btn-thm">Get Started</a>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="position-relative mb30-lg">

                    <div class="about-img wow fadeInRight" data-wow-delay="300ms">
                        <img class="w100" src="{{ asset('public/site/images/HomepageStep1.png') }}"
                            alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="our-about bgc-thm2 container pb0 pt0 mb30">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-xl-5 offset-xl-1">
                <div class="position-relative wow fadeInLeft" data-wow-delay="300ms">
                    <h2 class="mb35">Step 2</h2>
                    <h2 class=" mb35">Book your<br class="d-none d-lg-block"> service</h2>

                    <div class="list-style2 light-style">
                        <ul class="mb30">
                            <li><i class="far fa-check fa-check-custom"></i>Easy booking process</li>
                            <li><i class="far fa-check fa-check-custom"></i>Safe payments</li>
                            <li><i class="far fa-check fa-check-custom"></i>Cancel order anytime</li>
                            <li><i class="far fa-check fa-check-custom"></i>Refer and Earn</li>
                        </ul>
                    </div>
                    <div class="row mt20 animate-up-4">
                        <div class="col-xl-12">
                            <p class="animate-up-2 ff-heading mt30 mb15">Frequently Booked</p>
                            <div
                                class="home9-tags d-md-flex align-items-center animate-up-4 step-2-frenquently-booked">
                                <a class="bdrs60 mb-2 mb-md-0" href="">Relocation</a>
                                <a class="bdrs60 mb-2 mb-md-0" href="">Home Cleaning </a>
                                <a class="bdrs60 mb-2 mb-md-0" href="">Women’s Salon</a>
                                <a class="bdrs60 mb-2 mb-md-0" href="">Lab At Home</a>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-xl-6">
                <div class="position-relative mb30-lg">

                    <div class="about-img wow fadeInRight" data-wow-delay="300ms">
                        <img class="w100" src="{{ asset('public/site/images/HomepageStep2.png') }}"
                            alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="our-about bgc-thm2 container pb0 pt0 mb30">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-xl-5 offset-xl-1">
                <div class="position-relative wow fadeInLeft" data-wow-delay="300ms">
                    <h2 class="mb35">Step 3</h2>
                    <h2 class=" mb35">Relax<br class="d-none d-lg-block"> & chill</h2>

                    <div class="list-style2 light-style">
                        <ul class="mb30">
                            <li><i class="far fa-check fa-check-custom"></i>100% satisfaction guaranteed</li>
                            <li><i class="far fa-check fa-check-custom"></i>Get 10% off on repeat orders</li>
                            <li><i class="far fa-check fa-check-custom"></i>Refer and earn</li>
                            <li><i class="far fa-check fa-check-custom"></i>4.7 on Google Reviews</li>
                        </ul>
                    </div>
                    <a href="#" class="ud-btn btn-thm">Book Now</a>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="position-relative mb30-lg">

                    <div class="about-img wow fadeInRight" data-wow-delay="300ms">
                        <img class="w100" src="{{ asset('public/site/images/HomepageStep3.png') }}"
                            alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb90 pb30-md pt90">
    <div class="container">
        <div class="row align-items-center wow fadeInUp" data-wow-delay="00ms">
            <div class="col-lg-6">
                <div class="main-title2">
                    <h2 class="title we_do_heading">Top Ranked Vendors</h2>

                </div>
            </div>
            <div class="col-lg-6">

                <p class="paragraph we_cut_out_paragraph">Get your weekend back, we've got your to-do list
                    covered. Hire our top rated verified vendors for the best
                    in class stress free service and top class prices
                </p>

            </div>
        </div>

    </div>
</section>

<section class="bgc-thm3">
    <div class="container">
        <div class="row align-items-md-center">
            <div class="col-md-6 col-lg-8 mb30-md wow fadeInUp" data-wow-delay="100ms">
                <div class="main-title">
                    <h2 class="title">Customers Love Us</h2>
                    <p class="paragraph">100% Satisfaction guaranteed. Our customers are our
                        priority which is why we are the best rated brand on
                        Google.</p>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="funfact_one">
                            <div class="details">
                                <ul class="ps-0 d-flex mb-0">
                                    <li>
                                        <div class="timer">4.9</div>
                                    </li>

                                    <li><span>/</span></li>
                                    <li>
                                        <div class="timer">5</div>
                                    </li>
                                </ul>
                                <p class="text mb-0">Ratings on Google </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="funfact_one">
                            <div class="details">
                                <ul class="ps-0 d-flex mb-0">
                                    <li>
                                        <div class="timer">500</div>
                                    </li>
                                    <li><span>+</span></li>
                                </ul>
                                <p class="text mb-0">Positive reviews</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="testimonial-slider2 mb15 navi_pagi_bottom_center slider-1-grid owl-carousel owl-theme wow fadeInUp"
                    data-wow-delay="300ms">
                    <div class="item">
                        <div class="testimonial-style1 default-box-shadow1 position-relative bdrs16 mb35">
                            <div class="testimonial-content">
                                <h4 class="title text-thm text_blue">Great Service</h4>
                                <span class="icon fas fa-quote-left"></span>
                                <h4 class="t_content">“Extremely professional team with complete
                                    attention to detail. Their staff is very well
                                    trained and were very helpful and prompt.
                                    Thank you VendorsCity.”</h4>
                            </div>
                            <div class="thumb d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img class="wa" src="{{ asset('public/site/images/customer1.png') }}"
                                        alt="">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">Fatema Sheikh</h6>
                                    <!-- <p class="fz14 mb-0">Web Designer</p> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial-style1 default-box-shadow1 position-relative bdrs16 mb35">
                            <div class="testimonial-content">
                                <h4 class="title text-thm text_blue">Great Service</h4>
                                <span class="icon fas fa-quote-left"></span>
                                <h4 class="t_content">“Extremely professional team with complete
                                    attention to detail. Their staff is very well
                                    trained and were very helpful and prompt.
                                    Thank you VendorsCity.”</h4>
                            </div>
                            <div class="thumb d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img class="wa" src="{{ asset('public/site/images/customer1.png') }}"
                                        alt="">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">Devang Patel</h6>
                                    <!-- <p class="fz14 mb-0">Web Designer</p> -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Faq Area -->

@if ($faq != '' && count($faq) > 0)
    <section class="our-faq pb90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto wow fadeInUp" data-wow-delay="300ms">
                    <div class="main-title mb30">
                        <h2 class="title">Have Questions?<br>Get Answers.</h2>
                        <h4 class="title">Payments</h4>
                    </div>
                </div>
            </div>
            <div class="row wow fadeInUp" data-wow-delay="300ms">
                <div class="col-lg-12 mx-auto">
                    <div class="ui-content">
                        <div class="accordion-style1 faq-page mb-4 mb-lg-5">
                            <div class="accordion" id="accordionExample">
                                @php
                                    $i = 0;
                                @endphp

                                @foreach ($faq as $faq_data)
                                    <div class="accordion-item @php if($i == 0){echo 'active';} @endphp">
                                        <h2 class="accordion-header" id="headingOne_{{ $faq_data->id }}">
                                            <button
                                                class="accordion-button @php if($i != 0){echo 'collapsed';} @endphp"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne_{{ $faq_data->id }}"
                                                aria-expanded="true"
                                                aria-controls="collapseOne">{{ $faq_data->question }}</button>
                                        </h2>
                                        <div id="collapseOne_{{ $faq_data->id }}"
                                            class="accordion-collapse collapse @php if($i == 0){echo 'show';} @endphp"
                                            aria-labelledby="headingOne_{{ $faq_data->id }}"
                                            data-parent="#accordionExample">
                                            <div class="accordion-body">{!! html_entity_decode($faq_data->answer) !!}</div>
                                        </div>
                                    </div>

                                    @php
                                        $i++;
                                    @endphp
                                @endforeach

                                <!-- <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">How do I get access to a theme I purchased?</button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                      <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non at phasellus ultricies hendrerit. Eget a, sit morbi nunc sit id massa. Metus, scelerisque volutpat nec sit vel donec. Sagittis, id volutpat erat vel.</div>
                    </div>
                  </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mx-auto know_more_btn">
                    <a href="#" class="ud-btn btn-thm2">Know More</a>
                </div>
            </div>
        </div>
    </section>

@endif

<section class="our-about bgc-thm2 container pb0 pt0 mb30">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-xl-5 offset-xl-1">
                <div class="position-relative wow fadeInLeft" data-wow-delay="300ms">

                    <h2 class=" mb35">Register with us<br class="d-none d-lg-block">as a verified vendor
                    </h2>

                    <div class="list-style2 light-style">
                        <ul class="mb30">
                            <li><i class="far fa-check fa-check-custom"></i>Get qualified leads</li>
                            <li><i class="far fa-check fa-check-custom"></i>Reach out to direct customers</li>
                            <li><i class="far fa-check fa-check-custom"></i>Generate added revenue</li>
                            <li><i class="far fa-check fa-check-custom"></i>Help us take your business forward</li>
                        </ul>
                    </div>
                    <a href="#" class="ud-btn btn-thm">Register Now</a>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="position-relative mb30-lg">

                    <div class="about-img wow fadeInRight" data-wow-delay="300ms">
                        <img class="w100" src="{{ asset('public/site/images/regasvendor.png') }}" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="bgc-thm2 container pb0 pt0 mb30">
    <div class="container">
        <div class="row align-items-center custom_marquee">


            <marquee width="100%" direction="left">| 15,000+ Customers | <span class="flaticon-star custom_icon">
                </span>Rated 4.8 out of 5 | <span class="flaticon-call custom_icon"> </span>Live Customer Support |
                15,000+ Customers | <span class="flaticon-star custom_icon"> </span>Rated 4.8 out of 5 | <span
                    class="flaticon-call custom_icon"> </span>Live Customer Support | 15,000+ Customers | <span
                    class="flaticon-star custom_icon"> </span>Rated 4.8 out of 5 | <span
                    class="flaticon-call custom_icon"> </span>Live Customer Support | 15,000+ Customers | <span
                    class="flaticon-star custom_icon"> </span>Rated 4.8 out of 5 | <span
                    class="flaticon-call custom_icon"> </span>Live Customer Support | 15,000+ Customers | <span
                    class="flaticon-star custom_icon"> </span>Rated 4.8 out of 5 | <span
                    class="flaticon-call custom_icon"> </span>Live Customer Support | 15,000+ Customers | <span
                    class="flaticon-star custom_icon"> </span>Rated 4.8 out of 5 | <span
                    class="flaticon-call custom_icon"> </span>Live Customer Support |
            </marquee>

        </div>
    </div>
</section>

@include('front.includes.footer')
<script>
    function search_banner() {
        $('#search_banner').submit();
    }
</script>
