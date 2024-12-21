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
</style>
@php
    $userData = Session::get('user');

    $wallet_amount_data = DB::table('front_user_wallet')
        ->where('refer_id', $userData['refer_id'])
        ->get();

    $total_wallet_amount = 0;

    foreach ($wallet_amount_data as $wallet) {
        $total_wallet_amount += $wallet->wallet_amount;
    }

    // Now $total_wallet_amount contains the sum of all wallet_amount values
    // echo 'Total Wallet Amount: ' . $total_wallet_amount;

@endphp


<div class="body_content">
    <!-- Our LogIn Area -->
    <section class="our-login">

        <div class="container">
            <div class="row">
                <div class="col-lg-4">

                    @include('front.account_sidebar')
                </div>

                <div class="col-lg-8">

                    <div class="tab-content">

                        <div class="your_rewards">
                            <div class="">

                                <div class="col-md-12">
                                    <div class="xin_wallet_total">

                                        <div class="xin_wallet_box">


                                            <div class="fixed_amt_text">
                                                <h3 style="color: #e5097f;">AED.{{ $total_wallet_amount }}</h3>
                                                <p style="font-weight: bold; font-size:20px; line-height: 30px; ">
                                                    Current wallet Balance</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <!-- Single Tab Content End -->

                        </div>
                    </div> <!-- My Account Tab Content End -->
                </div>
            </div>

        </div>
    </section>
</div>


@include('front.includes.footer')
