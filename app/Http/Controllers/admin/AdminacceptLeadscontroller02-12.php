<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use DB;
class AdminacceptLeadscontroller extends Controller
{
    //
    public function enquiry_accept(Request $request)
    {
        $query = DB::table('package_inquiry_accepted')->select('*')->where('accept_reject', 0);                          
        $data['filter_vendor_id'] = "";
        if($request->action == 'filter'){
            $query->where('vendor_id',$request->vendor_id);
            $data['filter_vendor_id'] =$request->vendor_id;
        }
        $data['package_inquiry_accepted'] = $query->where('service_id', '!=', 34)->orderBy('id', 'desc')->get();
        $data['all_vendor'] = DB::table('users')->where('vendor',1)->where('is_active',0)->get()->toArray();
        return view('admin.list_adminaccept_leads',$data);
    }
    public function enquiry_reject(Request $request)
    {
         $query = DB::table('package_inquiry_accepted')
                                       ->select('*')
                                       //->where('vendor_id', '=', $userId)
                                       ->where('accept_reject', 1);
                                       
        $data['filter_vendor_id'] = "";
        if($request->action == 'filter'){
            $query->where('vendor_id',$request->vendor_id);
            $data['filter_vendor_id'] =$request->vendor_id;
        }
        $data['package_inquiry_accepted'] = $query->orderBy('id', 'desc')->get();
        $data['all_vendor'] = DB::table('users')->where('vendor',1)->where('is_active',0)->get()->toArray();
             
       return view('admin.list_adminreject_leads',$data);
    }

    public function painting_enquiry(Request $request)
    {
        $data['painting_enquiry'] = DB::table('painting_enquiry')->orderBy('id', 'desc')->get();
       // echo"<pre>";print_r($data['painting_enquiry']);echo"</pre>";exit;                          
        return view('admin.list_painting_enquiry',$data);
    }
    public function filter_data(Request $request)
    {
        // echo"<pre>";print_r($request->all());echo"</pre>";exit;
        $vendorname = $request->input('filter_vendor_id_fil','');
        $query = DB::table('package_inquiry_accepted')->select('*')->where('accept_reject', 0)->where('service_id', '!=', 34);
        if ($vendorname !='')
        {   
            $query = $query->where('vendor_id',$vendorname);
        }
        $data = $query->orderBy('id', 'desc')->get();
        // echo"<pre>";print_r($data);echo"</pre>";exit;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Date');
        $sheet->setCellValue('B1', 'Vendor Name');
        $sheet->setCellValue('C1', 'Inquiry No');
        $sheet->setCellValue('D1', 'Accepted Date');
        $sheet->setCellValue('E1', 'Name');
        $sheet->setCellValue('F1', 'Service');
        $sheet->setCellValue('G1', 'Sub Service');
        $sheet->setCellValue('H1', 'Lead Amount');
        $row = 2;
        if(isset($data)){
            foreach ($data as $data_new) {
            $service_data=DB::table('services')->where('id',$data_new->service_id)->first();
            $sub_service_data=DB::table('subservices')->where('id',$data_new->subservice_id)->first();
            $vendor_data = DB::table('users')->where('vendor',1)->where('is_active',0)->where('id',$data_new->vendor_id)->first();
            $packages_enquiry_data = DB::table('packages_enquiry')->where('id','=',$data_new->packages_inquiry_id,)->first();
            // echo"<pre>";print_r($packages_enquiry_data);echo"</pre>";exit;
            // $customer_data = DB::table('packages_enquiry')->groupBy('name')->where('name',$data_new->name)->first();
            if ($packages_enquiry_data->added_date !== null) {
                $sheet->setCellValue('A' . $row, $packages_enquiry_data->added_date);
            } else {
               $sheet->setCellValue('A' . $row, '-'); 
            }
            if ($vendor_data && $vendor_data->name !== null) {
                $sheet->setCellValue('B' . $row, $vendor_data->name);
            } else {
               $sheet->setCellValue('B' . $row, '-'); 
            }
            if ($data_new->packages_inquiry_id !== null) {
                $sheet->setCellValue('C' . $row, 'IQ-MOVING-24-'.$data_new->packages_inquiry_id);
            } else {
               $sheet->setCellValue('C' . $row, '-'); 
            }
            if ($data_new->added_date !== null) {
                $sheet->setCellValue('D' . $row,$data_new->added_date);
            } else {
               $sheet->setCellValue('D' . $row, '-'); 
            }
            if ($packages_enquiry_data->name !== null) {
                $sheet->setCellValue('E' . $row, $packages_enquiry_data->name);
            } else {
               $sheet->setCellValue('E' . $row, '-'); 
            }
            if ($service_data->servicename !== null) {
                $sheet->setCellValue('F' . $row, $service_data->servicename);
            } else {
               $sheet->setCellValue('F' . $row, '-'); 
            }
            if ($sub_service_data->subservicename !== null) {
                $sheet->setCellValue('G' . $row, $sub_service_data->subservicename);
            } else {
               $sheet->setCellValue('G' . $row, '-'); 
            }
            if ($data_new->price_of_lead !== null) {
                $sheet->setCellValue('H' . $row, $data_new->price_of_lead);
            } else {
               $sheet->setCellValue('H' . $row, '0'); 
            }
            $row++;
            }
           
        }
        $writer = new Xlsx($spreadsheet);
        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Accepted-Enquiry-list.xlsx"');
        header('Cache-Control: max-age=0');
        // Write the file to the browser
        $writer->save('php://output');
    }
    
}
