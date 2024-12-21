@include('front.includes.header')

<style>
    .top-icon {
    border-radius: 50%;
	width: 78px;
    height: 72px;
    background-color: #000;
    }
	
	.textp {
    font-size: 18px;
    margin-bottom: 15px;
    line-height: 25px;

    }
</style>
	
        <!-- start section -->
        <!--<section class="wow animate__fadeIn">
            <div class="container">
                <h1 style="text-align:center;"><?php echo $message; ?></h1>
            </div>
        </section>-->
	
		<section class="wow animate__fadeIn pt40">
            <div class="container text-center">
			<div><img src="{{ asset('public/site/images/tick_icon.png') }}" alt=""></div>
                <h2 style="color: #0040E6;">Thank you for choosing VendorsCity!</h2>
				<p class="textp">Hi Devang, we have received your booking for the follwing service:</p>
				<p class="textp"><b>Appartment Villa</b><br>Order Number : 20<br></p>
				<div><img class="bdrs20" src="{{ asset('public/site/images/order_process.png') }}" alt=""></div>
				<!--<div><img class="bdrs20" src="{{ asset('public/site/images/quote-process.png') }}" alt=""></div>-->
				<p class="textp pt20"><b>Your payment needs to be processed before our crew reaches the location.</b></p>
				<p class="textp">You will receive a detailed invoice on your email address shared.<br>Accepted payment methods include cash, credit card, and debit card.</p>
				<p class="textp pt20"><b>Next Steps:</b></p>
				<p class="textp">We will assign a vendor to your service request shortly. They will contact you to <br>confirm the details and make any necessary arrangements.</p>
				<p class="textp">Once confirmed, ensure that you are at the specified time and location to <br>receive your</p>
            </div>
        </section>
		
        <!-- end section -->
@include('front.includes.footer')