<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Vendors;
use App\Models\Admin\City;
use App\Models\Admin\UserPermission;
use Illuminate\Support\Facades\Hash;
use DB;
use Image;
use DateTime; 
use Illuminate\Support\Facades\Mail;
class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['vendors_data']=DB::table('users')->where('vendor',1)->orderBy('id','DESC')->get()->toArray();
       
       return view('admin.list_vendors',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data['user_data'] = DB::select('select * from permission order by id desc');
        $data['permission_data'] = UserPermission::orderBy('id','DESC')->get();       
        $data['city_data'] = City::orderBy('id','DESC')->get();   
        $data['service_data'] = DB::table('services')
        ->where('is_active', 0)
        ->orderBy('set_order')
        ->get(); 
      
       
        return view('admin.add_vendors',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo"<pre>";
        // print_r($request->post());
        // echo"</pre>";exit;
        
        $data['role_id']=$_POST['hidden_role_id'];
        $data['name']=$_POST['name'];
        $data['user_name']=$_POST['user_name'];       
        $data['companywebsite']=$_POST['companywebsite'];
        // $data['city']=$_POST['city'];
        if (isset($_POST['city'])) {
            $data['city'] = implode(',', $_POST['city']);
        } else {
            $data['city'] = ''; 
        }
        $data['crole']=$_POST['crole'];
        $data['parentcname']=$_POST['parentcname'];
        $data['establishment_date']=$_POST['establishment_date'];
        $data['tlexpiry']=$_POST['tlexpiry'];
        $data['staff']=$_POST['staff'];
        $data['remarks']=$_POST['remarks'];
        $data['socialmedai']=$_POST['socialmedai'];
        $data['password']=Hash::make ($_POST['password']);        
        $data['email']=$_POST['email'];
        $data['rating']=$_POST['rating'];
        $data['number_of_review']=$_POST['number_of_review'];
        $data['review_link']=$_POST['review_link'];
        $data['short_description']=$_POST['short_description'];
        if($_POST['mobile'] !='')
        {
            $data['mobile']=$_POST['mobile'];
        }
        else
        {
            $data['mobile']=null;
        }
        if (request()->has('serviceList') && !empty(request()->input('serviceList'))) {
            $serviceList = request()->input('serviceList');
            
            if (is_array($serviceList)) {
                $data['serviceList'] = implode(',', $serviceList);
            } else {
                // Handle the case where serviceList is not an array if necessary
                // For example, you might set a default value or throw an error
                $data['serviceList'] = '';
            }
        }
              
        $data['vendor'] = 1;
        $data['is_active'] = 1;

        if ($request->hasFile('company_logo')) 
        {
            $file = $request->file('company_logo');
            $path = public_path('upload/vendors/');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Save the original image
            $file->move($path, $fileName);
            $data['company_logo'] = $fileName;

            // Create a resized copy of the image
            $resizedImage = Image::make($path . $fileName)->resize(60, 60);
            $resizedFileName = uniqid() . '_thumb.' . $file->getClientOriginalExtension();
            $resizedImage->save($path . $resizedFileName);

            // Save the resized image file name in data if needed
            $data['company_logo'] = $resizedFileName;
        }

        if ($request->hasFile('vatcertificate')) 
    {
             
        $file = $request->file('vatcertificate');
             
        $path = public_path('upload/vendors/');
            
        $fileName = uniqid().'.'.$file->getClientOriginalExtension();
       
        $file->move($path, $fileName);
        
       
        $data['vatcertificate']= $fileName;
           
    }
    if ($request->hasFile('trncertificate')) 
    {
             
        $file = $request->file('trncertificate');
             
        $path = public_path('upload/vendors/');
            
        $fileName = uniqid().'.'.$file->getClientOriginalExtension();
       
        $file->move($path, $fileName);
        
       
        $data['trncertificate']= $fileName;
        
           
    }
    if ($request->hasFile('tradelicense')) 
    {
             
        $file = $request->file('tradelicense');
             
        $path = public_path('upload/vendors/');
            
        $fileName = uniqid().'.'.$file->getClientOriginalExtension();
       
        $file->move($path, $fileName);
        
       
        $data['tradelicense']= $fileName;
           
    }

       

   $vendors_id = DB::table('users')->insertGetId($data);

   $year =date('y');
   $data_u['vendor_id'] = "VID" . $year . sprintf("%06d", $vendors_id);

    DB::table('users')->where('id', $vendors_id)->update($data_u);

    if (count($_POST['poc']) > 0 && $_POST['poc'] != '') {

        for ($i = 0; $i < count($_POST['poc']); $i++) {

            if($_POST['poc'][$i] != '')
            {

                $content['p_id'] = $vendors_id;

                $content['poc'] = $_POST['poc'][$i];

                $content['poctitle'] = $_POST['poctitle'][$i];

                $content['c_email'] = $_POST['c_email'][$i];

                $content['telephone'] = $_POST['telephone'][$i];

                $this->insert_attribute($content);

            }

        }

    }
    // echo"<pre>";print_r($data);echo"</pre>";exit;
    return redirect()->route('vendors.index')->with('success', 'Vendor Added Successfully');
    }
    function insert_attribute($content)
    {

        $data['pid'] = $content['p_id'];
        $data['poc'] = $content['poc'];
        $data['poctitle'] = $content['poctitle'];
        $data['c_email'] = $content['c_email'];
        $data['telephone'] = $content['telephone'];
        DB::table('vendors_attribute')->insertGetId($data);

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
       
        
        $data['vendors'] = DB::table('users')->where('id', '=',  $id)->first(); 
        // echo"<pre>";
        // print_r($data['vendors']);
        // echo"</pre>";exit;
        
      
        $data['attribute_data'] = DB::table('vendors_attribute')

        ->select('*')

        ->where('pid', '=',$data['vendors']->id)

        ->get()

        ->toArray();
        


        $data['permission_data'] = UserPermission::orderBy('id','DESC')->get();       
        $data['city_data'] = City::orderBy('id','DESC')->get();
        $data['service_data'] = DB::table('services')->where('is_active', 0)->orderBy('set_order')->get();
        return view('admin.edit_vendors',$data);

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
        // echo"<pre>";
        // print_r($request->all());
        // echo"</pre>";exit;

        $data['role_id']=$_POST['hidden_role_id'];
        $data['name']=$_POST['name'];
        $data['user_name']=$_POST['user_name'];       
        $data['companywebsite']=$_POST['companywebsite'];
        // $data['city']=$_POST['city'];
        // $data['city'] = implode(',', $_POST['city']);  
        if (isset($_POST['city'])) {
            $data['city'] = implode(',', $_POST['city']);
        } else {
            $data['city'] = ''; 
        }
        $data['crole']=$_POST['crole'];
        $data['parentcname']=$_POST['parentcname'];
        $data['establishment_date']=$_POST['establishment_date'];
        $data['tlexpiry']=$_POST['tlexpiry'];
        $data['staff']=$_POST['staff'];
        $data['remarks']=$_POST['remarks'];
        $data['socialmedai']=$_POST['socialmedai'];
        $data['rating']=$_POST['rating'];
        $data['number_of_review']=$_POST['number_of_review'];
        $data['review_link']=$_POST['review_link'];
        $data['short_description']=$_POST['short_description'];
        // $data['password']=Hash::make ($_POST['password']);        
        $data['email']=$_POST['email'];
        if($_POST['mobile'] !='')
        {
            $data['mobile']=$_POST['mobile'];
        }
        else
        {
            $data['mobile']=null;
        }  
        
        if (isset($_POST['serviceList']) && !empty($_POST['serviceList'])) {
            $serviceList = $_POST['serviceList'];
        
            if (is_array($serviceList) && count($serviceList) > 0) {
                $data['serviceList'] = implode(',', $serviceList);
            } else {
                $data['serviceList'] = '';
            }
        } else {
            $data['serviceList'] = null;
        }
        
            
       


        $data['vendor'] = 1;

         if ($request->hasFile('company_logo')) 
        {
            $file = $request->file('company_logo');
            $path = public_path('upload/vendors/');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Save the original image
            $file->move($path, $fileName);
            $data['company_logo'] = $fileName;

            // Create a resized copy of the image
            $resizedImage = Image::make($path . $fileName)->resize(60, 60);
            $resizedFileName = uniqid() . '_thumb.' . $file->getClientOriginalExtension();
            $resizedImage->save($path . $resizedFileName);

            // Save the resized image file name in data if needed
            $data['company_logo'] = $resizedFileName;
        }

        if ($request->hasFile('vatcertificate')) 
    {
             
        $file = $request->file('vatcertificate');
             
        $path = public_path('upload/vendors/');
            
        $fileName = uniqid().'.'.$file->getClientOriginalExtension();
       
        $file->move($path, $fileName);
        
       
        $data['vatcertificate']= $fileName;
           
    }
    if ($request->hasFile('trncertificate')) 
    {
             
        $file = $request->file('trncertificate');
             
        $path = public_path('upload/vendors/');
            
        $fileName = uniqid().'.'.$file->getClientOriginalExtension();
       
        $file->move($path, $fileName);
        
       
        $data['trncertificate']= $fileName;
        
           
    }
    if ($request->hasFile('tradelicense')) 
    {
             
        $file = $request->file('tradelicense');
             
        $path = public_path('upload/vendors/');
            
        $fileName = uniqid().'.'.$file->getClientOriginalExtension();
       
        $file->move($path, $fileName);
        
       
        $data['tradelicense']= $fileName;
           
    }

    //    echo"<pre>";
    //     print_r($data);
    //     echo"</pre>";exit;


//    $vendors_id = DB::table('users')->insertGetId($data);
    DB::table('users')->where('id', $id)->update($data);

    if (count($_POST['poc1']) > 0 && $_POST['poc1'] != '') {

        for ($i = 0; $i < count($_POST['poc1']); $i++) {



            if($_POST['poc1'][$i] != ''){



                $content['p_id'] = $id;

                $content['poc'] = $_POST['poc1'][$i];

                $content['poctitle'] = $_POST['poctitle1'][$i];

                $content['c_email'] = $_POST['c_email1'][$i];

                $content['telephone'] = $_POST['telephone1'][$i];

                $this->insert_attribute($content);

            }

        }

    }

    if ($request->pocu != '' && count($request->pocu) > 0 ) {

        for ($i = 0; $i < count($_POST['pocu']); $i++) {



            if($_POST['pocu'][$i] != ''){



                $content['p_id'] = $id;

                $content['poc'] = $_POST['pocu'][$i];

                $content['poctitle'] = $_POST['poctitleu'][$i];

                $content['c_email'] = $_POST['c_emailu'][$i];

                $content['telephone'] = $_POST['telephoneu'][$i];

                $content['updateid1xxx'] = $_POST['updateid1xxx'][$i];

                $this->update_attribute($content);

            }

        }

    }
    return redirect()->route('vendors.index')->with('success','Vendors Updated Successfully.');

    }

    function update_attribute($content){



        $data['pid'] = $content['p_id'];

        $data['poc'] = $content['poc'];

        $data['poctitle'] = $content['poctitle'];

        $data['c_email'] = $content['c_email'];

        $data['telephone'] = $content['telephone'];       


        DB::table('vendors_attribute')->where('id', $content['updateid1xxx'])->update($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       

        $delete_id = $request->selected;

        // echo"<pre>";
        // print_r($delete_id);
        // echo"</pre>";exit;

        DB::table('users')->whereIn('id',$delete_id)->delete();

        return redirect()->route('vendors.index')->with('success','Vendors has been deleted successfully');
    }

    public function remove_vendors_att (Request $request){

        $service = $request->pid;

        $id = $request->id;

        $result = DB::table('vendors_attribute')->where('pid', '=',$service)->where('id', '=',$id)->delete();

        return redirect()->route('vendors.edit',$service)->with('success','Vendors Attribute has been deleted successfully');

    }

    public  function change_status_vendors(){



        $id=$_POST['id'];

        $value=$_POST['value'];  
        
        // echo"<pre>";
        // print_r($_POST);
        // echo"</pre>";exit;
        
        if($value == 0){

            $vendor_data = DB::table('users')->where('id',$id)->first();

            $dateTime = new DateTime($vendor_data->created_at);
            $year = $dateTime->format("y");
            
            $vendorId = $vendor_data->vendor_id;

            $htmll = '<!doctype html> <html>
                <head>
                    <meta charset="utf-8">
                    <title>Registration Email</title>
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
                            <p>Dear '.$vendor_data->name.',</p>
                            
                            <p>Congratulations! We are delighted to inform you that your registration as a vendor on VendorsCity has been accepted. Welcome aboard!</p>';

                            $htmll_service = '<strong>Services Offered:</strong> ';
                            $services = explode(',', $vendor_data->serviceList);
                            $count = count($services);
                            foreach($services as $key => $service){

                                $htmll_service .= \Helper::servicename($service);
                                if ($key < $count - 1) {
                                    $htmll_service .= ', '; // Add comma and space for all except the last item
                                }
                                  }
                            
                            $htmll .='<p><strong>Your Vendor ID:</strong> '.$vendorId.' <br> '.$htmll_service.'</p>';

                           
                            
                            $htmll .=' 

                            <p><strong>Your Vendor Login Details:</strong> <br>Email: '.$vendor_data->email.'</p>
                            <p>You can now access your vendor dashboard and start offering your services to our customers. Here are some key actions you can take in your dashboard:</p>
                            <ol>
                                <li><b>Manage Bookings:</b> View, accept, manage bookings and quote requests from customers.
                                    
                                </li>
                                <li><b>View Payments:</b> Track your earnings and payment history.
                                </li>
                                <li><b>Customer Communication:</b> Communicate with customers and address their queries.
                                </li>
                            </ol>

                            <p><a class="btnlink" href="'.url("admin").'">Get Started</a></p>

                            <p>If you have any questions or need assistance, feel free to reach out to us at <a href="mailto:vendors@vendorscity.com">vendors@vendorscity.com</a>. We are here to support you throughout your journey with VendorsCity.
                            </p>
                            
                            
                            <p>Once again, welcome to our platform, and we look forward to a successful partnership!</p>

                            
                        </div>
                        <div class="email_footer">
                            <h3>The VendorsCity Team</h3>
                            <div class="email_footer_div">
                                <div class="footer_left">
                                    <img style="width:100%;" src="'.asset("public/site/images/vcfaviconwap.png").'"" >
                                </div>
                                <div class="footer_right">
                                    <p>Questions? Email <a style="color: #555;" href="mailto:vendors@vendorscity.com">vendors@vendorscity.com</a></p>
                                    <p>VendorsCity Portal LLC</p>
                                    <div class="footer_links">
                                <a href="'.url("/terms-of-service").'">Terms of Use</a>
                                <a href="'.url("/privacy-policy").'">Privacy Policy</a>
                                <a href="'.url("/contact").'">Contact Us</a>
                                </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
            </html>';

            // echo $htmll;exit;
            // echo"<pre>";print_r($vendor_data);echo"</pre>";exit;

            $subject = "Important Update: Your Vendor Account at VendorsCity";
            $admin = $vendor_data->email;                  
            $ccRecipients = [];
            
            Mail::send([], [], function($message) use($htmll, $admin, $subject,$ccRecipients) {
                $message->to($admin);
                $message->subject($subject);
                foreach ($ccRecipients as $ccRecipient) {
                    $message->cc($ccRecipient);
                }
                $message->html($htmll);
            });
        }

        DB::table('users')->where('id',$id)->update(array('is_active'=>$value));

        echo"1";

    }

    function vendor_check_mail(){

        $email = $_POST['email']; // Replace with the email you want to search for

        $result = DB::table('users')
            ->select('*')
            ->where('email', $email)
            ->first();

        if ($result) {
            return 1;
        } else {
            return 0;
        }

            echo $result;
    }

    function vendor_edit_check_mail(){

        $email = $_POST['email'];
        $vendor_id = $_POST['vendor_id'];

        $result = DB::table('users')
            ->select('*')
            ->where('email', $email)
            ->where('id', '!=', $vendor_id) // Exclude user with ID 1
            ->first();

        if ($result) {
            return 1;
        } else {
            return 0;
        }

            echo $result;
    }

    public function subscription($id){

        $data['id'] = $id;
        return view('admin.subscription_page',$data);
    }
}