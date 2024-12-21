@include('front.includes.header')
<style type="text/css">
.our-faq {
    padding-top: 90px;
}
    .package_list_banner {
        background-image: inherit;
        background-color: #eee;
        padding-left: 30px;
    }

    .package_list_banner h2 {
        font-size: 50px;
        width: 56%;
        line-height: normal;
    }

    .vendor_banner_sec h2 {
        font-size: 50px;
        width: 80%;
    }

    /* .vendor_banner_sec img {
        width: 60%;
    } */

    .vendor_banner_sec .about-img {
        text-align: center;
    }

    .add-joining {
        font-size: 14px;
        padding: 5px 13px;
    }

    .listing-style1 .list-content {
        padding: 25px 20px;
        position: relative;
    }

    .ui-slider-range.ui-corner-all.ui-widget-header {
        background-color: #0040E6;
        height: 4px;
    }

    span.ui-slider-handle.ui-corner-all.ui-state-default {
        border: 2px solid #0040E6;

    }

    [dir] .placeholder.rect {
        padding-bottom: 66.6%;
    }

    [dir] .rounded {
        border-radius: 0.25rem !important;
    }

    [dir] .bg-primary {
        background-color: #01788e !important;
    }

    .placeholder {
        height: auto;
    }

    .placeholder {
        height: 0;
        width: 100%;
        opacity: 1;
    }

    #centerButton {
        position: absolute;
        top: 80%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
    }

    .bgc-thm2 {
        background-color: inherit;
    }

    .ticker-container {
        overflow: hidden;
        white-space: nowrap;
        width: 100%;
    }

    .ticker-items {
        display: inline-block;
        white-space: nowrap;
    }

    .ticker-item {
        display: inline-block;
        padding: 0 10px;
    }

    .bgc-thm22 {
        background-color: #eee;
        border-radius: 40px;
    }

    .mobile_img{display:none}

    @media only screen and (max-width: 600px) {
        img {
            max-width: 100%;
        }
        .mrgt0 {
            margin-top: 0 !important;
        }
        .mrgb0 {
            margin-bottom: 0 !important;
        }
        .ptm0 {
            padding-top: 0 !important;
        }
        .pbm0 {
            padding-bottom: 0 !important;
        }
        .we_do_heading {
            font-size: 50px;
        }
        .reviewListBox {
            height: auto;
            margin: 0 0 10px 0;
        }
        .mobile_img{display:block}
        .desktop_img{display:none}
    }

    #bannerBottom {
        position: absolute;
        bottom: 0;
        width: 100%;
        text-align: center;
        background-color: #0040E6;
        border-radius: 0 0 16px 16px;
        padding: 5px 0;
    }
    #bannerBottom p {
        margin: 0;
        color: #000;
        font-size: 15px;
    }
    .review-color {
        color: #f2c300;
        margin-right: 2px;
    }
    .we_cut_out_paragraph {
        line-height: 35px;
        border-left: 2px solid gray;
        padding-left: 25px;
    }
</style>
<!-- <section class="breadcumb-section pt-0 container">
    <div
        class="cta-service-v3 cta-banner mx-auto maxw1700 pt120 pb120 bdrs16 position-relative overflow-hidden d-flex align-items-center mx20-lg px30-lg package_list_banner">
        
        <img class="service-v3-vector d-none d-lg-block" src="{{ asset('public/site/images/package_listbanner.png') }}"
            alt="">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-xl-5">
                    <div class="position-relative">
                        <h2 class="">Explore the best deals on moving</h2>
                       
                        <div class="list-style2 light-style">
                        <ul class="mb30">
                            <li><i class="far fa-check fa-check-custom"></i>Use Code MoveitMoveit</li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

@php
    // echo '<pre>';
    // print_r($package_data[0]);
    // echo '</pre>';
    // exit();
@endphp

<section class="our-about bgc-thm2 container pb0 pt0 mb30 mt120 vendor_banner_sec mrgb0">
    <div class="container">
        <div class="row align-items-center">
            {{-- <div class="col-xl-5 offset-xl-1">
                <div class="position-relative wow fadeInLeft" data-wow-delay="300ms">
                    <h2 class=" mb35">Explore the best deals on moving</h2>

                </div>
                <div class="list-style2 light-style">
                    <ul class="mb30">
                        <li><i class="far fa-check fa-check-custom"></i>Use Code MoveitMoveit</li>
                    </ul>
                </div>
            </div> --}}
            <div class="col-xl-12">
                <div class="position-relative mb30-lg mrgb0">
                    <div class="about-img wow fadeInRight mb-3" data-wow-delay="300ms">
                        @if(isset($banner_subservices->banner_image))
                            <img style="width: 100%;" class="bdrs16 desktop_img"
                                src="{{ asset('public/upload/subservice/banner/large/' . $banner_subservices->banner_image) }}"
                                alt="">

                            <img style="width: 100%;" class="bdrs16 mobile_img"
                            src="{{ asset('public/upload/subservice/large/' . $banner_subservices->image) }}"
                            alt="">
                        @else

                             <img style="width: 100%;" class="bdrs16"
                                src="{{ asset('public/upload/subservice/banner/no_image_subservice.png') }}"
                                alt="">

                        @endif
                    </div>
                    {{-- @if (!empty($package_data) && isset($package_data[0])) --}}
                    <div id="centerButton"">
                        @if($banner_subservices->is_bookable == 1)
                        <a id="gets_button" style="margin-bottom: 50%;"
                            href="{{ route('enquiry', ['service_id' => $services_id, 'subservice_id' => $subservices_new->id]) }}"
                            class="ud-btn btn-thm2 add-joining">
                            Get Multiple Quotes
                        </a>
                        @else
                        <a id="gets_button" style="margin-bottom: 50%;"
                        href="{{ route('booknow', ['service_id' => $services_id, 'subservice_id' => $subservices_new->id]) }}"
                        class="ud-btn btn-thm2 add-joining">
                        Book Now
                    </a>
                        @endif
                    </div>
                    {{-- @endif --}}

                    <div id="bannerBottom">
                        <p style="color: #fff">Get <strong>5 Free Quotes</strong> from our <strong>Trusted Vendors</strong> @if($package_count > 0)or <strong>Choose a Package Below</strong> @endif</p>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

@isset($subservices_new->top_description)
    <section class="pt30 pb90 pbm0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    {{-- <h4>Description</h4> --}}
                    {!! html_entity_decode($subservices_new->top_description) !!}
                </div>
            </div>
        </div>
    </section>
@endisset


@if($package_count > 0)
<!-- Listings All Lists -->
<section class="pt30 pb90 pbm0">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="list-sidebar-style1 d-none d-lg-block">
                    <div class="accordion" id="accordionExample">

                        <div class="card mb20 pb5">
                            <div class="card-header active" id="heading2" data-bs-toggle="collapse"
                                data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                <h4>
                                    <button class="btn btn-link ps-0" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">Sub
                                        Service</button>
                                </h4>
                            </div>
                            <div id="collapse2" class="collapse show" aria-labelledby="heading2"
                                data-parent="#accordionExample">
                                <div class="card-body card-body px-0 pt-0">
                                    @foreach ($subservice_data as $subservices)
                                        <div class="checkbox-style1">
                                            <a href="{{ url('package-lists/' . $subservices->page_url) }}">
                                                <label class="custom_checkbox">{{ $subservices->subservicename }}
                                                </label>
                                            </a>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>


                        <form id="search_mini_form" name="search_mini_form" method="get">
                            @csrf
                            <input type="hidden" name="search" value="{{ $serach_var }}">

                            <div class="card mb20 pb5">
                                <div class="card-header active" id="heading2" data-bs-toggle="collapse"
                                    data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                    <h4>
                                        <button class="btn btn-link ps-0" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                            Packages Category</button>
                                    </h4>
                                </div>
                                <div id="collapse3" class="collapse show" aria-labelledby="heading2"
                                    data-parent="#accordionExample">
                                    <div class="card-body card-body px-0 pt-0">

                                        @php
                                            if ($package_cat_ids != '') {
                                                $package_cat_array = explode(',', $package_cat_ids);
                                            } else {
                                                $package_cat_array = [];
                                            }
                                        @endphp

                                        @foreach ($package_category as $package_catgory_data)
                                            <div class="checkbox-style1">
                                                <div class="checkbox-style1 mb15">
                                                    <label class="custom_checkbox">{{ $package_catgory_data->name }}
                                                        <input type="checkbox" onclick="allfilter1()"
                                                            value="{{ $package_catgory_data->id }}" name="package_cat[]"
                                                            @php if(in_array($package_catgory_data->id,$package_cat_array)){ echo "checked"; } @endphp>
                                                        <span class="checkmark"></span>

                                                    </label>
                                                </div>

                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            <div class="card mb20 pb0">
                                <div class="card-header active" id="heading1" data-bs-toggle="collapse"
                                    data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    <h4>
                                        <button class="btn btn-link ps-0" type="submit" data-bs-toggle="collapse"
                                            data-bs-target="#collapse1" aria-expanded="true"
                                            aria-controls="collapse1">Budget</button>
                                    </h4>
                                </div>

                                @php
                                    if (isset($_GET['filter_price_start'])) {
                                        $startPrice = $_GET['filter_price_start'];
                                    } else {
                                        $startPrice = '1';
                                    }

                                    if (isset($_GET['filter_price_end'])) {
                                        $endPrice = $_GET['filter_price_end'];
                                    } else {
                                        $endPrice = $max_price;
                                    }
                                @endphp

                                <div id="collapse1" class="collapse show" aria-labelledby="heading1"
                                    data-parent="#accordionExample">
                                    <div class="card-body card-body px-0 pt-0">
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range mb10 mt15">
                                                </div>
                                                <div class="text-center">
                                                    <input type="text" class="amount" id="amount"
                                                        placeholder="AED {{ $startPrice }}">
                                                    <span class="fa-sharp fa-solid fa-minus mx-2 dark-color"></span>
                                                    <input type="text" class="amount2" id="amount2"
                                                        placeholder="AED {{ $endPrice }}">


                                                    <input type="hidden" name="max_price" id="max_price"
                                                        value="{{ $max_price }}">
                                                    <input type="hidden" name="filter_price_start"
                                                        id="filter_price_start" value="{{ $filter_price_start }}">
                                                    <input type="hidden" name="filter_price_end"
                                                        id="filter_price_end" value="{{ $filter_price_end }}">
                                                    <input type="hidden" name="sort_by" id="sort_by">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- <div class="card mb20 pb5">
                            <div class="card-header active" id="heading2">
                                <h4>
                                    <button class="btn btn-link ps-0" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse2" aria-expanded="true"
                                        aria-controls="collapse2">Region</button>
                                </h4>
                            </div>
                            <div id="collapse2" class="collapse show" aria-labelledby="heading2"
                                data-parent="#accordionExample">
                                <div class="card-body card-body px-0 pt-0">
                                    <div class="checkbox-style1 mb15">
                                        <label class="custom_checkbox">Dubai
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                            
                                        </label>
                                    </div>
                                    <a class="text-thm" href="">+Show more</a>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="card mb20 pb5">
                  <div class="card-header active" id="heading3">
                    <h4>
                      <button class="btn btn-link ps-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">Location</button>
                    </h4>
                  </div>
                  <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordionExample">
                    <div class="card-body card-body px-0 pt-0">
                      <div class="search_area mb15">
                        <input type="text" class="form-control" placeholder="What are you looking for?">
                        <label><span class="flaticon-loupe"></span></label>
                      </div>
                      <div class="checkbox-style1 mb15">
                        <label class="custom_checkbox">United States
                          <input type="checkbox">
                          <span class="checkmark"></span>
                          <span class="right-tags">(1,945)</span>
                        </label>
                        <label class="custom_checkbox">United Kingdom
                          <input type="checkbox" checked="checked">
                          <span class="checkmark"></span>
                          <span class="right-tags">(8,136)</span>
                        </label>
                        <label class="custom_checkbox">Canada
                          <input type="checkbox">
                          <span class="checkmark"></span>
                          <span class="right-tags">(917)</span>
                        </label>
                        <label class="custom_checkbox">Germany
                          <input type="checkbox">
                          <span class="checkmark"></span>
                          <span class="right-tags">(240)</span>
                        </label>
                        <label class="custom_checkbox">Turkey
                          <input type="checkbox">
                          <span class="checkmark"></span>
                          <span class="right-tags">((2,460)</span>
                        </label>
                      </div>
                      <a class="text-thm" href="">+20 more</a>
                    </div>
                  </div>
                </div>
                <div class="card mb20 pb5">
                  <div class="card-header active" id="heading4">
                    <h4>
                      <button class="btn btn-link ps-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4">Speaks</button>
                    </h4>
                  </div>
                  <div id="collapse4" class="collapse show" aria-labelledby="heading4" data-parent="#accordionExample">
                    <div class="card-body card-body px-0 pt-0">
                      <div class="checkbox-style1 mb15">
                        <label class="custom_checkbox">Turkish
                          <input type="checkbox">
                          <span class="checkmark"></span>
                          <span class="right-tags">(1,945)</span>
                        </label>
                        <label class="custom_checkbox">English
                          <input type="checkbox" checked="checked">
                          <span class="checkmark"></span>
                          <span class="right-tags">(8,136)</span>
                        </label>
                        <label class="custom_checkbox">Italian
                          <input type="checkbox">
                          <span class="checkmark"></span>
                          <span class="right-tags">(917)</span>
                        </label>
                        <label class="custom_checkbox">Spanish
                          <input type="checkbox">
                          <span class="checkmark"></span>
                          <span class="right-tags">(240)</span>
                        </label>
                      </div>
                      <a class="text-thm" href="">+20 more</a>
                    </div>
                  </div>
                </div> -->
                        <!--  <div class="card mb20 pb0">
                  <div class="card-header active" id="heading5">
                    <h4>
                      <button class="btn btn-link ps-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapse5">Level</button>
                    </h4>
                  </div>
                  <div id="collapse5" class="collapse show" aria-labelledby="heading5" data-parent="#accordionExample">
                    <div class="card-body card-body px-0 pt-0">
                      <div class="checkbox-style1">
                        <label class="custom_checkbox">Top Rated Seller
                          <input type="checkbox">
                          <span class="checkmark"></span>
                          <span class="right-tags">(1,945)</span>
                        </label>
                        <label class="custom_checkbox">Level Two
                          <input type="checkbox" checked="checked">
                          <span class="checkmark"></span>
                          <span class="right-tags">(8,136)</span>
                        </label>
                        <label class="custom_checkbox">Level One
                          <input type="checkbox">
                          <span class="checkmark"></span>
                          <span class="right-tags">(917)</span>
                        </label>
                        <label class="custom_checkbox">New Seller
                          <input type="checkbox">
                          <span class="checkmark"></span>
                          <span class="right-tags">(240)</span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row align-items-center mb20">
                    <div class="col-md-6">
                        <div class="text-center text-md-start">
                            <p class="text mb-0 mb10-sm"><span class="fw500">{{ $package_count }}</span>
                                services
                                available</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div
                            class="page_control_shorting d-md-flex align-items-center justify-content-center justify-content-md-end">
                            <div class="dropdown-lists d-block d-lg-none me-2 mb10-sm">
                                <ul class="p-0 mb-0 text-center text-md-start">
                                    <li>
                                        <!-- Advance Features modal trigger -->
                                        <button type="button" class="open-btn filter-btn-left"> <img class="me-2"
                                                src="{{ asset('public/site/images/icon/all-filter-icon.svg') }}"
                                                alt=""> All Filter</button>
                                    </li>
                                </ul>
                            </div>
                            {{-- <div class="pcs_dropdown dark-color pr10 text-center text-md-end"><span>Sort by</span>
                                <select class="selectpicker show-tick">
                                    <option>Best Selling</option>
                                    <option>Recommended</option>
                                    <option>New Arrivals</option>
                                </select>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- @php
                        echo '<pre>';
                        print_r($package_data);
                        echo '</pre>';
                    @endphp --}}

                    @if ($package_data != '' && count($package_data) > 0)

                        @foreach ($package_data as $package_data_new)
                            @php

                                $service = DB::table('services')
                                    ->where('id', $package_data_new->service_id)
                                    ->first();

                                $service_city =explode(',',$service->city);
                                   
                        // echo '<pre>';
                        // print_r($service_city);
                        // echo '</pre>';

                                $subservice = DB::table('subservices')
                                    ->where('id', $package_data_new->subservice_id)
                                    ->first();

                                

                            @endphp

                            @if(in_array(session('search_city_id'),$service_city))
                            <div class="col-sm-6 col-xl-4">
                                <div class="listing-style1">
                                    {{-- <div class="list-thumb">
                                        @if ($package_data_new->image)
                                            <a href="{{ url('package-detail/' . $package_data_new->page_url) }}">
                                                <img class="w-100"
                                                    src="{{ asset('public/upload/packages/large/' . $package_data_new->image) }}"
                                                    alt="">
                                            </a>
                                        @endif
                                        <a href="" class="listing-fav fz12"><span
                                                class="far fa-heart"></span></a>
                                    </div> --}}
                                    <div class="list-content">
                                        <h5 class="list-title" style="text-align: center">
                                            <a href="{{ url('package-detail/' . $package_data_new->page_url) }}">
                                                <span
                                                    style="font-size: 30px;font-family: 'SF Pro Rounded';font-size;">{{ $package_data_new->title }}</span><br>
                                                <span
                                                    style="font-size:20px;">{{ $package_data_new->sub_title }}</span>

                                            </a>
                                        </h5>

                                        @if ($package_data_new->short_description)
                                            <div class="review-meta d-flex align-items-center">
                                                <p>{{ $package_data_new->short_description }}</p>
                                            </div>
                                        @endif
                                        <hr class="my-2">
                                        @php
                                            $disc_price = $package_data_new->price; // Set a default value

                                            if ($package_data_new->discount_type != '') {
                                                if ($package_data_new->discount_type == 0) {
                                                    $disc_price_new =
                                                        ($package_data_new->price * $package_data_new->discount) / 100;
                                                    $disc_price = $package_data_new->price - $disc_price_new;
                                                } elseif ($package_data_new->discount_type == 1) {
                                                    $disc_price =
                                                        $package_data_new->price - $package_data_new->discount;
                                                } else {
                                                    $package_data_new->price;
                                                }
                                            } else {
                                                $package_data_new->price;
                                            }
                                        @endphp
                                        <div class="list-meta justify-content-between align-items-center mt15">
                                            {{-- <a href="{{ url('package-detail/' . $package_data_new->page_url) }}">
                                                @if ($package_data_new->discount_type != '2')
                                                    <span class="fz18">AED {{ $disc_price }}
                                                        <del class="fz15">{{ $package_data_new->price }}</del>
                                                        @if ($package_data_new->discount != '')
                                                            <span class="fz15"
                                                                style="color:red;">{{ $package_data_new->discount }}%
                                                                OFF</span>
                                                        @endif
                                                    </span>
                                                @else
                                                    <span class="fz18">AED {{ $package_data_new->price }}</span>
                                                @endif

                                            </a> --}}
                                            @php

                                                $inclusions_packages = DB::table('packages_incluser')
                                                    ->where('pid', $package_data_new->id)
                                                    ->get();

                                                $exclusions_packages = DB::table('packages_excluser')
                                                    ->where('pid', $package_data_new->id)
                                                    ->get();

                                            @endphp
                                            @if (isset($inclusions_packages) && count($inclusions_packages) > 0)
                                                <div class="list-style1 mb-5">

                                                    <h4>Inclusions</h4>

                                                    <ul class="">
                                                        @foreach ($inclusions_packages as $inclusions_packages_data)
                                                            <li class="mb15"><i
                                                                    class="far fa-check text-thm3 bgc-thm3-light fa-check-custom"></i>{{ $inclusions_packages_data->incluser_name }}
                                                            </li>
                                                        @endforeach

                                                    </ul>

                                                </div>
                                            @endif

                                            @if (isset($exclusions_packages) && count($exclusions_packages) > 0)
                                                <div class="list-style1">

                                                    <h4>Exclusions</h4>

                                                    <ul class="">
                                                        @foreach ($exclusions_packages as $exclusions_packages_data)
                                                            <li class="mb15"><i
                                                                    class="far fa-times text-thm3 bgc-thm3-light fa-check-custom"
                                                                    style="background: red"></i>{{ $exclusions_packages_data->excluser_name }}
                                                            </li>
                                                        @endforeach

                                                    </ul>

                                                </div>
                                            @endif

                                            <div class="budget pricebtn"
                                                style="background-color: #0040E6;text-align: center;">
                                                {{-- //@if (in_array('0', explode(',', $subservice->is_bookable))) --}}
                                                    <a class="ud-btn btn-thm add-joining addtocart-btn_{{ $package_data_new->id }}"
                                                        href="{{ route('cart') }}"
                                                        onclick="add_to_cart('{{ $package_data_new->id }}'); return false;">
                                                        @if ($package_data_new->discount_type != '2')
                                                            <span style="display: flex;">{{ $disc_price }} <span
                                                                    style="font-size: 14px">&nbsp; AED &nbsp;</span>
                                                                <del class="fz15">{{ $package_data_new->price }}
                                                                </del> <span style="font-size: 14px">&nbsp; AED
                                                                    &nbsp;</span>
                                                                @if ($package_data_new->discount != '')
                                                                    <span class="fz15" style="display: flex;"
                                                                        style="color:white;">{{ $package_data_new->discount }}%
                                                                        OFF</span>
                                                                @endif
                                                            </span>
                                                        @else
                                                            <span style="display: flex;">
                                                                {{ $package_data_new->price }} <span
                                                                    style="font-size: 14px">&nbsp;AED</span></span>
                                                        @endif
                                                    </a>

                                                    <a class="ud-btn btn-thm add-joining loader-test_{{ $package_data_new->id }}"
                                                        href="javascript:void(0);" style="display: none;">
                                                        Please Wait...
                                                    </a>
                                                {{-- @endif --}}

                                                {{-- @if (in_array('1', explode(',', $subservice->is_bookable)))
                                                    <a class="ud-btn btn-thm add-joining"
                                                        href="{{ route('enquiry', ['id' => $package_data_new->id, 'service_id' => 0]) }}">Get
                                                        Multiple Quote</a>
                                                @endif --}}

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @else
                        No Package Available

                    @endif


                </div>
                {{-- {!! $package_pagination->appends($_GET)->render('pagination::bootstrap-4') !!} --}}
                <!--  <div class="row">
              <div class="mbp_pagination mt30 text-center">
                <ul class="page_navigation">
                  <li class="page-item">
                    <a class="page-link" href="#"> <span class="fas fa-angle-left"></span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">4</a></li>
                  <li class="page-item d-inline-block d-sm-none"><a class="page-link" href="#">...</a></li>
                  <li class="page-item"><a class="page-link" href="#">5</a></li>
                  <li class="page-item d-none d-sm-inline-block"><a class="page-link" href="#">...</a></li>
                  <li class="page-item d-none d-sm-inline-block"><a class="page-link" href="#">20</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#"><span class="fas fa-angle-right"></span></a>
                  </li>
                </ul>
                <p class="mt10 mb-0 pagination_page_count text-center">1 – 20 of 300+ property available</p>
              </div>
            </div> -->
            </div>
        </div>
    </div>
</section>
@endif
<section class="pb90 pb30-md pt10 ptm0">
    <div class="container">
        <div class="row align-items-center wow fadeInUp" data-wow-delay="00ms">
            <div class="col-lg-6">
                <div class="main-title2">
                    <h2 class="title we_do_heading">Most Popular Services
                    </h2>

                </div>
            </div>
            <div class="col-lg-6">

                <p class="paragraph we_cut_out_paragraph">Get your weekend back, we've got your to-do list
                    covered. Hire our top rated verified vendors for the best
                    in class stress free service and top class prices
                </p>

            </div>
        </div>



        @php
            // $test = DB::table('services')->where('id', $services_id)->get();
            //$services = DB::table('services')->where('id', '!=', $services_id)->where('is_active', 0)->get();
            $services = DB::table('subservices')->where('id', '!=', $banner_subservices->id)->where('serviceid', $banner_subservices->serviceid)->get();
            // echo '<pre>';
            // print_r($services);
            // echo '</pre>';
            // exit();
        @endphp


        <div class="tab-content ha" id="pills-tabContent">
            <div class="tab-pane fade fz15 text show active" id="pills-home" role="tabpanel"
                aria-labelledby="pills-home-tab">
                <div class="navi_pagi_bottom_center slider-4-grid owl-carousel owl-theme">
                    @foreach ($services as $services_data)
                        <div class="item">
                            <div class="listing-style1">
                                <div class="list-thumb">
                                    <a href="{{ url('package-lists/' . $services_data->page_url) }}">
                                        @if (isset($services_data->image) && $services_data->image != '')
                                            <img class="w-100"
                                                src="{{ asset('public/upload/subservice/large/' . $services_data->image) }}"
                                                alt="">
                                        @else
                                            <img class="w-100"
                                                src="{{ asset('public/upload/subservice/large/1715859524No_Image_Available.jpg') }}"
                                                alt="">
                                        @endif
                                    </a>
                                    {{-- <a href="" class="listing-fav fz12"><span class="far fa-heart"></span></a> --}}
                                </div>
                                <div class="list-content"
                                    style="padding: 35px 15px 20px 15px; background:#eee; !important">

                                    {{-- <div class="review-meta d-flex align-items-center">
                                        <i class="fas fa-star fz10 review-color"></i>
                                        <i class="fas fa-star fz10 review-color"></i>
                                        <i class="fas fa-star fz10 review-color"></i>
                                        <i class="fas fa-star fz10 review-color"></i>

                                    </div> --}}

                                    <div class="list-meta d-flex justify-content-between align-items-center">
                                        <a class="d-flex" href="{{ url('package-lists/' . $services_data->page_url) }}">
                                            <span class="fz14"
                                                style="font-size: 20px;!important">{{ $services_data->subservicename }}</span>
                                        </a>
                                        <div class="budget">
                                            <i class="far fa-arrow-right-long"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>

</section>

@isset($subservices_new->description)
    <section class="pt30 pb10 pbm0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    {{-- <h4>Description</h4> --}}
                    {!! html_entity_decode($subservices_new->description) !!}
                </div>
            </div>
        </div>
    </section>
@endisset

@php
    $package_attr = DB::table('subservice_attr')
        ->where('pid', $subservices_new->id)
        ->get();

@endphp
@isset($package_attr)

    <section class="pb10 pb30-md pt10 ptm0">
        <div class="container">
            <div class="row mb-5 align-items-center mrgb0">
                @foreach ($package_attr as $index => $package_attribut)
                    @if ($index % 2 == 1)
                        <div class="col-12 col-md-6 px-5 px-md-0 pr-md-0 stack-bottom stack-adjust--right">
                            <div class="rounded p-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="mb-4 font-weight-bold">
                                            {{ $package_attribut->title_addmore }}</h3>
                                    </div>
                                    <div class="col-12">{!! html_entity_decode($package_attribut->description_addmore) !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-5 col-md-6 pl-md-0 stack-top stack-adjust--left mrgb0">
                            <div class="placeholder rect bg-primary rounded b-lazy b-loaded"
                                style="background: url('{{ asset('public/upload/subservice/subservice_attr/large/' . $package_attribut->image) }}'); background-size: cover; width: 100%; height: 300px;">
                            </div>
                            
                        </div>
                    @else
                        <!-- Reverse the order for odd indices -->
                        <div class="col-12 mb-5 col-md-6 pl-md-0 stack-top stack-adjust--left">
                            <div class="placeholder rect bg-primary rounded b-lazy b-loaded"
                                style="background: url('{{ asset('public/upload/subservice/subservice_attr/large/' . $package_attribut->image) }}'); background-size: cover; width: 100%; height: 300px;">
                            </div>
                        </div>

                        <div
                            class="col-12 
                col-md-6 px-5 px-md-0 pr-md-0 stack-bottom stack-adjust--right">
                            <div class="rounded p-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="mb-4 font-weight-bold">
                                            {{ $package_attribut->title_addmore }}</h3>
                                    </div>
                                    <div class="col-12">{!! html_entity_decode($package_attribut->description_addmore) !!}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </section>
@endisset

<section class="pb90 pb30-md pt10 ptm0">
    <div class="container">
        <div class="row align-items-md-center">
							<div class="col-sm-12 col-xl-3 text-center">
                                <img src="{{ asset('public/site/images/Select_your_Service.png') }}" alt="" style="width: 65%;">
                                <h3 style="margin-top: 15px;">Why VendorsCity?</h3>
                                <p style="padding: 0 32px;">Positioned as a leading home and commercial services marketplace, VendorsCity takes the lead in streamlining your diverse service requirements. Here's why opting for our services stands out.</p>
                            </div>
                            <div class="col-sm-12 col-xl-3 text-center">
                                <img src="{{ asset('public/site/images/Sit_back_and_relax.png') }}" alt="" style="width: 65%;">
                                <h3 style="margin-top: 15px;">Top-notch Professionals</h3>
                                <p style="padding: 0 28px;">Connect with industry-leading professionals through VendorsCity. Prioritizing excellence, we ensure our partners deliver exceptional quality for your utmost satisfaction.</p>
                            </div>
                            <div class="col-sm-12 col-xl-3 text-center">
                                <img src="{{ asset('public/site/images/about/ease_of_booking.png') }}" alt="" style="width: 65%;">
                                <h3 style="margin-top: 15px;">Consistent Excellence</h3>
                                <p style="padding: 0 32px;">Quality is our standard at VendorsCity. Through rigorous measurement and management, we maintain unparalleled service quality, consistently exceeding expectations.</p>
                            </div>
							<div class="col-sm-12 col-xl-3 text-center">
                                <img src="{{ asset('public/site/images/about/customer_support.png') }}" alt="" style="width: 65%;">
                                <h3 style="margin-top: 15px;">Customer-Focused</h3>
                                <p style="padding: 0 32px;">Customer service is a priority at VendorsCity. With a seven-day operating contact center, we take your concerns seriously, providing reliable support whenever you need it.</p>
                            </div>
        </div>
    </div>
</section>

<!--<section class="pb90 pb30-md pt10 ptm0">
    <div class="container">
        <div class="row align-items-md-center">
            <div class="col-md-6 col-lg-12 mb30-md wow fadeInUp" data-wow-delay="100ms">
                <h3>Why VendorsCity?</h3>
                <p>
Positioned as a leading home and commercial services marketplace, VendorsCity takes the lead in streamlining your diverse service requirements. Here's why opting for our services stands out:</p>

<h3>Top-notch Professionals: </h3>
<p>Connect with industry-leading professionals through VendorsCity. Prioritizing excellence, we ensure our partners deliver exceptional quality for your utmost satisfaction.</p>

<h3>Consistent Excellence:</h3><p> Quality is our standard at VendorsCity. Through rigorous measurement and management, we maintain unparalleled service quality, consistently exceeding expectations.</p>

<h3>Customer-Focused: </h3> <p> Customer service is a priority at VendorsCity. With a seven-day operating contact center, we take your concerns seriously, providing reliable support whenever you need it.</p>
            </div>
        </div>
    </div>
</section>-->


<section class="pt10 mt-30 pb-0">
    <div class="container">
        <div class="row wow fadeInUp" data-wow-delay="00ms">
            <div class="col-lg-6">
                <div class="main-title2">
                    <h2 class="title we_do_heading">Hear what Our Clients Have to say About Us</h2>

                </div>
            </div>
            <div class="col-lg-6">

                <p class="paragraph we_cut_out_paragraph">Step into a world of satisfaction and trust as you explore stories and positive experiences ahared by our delighted customers.Discover firsthand the joy and reliability that defines our services!
                </p>

            </div>
        </div>

    </div>
</section>

<section class="bgc-thm3" style="display: none;">
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
                                        <div class="timer">4.7</div>
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
                                        <div class="timer">300</div>
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
                

                    @if(!empty($googleReview))
                <div class="testimonial-slider2 mb15 navi_pagi_bottom_center slider-1-grid owl-carousel owl-theme wow fadeInUp"
                    data-wow-delay="300ms">
                    @foreach($googleReview as $googleReview_data)
                    <div class="item">
                        <div class="testimonial-style1 default-box-shadow1 position-relative bdrs16 mb35">
                            <div class="testimonial-content">
                                @if($googleReview_data->label != '')
                                    <h4 class="title text-thm text_blue">{{$googleReview_data->label}}</h4>
                                @endif 
                                <span class="icon fas fa-quote-left"></span>
                                @if($googleReview_data->description != '')
                                <h4 class="t_content">“{{$googleReview_data->description}}”</h4>
                                     @endif 
                            </div>
                            <div class="thumb d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('public/site/images/profileimage.png') }}"
                                    alt="" style="width: 75px !important;">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    @if($googleReview_data->name != '')
                                    <h6 class="mb-0">{{$googleReview_data->name}}</h6>
                                    @endif 
                                    <!-- <p class="fz14 mb-0">Web Designer</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                   <!--  <div class="item">
                        <div class="testimonial-style1 default-box-shadow1 position-relative bdrs16 mb35">
                            <div class="testimonial-content">
                                <h4 class="title text-thm text_blue">Good Service</h4>
                                <span class="icon fas fa-quote-left"></span>
                                <h4 class="t_content">“Very friendly staff, i got few big boxes, and 10 small boxea and
                                    some moving-needed stuff.
                                    I tell you it is reliable to conyltain your home stuff while moving homes.
                                    Highly recommended. And one more thing... It is half the price of the box from
                                    Amazon”</h4>
                            </div>
                            <div class="thumb d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('public/site/images/profileimage.png') }}" alt=""
                                        style="width: 75px !important;">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">Ali Boshra</h6>
                                   
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial-style1 default-box-shadow1 position-relative bdrs16 mb35">
                            <div class="testimonial-content">
                                <h4 class="title text-thm text_blue">Great Service</h4>
                                <span class="icon fas fa-quote-left"></span>
                                <h4 class="t_content">“Really good service! Very importantly they came on time, they
                                    did their job quickly and cleaned up after. Highly recommend this company.”</h4>
                            </div>
                            <div class="thumb d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('public/site/images/profileimage.png') }}" alt=""
                                        style="width: 75px !important;">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">Anna B</h6>
                                   
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial-style1 default-box-shadow1 position-relative bdrs16 mb35">
                            <div class="testimonial-content">
                                <h4 class="title text-thm text_blue">Professional Service</h4>
                                <span class="icon fas fa-quote-left"></span>
                                <h4 class="t_content">“Professional and friendly team moved all our goods and helped us
                                    with a few other odds and ends around the house - highly recommended”</h4>
                            </div>
                            <div class="thumb d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('public/site/images/profileimage.png') }}" alt=""
                                        style="width: 75px !important;">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">Tim Jaja</h6>
                                   
                                </div>
                            </div>
                        </div>
                    </div> -->



                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<div class="container wow fadeInUp" data-wow-delay="300ms">
    <div class="reviewList">
        <div class="row align-items-md-center">
            <div class="col-lg-12">
                <h2>Read Our Verified Reviews</h2>
            </div>
        </div>
        <div class="row" style="margin:0; ">
            @if(!empty($googleReview))
                @foreach($googleReview as $googleReview_data)
                <div class="col-lg-3">
                    <div class="reviewListBox">

                        @if($googleReview_data->name != '')
                        <h5 class="mb-0">{{$googleReview_data->name}}</h5>
                        @endif 

                        @if($googleReview_data->label != '')
                        <div class="d-flex">
                               @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $googleReview_data->label)
                                        <i class="fas fa-star review-color"></i>
                                    @else
                                        <i class="far fa-star review-color ms-2"></i>
                                    @endif
                                @endfor
                              </div>
                            
                        @endif 
                        @if($googleReview_data->description != '')
                            <p>“{{$googleReview_data->description}}”</p>
                        @endif 
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>


<div class="container">
    <div class="googlereview">
        <div class="row align-items-md-center">
            <div class="col-lg-5 wow fadeInUp" data-wow-delay="300ms">
                <h3>Curiouos about what sets apart?</h3>
                <p>Explore our Google Reviews and discover why customers trust us with home service needs</p>
            </div>
            <div class="col-lg-3 wow fadeInUp" data-wow-delay="300ms">
                <a style="width: 100%;" href="https://www.google.com/search?q=vendorscity+dubai&sca_esv=e472bba1732e8ddb&sca_upv=1&rlz=1C5CHFA_enAE1014AE1015&sxsrf=ADLYWIKMm77ohxWtSjtB2FywHuiQPICeBA%3A1716628559794&ei=T6xRZquOMNCVxc8Ph-eCsAo&ved=0ahUKEwjr8ZHcu6iGAxXQSvEDHYezAKYQ4dUDCBA&uact=5&oq=vendorscity+dubai&gs_lp=Egxnd3Mtd2l6LXNlcnAiEXZlbmRvcnNjaXR5IGR1YmFpMgQQIxgnMggQABgIGA0YHjIIEAAYCBgNGB4yCBAAGAgYDRgeMgsQABiABBiGAxiKBTILEAAYgAQYhgMYigUyCxAAGIAEGIYDGIoFMgsQABiABBiGAxiKBTIIEAAYgAQYogQyCBAAGIAEGKIESMAKUMoEWN8GcAF4AZABAJgB_wGgAcYDqgEFMC4xLjG4AQPIAQD4AQGYAgOgAtMDwgIKEAAYsAMY1gQYR8ICBxAAGIAEGA3CAggQABgFGA0YHsICChAAGAUYDRgeGA-YAwDiAwUSATEgQIgGAZAGCJIHBTEuMC4yoAeUEA&sclient=gws-wiz-serp#lrd=0x4c30ffdf4bf81567:0xaf176b54bfc73c00,1" target="_blank" class="ud-btn btn-thm">Read More Reviews</a>
            </div>
            <div class="col-lg-4 wow fadeInUp" data-wow-delay="300ms" style="text-align: right;">
                <img class="w100" src="{{ asset('public/site/images/googlereview.png') }}" alt="" style="max-width: 400px;">
            </div>
        </div>
    </div>
</div>

@if(!empty($faq))
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

                            <!-- <div class="accordion-item active">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">What methods of payments are
                                        supported?</button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non
                                        at
                                        phasellus ultricies hendrerit. Eget a, sit morbi nunc sit id massa.
                                        Metus,
                                        scelerisque volutpat nec sit vel donec. Sagittis, id volutpat erat vel.
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">Can I cancel at
                                        anytime?</button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non
                                        at
                                        phasellus ultricies hendrerit. Eget a, sit morbi nunc sit id massa.
                                        Metus,
                                        scelerisque volutpat nec sit vel donec. Sagittis, id volutpat erat vel.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">How do I get a
                                        receipt for
                                        my purchase?</button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non
                                        at
                                        phasellus ultricies hendrerit. Eget a, sit morbi nunc sit id massa.
                                        Metus,
                                        scelerisque volutpat nec sit vel donec. Sagittis, id volutpat erat vel.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">Which license do I
                                        need?</button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="headingFour" data-parent="#accordionExample">
                                    <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non
                                        at
                                        phasellus ultricies hendrerit. Eget a, sit morbi nunc sit id massa.
                                        Metus,
                                        scelerisque volutpat nec sit vel donec. Sagittis, id volutpat erat vel.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                        aria-expanded="false" aria-controls="collapseFive">How do I get access
                                        to a
                                        theme I purchased?</button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse"
                                    aria-labelledby="headingFive" data-parent="#accordionExample">
                                    <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non
                                        at
                                        phasellus ultricies hendrerit. Eget a, sit morbi nunc sit id massa.
                                        Metus,
                                        scelerisque volutpat nec sit vel donec. Sagittis, id volutpat erat vel.
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endif

<section class="our-about bgc-thm2 bgc-thm22 container pb0 pt0 mb30 mt30">
    <div class="container">
        <div class="row align-items-center custom_marquee">


            {{-- <marquee width="100%" direction="left">| 15,000+ Customers | <span class="flaticon-star custom_icon">
                </span>Rated 4.8 out of 5 | <span class="flaticon-call custom_icon"> </span>Live Customer
                Support |
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
            </marquee> --}}

            <div class="ticker-container">
                <div class="ticker-items">
                    <div class="ticker-item"><span class="fa-regular fa-message-pen custom_icon"></span> Up to 5 Free Quotes </div>
                    <div class="ticker-item"><span class="fa-regular fa-phone custom_icon"></span> Live Customer Support</div>
                    <div class="ticker-item"><span class="fa-regular fa-user custom_icon"></span>Trusted Vendors </div>
                    <!-- Add more items as needed -->
                </div>
            </div>

        </div>
    </div>
</section>
@include('front.includes.footer')

<script>
    $(".slider-range").on("slide", function(event, ui) {
        var lowAmount = $("#amount").val();
        var highAmount = $("#amount2").val();
        var max_price = $("#max_price").val();

        $("#filter_price_start").val(lowAmount);
        $("#filter_price_end").val(highAmount);
        $("#max_price").val(max_price);

        // $("#categoryFilter").submit();
        document.search_mini_form.submit();
    });

    function allfilter1() {
        //alert('test');
        document.search_mini_form.submit();
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.0/gsap.min.js"></script>
<script>
    const tickerContainer = document.querySelector('.ticker-container');
    const tickerItems = document.querySelector('.ticker-items');
    const items = document.querySelectorAll('.ticker-item');

    // Calculate the width of all items combined
    let itemsWidth = 0;
    items.forEach(item => {
        itemsWidth += item.offsetWidth;
    });

    // Clone items to fill the container at least twice
    while (tickerItems.offsetWidth < tickerContainer.offsetWidth * 2) {
        items.forEach(item => {
            const clone = item.cloneNode(true);
            tickerItems.appendChild(clone);
        });
    }

    // Set up GSAP animation
    gsap.to(tickerItems, {
        duration: 5, // Adjust duration as needed
        x: -itemsWidth,
        ease: 'none',
        repeat: -1
    });
</script>
