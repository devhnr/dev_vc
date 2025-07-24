@include('front.includes.header')
<style>
.banner_sec{margin-left: 9%;}
.cta-service-v3{background-image: inherit;background-color: #eee;}

 .listing-style1{
        border:none !important; 
        margin-bottom: 15px !important;
    }
	
	.serviceimage_desktop{
        display: block;
    }
    .serviceimage_mobile {
        display: none;
    }
	
	.review-stars{
            justify-content: center;
        }
	.custom_splide.main-title{margin-bottom: 0px;} 
@media (max-width: 767px) {
    .google-button {
        font-size: 13px !important;
        padding: 5px 5px !important;
    }
    .google-text{
        font-size: 20px !important;
    }
    .googlereview p{
        font-size: 15px !important;
    }
	
	    .mobile-splide {
        padding: 10px !important;
    }
	
	.serviceimage_desktop{
            display: none !important;
        }
        .serviceimage_mobile{
            display: block !important;
        }
    .review-description{
        font-size: 12px !important;
        max-height: 9em !important;
        height: 120px !important;
    }
	
	.body_content {
        margin-top: 130px;
    }
}
    
.review-description {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    max-height: 11em; 
    height: 160px;
}
		
		
		

</style>
<section class="breadcumb-section pt-4 mt120">
  <div class="container">
  
      <div
          class="cta-service-v3 cta-banner mx-auto maxw1700 pt120 pb120 bdrs16 position-relative overflow-hidden d-flex align-items-center mx20-lg px30-lg">
         
        @if ($service_data->banner != '')
         <img class="service-v3-vector d-none d-lg-block" src="{{ asset('public/upload/service/banner/large/' . $service_data->banner) }}" alt=""></a>
          @else
           <img class="service-v3-vector d-none d-lg-block" src="{{ asset('public/upload/service/banner/large/Image_Available.jpg') }}" alt=""></a>
       @endif
  
              <div class="row wow fadeInUp">
                  <div class="col-xl-10 banner_sec">
                      <div class="position-relative">
                          <h2 class=" banner_title" >{{"$service_data->title"}}</h2>
                          <!-- <p class="text mb30 text-white">Give your visitor a smooth online experience with a solid UX design</p> -->
                          <div class="d-flex align-items-center">
  
                              <h6 class="mb-0">{{"$service_data->sub_title"}}
                              </h6>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>


<!-- Listings All Lists -->
<section class="pt30 pb10">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row align-items-center mb20">
                    <div class="col-md-6">
                        <div class="text-center text-md-start">
                            <p class="text mb-0 mb10-sm"><span class="fw500">{{ $subservice_count }}</span> services
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
                            <div class="pcs_dropdown dark-color pr10 text-center text-md-end"><span>Sort
                                    by</span>
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
				
				 @foreach ($subservice_data as $subservice)
                        <div class="col-sm-6 col-xl-3 col-6 col-lg-3">
                            <div class="listing-style1">

                                <div class="list-thumb bdrs12">
                                    @if ($subservice->image != '')
                                    <a
                                    href="{{ url('package-lists/' . $subservice->page_url) }}">
										<img 
                                                            src="{{ asset('public/upload/subservice/large/' . $subservice->image) }}"
                                                            alt="" class="serviceimage_desktop w-100" >
                                                        <img 
                                                            src="{{ asset('public/upload/subservice/medium/' . $subservice->image) }}"
                                                            alt="" class="serviceimage_mobile w-100">
											
											</a>
                                    @else
                                    <a
                                    href="{{ url('package-lists/' . $subservice->page_url) }}"> <img class="w-100"
                                            src="{{ asset('public/upload/service/large/Image_Available.jpg') }}"
                                            alt=""></a>
                                    @endif
                                    
                                </div>
                            </div>
                              <div class="list-content">
                                    <h5 class="list-title"><a
                                            href="{{ url('package-lists/' . $subservice->page_url) }}" style="font-weight:600;">{{ $subservice->subservicename }}
                                        </a></h5>
                                    @if ($subservice->sort_description != '')
                                        <div class="review-meta d-flex align-items-center">
                                            <p>{!! html_entity_decode($subservice->description) !!}</p>

                                        </div>
                                    @endif
                                </div>
                        </div>
				@endforeach 
                </div>
            </div>
        </div>
    </div>
</section>


    <div class="container">
        <div class="row align-items-center wow fadeInUp">
          <div class="col-lg-9">
            <div class="main-title">
              <h2 class="title">Read Our Verified Reviews</h2>
            </div>
          </div>
        </div>
        <div class="row wow fadeInUp" data-wow-delay="300ms">
          <div class="col-lg-12">
		  
		  <div id="review-slider" class="splide">
			  <div class="splide__track">
				<ul class="splide__list">
			@if(!empty($googleReview))
						 @foreach($googleReview as $googleReview_data)
				  <li class="splide__slide text-center" >
					<div class="freelancer-style1 text-center bdr1 bdrs16 hover-box-shadow review-card-fixed">
							  
							  <div class="details">
								@if($googleReview_data->name != '')
								<h5 class="title mb-1">{{$googleReview_data->name}}</h5>
								@endif
								
								<div class="review">
									 @if($googleReview_data->label != '')
									<div class="d-flex review-stars">
											@for ($i = 1; $i <= 5; $i++)
												@if ($i <= $googleReview_data->label)
													<i class="fas fa-star review-color"></i>
												@else
													<i class="far fa-star review-color ms-2"></i>
												@endif
											@endfor
										  </div>
									@endif 
								</div>
								
								<hr class="opacity-100 mt20 mb15">
								@if($googleReview_data->description != '')
                                @php
                                $shortDescription = Str::limit($googleReview_data->description, 150);
                                @endphp
                                    
                                <p class="review-description">“{{ $shortDescription }}”</p>
								@endif 
							  </div>
							</div>
				  </li>
			@endforeach
						  @endif

				  <!-- Add more slides as needed -->

				</ul>
			  </div>
			</div>
            
          </div>
        </div>
    </div>
 

      <div class="container pb10">
          <div class="googlereview ">
              <div class="row align-items-md-center">
                  <div class="col-lg-5 wow fadeInUp" data-wow-delay="300ms">
                      <h3 class="google-text">Curious about what sets apart?</h3>
                      <p>Explore our Google Reviews and discover why customers trust us with home service needs</p>
                  </div>
                  <div class="col-lg-3 col-6 wow fadeInUp" data-wow-delay="300ms">
                      <a style="width: 100%;" href="https://www.google.com/search?q=vendorscity+dubai&sca_esv=e472bba1732e8ddb&sca_upv=1&rlz=1C5CHFA_enAE1014AE1015&sxsrf=ADLYWIKMm77ohxWtSjtB2FywHuiQPICeBA%3A1716628559794&ei=T6xRZquOMNCVxc8Ph-eCsAo&ved=0ahUKEwjr8ZHcu6iGAxXQSvEDHYezAKYQ4dUDCBA&uact=5&oq=vendorscity+dubai&gs_lp=Egxnd3Mtd2l6LXNlcnAiEXZlbmRvcnNjaXR5IGR1YmFpMgQQIxgnMggQABgIGA0YHjIIEAAYCBgNGB4yCBAAGAgYDRgeMgsQABiABBiGAxiKBTILEAAYgAQYhgMYigUyCxAAGIAEGIYDGIoFMgsQABiABBiGAxiKBTIIEAAYgAQYogQyCBAAGIAEGKIESMAKUMoEWN8GcAF4AZABAJgB_wGgAcYDqgEFMC4xLjG4AQPIAQD4AQGYAgOgAtMDwgIKEAAYsAMY1gQYR8ICBxAAGIAEGA3CAggQABgFGA0YHsICChAAGAUYDRgeGA-YAwDiAwUSATEgQIgGAZAGCJIHBTEuMC4yoAeUEA&sclient=gws-wiz-serp#lrd=0x4c30ffdf4bf81567:0xaf176b54bfc73c00,1" target="_blank" class="ud-btn btn-thm google-button">Read More Reviews</a>
                  </div>
                  <div class="col-lg-4 col-6 wow fadeInUp" data-wow-delay="300ms" style="text-align: right;">
                      <img class="w100" src="{{ asset('public/site/images/googlereview.png') }}" alt="" style="max-width: 400px;">
                  </div>
              </div>
          </div>
      </div>
	@if(isset($faq) && count($faq) > 0)
    <section class="our-faq pb10">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto wow fadeInUp" data-wow-delay="300ms">
                <div class="main-title mb30">
                    <h2 class="title">Have Questions?<br>Get Answers.</h2>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section> 

@endif

@include('front.includes.footer')

 <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
        new Splide('#review-slider', {
            type: 'slide',
            perPage: 4,
            gap: '1rem',
            autoplay: false,
            interval: 3000,
            pagination: false,
            arrows: false,
            breakpoints: {
            768: {
               fixedWidth: '65%',   // Each slide takes 80% of container
                    focus: 0,            // Start slide aligned left
                    gap: '1rem',
                    arrows: false,
            },
            },
        }).mount();
        });

 document.querySelectorAll('.custom_splide.splide:not(#feature-slider)').forEach(function (splideElement) {

        splideElement.classList.add('custom-splide');
        const splideId = splideElement.id;

        const subserviceCount = parseInt(splideElement.getAttribute('data-subservice-count')) || 0;
        const showArrows = subserviceCount > 5;

        const splideInstance = new Splide('#' + splideId, {
            type: 'slide',
            perPage: 5,
            gap: '1rem',
            autoplay: false,
            interval: 3000,
            pagination: false,
            arrows: showArrows,
            breakpoints: {
                768: {
                    fixedWidth: '34%',   // Each slide takes 80% of container
                    focus: 0,            // Start slide aligned left
                    gap: '0.5rem',
                    arrows: false,
                    },
            },
        });

        splideInstance.mount();
        
       // Bind custom buttons using ID extracted from splideElement
        const prevButton = document.querySelector('.custom-prev-' + splideId.replace('splide_', ''));
        const nextButton = document.querySelector('.custom-next-' + splideId.replace('splide_', ''));

        if (prevButton && nextButton) {
            prevButton.addEventListener('click', () => splideInstance.go('<'));
            nextButton.addEventListener('click', () => splideInstance.go('>'));
        }
    });


</script>
