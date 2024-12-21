<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Wallet;
use Auth;
Use DB;
use Session;
use Stripe\Stripe;
use Stripe\Charge;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor_data = Auth::user();       
        
        $data['wallet_data'] = Wallet::where('vendors_id', $vendor_data->id)->orderBy('id', 'DESC')->get();        
        return view('admin.list_wallet',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_wallet');
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
      $vendor_id = Auth::user()->id;
      

      

       $wallet= new Wallet;
       $wallet->price=$request->price;
       $wallet->payment=$request->payment;
       $wallet->vendors_id=Auth::user()->id;
       $wallet->add_deduct=0;
       $wallet->status=0; 
       //$wallet->transaction_id=$transaction_id; 



       if ($request->payment == 0){
            $wallet->payment_status='Success';
       }
       if ($request->payment == 1){
            $wallet->payment_status='Fail';
       }

       $wallet->save();

       $wallet_id = $wallet->id;

       $vendor_data_new = DB::table('users')->where('id',$vendor_id)->first();
       $year =date('y');
       $data_u['transaction_id'] = "TID-".$vendor_data_new->vendor_id."-" . $year ."-". sprintf("%06d", $wallet_id);
       DB::table('wallets')->where('id', $wallet_id)->update($data_u);

       /* notification sectio start */
       $data_notification['vendor_id'] = 1;
       $data_notification['subject'] = 'Vendor '.$vendor_data_new->name.' has added amount '.$request->price.'';
       $data_notification['added_datetime'] = date('Y-m-d h:i:s');

       DB::table('notification')->insert($data_notification);
   /* notification sectio end */


       Session::put('wallet_id', $wallet_id);

       if ($request->payment == 0){
        return redirect()->route('wallet.index')->with('success',"Wallet Data Added Successfully");
       }
       if ($request->payment == 1){
           
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

            $response = $stripe->checkout->sessions->create([
                'line_items' => [
                  [
                    'price_data' => [
                      'currency' => 'aed',
                      'product_data' => [
                          'name' => 'Wallet'
                      ],
                      'unit_amount' => $request->price*100,
                    ],
                    'quantity' => 1,
                  ],
                ],
                'metadata' => [
                    'user_id' => Auth::user()->id, // Add user's ID to metadata
                ],
                'mode' => 'payment',
                'success_url' => route('paymentSuccess'),
                'cancel_url' => route('paymentFail'),
            ]);

            if(isset($response->id) && $response->id != ''){
                Session::put('stripe_session_id', $response->id);
                return redirect($response->url);
            }else{
                return redirect()->route('paymentFail');
            }
       }
    }

    public function paymentSuccess(Request $request){
        $stripe_session_id = Session::get('stripe_session_id');

        $wallet_id = Session::get('wallet_id');

        if(isset($stripe_session_id)){

            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

            $response = $stripe->checkout->sessions->retrieve($stripe_session_id);

            if($response->status == 'complete'){

                $data_u['payment_id'] = $response->id; 
                $data_u['payment_status'] = "Success";
                $data_u['status'] = 1;

                $orderdata = DB::table('wallets')->where('id',$wallet_id)->update($data_u);

                // Retrieve data from 'wallets' table, including the 'price' column
                $walletData = DB::table('wallets')->where('id', $wallet_id)->first();
                $value = 1;
                // Assuming 'users' table has a column 'wallet_amount', update it
                DB::table('users')->where('id', $walletData->vendors_id)->update([
                    'wallet_amount' => DB::raw('wallet_amount ' . ($value == 0 ? '-' : '+') . ' ' . $walletData->price),
                    // Adjust column names as needed
                ]);

                return redirect()->route('wallet.index')->with('success',"Wallet Data Added Successfully");
 
            }
            
        }else{
            return redirect()->route('paymentFail');
        }
    }

    function paymentFail(Request $request){
        
        session()->forget('wallet_id');
        session()->forget('stripe_session_id');
        
        return redirect()->route('wallet.index')->with('fail',"Payment Fail");

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
}