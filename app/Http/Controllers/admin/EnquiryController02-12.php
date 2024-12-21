<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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