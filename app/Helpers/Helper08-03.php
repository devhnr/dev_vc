<?php

namespace App\Helpers;
use Session;
use DB;

class Helper{

	public static function get_user_data(string $string)

    {
        $query = DB::table("users")->where("id",$string);
        if($query->count() > 0)
        {
            return $query->get()->first();
        } else
        {
            return false;
        }
		
    }

    public static function get_front_user_data(string $string)

    {
        $query = DB::table("front_users")->where("id",$string);
        if($query->count() > 0)
        {
            return $query->get()->first();
        } else
        {
            return false;
        }
        
    }

    public static function get_product_data(string $string)

    {
        $query = DB::table("products")->where("id",$string);
        if($query->count() > 0)
        {
            return $query->get()->first();
        } else
        {
            return false;
        }
        
    }

    public static function get_permission_data(string $string)
    {
        $query = DB::table("user_permissions")->where("id",$string);
        if($query->count() > 0)
        {
            return $query->get()->first();
        } else
        {
            return false;
        }
    }

	public static function categoryname(int $id){

		$result = DB::table('categories')->where('id',$id)->first();                                                     
		
        if($result !='' && isset($result)){
            return $result->name;
        }else{
            echo "-";
        }
	}
	
	public static function groupname(string $group_id){
        $query = DB::table('groups')->where('id',$group_id)->first();		
		if ($query) {
			return $query->name;
		} else {
			
			return '-'; 
		}
    }
	public static function countryname(string $country_id){
        $query = DB::table('countries')->where('id',$country_id)->first();		
		if ($query) {
			return $query->country;
		} else {
			
			return '-'; 
		}
    }
    public static function cityname(string $city){
        $query = DB::table('cities')->where('id',$city)->first();		
		if ($query) {
			return $query->name;
		} else {
			
			return '-'; 
		}
    }

    public static function state_name(string $state_id){
        $query = DB::table('states')->where('id',$state_id)->first();      
        if ($query) {
            return $query->state;
        } else {
            
            return '-'; 
        }
    }

    public static function user_role_name(int $id){

		$result = DB::table('user_permissions')->where('id',$id)->first();	
        if($result !='' && isset($result)){
            return $result->cname;
        }else{
            echo "-";
        }        
	}

    public static function check_wishlist($product_id)
    {
        $query = DB::table("wishlist")->where("userid",Session::get('userdata')['userid'])->where("product_id",$product_id);
        if($query->count() > 0)
        {
            return true;
        }else
        {
            return false;
        }
       
    }
    public static function servicename(int $id){

		$result = DB::table('services')->where('id',$id)->first();                                                     
		
        if($result !='' && isset($result)){
            return $result->servicename;
        }else{
            echo "-";
        }
	}

    public static function subservicename(int $id){

        $result = DB::table('subservices')->where('id',$id)->first();                                                     
        
        if($result !='' && isset($result)){
            return $result->subservicename;
        }else{
            echo "-";
        }
    }
    public static function packagescategory(int $id){

        $result = DB::table('package_categories')->where('id',$id)->first();                                                     
        
        if($result !='' && isset($result)){
            return $result->name;
        }else{
            echo "-";
        }
    }
    public static function vendorsname(int $id){

        $result = DB::table('users')->where('id',$id)->first();                                                     
        
        if($result !='' && isset($result)){
            return $result->name;
        }else{
            echo "-";
        }
    }

    public static function packages_enquiry(int $id){

        $result = DB::table('packages')->where('id',$id)->first();                                                     
        
        if($result !='' && isset($result)){
            return $result->name;
        }else{
            echo "-";
        }
    }
    public static function form_fields(int $id){

        $result = DB::table('form_fileds')->where('id',$id)->first();                                                     
        
        if($result !='' && isset($result)){
            return $result->lable_name;
        }else{
            echo "-";
        }
    }
    
	
} 