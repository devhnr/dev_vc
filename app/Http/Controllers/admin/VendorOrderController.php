<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Order;
use DB;
use Auth;
class VendorOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($order_id = '', $status = '')
    {
        $vendors_id = Auth::user()->id;
        // echo $order_id;exit;
        $data['error'] = '';
        //$data['subscribe_data'] = Subscribe::orderBy('id','DESC')->get();    
        $query = DB::table('ci_orders')
        ->leftJoin('frontloginregisters', 'ci_orders.user_id', '=', 'frontloginregisters.id')
        //->leftJoin('ci_shipping_address', 'ci_orders.order_id', '=', 'ci_shipping_address.order_id')
        ->select('frontloginregisters.email as user_email', 'frontloginregisters.name as user_name', 'frontloginregisters.mobile as user_mobile',  'ci_orders.*')
        ->where('ci_orders.order_from', '!=', 2)
        ->where('ci_orders.order_from', '=', 0)
        ->where('ci_orders.order_from', '!=', 1);;
       
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
    $query->where('ci_orders.vendor_id', $vendors_id);
    $query->orderBy('ci_orders.order_id', 'DESC');
    
    $orderList = $query->get();
    
    // echo"<pre>";
    //     print_r($orderList);
    // echo"</pre>";exit;
    
    foreach ($orderList as $order) {
        $itemList = DB::table('ci_order_item')
            ->where('order_id', $order->order_id)           
            ->where('subservice_id', 23)
            ->get();      
            //  echo"<pre>";
            //     print_r($itemList);
            // echo"</pre>";     
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
    }
   $orderList;  
    $data['vendororders_list'] = $orderList;
    // echo "<pre>";print_r($data);echo"</pre>";exit;  
        return view('admin.list_vendororder',$data);
    }

    public function cleaning_listing($order_id = '', $status = '')
    {
        $vendors_id = Auth::user()->id;
        // echo $order_id;exit;
        $data['error'] = '';
        //$data['subscribe_data'] = Subscribe::orderBy('id','DESC')->get();    
        $query = DB::table('ci_orders')
        ->leftJoin('frontloginregisters', 'ci_orders.user_id', '=', 'frontloginregisters.id')
        //->leftJoin('ci_shipping_address', 'ci_orders.order_id', '=', 'ci_shipping_address.order_id')
        ->select('frontloginregisters.email as user_email', 'frontloginregisters.name as user_name', 'frontloginregisters.mobile as user_mobile',  'ci_orders.*')
        ->where('ci_orders.order_from', '!=', 2)
        ->where('ci_orders.order_from', '!=', 0)
        ->where('ci_orders.order_from', '=', 1);;
       
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
    $query->where('ci_orders.vendor_id', $vendors_id);
    $query->orderBy('ci_orders.order_id', 'DESC');
    
    $orderList = $query->get();
    
    // echo"<pre>";
    //     print_r($orderList);
    // echo"</pre>";exit;
    
    foreach ($orderList as $order) {
        $itemList = DB::table('ci_order_item')
            ->where('order_id', $order->order_id)           
            ->where('subservice_id', 28)
            ->get();      
            //  echo"<pre>";
            //     print_r($itemList);
            // echo"</pre>";     
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
    }
   $orderList;  
    $data['vendororders_list'] = $orderList;
    // echo "<pre>";print_r($data);echo"</pre>";exit;  
        return view('admin.list_vendororder',$data);
    }


    public function painting_listing($order_id = '', $status = '')
    {
        $vendors_id = Auth::user()->id;
        // echo $order_id;exit;
        $data['error'] = '';
        //$data['subscribe_data'] = Subscribe::orderBy('id','DESC')->get();    
        $query = DB::table('ci_orders')
        ->leftJoin('frontloginregisters', 'ci_orders.user_id', '=', 'frontloginregisters.id')
        //->leftJoin('ci_shipping_address', 'ci_orders.order_id', '=', 'ci_shipping_address.order_id')
        ->select('frontloginregisters.email as user_email', 'frontloginregisters.name as user_name', 'frontloginregisters.mobile as user_mobile',  'ci_orders.*')
        ->where('ci_orders.order_from', '=', 2)
        ->where('ci_orders.order_from', '!=', 0)
        ->where('ci_orders.order_from', '!=', 1);
       
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
    $query->where('ci_orders.vendor_id', $vendors_id);
    $query->orderBy('ci_orders.order_id', 'DESC');
    
    $orderList = $query->get();
    
        foreach ($orderList as $order) {
            $itemList = DB::table('ci_order_item')
                ->where('order_id', $order->order_id) 
                ->where('subservice_id', 47)          
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
        }

        $orderList;  
        $data['vendororders_list'] = $orderList;
        //echo "<pre>";print_r($data);echo"</pre>";exit;  
        return view('admin.list_vendororder',$data);
    }
    
    function vendordetail($order_id){
        // echo $order_id;exit;
        $data['error'] = '';
        $vendors_id = Auth::user()->id;
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
    $query->where('ci_orders.vendor_id', $vendors_id);
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
            $order->sub_total = $total;
        }
        $order->items = $itemList;
        
    }
    $orderList;  
    $data['order'] = $orderList[0];
        //  echo "<pre>";print_r($data);echo"</pre>";exit;  
        return view('admin.view_vendor_order',$data);
    }
    // public function destroy(Request $request)
    // {
    //     $delete_id = $request->selected;
    //     // echo $delete_id;exit;
    //     Subscribe::whereIn('id',$delete_id)->delete();
    //     return redirect()->route('subscribe.index')->with('success','Subscribe has been deleted successfully');
    //     // $id=$request->id;
    //     // Subscribe::whereIn('id',$id)->delete();
    //     // return redirect()->route('subscribe.index');
    // }
//     function assign_vendor(){
        
//         $order_id = $_POST['order_id'];
//         $ci_order_item_data = DB::table('ci_order_item')
//             ->where('order_id', $order_id)
//             ->first();
        
//         $currentDate = now();
//         $vendor_subscription = DB::table('subscription')
//                                        ->select('*')
//                                        ->where('services', '=', $ci_order_item_data->service_id)
//                                        ->whereRaw("FIND_IN_SET(?, sub_service)", [$ci_order_item_data->subservice_id])
//                                        ->where('enddate', '>=', $currentDate)
//                                         ->groupBy('vendor_id')
//                                        ->orderBy('id', 'desc')
//                                        ->get();
// //echo "<pre>";print_r($vendor_subscription);echo"</pre>";
//         $html = '<select id="vendor_id" name="vendor_id"  class="form-control">';
                
//                 $html .= "<option value=''>Select Vendor</option>";
//                 if ($vendor_subscription != '') {
//                     for ($i = 0; $i < count($vendor_subscription); $i++) {
//                         $vendor_data = DB::table('users')
//                                         ->where('id', $vendor_subscription[$i]->vendor_id)
//                                         ->where('vendor', 1)
//                                         ->where('is_active', 0)
//                                         ->first();
//                                         //echo "<pre>";print_r($vendor_data);echo"</pre>";
//                         if($vendor_data != ''){
//                             $html .= "<option value='" . $vendor_data->id . "'>" . $vendor_data->name . "</option>";
//                         }
                        
//                         //echo "<pre>";print_r($vendor_subscription[$i]->vendor_id);echo"</pre>";
//                     }
//                 }
//                 //exit;
//         $html .= "</select>";
//         $html .= "<input type='hidden' name='order_id' id='order_id' value='" . $order_id . "'/>";
//         echo $html;
        
//     }
    // function order_vendor_form(){
    //     //echo "<pre>";print_r($_POST);echo"</pre>";exit;
    //     $vendor_id = $_POST['vendor_id'];
    //     $order_id = $_POST['order_id'];
    //     DB::table('ci_orders')
    //         ->where('order_id', $order_id)
    //         ->update(['vendor_id' => $vendor_id]);
    //     return redirect()->route('order.index')->with('success','Vendor Assign successfully');
    // }
}