<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subscription_page');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public  function base_on_service_lead($vendor_id){



        if(request()->input('action') == 'add'){

            //echo "<pre>";print_r($_POST);echo"</pre>";exit;

            $currentDateTime = date("Y-m-d H:i:s");
            $end_date = date('Y-m-d H:i:s', strtotime($currentDateTime . ' +30 days'));

            $data['vendor_id'] = request()->input('vendor_id');
            $data['subscription_name'] = request()->input('subscription_name');
            $data['subscription_id'] = request()->input('subscription_id');
            $data['country'] = request()->input('country');
            $data['state'] = request()->input('state');
            $data['city'] = implode(',', request()->input('city'));
            $data['services'] = implode(',', request()->input('services'));
            $data['sub_service'] = implode(',', request()->input('sub_service'));
            $data['total'] = request()->input('total');
            $data['startdate'] = $currentDateTime;
            $data['enddate'] = $end_date;
            $data['added_date'] = $currentDateTime;

            // echo "<pre>";print_r($data);echo"</pre>";exit;

            $id = DB::table('subscription')->insertGetId($data);
            //$id = 10;
            $content['subscription_id'] = $id;
            $content['sub_service'] = request()->input('sub_service');

            $this->insert_attribute($content);


            /*-----Start Update Vendor wallet amount-----*/

            $vendors_data = DB::table('users')->where('id', $data['vendor_id'])->first();
            $vendor_wallet_amount = $vendors_data->wallet_amount - $data['total'];
            DB::table('users')->where('id', $data['vendor_id'])->update(['wallet_amount' => $vendor_wallet_amount]);

            //echo "<pre>";print_r($vendor_wallet_amount);echo"</pre>";exit;

            /*-----Start Update Vendor wallet amount-----*/


            /*------Insert Wallet data start------*/
            $data_wallet['vendors_id'] = $data['vendor_id'];
            $data_wallet['price'] = $data['total'];
            $data_wallet['payment'] = 0;
            $data_wallet['add_deduct'] = 1;
            $data_wallet['status'] = 0;
            $data_wallet['subscription_id'] = $id;
            DB::table('wallets')->insertGetId($data_wallet);

            /*------Insert Wallet data ENd------*/

             return Redirect::route('vendors.subscription', ['id' => $vendor_id])->with('success', 'Subscription Purchased Successfully.');
            // return redirect()->route('vendors.subscription', ['id' => $vendor_id])->with('success', 'Subscription Purchased Successfully.');

            

            //echo "<pre>";print_r($data);echo "</pre>";exit;
        }
        $data['country_data'] = DB::table('countries')->select('*')->orderBy('id','DESC')->get();
        $data['state_data'] = DB::table('states')->select('*')->orderBy('id','DESC')->get();
        $data['allcity'] = DB::table('cities')->select('*')->get();
        $data['allservices'] = DB::table('services')->select('*')->where('is_active', 0)->get();
        $data['allsub_services'] = DB::table('subservices')->select('*')->get();
        $data['id'] = $vendor_id;

       

        return view('admin.base_on_service_lead',$data);
    }


    function insert_attribute($content){

        foreach($content['sub_service'] as $sub_service_data){

            $result = DB::table('subservices')->select('*')->where('id','=',$sub_service_data)->first();

            $sessionKey = 'subservice_price_session_' . $result->id;

            if(Session::has($sessionKey)){
                $val = Session::get($sessionKey);
            }else{
                $val = $result->charge;
            }

            $sessionKey_new = 'subservice_no_of_inquiry_session_' . $result->id;

            if(Session::has($sessionKey_new)){
                $val_no_of_inquiry = Session::get($sessionKey_new);
            }else{
                $val_no_of_inquiry = $result->no_of_inquiry;
            }

            
           // echo "<pre>";print_r($result);echo "</pre>";

            $data['subscription_id'] = $content['subscription_id'];
            $data['service_id'] = $result->serviceid;
            $data['subservice_id'] = $result->id;
            $data['charge'] = $val;
            $data['no_of_inquiry'] = $val_no_of_inquiry;

            DB::table('subscription_subservice_attribute')->insertGetId($data);
            

            Session::forget($sessionKey);
            Session::forget($sessionKey_new);
        }

        //exit;
    }


    public  function based_on_booking_services($vendor_id){
        $data['country_data'] = DB::table('countries')->select('*')->orderBy('id','DESC')->get();
        $data['state_data'] = DB::table('states')->select('*')->orderBy('id','DESC')->get();
        $data['allcity'] = DB::table('cities')->select('*')->get();

         if(request()->input('action') == 'add'){

            $currentDateTime = date("Y-m-d H:i:s");
            $end_date = date('Y-m-d H:i:s', strtotime($currentDateTime . ' +30 days'));

            $data_new['vendor_id'] = request()->input('vendor_id');
            $data_new['subscription_name'] = request()->input('subscription_name');
            $data_new['subscription_id'] = request()->input('subscription_id');
            // $data['country'] = request()->input('country');
            // $data['state'] = request()->input('state');
            // $data['city'] = request()->input('city');
            // $data['services'] = implode(',', request()->input('services'));
            // $data['sub_service'] = implode(',', request()->input('sub_service'));
            $data_new['total'] = request()->input('total');
            $data_new['startdate'] = $currentDateTime;
            $data_new['enddate'] = $end_date;
            $data_new['added_date'] = $currentDateTime;

            $id = DB::table('subscription')->insertGetId($data_new);

            return Redirect::route('vendors.subscription', ['id' => $vendor_id])->with('success', 'Subscription Purchased Successfully.');

            

            //echo "<pre>";print_r($_POST);echo "</pre>";exit;

         }

         $data['id'] = $vendor_id;
        
        return view('admin.based_on_booking_services',$data);
    }

    public  function based_on_listing_criteria($vendor_id){
        $data['country_data'] = DB::table('countries')->select('*')->orderBy('id','DESC')->get();
        $data['state_data'] = DB::table('states')->select('*')->orderBy('id','DESC')->get();
        $data['allcity'] = DB::table('cities')->select('*')->get();

        if(request()->input('action') == 'add'){

            $currentDateTime = date("Y-m-d H:i:s");
            $end_date = date('Y-m-d H:i:s', strtotime($currentDateTime . ' +30 days'));

            $data_new['vendor_id'] = request()->input('vendor_id');
            $data_new['subscription_name'] = request()->input('subscription_name');
            $data_new['subscription_id'] = request()->input('subscription_id');
            $data_new['country'] = request()->input('country');
            $data_new['state'] = request()->input('state');
            $data_new['city'] = implode(',', request()->input('city'));
            // $data['services'] = implode(',', request()->input('services'));
            // $data['sub_service'] = implode(',', request()->input('sub_service'));
            $data_new['total'] = request()->input('total');
            $data_new['startdate'] = $currentDateTime;
            $data_new['enddate'] = $end_date;
            $data_new['added_date'] = $currentDateTime;

            $id = DB::table('subscription')->insertGetId($data_new);

            /*-----Start Update Vendor wallet amount-----*/

            $vendors_data = DB::table('users')->where('id', $data_new['vendor_id'])->first();
            $vendor_wallet_amount = $vendors_data->wallet_amount - $data_new['total'];
            DB::table('users')->where('id', $data_new['vendor_id'])->update(['wallet_amount' => $vendor_wallet_amount]);

            //echo "<pre>";print_r($vendor_wallet_amount);echo"</pre>";exit;

            /*-----Start Update Vendor wallet amount-----*/


            /*------Insert Wallet data start------*/
            $data_wallet['vendors_id'] = $data_new['vendor_id'];
            $data_wallet['price'] = $data_new['total'];
            $data_wallet['payment'] = 0;
            $data_wallet['add_deduct'] = 1;
            $data_wallet['status'] = 0;
            $data_wallet['subscription_id'] = $id;
            DB::table('wallets')->insertGetId($data_wallet);

            /*------Insert Wallet data ENd------*/

            return Redirect::route('vendors.subscription', ['id' => $vendor_id])->with('success', 'Subscription Purchased Successfully.');

            //echo "<pre>";print_r($_POST);echo "</pre>";exit;

         }

         $data['id'] = $vendor_id;
        
        return view('admin.based_on_listing_criteria',$data);
    }

    function state_show_subscription(){
        $country_id = $_POST['country_id'];
        //echo $cat_id;exit;
        $result = DB::table('states')->select('*')->where('country_id','=',$country_id)->get();

        $result_new = $result->toArray();

        $html = "<select id='state' name='state' class='form-control' onchange='city_change(this.value);'>";
        $html .= "<option value=''>Select State</option>";
        if($result != '' && count($result) >0)
        {
            for($i=0;$i<count($result);$i++)
            {
                //echo "<pre>";print_r($result[$i]->id);echo "</pre>";exit;
                $html .= "<option value='".$result[$i]->id ."'>".$result[$i]->state ."</option>";
            }
        }
        $html .="</select>";
        //echo "<pre>";print_r($html);echo "</pre>";exit;
        echo $html;
    }

    function city_show(){
        $state_id = $_POST['state_id'];
        //echo $cat_id;exit;
        $result = DB::table('cities')->select('*')->where('state','=',$state_id)->get();

        $result_new = $result->toArray();

        $html = "<select id='city' name='city[]' class='form-control' multiple='multiple'>";
        $html .= "<option value=''>Select City</option>";
        if($result != '' && count($result) >0)
        {
            for($i=0;$i<count($result);$i++)
            {
                //echo "<pre>";print_r($result[$i]->id);echo "</pre>";exit;
                $html .= "<option value='".$result[$i]->id ."'>".$result[$i]->name ."</option>";
            }
        }
        $html .="</select>";
        //echo "<pre>";print_r($html);echo "</pre>";exit;
        echo $html;
    }

    function subservice_change(){
        $service_id = $_POST['service_id'];

        // $result = DB::table('subservices')->select('*')->whereIn('serviceid','=',$service_id)->get();
        $result = DB::table('subservices')
                ->select('*')
                ->whereIn('serviceid', $service_id)
                ->get();
        $result_new = $result->toArray();
        $html = '<select class="form-control" id="sub_service" name="sub_service[]" multiple="multiple" onchange="subservice_table_change(this.value);">';
         $html .= "<option value=''>Select Sub Service</option>";
        if($result != '' && count($result) >0){
            for($i=0;$i<count($result);$i++)
            {
                //echo "<pre>";print_r($result[$i]->id);echo "</pre>";exit;
                $html .= "<option value='".$result[$i]->id ."'>".$result[$i]->subservicename ."</option>";
            }
        }
        $html .="</select>";
        echo $html;
        // echo "<pre>";print_r($result);echo "</pre>";exit;

    }

    // function subservice_table_change(){

    //     $subservice_id = $_POST['subservice_id'];      

    //     if($subservice_id != ''){    

        
    //     $result = DB::table('subservices')
    //             ->select('*')
    //             ->whereIn('id', $subservice_id)
    //             ->get();

    //     $result_new = $result->toArray();

    //     $html = '<div class="row">';
            
    //         $html .= '<div class="col-md-12">';

    //             $html .= '<div class="table-responsive">';
                
    //                 $html .= '<table class="invoice-table table table-bordered">';

    //                 $html .="<thead>";

    //                     $html .= '<tr><th>Sub Services</th><th class="text-end">Price</th><th class="text-end">New Price</th></tr>';

    //                 $html .= '</thead>';

    //                 $html .='<tbody>';
    //                 $total = 0;
    //     if($result != '' && count($result) >0){

    //         for($i=0;$i<count($result);$i++){

    //             $html .= "<tr><td>".$result[$i]->subservicename ."</td><td class='text-end'>".$result[$i]->charge ."</td><td class='text-end'><input id='price' name='price' type='text' class='form-control' placeholder='Enter Price'/></td> </tr>";

    //             $total += $result[$i]->charge;

    //         }
    //     }

    //     $html .='</div></div>';

    //      $html .='</tbody>';

    //     $html .= '</table>';

    //     $html .='<div class="col-md-6 col-xl-4 ms-auto">';
    //         $html .='<div class="table-responsive">';
    //             $html .='<table class="invoice-table-two table">';
    //                 $html .= '<tbody><tr><th>Total :</th><td><span>'.$total.'</span></td></tr></tbody>';
    //             $html .='</table>';
    //         $html .='</div>';
    //     $html .='</div><input type="hidden" name="total" id="total" value="'.$total.'">';


    //     $html .= '</div>';
    // }else{
    //     $html = "";
    // }

    //     echo $html;

    // }


    function subservice_table_change() {
        $subservice_id = $_POST['subservice_id'];      
    
        if ($subservice_id != '') {    
            $result = DB::table('subservices')
                    ->select('*')
                    ->whereIn('id', $subservice_id)
                    ->get();                   
    
            $result_new = $result->toArray();
    
            $html = '<div class="row">';
    
            $html .= '<div class="col-md-12">';
    
            $html .= '<div class="table-responsive">';
    
            $html .= '<table class="invoice-table table table-bordered">';
    
            $html .= "<thead>";
            $html .= '<tr><th>Sub Services</th><th class="text-end">No Of Inquiry</th><th class="text-end">No Of Inquiry New</th><th class="text-end">Price</th><th class="text-end">New Price</th><th class="text-end">Final Price</th></tr>';
            $html .= '</thead>';
    
            $html .= '<tbody>';
            $total = 0;
    
            if ($result != '' && count($result) > 0) {
                for ($i = 0; $i < count($result); $i++) {

                    $sessionKey = 'subservice_price_session_' . $result[$i]->id;

                    if(Session::has($sessionKey)){
                        $val = Session::get($sessionKey);
                    }else{
                        $val = $result[$i]->charge;
                    }

                    $sessionKey_new = 'subservice_no_of_inquiry_session_' . $result[$i]->id;

                    if(Session::has($sessionKey_new)){
                        $val_no_of_inquiry = Session::get($sessionKey_new);
                    }else{
                        $val_no_of_inquiry = $result[$i]->no_of_inquiry;
                    }

                    $final_price = $val_no_of_inquiry * $val;

                    $html .= "<tr><td>".$result[$i]->subservicename."</td>";
                    $html .= "<td class='text-end'>".$result[$i]->no_of_inquiry."</td>";
                    $html .= "<td class='text-end'>
                    <input id='no_of_inquiry_".$i."' name='no_of_inquiry[]' type='text' class='form-control no-of-inquiry-input' placeholder='Enter No Of Inquiry' oninput='updateTotal_new(".$i.",".$result[$i]->id.")' data-no_of_inquiry='".$result[$i]->no_of_inquiry."' data-index='".$i."' value='".$val_no_of_inquiry."' /></td>";
                    $html .= "<td class='text-end'>".$result[$i]->charge."</td>";
                    $html .= "<td class='text-end'>
                    <input id='price_".$i."' name='price[]' type='text' class='form-control price-input' placeholder='Enter Price' oninput='updateTotal_new(".$i.",".$result[$i]->id.")' data-charge='".$result[$i]->charge."' data-index='".$i."' value='".$val."' /></td>";

                    $html .= "<td class='text-end'><span id='replace_final_price_".$i."'>".$final_price."</span> <input id='finalprice_".$i."' name='finalprice[]' type='hidden' value='".$final_price."' /></td>
                    </tr>";
    
                    $total += $final_price;
                }
            }
    
            $html .= '</tbody>';
            $html .= '</table>';
    
            $html .= '<div class="col-md-6 col-xl-4 ms-auto">';
            $html .= '<div class="table-responsive">';
            $html .= '<table class="invoice-table-two table">';
            $html .= '<tbody><tr><th>Total :</th><td><span id="total-span">'.$total.'</span></td></tr></tbody>';
            $html .= '</table>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<input type="hidden" name="total" id="total" value="'.$total.'">';    
    
            
            $_SESSION['subservice_prices'] = array();
            for ($i = 0; $i < count($result); $i++) {
                $_SESSION['subservice_prices'][$i] = $result[$i]->charge;
            }
    
            $html .= '</div>';            
        } else {
            $html = "";
        }
    
        echo $html;
    }
    
    function session_subs_price_change(){
        //echo "<pre>";print_r($_POST);echo "</pre>";exit;
        $no_of_inquiry = $_POST['no_of_inquiry'];
        $price = $_POST['price'];
        $sub_serviceid = $_POST['sub_serviceid'];

        $sessionKey = 'subservice_price_session_' . $sub_serviceid;
        Session::put($sessionKey, $price);

        $sessionKey_new = 'subservice_no_of_inquiry_session_' . $sub_serviceid;
        Session::put($sessionKey_new, $no_of_inquiry);


    }


 






}