<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $startdate = $request->s_date;
        $enddate = $request->e_date;
        $servicename = $request->servicename;
        $customer_name = $request->customer_name;

         $query= DB::table('packages_enquiry');

        if ($startdate !='')
        {   
            $query = $query->where('added_date', '>=', date('Y-m-d', strtotime($startdate)));
        }

        if ($enddate !='')
        {   
            $query = $query->where('added_date', '<=', date('Y-m-d', strtotime($enddate)));
        }    
        if ($servicename !='')
        {
            $query=$query->where('service_id', $servicename);
        }
        if ($customer_name !='')
        {
            $query=$query->where('name', $customer_name);
        }
        

        $data['startdate'] =$startdate;
        $data['enddate'] =$enddate;
        $data['filter_service_id'] =$servicename;
        $data['filter_customer_name'] =$customer_name;

        $data['service_data']=DB::table('services')->get();

        $data['system']=DB::table('system')->first();

        $data['customer_data'] = DB::table('packages_enquiry')->groupBy('name')->get();

        $data['packages_data'] = $query->orderBy('id','DESC')->get();
        
        return view('admin.list_packagesenquiry',$data);
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

    public function manual_assign_lead(){

    // echo"<pre>";print_r($_POST);echo"</pre>";exit;
        $inquiry_id = $_POST['inquiry_id'];

        $lead_inquiry_Data = DB::table('packages_enquiry')
            ->where('id', $inquiry_id)
            ->first();

          $package_inquiry_accepted_data = DB::table('package_inquiry_accepted')
                                    ->where('packages_inquiry_id', $inquiry_id)
                                    ->get();

            // echo"<pre>";print_r($package_inquiry_accepted_data);echo"</pre>";exit;

            $html = '';

            if (!$package_inquiry_accepted_data->isEmpty()) {
            $html .= '<table style="margin: 0 auto; border-collapse: collapse; border: 1px solid black; width: 100%;">';
            $html .= '<tr>';
            $html .= '<th style="text-align: center; border: 1px solid black; padding: 10px;" colspan="2">Assign Vendors</th>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<th style="text-align: center; border: 1px solid black; padding: 10px;">Vendor Name</th>';
            $html .= '<th style="text-align: center; border: 1px solid black; padding: 10px;">Assigned Date</th>';
            $html .= '</tr>';
            foreach($package_inquiry_accepted_data as $data){
            $html .= '<tr>';
            $html .= '<td style="text-align: center; border: 1px solid black; padding: 10px;">'.\Helper::vendorsname($data->vendor_id) .'</td>';
            $html .= '<td style="text-align: center; border: 1px solid black; padding: 10px;">'.$data->added_date.'</td>';
            $html .= '</tr>';
            }
            $html .= '</table>';
        }
            
            

        $html .= '<label>Select a Vendor</label>';
        $html .= '<select id="manual_lead_vendor_id" name="manual_lead_vendor_id[]" class="form-control vendor-mul-drop select2" multiple="multiple" placeholder="Please Select Vendor">';
                
                $html .= "<option value='' placeholder='Please Select Vendor'>Select Vendor</option>";

                $vendor_data = DB::table('users')
                                ->whereRaw("FIND_IN_SET(?, serviceList)", [$lead_inquiry_Data->service_id])
                                ->where('vendor', 1)
                                ->where('is_active', 0)
                                ->get()->toArray();

                $more_formfields_details_data = DB::table('more_formfields_details')
                            ->where('package_inquiry_id', $lead_inquiry_Data->id)
                            ->where('form_field_id', 17)
                            ->first();

                if($more_formfields_details_data){
                $form_attributes_data = DB::table('form_attributes')
                            ->where('id',
                            $more_formfields_details_data->formfield_value)
                            ->first();
               

                $city_data = DB::table('cities')
                            ->where('name', $form_attributes_data->form_option)
                            ->first();

                

                if($lead_inquiry_Data->form_type == 'International Move'){
                    $typeOfPackage = 1;
                    
                }elseif($lead_inquiry_Data->form_type == 'Local Move'){
                    $typeOfPackage = 0;
                }else{
                    $typeOfPackage = "";
                }
                
    
              // Initialize an array to keep track of added vendor IDs
                    $processed_vendor_ids = [];

                    // Loop through vendor data
                    foreach ($vendor_data as $vendor_data_new) {
                        $subscription_vendor_data = DB::table('subscription')
                            ->whereRaw('FIND_IN_SET(?, services)', [$lead_inquiry_Data->service_id])
                            ->whereRaw('FIND_IN_SET(?, sub_service)', [$lead_inquiry_Data->subservice_id])
                            ->whereRaw('FIND_IN_SET(?, city)', [$city_data->id])
                            ->where('is_deleted', '=', '0')
                            ->where('type_of_subscription', '=', 2)
                            ->where('type_of_package', '=', $typeOfPackage)
                            ->orderBy('id', 'DESC')
                            ->get()
                            ->toArray();

                        foreach ($subscription_vendor_data as $subscription_vendor_data_new) {
                            // Get vendor IDs from the subscription data
                            $vendor_ids = explode(",", $subscription_vendor_data_new->vendor_id);

                            foreach ($vendor_ids as $vendor_id) {
                                // Check if the vendor already has an entry in the 'package_inquiry_accepted' table for this inquiry
                                $is_already_accepted = DB::table('package_inquiry_accepted')
                                    ->where('packages_inquiry_id', $inquiry_id)
                                    ->where('vendor_id', $vendor_id)
                                    ->exists();
                            
                                // If the vendor is not already accepted and hasn't been processed
                                if (!$is_already_accepted && !in_array($vendor_id, $processed_vendor_ids)) {
                                    $processed_vendor_ids[] = $vendor_id;

                                    $html .= "<option value='" . $vendor_id . "'>" . \Helper::vendorsname($vendor_id) . "</option>";
                                }
                            }
                            
                        }
                    }
                }

        $html .= '</select>';

        $html .= "<input type='hidden' name='inquiry_id' id='inquiry_id' value='" . $inquiry_id . "'/>";
        echo $html;
    
    }

    public function manual_assign_vendor_form(){

        // echo"<pre>";print_r($_POST);echo"</pre>";exit;
        $vendorId = implode(",",$_POST['manual_lead_vendor_id']);
		
		$arrVendor = explode(",",$vendorId);

        $inquiry_id = $_POST['inquiry_id'];

        $package_inquiry = DB::table('packages_enquiry')->where('id',$inquiry_id)->first();

            $more_formfields_details_data = DB::table('more_formfields_details')
                        ->where('package_inquiry_id', $package_inquiry->id)
                        ->where('form_field_id', 17)
                        ->first();

            $form_attributes_data = DB::table('form_attributes')
                        ->where('id',
                        $more_formfields_details_data->formfield_value)
                        ->first();

            $city_data = DB::table('cities')
                        ->where('name', $form_attributes_data->form_option)
                        ->first();

            if($package_inquiry->form_type == 'International Move'){
                $typeOfPackage = 1;
                
            }elseif($package_inquiry->form_type == 'Local Move'){
                $typeOfPackage = 0;
            }else{
                $typeOfPackage = "";
            }

            $subscription_vendor_data= DB::table('subscription')
                        //->where('services',$request->service_id)
                        ->whereRaw('FIND_IN_SET(?, services)', [$package_inquiry->service_id])
                        ->whereRaw('FIND_IN_SET(?, sub_service)', [$package_inquiry->subservice_id])
                        ->whereRaw('FIND_IN_SET(?, city)', [$city_data->id])
                        ->where('is_deleted' , '=' ,'0')
                        ->where('type_of_subscription', '=', 2)
                        ->where('type_of_package', '=', $typeOfPackage)
                        ->orderBy('id','DESC')
                        ->get()->toArray();
                        
           // echo"<pre>";print_r($subscription_vendor_data);echo"</pre>";exit;

            if(!empty($subscription_vendor_data)){

                foreach($subscription_vendor_data as $subscription_vendor){

                   


                    $data_package['packages_inquiry_id'] = $package_inquiry->id;
                    $data_package['vendor_id'] = $subscription_vendor->vendor_id;
                    $data_package['added_date'] = date('Y-m-d');
                    $data_package['accept_reject'] = 0;
                    $data_package['subscription_type'] = 'A';
                    $data_package['subscription_id'] = $subscription_vendor->id;
                    $data_package['no_of_inquiry'] = 1;
                    $data_package['service_id'] = $package_inquiry->service_id;
                    $data_package['subservice_id'] = $package_inquiry->subservice_id;
                    $data_package['type_of_leads'] = $package_inquiry->form_type;

                   $checkInquiryAccept = DB::table('package_inquiry_accepted')->where('packages_inquiry_id',$package_inquiry->id)->where('vendor_id',$subscription_vendor->vendor_id)->first();


                //    echo"<pre>here";print_r($checkInquiryAccept);echo"</pre>";

                   $CountSubscription = DB::table('package_inquiry_accepted')->where('subscription_id',$subscription_vendor->id)->count();

                //    echo"<pre>test";print_r($CountSubscription);echo"</pre>";exit;

                
                   if(empty($checkInquiryAccept) && $subscription_vendor->no_of_inquiry_package > $CountSubscription && in_array($subscription_vendor->vendor_id, $arrVendor)){
                    //  echo "in";

                    $id_package_inquiry_accepted =  DB::table('package_inquiry_accepted')->insertGetId($data_package);
                    
                    $this->vendor_mail($subscription_vendor->vendor_id,$package_inquiry->id);

                    
                
                   }
                }
            }      
            // exit;
            return redirect()->route('enquiry.index')->with('success','The E-mail to the vendor has been sent successfully.');                          
        
    }
    function vendor_mail($vendor_id,$inquiryId)  {

        // echo"<pre>";print_r($vendor_id);echo"</pre>";
        // echo"<pre>";print_r($inquiryId);echo"</pre>";exit;

        $vendor_data = DB::table('users')->where('id', $vendor_id)->first();

        $package_data = DB::table('packages_enquiry')->where('id',$inquiryId)->first();

        $form_fields_data= DB::table('more_formfields_details')->where('package_inquiry_id',$inquiryId)->get()->toArray();

        $field_array = array();
        foreach ($form_fields_data as $key => $values) {

            $form_fields = DB::table('form_fileds')
                ->select('*')
                ->where('id', $values->form_field_id)
                ->first();

                if ($values->formfield_value != '') {
                    // If the key doesn't exist, add the entry to the array
                    $field_array[$key] = array('name' => $form_fields->lable_name, 'value' => $values->formfield_value,'id' => $form_fields->id,'mail_send' => $form_fields->mail_send);
                }
        }

        $html = '<!doctype html> <html>
        <head>
            <meta charset="utf-8">
            <title>Forget Password Email</title>
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
                #table_new,#table_new
                th,
                #table_new td {
                    border: 1px solid black;
                    border-collapse: collapse;
                }

                .custome_td{
                        background-color: #0040E6;
                        color: #fff;
                        padding: 10px 60px 10px 12px;
                        border-bottom-color: #fff !important;
                }
                .custome_td_new{
                        padding: 10px 12px;
                }
                .cutomer_td{
                    text-align:center;
                    background-color: #0040E6;
                    color: #fff;
                    border-bottom-color: #fff !important;
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
                    
                <p>Dear '.$vendor_data->name.',</pre>  
            
                <p>Congratulations! You have successfully accepted a new lead on VendorsCity. Below, you Will find the customer information necessary to fulfill the request.</p>

                <span><strong>Your Quote:</strong></span>';

                    $html.='<table style="width: 100%;">
                        <tr>
                            <th style="text-align: left;border: 1px solid #000;   background-color: #0040e6;color: #fff;padding: 10px 60px 10px 12px;">Quote</th>
                            <th style="text-align: left;border: 1px solid #000;   background-color: #0040e6;color: #fff;padding: 10px 60px 10px 12px;">Additional Information</th> 
                        </tr>
                        <tr>
                            <td style="text-align: left;border: 1px solid #000;padding: 10px 60px 10px 12px;">Based On Final Survey</td>
                            <td style="text-align: left;border: 1px solid #000;padding: 10px 60px 10px 12px;">This lead is chargeable. There was no quote provided to the client. Please quote the client directly via email and copy <a style="color: #555;tetext-decoration: inherit;" href="mailto:support@vendorscity.com">support@vendorscity.com</a> for our record.</td>
                        </tr>
                </table>';

             
                $html.='<br>
                <span><strong>Customer Details:</strong></span>
                <table id="table_new" style="width: 100%;border: 1px solid black;
                    border-collapse: collapse;">
                    
                    <tr>
                        <td class="custome_td" style="background-color: #0040E6;
                        color: #fff;padding: 10px 60px 10px 12px;border-bottom-color: #fff !important;border: 1px solid black;border-collapse: collapse;">Name:</td>
                        <td class="custome_td_new" style=" padding: 10px 12px;border: 1px solid black;border-collapse: collapse;"> '.$package_data->name.'</td>
                    </tr>
                    <tr>
                        <td class="custome_td" style="background-color: #0040E6;
                        color: #fff;padding: 10px 60px 10px 12px;border-bottom-color: #fff !important;border: 1px solid black;border-collapse: collapse;">Email:</td>
                        <td class="custome_td_new" style=" padding: 10px 12px;border: 1px solid black;border-collapse: collapse;"> '.$package_data->email.'</td>
                    </tr>
                    <tr>
                        <td class="custome_td" style="background-color: #0040E6;
                        color: #fff;padding: 10px 60px 10px 12px;border-bottom-color: #fff !important;border: 1px solid black;
                    border-collapse: collapse;">Mobile No:</td>
                        <td class="custome_td_new" style=" padding: 10px 12px;border: 1px solid black;
                    border-collapse: collapse;"> '.$package_data->mobile.'</td>
                    </tr>';

                    if (!empty($field_array)) {
                        $i = 0;
                        foreach ($field_array as $form_field_data) {
                        if (!empty($form_field_data['mail_send']) && $form_field_data['mail_send'] == '1') {
                            
                        $get_more_id = DB::table('more_formfields_details_att')
                        ->where('form_id', '=', $form_field_data['id'])
                        ->where('package_inquiry_id', '=', $inquiryId)
                        ->get()
                        ->toArray();

                    // echo "<pre>";print_r($form_field_data);echo "</pre>";exit;




                            if ($form_field_data['value'] != '') {
                                $html .= '<tr>';
                                            if($form_field_data['id'] != $i){
                                                $html .= '<td class="custome_td" style="background-color: #0040E6;
                                                color: #fff;padding: 10px 60px 10px 12px;border-bottom-color: #fff !important;border: 1px solid black;
                    border-collapse: collapse;">'. $form_field_data['name'] .'</td>  ';
                                            }                                                             

                                        if(is_numeric($form_field_data['value']) && $form_field_data['id'] != 30 && $form_field_data['id'] != 60){
                                                $html.='<td   class="custome_td_new" style=" padding: 10px 12px;border: 1px solid black;
                    border-collapse: collapse;">'. \Helper::form_fields_attr($form_field_data['value']) .'</td>';
                                        }else{
                                        
                                            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif','jfif'];
                                            $extension = pathinfo($form_field_data['value'],PATHINFO_EXTENSION);
                                        
                                            if (in_array(strtolower($extension), $imageExtensions)) { 
                                                // if($form_field_data['id'] == $i){                                                                                                                                              
                                                $html .= '<td colspan="2" class="text-center"><a href="' . url('download/' . $form_field_data['value']) . '">Download</a></td>';
                                            // }
                                            }else{
                                                $html.='<td  class="custome_td_new" style=" padding: 10px 12px;border: 1px solid black;
                                                border-collapse: collapse;" >'.$form_field_data['value'] .'</td>';
                                            }                                                                                         
                                        }
                                        $html.=' </tr>';
                            }
                    // echo "<pre>";print_r($get_more_id);echo "</pre>";
                            
                            if(isset($get_more_id) && count($get_more_id) > 0){
                                foreach ($get_more_id as $get_more_id_data) {    
                                    $html .= '<tr>';
                                    if($form_field_data['value'] == 111 && $form_field_data['id'] == 35){
                                        $html .= '<td class="custome_td" style="background-color: #0040E6;
                                                color: #fff;padding: 10px 60px 10px 12px;border-bottom-color: #fff !important;"> What days of the week would you like the service</td>'; 
                                    }else{
                                        $html .= '<td  class="custome_td" style="background-color: #0040E6;
                                                color: #fff;padding: 10px 60px 10px 12px;border-bottom-color: #fff !important;"> Type of Home</td>';
                                    }
                                    $html .= '                                          
                                    <td class="custome_td_new" style=" padding: 10px 12px;">'. \Helper::form_fields_attr_more($get_more_id_data->more_form_attributes_id) .'</td>                                               
                                </tr>';
                                }
                            }
                            

                        }

                        $i = $form_field_data['id'];

                        }
                    }
                
                
                    $html.='</table>

                    <p><strong>Next Steps:</strong></p>
                    <ol>
                        <li><strong>Contact the Customer:</strong> Confirm the service details and any additional requirements with the customer.</li>
                        <li><strong>Prepare for the Service:</strong>Make necessary preparations to fulfill the customer is request as specified.</li>
                        <li><strong>Complete the Service:</strong>Ensure the service is carried out professionally and to the customer is satisfaction.</li>
                        <li><strong>Payment Collection:</strong>If this is a Cash on Delivery (COD) order, collect the full payment upon job completion.</li>
                    </ol>
                    
                    <p>If you have any questions or need assistance, please do not hesitate to contact our vendor support team at <a style="color: #555;" href="mailto:vendors@vendorscity.com"> vendors@vendorscity.com</a>or call us at 056 VENDORS (836 3677).
                    </p>


            
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
                                <p style="margin:0;">Questions? Email <a style="color: #555;" href="mailto:vendors@vendorscity.com">vendors@vendorscity.com</a></p>
                                <p style="margin:0;">VendorsCity Portal LLC</p>
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
    
        $vendor_att_email=array();
        $vendor_data_attr= DB::table('vendors_attribute')->where('pid',$vendor_id)->get()->toArray();

        // echo"<pre>";print_r($vendor_data_attr);echo"</pre>";exit;

        foreach($vendor_data_attr as $attr_data){
            $vendor_att_email[] = $attr_data->c_email;
        

        }

        if(!empty($vendor_att_email)){
            $cc = implode(',',$vendor_att_email);
        }else{
            $cc = '';
        }
    
        $subject = "VendorsCity Lead Accepted for ".$package_data->name."! Here Are the Details";
        $to = $vendor_data->email;
        $ccRecipients = explode(',', $cc);
        $ccRecipients = array_filter($ccRecipients, 'strlen');
        $staticEmails = ['zafar@quickserverelo.com', 'hello@vendorscity.com'];
        $ccRecipients = array_merge($ccRecipients, $staticEmails);
        Mail::send([], [], function($message) use($html, $to,  $subject,$ccRecipients) {
                $message->to($to,'VendorsCity');
            //  $message->bcc($bccEmails);
                $message->subject($subject);
                //$message->from('devang.hnrtechnologies@gmail.com','VendorsCity');
                foreach ($ccRecipients as $ccRecipient) {
                    $message->cc($ccRecipient);
                }
                $message->html($html);
        });
        
    }

    public function change_status_auto_accept(){

        // echo"<pre>";print_r($_POST);echo"</pre>";exit;
        $auto_accept_package  = $_POST['value'];

        if ($auto_accept_package !== null){
            DB::table('system')
                ->update(['auto_accept_package' => $auto_accept_package]);
       }
       if($auto_accept_package == 1){
        echo "1";
       }else{
        echo "2";
       }
    }

    public function enquiry_details($enquiry_id)
    {
        // echo $enquiry_id;exit;
        $data['packages_enquiry']=DB::table('more_formfields_details')->where('package_inquiry_id',$enquiry_id)->get();
        return view('admin.list_enquiry_acc_rej',$data);
    }
    public function painting_enquiry_details($enquiry_id)
    {
        $data['painting_enquiry_data']=DB::table('painting_enquiry')->where('id',$enquiry_id)->first();
       // echo "<pre>";print_r($data);echo "</pre>";exit;
        return view('admin.list_painting_enquiry_view',$data);
    }
    public function download($filepath)
    {        
        $Downloads = public_path("upload/enquiry_images/{$filepath}");
        return response()->download($Downloads);
    }
    public function filter_data_enquiry(Request $request){
      
        $startdate = $request->input('startdate_fil','');
        $enddate = $request->input('enddate_fil','');
        $servicename = $request->input('filter_service_id_fil','');
        $customer_name = $request->input('filter_customer_name_fil','');

        $query = DB::table('packages_enquiry');

        if ($startdate !='')
        {   
            $query = $query->where('added_date', '>=', date('Y-m-d', strtotime($startdate)));
        }
        if ($enddate !='')
        {   
            $query = $query->where('added_date', '<=', date('Y-m-d', strtotime($enddate)));
        }    
        if ($servicename !='')
        {
            $query=$query->where('service_id', $servicename);
        }
        if ($customer_name !='')
        {
            $query=$query->where('name', $customer_name);
        }

        $data =$query->orderBy('id','DESC')->get()->toArray();

        // echo"<pre>";
        // print_r($data);
        // echo"</pre>";exit;

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Date');
        $sheet->setCellValue('B1', 'Inquiry No');
        $sheet->setCellValue('C1', 'Status');
        $sheet->setCellValue('D1', 'Name');
        $sheet->setCellValue('E1', 'Email');
        $sheet->setCellValue('F1', 'Mobile');
        $sheet->setCellValue('G1', 'Service');
        $sheet->setCellValue('H1', 'Sub Service');
       
        $row = 2;

        if(isset($data)){
            foreach ($data as $data_new) {

                $service_data=DB::table('services')->where('id',$data_new->service_id)->first();

                $sub_service_data=DB::table('subservices')->where('id',$data_new->subservice_id)->first();

                $customer_data = DB::table('packages_enquiry')->groupBy('name')->where('name',$data_new->name)->first();

                // echo"<pre>";print_r($data_new);echo"</pre>";exit;

                if ($data_new->added_date !== null) {
                    $sheet->setCellValue('A' . $row, $data_new->added_date);
                } else {
                   $sheet->setCellValue('A' . $row, '-'); 
                }

                if ($data_new->inquiry_id !== null) {
                    $sheet->setCellValue('B' . $row, $data_new->inquiry_id);
                } else {
                   $sheet->setCellValue('B' . $row, '-'); 
                }
                if ($data_new->count !== null) {
                    $sheet->setCellValue('C' . $row, $data_new->count . '/5 Accepted');
                } else {
                   $sheet->setCellValue('C' . $row, '-'); 
                }
                if ($customer_data->name !== null) {
                    $sheet->setCellValue('D' . $row, $customer_data->name);
                } else {
                   $sheet->setCellValue('D' . $row, '-'); 
                }
                if ($data_new->email !== null) {
                    $sheet->setCellValue('E' . $row, $data_new->email);
                } else {
                   $sheet->setCellValue('E' . $row, '-'); 
                }
                if ($data_new->mobile !== null) {
                    $sheet->setCellValue('F' . $row, $data_new->mobile);
                } else {
                   $sheet->setCellValue('F' . $row, '-'); 
                }
                if ($service_data->servicename !== null) {
                    $sheet->setCellValue('G' . $row, $service_data->servicename);
                } else {
                   $sheet->setCellValue('G' . $row, '-'); 
                }
                if ($sub_service_data->subservicename !== null) {
                    $sheet->setCellValue('H' . $row, $sub_service_data->subservicename);
                } else {
                   $sheet->setCellValue('H' . $row, '-'); 
                }
                $row++;

            }
        }
        $writer = new Xlsx($spreadsheet);

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Enquiry-list.xlsx"');
        header('Cache-Control: max-age=0');

        // Write the file to the browser
        $writer->save('php://output');

        


    }
    
}