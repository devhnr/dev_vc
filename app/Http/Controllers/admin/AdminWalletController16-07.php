<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Wallet;
use Auth;
use DB;
use DateTime; 
use Illuminate\Support\Facades\Mail;

class AdminWalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data['wallet_data'] = Wallet::orderBy('id', 'DESC')->get();  
        
       return view('admin.list_adminwallet',$data);
       
    }
    public function vendors_wallet($id)
    {
       
        // echo"<pre>";
        // print_r($id);
        // echo"</pre>";exit;
        $data['wallets_data'] = Wallet::where('vendors_id',$id)->orderBy('id', 'DESC')->get();
        
        return view('admin.list_vendorswallet',$data);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['error'] = "";
        $data['all_vendor'] = DB::table('users')->where('vendor',1)->get()->toArray();
        return view('admin.add_adminwallet',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['vendors_id'] = $request->input('vendor_id');
        $data['payment'] = $request->input('payment_type');
        $data['price'] = $request->input('price');
        $data['add_deduct'] = 0;
        $data['status'] = 0;

        $wallet_id = DB::table('wallets')->insertGetId($data);


        $vendor_data_new = DB::table('users')->where('id',$data['vendors_id'])->first();
        $year =date('y');

        $data_u['transaction_id'] = "TID-".$vendor_data_new->vendor_id."-" . $year ."-". sprintf("%06d", $wallet_id);
       DB::table('wallets')->where('id', $wallet_id)->update($data_u);

       return redirect()->route('adminwallet.index')->with('success', 'Admin Wallet Added Successfully');

        //echo"<pre>";print_r($request->all());echo"</pre>";exit;
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
        //echo"<pre>";
        // print_r($value);
        // echo"</pre>";exit;
    }
    public  function change_status_wallet(){

        $id = $_POST['id'];
        $vendorid = $_POST['vendorid'];
        $value = $_POST['value'];

        // Update 'wallets' table
        DB::table('wallets')->where('id', $id)->update(['status' => $value]);


        $vendor_data = DB::table('users')->where('id',$vendorid)->first();
        
        // Retrieve data from 'wallets' table, including the 'price' column
        $walletData = DB::table('wallets')->where('id', $id)->first();

        if($value == 1){
            $wallet_amount = $vendor_data->wallet_amount + $walletData->price;
        }else{
            $wallet_amount = $vendor_data->wallet_amount - $walletData->price;
        }

        $data_wa['wallet_amount'] = $wallet_amount;

        DB::table('users')->where('id', $vendorid)->update($data_wa);

        // Assuming 'users' table has a column 'wallet_amount', update it
        // DB::table('users')->where('id', $vendorid)->update([
        //     'wallet_amount' => DB::raw('wallet_amount ' . ($value == 0 ? '-' : '+') . ' ' . $walletData->price),
        //     // Adjust column names as needed
        // ]);

        if($value == 1){

            
            $wallets_data = DB::table('wallets')->where('id',$id)->first();
            $vendor_data_new = DB::table('users')->where('id',$vendorid)->first();
            

            $dateTime = new DateTime($wallets_data->created_at);
            $year = $dateTime->format("y");
            
            $TransactionId = $wallets_data->transaction_id;

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
                            
                            <p>We are pleased to inform you that your funds request of '.$wallets_data->price.' AED has been approved and successfully added to your account wallet. </p>';

                           
                            $htmll .=' </p>

                            <p>Here are the details:</p>
                            <ul>
                                <li>Requested Amount: '.$wallets_data->price.' AED </li>
                                <li>Approval Date: '.$newDate = date("d-m-Y", strtotime($wallets_data->created_at)).'</li>
                                <li>Transaction ID: '.$TransactionId.'</li>
                                <li>New Wallet Balance: '.$vendor_data_new->wallet_amount.' AED</li>
                                
                            </ul>

                            <p>You can now utilize these funds to purchase subscriptions for acquiring leads on VendorsCity. Should you require any assistance or have further questions, please dont hesitate to reach out to us by replying to this email.
</p>

                            
                        </div>
                        <div class="email_footer">
                            <h3>Accounts Team</h3>
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
            $subject = "Funds Approval Confirmation";
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


             /* notification sectio start */
                $data_notification['vendor_id'] = $vendor_data->id;
                $data_notification['subject'] = 'Your added fund has been approved. ';
                $data_notification['added_datetime'] = date('Y-m-d h:i:s');

                DB::table('notification')->insert($data_notification);
            /* notification sectio end */

            //echo"<pre>";print_r($vendor_data);echo"</pre>";exit;
        }
        
        
        
        echo "1";



    }
}