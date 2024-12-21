<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Order;
use DB;
use Illuminate\Support\Facades\Mail;
class Ordercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($order_id = '', $status = '')
    {
        $data['error'] = '';
        //$data['subscribe_data'] = Subscribe::orderBy('id','DESC')->get();    
        $query = DB::table('ci_orders')
        ->leftJoin('frontloginregisters', 'ci_orders.user_id', '=', 'frontloginregisters.id')
        ->select(
            'frontloginregisters.email as user_email',
            'frontloginregisters.name as user_name',
            'frontloginregisters.mobile as user_mobile',
            'ci_orders.*'
        );
        if (!empty($order_id)) {
            $query->where('ci_orders.order_id', $order_id);
        }
    
        if (!empty($status)) {
            if ($status == 'SUCCESS' || $status == 'FAILED') {
                $query->where('ci_orders.payment_status', $status);
            } else {
                $query->where('ci_orders.order_status', $status);
            }
        }
    
        $query->orderBy('ci_orders.order_id', 'DESC');
    
        // Get distinct orders where service_id is 45
        $orderList = $query->get();
        foreach ($orderList as $order) {
            $itemList = DB::table('ci_order_item')
                ->where('order_id', $order->order_id)
                ->where('service_id', 30)
                ->get();
    
            $total = 0;
    
            // echo"<pre>";print_r($itemList);echo"</pre>";
    
    
            foreach ($itemList as $item) {
                $product = DB::table('packages')
                    ->where('id', $item->package_id)
                    ->first();
    
                    // echo"<pre>";print_r($product);echo"</pre>";exit;
                    
    
                if($item->product_discount_amount != 0 && $item->product_discount_amount != '') {
                    $product_item_price = $item->product_discount_amount;
                } else {
                    $product_item_price = $item->package_item_price;
                }
    
                $total += $product_item_price * $item->package_quantity;
            }
    
            // Attach the items and subtotal to the order object
            $order->items = $itemList;
            $order->sub_total = $total;
        }
    
        $data['orders_list'] = $orderList;
    
        // echo"<pre>";print_r($data);echo"</pre>";exit;
    
        return view('admin.list_order', $data);
    }
    public function cleaning_package_order($order_id = '', $status = '')
    {
        $data['error'] = '';
        // First, fetch distinct orders
        $query = DB::table('ci_orders')
            ->leftJoin('frontloginregisters', 'ci_orders.user_id', '=', 'frontloginregisters.id')
            ->select(
                'frontloginregisters.email as user_email',
                'frontloginregisters.name as user_name',
                'frontloginregisters.mobile as user_mobile',
                'ci_orders.*'
            );
        $query = $query->where('order_from','!=',2); 
        if (!empty($order_id)) {
            $query->where('ci_orders.order_id', $order_id);
        }
        if (!empty($status)) {
            if ($status == 'SUCCESS' || $status == 'FAILED') {
                $query->where('ci_orders.payment_status', $status);
            } else {
                $query->where('ci_orders.order_status', $status);
            }
        }
        $query->orderBy('ci_orders.order_id', 'DESC');
        // Get distinct orders where service_id is 45
        $orderList = $query->get();
        // Now, for each order, fetch its items
        foreach ($orderList as $order) {
            $itemList = DB::table('ci_order_item')
                ->where('order_id', $order->order_id)
                ->where('service_id', 45)
                ->get();
            $total = 0;
            // echo"<pre>";print_r($itemList);echo"</pre>";
            foreach ($itemList as $item) {
                $product = DB::table('packages')
                    ->where('id', $item->package_id)
                    ->first();
                    // echo"<pre>";print_r($product);echo"</pre>";exit;
                    
                if($item->product_discount_amount != 0 && $item->product_discount_amount != '') {
                    $product_item_price = $item->product_discount_amount;
                } else {
                    $product_item_price = $item->package_item_price;
                }
                $total += $product_item_price * $item->package_quantity;
            }
            // Attach the items and subtotal to the order object
            $order->items = $itemList;
            $order->sub_total = $total;
        }
        $data['orders_list'] = $orderList;
       // echo"<pre>";print_r($data);echo"</pre>";exit;
        return view('admin.list_order', $data);
    }

    public function painting_service_order($order_id = '', $status = '')
    {
        $data['error'] = '';
        // First, fetch distinct orders
        $query = DB::table('ci_orders')
            ->leftJoin('frontloginregisters', 'ci_orders.user_id', '=', 'frontloginregisters.id')
            ->select(
                'frontloginregisters.email as user_email',
                'frontloginregisters.name as user_name',
                'frontloginregisters.mobile as user_mobile',
                'ci_orders.*'
            )
            ->where('order_from', '=', 2)
            ->where('order_from', '!=', 0)
            ->where('order_from', '!=', 1);

        if (!empty($order_id)) {
            $query->where('ci_orders.order_id', $order_id);
        }

        if (!empty($status)) {
            if ($status == 'SUCCESS' || $status == 'FAILED') {
                $query->where('ci_orders.payment_status', $status);
            } else {
                $query->where('ci_orders.order_status', $status);
            }
        }

        $query->orderBy('ci_orders.order_id', 'DESC');

        // Get distinct orders where service_id is 45
        $orderList = $query->get();

        // Fetch items for each order
        foreach ($orderList as $order) {
            $itemList = DB::table('ci_order_item')
                ->where('order_id', $order->order_id)
                ->where('subservice_id', 47)
                ->get();

            $total = $itemList->sum('price'); // Calculate total if price field exists

            // Attach items and subtotal to the order object
            $order->items = $itemList;
            $order->sub_total = $total;
        }

        $data['orders_list'] = $orderList;
       // echo"<pre>";print_r($data['orders_list']);echo"</pre>";exit;
        return view('admin.list_order', $data);
    }

    function detail($order_id){
        //echo $id;exit;
        $data['error'] = '';
        $query = DB::table('ci_orders')
        ->leftJoin('frontloginregisters', 'ci_orders.user_id', '=', 'frontloginregisters.id')
       ->leftJoin('ci_shipping_address', 'ci_orders.order_id', '=', 'ci_shipping_address.order_id')
        ->select('frontloginregisters.email as user_email', 'frontloginregisters.name as user_name', 'frontloginregisters.mobile as user_mobile',  'ci_orders.*',  'ci_shipping_address.*');
    if (!empty($order_id)) {
        $query->where('ci_orders.order_id', $order_id);
    }
    if (!empty($status)) {
        if ($status == 'SUCCESS' || $status == 'FAILED') {
            $query->where('ci_orders.payment_status', $status);
        } else {
            $query->where('ci_orders.order_status', $status);
        }
    }
    $query->orderBy('ci_orders.order_id', 'DESC');
    $orderList = $query->get();
    foreach ($orderList as $order) {
        $itemList = DB::table('ci_order_item')
            ->where('order_id', $order->order_id)
            ->get();
        if($order->order_from != 2){
            $total = 0;
            $additionalCost = 0;
            foreach ($itemList as $item) {
                $product = DB::table('packages')
                    ->where('id', $item->package_id)
                    ->first();
                if($item->product_discount_amount != 0 && $item->product_discount_amount != ''){
                    $product_item_price = $item->product_discount_amount;
                }else{
                    $product_item_price = $item->package_item_price;
                }
                $total += $product_item_price * $item->package_quantity;
            }
            $order->items = $itemList;
            if($order->order_from == 1 && $order->order_from != 2){
                $order->sub_total = $order->sub_total;
            }else{
                $order->sub_total = $total;
            }
        }else{
            foreach ($itemList as $item) {
                $product = DB::table('packages')
                    ->where('id', $item->package_id)
                    ->first();
            }
            $order->items = $itemList;
        }
        
    }
    $orderList;  
    $data['order'] = $orderList[0];
//     $sql = $query->toSql();
// echo $sql;
    //echo "<pre>";print_r($query);echo"</pre>";
       //echo "<pre>";print_r($data);echo"</pre>";exit;  
        return view('admin.view_order',$data);
    }
    public function destroy(Request $request)
    {
        $delete_id = $request->selected;
        // echo $delete_id;exit;
        Subscribe::whereIn('id',$delete_id)->delete();
        return redirect()->route('subscribe.index')->with('success','Subscribe has been deleted successfully');
        // $id=$request->id;
        // Subscribe::whereIn('id',$id)->delete();
        // return redirect()->route('subscribe.index');
    }
    function assign_vendor(){
        
        $order_id = $_POST['order_id'];
		
		$ci_order_data = DB::table('ci_orders')
            ->where('order_id', $order_id)
            ->first();
        $ci_order_item_data = DB::table('ci_order_item')
            ->where('order_id', $order_id)
            ->first();
        
        $currentDate = now();
        // $vendor_subscription = DB::table('subscription')
        //                                ->select('*')
        //                                ->where('services', '=', $ci_order_item_data->service_id)
        //                                ->whereRaw("FIND_IN_SET(?, sub_service)", [$ci_order_item_data->subservice_id])
        //                                //->where('enddate', '>=', $currentDate)
        //                                 ->groupBy('vendor_id')
        //                                ->orderBy('id', 'desc')
        //                                ->get();
			//echo "<pre>";print_r($vendor_subscription);echo"</pre>";exit;
        $html = '<select id="vendor_id" name="vendor_id"  class="form-control">';
                
                $html .= "<option value=''>Select Vendor</option>";
                // if ($vendor_subscription != '') {
                //     for ($i = 0; $i < count($vendor_subscription); $i++) {
                        $vendor_data = DB::table('users')
                                        // ->where('id', $vendor_subscription[$i]->vendor_id)
                                        ->whereRaw("FIND_IN_SET(?, serviceList)", [$ci_order_item_data->service_id])
                                        ->where('vendor', 1)
                                        ->where('is_active', 0)
                                        ->get()->toArray();
                                       //echo "<pre>";print_r($vendor_data);echo"</pre>";exit;
                        //for ($i = 0; $i < count($vendor_data); $i++) {
                                        //echo "<pre>";print_r($vendor_data);echo"</pre>";
                        foreach($vendor_data as $vendor_data_new){
                        if($vendor_data != ''){
							
							 if ($ci_order_data->vendor_id == $vendor_data_new->id) {
								$selected = "selected";
							} else {
								$selected = "";
							}
				
				
                            $html .= "<option value='" . $vendor_data_new->id . "'" . $selected . ">" . $vendor_data_new->name . "</option>";
                        }
                    }
                        
                        //echo "<pre>";print_r($vendor_subscription[$i]->vendor_id);echo"</pre>";
                //     }
                // }
                //exit;
        $html .= "</select>";
        $html .= "<input type='hidden' name='order_id' id='order_id' value='" . $order_id . "'/>";
        echo $html;
        
    }

    function order_vendor_form(){
        //echo "<pre>";print_r($_POST);echo"</pre>";exit;
        $vendor_id = $_POST['vendor_id'];
        $order_id = $_POST['order_id'];
        DB::table('ci_orders')
            ->where('order_id', $order_id)
            ->update(['vendor_id' => $vendor_id]);
        $vendor_detail = DB::table('users')->where('vendor', 1)->where('id',$vendor_id)->first();
        $order_data = DB::table('ci_orders')
            ->where('order_id', $order_id)->first();
        $order_item_data = DB::table('ci_order_item')
            ->where('order_id', $order_id)->get()->toArray();
        $customer_data = DB::table('frontloginregisters')
            ->where('id', $order_data->user_id)->first();
        // echo"<pre>";print_r($order_data);echo"</pre>";
        // echo"<pre>";print_r($order_item_data[0]);echo"</pre>";
        // echo"<pre>";print_r($customer_data);echo"</pre>";
        // exit;
        $html_append = "";
        if($order_data->paymentmode == 1){ //Cod mail
            $payment_mode = "Cash On Delivery (Please Collect from Customer)";
            $payment_mode_customer = "Cash On Delivery";
            $html_append .= "<p>Please <strong>contact the customer as soon as possible</strong> regarding the service. The customer may also contact you directly to discuss any specifics or ask questions about the service. Please ensure timely communication.";
            $html_append .= "<p><strong>Please note the following instructions for COD payments:</strong><br>";
            
            $html_append .='<ul>
                                <li>Kindly collect the <strong>full payment</strong> from the customer <strong>upon completing the service.</strong></li>
                                <li>A VendorsCity representative will visit your location within 5 working days to collect the cash payment. Alternatively, if you prefer a bank transfer, please inform us, and we will provide you with our transfer details.
                                </li>
                            </ul>';
        }else{
            $payment_mode = "Online (Paid)";
            $payment_mode_customer = "Online";
            $html_append .= "<p><strong>Important Information:</strong><br>";
            
            $html_append .='<ul>
                                <li><strong>Payment:</strong>Your payment will be processed after the successful completion of the job and confirmation from the customer.</li>
                                <li><strong>Customer Contact:</strong> Please <strong>contact the customer as soon as possible</strong> regarding the service. The customer may also contact you directly to discuss any specifics or ask questions about the service. Please ensure timely communication.
                                </li>
                            </ul>';
        }
        $vendor_html ='';
 
        $vendor_html .='<!doctype html>
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
<img src="'.asset("public/site/images/VC-FULL-COLOR.png").'"" style="width: 40%;" >
</div>
<div class="email_wrapper" style="width:100%;margin-top: 18px;font-size: 16px;">
                   <p>  Dear '.$vendor_detail->name.',</p>
                   <p>We are excited to inform you that a new order has been assigned to you through VendorsCity! Below are the details for the upcoming service:</p>';
                  $vendor_html .='<p><strong>Order Details:</strong><br>';
                    $vendor_html .='<ul>
                                        <li><strong>Service: </strong> '.\Helper::servicename($order_item_data[0]->service_id).'</li>
                                        <li><strong>Customer Name: </strong> '.$customer_data->name.'</li>
                                         <li><strong>Customer Email: </strong> '.$customer_data->email.'</li>
                                        <li><strong>Customer Contact: </strong> '.$customer_data->mobile.'</li>
                                        <li><strong>Date Requested: </strong> '.date('d-m-Y', strtotime($order_data->moving_date)).'</li>
                                        <li><strong>Payment Type: </strong> '.$payment_mode.'</li>
                                    </ul>';
                    $vendor_html .='<p>Press “View Order” or login to your vendor portal to access all the customer details to complete the order.</p>';
                    $vendor_html .='<button class="btn btn-primary" type="button"
                    style="background-color: #1F6EEC;border-color: #1F6EEC;color: #fff;
                    padding: 10px 18px;border-radius: 11px;">
                    <a href="' . route("vendororder.index") . '" style="color:#fff !important; text-decoration:none !important;">View Order</a></button>';
                    $vendor_html .= $html_append;
                $vendor_html .='
                <p>Your prompt attention to this order is greatly appreciated. If you have any questions or need further assistance, feel free to reach out to us at any time.</p>
                <p>Thank you for your continued partnership and dedication to providing top-notch service.
                </p>
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
                       <div class="footer_right"  style="margin-left:10px;
                                float: left;">
                           <p style="margin:0;">Questions? Email <a style="color: #555;" href="mailto:vendors@vendorscity.com">vendors@vendorscity.com</a></p>
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
        //echo $vendor_html;exit;
        $subject = "New ".$order_item_data[0]->service_name." Order Assigned on VendorsCity | Order No. ".$order_data->format_order_id."
";
        $to = $vendor_detail->email;
        // $ccRecipients = ['support@vendorscity.com'];
        $ccRecipients = array();
        // $to = $request->email;
        Mail::send([], [], function($message) use($vendor_html, $to, $subject,$ccRecipients) {
            $message->to($to);
            $message->subject($subject);
            foreach ($ccRecipients as $ccRecipient) {
                $message->cc($ccRecipient);
            }
            $message->html($vendor_html);
        });
                $customer_html ='';
                
                $customer_html .='<!doctype html>
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
                <img src="'.asset("public/site/images/VC-FULL-COLOR.png").'""style="width: 40%;" >
                </div>
                <div class="email_wrapper" style="width:100%;margin-top: 18px;font-size: 16px;">
                        <p>  Dear '.$customer_data->name.',</p>
                        <p>We are pleased to inform you that a vendor has been assigned to fulfill your service order with VendorsCity. Here are the details:</p>';
                       
                        $customer_html .='<ul>
                                            <li><strong>Order Number: </strong> '.$order_data->format_order_id.'</li>
                                            <li><strong>Payment Type: </strong> '.$payment_mode_customer.'</li>
                                            <li><strong>Service: </strong> '.\Helper::servicename($order_item_data[0]->service_id).'</li>
                                            <li><strong>Vendor Name: </strong> '.$vendor_detail->name.'</li>
                                                <li><strong>Contact Information: </strong> '.$vendor_detail->mobile.'</li>
                                            </ul>';
                        $customer_html .='<p>The vendor will reach out to you shortly to finalize the service details and arrange for scheduling. If this is a cash-on-delivery order, please make the payment directly to the vendor upon completion of the service.</p>';
                            
                        $customer_html .='
                        <p>If you have any questions or need further assistance, feel free to reach out to us at <a style="color: #555;" href="mailto:support@vendorscity.com">support@vendorscity.com</a> or call us at 056 VENDORS (836 3677).
                        </p>
                        <p>Thank you for your continued partnership and dedication to providing top-notch service.
                </p>
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
                       <div class="footer_right"  style="margin-left:10px;
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
                //echo $customer_html;exit;
                
                
                $subject = "Vendor Assigned for Your ".$order_item_data[0]->service_name."  Order with VendorsCity | Order No. ".$order_data->format_order_id."";
                $to = $customer_data->email;
                // $ccRecipients = ['support@vendorscity.com'];
                $ccRecipients = array();
                // $to = $request->email;
                Mail::send([], [], function($message) use($customer_html, $to, $subject,$ccRecipients) {
                    $message->to($to);
                    $message->subject($subject);
                    foreach ($ccRecipients as $ccRecipient) {
                        $message->cc($ccRecipient);
                    }
                    $message->html($customer_html);
                });
        
      
            $html = '<!doctype html> <html>
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
            <div class="wrapper">
                <div class="logo" style="float: inherit;">
                <img src="'.asset("public/site/images/VC-FULL-COLOR.png").'"" >
                </div>
                <div class="email_wrapper">
                    <p>Dear '.$vendor_detail->name.',</p>
                    <p>We are pleased to inform you that a new service booking has been made. Please find the details below:</p>
                    <button class="btn btn-primary" type="button"
                    style="background-color: #1F6EEC;
                    border-color: #1F6EEC;
                    color: #fff;
                    padding: 10px 18px;
                    border-radius: 11px;"><a href="' . route("vendorinquiry.index") . '" style="color:#fff !important; text-decoration:none !important;">View Request</a></button>
                    <p>Please contact the customer as soon as possible to confirm the booking and make any necessary arrangements. If you have any questions or require further assistance, feel free to reach out to us at hello@vendorscity.com. 
                    </p>
                    <p>Thank you for your prompt attention to this booking. We appreciate your continued partnership and commitment to delivering excellent service to our customers.</p>
                </div>
                <div class="email_footer">
                    <h3>The VendorsCity Team</h3>
                    <div class="email_footer_div">
                        <div class="footer_left">
                            <img style="width:100%;" src="'.asset("public/site/images/vcfaviconwap.png").'"" >
                        </div>
                        <div class="footer_right">
                            <p>Questions? Email <a style="color: #555;" href="mailto:support@vendorscity.com">support@vendorscity.com</a></p>
                            <p>VendorsCity Portal LLC</p>
                            <div class="footer_links">
                                <a href="'.url("/terms-of-service").'">Terms of Use</a>
                                <a href="'.url("/privacy-policy").'">Privacy Policy</a>
                                <a href="'.url("/contact").'">Contact Us</a>
                            </div>
                            <p>This message was mailed to '.$vendor_detail->email.' as part of you account registered with us on VendorsCity</p>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>';
            // $subject = "New Service Booking Alert";
            // $to = $vendor_detail->email;
            // $ccRecipients = ['support@vendorscity.com'];
            // // $to = $request->email;
            // Mail::send([], [], function($message) use($html, $to, $subject,$ccRecipients) {
            //     $message->to($to);
            //     $message->subject($subject);
            //     $message->from('devang.hnrtechnologies@gmail.com', 'VendorsCity');
            //     foreach ($ccRecipients as $ccRecipient) {
            //         $message->cc($ccRecipient);
            //     }
            //     $message->html($html);
            // });
        return redirect()->route('order.index')->with('success','Vendor Assign successfully');
    }
	
	public function set_booking_percentage()
    {
        $order_id = $_POST['order_id'];
        $percentage = $_POST['percentage'];
        // echo $id."-".$val;exit;
        DB::table('ci_order_item')->where('id', $order_id)->update(array('subservice_booking_percentage' => $percentage));
        echo "1";
        // return redirect()->route('product.index')->with('success','Set Order has been Updated successfully');
    }
}