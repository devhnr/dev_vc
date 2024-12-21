@include('front.includes.header')
<style type="text/css">
.vendor_banner_sec h2{font-size: 50px;width: 80%;}
.vendor_banner_sec img{width: 60%;}
.vendor_banner_sec .about-img{text-align: center;}
</style>
<section class="our-about bgc-thm2 container pb0 pt0 mb30 mt50 vendor_banner_sec">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-xl-5 offset-xl-1">
                <div class="position-relative wow fadeInLeft" data-wow-delay="300ms">
                    <h2 class=" mb35">Get the best deals
                        from the best
                        vendors</h2>

                </div>
            </div>
            <div class="col-xl-6">
                <div class="position-relative mb30-lg">

                    <div class="about-img wow fadeInRight" data-wow-delay="300ms">
                        <img class="" src="{{ asset('public/site/images/regasvendor_new1-removebg-preview.png') }}" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Listings All Lists -->
<section class="pt30 pb90">
    <div class="container">
        <div class="row">

            
            <div class="col-lg-3">
                <form id="search_mini_form" name="search_mini_form" method="get">
                   
                <div class="list-sidebar-style1 d-none d-lg-block">
                    <div class="accordion" id="accordionExample">
                        <div class="card mb20 pb5">
                            <div class="card-header active" id="heading2">
                                <h4>
                                    <button class="btn btn-link ps-0" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse2" aria-expanded="true"
                                        aria-controls="collapse2">Services</button>
                                </h4>
                            </div>

                            @php
                                if ($services_ids != '') {
                                    $package_cat_array = explode(',', $services_ids);
                                } else {
                                    $package_cat_array = [];
                                }
                            @endphp

                            <div id="collapse2" class="collapse show" aria-labelledby="heading2"
                                data-parent="#accordionExample">
                                <div class="card-body card-body px-0 pt-0">
                                    @foreach ($services as $services_data)
                                            <div class="checkbox-style1">
                                                <div class="checkbox-style1 mb15">
                                                    <label class="custom_checkbox">{{ $services_data->servicename }}
                                                        <input type="checkbox" onclick="allfilter1()"
                                                            value="{{ $services_data->id }}" name="service_id[]"
                                                            @php if(in_array($services_data->id,$package_cat_array)){ echo "checked"; } @endphp>
                                                        <span class="checkmark"></span>

                                                    </label>
                                                </div>

                                            </div>
                                        @endforeach
                                    
                                </div>
                            </div>
                        </div>
                        @if(isset($cities) && count($cities) > 0)

                        @php
                            if ($city_ids != '') {
                                $city_array = explode(',', $city_ids);
                            } else {
                                $city_array = [];
                            }
                        @endphp

                        <div class="card mb20 pb5">
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

                                     @foreach ($cities as $cities_data)
                                        <div class="checkbox-style1">
                                                <div class="checkbox-style1 mb15">
                                                    <label class="custom_checkbox">{{ $cities_data->name }}
                                                        <input type="checkbox" onclick="allfilter1()"
                                                            value="{{ $cities_data->id }}" name="city_id[]"
                                                            @php if(in_array($cities_data->id,$city_array)){ echo "checked"; } @endphp>
                                                        <span class="checkmark"></span>

                                                    </label>
                                                </div>

                                            </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
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
            </form>
            </div>
            <div class="col-lg-9">
                <div class="row align-items-center mb20">
                    <div class="col-md-6">
                        <div class="text-center text-md-start">

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
                            <div class="pcs_dropdown dark-color pr10 text-center text-md-end"><span>Sort by</span>
                                <select class="selectpicker show-tick">
                                    <option>Best Selling</option>
                                    <option>Recommended</option>
                                    <option>New Arrivals</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    @php
                            //echo"<pre>";print_r($allvendor);echo"</pre>";
                        @endphp

                    @if ($allvendor != '' && count($allvendor) > 0)

                        @php
                            //echo"<pre>";print_r($allvendor);echo"</pre>";
                        @endphp

                        @foreach ($allvendor as $allvendor_data)
                            <div class="col-md-6 col-lg-12">
                                <div class="freelancer-style1 bdr1 hover-box-shadow row ms-0 align-items-lg-center">
                                    <div class="col-lg-8 ps-0">
                                        <div class="d-lg-flex bdrr1 bdrn-xl pr15 pr0-lg">
                                            <div class="thumb w60 position-relative rounded-circle mb15-md">
                                                @if ($allvendor_data->image != '')
                                                    <img class="rounded-circle mx-auto"
                                                        src="{{ asset('public/upload/vendors/small/' . $allvendor_data->image) }}"
                                                        alt="" width="60px">
                                                @else
                                                    <img class="rounded-circle mx-auto"
                                                        src="{{ asset('public/upload/avatar.jpg') }}"
                                                        alt="Profile Image" width="60px">
                                                @endif
                                                <span class="online-badge2"></span>
                                            </div>
                                            <div class="details ml15 ml0-md mb15-md">
                                                <h5 class="title mb-3">{{ $allvendor_data->name }}</h5>

                                                @if ($allvendor_data->city != '')
                                                    <p class="mb-0 fz14 list-inline-item mb5-sm pe-1"><i
                                                            class="flaticon-place fz16 vam text-thm2 me-1"></i>
                                                        {!! Helper::cityname($allvendor_data->city) !!}</p>
                                                @endif

                                                @if ($allvendor_data->short_description != '')
                                                    <p class="text mt10">{{ $allvendor_data->short_description }}</p>
                                                @endif

                                                <div
                                                    class="skill-tags d-flex align-items-center justify-content-start">
                                                    <span class="tag">Relocation</span>
                                                    <span class="tag mx10">Storage</span>
                                                    <span class="tag">Truck Services</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 ps-0 ps-xl-3 pe-0">

                                        <div class="d-grid mt15">
                                            <a href="#" class="ud-btn btn-thm2">Get free quote</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        No Vendor Available

                    @endif



                </div>
                {{-- {!! $allvendor->appends($_GET)->render('pagination::bootstrap-4') !!} --}}
            </div>

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

<section class="pb90 pb30-md pt90">
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
                            <div class="accordion-item active">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">What methods of payments are supported?</button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non at
                                        phasellus ultricies hendrerit. Eget a, sit morbi nunc sit id massa. Metus,
                                        scelerisque volutpat nec sit vel donec. Sagittis, id volutpat erat vel.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">Can I cancel at anytime?</button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non at
                                        phasellus ultricies hendrerit. Eget a, sit morbi nunc sit id massa. Metus,
                                        scelerisque volutpat nec sit vel donec. Sagittis, id volutpat erat vel.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">How do I get a receipt for
                                        my purchase?</button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non at
                                        phasellus ultricies hendrerit. Eget a, sit morbi nunc sit id massa. Metus,
                                        scelerisque volutpat nec sit vel donec. Sagittis, id volutpat erat vel.</div>
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
                                    <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non at
                                        phasellus ultricies hendrerit. Eget a, sit morbi nunc sit id massa. Metus,
                                        scelerisque volutpat nec sit vel donec. Sagittis, id volutpat erat vel.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                        aria-expanded="false" aria-controls="collapseFive">How do I get access to a
                                        theme I purchased?</button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse"
                                    aria-labelledby="headingFive" data-parent="#accordionExample">
                                    <div class="accordion-body">Cras vitae ac nunc orci. Purus amet tortor non at
                                        phasellus ultricies hendrerit. Eget a, sit morbi nunc sit id massa. Metus,
                                        scelerisque volutpat nec sit vel donec. Sagittis, id volutpat erat vel.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="our-about bgc-thm2 container pb0 pt0 mb30">
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
    function allfilter1() {
        //alert('test');
        document.search_mini_form.submit();
    }
    </script>
