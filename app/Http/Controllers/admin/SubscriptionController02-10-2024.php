<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use Helper;
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

            //echo "<pre>";print_r($_POST);echo"</pre>";

            if(request()->input('type_of_subscription') == 0){
                $total = request()->input('total_package');
                $price_package = request()->input('price_package');
                $no_of_inquiry_package = request()->input('no_of_inquiry_package');
            }else{
                $total = 0;
                $price_package = 0;
                $no_of_inquiry_package = 0;
            }

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
            $data['total'] = $total;
            $data['type_of_subscription'] = request()->input('type_of_subscription');
            $data['type_of_package'] = request()->input('type_of_package');
            $data['price_package'] = $price_package;
            $data['no_of_inquiry_package'] = $no_of_inquiry_package;
            $data['startdate'] = $currentDateTime;
            $data['enddate'] = $end_date;
            $data['added_date'] = $currentDateTime;

            ///echo "<pre>";print_r($data);echo"</pre>";exit;

            // echo "<pre>";print_r($data);echo"</pre>";exit;

            $id = DB::table('subscription')->insertGetId($data);

            if(isset($_POST['form_id'])){

                foreach($_POST['form_id'] as $key => $val){

                    $data_local['subscription_id'] = $id;
                    $data_local['form_id'] = $val;
                    $data_local['form_attributes_id'] = $_POST['form_attributes_id'][$key];
                    $data_local['more_form_attributes_id'] = $_POST['more_form_attributes_id'][$key];
                    $data_local['local_no_of_inquiry'] = $_POST['local_no_of_inquiry'][$key];
                    $data_local['local_move_charge'] = $_POST['local_move_charge'][$key];
                    $data_local['local_service_id'] = $_POST['local_service_id'][$key];

                    if($data_local['local_move_charge'] > 0){

                        $data_wau['type_of_package'] = 0;
                        DB::table('subscription')->where('id', $id)->update($data_wau);

                    }
                    

                    DB::table('subscription_local_move_attribute')->insertGetId($data_local);
                    //echo "<pre>";print_r($data_local);echo"</pre>";exit;
                }
                
            }

            if(isset($_POST['international_form_id'])){

                foreach($_POST['international_form_id'] as $key => $val){

                    $data_intl['subscription_id'] = $id;
                    $data_intl['form_id'] = $val;
                    $data_intl['form_attributes_id'] = $_POST['international_form_attributes_id'][$key];
                    $data_intl['more_form_attributes_id'] = $_POST['international_more_form_attributes_id'][$key];
                    $data_intl['local_no_of_inquiry'] = $_POST['international_no_of_inquiry'][$key];
                    $data_intl['local_move_charge'] = $_POST['international_move_charge'][$key];
                    $data_intl['local_service_id'] = $_POST['international_service_id'][$key];

                    DB::table('subscription_international_move_attribute')->insertGetId($data_intl);

                    if($data_local['local_move_charge'] > 0){

                        $data_wau['type_of_package'] = 1;
                        DB::table('subscription')->where('id', $id)->update($data_wau);

                    }
                    // echo "<pre>";print_r($data_intl);echo"</pre>";exit;
                }
                
            }
            //exit;
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

            if(request()->input('type_of_subscription') == 0){
            /*------Insert Wallet data start------*/
            $data_wallet['vendors_id'] = $data['vendor_id'];
            $data_wallet['price'] = $data['total'];
            $data_wallet['payment'] = 0;
            $data_wallet['add_deduct'] = 1;
            $data_wallet['status'] = 0;
            $data_wallet['subscription_id'] = $id;
            $wallet_id = DB::table('wallets')->insertGetId($data_wallet);

            $vendor_data_new = DB::table('users')->where('id',$data['vendor_id'])->first();
            $year =date('y');
            $data_wau['transaction_id'] = "TID-".$vendor_data_new->vendor_id."-" . $year ."-". sprintf("%06d", $wallet_id);
            DB::table('wallets')->where('id', $wallet_id)->update($data_wau);

            }

            /*------Insert Wallet data ENd------*/

             return Redirect::route('vendors.subscription', ['id' => $vendor_id])->with('success', 'Subscription Purchased Successfully.');
            // return redirect()->route('vendors.subscription', ['id' => $vendor_id])->with('success', 'Subscription Purchased Successfully.');

            

            //echo "<pre>";print_r($data);echo "</pre>";exit;
        }
        $data['country_data'] = DB::table('countries')->select('*')->orderBy('country','ASC')->get();
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
            $wallet_id = DB::table('wallets')->insertGetId($data_wallet);

            $vendor_data_new = DB::table('users')->where('id',$data['vendor_id'])->first();
            $year =date('y');
            $data_wau['transaction_id'] = "TID-".$vendor_data_new->vendor_id."-" . $year ."-". sprintf("%06d", $wallet_id);
            DB::table('wallets')->where('id', $wallet_id)->update($data_wau);

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
        if($state_id == 0){
            $result = DB::table('cities')->select('*')->where('country','=',22)->get();
        }else{
            $result = DB::table('cities')->select('*')->where('state','=',$state_id)->get();
        }
        

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

    function chnage_moving_price(){

        $service_id = $_POST['service_id'];
        //echo "<pre>";print_r($service_id);echo "</pre>";
        //$service_id_array = 
        $html = "";
        if(in_array('30',$service_id)){
            
            $service_data = DB::table('services')->select('*')
                            ->where('id', 30)
                            ->first();

            $local_form_field_array = explode(',', $service_data->form_fields);

            //echo "<pre>";print_r($local_form_field_array);echo "</pre>";

            if(in_array('20',$local_form_field_array)){
                //echo "fsdf";
                $form_attributes = DB::table('form_attributes')->select('*')
                            ->where('form_id', 20)
                            ->get()->toArray();

                if(!empty($form_attributes)){

                    foreach($form_attributes as $form_attributes_data){

                        

                        $more_form_attributes = DB::table('more_form_attributes')->select('*')
                            ->where('attr_id', $form_attributes_data->id)
                            ->where('form_id', $form_attributes_data->form_id)
                            ->get()->toArray();

                        if(!empty($more_form_attributes)){

                            $html .= '<div class="row">';
    
                            $html .= '<div class="col-md-12">';
                    
                            $html .= '<div class="table-responsive">';

                            $html .= '<h5>Local Moving Charges</h5>';

                            $html .= '<table class="invoice-table table table-bordered">';
        
                            $html .= "<thead>";
                            $html .= '<tr><th>Package</th><th class="text-end">Size of House</th><th class="text-end">No Of Inquiry</th><th class="text-end">Rate/1 Lead</th><th class="text-end">Final Price</th></tr>';

                            

                            $html .= '</thead>';
                    
                            $html .= '<tbody>';
                            $total = 0;
                            $i=0;
                            foreach($more_form_attributes as $more_form_attributes_data){

                               // echo "<pre>";print_r($more_form_attributes_data->more_form_option);echo "</pre>";

                                $html .= "<tr><td>".$form_attributes_data->form_option."</td>";
                                $html .= "<td>".$more_form_attributes_data->more_form_option."</td>";
                                $html .= "<td><input id='local_no_of_inquiry_".$form_attributes_data->form_id."_".$form_attributes_data->id."_".$more_form_attributes_data->id."' name='local_no_of_inquiry[]' type='text' class='form-control local-no-of-inquiry' placeholder='Enter No Of Inquiry'  value='' oninput='updateTotal_new_local(".$form_attributes_data->form_id.",".$form_attributes_data->id.",".$more_form_attributes_data->id.")' data-no_of_inquiry='0' /></td>";
                                $html .= "<input type='hidden' name='form_id[]' value='".$form_attributes_data->form_id."'>";
                                $html .= "<input type='hidden' name='local_service_id[]' value='".$service_data->id."'>";
                                $html .= "<input type='hidden' name='form_attributes_id[]' value='".$form_attributes_data->id."'>";
                                $html .= "<input type='hidden' name='more_form_attributes_id[]' value='".$more_form_attributes_data->id."'>";
                                $html .= "<td><input id='local_move_charge_".$form_attributes_data->form_id."_".$form_attributes_data->id."_".$more_form_attributes_data->id."' name='local_move_charge[]' type='text' class='form-control price-local' placeholder='Enter Rate'  value='' oninput='updateTotal_new_local(".$form_attributes_data->form_id.",".$form_attributes_data->id.",".$more_form_attributes_data->id.")' /></td>";

                                $html .= "<td class='text-end'><span id='replace_local_final_price_".$form_attributes_data->form_id."_".$form_attributes_data->id."_".$more_form_attributes_data->id."'></span> <input id='replace_hidden_local_final_price_".$form_attributes_data->form_id."_".$form_attributes_data->id."_".$more_form_attributes_data->id."' name='local_finalprice_".$form_attributes_data->form_id."_".$form_attributes_data->id."[]' type='hidden' value='' /></td>
                    </tr>";
                                $i++;
                            }

                            $html .= '</tbody>';
                            $html .= '</table>';
    
                            $html .= '</div>';  
                            $html .= '</div>';  
                            $html .= '</div>'; 


                            $html .= '<div class="col-md-6 col-xl-4 ms-auto">';
                            $html .= '<div class="table-responsive">';
                            $html .= '<table class="invoice-table-two table">';
                            $html .= '<tbody><tr><th>Total :</th><td><span id="local-total-span_'.$form_attributes_data->form_id.'_'.$form_attributes_data->id.'"></span></td></tr></tbody>';
                            $html .= '</table>';
                            $html .= '</div>';
                            $html .= '</div>';
                            $html .= '<input type="hidden" name="local_total[]" id="local_total_'.$form_attributes_data->form_id.'_'.$form_attributes_data->id.'" value="0">';
                            
                            
                            // international move code start here


                            $html .= '<div class="row">';
    
                            $html .= '<div class="col-md-12">';
                    
                            $html .= '<div class="table-responsive">';

                            $html .= '<h5>International Moving Charges</h5>';

                            $html .= '<table class="invoice-table table table-bordered">';
        
                            $html .= "<thead>";
                            $html .= '<tr><th>Package</th><th class="text-end">Size of House</th><th class="text-end">No Of Inquiry</th><th class="text-end">Rate/1 Lead</th><th class="text-end">Final Price</th></tr>';

                            

                            $html .= '</thead>';
                    
                            $html .= '<tbody>';
                            $total = 0;
                            $i=0;
                            foreach($more_form_attributes as $more_form_attributes_data){

                               // echo "<pre>";print_r($more_form_attributes_data->more_form_option);echo "</pre>";

                                $html .= "<tr><td>".$form_attributes_data->form_option."</td>";
                                $html .= "<td>".$more_form_attributes_data->more_form_option."</td>";
                                $html .= "<td><input id='international_no_of_inquiry_".$form_attributes_data->form_id."_".$form_attributes_data->id."_".$more_form_attributes_data->id."' name='international_no_of_inquiry[]' type='text' class='form-control international-no-of-inquiry' placeholder='Enter No Of Inquiry'  value='' oninput='updateTotal_new_international(".$form_attributes_data->form_id.",".$form_attributes_data->id.",".$more_form_attributes_data->id.")' data-no_of_inquiry='0' /></td>";
                                $html .= "<input type='hidden' name='international_form_id[]' value='".$form_attributes_data->form_id."'>";
                                $html .= "<input type='hidden' name='international_service_id[]' value='".$service_data->id."'>";
                                $html .= "<input type='hidden' name='international_form_attributes_id[]' value='".$form_attributes_data->id."'>";
                                $html .= "<input type='hidden' name='international_more_form_attributes_id[]' value='".$more_form_attributes_data->id."'>";
                                $html .= "<td><input id='international_move_charge_".$form_attributes_data->form_id."_".$form_attributes_data->id."_".$more_form_attributes_data->id."' name='international_move_charge[]' type='text' class='form-control price-local' placeholder='Enter Rate'  value='' oninput='updateTotal_new_international(".$form_attributes_data->form_id.",".$form_attributes_data->id.",".$more_form_attributes_data->id.")' /></td>";

                                $html .= "<td class='text-end'><span id='replace_international_final_price_".$form_attributes_data->form_id."_".$form_attributes_data->id."_".$more_form_attributes_data->id."'></span> <input id='replace_hidden_international_final_price_".$form_attributes_data->form_id."_".$form_attributes_data->id."_".$more_form_attributes_data->id."' name='international_finalprice_".$form_attributes_data->form_id."_".$form_attributes_data->id."[]' type='hidden' value='' /></td>
                    </tr>";
                                $i++;
                            }

                            $html .= '</tbody>';
                            $html .= '</table>';
    
                            $html .= '</div>';  
                            $html .= '</div>';  
                            $html .= '</div>'; 


                            $html .= '<div class="col-md-6 col-xl-4 ms-auto">';
                            $html .= '<div class="table-responsive">';
                            $html .= '<table class="invoice-table-two table">';
                            $html .= '<tbody><tr><th>Total :</th><td><span id="international-total-span_'.$form_attributes_data->form_id.'_'.$form_attributes_data->id.'"></span></td></tr></tbody>';
                            $html .= '</table>';
                            $html .= '</div>';
                            $html .= '</div>';
                            $html .= '<input type="hidden" name="international_total[]" id="international_total_'.$form_attributes_data->form_id.'_'.$form_attributes_data->id.'" value="0">';


                            /*international move code end*/

                        }

                        
                            // echo "<pre>";print_r($more_form_attributes);echo "</pre>";
                    }

                }

                

            }
           

        }
        // else{
        //     echo "no";
        // }
        echo $html;
        //exit;
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
    
        if (!empty($subservice_id)) {    
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
            $html .= '<tr><th>Sub Services</th><th class="text-end">Number of Leads</th><th class="text-end">Price</th><th class="text-end">Final Price</th></tr>';
            $html .= '</thead>';
    
            $html .= '<tbody>';
            $total = 0;
    
            if ($result != '' && count($result) > 0) {
                for ($i = 0; $i < count($result); $i++) {

                    $sessionKey = 'subservice_price_session_' . $result[$i]->id;

                    if(Session::has($sessionKey)){
                        $val = Session::get($sessionKey);
                    }else{
                        $val = 0;
                    }

                    $sessionKey_new = 'subservice_no_of_inquiry_session_' . $result[$i]->id;

                    if(Session::has($sessionKey_new)){
                        $val_no_of_inquiry = Session::get($sessionKey_new);
                    }else{
                        $val_no_of_inquiry = $result[$i]->no_of_inquiry;
                    }

                    $final_price = $val_no_of_inquiry * $val;

                    $html .= "<tr><td>".$result[$i]->subservicename."</td>";
                    // $html .= "<td class='text-end'>".$result[$i]->no_of_inquiry."</td>";
                    $html .= "<td class='text-end'>
                    <input id='no_of_inquiry_".$i."' name='no_of_inquiry[]' type='text' class='form-control no-of-inquiry-input' placeholder='Enter Number of Leads' oninput='updateTotal_new(".$i.",".$result[$i]->id.")' data-no_of_inquiry='".$result[$i]->no_of_inquiry."' data-index='".$i."' value='".$val_no_of_inquiry."' /></td>";
                    // $html .= "<td class='text-end'>".$result[$i]->charge."</td>";
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

    function subscription_replace(){
        
        $id = $_POST['id'];
        $subscription_data = DB::table('subscription')->where('id', $id)->first();

        $subscription_attribute = DB::table('subscription_subservice_attribute')->where('subscription_id', $id)->get()->toArray();

        $subscription_city = explode(',',$subscription_data->city);
        $city_names = [];

        // Loop through each ID and get the corresponding city name using a helper function
        foreach ($subscription_city as $city_id) {
            // Assuming getCityNameById is your helper function
            $city_names[] =  Helper::cityname(trim($city_id)); // trim to remove any extra whitespace
        }
        $city_names = implode(',',$city_names);
        //echo "<pre>";print_r($city_names);echo "</pre>";exit;

        $html='<div class="row"><div class="col-md-12">';

        $html.='<table class="invoice-table table table-bordered mb-10" style="
    margin-bottom: 14px;
">';    
                            
                                               
                                $html.='<tr>';
                                    $html.='<td>City</td>';
                                    $html.='<td>'.$city_names.'</td>';
                                $html.='</tr>';
                            
                $html.='</table>';
        //$html.='<p><strong>City Details : </strong>'.$city_names.'</p>';
        if($subscription_data->type_of_subscription == 0){
            $html.='<div class="table-responsive">';
            $html.='<h5>Package Detail</h5>';
                $html.='<table class="invoice-table table table-bordered">';
                        $html.='<thead>
                                    <tr>
                                        <th>Services</th>
                                        <th>Sub Services</th>
                                    </tr>
                                </thead>';
                            foreach($subscription_attribute as $subscription_attribute_data){
                                $html.='<tr>';
                                    $html.='<td>'.Helper::servicename($subscription_attribute_data->service_id).'</td>';
                                    $html.='<td>'.Helper::subservicename($subscription_attribute_data->subservice_id).'</td>';
                                $html.='</tr>';
                            }
                $html.='</table>';

                $html.='<div class="col-md-6 col-xl-4 ms-auto">
                            <div class="table-responsive">
                                <table class="invoice-table-two table">
                                    <tbody>
                                        <tr>
                                            <th>Total Inquiry :</th>
                                            <td><span>'.$subscription_data->no_of_inquiry_package.'</span></td>
                                        </tr>
                                        <tr>
                                            <th>Total Price :</th>
                                            <td><span>'.$subscription_data->price_package.'</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>';
            $html.='</div>';
        }else{
            
            

            $subscription_attribute = DB::table('subscription_subservice_attribute')
            ->where('subscription_id', $id)
            ->where(function($query) {
                $query->where('service_id', '!=', 30)
                      ->orWhere('subservice_id', '!=', 23);
            })
            ->where(function($query) {
                $query->where('service_id', '!=', 30)
                      ->orWhere('subservice_id', '!=', 26);
            }) ->get();
                                        // ->get()->toArray();
            // $rawSql = $query->toSql();
            // $bindings = $query->getBindings();
            // $interpolatedSql = vsprintf(str_replace('?', '%s', $rawSql), $bindings);
            // echo $interpolatedSql;
            // echo "<pre>";print_r($subscription_attribute);echo "</pre>";exit;

            if(!empty($subscription_attribute)){

                $html.='<div class="table-responsive">';

            $html.='<h5>Leads Detail</h5>';

            $html.='<table class="invoice-table table table-bordered">';
            $html.='<thead>
                        <tr>
                            <th>Services</th>
                            <th>Sub Services</th>
                            <th>Per lead Price</th>
                        </tr>
                    </thead>';

                foreach($subscription_attribute as $subscription_attribute_data){
                    $html.='<tr>';
                        $html.='<td>'.Helper::servicename($subscription_attribute_data->service_id).'</td>';
                        $html.='<td>'.Helper::subservicename($subscription_attribute_data->subservice_id).'</td>';
                    

                    $html.='<td>'.$subscription_attribute_data->charge.'</td>';
                    $html.='</tr>';
                }

                $html.='</table>';

                $html.='</div>';
            }
        
            

            

           
            $html.='<div class="table-responsive">';

            //$html.='<h5>Leads Detail</h5>';

            $service_explode = explode(',', $subscription_data->services);

            if(in_array('30',$service_explode)){

                $totalInternationalCharge = DB::table('subscription_international_move_attribute')
                                        ->where('subscription_id', $subscription_data->id)
                                        ->sum('local_move_charge');

                $totallocalCharge = DB::table('subscription_local_move_attribute')
                                            ->where('subscription_id', $subscription_data->id)
                                            ->sum('local_move_charge');
                $condition_not_in_local_international = 0;
                if($totalInternationalCharge > 0){

                    $type_of_move = 'International Move';

                    $data_moving =DB::table('subscription_international_move_attribute')
                                    ->where('subscription_id', $subscription_data->id)
                                    ->get()->toArray();
                    //->sum('local_move_charge');

                    $condition_not_in_local_international = 1;

                }elseif($totallocalCharge > 0){
                    $type_of_move = 'Local Move';
                    $data_moving =DB::table('subscription_local_move_attribute')
                                ->where('subscription_id', $subscription_data->id)
                                ->get()->toArray();

                    $condition_not_in_local_international = 1;
                }else{
                    $type_of_move = 'Leads Detail';
                    $data_moving =DB::table('subscription_local_move_attribute')
                                ->where('subscription_id', $subscription_data->id)
                                ->get()->toArray();

                    $condition_not_in_local_international = 0;
                }

                if($condition_not_in_local_international == 0){

                    // $subscription_attribute = DB::table('subscription_subservice_attribute')
                    //                     ->where('subscription_id', $id)
                    //                     //->whereNotIn('service_id', [30])
                    //                     ->get()->toArray();

                    // $html.='<div class="table-responsive">';

                    // $html.='<h5>Leads Detail</h5>';
        
                    // $html.='<table class="invoice-table table table-bordered">';
                    // $html.='<thead>
                    //             <tr>
                    //                 <th>Services</th>
                    //                 <th>Sub Services</th>
                    //                 <th>Per lead Price</th>
                    //             </tr>
                    //         </thead>';
        
                    //     foreach($subscription_attribute as $subscription_attribute_data){
                    //         $html.='<tr>';
                    //             $html.='<td>'.Helper::servicename($subscription_attribute_data->service_id).'</td>';
                    //             $html.='<td>'.Helper::subservicename($subscription_attribute_data->subservice_id).'</td>';
                            
        
                    //         $html.='<td>'.$subscription_attribute_data->charge.'</td>';
                    //         $html.='</tr>';
                    //     }
        
                    //     $html.='</table>';
        
                    //     $html.='</div>';

                }else{

                
                $html.='<h5 style="margin: 3% 0;">'.$type_of_move.'</h5>';
                $html.='<table class="invoice-table table table-bordered">';
                $html.='<thead>
                            
                            <tr>
                                <th>Package</th>
                                <th>Size of House</th>
                                <th>Rate/1 Lead</th>
                            </tr>
                        </thead>';
                        foreach($data_moving as $data_moving_new){

                            if($data_moving_new->local_move_charge > 0){

                            //

                        $package_name = DB::table('form_attributes')
                                        ->where('id',$data_moving_new->form_attributes_id)
                                        ->where('form_id',$data_moving_new->form_id)->first();
                                        // echo "<pre>";print_r($package_name);echo "</pre>";exit;

                        $size_of_house_name = DB::table('more_form_attributes')
                                        ->where('id',$data_moving_new->more_form_attributes_id)
                                        ->where('attr_id',$data_moving_new->form_attributes_id)
                                        ->where('form_id',$data_moving_new->form_id)->first();
                        $html.='<tr>';

                                $html.='<td>'.$package_name->form_option.'</td>';
                                $html.='<td>'.$size_of_house_name->more_form_option.'</td>';
                                $html.='<td>'.$data_moving_new->local_move_charge.'</td>';
                        $html.='</tr>';
                            }
                        }


                $html.='</table>';

                 }

            }

            $html.='</div>';


            

            
        }   





        $html.='</div></div>';

        echo $html;
        // echo "<pre>";print_r($subscription_data);echo "</pre>";exit;

    }


 






}