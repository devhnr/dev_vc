<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Email;
use DB;
use Cart;
use Session;

class Cartcontroller extends Controller
{

    public function cart(){

        $data['meta_title'] = "";
        $data['meta_keyword'] = "";
        $data['meta_description'] = "";

        return view('front.cart',$data);
    }

    
    function add_to_cart(){

        $package_id = $_POST['package_id'];
        $qty = $_POST['qty'];

        if($package_id != ''){

            $package_data = DB::table('packages')->where('id',$package_id)->first();

            if($package_data->image != ''){
                $image = $package_data->image;
            }else{
                $image = "no-image.png";
            }

            $service_data = DB::table('services')->where('id',$package_data->service_id)->first();
            $subservices_data = DB::table('subservices')->where('id',$package_data->subservice_id)->first();
        //    echo "<pre>";print_r($subservices_data);echo "</pre>";exit;
            $packagecategory_data = DB::table('package_categories')->where('id',$package_data->packagecategory_id)->first();

            if($package_data->booking_service_per > 0 && $package_data->booking_service_per != '') {
                $servicepercentage = $package_data->booking_service_per;
            }
            elseif($subservices_data->servicepercentage > 0 && $subservices_data->servicepercentage != ''){
                $servicepercentage = $subservices_data->servicepercentage;
               
            }else{
                $servicepercentage = 0;
            }


            // if($subservices_data->servicepercentage > 0 && $subservices_data->servicepercentage != '') {
            //     $servicepercentage = $subservices_data->servicepercentage;
            // }else{
            //     $servicepercentage = 0;
            // }
            

            //echo "<pre>";print_r($subservices_data);echo "</pre>";exit;

            $price = $package_data->price;

            if($package_data->discount > 0){

                if($package_data->discount_type == 0){
    
                    $disc_price_new = $price * $package_data->discount /100 ;
    
                    $disc_price = $price - $disc_price_new;
                }elseif($package_data->discount_type == 1){
                    $disc_price = $price - $package_data->discount;
                }else{
                    $disc_price = $price;
                }
    
            }else{
                $disc_price = 0;
            }

            $cartdiscount = $disc_price;

            //echo "<pre>";print_r($service_data);echo "</pre>";exit;

            Cart::add([
            'id' => $package_data->id, 
            'name' => $package_data->name, 
            'qty' => $qty, 
            'price' => $package_data->price, 
            'options' => [
                'service_id' => $package_data->service_id,
                'service_name' => $service_data->servicename,
                'subservice_id' => $package_data->subservice_id,
                'subservice_name' => $subservices_data->subservicename,
                'subservice_description' => $subservices_data->description,
                'packagecategory_id' => $package_data->service_id,
                'packagecategory_name' => $packagecategory_data->name,
                'page_url' => $package_data->page_url,
                'product_discount_amount' => $cartdiscount,
                'image' => $image,
                'discount' => $package_data->discount,
                'discount_type' => $package_data->discount_type,
                'subservice_booking_percentage' => $servicepercentage,
                
            ]]);

            echo $cartItems =  Cart::content()->count();

        }   
    }


    function add_to_cart_book(){

        $package_id = $_POST['package_id'];
        $qty = $_POST['qty'];

        if($package_id != ''){

            $package_data = DB::table('packages')->where('id',$package_id)->first();

            if($package_data->image != ''){
                $image = $package_data->image;
            }else{
                $image = "no-image.png";
            }

            $service_data = DB::table('services')->where('id',$package_data->service_id)->first();
            $subservices_data = DB::table('subservices')->where('id',$package_data->subservice_id)->first();
        //    echo "<pre>";print_r($subservices_data);echo "</pre>";exit;
            $packagecategory_data = DB::table('package_categories')->where('id',$package_data->packagecategory_id)->first();

            if($package_data->booking_service_per > 0 && $package_data->booking_service_per != '') {
                $servicepercentage = $package_data->booking_service_per;
            }
            elseif($subservices_data->servicepercentage > 0 && $subservices_data->servicepercentage != ''){
                $servicepercentage = $subservices_data->servicepercentage;
               
            }else{
                $servicepercentage = 0;
            }


            // if($subservices_data->servicepercentage > 0 && $subservices_data->servicepercentage != '') {
            //     $servicepercentage = $subservices_data->servicepercentage;
            // }else{
            //     $servicepercentage = 0;
            // }
            

            //echo "<pre>";print_r($subservices_data);echo "</pre>";exit;

            $price = $package_data->price;

            if($package_data->discount > 0){

                if($package_data->discount_type == 0){
    
                    $disc_price_new = $price * $package_data->discount /100 ;
    
                    $disc_price = $price - $disc_price_new;
                }elseif($package_data->discount_type == 1){
                    $disc_price = $price - $package_data->discount;
                }else{
                    $disc_price = $price;
                }
    
            }else{
                $disc_price = 0;
            }

            $cartdiscount = $disc_price;

            //echo "<pre>";print_r($service_data);echo "</pre>";exit;

            Cart::add([
            'id' => $package_data->id, 
            'name' => $package_data->name, 
            'qty' => $qty, 
            'price' => $package_data->price, 
            'options' => [
                'service_id' => $package_data->service_id,
                'service_name' => $service_data->servicename,
                'subservice_id' => $package_data->subservice_id,
                'subservice_name' => $subservices_data->subservicename,
                'subservice_description' => $subservices_data->description,
                'packagecategory_id' => $package_data->service_id,
                'packagecategory_name' => $packagecategory_data->name,
                'page_url' => $package_data->page_url,
                'product_discount_amount' => $cartdiscount,
                'image' => $image,
                'discount' => $package_data->discount,
                'discount_type' => $package_data->discount_type,
                'subservice_booking_percentage' => $servicepercentage,
                
            ]]);

            echo $cartItems =  Cart::content()->count();

        }   
    }


    function cart_remove(){

        $rowId = $_POST['rowId'];
        Cart::remove($rowId);
        Session::forget('walletdiscount');
        echo Cart::count();
    }
    function cart_remove_book_now(){

        $rowId = $_POST['rowId'];
        Cart::remove($rowId);
        Session::forget('walletdiscount');
        echo Cart::count();
    }

    function update_cart(){
        // echo "<pre>";print_r($_POST);echo "</pre>";exit;
        $rowid = $_POST['rowid'];
        $qty = $_POST['qty'];
        $count = $_POST['count'];
        Cart::update($rowid, $count);
        echo Cart::count();
        
    }
    
}