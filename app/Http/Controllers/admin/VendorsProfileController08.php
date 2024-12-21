<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
use App\Models\Admin\City;
use App\Models\Admin\UserPermission;

class VendorsProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.vendorsprofile');
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
        
        $data['vendorsprofile']=DB::table('users')->where('id','=',$id)->first(); 

        $data['attribute_data']=DB::table('vendors_attribute')->where('pid',$data['vendorsprofile']->id)->get()->toArray();

        $data['city_data'] = City::orderBy('id','DESC')->get();
        $data['permission_data'] = UserPermission::orderBy('id','DESC')->get();

        return view('admin.editvendorsprofile',$data);
       


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
        // echo "<pre>";
        // print_r($_FILES);
        // echo "</pre>";exit;
        
        $data['role_id']=$_POST['hidden_role_id'];
        $data['name']=$_POST['name'];
        $data['user_name']=$_POST['user_name'];       
        $data['companywebsite']=$_POST['companywebsite'];
        $data['city']=$_POST['city'];
        $data['crole']=$_POST['crole'];
        $data['parentcname']=$_POST['parentcname'];
        $data['establishment_date']=$_POST['establishment_date'];
        $data['tlexpiry']=$_POST['tlexpiry'];
        $data['staff']=$_POST['staff'];
        $data['remarks']=$_POST['remarks'];
        $data['socialmedai']=$_POST['socialmedai'];
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
        $data['vendor'] = 1;

        if($request->hasfile('image') != ''){

            $image = $request->file('image');
            $remove_space = str_replace(' ', '-', $image->getClientOriginalName());
            $data['image'] = time() . $remove_space;
            $destinationPath = public_path('upload/vendors/small');
            $img = Image::make($image->path());
            $width=100;
            $height=100;
            $img->resize($width,$height,function($constraint){
            })->save($destinationPath.'/'.$data['image']);
              
            $destinationPath = public_path('upload/vendors/');
            $image->move($destinationPath,$data['image']);
            $image = $data['image'];
            $data['image']  = $image;
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

       
    // echo"<pre>";
    // print_r($data);
    // echo"</pre>";exit;
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
    return redirect()->route('vendorsprofile.index')->with('success','Vendors profile Updated Successfully.');
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
    public function destroy($id)
    {
        //
    }

    public function remove_vendorsprofile_att (Request $request){

        $service = $request->pid;

        $id = $request->id;

        $result = DB::table('vendors_attribute')->where('pid', '=',$service)->where('id', '=',$id)->delete();

        return redirect()->route('vendorsprofile.edit',$service)->with('success',' Deleted Successfully');

    }
}