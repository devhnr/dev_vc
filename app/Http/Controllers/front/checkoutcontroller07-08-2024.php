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

        //echo "<pre>";print_r($data);echo"</pre>";exit;
        return view('front.checkout',$data);
    }

    function order_place(Request $request){
       
        $userdata = Session::get('user');   


        //echo "<pre>";print_r(Session::get('user_wallet_amount'));echo"</pre>";exit;
    //    echo "<pre>";print_r($request->post());echo"</pre>";exit;

        

        $cart = \Cart::content();
        //echo "<pre>";print_r(Session::get('walletdiscount'));echo"</pre>";
       // exit;

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

        $content=array(
            'user_id'               => $userid,
            'order_number'          => $order_number,
            'order_total'           => session('order_total'),
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

        $walletdiscount = Session::get('walletdiscount') ?? "";
        $userWalletamount = Session::get('user_wallet_amount') ?? "";
        if ($walletdiscount !="" && $userWalletamount != "") {

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

        //echo "<pre>";print_r($request->all());echo"</pre>";exit;

        $userdata = Session::get('user'); 

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

        $order_total = $request->total_to_pay;
        $vat_total = $request->vat_total;

        $order_from = 1; // booking form data

        $content=array(
            'user_id'               => $userid,
            'order_number'          => $order_number,
            'order_total'           => $order_total,
            'vatcharge'             => $vat_total,
            'order_currency'        => 'AED',
            'order_status'          => $order_status,
            'paymentmode'           => $paymentmode,
            'payment_status'        => $payment_status,
            'created_at'            => date('Y-m-d H:i:s'),
            //'ip_address'            => $_SERVER['REMOTE_ADDR'],
            'list_order_status'     => $list_order_status,
            'service_charge'     => $request->service_charge,
            'additional_charge'     => $request->additional_charge,
            'sub_total'     => $request->sub_total,
            'cod_charge'     => $request->cod_charge,
            'service_fee'     => $request->service_fee,
            'order_from'     => $order_from,
        );

        $arrOrderId = DB::table('ci_orders')->insertGetId($content);

        $year =date('y');
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
            'which_day_of_the_week_do_you_want_the_service'                            => $which_day_of_the_week_do_you_want_the_service ,
            'cdate'                                => date('Y-m-d'),

            );

        $order_item_id = DB::table('ci_order_item')->insertGetId($arrData);

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
        //}

        if($payment_type == 'COD'){
            $success = $this->success_mail_book_now();
            if ($success) {
                // Redirect to the 'thankyou' route
                return redirect('thankyou_book_now');
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

                $success = $this->success_mail();
                if ($success) {
                    // Redirect to the 'thankyou' route
                    return redirect('thankyou');
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

           return view('front.thank_you',$data);
        
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
            $data['userid']=$userdata['userid'];
            $data['refer_id']=$userdata['refer_id'];
            $data['order_currency']=$orderdata->order_currency;
            $data['wallet_amount']=$total;
            $data['system_percentage']=$system_percentage->percentage;
            $data['order_total']=$orderdata->order_total;
            $data['added_date']=date('Y-m-d');
           
            DB::table('front_user_wallet')->insert($data);
        }

        //  $to = 'devang.hnrtechnologies@gmail.com';
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
            $ccRecipients = ['support@vendorscity.com'];
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
        $orderdata = DB::table('ci_orders')->where('order_number',$order_number)->first();

       // echo"<pre>";print_r($orderdata);echo"</pre>";exit;

        Session::put('order_payment_mode', $orderdata->paymentmode);

        if($orderdata->paymentmode == 1){
            $payment_mode = "Cash On Delivery";
        }else{
            $payment_mode = "Online Payment";
        }

        $order_item_data = DB::table('ci_order_item')->where('order_id',$order_number)->first();

        

        $service_name = \Helper::subservicename(strval($order_item_data->subservice_id));

        Session::put('book_now_subservice_name_session', $service_name);

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
            $when = $order_item_data->bookingdate . " ".$order_item_data->month. ", " .$order_item_data->bookingyear. " at " .$order_item_data->time_slot;
        }

        $Where = $order_item_data->city . ", ".$order_item_data->area. ", " .$order_item_data->building_street_no. ", " .$order_item_data->apartment_villa_no;
        
        
        $user_name = $userdata['name'];
        $user_email = $userdata['email'];


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
                        <p>Your booking is confirmed and you have been matched with one of our Super Cleaners at no additional cost!</p>

                       <p>A Super Cleaner is:</p>
                       <ul>
                        <li>One of our highest rated cleaners</li>
                        <li>Rated 4.75 out of 5 by over 1000 customers</li>
                        <li>Highly trained, experienced, and ready to make your home shine</li>
                       </ul>

                       <div class="heading" style="font-weight: bold;font-size: 20px;margin-top: 7%;">Booking details</div>
                       <hr>
                       <div class="main">
                            <div class="row main_row" style="margin:10px 0;">

                                <div class="col-lg-2 custom_col_2" style="width: 18%;
                                display: inline-block;">
                                    <h5 style="font-size: 17px;margin: 0;">Service</h5>
                                </div>
                                <div class="col-lg-8 custom_col_8" style=" width: 75%;
                                display: inline-block;">';

                                if(!empty($order_item_package_data)){
                                    foreach($order_item_package_data as $package_data){
                                        $message_bodyy .='<p style="margin: 0;">'.$package_data->package_item_name.' * '.$package_data->package_quantity.'</p>';
                                    }

                                }else{
                                    $message_bodyy .='<p style="margin: 0;">'.$service_mail.'</p>';
                                }
                                    


                                $message_bodyy .='</div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">

                                <div class="col-lg-2 custom_col_2" style="width: 18%;
                                display: inline-block;">
                                    <h5 style="font-size: 17px;margin: 0;">When</h5>
                                </div>
                                <div class="col-lg-8 custom_col_8" style=" width: 75%;
                                display: inline-block;">
                                    <p style="margin: 0;">'.$when.'</p>
                                </div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">

                                <div class="col-lg-2 custom_col_2" style="width: 18%;
                                display: inline-block;">
                                    <h5 style="font-size: 17px;margin: 0;">Where</h5>
                                </div>
                                <div class="col-lg-8 custom_col_8" style=" width: 75%;
                                display: inline-block;">
                                    <p style="margin: 0;">'.$Where.'</p>
                                </div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">

                                <div class="col-lg-2 custom_col_2" style="width: 18%;
                                display: inline-block;">
                                    <h5 style="font-size: 17px;margin: 0;">Order ID</h5>
                                </div>
                                <div class="col-lg-8 custom_col_8" style=" width: 75%;
                                display: inline-block;">
                                    <p style="margin: 0;">'.$format_order_id.'</p>
                                </div>
                             </div>

                             
                       </div>

                       <div class="heading" style="font-weight: bold;font-size: 20px;margin-top: 7%;">Payment details</div>
                       <hr>
                       <div class="main">
                            <div class="row main_row" style="margin:10px 0;">

                                <div class="col-lg-2 custom_col_2_payment" style="  width: 29%;display: inline-block;">
                                    <h5 style="font-size: 17px;margin: 0;">Service Charges</h5>
                                </div>
                                <div class="col-lg-8 custom_col_8_payment" style=" width: 70%;text-align: right;display: inline-block;">
                                    <p style="margin: 0;">AED '.$orderdata->sub_total.'</p>
                                </div>
                             </div>

                             <div class="row main_row" style="margin:10px 0;">

                                <div class="col-lg-2 custom_col_2_payment" style="  width: 29%;display: inline-block;">
                                    <h5 style="font-size: 17px;margin: 0;">VAT</h5>
                                </div>
                                <div class="col-lg-8 custom_col_8_payment" style=" width: 70%;text-align: right;display: inline-block;">
                                    <p style="margin: 0;">AED '.$orderdata->vatcharge.'</p>
                                </div>
                             </div>
                       </div>

                        <hr>

                        <div class="main">
                            <div class="row main_row" style="margin:10px 0;">

                                <div class="col-lg-2 custom_col_2_payment" style="  width: 29%;display: inline-block;">
                                    <h5 style="font-size: 17px;margin: 0;">Total</h5>
                                </div>
                                <div class="col-lg-8 custom_col_8_payment" style=" width: 70%;text-align: right;display: inline-block;">
                                    <p  style="margin: 0;">AED '.$orderdata->order_total.'</p>
                                </div>
                             </div>
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

        $subject = "Your booking is confirmed";

       $to = $user_email;
        //$to = 'devang.hnrtechnologies@gmail.com';
         Mail::send([], [], function($message) use($message_bodyy, $to, $subject) {
             $message->to($to);
             $message->subject($subject);
             $message->html($message_bodyy);
         });

         return true;

        // echo"<pre>";print_r($order_item_data);echo"</pre>";exit;
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
        $walletdiscount = $request->total_wallet_amount;
        $userWalletamount = $request->userWalletamount;
        Session::put('walletdiscount',$walletdiscount);
        Session::put('user_wallet_amount',$userWalletamount);
        $sessionWalletAmt = Session::get('walletdiscount',$walletdiscount);
        echo $sessionWalletAmt;   
    }

    

}