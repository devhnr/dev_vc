<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Faq;
use DB;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['faq_data']=Faq::orderBy('id','DESC')->get();
        return view('admin.list_faq',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data['allpackage'] = DB::table('packages')->orderBy('id','desc')->get();
        $data['allsubservices'] = DB::table('subservices')->orderBy('id','desc')->get();
        return view('admin.add_faq',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faq= new Faq;
        $faq->question=$request->question;
        $faq->packages=implode(',', $request->packages);
        $faq->answer=$request->answer;

        $faq->save();

        return redirect()->route('faq.index')->with('success','FAQ Data Added Successfully');

       
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
    public function edit(FAQ $faq)
    {
        $data['allpackage'] = DB::table('packages')->orderBy('id','desc')->get();
         $data['allsubservices'] = DB::table('subservices')->orderBy('id','desc')->get();
        return view('admin.edit_faq',compact('faq'),$data);
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
        $faq= FAQ::find($id);
        
        $faq->question=$request->question;
        if($request->packages != ''){
            $faq->packages=implode(',', $request->packages);
        }
        
        $faq->answer=$request->answer;

        $faq->update();

        return redirect()->route('faq.index')->with('success','FAQ Data Updated Successfully');

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

        FAQ::whereIn('id',$id)->delete();

        return redirect()->route('faq.index')->with('success','FAQ Data Deleted Successfully');
    }
}