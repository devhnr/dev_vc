@include('front.includes.header')
<style>
    /* Enquiry User Popup Modal Style */

    .input-field{
    display: block;
    width: 100%;
    height: 45px !important;
    padding: 6px 12px !important;
    font-size: 14px !important;
    line-height: 1.42857143 !important;
    color: #131313 !important;
    background-color: transparent !important;
    background-image: none !important;
    border: none !important;
    border-bottom: 1px solid #2b333a9e !important;
    border-radius: 0px !important;
    box-shadow: none !important;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
/* .form-control:focus {
  border-color: #000;
  -webkit-box-shadow: none;
  box-shadow: none;
  border-bottom: 1px solid #000;
} */

.login-form-modal .my_btn{
      font-size: 14px;
    color: #000;
    font-family: Avenir-Medium;
    text-transform: uppercase;
    border-style: solid;
    border-image-source: linear-gradient(270deg,#FCFF00, #18f0b8, #18a2f0, #FCFF00);
    border-image-slice: 1;
    border-width: 2px;
    margin-top: 0;
    padding: 14px 18px 10px 16px;
    position: relative;
    text-align: center;
    --borderWidth: 2px;
    border-radius: 0;
    /* border: none; */
    background: #fff;
    display: block;
    max-width: fit-content;
    margin-bottom: 10px;
    line-height: 20px;
    transition: .9s ease-in-out;
        margin: auto;
}

.modal-footer {
    margin-top: -20px;
    border-top: none !important;
}


 .login-form-modal form {
    max-width: 90%;
    margin: auto;
    display: flex;
    flex-direction: column;
    row-gap: 8px;
    /* padding-top: 20px; */
    }
    .login-form-modal h3{
        font-size: 22px;
        line-height: 32px;
    }
    .login-form-modal h3 br
    {
        /*display:  none;*/
    }
     .login-form-modal {
    padding: 50px 0 0 0;
    margin: auto;
    z-index:999999999;
}

.View-land-submit{
  margin-bottom: 25px;
  text-align: center;
  padding: 10px 20px;
  background: #299c9c;
  text-decoration: none;
  border-radius: 40px;
  color: white;
  font-size: 18px;
  border: 2px solid #299c9c;
}

body.modal-open {
    overflow: hidden !important;
}

.user-modal-dialog{
    max-width: 37% !important;
}
.login-form-modal{
    overflow-x: inherit !important;
    overflow-y: inherit !important;
}
.login-form-modal{
    padding-top: 10%;
}

@media (max-width: 768px) {
    .user-modal-dialog{
       max-width:100% !important;
       padding-top:20%;
    }
}

.owl-item.active {
    width: auto !important;
}
.modal-title{
    color: #000000;
    font-size: 30px;
    font-weight: bold;
}
.details-form label{
    font-size: 20px;
    color: #000000;
    font-weight: 500;
}

.detail-continue-btn{
    background-color: #FFD800 !important;
    color: #000000;
    border-color: #FFD800 !important;

    width: 100%;
    border-radius: 4px;
    display: inline-block;
    font-family: var(--title-font-family);
    font-weight: 700;
    font-size: 20px;
    font-style: normal;
    letter-spacing: 0em;
    padding: 8px 67px;
    position: relative;
    overflow: hidden;
    text-align: center;
    z-index: 0;
    margin-bottom: 10px;
    -webkit-transition: all 0.4s ease;
    -moz-transition: all 0.4s ease;
    -ms-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    transition: all 0.4s ease;
}
.intl-tel-input,
.iti{
  width: 100%;
}

.iti--allow-dropdown input, .iti--allow-dropdown input[type=text], .iti--allow-dropdown input[type=tel], .iti--separate-dial-code input, .iti--separate-dial-code input[type=text], .iti--separate-dial-code input[type=tel] {
    padding-right: 6px !important;
    padding-left: 91px !important;
    margin-left: 0;
}

.details-header {
    display: flex;
    flex-shrink: 0;
    align-items: center;
    justify-content: space-between;
    padding: 10px 2rem !important;
    border-bottom: 1px solid #dee2e6;
    border-top-left-radius: calc(.3rem - 1px);
    border-top-right-radius: calc(.3rem - 1px);
    /* margin-left: 20px; */
}

.details-modal-content{
    border-radius: 15px;
}
</style>
<section class="our-register mt120">
    <div class="container">       
            <div class="row wow fadeInRight" data-wow-delay="300ms">
                <div class="col-xl-7 mx-auto">
                    <div class="log-reg-form search-modal form-style1 bgc-white p30 p30-sm default-box-shadow1 bdrs12">

                        <div class="tab3">

                            {{-- Thankyou --}}
            
                            <div class="container text-center">
                                <div class="step-counter" style="background-color: #685F5E;color: #fff;border-radius: 50%;position: relative;z-index: 5;display: flex;justify-content: center;align-items: center;width: 80px;height: 80px;margin: 0 auto;border-radius: 50%;">
								<i class="fa-solid fa-check" style="font-size: 40px;margin: 0 0 3px 4px;"></i>
								</div>
                                    <h2 style="color: #0040E6;">Thank you for Your Quote Request!</h2>
                                    <p class="textp">Hi {{ Session::get('enquiry_user_data')['name'] }}, we have received your request for the following service :</p>
                                    <p class="textp"><b>{{ Session::get('enquiry_user_data')['type_of_painting'] }}</b><br>
                                        {{-- Order Number : <span id="order_id_ajax"></span> --}}
                                        <br></p>
                                    {{-- <div><img class="bdrs20" src="{{ asset('public/site/images/order_process.png') }}" alt=""></div> --}}
                                    <!--<div><img class="bdrs20" src="{{ asset('public/site/images/quote-process.png') }}" alt="" style="
                                        width: 100%;
                                    "></div>-->
									<div class="stepper-wrapper">
									  <div class="stepper-item completed">
										<div class="step-counter" style="background-color: #0040E6;color: #fff;"><i class="fa-solid fa-pen-to-square" style="font-size: 35px;margin: 0 0 3px 4px;font-weight: 500;"></i>
										</div>
										<div class="step-name">Received Request</div>
									  </div>
									  <div class="stepper-item completed">
										<div class="step-counter" style="background-color: #FFD312;color: #fff;">
										<i class="fa-light fa-memo-pad" style="font-size: 35px;font-weight: 500;"></i>
										</div>
										<div class="step-name">Compare Qoutes</div>
									  </div>
									  <div class="stepper-item">
										<div class="step-counter" style="background-color: #FFD312;color: #fff;">
										<i class="fa-regular fa-user" style="font-size: 35px;font-weight: 500;"></i>
										</div>
										<div class="step-name">Select a Vendor</div>
									  </div>
									  <div class="stepper-item">
										<div class="step-counter" style="background-color: #FFD312;color: #fff;">
										<i class="fa-solid fa-truck" style="font-size: 35px;margin: 0 0 3px 4px;font-weight: 500;"></i>
										</div>
										<div class="step-name">Receive your Service</div>
									  </div>
									</div>	
				
                                    <p class="textp pt20">You will receive <b>up to 5 quotes  </b> from our trusted vendors within the next <b>2 business days.</b></p>
                                    <p class="textp">A confirmation email has been sent to your email address with further details.</p>
                                    <p class="textp pt20">Each quote will include detailed pricing and service information. You can review the quotes and select the one that best meets your needs based on their rating and review.</p>
                                    <p class="textp pt20"><b>Next Steps:</b></p>
                                    <p class="textp">Our vendors will contact you directly to provide their quotes. You can compare the quotes and choose the best one that fits your requirements. Need Assistance? <a href="{{ route('contact') }}">Contact Us</a></p>
                                    {{-- <p class="textp">Once confirmed, ensure that you are at the specified time and location to <br>receive your</p> --}}
                                </div>
                        </div>



                    </div>
                </div>
            </div>
    </div>
</section>
@include('front.includes.footer')