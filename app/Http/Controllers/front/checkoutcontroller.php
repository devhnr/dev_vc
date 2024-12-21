<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
Use DB;
Use Helper;
use Session;
Use Mail;
use Stripe\Stripe;
use Stripe\Charge;
class checkoutcontroller extends Controller
{
    //

    public function __construct()
    {
        // Disable ModSecurity for this script
        putenv('MODSEC_ENABLE=Off');
    }
    public function checkout(){
        $data['meta_title'] = "";
        $data['meta_keyword'] = "";
        $data['meta_description'] = "";
        $data['country']= DB::table('countries')->orderBy('id', 'DESC')->get();

        // echo "<pre>";print_r($data);echo"</pre>";exit;
        return view('front.checkout',$data);
    }

    function order_place(Request $request){
       
        $userdata = Session::get('user');   

       
        // echo "<pre>";print_r(Session::get('user_wallet_amount'));echo"</pre>";exit;
    //    echo "<pre>";print_r($request->all());echo"</pre>";exit;

        

        $cart = \Cart::content();
        // echo "<pre>";print_r(Session::get('walletdiscount'));echo"</pre>";
    //    exit;

        $id = $_POST['payment_method'];

        if($id == '1'){
            $order_status = 'P';
            $paymentmode = $id;
            $list_order_status = '0';
            $payment_status = 'Success';
            $payment_mode = "COD";
        }else {
            $order_status = 'P';
            $paymentmode = $id;
            $list_order_status = '0';
            $payment_status = 'FAILED';
            $payment_mode = "ONLINE PAYMENT";   
        }

        $intOrderNumber = DB::table('ci_orders')
                ->select(DB::raw('MAX(order_id) as lastOrderNumber'))
                ->first();
        
                // echo "<pre>";print_r($intOrderNumber);echo"</pre>";

        if ($intOrderNumber) {
            $intOrderNumber = $intOrderNumber->lastOrderNumber + 1;

            $intOrderNumber_new = $intOrderNumber;
            $nextOrderNumber;
        } else {
            $intOrderNumber_new = 1;
        }

        // echo "<pre>";print_r($intOrderNumber_new);echo"</pre>";

        Session::put('order_number', $intOrderNumber_new);
        $order_number = Session::get('order_number');

        //echo "<pre>";print_r($order_number);echo"</pre>";


        $userid = $userdata['userid'];
        // echo "<pre>";print_r($userid);echo"</pre>";exit;

        if(session('coupan_data.coupancode') != ''){
            $coupancode=session('coupan_data.coupancode');
        }else{
            $coupancode="";
        }

        if(session('discount_amount') != ''){
            $coupondiscount = session('discount_amount');
        }else{
            $coupondiscount = 0;
        }

            $wallet_plus_amount = DB::table('front_user_wallet')
            ->where('refer_id', $userdata['userid'])
            ->where('added_from',0)
            ->sum('wallet_amount');

            $wallet_minus_amount = DB::table('front_user_wallet')
                    ->where('refer_id', $userdata['userid'])
                    ->where('added_from',1)
                    ->sum('wallet_amount');

            $front_wallet_amount = $wallet_plus_amount - $wallet_minus_amount;

            $order_total =  session('order_total');

            // $apply_wallet_discount = session('apply_wallet_discount');

            // echo"<pre>";print_r($request->all());echo"</pre>";exit;

        if($request->apply_button == 1){
            //  echo"in";exit;
            if($front_wallet_amount > $order_total){
               
                $order_total_new = 0;
                $front_wallet_amount_new = $order_total;

            // echo "<pre>";print_r($order_total_new);echo"</pre>";
            // echo "<pre>";print_r($front_wallet_amount_new);echo"</pre>";exit;
            }else{
                $order_total_new = $order_total - $front_wallet_amount;
                $front_wallet_amount_new = $front_wallet_amount;

            }

        }elseif($request->cancel_button == 0){
            $order_total_new = $order_total;
            $front_wallet_amount_new = 0;

            }else{
                $order_total_new = $order_total;
                $front_wallet_amount_new = 0;
        }
            //  echo "<pre>";print_r($order_total_new);echo"</pre>";exit;

            $content=array(
            'user_id'               => $userid,
            'order_number'          => $order_number,
            'order_total'           => $order_total_new,
            'front_wallet_amount'   => $front_wallet_amount_new,
            'shippingcost'          => session('shippingcahrge'),
            'vatcharge'             => session('vatcharge'),
            'order_currency'        => 'AED',
            'order_status'          => $order_status,
            'paymentmode'           => $paymentmode,
            'payment_status'        => $payment_status,
            'created_at'            => date('Y-m-d H:i:s'),
            'coupondiscount'        => $coupondiscount ,
            'coupon_code'           => $coupancode,
            'moving_date'           => $request->moving_date,
            //'ip_address'            => $_SERVER['REMOTE_ADDR'],
            'list_order_status'     => $list_order_status,
            );


        // echo "<pre>";print_r($content);echo"</pre>";exit;


        $arrOrderId = DB::table('ci_orders')->insertGetId($content);
        $year =date('y');
        $data_u['format_order_id'] = "VC-" . $year ."-UAE-". sprintf("%06d", $arrOrderId);
        DB::table('ci_orders')->where('order_id', $arrOrderId)->update($data_u);

        Session::put('format_order_id', $data_u['format_order_id']);
        //echo "<pre>";print_r($arrOrderId);echo"</pre>";
        

        if ($arrOrderId) {
            $arrOrderId;
        }

        foreach(\Cart::content() as $arrRowDeailts){

        $arrData=array(
                'order_id'                        => $arrOrderId,
                'user_info_id'                    => $userid,
                'package_id'                      => $arrRowDeailts->id,
                'package_item_name'               => $arrRowDeailts->name,
                'package_quantity'                => $arrRowDeailts->qty,
                'package_item_price'              => $arrRowDeailts->price,
                'service_id'                      => $arrRowDeailts->options->service_id,
                'service_name'                    => $arrRowDeailts->options->service_name,
                'subservice_id'                   => $arrRowDeailts->options->subservice_id,
                'subservice_name'                 => $arrRowDeailts->options->subservice_name,
                'packagecategory_id'              => $arrRowDeailts->options->packagecategory_id,
                'packagecategory_name'            => $arrRowDeailts->options->packagecategory_name,
                'page_url'                        => $arrRowDeailts->options->page_url,
                'image'                           => $arrRowDeailts->options->image,
                'discount'                        => $arrRowDeailts->options->discount,
                'discount_type'                   => $arrRowDeailts->options->discount_type,
                'product_discount_amount'         => round($arrRowDeailts->options->product_discount_amount),
                'cdate'                           => date('Y-m-d'),
                'subservice_booking_percentage'   => $arrRowDeailts->options->subservice_booking_percentage,

                );
                
        // echo "<pre>";print_r($arrData);echo"</pre>";exit;


            DB::table('ci_order_item')->insertGetId($arrData);

            // DB::table('product_attribute')
            //     ->where('id', $arrRowDeailts->options->attribute_id)
            //     ->decrement('qty', $arrRowDeailts->qty);
        }
        if($request->fname !=''){
            $data['first_name']=$request->fname;
            $data['last_name']=$request->lname;
            $data['country']=$request->country;
            $data['emirate']=$request->emirate;
            $data['area']=$request->area;
            $data['address1']=$request->address1;
            $data['state']=$request->state_name;
            $data['city']=$request->city;
            $data['zipcode']=$request->zipcode;
            $data['address2']=$request->optional;
            $data['phone_number']=$request->phone;
            $data['email_address']=$request->email_ship;
            $data['additional_message']=$request->additional_message;
            $data['payment_method']=$request->payment_method;
            $data['order_id']=$arrOrderId;
            $data['user_id']=$userid;           
            
            DB::table('ci_shipping_address')->insert($data);
        }
        if($request->apply_button == 1){
        $walletdiscount = Session::get('walletdiscount') ?? "";
        $userWalletamount = Session::get('user_wallet_amount') ?? "";
        if ($walletdiscount !="" && $userWalletamount != "") {

            if($userWalletamount > $walletdiscount){

                // $Pending_data = $userWalletamount - $walletdiscount;
                
                $walletData = array(
                    'userid'          => 0,
                    'refer_id'        => $userid,
                    'order_currency'  => 'AED',
                    'order_total'     => session('order_total'),  
                    'wallet_amount'   => $walletdiscount,  
                    'added_from'      => 1,  
                    'order_id'        => $arrOrderId,  
                    'added_date'      => date('Y-m-d'), 
                );
                
                DB::table('front_user_wallet')->insertGetId($walletData);
            }else{

                $walletData = array(
                    'userid'          => 0,
                    'refer_id'        => $userid,
                    'order_currency'  => 'AED',
                    'order_total'     => session('order_total'),  
                    'wallet_amount'   => $userWalletamount,  
                    'added_from'      => 1,  
                    'order_id'        => $arrOrderId,  
                    'added_date'      => date('Y-m-d'), 
                );

                DB::table('front_user_wallet')->insertGetId($walletData);
        }
        }
    }

        if($id == 1){
            $success = $this->success_mail();
            if ($success) {
                // Redirect to the 'thankyou' route
                return redirect('thankyou');
            } 
        }else{
			
			// Set your secret key. Remember to switch to your live secret key in production.
            // See your keys here: https://dashboard.stripe.com/apikeys
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

            $response = $stripe->checkout->sessions->create([
              'line_items' => [
                [
                  'price_data' => [
                    'currency' => 'aed',
                    'product_data' => [
                        'name' => 'Your Total'
                    ],
                    'unit_amount' => session('order_total')*100,
                  ],
                  'quantity' => 1,
                ],
              ],
              'mode' => 'payment',
              'success_url' => route('payment_success'),
              'cancel_url' => route('payment_fail'),
            ]);

            // dd($response);
            // echo "dev".$response->id;
            if(isset($response->id) && $response->id != ''){

                Session::put('stripe_session_id', $response->id);
                

                return redirect($response->url);
            }else{
                return redirect()->route('payment_fail');
            }
        }

        

       

       // echo "<pre>";print_r($walletdiscount);echo"</pre>";exit;
        
    }

    function book_now_order(Request $request){

    //    echo "<pre>";print_r($request->all());echo"</pre>";exit;
        $userdata = Session::get('user'); 

        $isPaintingBookOrEnquiry = $request->is_book_or_quote ?? "";
        $type_of_paintingInset = $request->type_of_painting ?? "";
        $cleaingService = $request->how_many_cleaners_do_you_need ?? "";
        
        if($isPaintingBookOrEnquiry != "get-quote" && $type_of_paintingInset =="Move in / Move Out Painting" || $cleaingService !=""){

            //echo "<pre>";print_r($request->all());echo"</pre>";exit;

            $payment_type = $request->payment_type;

            if($payment_type == 'COD'){
                $order_status = 'P';
                $paymentmode = 1;
                $list_order_status = '0';
                $payment_status = 'Success';
                $payment_mode = "COD";
            }else {
                $order_status = 'P';
                $paymentmode = 2;
                $list_order_status = '0';
                $payment_status = 'FAILED';
                $payment_mode = "ONLINE PAYMENT";   
            }


            $intOrderNumber = DB::table('ci_orders')
            ->select(DB::raw('MAX(order_id) as lastOrderNumber'))
            ->first();

            if ($intOrderNumber) {
                $intOrderNumber = $intOrderNumber->lastOrderNumber + 1;

                $intOrderNumber_new = $intOrderNumber;
                $nextOrderNumber;
            } else {
                $intOrderNumber_new = 1;
            }


            Session::put('order_number', $intOrderNumber_new);
            $order_number = Session::get('order_number');

            $userid = $userdata['userid'];
            //echo "<pre>";print_r($userid);echo"</pre>";exit;
            
            

            $isPaintingData = $request->type_of_painting ?? "";

            if($isPaintingData == "" && empty($isPaintingData)){

                // echo"cleaning_here";exit;

                $order_from = 1; // booking form data

            $wallet_plus_amount = DB::table('front_user_wallet')
                                ->where('refer_id', $userdata['userid'])
                                ->where('added_from',0)
                                ->sum('wallet_amount');

            $wallet_minus_amount = DB::table('front_user_wallet')
                                    ->where('refer_id', $userdata['userid'])
                                    ->where('added_from',1)
                                    ->sum('wallet_amount');

            $front_wallet_amount = $wallet_plus_amount - $wallet_minus_amount;

            $order_total = $request->total_to_pay;

            // $apply_wallet_discount = session('apply_wallet_discount');

            // echo"<pre>";print_r($front_wallet_amount);echo"</pre>";
            // echo"<pre>";print_r($order_total);echo"</pre>";exit;

                if($request->apply_button == 1){
                    //  echo"in";exit;
                    if($front_wallet_amount > $order_total){
                    
                        $order_total_new = 0;
                        $front_wallet_amount_new = $order_total;

                    // echo "<pre>";print_r($order_total_new);echo"</pre>";
                    // echo "<pre>";print_r($front_wallet_amount_new);echo"</pre>";exit;
                    }else{
                        $order_total_new = $order_total - $front_wallet_amount;
                        $front_wallet_amount_new = $front_wallet_amount;

                    }

                }elseif($request->cancel_button == 0){
                    $order_total_new = $order_total;
                    $front_wallet_amount_new = 0;

                    }else{
                        $order_total_new = $order_total;
                        $front_wallet_amount_new = 0;
                }

                
                $vat_total = $request->vat_total;

        $content = array(
                    'user_id'               => $userid,
                    'order_number'          => $order_number,
                    'order_total'           => $order_total_new,
                    'front_wallet_amount'   => $front_wallet_amount_new,
                    'vatcharge'             => $vat_total,
                    'order_currency'        => 'AED',
                    'order_status'          => $order_status,
                    'paymentmode'           => $paymentmode,
                    'payment_status'        => $payment_status,
                    'created_at'            => date('Y-m-d H:i:s'),
                    //'ip_address'            => $_SERVER['REMOTE_ADDR'],
                    'list_order_status'     => $list_order_status,
                    'service_charge'     => $request->service_charge,
                    'promo_discount'     => $request->promo_discount,
                    'cleaning_discount_additional'     => $request->cleaning_discount_additional,
                    'timing_charge'     => $request->timing_charge,
                    'additional_charge'     => $request->additional_charge,
                    'sub_total'     => $request->sub_total,
                    'cod_charge'     => $request->cod_charge,
                    'service_fee'     => $request->service_fee,
                    'order_from'     => $order_from,
                );

            }

            if($isPaintingData != "" && !empty($isPaintingData)){

                // echo"painting_here";exit;

                $wallet_plus_amount = DB::table('front_user_wallet')
                                    ->where('refer_id', $userdata['userid'])
                                    ->where('added_from',0)
                                    ->sum('wallet_amount');

                $wallet_minus_amount = DB::table('front_user_wallet')
                                    ->where('refer_id', $userdata['userid'])
                                    ->where('added_from',1)
                                    ->sum('wallet_amount');

                $front_wallet_amount = $wallet_plus_amount - $wallet_minus_amount;

                $order_total = $request->total_to_pay_charge_price;

                // $apply_wallet_discount = session('apply_wallet_discount');

                // echo"<pre>";print_r($request->all());echo"</pre>";exit;

                if($request->apply_button == 1){
                    //  echo"in";exit;
                    if($front_wallet_amount > $order_total){
                    
                        $order_total_new = 0;
                        $front_wallet_amount_new = $order_total;

                    // echo "<pre>";print_r($order_total_new);echo"</pre>";
                    // echo "<pre>";print_r($front_wallet_amount_new);echo"</pre>";exit;
                    }else{
                        $order_total_new = $order_total - $front_wallet_amount;
                        $front_wallet_amount_new = $front_wallet_amount;

                    }

                }elseif($request->cancel_button == 0){
                    $order_total_new = $order_total;
                    $front_wallet_amount_new = 0;

                    }else{
                        $order_total_new = $order_total;
                        $front_wallet_amount_new = 0;
                }


                
                $vat_total = $request->hidden_vat_charge_price;
                $order_from = 2; // booking form data

                $content = array(
                    'user_id'               => $userid,
                    'order_number'          => $order_number,
                    'front_wallet_amount'   => $front_wallet_amount_new,
                    'order_total'           => $order_total_new,
                    'vatcharge'             => $vat_total,
                    'order_currency'        => 'AED',
                    'order_status'          => $order_status,
                    'paymentmode'           => $paymentmode,
                    'payment_status'        => $payment_status,
                    'created_at'            => date('Y-m-d H:i:s'),
                    //'ip_address'            => $_SERVER['REMOTE_ADDR'],
                    'list_order_status'     => $list_order_status,
                    'service_charge'     => $request->size_of_home_price,
                    'promo_discount'     => $request->hidden_discount_price,
                    'cleaning_discount_additional'     => '',
                    'timing_charge'     => $request->timing_charge,
                    'additional_charge'     => $request->additional_charge_price,
                    'sub_total'     => $request->hidden_subtotal_price,
                    'cod_charge'     => $request->cod_charge_new ? : "",
                    'service_fee'     => $request->service_fee,
                    'order_from'     => $order_from,
                );

            }
            
                // echo "<pre>";print_r($content);echo"</pre>";exit;
            $arrOrderId = DB::table('ci_orders')->insertGetId($content);

        

            $year = date('y');
            $data_u['format_order_id'] = "VC-" . $year ."-UAE-". sprintf("%06d", $arrOrderId);
            DB::table('ci_orders')->where('order_id', $arrOrderId)->update($data_u);
            Session::put('format_order_id', $data_u['format_order_id']);

            if ($arrOrderId) {
                $arrOrderId;
            }

            if($request->which_day_of_the_week_do_you_want_the_service != ''){
                $which_day_of_the_week_do_you_want_the_service = implode(',', $request->which_day_of_the_week_do_you_want_the_service);
            }else{
                $which_day_of_the_week_do_you_want_the_service = "";
            }

            if($isPaintingData == "" && empty($isPaintingData)){

                $arrData=array(
                    'order_id'                             => $arrOrderId,
                    'user_info_id'                         => $userid,
                    'service_id'                           => $request->service_id,
                    'subservice_id'                        => $request->subservice_id,
                    'how_many_cleaners_do_you_need'        => $request->how_many_cleaners_do_you_need,
                    'how_many_hours_should_they_stay'      => $request->how_many_hours_should_they_stay,
                    'how_often_do_you_need_cleaning'       => $request->how_often_do_you_need_cleaning,
                    'do_you_need_cleaning_material'        => $request->do_you_need_cleaning_material,
                    'any_special_instruction'              => $request->any_special_instruction,
                    'address_type'                         => $request->address_type,
                    'city'                                 => $request->city,
                    'area'                                 => $request->area,
                    'building_street_no'                   => $request->building_street_no,
                    'apartment_villa_no'                   => $request->apartment_villa_no,
                    'bookingdate'                                 => $request->date,
                    'bookingyear'                                 => date('Y'),
                    'month'                                => $request->month,
                    'time_slot'                            => $request->time_slot,
                    'which_day_of_the_week_do_you_want_the_service' => $which_day_of_the_week_do_you_want_the_service ,
                    'cdate'                                => date('Y-m-d'),
                    );
            } 

            if($isPaintingData !== "" && !empty($isPaintingData)){

                if($request->selected_home_furnished_price != 0){
                    $isYourHomeFurnished = "Yes";
                }else{
                    $isYourHomeFurnished = "No";
                }

                $arrData=array(
                    'order_id'                             => $arrOrderId,
                    'user_info_id'                         => $userid,
                    'service_id'                           => $request->service_id,
                    'subservice_id'                        => $request->subservice_id,
                    'address_type'                         => $request->address_type,
                    'city'                                 => $request->city,
                    'area'                                 => $request->area,
                    'building_street_no'                   => $request->building_street_no,
                    'apartment_villa_no'                   => $request->apartment_villa_no,
                    'bookingdate'                          => $request->date,
                    'bookingyear'                          => date('Y'),
                    'month'                                => $request->month,
                    'time_slot'                            => $request->time_slot,
                    'type_of_painting'                     => $request->type_of_painting,
                    'selected_type_home'                   => $request->selected_type_home,
                    'selected_size_home'                   => $request->selected_size_home,
                    'service_charge_price'                 => $request->size_of_home_price,
                    'color_you_want_painted_price'         => $request->color_you_want_painted_price,
                    'walls_now_price'                      => $request->color_your_walls_now_price,
                    'you_want_paint_color'                 => $request->selected_you_want_color_name,
                    'your_walls_now_color'                 => $request->selected_your_walls_now_name,
                    'is_home_furnished'                    => $isYourHomeFurnished,
                    'no_of_ceilings'                       => $request->no_of_ceilings ? : "",
                    'describe_painting_service'            => $request->describe_painting_service ? : "",
                    'cdate'                                => date('Y-m-d'),
                    );
            } 

            $order_item_id = DB::table('ci_order_item')->insertGetId($arrData);
                
            if($isPaintingData == "" && empty($isPaintingData)){
                if(\Cart::count() > 0){
                foreach(\Cart::content() as $arrRowDeailts){

                $arrData_package=array(
                        'order_id'                        => $arrOrderId,
                        'order_item_id'                   => $order_item_id,
                        'user_info_id'                    => $userid,
                        'package_id'                      => $arrRowDeailts->id,
                        'package_item_name'               => $arrRowDeailts->name,
                        'package_quantity'                => $arrRowDeailts->qty,
                        'package_item_price'              => $arrRowDeailts->price,
                        'service_id'                      => $arrRowDeailts->options->service_id,
                        'service_name'                    => $arrRowDeailts->options->service_name,
                        'subservice_id'                   => $arrRowDeailts->options->subservice_id,
                        'subservice_name'                 => $arrRowDeailts->options->subservice_name,
                        'packagecategory_id'              => $arrRowDeailts->options->packagecategory_id,
                        'packagecategory_name'            => $arrRowDeailts->options->packagecategory_name,
                        'page_url'                        => $arrRowDeailts->options->page_url,
                        'image'                           => $arrRowDeailts->options->image,
                        'discount'                        => $arrRowDeailts->options->discount,
                        'discount_type'                   => $arrRowDeailts->options->discount_type,
                        'product_discount_amount'         => round($arrRowDeailts->options->product_discount_amount),
                        'cdate'                           => date('Y-m-d'),
                        'subservice_booking_percentage'   => $arrRowDeailts->options->subservice_booking_percentage,

                        );
                        
                // echo "<pre>";print_r($arrData);echo"</pre>";exit;


                        DB::table('ci_order_item_packages')->insertGetId($arrData_package);
                    }
                }
            }

            //if($request->fname !=''){
                $data['first_name']="";
                $data['last_name']="";
                $data['country']="";
                $data['address1']="";
                $data['state']="";
                $data['city']="";
                $data['zipcode']="";
                $data['address2']="";
                $data['phone_number']="";
                $data['email_address']="";
                $data['additional_message']="";
                $data['payment_method']="";
                $data['order_id']=$arrOrderId;
                $data['user_id']=$userid;           
                
                DB::table('ci_shipping_address')->insert($data);

            if($isPaintingData != "" && !empty($isPaintingData)){
                // echo"painting_here";exit;
                
                if($request->apply_button == 1){
                    $walletdiscount = Session::get('walletdiscount') ?? "";
                    $userWalletamount = Session::get('user_wallet_amount') ?? "";
                    if ($walletdiscount !="" && $userWalletamount != "") {
            
                        if($userWalletamount > $walletdiscount){
            
                            // $Pending_data = $userWalletamount - $walletdiscount;
                            $order_total = $request->total_to_pay_charge_price;
                            $order_total = round((float) $order_total, 2);

                            $walletData = array(
                                'userid'          => 0,
                                'refer_id'        => $userid,
                                'order_currency'  => 'AED',
                                'order_total'     => $order_total,  
                                'wallet_amount'   => $walletdiscount,  
                                'added_from'      => 1,  
                                'order_id'        => $arrOrderId,  
                                'added_date'      => date('Y-m-d'), 
                            );
                            
                            DB::table('front_user_wallet')->insertGetId($walletData);
                        }else{
            
                            $walletData = array(
                                'userid'          => 0,
                                'refer_id'        => $userid,
                                'order_currency'  => 'AED',
                                'order_total'     => $order_total,  
                                'wallet_amount'   => $userWalletamount,  
                                'added_from'      => 1,  
                                'order_id'        => $arrOrderId,  
                                'added_date'      => date('Y-m-d'), 
                            );
            
                            DB::table('front_user_wallet')->insertGetId($walletData);
                    }
                    }
                }
            }else{
                // echo"cleaning_here";exit;
                if($request->apply_button == 1){
                    $walletdiscount = Session::get('walletdiscount') ?? "";
                    $userWalletamount = Session::get('user_wallet_amount') ?? "";

                    
                    if ($walletdiscount !="" && $userWalletamount != "") {
            
                        if($userWalletamount > $walletdiscount){
            
                            // $Pending_data = $userWalletamount - $walletdiscount;
                            $order_total = $request->total_to_pay;
                            $order_total = round((float) $order_total, 2);

                            $walletData = array(
                                'userid'          => 0,
                                'refer_id'        => $userid,
                                'order_currency'  => 'AED',
                                'order_total'     => $order_total,  
                                'wallet_amount'   => $walletdiscount,  
                                'added_from'      => 1,  
                                'order_id'        => $arrOrderId,  
                                'added_date'      => date('Y-m-d'), 
                            );
                            
                            DB::table('front_user_wallet')->insertGetId($walletData);
                        }else{
            
                            // echo"<pre>";print_r($walletdiscount);echo"</pre>";
                            // echo"<pre>";print_r($userWalletamount);echo"</pre>";exit;

                            $walletData = array(
                                'userid'          => 0,
                                'refer_id'        => $userid,
                                'order_currency'  => 'AED',
                                'order_total'     => $order_total,  
                                'wallet_amount'   => $userWalletamount,  
                                'added_from'      => 1,  
                                'order_id'        => $arrOrderId,  
                                'added_date'      => date('Y-m-d'), 
                            );
            
                            DB::table('front_user_wallet')->insertGetId($walletData);
                    }
                    }
                }
            }

            Session::put('painting_service_name',$type_of_paintingInset);
            if($payment_type == 'COD'){
                $success = $this->success_mail_book_now();
                if ($success) {
                    // Redirect to the 'thankyou' route
                    if($isPaintingData == "" && empty($isPaintingData)){
                        return redirect('thankyou_book_now');
                    }else{
                        return redirect('thankyou-book-now');
                    }
                } 
            }else{

                $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

                $response = $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                    'price_data' => [
                        'currency' => 'aed',
                        'product_data' => [
                            'name' => 'Your Total'
                        ],
                        'unit_amount' => $order_total *100,
                    ],
                    'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('payment_success'),
                'cancel_url' => route('payment_fail'),
                ]);

                // dd($response);
                // echo "dev".$response->id;
                if(isset($response->id) && $response->id != ''){

                    Session::put('stripe_session_id', $response->id);
                    

                    return redirect($response->url);
                }else{
                    return redirect()->route('payment_fail');
                }
            }
        }else{
            // echo "<pre>";print_r($userdata);echo"</pre>";
            
            $type_of_painting = $request->type_of_painting;
            $service_id = $request->service_id;
            $subservice_id = $request->subservice_id;
            $name = $userdata['name'];
            $email = $userdata['email'];
            $mobile = $userdata['mobile'];
            $addressType = $request->address_type;
            $city = $request->city;
            $area = $request->area;
            $building_street_no = $request->building_street_no;
            $enquiry_date = $request->date;
            $enquiry_month = $request->month;
            $enquiry_year = date('Y');
            $time_slot = $request->time_slot;
            $description = $request->describe_painting_service;

            if($request->formfield_value == "Paint individual rooms"){
                $no_of_rooms_paint = $request->how_many_rooms_painted ?? '';
                $noRoomsPaint =  $no_of_rooms_paint;
            }else{
                $noRoomsPaint = 0;
            }

            if($request->formfield_value == "Paint individual walls"){
                $no_of_walls_paint = $request->how_many_walls_painted ?? '';
                $noWallsPaint =  $no_of_walls_paint;
            }else{
                $noWallsPaint = 0;
            }

            $arrayOfEnquiry = array(
                'type_of_painting'          => $type_of_painting,
                'name'                      => $name,
                'service_id'                => $service_id,
                'subservice_id'             => $subservice_id,
                'email'                     => $email,
                'mobile'                    => $mobile,
                'addressType'               => $addressType,
                'city'                      => $city,
                'area'                      => $area,
                'building_street_no'        => $building_street_no,
                'enquiry_date'              => $enquiry_date,
                'enquiry_month'             => $enquiry_month,
                'enquiry_year'              => $enquiry_year,
                'time_slot'                 => $time_slot,
                'no_of_rooms_painted'       => $noRoomsPaint,
                'no_of_walls_painted'       => $noWallsPaint,
                'describe_painting_service' => $description ?? "",
                'added_date'                => date("Y-m-d"),
            );

          //echo "<pre>";print_r($arrayOfEnquiry);echo"</pre>";exit;

          $enquiryInsertId =  DB::table('painting_enquiry')->insertGetId($arrayOfEnquiry);
          $processed_text = "Painting";
          $yearForId =date('y');
          $data_u['inquiry_id'] = "IQ-".$processed_text."-" . $yearForId ."-". sprintf("%06d", $enquiryInsertId);
          DB::table('painting_enquiry')->where('id', $enquiryInsertId)->update($data_u);

          $arrayData = array('name' => $name,'type_of_painting'=>$type_of_painting);
            Session::put('enquiry_user_data',$arrayData);
            $success = $this->success_mail_painting_enquiry();
            /*  if ($success) {
                    if($isPaintingData == "" && empty($isPaintingData)){
                        return redirect('thankyou_book_now');
                    }else{
                        return redirect('thankyou-book-now');
                    }
                }  */

        
            return redirect()->route('thank-you');

        }
        
       // echo "<pre>";print_r($request->all());echo"</pre>";exit;
    }
	public function payment_success(Request $request){

        $stripe_session_id = Session::get('stripe_session_id');

        $order_number = Session::get('order_number');
		
		if(isset($stripe_session_id)){

            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

            $response = $stripe->checkout->sessions->retrieve($stripe_session_id);

            if($response->status == 'complete'){

                $data_u['payment_id'] = $response->id; 
                $data_u['currency'] = $response->currency; 
                $data_u['payment_status'] = "Success";

                $orderdata = DB::table('ci_orders')->where('order_number',$order_number)->update($data_u);

                $success = $this->success_mail_book_now();
                if ($success) {
                    // Redirect to the 'thankyou' route
                    return redirect('thankyou_book_now');
                } 
            }
            
        }else{
            return redirect()->route('payment_fail');
        }
	}

    function payment_fail(Request $request){
        

        \Cart::destroy(); 
        session()->forget('coupan_data');
        session()->forget('shippingcahrge');
        session()->forget('discount_amount');
        session()->forget('order_total');
        session()->forget('stripe_session_id');
        session()->forget('walletdiscount');
        session()->forget('user_wallet_amount');
        
           //echo "here";exit;
           $data['meta_title'] = "";
           $data['meta_keyword'] = "";
           $data['meta_description'] = "";

           $data['message'] =  "Payment Fail";

           return view('front.payment_fail',$data);
        
    }

    public function success_mail(){

        $order_number = Session::get('order_number');

        $format_order_id = Session::get('format_order_id');
 
         $orderdata = DB::table('ci_orders')->where('order_number',$order_number)->first();
        

         Session::put('order_payment_mode', $orderdata->paymentmode);

         if($orderdata->paymentmode == 1){
             $payment_mode = "Cash On Delivery";
         }else{
             $payment_mode = "Online Payment";
         }
 
         $order_item_data = DB::table('ci_order_item')->where('order_id',$order_number)->get();


       //  $shiaddress = DB::table('ci_shipping_address')->where('order_id',$order_number)->first();
    //    echo "<pre>";print_r($order_item_data);echo"</pre>";
         // echo "<pre>";print_r($orderdata);echo "</pre>";
       
         $i=1;
 
             $message_body ='';
 
             $message_body .='<!doctype html>
 
 <html lang="en">
 
     <body style="margin: 0;font-family: Arial, Helvetica, sans-serif;">
 
         <div style="max-width:630px;margin: 0 auto;border: thin solid #f3f0f0;">
 
             <header style="text-align:center;"><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
 
                 <a href="{{ config("app.url") }}"><img style="max-width:100%;display: inline-block;" src="'.asset("public/site/images/VC-LONG-COLOR.png").'"></a>           </header>
 
             <div style="background:#ababab;padding: 7% 8% 6%;">
 
                 <p style="font-size: 17px;letter-spacing: 0.5px;text-align:center;line-height: 30px;color:#fff;margin:0;">
 
                     Hi, Your order number <strong>'.$format_order_id.'</strong> has been<br>
 
                     successfully placed.
 
                 </p>
 
             </div>
 
             <div style="background:#EDEDED;padding: 20px 7%;font-size: 14px;text-align: left;">
 
                 <div style="width:55%;background:#EDEDED;text-align: left;display: inline-block;margin-bottom: 10px;">
 
                     <p style="margin:0">
 
                         <strong>Order Details</strong><br>
 
                         Order No.: '.$format_order_id.'<br><br>
 
                         Payment Mode: '.$payment_mode.'<br>
 
                     </p>
 
                 </div>
 
 
             </div>
 
             <div style="padding: 0px 30px;">
 
                 <p style="text-align: left;text-align: left;border-bottom: 2px solid #727171;padding-bottom: 4px;"><strong>Item(s) in Your Order</strong></p>
 
                 <table style="border-collapse: collapse;width: 100%;">';
 
                 $pvalue = '0';
 
                 $userdata = Session::get('user');

                 $userid = $userdata['userid'];

                 $user_email = $userdata['email'];

                 foreach($order_item_data as $arrRowDeailts )  
 
                 {

                    if($arrRowDeailts->product_discount_amount != 0 && $arrRowDeailts->product_discount_amount != ''){
                        $product_discount_amount = $arrRowDeailts->product_discount_amount;
                     }else{
                        $product_discount_amount = $arrRowDeailts->package_item_price;
                     }
 
                     $totalgst='0';
 
                     $message_body .='<tr style="border-bottom: 2px solid #CCCECF;">';
 
                     if($arrRowDeailts->image != ''){
 
                     $message_body .=' <td style="width: 85px;padding-bottom: 10px;vertical-align: top;"><img src="'.asset("public/upload/packages/large/".$arrRowDeailts->image).'" style="width:85px;height:97px;border: 2px solid gray;" /></td>';
                     }else{
                     $message_body .='<td style="width: 85px;padding-bottom: 10px;vertical-align: top;"><img src="'.asset("public/upload/packages/large/no-image.png").'" style="width:85px;height:97px;border: 2px solid gray;" /></td>';
                     }
 
                     $message_body .='<td style="text-align: left;vertical-align: top;padding-left: 15px;padding-bottom: 10px;">
 
                         <p style="margin: 0;"><strong>'.$arrRowDeailts->package_item_name.'</strong></p>
 
                         <p style="margin: 0;"> <span style="color:gray;">Quantity:</span> '.$arrRowDeailts->package_quantity.'</p><br>
 
                     </td>
 
                     <td style="vertical-align: top;width: 150px;text-align: right;padding-bottom: 10px;">'.
                     
                     
                     
                     $orderdata->order_currency.' '.number_format(($product_discount_amount * $arrRowDeailts->package_quantity),2); 
 
                     /* $message .='&nbsp; <del style="color:gray;">Rs.: 1599</del></td>';*/
 
                     $message_body .='</tr>';
 
                     $i++;
 
                     $pvalue = ($pvalue +  (($product_discount_amount) * $arrRowDeailts->package_quantity));
 
                 }
 
                     $message_body .='<tr style="border-bottom: 2px solid #CCCECF;color: #808080;">
 
                         <td style="text-align:left;" colspan="2">Subtotal</td>
 
                         <td style="text-align:right;">'.$orderdata->order_currency.' '.number_format($pvalue,2).'</td>
 
                     </tr>';
 
                     if($orderdata->coupondiscount != "" && $orderdata->coupondiscount !=0 )  {
 
                     $message_body .='<tr style="border-bottom: 2px solid #CCCECF;color: #808080;">
 
                         <td style="text-align:left;" colspan="2">Discount</td>
 
                         <td style="text-align:right;">'.$orderdata->order_currency.' '.number_format($orderdata->coupondiscount,2).'</td>
 
                     </tr>';
 
                     }
 
 
                     if($orderdata->shippingcost != "" && $orderdata->shippingcost !=0 ){
 
                     $message_body .='<tr style="color: #808080;">
 
                      <td style="text-align:left;" colspan="2">Shipping</td>
 
                      <td style="text-align:right;">'.$orderdata->order_currency.' '.number_format($orderdata->shippingcost,2).'</td>
 
                     </tr>';
 
                     }

                     if($orderdata->vatcharge != "" && $orderdata->vatcharge !=0 ){
 
                        $message_body .='<tr style="color: #808080;">
    
                         <td style="text-align:left;" colspan="2">VAT 5%</td>
    
                         <td style="text-align:right;">'.$orderdata->order_currency.' '.number_format($orderdata->vatcharge,2).'</td>
    
                        </tr>';
    
                        }

                     if($orderdata->front_wallet_amount != "" && $orderdata->front_wallet_amount !=0 ){
 
                        $message_body .='<tr style="color: #808080;">
    
                         <td style="text-align:left;" colspan="2">Wallet Amount</td>
    
                         <td style="text-align:right;">' .'-'.$orderdata->order_currency.' '.number_format($orderdata->front_wallet_amount,2).'</td>
    
                        </tr>';
    
                        }
 
                     $message_body .='<tr style="border-bottom: 1px solid #000;border-top: 1px solid #000;font-weight: bold;">
 
                         <td style="text-align:left;" colspan="2">Total</td>
 
                         <td style="text-align:right;">'.$orderdata->order_currency.' '.number_format($orderdata->order_total,2).'</td>
 
                     </tr>
 
                 </table>
 
             </div>
 
         </div>
 
     </body>
 
 </html>';

                    
            $subject = "Thank you for shopping with Vendors City";
            $refer_id = $userdata['refer_id'];
            
            $system_percentage = DB::table('system')->first();
            $total = ($orderdata->order_total * $system_percentage->percentage /100);

            // echo $total;exit;
        if(isset($userdata['refer_id']) && $userdata['refer_id'] !='')
        {
            $existing_wallet = DB::table('front_user_wallet')->where('userid', $userdata['userid'])->first();
            if(!$existing_wallet){
            $data['userid']=$userdata['userid'];
            $data['refer_id']=$userdata['refer_id'];
            $data['order_currency']=$orderdata->order_currency;
            $data['wallet_amount']=$total;
            $data['system_percentage']=$system_percentage->percentage;
            $data['order_total']=$orderdata->order_total;
            $data['added_date']=date('Y-m-d');
           
            DB::table('front_user_wallet')->insert($data);
            }
        }
    

        //  $to = $user_email;
        //  $ccRecipients = ['support@vendorscity.com'];
         
        //  Mail::send([], [], function($message) use($message_body, $to, $subject) {
        //      $message->to($to);
        //      $message->subject($subject);
        //      $message->from('devang.hnrtechnologies@gmail.com', 'Vendors City');
        //      $message->html($message_body);
        //  });

         if($orderdata->paymentmode == 1){
             $payment_mode = "COD";
         }else{
             $payment_mode = "Online";
         }

         $user_name = $userdata['name'];
         $message_bodyy ='';
 
             $message_bodyy .='<!doctype html>
 
 <html lang="en">
 <head>
 <meta charset="utf-8">
 <title>Account Registration:</title>
 <style>
     .logo {
         border-bottom: 4px solid #FFD413;
     }
     .logo img{
         width: 45%;
     }
     .wrapper {
         width: 100%;
         max-width:500px;
         margin:auto;
         font-size:14px;
         line-height:24px;
         font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;
         color:#555;
         padding:50px 0;
     }   
     .email_wrapper {
         width:100%;
         margin-top: 18px;
         font-size: 16px;
     }
     h2 {
         font-size: 26px;
         font-weight: bolder;
         margin: 0;
     }
     .btnlink {
         background: #0040E6;
         color: #fff !important;
         text-decoration: none;
         width: 100%;
         display: block;
         padding: 9px 0;
         text-align: center;
         font-size: 16px;
         border-radius: 9px;
     }
     .email_footer {
         width:100%;
         margin-top: 20px;
     }
     h3 {
         font-size: 20px;
         font-weight: bolder;
         margin: 0;
         border-bottom: 3px solid #6B7177;
         padding-bottom: 20px;
         margin-bottom: 15px;
     }
     .email_footer_div {
         width:100%;
         display: flex; 
     }
     .footer_left {
         width: 100px;
         float: left;
     }
     .footer_right {
         margin-left:10px;
         float: left;
     }
     .footer_right p{
         margin:0;
     }
     .footer_links {
         margin:10px 0;
     }
     .footer_links a {
         width: 100%;
         color: #555;
         display: inline-block;
     }
 </style>
        </head>
            <body>
            <div class="wrapper" style="width: 100%;max-width:500px;margin:auto;
                            font-size:14px;line-height:24px;
                            font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;color:#555;padding:50px 0;">
                <div class="logo" style="float: inherit;border-bottom: 4px solid #FFD413;">
                <img src="'.asset("public/site/images/VC-FULL-COLOR.png").'"" style="width: 40%;"  >
                </div>

                    <div class="email_wrapper" style="width:100%;margin-top: 18px;font-size: 16px;" > 
                    <p> Dear '.$user_name.',</p>
                    <p>Thank you for booking a service with VendorsCity! We are excited to assist you.</p>

                    <p>Your booking details are as follows:</p>';

                    foreach($order_item_data as $arrRowDeailtss ) {
                        $message_bodyy .='<strong>Service: </strong> '.$arrRowDeailtss->service_name.'<br>';
                     }

                     $message_bodyy .='
                     <strong>Date: </strong> '.$orderdata->moving_date.'<br>
                     <strong>Order No: </strong> '.$orderdata->format_order_id.'';

                     if($payment_mode == 'COD'){
                            $message_bodyy .='<p>Payment needs to be processed once our crew reaches the location. You will receive a detailed invoice from our crew. Accepted payment methods include cash, credit card, and debit card. In case an online transfer is required, please inform us and ensure it is completed a day prior to our arrival onsite.</p>';
                     }else{
                        $message_bodyy .='<p>Your payment has been successfully processed. You will receive another email with a detailed receipt shortly.</p>';
                     }
                     

                     $message_bodyy .='<p>Your service provider will contact you soon to confirm the details and make any necessary arrangements. If you do not hear from them within 2 business days, please email us at <a style="color: #555;" href="mailto:support@vendorscity.com">support@vendorscity.com</a> or call us at 056 VENDORS (836 3677).</p>

                     <p>If you have any questions or need to make changes to your booking, please do not hesitate to   <a href="'.url("/contact").'">Contact Us</a>.
                     </p>
                     <p>Thank you for choosing VendorsCity. We look forward to providing you with exceptional service.</p>
                    </div>
                     <div class="email_footer" style="width:100%;margin-top: 20px;">
                            <h3 style=" font-size: 20px;font-weight: bolder;margin: 0;
                            border-bottom: 3px solid #6B7177;padding-bottom: 20px;
                            margin-bottom: 15px;">The VendorsCity Team</h3>
                            <div class="email_footer_div" style=" width:100%;
                            display: flex; ">
                                <div class="footer_left" style="width: 100px;
                            float: left;">
                                    <img style="width:70%;" src="'.asset("public/site/images/vcfaviconwap.png").'"" >
                                </div>
                                <div class="footer_right" style="margin-left:10px;
                                float: left;">
                                    <p style="margin:0;">Questions? Email <a style="color: #555;" href="mailto:support@vendorscity.com">support@vendorscity.com</a></p>
                                    <p  style="margin:0;">VendorsCity Portal LLC</p>
                                    <div class="footer_links" style=" margin:10px 0;">
                                <a href="'.url("/terms-of-service").'"  style="width: 100%;color: #555;display: inline-block;">Terms of Use</a>
                                <a href="'.url("/privacy-policy").'"  style="width: 100%;color: #555;display: inline-block;">Privacy Policy</a>
                                <a href="'.url("/contact").'"  style="width: 100%;color: #555;display: inline-block;">Contact Us</a>
                                </div>
                                   
                                </div>
                            </div>
                      </div>
                </div>
            </body>
 </html>';

                    
            $subject = "Service Booking Confirmation ".$orderdata->format_order_id."";
            $refer_id = $userdata['refer_id'];
            
            $system_percentage = DB::table('system')->first();
            $total = ($orderdata->order_total * $system_percentage->percentage /100);
            
            // echo $message_bodyy;exit;
        
            $to = $user_email;
            $ccRecipients = ['hello@vendorscity.com','zafar@quickserverelo.com'];
            // $to = "mayudin.hnrtechnologies@gmail.com";
            Mail::send([], [], function($message) use($message_bodyy, $to, $subject,$ccRecipients) {
                $message->to($to);
                $message->subject($subject);
                $message->from('devang.hnrtechnologies@gmail.com', 'Vendors City');
                foreach ($ccRecipients as $ccRecipient) {
                    $message->cc($ccRecipient);
                }
                $message->html($message_bodyy);
            });

 
 
     
         return true;
 
     }
     public function success_mail_book_now(){

        $userdata = Session::get('user');
        
        $order_number = Session::get('order_number');
        $format_order_id = Session::get('format_order_id');

        // echo"<pre>";print_r($order_number);echo"</pre>";
        // echo"<pre>";print_r($format_order_id);echo"</pre>";exit;
        $orderdata = DB::table('ci_orders')->where('order_id',$order_number)->first();

            // echo"<pre>";print_r($orderdata);echo"</pre>";exit;

        Session::put('order_payment_mode', $orderdata->paymentmode);

        if($orderdata->paymentmode == 1){
            $payment_mode = "Cash On Delivery";
        }else{
            $payment_mode = "Online Payment";
        }

        $order_item_data = DB::table('ci_order_item')->where('order_id',$order_number)->first();
       // echo"<pre>";print_r($order_item_data);echo"</pre>";exit;

       if($order_item_data->subservice_id == 47){
        $type_of_painting = DB::table('ci_order_item')->where('order_id',$order_number)->where('service_id',$order_item_data->service_id)->where('subservice_id',$order_item_data->subservice_id)->first();
       }else{
        $type_of_painting =array();
       }

        

        //echo"<pre>sss";print_r($type_of_painting);echo"</pre>";

        if(!empty($type_of_painting)){

            $service_name = $type_of_painting->type_of_painting;

            //Session::put('book_now_subservice_name_session', $type_of_painting_name);
        }else{
            $service_name = \Helper::subservicename(strval($order_item_data->subservice_id));
            //Session::put('book_now_subservice_name_session', $service_name);
        }
        Session::put('book_now_subservice_name_session', $service_name);
        //echo $service_name;exit;
        

        //$service_name = \Helper::subservicename(strval($order_item_data->subservice_id));

        

        if($order_item_data->how_often_do_you_need_cleaning != ''){
            $service_mail = $service_name ." - " .$order_item_data->how_often_do_you_need_cleaning . " for " .$order_item_data->how_many_hours_should_they_stay . " hours " . $order_item_data->how_many_cleaners_do_you_need . " cleaner(s)";

            $order_item_package_data = array();
        }else{
            $service_mail ='';
            $order_item_package_data = DB::table('ci_order_item_packages')
                                        ->where('order_id',$order_number)
                                        ->where('order_item_id',$order_item_data->id)
                                        ->get()->toArray();
        }

        //echo"<pre>";print_r($order_item_package_data);echo"</pre>";exit;
        

        if($order_item_data->which_day_of_the_week_do_you_want_the_service != ''){
            $when = $order_item_data->which_day_of_the_week_do_you_want_the_service." " .$order_item_data->bookingdate . " ".$order_item_data->month. ", " .$order_item_data->bookingyear. " at " .$order_item_data->time_slot;
        }else{
            $when = $order_item_data->bookingdate . " ".$order_item_data->month. ", " .$order_item_data->bookingyear;
        }

        $Where = $order_item_data->city . ", ".$order_item_data->area. ", " .$order_item_data->building_street_no. ", " .$order_item_data->apartment_villa_no;

        $total_new = $orderdata->sub_total * 5/100; 
        
        $total = $orderdata->sub_total + $total_new - $orderdata->front_wallet_amount; 
        $total = floor($total);
                
        $user_name = $userdata['name'];
        $user_email = $userdata['email'];


        $message_bodyy ='';
        if($orderdata->order_from == 1 && $orderdata->order_from != 2){
             $message_bodyy .='<!doctype html>
 
 <html lang="en">
 <head>
 <meta charset="utf-8">
 <title>Account Registration:</title>
 <style>
     .logo {
         border-bottom: 4px solid #FFD413;
     }
     .logo img{
         width: 45%;
     }
     .wrapper {
         width: 100%;
         max-width:500px;
         margin:auto;
         font-size:14px;
         line-height:24px;
         font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;
         color:#555;
         padding:50px 0;
     }   
     .email_wrapper {
         width:100%;
         margin-top: 18px;
         font-size: 16px;
     }
     h2 {
         font-size: 26px;
         font-weight: bolder;
         margin: 0;
     }
     .btnlink {
         background: #0040E6;
         color: #fff !important;
         text-decoration: none;
         width: 100%;
         display: block;
         padding: 9px 0;
         text-align: center;
         font-size: 16px;
         border-radius: 9px;
     }
     .email_footer {
         width:100%;
         margin-top: 20px;
     }
     h3 {
         font-size: 20px;
         font-weight: bolder;
         margin: 0;
         border-bottom: 3px solid #6B7177;
         padding-bottom: 20px;
         margin-bottom: 15px;
     }
     .email_footer_div {
         width:100%;
         display: flex; 
     }
     .footer_left {
         width: 100px;
         float: left;
     }
     .footer_right {
         margin-left:10px;
         float: left;
     }
     .footer_right p{
         margin:0;
     }
     .footer_links {
         margin:10px 0;
     }
     .footer_links a {
         width: 100%;
         color: #555;
         display: inline-block;
     }

     .custom_col_2{
        width: 18%;
    display: inline-block;
    }

    .custom_col_8{
        width: 75%;
    display: inline-block;
    }

    .custom_col_2_payment{
        width: 29%;
    display: inline-block;
    }

    .custom_col_8_payment{
        width: 70%;
        text-align: right;
    display: inline-block;
    }
        .main_row{margin:10px 0;}
    .custom_col_2 h5{font-size: 17px;margin: 0;}
    .custom_col_8 p{margin: 0;}

    .custom_col_2_payment h5{font-size: 17px;margin: 0;}
    .custom_col_8_payment p{margin: 0;}
 </style>
</head>
<body>
<div class="wrapper" style="width: 100%;max-width:500px;margin:auto;
                            font-size:14px;line-height:24px;
                            font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;color:#555;padding:50px 0;">
    <div class="logo" style="float: inherit;border-bottom: 4px solid #FFD413;">
    <img src="'.asset("public/site/images/VC-FULL-COLOR.png").'"" style="width: 40%;" >
    </div>

     <div class="email_wrapper" style="width:100%;margin-top: 18px;font-size: 16px;" >
                        <p> <strong> Dear </strong>'.$user_name.',</p>
                        <p>Thank you for choosing VendorsCity! We\'re pleased to confirm your '.$service_name.' cleaning service booking.</p>

                       <!--<p>A Super Cleaner is:</p>
                       <ul>
                        <li>One of our highest rated cleaners</li>
                        <li>Rated 4.75 out of 5 by over 1000 customers</li>
                        <li>Highly trained, experienced, and ready to make your home shine</li>
                       </ul> -->

                       <div class="heading" style="font-weight: bold;font-size: 20px;margin-top: 7%;">
                        Here are the details of your service:
                        </div>
                       <hr>
                       <div class="main">
                            <div class="row main_row" style="margin:10px 0;">

                                <div class="col-lg-2 custom_col_2" style="width: 100%;
                                display: inline-block;">
                                <ul style="margin: 0;padding: 0"><li>
                                    <h5 style="font-size: 14px;margin: 0;">Service Type:';
                                if(!empty($order_item_package_data)){
                                    foreach($order_item_package_data as $package_data){
                                        $message_bodyy .='<p style="margin: 0;">'.$package_data->package_item_name.' * '.$package_data->package_quantity.'</p>';
                                    }
                                }else{
                                    $message_bodyy .='<span style="margin: 0;font-weight:100;">'.$service_name.'</span></h5></li></ul>';
                                }
                                $message_bodyy .='</div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">
                                <div class="col-lg-2 custom_col_2" style="width: 100%;
                                display: inline-block;">
                                <ul style="margin: 0;padding: 0"><li>
                                    <h5 style="font-size: 14px;margin: 0;">Date: <span style="margin: 0;font-weight:100;"> '.$when.' </span></h5>
                                    </li></ul>
                                </div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">
                                <div class="col-lg-2 custom_col_2" style="width: 100%;
                                display: inline-block;">
                                <ul style="margin: 0;padding: 0"><li>
                                    <h5 style="font-size: 14px;margin: 0;">Time: 
                                     <span style="margin: 0;font-weight:100;"> '.\Helper::timeslotname($order_item_data->time_slot).'</span></h5> </li></ul>
                                </div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">
                                <div class="col-lg-2 custom_col_2" style="width: 100%;
                                display: inline-block;">
                                <ul style="margin: 0;padding: 0"><li>
                                    <h5 style="font-size: 14px;margin: 0;">No. of Cleaners: 
                                     <span style="margin: 0;font-weight:100;"> '.$order_item_data->how_many_cleaners_do_you_need.' Cleaner(s)</span></h5> </li></ul>
                                </div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">
                                <div class="col-lg-2 custom_col_2" style="width: 100%;
                                display: inline-block;">
                                <ul style="margin: 0;padding: 0"><li>
                                    <h5 style="font-size: 14px;margin: 0;">No. of Hours: 
                                     <span style="margin: 0;font-weight:100;"> '.$order_item_data->how_many_hours_should_they_stay.' Hours</span></h5> </li></ul>
                                </div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">
                                <div class="col-lg-2 custom_col_2" style="width: 100%;
                                display: inline-block;">
                                <ul style="margin: 0;padding: 0"><li>
                                    <h5 style="font-size: 14px;margin: 0;">Frequency:
                                     <span style="margin: 0;font-weight:100;"> '.$order_item_data->how_often_do_you_need_cleaning.'</span></h5> </li></ul>
                                </div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">
                                <div class="col-lg-2 custom_col_2" style="width: 100%;
                                display: inline-block;">
                                <ul style="margin: 0;padding: 0"><li>
                                    <h5 style="font-size: 14px;margin: 0;">Material:
                                     <span style="margin: 0;font-weight:100;"> '.$order_item_data->do_you_need_cleaning_material.'</span></h5> </li></ul>
                                </div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">
                                <div class="col-lg-2 custom_col_2" style="width: 100%;
                                display: inline-block;">
                                <ul style="margin: 0;padding: 0"><li>
                                    <h5 style="font-size: 14px;margin: 0;">Address:
                                     <span style="margin: 0;font-weight:100;"> '.$Where.'</span></h5> </li></ul>
                                </div>
                             </div>
                       </div>
                        <p>Our professional cleaning team will arrive promptly at the scheduled time, equipped with everything needed to leave your 
                        '.$service_name.' spotless.</p>.';

                    if($orderdata->paymentmode == '1' && $order_item_data->how_often_do_you_need_cleaning == "Weekly"){
                    $message_bodyy .='<h5 style="font-size: 14px;margin: 0;">Weekly Payment:</h5>
                    <p>Since this is a <strong style="font-weight:700;">cash on delivery service </strong>, payment of amount AED <strong style="font-weight:1000;"> '.$total.'</strong>is due weekly in full upon completion of the service. Please have the payment ready for our team.</p>.';
                    }
                    if($orderdata->paymentmode == '2' && $order_item_data->how_often_do_you_need_cleaning == "Weekly"){
                    $message_bodyy .='<h5 style="font-size: 14px;margin: 0;">Weekly Payment:</h5>
                    <p>You will be debited each week from your original payment method for your service until you cancel your cleaning subscription with us. If you wish to cancel your subscription reach out to support@vendorscity.com or WhatsApp us at 056 836 3677 and we will sort it out.</p>.';
                    }
                    
                    if($orderdata->paymentmode == '1' && $order_item_data->how_often_do_you_need_cleaning == "Once"){
                    $message_bodyy .='<p>Since this is a <strong style="font-weight:700;">cash on delivery service </strong>, payment of amount AED <strong style="font-weight:1000;">'.$total.'</strong> is due in full upon completion of the service. Please have the payment ready for our team.</p>.';
                    }

                    $message_bodyy .='<h5 style="font-size: 14px;margin: 0;">Important Notes:</h5> 
                    <ul><li>
                    Please ensure someone is available at home to grant access to our team.</li>
                    <li>If you need to reschedule or have any special instructions, don\'t hesitate to reach out to us at 056 836 3677 or <a style="color: #555;" href="mailto:support@vendorscity.com">support@vendorscity.com</a>.</li>
                    <li>Charges may apply for last minute cancellations or rescheduling of service.</li>
                    </ul>
                    <p>We are excited to deliver an exceptional service experience for you.
                    The VendorsCity Team</p>

                    <div class="heading" style="font-weight: bold;font-size: 20px;
                        <div class="email_footer" style="width:100%;margin-top: 20px;">
                        <h3 style=" font-size: 20px;font-weight: bolder;margin: 0;
                        border-bottom: 3px solid #6B7177;padding-bottom: 20px;
                        margin-bottom: 15px;">The VendorsCity Team</h3>
                        <div class="email_footer_div" style=" width:100%;
                        display: flex; ">
                            <div class="footer_left" style="width: 100px;
                        float: left;">
                                <img style="width:70%;" src="'.asset("public/site/images/vcfaviconwap.png").'"" >
                            </div>
                            <div class="footer_right" style="margin-left:10px;
                            float: left;">
                                <p style="margin:0;">Questions? Email <a style="color: #555;" href="mailto:support@vendorscity.com">support@vendorscity.com</a></p>
                                <p style="margin:0;">VendorsCity Portal LLC</p>
                                <div class="footer_links" style=" margin:10px 0;">
                            <a href="'.url("/terms-of-service").'" style="width: 100%;color: #555;display: inline-block;">Terms of Use</a>
                            <a href="'.url("/privacy-policy").'" style="width: 100%;color: #555;display: inline-block;">Privacy Policy</a>
                            <a href="'.url("/contact").'" style="width: 100%;color: #555;display: inline-block;">Contact Us</a>
                            </div>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </body>

 
     
 
 </html>';
//  echo $message_bodyy;exit;

        $subject = " Confirmation of Your $service_name Service Booking .'$orderdata->format_order_id'. ";
    }else if($orderdata->order_from == 2 && $orderdata->order_from != 1){

        /* Email For Painting */

        $date = $order_item_data->bookingdate ?? "";
        $month = $order_item_data->month ?? "";
        $year = $order_item_data->bookingyear ?? "";

        $timeSlot = Helper::timeslotname(strval($order_item_data->time_slot));

        if($date != '' && $month != '' && $year != ''){

            $date_and_time = $month.' '.$date.', '.$year;
        
        }else{
            $date_and_time = "-";
        }

        /* Address */
        $address_painting = $order_item_data->area.', '.$order_item_data->building_street_no.', '.$order_item_data->apartment_villa_no;

        $message_bodyy .='<!doctype html>
 
 <html lang="en">
 <head>
 <meta charset="utf-8">
 <title>Account Registration:</title>
 <style>
     .logo {
         border-bottom: 4px solid #FFD413;
     }
     .logo img{
         width: 45%;
     }
     .wrapper {
         width: 100%;
         max-width:500px;
         margin:auto;
         font-size:14px;
         line-height:24px;
         font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;
         color:#555;
         padding:50px 0;
     }   
     .email_wrapper {
         width:100%;
         margin-top: 18px;
         font-size: 16px;
     }
     h2 {
         font-size: 26px;
         font-weight: bolder;
         margin: 0;
     }
     .btnlink {
         background: #0040E6;
         color: #fff !important;
         text-decoration: none;
         width: 100%;
         display: block;
         padding: 9px 0;
         text-align: center;
         font-size: 16px;
         border-radius: 9px;
     }
     .email_footer {
         width:100%;
         margin-top: 20px;
     }
     h3 {
         font-size: 20px;
         font-weight: bolder;
         margin: 0;
         border-bottom: 3px solid #6B7177;
         padding-bottom: 20px;
         margin-bottom: 15px;
     }
     .email_footer_div {
         width:100%;
         display: flex; 
     }
     .footer_left {
         width: 100px;
         float: left;
     }
     .footer_right {
         margin-left:10px;
         float: left;
     }
     .footer_right p{
         margin:0;
     }
     .footer_links {
         margin:10px 0;
     }
     .footer_links a {
         width: 100%;
         color: #555;
         display: inline-block;
     }

     .custom_col_2{
        width: 18%;
    display: inline-block;
    }

    .custom_col_8{
        width: 75%;
    display: inline-block;
    }

    .custom_col_2_payment{
        width: 29%;
    display: inline-block;
    }

    .custom_col_8_payment{
        width: 70%;
        text-align: right;
    display: inline-block;
    }
        .main_row{margin:10px 0;}
    .custom_col_2 h5{font-size: 17px;margin: 0;}
    .custom_col_8 p{margin: 0;}

    .custom_col_2_payment h5{font-size: 17px;margin: 0;}
    .custom_col_8_payment p{margin: 0;}
 </style>
</head>
<body>
<div class="wrapper" style="width: 100%;max-width:500px;margin:auto;
                            font-size:14px;line-height:24px;
                            font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;color:#555;padding:50px 0;">
    <div class="logo" style="float: inherit;border-bottom: 4px solid #FFD413;">
    <img src="'.asset("public/site/images/VC-FULL-COLOR.png").'"" style="width: 40%;" >
    </div>

     <div class="email_wrapper" style="width:100%;margin-top: 18px;font-size: 16px;" >
                        <p>  Dear '.$user_name.',</p>';
                        if($orderdata->paymentmode == 1){
                            $message_bodyy .= '<p>Thank you for choosing VendorsCity! We\'re pleased to confirm your painting service booking.</p>';
                        }else{
                            $message_bodyy .= '<p>Thank you for choosing VendorsCity! We\'re pleased to confirm your painting service booking.</p>';
                        }

                       $message_bodyy .= '<!--<p>A Super Cleaner is:</p>
                       <ul>
                        <li>One of our highest rated cleaners</li>
                        <li>Rated 4.75 out of 5 by over 1000 customers</li>
                        <li>Highly trained, experienced, and ready to make your home shine</li>
                       </ul> -->

                       <div class="heading" style="font-weight: bold;font-size: 20px;margin-top: 7%;">
                        Here are the details of your service:
                        </div>
                       <hr>
                       <div class="main">
                            <div class="row main_row" style="margin:10px 0;">

                                <div class="col-lg-2 custom_col_2" style="width: 100%;
                                display: inline-block;">
                                <ul style="margin: 0;padding: 0"><li>
                                    <h5 style="font-size: 14px;margin: 0;">Service Type: ';
                                if(!empty($order_item_package_data)){
                                    foreach($order_item_package_data as $package_data){
                                        $message_bodyy .='<p style="margin: 0;">'.$package_data->package_item_name.' * '.$package_data->package_quantity.'</p>';
                                    }
                                }else{
                                    $message_bodyy .='<span style="margin: 0;font-weight:100;color: #000;">'.$service_name.'</span></h5></li></ul>';
                                }
                                $message_bodyy .='</div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">
                                <div class="col-lg-2 custom_col_2" style="width: 100%;
                                display: inline-block;">
                                <ul style="margin: 0;padding: 0"><li>
                                    <h5 style="font-size: 14px;margin: 0;">Date: <span style="margin: 0;font-weight:100;color: #000;"> '.$date_and_time.' </span></h5>
                                    </li></ul>
                                </div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">
                                <div class="col-lg-2 custom_col_2" style="width: 100%;
                                display: inline-block;">
                                <ul style="margin: 0;padding: 0"><li>
                                    <h5 style="font-size: 14px;margin: 0;">Time: 
                                     <span style="margin: 0;font-weight:100;color: #000;"> '.$timeSlot.'</span></h5> </li></ul>
                                </div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">
                                <div class="col-lg-2 custom_col_2" style="width: 100%; display: inline-block;">
                                <ul style="margin: 0;padding: 0"><li>
                                    <h5 style="font-size: 14px;margin: 0;">Service: 
                                     <span style="margin: 0;font-weight:100;color: #000;"> '.$order_item_data->type_of_painting.'</span></h5> </li></ul>
                                </div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">
                                <div class="col-lg-2 custom_col_2" style="width: 100%;
                                display: inline-block;">
                                <ul style="margin: 0;padding: 0"><li>
                                    <h5 style="font-size: 14px;margin: 0;">Size of Home: 
                                     <span style="margin: 0;font-weight:100;color: #000;"> '.$order_item_data->selected_type_home.' - '.$order_item_data->selected_size_home.'</span></h5> </li></ul>
                                </div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">
                                <div class="col-lg-2 custom_col_2" style="width: 100%;
                                display: inline-block;">
                                <ul style="margin: 0;padding: 0"><li>
                                    <h5 style="font-size: 14px;margin: 0;">Furnished:
                                     <span style="margin: 0;font-weight:100;color: #000;"> '.$order_item_data->is_home_furnished.'</span></h5> </li></ul>
                                </div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">
                                <div class="col-lg-2 custom_col_2" style="width: 100%;
                                display: inline-block;">
                                <ul style="margin: 0;padding: 0"><li>
                                    <h5 style="font-size: 14px;margin: 0;">Color:
                                     <span style="margin: 0;font-weight:100;color: #000;"> '.$order_item_data->your_walls_now_color.' to '.$order_item_data->you_want_paint_color.'</span></h5> </li></ul>
                                </div>
                             </div>';
                            
                             if($order_item_data->no_of_ceilings !=""){

                                $message_bodyy .= '<div class="row main_row" style="margin:10px 0;">
                                    <div class="col-lg-2 custom_col_2" style="width: 100%;
                                    display: inline-block;">
                                    <ul style="margin: 0;padding: 0"><li>
                                        <h5 style="font-size: 14px;margin: 0;">Ceilings:
                                        <span style="margin: 0;font-weight:100;color: #000;"> '.$order_item_data->no_of_ceilings.'</span></h5> </li></ul>
                                    </div>
                                </div>';
                             }

                             $message_bodyy .= '<div class="row main_row" style="margin:10px 0;">
                                    <div class="col-lg-2 custom_col_2" style="width: 100%;
                                    display: inline-block;">
                                    <ul style="margin: 0;padding: 0"><li>
                                        <h5 style="font-size: 14px;margin: 0;">Address:
                                        <span style="margin: 0;font-weight:100;color: #000;"> '.$address_painting.'</span></h5> </li></ul>
                                    </div>
                                </div>';

                       $message_bodyy .= '</div>';
                       if($orderdata->paymentmode == 1){
                            $message_bodyy .= '<p>Our professional painting team will arrive promptly at the scheduled time, prepared with everything necessary to give your home a fresh, vibrant look.</p>';

                            $message_bodyy .= '<p>Since this is a <strong style="font-weight:700;">cash on delivery</strong> service, payment of amount AED <strong style="font-weight:700;">'.$orderdata->order_total.'</strong> is due in full upon completion of the service. Please have the payment ready for our team.</p>';
                       }else{
                            $message_bodyy .= '<p>Our professional painting team will arrive promptly at the scheduled time, prepared with everything necessary to give your home a fresh, vibrant look.</p>';
                       }

                    $message_bodyy .='<h5 style="font-size: 14px;margin: 0;">Important Notes:</h5> 
                    <ul><li>
                    Please ensure someone is available at home to grant access to our team.</li>
                    <li>If you need to reschedule or have any specific color preferences or instructions, don’t hesitate to reach out to us at 056 836 3677 or <a style="color: #555;" href="mailto:support@vendorscity.com">support@vendorscity.com</a>.</li>
                    <li>Charges may apply for last-minute cancellations or rescheduling of service.</li>
                    </ul>
                    <p>We’re excited to provide you with an exceptional painting experience.<br/>
                    The VendorsCity Team</p>

                    <div class="heading" style="font-weight: bold;font-size: 20px;
                        <div class="email_footer" style="width:100%;margin-top: 20px;">
                        <h3 style=" font-size: 20px;font-weight: bolder;margin: 0;
                        border-bottom: 3px solid #6B7177;padding-bottom: 20px;
                        margin-bottom: 15px;">The VendorsCity Team</h3>
                        <div class="email_footer_div" style=" width:100%;
                        display: flex; ">
                            <div class="footer_left" style="width: 100px;
                        float: left;">
                                <img style="width:70%;" src="'.asset("public/site/images/vcfaviconwap.png").'"" >
                            </div>
                            <div class="footer_right" style="margin-left:10px;
                            float: left;">
                                <p style="margin:0;">Questions? Email <a style="color: #555;" href="mailto:support@vendorscity.com">support@vendorscity.com</a></p>
                                <p style="margin:0;">VendorsCity Portal LLC</p>
                                <div class="footer_links" style=" margin:10px 0;">
                            <a href="'.url("/terms-of-service").'" style="width: 100%;color: #555;display: inline-block;">Terms of Use</a>
                            <a href="'.url("/privacy-policy").'" style="width: 100%;color: #555;display: inline-block;">Privacy Policy</a>
                            <a href="'.url("/contact").'" style="width: 100%;color: #555;display: inline-block;">Contact Us</a>
                            </div>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </body>
        </html>';

        $subject = " Confirmation of Your $service_name Booking .'$orderdata->format_order_id'. ";
    }

     
        $system_percentage = DB::table('system')->first();
        $total = ($orderdata->order_total * $system_percentage->percentage /100);

            // echo $total;exit;
        if(isset($userdata['refer_id']) && $userdata['refer_id'] !='')
        {
            $existing_wallet = DB::table('front_user_wallet')->where('userid', $userdata['userid'])->first();
            if(!$existing_wallet){
            $data['userid']=$userdata['userid'];
            $data['refer_id']=$userdata['refer_id'];
            $data['order_currency']=$orderdata->order_currency;
            $data['wallet_amount']=$total;
            $data['system_percentage']=$system_percentage->percentage;
            $data['order_total']=$orderdata->order_total;
            $data['added_date']=date('Y-m-d');
        
            DB::table('front_user_wallet')->insert($data);
            }
        }
       $to = $user_email;
        //$to = 'devang.hnrtechnologies@gmail.com';
        $ccRecipients = ['hello@vendorscity.com','zafar@quickserverelo.com'];
         Mail::send([], [], function($message) use($message_bodyy, $to, $subject,$ccRecipients) {
             $message->to($to);
             $message->subject($subject);
             foreach ($ccRecipients as $ccRecipient) {
                $message->cc($ccRecipient);
            }
             $message->html($message_bodyy);
         });

         return true;

        // echo"<pre>";print_r($order_item_data);echo"</pre>";exit;
     }

     function success_mail_painting_enquiry(){

        $userdata = Session::get('user');
        $user_email = $userdata['email'];
        $user_name = $userdata['name'];

        //echo "<pre>";print_r(Session::get('enquiry_user_data'));echo "</pre>";exit;
        $paintingServiceName = Session::get('enquiry_user_data')['type_of_painting'];
        $message_bodyy = "";
        $message_bodyy .='<!doctype html>

  
        <head>
        <meta charset="utf-8">
        <title>Painting Enquiry:</title>
        <style>
            .logo {
                border-bottom: 4px solid #FFD413;
            }
            .logo img{
                width: 45%;
            }
            .wrapper {
                width: 100%;
                max-width:500px;
                margin:auto;
                font-size:14px;
                line-height:24px;
                font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;
                color:#555;
                padding:50px 0;
            }   
            .email_wrapper {
                width:100%;
                margin-top: 18px;
                font-size: 16px;
            }
            h2 {
                font-size: 26px;
                font-weight: bolder;
                margin: 0;
            }
            .btnlink {
                background: #0040E6;
                color: #fff !important;
                text-decoration: none;
                width: 100%;
                display: block;
                padding: 9px 0;
                text-align: center;
                font-size: 16px;
                border-radius: 9px;
            }
            .email_footer {
                width:100%;
                margin-top: 20px;
            }
            h3 {
                font-size: 20px;
                font-weight: bolder;
                margin: 0;
                border-bottom: 3px solid #6B7177;
                padding-bottom: 20px;
                margin-bottom: 15px;
            }
            .email_footer_div {
                width:100%;
                display: flex; 
            }
            .footer_left {
                width: 100px;
                float: left;
            }
            .footer_right {
                margin-left:10px;
                float: left;
            }
            .footer_right p{
                margin:0;
            }
            .footer_links {
                margin:10px 0;
            }
            .footer_links a {
                width: 100%;
                color: #555;
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <div class="wrapper" style="width: 100%;max-width:500px;margin:auto;
                        font-size:14px;line-height:24px;font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;color:#555;padding:50px 0;">
            <div class="logo"style="float: inherit;border-bottom: 4px solid #FFD413;">
            <img src="'.asset("public/site/images/VC-FULL-COLOR.png").'"" style="width: 40%;"  >
            </div>
            <div class="email_wrapper" style="width:100%;margin-top: 18px;font-size: 16px;" >
                <p>Dear '.$user_name.',</p>
                <p>Thank you for reaching out to VendorsCity! We have received your request for up to 5 free quotes for '. $paintingServiceName. '.</p>
                <p><strong>What Happens Next?</strong></p>
    
                <p>Our trusted vendors will review your request and will contact you within 2 business days. You will receive up to 5 quotes tailored to your specific painting needs.</p>
                <p><strong>How to Choose the Best Vendor:</strong></p>
                <ul><li style= "list-style-type: disc;margin-bottom: -15px;">Review the quotes you receive.</li>
                <li style= "list-style-type: disc;margin-bottom: -15px;">Check out the vendor ratings and reviews to make an informed decision.</li>
                <li style= "list-style-type: disc";>Select the vendor that best suits your requirements.</li></ul>  
                <p>We are committed to helping you find the best services quickly and easily. If you have any questions or need further assistance, please don&#39;t hesitate to contact us at <a href="mailto:support@vendorscity">support@vendorscity.com</a>.
                </p> 
                
                <p>Thank you for choosing VendorsCity!</p>
               
            </div>
              <div class="email_footer" style="width:100%;margin-top: 20px;">
                                <h3 style=" font-size: 20px;font-weight: bolder;margin: 0;
                                border-bottom: 3px solid #6B7177;padding-bottom: 20px;
                                margin-bottom: 15px;">The VendorsCity Team</h3>
                                <div class="email_footer_div" style=" width:100%;
                                display: flex; ">
                                    <div class="footer_left" style="width: 100px;
                                float: left;">
                                        <img style="width:70%;" src="'.asset("public/site/images/vcfaviconwap.png").'"" >
                                    </div>
                                    <div class="footer_right" style="margin-left:10px;
                                    float: left;">
                                        <p style="margin:0;">Questions? Email <a style="color: #555;" href="mailto:support@vendorscity.com">support@vendorscity.com</a></p>
                                        <p  style="margin:0;">VendorsCity Portal LLC</p>
                                        <div class="footer_links" style=" margin:10px 0;">
                                    <a href="'.url("/terms-of-service").'"  style="width: 100%;color: #555;display: inline-block;">Terms of Use</a>
                                    <a href="'.url("/privacy-policy").'"  style="width: 100%;color: #555;display: inline-block;">Privacy Policy</a>
                                    <a href="'.url("/contact").'"  style="width: 100%;color: #555;display: inline-block;">Contact Us</a>
                                    </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </body>
                    </html>';

       $subject = " Your Request for Free Quotes on Painting is being Processed!";
    
        
      
       $to = $user_email;
       $ccRecipients = ['hello@vendorscity.com','zafar@quickserverelo.com'];
       $system_percentage = DB::table('system')->first();
       $total = ($orderdata->order_total * $system_percentage->percentage /100);

            // echo $total;exit;
        if(isset($userdata['refer_id']) && $userdata['refer_id'] !='')
        {
            $existing_wallet = DB::table('front_user_wallet')->where('userid', $userdata['userid'])->first();
            if(!$existing_wallet){
            $data['userid']=$userdata['userid'];
            $data['refer_id']=$userdata['refer_id'];
            $data['order_currency']=$orderdata->order_currency;
            $data['wallet_amount']=$total;
            $data['system_percentage']=$system_percentage->percentage;
            $data['order_total']=$orderdata->order_total;
            $data['added_date']=date('Y-m-d');
            
            DB::table('front_user_wallet')->insert($data);
            }
        }
        // $ccRecipients = array();
        // $to = "mayudin.hnrtechnologies@gmail.com";
        Mail::send([], [], function($message) use($message_bodyy, $to, $subject,$ccRecipients) {
            $message->to($to);
            $message->subject($subject);
            foreach ($ccRecipients as $ccRecipient) {
                $message->cc($ccRecipient);
            }
            $message->html($message_bodyy);
        });
    }

     function thankyou_book_now(){

        \Cart::destroy(); 
        session()->forget('coupan_data');
        session()->forget('shippingcahrge');
        session()->forget('discount_amount');
        session()->forget('order_total');
        session()->forget('stripe_session_id');
        session()->forget('walletdiscount');
        session()->forget('user_wallet_amount');

        $data['meta_title'] = "";
       $data['meta_keyword'] = "";
       $data['meta_description'] = "";

       $data['message'] =  "Book Now";
        return view('front.thank_you_book_now',$data);
     }
     function thankyou_painting(){

        \Cart::destroy(); 
        session()->forget('coupan_data');
        session()->forget('shippingcahrge');
        session()->forget('discount_amount');
        session()->forget('order_total');
        session()->forget('stripe_session_id');
        session()->forget('walletdiscount');
        session()->forget('user_wallet_amount');

        $data['meta_title'] = "";
       $data['meta_keyword'] = "";
       $data['meta_description'] = "";

       $data['message'] =  "Book Now";
        return view('front.thank_you_painting',$data);
     }

     function thankyou(){
        \Cart::destroy(); 
        session()->forget('coupan_data');
        session()->forget('shippingcahrge');
        session()->forget('discount_amount');
        session()->forget('order_total');
        session()->forget('stripe_session_id');
        session()->forget('walletdiscount');
        session()->forget('user_wallet_amount');
        
       //echo "here";exit;
       $data['meta_title'] = "";
       $data['meta_keyword'] = "";
       $data['meta_description'] = "";

       $data['message'] =  "Thank you for choosing VendorsCity! Your order has been successfully processed. A detailed confirmation email has been sent to your registered email address. If you need any assistance or have questions, please don't hesitate to contact us at support@vendorscity.com or call us at 056 VENDORS (056 836 3677). We're here to help!";

       return view('front.thank_you',$data);
   }

    function bill_state_change(){

        $country_id=$_POST['country_id'];

        $result=DB::table('states')
                    ->select('*')
                    ->where('country_id','=',$country_id)
                    ->get();

            $result_new=$result->toArray();
            // echo"<pre>";print_r($result_new);echo"</pre>";exit;
            $html  ="<select name='state_name' id='state_name' class='form-control' onchange='ship_state_change(this.value);'>";
            $html .="<option value=''>Select State</option>";
            if($result !='' &&  count($result)>0){
    
                for($i=0; $i<count($result); $i++){
                    
                    $html .="<option value='".$result[$i]->id."'>".$result[$i]->state."</option>";
                }
            }
            $html  .="<select>";
            echo $html;
    }

    function ship_state_change(){

        $country_id=$_POST['country'];
        $state_id=$_POST['state_id'];

        $result=DB::table('cities')
                    ->select('*')
                    ->where('country','=',$country_id)
                    ->where('state','=',$state_id)
                    ->get();

            $result_new=$result->toArray();
            // echo"<pre>";print_r($result_new);echo"</pre>";exit;
            $html  ="<select name='city' id='city' class='form-control'>";
            $html .="<option value=''>Select Town / City</option>";
            if($result !='' &&  count($result)>0){
    
                for($i=0; $i<count($result); $i++){
                    
                    $html .="<option value='".$result[$i]->id."'>".$result[$i]->name."</option>";
                }
            }
            $html  .="<select>";
            echo $html;
    }

    function apply_wallet_dicount(Request $request)
    {
        // echo"<pre>";print_r($request->all());echo"</pre>";exit;

        $walletdiscount = $request->total_wallet_amount;
        $userWalletamount = $request->userWalletamount;
        Session::put('walletdiscount',$walletdiscount);
        Session::put('user_wallet_amount',$userWalletamount);
        
        $sessionWalletAmt = Session::get('walletdiscount',$walletdiscount);
        echo $sessionWalletAmt;  

    }
    function cancel_wallet_dicount(Request $request)
    {
        // echo"<pre>";print_r($request->all());echo"</pre>";exit;

        $walletdiscount = $request->orderTotal;
        $userWalletamount = $request->userWalletAmount;
        Session::put('walletdiscount',$walletdiscount);
        Session::put('user_wallet_amount',$userWalletamount);
        
        $sessionuserWalletamount = Session::get('user_wallet_amount',$userWalletamount);
        echo $sessionuserWalletamount;  

    }

    

}