<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\front\Frontloginregister;
use Hash;
use DB;
use Session;


use Carbon\Carbon;

use Symfony\Component\Mime\Email;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;




class MyaccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function my_order()
    {

      $userdata = Session::get('user');

      $userid = $userdata['userid'];


      $query = DB::table('ci_orders')
        ->leftJoin('frontloginregisters', 'ci_orders.user_id', '=', 'frontloginregisters.id')
        //->leftJoin('ci_shipping_address', 'ci_orders.order_id', '=', 'ci_shipping_address.order_id')
        ->select('frontloginregisters.email as user_email', 'frontloginregisters.name as user_name', 'frontloginregisters.mobile as user_mobile',  'ci_orders.*');

        $query->where('ci_orders.user_id', $userid);


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
        $order->sub_total = $total;
    }

   $orderList;  

    $data['orders_list'] = $orderList;

    echo "<pre>";print_r($data['orders_list']);echo"</pre>";exit;
       return view('front.my_order',$data);
    }

    public function my_account()
    {
       return view('front.my_account');
    }
    public function refer_earn()
    {
       return view('front.refer_earn');
    }
    public function refral()
    {
       return view('front.refers');
    }
    
    public function refer_earn_frend($userId)
    {
        //echo $userId;exit;
        $decryptedId = base64_decode($userId);

        // echo $decryptedId;exit;
        
        return view('front.frontloginregister',['decryptedId' => $decryptedId]);
      
    }

    public function my_profile()
    {
      $userData = Session::get('user');

      $userid = $userData['userid'];

      $data['user_data'] =  DB::table('frontloginregisters')->where('id', $userid)->first();

      //echo "<pre>";print_r($data);echo"</pre>";exit;

       return view('front.my_profile',$data);
    }

    public function edit_profile()
    {

      
      if(request()->input('action') == 'update_profile'){


         $userdata = Session::get('user');
         $userid = $userdata['userid'];

         $data['name'] = request()->input('fname');
         $data['mobile'] = request()->input('mobile');

         $result = DB::table('frontloginregisters')
        ->where('id', $userid)
        ->update($data);

        return redirect()->to('/my-profile')->with('L_strsucessMessage','Profile Updated Successfully');

         //echo "<pre>";print_r($data);echo"</pre>";exit;
      }

      $userData = Session::get('user');

      $userid = $userData['userid'];

      $data['user_data'] =  DB::table('frontloginregisters')->where('id', $userid)->first();

       return view('front.edit_profile',$data);
    }
    public function my_wallet()
    {
       return view('front.my_wallet');
    }
    public function order_detail()
    {

      $userdata = Session::get('user');

       
      

      $userid = $userdata['userid'];
   


      $query = DB::table('ci_orders')
        ->leftJoin('frontloginregisters', 'ci_orders.user_id', '=', 'frontloginregisters.id')
        ->leftJoin('ci_shipping_address', 'ci_orders.order_id', '=', 'ci_shipping_address.order_id')
        ->select('frontloginregisters.email as user_email', 'frontloginregisters.name as user_name', 'frontloginregisters.mobile as user_mobile',  'ci_orders.*',  'ci_shipping_address.*');

       

        $query->where('ci_orders.user_id', $userid);


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
        $order->sub_total = $total;
    }

   $orderList;  

    $data['orders_list'] = $orderList;

    //echo "<pre>";print_r($data);echo"</pre>";exit;
       return view('front.order_detail',$data);
    }

    function cancelpackage($id){

       // echo $id;exit;

        $data_u['is_return'] = 1;

        $orderdata = DB::table('ci_order_item')->where('id',$id)->update($data_u);

        return redirect()->to('/my-order')->with('L_strsucessMessage','Package Cancel Successfully');
    }
    
}