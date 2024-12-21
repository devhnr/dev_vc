<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\PackageCategory;
use DB;

class PackageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['packagecategory_data']=DB::table('package_categories')->orderBy('id','DESC')->get();
       
        
        return view('admin.list_packagecategory',$data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['service_data'] = DB::table('services')->select('*')->orderBy('id','DESC')->get();   
        
        $data['subservice_data'] = DB::table('subservices')->select('*')->orderBy('id','DESC')->get();
        return view('admin.add_packagecategory',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data['service_id']=$request->service_id;
       $data['subservice_id']=$request->subservice_id;
       $data['name']=$request->name;

       DB::table('package_categories')->insert($data);
       return redirect()->route('packagecategory.index')->with('success','Package Category Data Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // echo"<pre>";
        // print_r($data['subservice_data']);
        // echo"</pre>";exit;
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data['packagecategory'] = DB::table('package_categories')->where('id', $id)->first();
        $data['service_data'] = DB::table('services')->orderBy('id','DESC')->get();       
        $data['subservice_data'] = DB::table('subservices')->where('serviceid',$data['packagecategory']->service_id)->get();
        
      

        return view('admin.edit_packagecategory',$data);
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
        
        $data['service_id']=$request->service_id;
        $data['subservice_id']=$request->subservice_id;
        $data['name']=$request->name;
 
        DB::table('package_categories')->where('id', $id)->update($data);
        
        return redirect()->route('packagecategory.index')->with('success','Package Category Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->selected;
        DB::table('package_categories')->whereIn('id',$id)->delete();
        return redirect()->route('packagecategory.index')->with('success','Package Category Data Deleted Successfully');
    }
    function subservice_show(){
        $service_id = $_POST['service_id'];
        // echo $service_id;exit;
        
        $result = DB::table('subservices')->select('*')->where('serviceid','=',$service_id)->get();        

        $result_new = $result->toArray();

        $html = ' <select class="form-control" id="subservice_id" name="subservice_id">';
        $html .= '<option value="">Select Sub Service</option>';
        if($result != '' && count($result) >0)
        {
            for($i=0;$i<count($result);$i++)
            {
                // echo "<pre>";print_r($result[$i]->id);echo "</pre>";exit;
                $html .= "<option value='".$result[$i]->id ."'>".$result[$i]->subservicename."</option>";
            }
        }
        $html .="</select>";
        // echo "<pre>";print_r($html);echo "</pre>";exit;
        echo $html;
    }
}