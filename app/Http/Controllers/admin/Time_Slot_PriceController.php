<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class Time_Slot_PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.edit_time_slot_price');
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
    public function edit()
    {
        // echo"<pre>";print_r($data);echo"</pre>";exit;

        return view('admin.edit_time_slot_price');
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
        

        if (count($request['time_slot_id']) > 0 && $request['time_slot_id'] != '') {

            for ($i = 0; $i < count($request['time_slot_id']); $i++) {
    
                if($request['time_slot_id'][$i] != ''){
    
                    $content['time_slot_id'] = $request['time_slot_id'][$i];    
                    $content['price'] = $request['price'][$i]; 
                    $content['subservice_id'] = 28; 

                    $subservice_timeslot_price = DB::table('subservice_timeslot_price')
                                                ->where('time_slot_id',$content['time_slot_id'])
                                                ->where('subservice_id',$content['subservice_id'])
                                                ->first();
                    if(isset($subservice_timeslot_price) && !empty($subservice_timeslot_price)){
                        $content['id'] = $subservice_timeslot_price->id; 
                        $this->update_subservice_timeslot_price($content);

                    }else{
                        $this->insert_subservice_timeslot_price($content);

                    }
                    //echo"<pre>";print_r($subservice_timeslot_price);echo"</pre>";
                    //$this->update_home_price($content);
                }                    
            }
    
        }


        if (count($request['time_slot_id']) > 0 && $request['time_slot_id'] != '') {

            for ($i = 0; $i < count($request['time_slot_id']); $i++) {
    
                if($request['time_slot_id'][$i] != ''){
    
                    $content['time_slot_id'] = $request['time_slot_id'][$i];    
                    $content['price'] = $request['price'][$i]; 
                    $content['subservice_id'] = 30; 

                    $subservice_timeslot_price = DB::table('subservice_timeslot_price')
                                                ->where('time_slot_id',$content['time_slot_id'])
                                                ->where('subservice_id',$content['subservice_id'])
                                                ->first();
                    if(isset($subservice_timeslot_price) && !empty($subservice_timeslot_price)){
                        $content['id'] = $subservice_timeslot_price->id; 
                        $this->update_subservice_timeslot_price($content);

                    }else{
                        $this->insert_subservice_timeslot_price($content);

                    }
                    //echo"<pre>";print_r($subservice_timeslot_price);echo"</pre>";
                    //$this->update_home_price($content);
                }                    
            }
    
        }

        if (count($request['time_slot_id']) > 0 && $request['time_slot_id'] != '') {

            for ($i = 0; $i < count($request['time_slot_id']); $i++) {
    
                if($request['time_slot_id'][$i] != ''){
    
                    $content['time_slot_id'] = $request['time_slot_id'][$i];    
                    $content['price'] = $request['price'][$i]; 
                    $content['subservice_id'] = 29; 

                    $subservice_timeslot_price = DB::table('subservice_timeslot_price')
                                                ->where('time_slot_id',$content['time_slot_id'])
                                                ->where('subservice_id',$content['subservice_id'])
                                                ->first();
                    if(isset($subservice_timeslot_price) && !empty($subservice_timeslot_price)){
                        $content['id'] = $subservice_timeslot_price->id; 
                        $this->update_subservice_timeslot_price($content);

                    }else{
                        $this->insert_subservice_timeslot_price($content);

                    }
                    //echo"<pre>";print_r($subservice_timeslot_price);echo"</pre>";
                    //$this->update_home_price($content);
                }                    
            }
    
        }

        if (count($request['time_slot_id']) > 0 && $request['time_slot_id'] != '') {

            for ($i = 0; $i < count($request['time_slot_id']); $i++) {
    
                if($request['time_slot_id'][$i] != ''){
    
                    $content['time_slot_id'] = $request['time_slot_id'][$i];    
                    $content['price'] = $request['price'][$i]; 
                    $content['subservice_id'] = 33; 

                    $subservice_timeslot_price = DB::table('subservice_timeslot_price')
                                                ->where('time_slot_id',$content['time_slot_id'])
                                                ->where('subservice_id',$content['subservice_id'])
                                                ->first();
                    if(isset($subservice_timeslot_price) && !empty($subservice_timeslot_price)){
                        $content['id'] = $subservice_timeslot_price->id; 
                        $this->update_subservice_timeslot_price($content);

                    }else{
                        $this->insert_subservice_timeslot_price($content);

                    }
                    //echo"<pre>";print_r($subservice_timeslot_price);echo"</pre>";
                    //$this->update_home_price($content);
                }                    
            }
    
        }

        return redirect()->route('time_slot_price.index')->with('success', 'Time Slot  Price  Update Successfully');

       // exit;
    }

    function update_subservice_timeslot_price($content){
        $data['time_slot_id'] = $content['time_slot_id'];    
        $data['price'] = $content['price'];    
        $data['subservice_id'] = $content['subservice_id'];    

        DB::table('subservice_timeslot_price')->where('id', $content['id'])->update($data);
    }

    function insert_subservice_timeslot_price($content){
        $data['time_slot_id'] = $content['time_slot_id'];    
        $data['price'] = $content['price'];    
        $data['subservice_id'] = $content['subservice_id'];    

        DB::table('subservice_timeslot_price')->insert($data);
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