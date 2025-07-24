                            <!-- Our Footer -->
<section class="footer-style1 at-home5 pt25 pb-0" style="background-color: #222222;">
   
    {{-- <div class="web_whatsapp">
        <a href="https://web.whatsapp.com/send?phone=9710568363677" target="_blank"><i class="fab fa-whatsapp"></i></a>
    </div> --}}
    <div class="web_whatsapp">
        <a href="" id="whatsappButton" target="_blank"><i class="fab fa-whatsapp"></i></a>
    </div>

    <style>
        .footer-logo{
            width: 30% !important;
        }
        @media only screen and (max-width: 768px) {
            .footer-logo{
            width: 67% !important;
            }
        }
    </style>

    <div class="container">
        <!--<div class="row bdrb1 pb10 mb60">
            <div class="col-md-7">
                <div
                    class="d-block text-center text-md-start justify-content-center justify-content-md-start d-md-flex align-items-center mb-3 mb-md-0">
                    <a class="fz17 fw500 mr15-md mr30" href="{{ route('term_condition') }}" style="color: #fff;">Terms of Service</a>
                    <a class="fz17 fw500 mr15-md mr30" href="{{ route('privacy_policy') }}" style="color: #fff;">Privacy Policy</a>
                    <a class="fz17 fw500" href="" style="color: #fff;">Site Map</a>
                </div>
            </div>
            <div class="col-md-5">
                <div class="social-widget text-center text-md-end">
                    <div class="social-style1 light-style2">
                        <a class="me-2 fw500 fz17" href="" style="color: #fff;">Follow us</a>
                        
						<a href="https://www.facebook.com/myvendorscity" target="_blank">
						<i class="fab fa-facebook-f list-inline-item" style="color: #fff;"></i>
						</a>
						
                        <a href="https://x.com/myvendorsCity" target="_blank" style="padding: 0 10px 0px 10px;">
						<img src="{{ asset('/public/site/images/twitter.png') }}"
                                style="height: 15px;width: 16px;margin-top: -4px;">
                        </a>
						
                        {{-- <a href=""><i class="fa-brands fa-square-x-twitter list-inline-item"></i></a> --}}
                        
						<a href="https://www.instagram.com/myvendorscity/" target="_blank">
						<i class="fab fa-instagram list-inline-item" style="color: #fff;"></i>
						</a>
						
                        <a href="https://www.linkedin.com/company/vendorscity/" target="_blank">
						<i class="fab fa-linkedin-in list-inline-item" style="color: #fff;"></i>
						</a>
						
                    </div>
                </div>
            </div>
        </div>-->
		{{-- <h1 class="mb25" style="color: #fff;font-size: 60px;">VendorsCity</h1> --}}
<img class="mb25 footer-logo" src="{{ asset('public/site/images/footer-logo.svg') }}"
alt="Footer Logo" >
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="link-style1 light-style at-home8 mb-4 mb-sm-5">
                    <h4 class="mb15" style="color: #fff;">About VendorsCity</h4>
                    <div class="link-list">
                        <a href="{{ route('about_us') }}" style="color: #eee;">About Us</a>
                        <li><a href="{{ route('contact') }}" style="color: #eee;">Contacting VendorsCity</a></li>
                        <a href="{{ route('careers') }}" style="color: #eee;">Careers Opportunities</a>
                        <a style="color: #eee;" href="{{ route('payment_refund_policy') }}">Payment & Refund Policy</a>
                        <a  href="{{ url('/blog') }}" style="color: #eee;">Blogs</a>
                        <a  href="{{ url('/services') }}" style="color: #eee;">Services</a>
                        <a  href="{{ url('/our-vendors') }}" style="color: #eee;">Our Vendors</a>
                        <!-- <a href="">Partnerships</a> 
                        <a href="{{ route('privacy_policy') }}" style="color: #eee;">Privacy Policy</a>
                        <a href="{{ route('term_condition') }}" style="color: #eee;">Terms of Service</a>-->
                    </div>
                </div>
            </div>
            @php
                $service_data = DB::table('services')->where('is_active', 0)->orderBy('set_order')->get();
            @endphp
            <div class="col-sm-6 col-lg-3">
                <div class="link-style1 light-style at-home8 mb-4 mb-sm-5">
                    <h4 class="mb15" style="color: #fff;">Services</h4>
                    <ul class="ps-0">
                        @foreach ($service_data as $service)
                            <li><a href="{{ url('service/' . $service->page_url) }}"
                                    style="text-decoration: none;color: #eee;">{{ $service->servicename }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--<div class="col-sm-6 col-lg-3">
                <div class="link-style1 light-style at-home8 mb-4 mb-sm-5">
                    <h4 class="mb15" style="color: #fff;">Support</h4>
                    <ul class="ps-0">
                        <li><a href="" style="color: #eee;">Help & Support</a></li>
                        <li><a href="" style="color: #eee;">Trust & Safety</a></li>
                        <li><a href="" style="color: #eee;">Selling on Vendorscity</a></li>
                        <li><a href="" style="color: #eee;">Buying on Vendorscity</a></li>
                    </ul>
                </div>
            </div>-->
			<div class="col-sm-6 col-lg-3">
                <div class="link-style1 light-style at-home8 mb-4 mb-sm-5">
                    <h4 class="mb15" style="color: #fff;">For Customers</h4>
                    <ul class="ps-0">
                        @php
                        $userdata = Session::get('user');
                        @endphp
                        @if(isset($userdata))
                        <li><a href="{{ url('/my-profile') }}" style="color: #eee;">Manage Your Account</a></li>
                        @else
                        <li><a href="{{ url('/Sign-in') }}" style="color: #eee;">Manage Your Account</a></li>
                        @endif

                        @if(isset($userdata))
                        <li><a href="{{ url('/refer&earn') }}" style="color: #eee;">Refer & Earn</a></li>
                        @else
                        <li><a href="{{ url('/Sign-in') }}" style="color: #eee;">Refer & Earn</a></li>
                        @endif

                        <li><a href="https://www.google.com/search?q=vendorscity+dubai&sca_esv=e472bba1732e8ddb&sca_upv=1&rlz=1C5CHFA_enAE1014AE1015&sxsrf=ADLYWIKMm77ohxWtSjtB2FywHuiQPICeBA%3A1716628559794&ei=T6xRZquOMNCVxc8Ph-eCsAo&ved=0ahUKEwjr8ZHcu6iGAxXQSvEDHYezAKYQ4dUDCBA&uact=5&oq=vendorscity+dubai&gs_lp=Egxnd3Mtd2l6LXNlcnAiEXZlbmRvcnNjaXR5IGR1YmFpMgQQIxgnMggQABgIGA0YHjIIEAAYCBgNGB4yCBAAGAgYDRgeMgsQABiABBiGAxiKBTILEAAYgAQYhgMYigUyCxAAGIAEGIYDGIoFMgsQABiABBiGAxiKBTIIEAAYgAQYogQyCBAAGIAEGKIESMAKUMoEWN8GcAF4AZABAJgB_wGgAcYDqgEFMC4xLjG4AQPIAQD4AQGYAgOgAtMDwgIKEAAYsAMY1gQYR8ICBxAAGIAEGA3CAggQABgFGA0YHsICChAAGAUYDRgeGA-YAwDiAwUSATEgQIgGAZAGCJIHBTEuMC4yoAeUEA&sclient=gws-wiz-serp#lrd=0x4c30ffdf4bf81567:0xaf176b54bfc73c00,1" style="color: #eee;">VC Reviews</a></li>
                    </ul>
					<h4 class="mb15" style="color: #fff;">For Vendors</h4>
					<ul class="ps-0">
                        <li><a href="{{ url('/become-a-vendor') }}"" style="color: #eee;">Become a Vendor</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="link-style1 light-style at-home8 mb-4 mb-sm-5">
                    <h4 class="mb15" style="color: #fff;">Get in Touch With Us</h4>
					<ul class="ps-0">
                    <li style="color: #eee;">
                        Bardab - Al Quoz 3 - Owned by Dubai Investment Fund 24TF-A-BLK Office No.
                    </li>
					<li style="color: #eee;"> <i class="fas fa-phone" style="color: #fff; margin-right: 5px;"></i><a href="tel:+971508807610" style="color: #eee; text-decoration: none;display:unset;">+971 50 880 7610</a></li>
					</ul>
                    <ul class="ps-0">
                        <li><a href="mailto:support@vendorscity.com" style="color: #eee;">support@vendorscity.com</a></li>
						<li style="color: #eee;">056 VENDORS (836 3677)</li>
                    </ul>
					<h4 class="mb15" style="color: #fff;">Social Links</h4>
					<div class="social-widget text-center text-md-end">
                    <div class="social-style1 light-style2" style="text-align: initial;">
                        <a href="https://www.facebook.com/myvendorscity" target="_blank" style="display: initial;">
						<i class="fab fa-facebook-f list-inline-item" style="color: #fff;"></i>
						</a>
						
                        <a href="https://x.com/myvendorsCity" target="_blank" style="padding: 0 10px 0px 10px;display: initial;">
						<img src="{{ asset('/public/site/images/twitter.png') }}"
                                style="height: 15px;width: 16px;margin-top: -4px;">
                        </a>
						
                        {{-- <a href=""><i class="fa-brands fa-square-x-twitter list-inline-item"></i></a> --}}
                        
						<a href="https://www.instagram.com/myvendorscity/" target="_blank" style="display: initial;">
						<i class="fab fa-instagram list-inline-item" style="color: #fff;"></i>
						</a>
						
                        <a href="https://www.linkedin.com/company/vendorscity/" target="_blank" style="display: initial;">
						<i class="fab fa-linkedin-in list-inline-item" style="color: #fff;"></i>
						</a>
						
                    </div>
                </div>
                </div>
            </div>
           
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                <p class="copyright-text mb-2 mb-md0 text-dark-light ff-heading" style="color: #eee;">
				<a class="fz17 fw500 mr15-md mr30" href="{{ route('term_condition') }}" style="color: #fff;">Terms of Service</a>
                    <a class="fz17 fw500 mr15-md mr30" href="{{ route('privacy_policy') }}" style="color: #fff;">Privacy Policy</a>
                    <a class="fz17 fw500" href="" style="color: #fff;">Site Map</a><br>© VendorsCity {{ date('Y') }}. All rights reserved.</p>
                </div>
            </div>
            <!-- <div class="col-md-6">
            <div class="footer_bottom_right_btns at-home8 text-center text-lg-end">
              <ul class="p-0 m-0">
                <li class="list-inline-item bg-white">
                  <select class="selectpicker show-tick">
                    <option>US$ USD</option>
                    <option>Euro</option>
                    <option>Pound</option>
                  </select>
                </li>
                <li class="list-inline-item bg-white">
                  <select class="selectpicker show-tick">
                    <option>English</option>
                    <option>Frenc</option>
                    <option>Italian</option>
                    <option>Spanish</option>
                    <option>Turkey</option>
                  </select>
                </li>
              </ul>
            </div>
          </div> -->
        </div>
    </div>
</section>
{{-- <a class="scrollToHome" href="#" style="background: #fff;"><i class="fas fa-angle-up" style="color: #000;"></i></a> --}}


</div>
</div>
<!-- Wrapper End -->
<script src="{{ asset('public/site/js/jquery-3.6.4.min.js') }}"></script>
@if (Session::get('L_strsucessMessage') != '')
    <script>
        (function($) {
            $(document).on('ready', function() {
                document.getElementById('message_succsess').innerHTML =
                    "{{ Session::get('L_strsucessMessage') }}";
                setTimeout(function() {
                    $("#message_succsess").show('blind', {}, 500)
                }, 5000);
                setTimeout(function() {
                    $("#message_succsess").hide('blind', {}, 900)
                }, 9000);
            });
        })(window.jQuery);
    </script>
@endif


<script src="{{ asset('public/site/js/jquery-migrate-3.0.0.min.js') }}"></script>
<script src="{{ asset('public/site/js/popper.min.js') }}"></script>
<script src="{{ asset('public/site/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/site/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('public/site/js/jquery.mmenu.all.js') }}"></script>
<script src="{{ asset('public/site/js/ace-responsive-menu.js') }}"></script>
<script src="{{ asset('public/site/js/jquery-scrolltofixed-min.js') }}"></script>
<script src="{{ asset('public/site/js/wow.min.js') }}"></script>
<script src="{{ asset('public/site/js/owl.js') }}"></script>
<script src="{{ asset('public/site/js/jquery.counterup.js') }}"></script>
<script src="{{ asset('public/site/js/isotop.js') }}"></script>
<script src="{{ asset('public/site/js/scrollbalance.js') }}"></script>
<script src="{{ asset('public/site/js/scrollbalance_new.js') }}"></script>
<!-- Custom script for all pages -->
<script src="{{ asset('public/site/js/script.js') }}"></script>
<script src="{{ asset('public/site/js/owl.carousel.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> --}}

<!-- Select2 JS -->

<script src="{{ asset('public/site/js/select2.min.js') }}"></script>

<script type="text/javascript">
    function remove_to_cart(rowId) {

        var answer = window.confirm("Do you want to remove this Package from cart?");

        if (answer) {
            var url = '{{ url('cart_remove') }}';
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "rowId": rowId
                },
                success: function(msg) {

                    if (msg != '') {
                        $("#message_error").html("Package Removed From Cart");
                        $('#message_error').show().delay(0).fadeIn('show');
                        $('#message_error').show().delay(2000).fadeOut('show');
                        $("#mydiv_pc").load(location.href + " #mydiv_pc");
                        //  $("#header_cart").load(location.href + " #header_cart");
                        // $("#header_cart_count").load(location.href + " #header_cart_count");
                        return false;
                    }

                }

            });
        }
    }

    function add_to_cart(package_id) {

        var qty = 1;

        $.ajax({

            type: 'POST',
            url: '{{ url('add_to_cart ') }}',
            data: {

                "_token": "{{ csrf_token() }}",
                'qty': qty,
                'package_id': package_id,

            },

            success: function(msg) {
                if (msg != 0) {
                    // $("#header_cart").load(location.href + " #header_cart");
                    // $("#header_cart_count").load(location.href + " #header_cart_count");
                    // $("#message_succsess").html("Package Added To Cart");
                    // $('#message_succsess').show().delay(0).fadeIn('show');
                    // $('#message_succsess').show().delay(2000).fadeOut('show');
                    $(".addtocart-btn_" + package_id).hide();
                    $(".loader-test_" + package_id).show();
                    setTimeout(function() {
                        window.location.href = "{{ route('cart') }}";
                        $(".addtocart-btn_" + package_id).show();
                        $(".loader-test_" + package_id).hide();
                    }, 2000);
                    return false;
                }
            }
        });

    }

    function validation_subs() {

        var email = $("#subs_email").val();
        if (email == '') {
            $("#validation_error").html("Please Enter Email Address");
            $('#validation_error').show().delay(0).fadeIn('show');
            $('#validation_error').show().delay(2000).fadeOut('show');
            return false;
        }

        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(email)) {
            jQuery('#validation_error').html("Please Enter Valid E-mail.");
            jQuery('#validation_error').show().delay(0).fadeIn('show');
            jQuery('#validation_error').show().delay(2000).fadeOut('show');
            return false;
        }

        var url = "{{ url('check_email') }}";

        $.ajax({
            url: url,
            type: 'post',
            data: {
                '_token': '{{ csrf_token() }}',
                'email': email
            },
            success: function(returndata) {
                //alert(returndata);
                if (returndata == 0) {
                    $("#validation_error").html("Email Address Already Exists");
                    $('#validation_error').show().delay(0).fadeIn('show');
                    $('#validation_error').show().delay(2000).fadeOut('show');
                    return false;
                } else {

                    $('#news_letter').submit();
                }
            }
        });
    }
</script>
@php
    $subservices_he = DB::table('subservices')->where('is_active', 0)->orderBy('set_order','ASC')->get();
@endphp

<script>
    function search_banner_header() {

        
    var search_auto_header = jQuery("#search_auto_header").val();
    if (search_auto_header == '') {

        jQuery('#search_auto_header_error').html("Please Enter Some Service");
        jQuery('#search_auto_header_error').show().delay(0).fadeIn('show');
        jQuery('#search_auto_header_error').show().delay(2000).fadeOut('show');
        $('html, body').animate({
            scrollTop: $('#search_auto_header').offset().top - 150
        }, 1000);
        return false;

    }
    $('#search_banner_header').submit();
    }

    let names_header = [];
    @if ($subservices_he != '')
        @foreach ($subservices_he as $subservices_he_data)
        names_header.push("{{ $subservices_he_data->subservicename }}");
        @endforeach
    @endif

    let sortedNames = names_header.sort();
    let input = document.getElementById("search_auto_header");


    input.addEventListener("keyup", (e) => {
  // Clear previous results
  removeElements_new();

  // Get the input value and convert it to lowercase
  let inputValue = input.value.toLowerCase();

  // Loop through sortedNames array
  for (let i of sortedNames) {
    // Convert current element `i` to lowercase
    let lowercaseName = i.toLowerCase();

    // Check if the input value is found anywhere in the lowercaseName
    if (lowercaseName.includes(inputValue) && inputValue !== "") {
      // Create li element
      let listItem = document.createElement("li");
      listItem.classList.add("list-items");
      listItem.style.cursor = "pointer";
      listItem.setAttribute("onclick", "displayNames_new('" + i + "')");

      // Highlight the matching part
      let startIndex = lowercaseName.indexOf(inputValue);
      let matchedPart = i.substr(startIndex, inputValue.length);
      let remainder = i.substr(startIndex + inputValue.length);

      // Display matched part in bold
      listItem.innerHTML = i.substr(0, startIndex) + "<b>" + matchedPart + "</b>" + remainder;

      // Append list item to the list
      document.querySelector(".list_header").appendChild(listItem);
    }
  }
});
function displayNames_new(value) {
  input.value = value;
  removeElements_new();
  var currentUrl = window.location.href;
// alert(val);
    $('#currentUrl_header').val(currentUrl);
  //$('#search_banner_header').submit();
}
function removeElements_new() {
  //clear all the item
  let items = document.querySelectorAll(".list-items");
  items.forEach((item) => {
    item.remove();
  });
}

function search_city_header(val){

    var currentUrl = window.location.href;
// alert(val);
    $('#currentUrl_header').val(currentUrl);
    $('#search_city_header').val(val);
    $('#search_banner_header').submit();
}



 let names_mobile = [];
    @if ($subservices_he != '')
        @foreach ($subservices_he as $subservices_he_data)
        names_mobile.push("{{ $subservices_he_data->subservicename }}");
        @endforeach
    @endif

    let sortedNames_mobile = names_mobile.sort();
    let input_mobile = document.getElementById("search_auto_mobile");


    input_mobile.addEventListener("keyup", (e) => {
  // Clear previous results
  removeElements_new();

  // Get the input value and convert it to lowercase
  let inputValue = input_mobile.value.toLowerCase();

  // Loop through sortedNames array
  for (let i of sortedNames_mobile) {
    // Convert current element `i` to lowercase
    let lowercaseName = i.toLowerCase();

    // Check if the input value is found anywhere in the lowercaseName
    if (lowercaseName.includes(inputValue) && inputValue !== "") {
      // Create li element
      let listItem = document.createElement("li");
      listItem.classList.add("list-items");
      listItem.style.cursor = "pointer";
      listItem.setAttribute("onclick", "displayNames_mobile('" + i + "')");

      // Highlight the matching part
      let startIndex = lowercaseName.indexOf(inputValue);
      let matchedPart = i.substr(startIndex, inputValue.length);
      let remainder = i.substr(startIndex + inputValue.length);

      // Display matched part in bold
      listItem.innerHTML = i.substr(0, startIndex) + "<b>" + matchedPart + "</b>" + remainder;

      // Append list item to the list
      document.querySelector(".list_mobile").appendChild(listItem);
    }
  }
});
function displayNames_mobile(value) {
    input_mobile.value = value;
  removeElements_new();
  var currentUrl = window.location.href;
// alert(val);
    $('#currentUrl_mobile').val(currentUrl);
  //$('#search_banner_header').submit();
}
function removeElements_new() {
  //clear all the item
  let items = document.querySelectorAll(".list-items");
  items.forEach((item) => {
    item.remove();
  });
}

function search_city_mobile(val){

    var currentUrl = window.location.href;
// alert(val);
    $('#currentUrl_mobile').val(currentUrl);
    $('#search_city_mobile_id').val(val);
    $('#search_banner_mobile').submit();
}
</script>
<script>
    // JavaScript to open WhatsApp
    document.getElementById('whatsappButton').addEventListener('click', function () {
        const phoneNumber = "9710568363677"; // Replace with your WhatsApp number
        const message = ""; // Replace with your default message

        // Open WhatsApp in a new tab
        window.open(`https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`, '_blank');
    });
</script>

<script>
    /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
    function myFunction() {
      document.getElementById("myDropdownnew").classList.toggle("show-new");
    }
    
    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtnnew')) {
        var dropdowns = document.getElementsByClassName("dropdown-content-new");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show-new')) {
            openDropdown.classList.remove('show-new');
          }
        }
      }
    }

    
</script>
</body>

</html>
