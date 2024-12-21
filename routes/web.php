<?php
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\UserPermissionController;
use App\Http\Controllers\admin\Admin_userController;
use App\Http\Controllers\admin\ContinentController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\GooglereviewController;
use App\Http\Controllers\admin\StateController;
use App\Http\Controllers\admin\CityController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\SubserviceController;
use App\Http\Controllers\admin\VendorsController;

use App\Http\Controllers\admin\VendorsProfileController;

use App\Http\Controllers\admin\Pricecontroller;
use App\Http\Controllers\admin\SubscriptionController;
use App\Http\Controllers\admin\Subscriptiondetails_controller;
use App\Http\Controllers\admin\Leadscontroller;
use App\Http\Controllers\admin\AcceptLeadscontroller;
use App\Http\Controllers\admin\RejectLeadscontroller;
use App\Http\Controllers\admin\PaintingLeadscontroller;
use App\Http\Controllers\admin\Vendorinquirycontroller;
use App\Http\Controllers\admin\CmsController;
use App\Http\Controllers\admin\PackageCategoryController;
use App\Http\Controllers\admin\PackagesController;
use App\Http\Controllers\admin\WalletController;
use App\Http\Controllers\admin\AdminWalletController;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\FrontuserController;
use App\Http\Controllers\admin\EnquiryController;

use App\Http\Controllers\admin\Form_fieldController;
use App\Http\Controllers\admin\Ordercontroller;
use App\Http\Controllers\admin\VendorOrderController;
use App\Http\Controllers\admin\SubscribeController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\Blog_categoryController;
use App\Http\Controllers\admin\SalesReportController;
use App\Http\Controllers\admin\SystemController;
use App\Http\Controllers\admin\Cleaning_PriceController;
use App\Http\Controllers\admin\Time_Slot_PriceController;
use App\Http\Controllers\admin\AdminpassController;
use App\Http\Controllers\admin\AdminacceptLeadscontroller;
use App\Http\Controllers\admin\PaintingPriceController;
use App\Http\Controllers\admin\EnquiryUsersController;




use App\Http\Controllers\front\FrontloginregisterController;
use App\Http\Controllers\front\FrontvendorController;
use App\Http\Controllers\front\checkoutcontroller;
use App\Http\Controllers\front\Packagecontroller;
use App\Http\Controllers\front\MyaccountController;





// Route::get('/', function () {
//     return view('welcome');
// });

//Clear config cache:
Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return 'Config cache cleared';
}); 
// Clear application cache:
// Route::get('/clear-cache', function() {
//     $exitCode = Artisan::call('cache:clear');
//     return 'Application cache cleared';
// });
// // Clear view cache:
// Route::get('/view-clear', function() {
//     $exitCode = Artisan::call('view:clear');
//     return 'View cache cleared';
// });
//  Route::get('/optimize-clear', function() {
//     $exitCode = Artisan::call('optimize:clear');
//     return 'Application cache cleared successfully';
// });

/*------Front routes start ------*/
Route::get('/vendor-registration-succesful', '\App\Http\Controllers\front\Homecontroller@become_vendors')->name('vendor-registration-succesful');
Route::post('facebook-login', '\App\Http\Controllers\front\FrontloginregisterController@facebook')->name('facebook-login');

Route::get('auth/google', '\App\Http\Controllers\front\FrontloginregisterController@redirectToGoogle');
Route::get('gmail-login', '\App\Http\Controllers\front\FrontloginregisterController@gmail');

Route::get('/', '\App\Http\Controllers\front\Homecontroller@index');
Route::post('search', '\App\Http\Controllers\front\Homecontroller@search')->name('search');

Route::get('/privacy-policy', '\App\Http\Controllers\front\Homecontroller@privacy_policy')->name('privacy_policy');
Route::get('/terms-of-service', '\App\Http\Controllers\front\Homecontroller@term_condition')->name('term_condition');
Route::get('/payment_refund_policy', '\App\Http\Controllers\front\Homecontroller@payment_refund_policy')->name('payment_refund_policy');
Route::get('/contact', '\App\Http\Controllers\front\Homecontroller@contact')->name('contact');
Route::post('/contact_us_data', '\App\Http\Controllers\front\Homecontroller@contact_us_data');
Route::get('/careers', '\App\Http\Controllers\front\Homecontroller@careers')->name('careers');
Route::get('/about_us', '\App\Http\Controllers\front\Homecontroller@about_us')->name('about_us');

Route::get('/services', '\App\Http\Controllers\front\Homecontroller@book_services');
// Route::get('/book-services', '\App\Http\Controllers\front\Homecontroller@book_services');
Route::get('/become-a-vendor', '\App\Http\Controllers\front\Homecontroller@become_vendor');
Route::get('/blog', '\App\Http\Controllers\front\Homecontroller@blog');
Route::get('/blog_detail/{blog_url}', '\App\Http\Controllers\front\Homecontroller@blog_detail');
Route::get('Sign-Up/{id?}', '\App\Http\Controllers\front\FrontloginregisterController@test');
Route::resource('Sign-Up', '\App\Http\Controllers\front\FrontloginregisterController');
Route::get('Sign-in', '\App\Http\Controllers\front\FrontloginregisterController@Sign_in')->name('Sign-in');

Route::post('user-detail-login','App\Http\Controllers\front\FrontloginregisterController@user_detail_login')->name('user-detail-login');

// Handle both GET and POST requests
// Route::match(['get', 'post'], 'sign-in-form', '\App\Http\Controllers\front\FrontloginregisterController@sign_in_form')->name('sign-in-form');

Route::get('user_signout', 'App\Http\Controllers\front\FrontloginregisterController@user_signout')->name('user_signout');


Route::get('test_mail', 'App\Http\Controllers\front\FrontloginregisterController@test_mail')->name('test_mail');

Route::post('check_login', 'App\Http\Controllers\front\FrontloginregisterController@check_login');

Route::get('search-package', 'App\Http\Controllers\front\FrontloginregisterController@search_package')->name('search_package');
// Route::post('search-package', 'App\Http\Controllers\front\Homecontroller@search_package');

// Route::match(['get', 'post'], 'search-package', [FrontloginregisterController::class, 'search_package'])->name('search_package');

Route::post('user_login','App\Http\Controllers\front\FrontloginregisterController@user_login')->name('user_login');

Route::post('registration_mail_check', '\App\Http\Controllers\front\FrontloginregisterController@registration_mail_check');


Route::get('forget-password','\App\Http\Controllers\front\FrontloginregisterController@lost_password'); 
Route::post('email-check-login','\App\Http\Controllers\front\FrontloginregisterController@emailCheck'); 
Route::post('resetpassword','\App\Http\Controllers\front\FrontloginregisterController@get_password')->name('reset-password');
Route::get('reset-password/{uid}','\App\Http\Controllers\front\FrontloginregisterController@reset_password')->name('reset_password');


Route::post('check_email','\App\Http\Controllers\front\FrontloginregisterController@check_email');
Route::post('news_letter_email','\App\Http\Controllers\front\FrontloginregisterController@news_letter_email');


Route::post('set_password/{uid}','\App\Http\Controllers\front\FrontloginregisterController@set_password')->name('set_password');

Route::match(['get', 'post'], 'lost-password', [AdminpassController::class, 'lost_password'])->name('lost_password');
Route::post('email-check-login-admin','\App\Http\Controllers\admin\AdminpassController@emailCheck'); 
Route::get('reset-password-vendor/{uid}','\App\Http\Controllers\admin\AdminpassController@reset_password')->name('reset_password');
Route::post('set_password_vendor/{uid}','\App\Http\Controllers\admin\AdminpassController@set_password_vendor')->name('set_password_vendor');

        

Route::match(['get', 'post'], 'our-vendors', [FrontvendorController::class, 'vendor_database'])->name('vendor_database');

Route::get('/package-lists/{page_url}', '\App\Http\Controllers\front\Packagecontroller@package_lists')->name('package-lists');
Route::get('/package-detail/{page_url}', '\App\Http\Controllers\front\Packagecontroller@package_detail');

Route::get('enquiry/{id}/', '\App\Http\Controllers\front\Packagecontroller@enquiry')->name('enquiry');
Route::get('enquiry/{id}/{service_id}/', '\App\Http\Controllers\front\Packagecontroller@enquiry')->name('enquiry');

Route::get('enquiry/{id}/', '\App\Http\Controllers\front\Packagecontroller@enquiry');

Route::get('enquiry/{id}/{service_id}/', '\App\Http\Controllers\front\Packagecontroller@enquiry_sub')->name('enquiry');



Route::get('enquiry/{service_id}/{subservice_id}', 'Packagecontroller@enquiry_sub')->name('enquiry');

Route::get('booknow/{service_id}/{subservice_id}', '\App\Http\Controllers\front\Packagecontroller@booknow')->name('booknow');

Route::post('get_price_cleaning','\App\Http\Controllers\front\Packagecontroller@get_price_cleaning');

Route::post('apply-wallet-discount-book_now','\App\Http\Controllers\front\Packagecontroller@apply_wallet_discount_book_now');
Route::post('cancel-wallet-discount-book-now','\App\Http\Controllers\front\Packagecontroller@cancel_wallet_discount_book_now');


Route::post('change_drop_down','\App\Http\Controllers\front\Packagecontroller@change_drop_down');

Route::post('change_drop_down_two','\App\Http\Controllers\front\Packagecontroller@change_drop_down_two');


Route::get('service/{page_url}', '\App\Http\Controllers\front\Homecontroller@subservices')->name('subservices');




// Route::post('package_inquiry', '\App\Http\Controllers\front\Packagecontroller@package_inquiry')->name('package_inquiry');

Route::match(['get', 'post'], 'package_inquiry', '\App\Http\Controllers\front\Packagecontroller@package_inquiry')->name('package_inquiry');

Route::post('package_inquiry_new', '\App\Http\Controllers\front\Packagecontroller@package_inquiry_new')->name('package_inquiry_new');




Route::post('vendors_check_mail', '\App\Http\Controllers\front\Homecontroller@vendors_check_mail'); 
Route::post('/vendors_data', '\App\Http\Controllers\front\Homecontroller@vendors_data');

Route::get('/cart', '\App\Http\Controllers\front\Cartcontroller@cart')->name('cart');
Route::post('add_to_cart','\App\Http\Controllers\front\Cartcontroller@add_to_cart');
Route::post('cart_remove', '\App\Http\Controllers\front\Cartcontroller@cart_remove');
Route::post('update_cart', '\App\Http\Controllers\front\Cartcontroller@update_cart');

Route::post('add_to_cart_book','\App\Http\Controllers\front\Cartcontroller@add_to_cart_book');
Route::post('cart_remove_book_now', '\App\Http\Controllers\front\Cartcontroller@cart_remove_book_now');




Route::get('/checkout', '\App\Http\Controllers\front\checkoutcontroller@checkout');
Route::post('/order_place', '\App\Http\Controllers\front\checkoutcontroller@order_place')->name('order_place');
Route::get('thankyou', [checkoutcontroller::class, 'thankyou'])->name("thankyou");
Route::get('thankyou_book_now', [checkoutcontroller::class, 'thankyou_book_now'])->name("thankyou_book_now");

Route::get('thankyou-book-now', [checkoutcontroller::class, 'thankyou_painting'])->name("thankyou-book-now");
Route::get('success_mail_book_now', [checkoutcontroller::class, 'success_mail_book_now'])->name("success_mail_book_now");

Route::post('/book_now_order', '\App\Http\Controllers\front\checkoutcontroller@book_now_order')->name('book_now_order');

Route::get('/payment_success', '\App\Http\Controllers\front\checkoutcontroller@payment_success')->name('payment_success');
Route::get('/payment_fail', '\App\Http\Controllers\front\checkoutcontroller@payment_fail')->name('payment_fail');

Route::post('/bill_state_change', '\App\Http\Controllers\front\checkoutcontroller@bill_state_change');
Route::post('/ship_state_change', '\App\Http\Controllers\front\checkoutcontroller@ship_state_change');


Route::get('/my-account', '\App\Http\Controllers\front\MyaccountController@my_account');
Route::get('/my-order', '\App\Http\Controllers\front\MyaccountController@my_order');
Route::get('/my-profile', '\App\Http\Controllers\front\MyaccountController@my_profile');
// Route::get('/order-detail', '\App\Http\Controllers\front\MyaccountController@order_detail');
Route::get('/order-detail/{id}', '\App\Http\Controllers\front\MyaccountController@order_details');
Route::get('refer&earn', '\App\Http\Controllers\front\MyaccountController@refer_earn');
Route::get('refral', '\App\Http\Controllers\front\MyaccountController@refral');
Route::get('refer_and_earn/{userid}', '\App\Http\Controllers\front\MyaccountController@refer_earn_frend');
Route::get('cancelpackage/{id}/', '\App\Http\Controllers\front\MyaccountController@cancelpackage')->name('cancelpackage');


Route::match(['get', 'post'], 'edit-profile', [MyaccountController::class, 'edit_profile'])->name('edit_profile');
Route::get('my-wallet', '\App\Http\Controllers\front\MyaccountController@my_wallet');
Route::get('download/{filepath}', [Packagecontroller::class, 'download']);



Route::get('downloads/{filename}', '\App\Http\Controllers\front\Homecontroller@downloads')->name('downloads');

Route::post('/apply-wallet-dicount', '\App\Http\Controllers\front\checkoutcontroller@apply_wallet_dicount');
Route::post('/cancel-wallet-dicount', '\App\Http\Controllers\front\checkoutcontroller@cancel_wallet_dicount');

/* Pating Price Routes and Urls */
Route::post('get-size-home-price','\App\Http\Controllers\front\Packagecontroller@get_size_home_price');
Route::post('get-color-painted-price','\App\Http\Controllers\front\Packagecontroller@get_color_painted_price');
Route::post('get-colornow-paint-price','\App\Http\Controllers\front\Packagecontroller@get_colornow_paint_price');
Route::post('get-home-furnished-price','\App\Http\Controllers\front\Packagecontroller@get_home_furnished_price');

Route::get('thank-you', function () {
   
        return view('front.enquiry-thankyou');

})->name('thank-you');

//Route::get('/edit-profile', '\App\Http\Controllers\front\MyaccountController@edit_profile');

// Route::get('/checkout', '\App\Http\Controllers\front\checkoutcontroller@checkout');
// Route::post('/order_place', '\App\Http\Controllers\front\checkoutcontroller@order_place')->name('order_place');
// Route::get('thankyou', [checkoutcontroller::class, 'thankyou'])->name("thankyou");



// Route::match(['get', 'post'], 'vendor-database', [FrontvendorController::class, 'vendor_database'])->name('vendor_database');


/*------End Front routes  ------*/

/*------vendors routes start ------*/




    Route::get('/vendors', function () {
        if (Auth::user()->vendor == 1) {
            return view('admin.vendorsdashboard');
        } else {
            return view('admin.dashboard');
        }
})->middleware(['auth', 'verified'])->name('vendor.dashboard');

Route::get('/admin', function () {
    //echo "Welcome Admin";exit;
    if (Auth::user()->vendor == 1) {
        return view('admin.vendorsdashboard');
    } else {
        return view('admin.dashboard');
    }
})->middleware(['auth', 'verified'])->name('admin.dashboard');



Route::get('/dashboard', '\App\Http\Controllers\admin\HomeController@redirectToDashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
// Route::get('/vendor', function () {

//     echo "Welcome Vendor";exit;
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('vendor.dashboard');



// Route::middleware(['auth', 'verified'])->group(function () {

//     echo "Welcome vendor";exit;
//     Route::get('/vendor', 'VendorController@index')->name('vendor.dashboard');
//     // Define other vendor-specific routes here
// });





/*------vendors Front routes  ------*/



    Route::middleware('auth')->group(function () {



    Route::resource('/admin/permission', '\App\Http\Controllers\admin\PermissionController');
    
    Route::resource('/admin/userpermission', '\App\Http\Controllers\admin\UserPermissionController');
    Route::get('delete_permission', [UserPermissionController::class, 'delete_permission'])->name('delete_permission');
    Route::get('destroyPermission', [UserPermissionController::class, 'destroyPermission'])->name('destroyPermission');    

    Route::resource('/admin/adminuser', '\App\Http\Controllers\admin\Admin_userController');
    Route::get('/admin/delete_admin', [Admin_userController::class, 'destroy'])->name('delete_admin'); 
    Route::post('change_status_adminuser','App\Http\Controllers\admin\Admin_userController@change_status_adminuser'); 

    Route::resource('admin/continent','App\Http\Controllers\admin\ContinentController');
    Route::get('delete_continent',[ContinentController::class,'destroy'])->name('delete_continent');

    Route::resource('admin/country','App\Http\Controllers\admin\CountryController');
    Route::get('delete_country',[CountryController::class,'destroy'])->name('delete_country');
    // Route::post('admin/upload', [CountryController::class, 'xlsupload'])->name('country.upload');
    Route::match(['get', 'post'], 'upload_country', [CountryController::class, 'xlsupload'])->name('upload_country');

    Route::resource('admin/state','App\Http\Controllers\admin\StateController');
    Route::get('delete_state',[StateController::class,'destroy'])->name('delete_state');
    Route::match(['get', 'post'], 'upload_state', [StateController::class, 'xlsupload'])->name('upload_state');

    Route::resource('admin/city','App\Http\Controllers\admin\CityController');
    Route::get('/admin/delete_city', [CityController::class, 'destroy'])->name('delete_city');
    Route::post('state_show', 'App\Http\Controllers\admin\CityController@state_show');
    Route::get('/admin/bulk_upload_city', [CityController::class, 'bulk_upload_city'])->name('bulk_upload_city');
    Route::post('/admin/bulk_upload_city', [CityController::class, 'bulk_upload_city'])->name('bulk_upload_city');


    Route::match(['get', 'post'], 'upload_city', [CityController::class, 'xlsupload'])->name('upload_city');




    Route::resource('admin/service','App\Http\Controllers\admin\ServiceController');  
    Route::get('delete_service',[ServiceController::class,'destroy'])->name('delete_service'); 
    Route::post('set_order_service', '\App\Http\Controllers\admin\ServiceController@set_order_service');
    Route::post('change_status_service','App\Http\Controllers\admin\ServiceController@change_status_service');
    Route::post('city_show_new', 'App\Http\Controllers\admin\ServiceController@city_show_new');

    
    Route::resource('admin/subservice','App\Http\Controllers\admin\SubserviceController');  
    Route::get('delete_subservice',[SubserviceController::class,'destroy'])->name('delete_subservice');
    Route::post('set_order_subservice', '\App\Http\Controllers\admin\SubserviceController@set_order_subservice');
    Route::get('removed_addmore_att/{pid}/{id}', [SubserviceController::class, 'removed_addmore_att'])->name('removed_addmore_att');
    Route::post('change_status_subservice','App\Http\Controllers\admin\SubserviceController@change_status_subservice');


    Route::resource('admin/vendors','App\Http\Controllers\admin\VendorsController');  
    Route::get('delete_vendors',[VendorsController::class,'destroy'])->name('delete_vendors');
    Route::get('remove_vendors_att/{pid}/{id}', [VendorsController::class, 'remove_vendors_att'])->name('remove_vendors_att'); 
    Route::post('change_status_vendors','App\Http\Controllers\admin\VendorsController@change_status_vendors');
    Route::post('excel_download_vendors', '\App\Http\Controllers\admin\VendorsController@excel_download_vendors');
    Route::match(['get', 'post'], 'edit_subscription/{id}', [VendorsController::class, 'edit_subscription'])->name('edit_subscription');
    
    Route::match(['get', 'post'], 'edit_international_subscription/{id}', [VendorsController::class, 'edit_international_subscription'])->name('edit_international_subscription');

    Route::match(['get', 'post'], 'copy_package_subscription/{id}', [VendorsController::class, 'copy_package_subscription'])->name('copy_package_subscription');


    Route::get('admin/vendors/{id}/subscription', 'App\Http\Controllers\admin\VendorsController@subscription')->name('vendors.subscription');


    // routes/web.php
    route::get('/vendor-login/{id}', [VendorsController::class, 'vendor_login'])->name('vendor_login');

    Route::resource('vendorsprofile','App\Http\Controllers\admin\VendorsProfileController');
    Route::get('remove_vendorsprofile_att/{pid}/{id}', [VendorsProfileController::class, 'remove_vendorsprofile_att'])->name('remove_vendorsprofile_att');


    Route::resource('admin/price','App\Http\Controllers\admin\Pricecontroller');  
    Route::get('delete_price',[Pricecontroller::class,'destroy'])->name('delete_price');

    Route::resource('admin/subscription','App\Http\Controllers\admin\SubscriptionController');

    Route::get('/delete-subscription', [SubscriptionController::class, 'destroy'])->name('delete_subscription');


    // Route::get('base_on_service_lead',[SubscriptionController::class,'base_on_service_lead'])->name('base_on_service_lead');

    // Route::get('based_on_booking_services',[SubscriptionController::class,'based_on_booking_services'])->name('based_on_booking_services');
    // Route::get('based_on_listing_criteria',[SubscriptionController::class,'based_on_listing_criteria'])->name('based_on_listing_criteria');

    Route::post('session_subs_price_change', 'App\Http\Controllers\admin\SubscriptionController@session_subs_price_change');
    Route::post('state_show_subscription', 'App\Http\Controllers\admin\SubscriptionController@state_show_subscription');
    Route::post('to_country_show_subscription', 'App\Http\Controllers\admin\SubscriptionController@to_country_show_subscription');
    Route::post('city_show', 'App\Http\Controllers\admin\SubscriptionController@city_show');
    Route::post('subservice_change', 'App\Http\Controllers\admin\SubscriptionController@subservice_change');
    Route::post('subservice_table_change', 'App\Http\Controllers\admin\SubscriptionController@subservice_table_change');

    Route::post('subscription_replace', 'App\Http\Controllers\admin\SubscriptionController@subscription_replace');

    
    Route::match(['get', 'post'], 'base_on_service_lead/{id}', [SubscriptionController::class, 'base_on_service_lead'])->name('base_on_service_lead');
    Route::match(['get', 'post'], 'based_on_booking_services/{id}', [SubscriptionController::class, 'based_on_booking_services'])->name('based_on_booking_services');
    Route::match(['get', 'post'], 'based_on_listing_criteria/{id}', [SubscriptionController::class, 'based_on_listing_criteria'])->name('based_on_listing_criteria');

    Route::match(['get', 'post'], 'international-package/{id}', [SubscriptionController::class, 'international_package'])->name('international-package');

    Route::post('chnage_moving_price', 'App\Http\Controllers\admin\SubscriptionController@chnage_moving_price');
    Route::post('chnage_moving_price_for_int', 'App\Http\Controllers\admin\SubscriptionController@chnage_moving_price_for_int');

    // Route::post('base_on_service_lead',[SubscriptionController::class,'base_on_service_lead'])->name('base_on_service_lead');
    // Route::post('based_on_booking_services',[SubscriptionController::class,'based_on_booking_services'])->name('based_on_booking_services');
    // Route::post('based_on_listing_criteria',[SubscriptionController::class,'based_on_listing_criteria'])->name('based_on_listing_criteria');

    Route::resource('admin/subscription-details','App\Http\Controllers\admin\Subscriptiondetails_controller');

    Route::post('vendor_check_mail', 'App\Http\Controllers\admin\VendorsController@vendor_check_mail');
    Route::post('vendor_edit_check_mail', 'App\Http\Controllers\admin\VendorsController@vendor_edit_check_mail');

    Route::get('admin/vendor-invoice/{id}', 'App\Http\Controllers\admin\Subscriptiondetails_controller@vendor_invoice')->name('vendor-invoice');

    Route::resource('admin/leads','App\Http\Controllers\admin\Leadscontroller'); 
    Route::resource('admin/acceptleads','App\Http\Controllers\admin\AcceptLeadscontroller'); 
    Route::resource('admin/rejectleads','App\Http\Controllers\admin\RejectLeadscontroller'); 
    Route::resource('admin/painting-inquiry','App\Http\Controllers\admin\PaintingLeadscontroller'); 
    Route::resource('admin/vendorinquiry','App\Http\Controllers\admin\Vendorinquirycontroller');
    Route::match (['get','post'],'/vendor-enquiry-filter','App\Http\Controllers\admin\Vendorinquirycontroller@index')->name('vendor-enquiry-filter');
    Route::get('accept_vendor_inquiry', 'App\Http\Controllers\admin\Vendorinquirycontroller@accept_vendor_inquiry')->name('accept_vendor_inquiry');

    Route::match(['get', 'post'], 'accept_vendor_inquiry/{vendors_id}/{inquiry_id}', 'App\Http\Controllers\admin\Vendorinquirycontroller@accepted_vendor_inquiry')->name('accept_vendor_inquiryy');

    Route::get('enquiry_detail/{enquiry_id}', [Vendorinquirycontroller::class, 'enquiry_details'])->name('enquiry_detail');
    Route::get('painting-enquiry-detail/{enquiry_id}', [Vendorinquirycontroller::class, 'painting_enquiry_detail'])->name('painting-enquiry-detail');
    
    Route::get('/accpet_form/{package_inquiry_id}/{user_id}', [Vendorinquirycontroller::class, 'accpet_form'])->name('accpet_form');


    Route::get('accept_lead_form', 'App\Http\Controllers\admin\Vendorinquirycontroller@accept_lead_form')->name('accept_lead_form');
    Route::get('accept_lead_form_new', 'App\Http\Controllers\admin\Vendorinquirycontroller@accept_lead_form_new')->name('accept_lead_form_new');


 
    Route::post('reason_reject_form', 'App\Http\Controllers\admin\Vendorinquirycontroller@add_reject_reason')->name('reason_reject_form');
    Route::get('enquiry_details/{enquiry_id}', [Vendorinquirycontroller::class, 'enquiry_detailss'])->name('enquiry_details');


    


    Route::resource('admin/cms','App\Http\Controllers\admin\CmsController'); 
    Route::get('delete_cms',[CmsController::class,'destroy'])->name('delete_cms');

    Route::resource('admin/packagecategory', '\App\Http\Controllers\admin\PackageCategoryController');
    Route::post('subservice_show', 'App\Http\Controllers\admin\PackageCategoryController@subservice_show');
    Route::get('delete_packagecategory',[PackageCategoryController::class,'destroy'])->name('delete_packagecategory');
    
    
    Route::resource('admin/packages', '\App\Http\Controllers\admin\PackagesController');
    Route::post('subservice_show', 'App\Http\Controllers\admin\PackagesController@subservice_show');
    Route::post('packagecategory_show', 'App\Http\Controllers\admin\PackagesController@packagecategory_show');
    Route::get('delete_packages',[PackagesController::class,'destroy'])->name('delete_packages');
    Route::get('editimage/{id}', [PackagesController::class, 'editimage'])->name('editimage');
    Route::post('editimage_store', [PackagesController::class, 'editimage_store'])->name('editimage_store');
    Route::get('packages_removeimage/{pid}/{id}', [PackagesController::class, 'packages_removeimage'])->name('packages_removeimage');
    Route::post('set_order_packages', '\App\Http\Controllers\admin\PackagesController@set_order_packages');

    Route::resource('wallet', '\App\Http\Controllers\admin\WalletController');

    Route::get('/paymentSuccess', '\App\Http\Controllers\admin\WalletController@paymentSuccess')->name('paymentSuccess');
    Route::get('/paymentFail', '\App\Http\Controllers\admin\WalletController@paymentFail')->name('paymentFail');

    Route::post('ckeditor/upload', [PackagesController::class, 'upload'])->name('ckeditor.upload');
    Route::get('remove_addmore_att/{pid}/{id}', [PackagesController::class, 'remove_addmore_att'])->name('remove_addmore_att');

    Route::resource('admin/adminwallet', '\App\Http\Controllers\admin\AdminWalletController');
    Route::post('admin_wallet_filter', 'App\Http\Controllers\admin\AdminWalletController@index')->name('admin_wallet_filter');
    Route::get('filter_data_adminwallet', '\App\Http\Controllers\admin\AdminWalletController@filter_data_adminwallet');
    Route::get('vendors_wallet/{vendors_id}', [AdminWalletController::class, 'vendors_wallet'])->name('vendors_wallet');
    Route::post('change_status_wallet','App\Http\Controllers\admin\AdminWalletController@change_status_wallet');
    Route::post('vendor_wallet_check','App\Http\Controllers\admin\AdminWalletController@vendor_wallet_check');


    Route::resource('admin/faq', '\App\Http\Controllers\admin\FaqController');
    Route::get('delete_faq',[FaqController::class,'destroy'])->name('delete_faq');

    Route::resource('/admin/frontuser', '\App\Http\Controllers\admin\FrontuserController');
    Route::post('change_status_frontuser','App\Http\Controllers\admin\FrontuserController@change_status_frontuser');

    Route::get('export-all', [App\Http\Controllers\admin\FrontuserController::class, 'downloadXls'])->name('export-excel');
    
    Route::resource('/enquiry', '\App\Http\Controllers\admin\EnquiryController');
    Route::post('change_status_auto_accept','App\Http\Controllers\admin\EnquiryController@change_status_auto_accept');
    Route::post('manual-assign-lead', '\App\Http\Controllers\admin\EnquiryController@manual_assign_lead');
    Route::post('manual-assign-vendor-form', '\App\Http\Controllers\admin\EnquiryController@manual_assign_vendor_form');
    Route::match (['get','post'],'/enquiry-filter','App\Http\Controllers\admin\EnquiryController@index')->name('enquiry-filter');
    Route::get('filter_data_enquiry', '\App\Http\Controllers\admin\EnquiryController@filter_data_enquiry');
    Route::get('enquiry_page/{enquiry_id}', [EnquiryController::class, 'enquiry_details'])->name('enquiry_page');
    Route::get('painting-lead-detail/{enquiry_id}', [EnquiryController::class, 'painting_enquiry_details'])->name('painting-lead-detail');

   

    // Route::resource('/enquiry_accept', '\App\Http\Controllers\admin\AdminacceptLeadscontroller');
    Route::get('filter_data', '\App\Http\Controllers\admin\AdminacceptLeadscontroller@filter_data');
    Route::match(['get', 'post'], 'enquiry_accept', [AdminacceptLeadscontroller::class, 'enquiry_accept'])->name('enquiry_accept');
    Route::match(['get', 'post'], 'enquiry_reject', [AdminacceptLeadscontroller::class, 'enquiry_reject'])->name('enquiry_reject');
    Route::match(['get', 'post'], 'painting-enquiry', [AdminacceptLeadscontroller::class, 'painting_enquiry'])->name('painting-enquiry');

    Route::get('admin/download/{filepath}', [EnquiryController::class, 'download']);
    

    


    Route::resource('/admin/form_field', '\App\Http\Controllers\admin\Form_fieldController');
    Route::get('/admin/delete_form_field', [Form_fieldController::class, 'delete_form_field'])->name('delete_form_field');
    Route::get('remove_attribute/{form_id}/{id}', [Form_fieldController::class, 'remove_attribute'])->name('remove_attribute');
    Route::post('set_order_form_fields', '\App\Http\Controllers\admin\Form_fieldController@set_order_form_fields');
    Route::post('validate_form_field','App\Http\Controllers\admin\Form_fieldController@validate_form_field');
    Route::post('mail_send','App\Http\Controllers\admin\Form_fieldController@mail_send_fun');
    Route::get('remove_add_more_attribute/{form_id}/{id}/{attr_id}', [Form_fieldController::class, 'remove_more_attribute'])->name('remove_add_more_attribute');

    
    Route::resource('admin/order','App\Http\Controllers\admin\Ordercontroller');  
    Route::get('cleaning_package_order', '\App\Http\Controllers\admin\Ordercontroller@cleaning_package_order')
    ->name('cleaning_package_order');
    Route::get('painting-service-order', '\App\Http\Controllers\admin\Ordercontroller@painting_service_order')
    ->name('painting-service-order');
    Route::get('delete_order',[Ordercontroller::class,'destroy'])->name('delete_order');
    Route::get('admin/order/detail/{order_id}', [Ordercontroller::class, 'detail'])->name('detail');
    Route::get('admin/order/painting-detail/{order_id}', [Ordercontroller::class, 'detail'])->name('painting-detail');
    Route::get('admin/order/cleaning-detail/{order_id}', [Ordercontroller::class, 'detail'])->name('cleaning-detail');
    Route::get('admin/order/moving-detail/{order_id}', [Ordercontroller::class, 'detail'])->name('moving-detail');
    
    

    Route::resource('admin/order','App\Http\Controllers\admin\Ordercontroller');  
    Route::get('delete_order',[Ordercontroller::class,'destroy'])->name('delete_order');
    Route::get('admin/order/detail/{order_id}', [Ordercontroller::class, 'detail'])->name('detail');

    Route::post('assign_vendor', '\App\Http\Controllers\admin\Ordercontroller@assign_vendor');
    Route::post('painting-assign-vendor', '\App\Http\Controllers\admin\PaintingLeadscontroller@painting_assign_vendor');
    Route::post('painting-email-vendor', '\App\Http\Controllers\admin\PaintingLeadscontroller@painting_email_vendor');
    Route::post('painting-vendor-form', '\App\Http\Controllers\admin\PaintingLeadscontroller@painting_vendor_form');

    Route::post('add_amount_form', '\App\Http\Controllers\admin\Ordercontroller@add_amount_form');
    Route::post('checkAmountorder', '\App\Http\Controllers\admin\Ordercontroller@checkAmountorder');
    Route::match (['get','post'],'/vendors-filter','App\Http\Controllers\admin\Ordercontroller@vendor_commission_report')->name('vendors-filter');
    Route::get('filter_data_vendor', '\App\Http\Controllers\admin\Ordercontroller@filter_data_vendor');
    Route::get('admin/vendor-commission-report', '\App\Http\Controllers\admin\Ordercontroller@vendor_commission_report')->name('vendor-commission-report');
    
    Route::post('painting-wallet-vendor', '\App\Http\Controllers\admin\PaintingLeadscontroller@painting_wallet_vendor');

    Route::post('order_vendor_form', '\App\Http\Controllers\admin\Ordercontroller@order_vendor_form');
    Route::post('set_booking_percentage', '\App\Http\Controllers\admin\Ordercontroller@set_booking_percentage');

    Route::resource('admin/vendororder','App\Http\Controllers\admin\VendorOrderController');
    Route::get('admin/order/vendor-moving-detail/{vendororder_id}', [VendorOrderController::class, 'vendordetail'])->name('vendor-moving-detail');


    Route::get('admin/order/vendor-cleaning-detail/{vendororder_id}', [VendorOrderController::class, 'vendordetail'])->name('vendor-cleaning-detail');
    Route::get('admin/cleaning-listing', '\App\Http\Controllers\admin\VendorOrderController@cleaning_listing')
    ->name('cleaning-listing');

    Route::get('admin/order/vendor-painting-detail/{vendororder_id}', [VendorOrderController::class, 'vendordetail'])->name('vendor-painting-detail');
    Route::get('admin/painting-listing', '\App\Http\Controllers\admin\VendorOrderController@painting_listing')
    ->name('painting-listing');


    Route::resource('admin/subscribe','App\Http\Controllers\admin\SubscribeController');   
    Route::get('delete_subscribe',[SubscribeController::class,'destroy'])->name('delete_subscribe');

    Route::get('remove_others_att/{pid}/{id}', [PackagesController::class, 'remove_others_att'])->name('remove_others_att'); 
    Route::get('remove_packages_att/{pid}/{id}', [PackagesController::class, 'remove_packages_att'])->name('remove_packages_att'); 
    Route::get('remove_package_att/{pid}/{id}', [PackagesController::class, 'remove_package_att'])->name('remove_package_att'); 

    Route::get('/enquiry_login', '\App\Http\Controllers\front\Packagecontroller@enquiry_login')->name('enquiry_login');
   
    Route::resource('admin/blog','App\Http\Controllers\admin\BlogController'); 
    Route::get('delete_blog',[BlogController::class,'destroy'])->name('delete_blog');
    Route::post('blog_subservice_show', 'App\Http\Controllers\admin\BlogController@subservice_show');

    Route::resource('admin/blog_category','App\Http\Controllers\admin\Blog_categoryController'); 
    Route::get('delete_blog_category',[Blog_categoryController::class,'destroy'])->name('delete_blog_category');

    Route::resource('admin/salesreport','App\Http\Controllers\admin\SalesReportController');
    Route::get('admin/sales-report/detail/{order_id}', [SalesReportController::class, 'detail'])->name('details');


    Route::resource('admin/google_review','App\Http\Controllers\admin\GooglereviewController');
    Route::get('delete_google_review',[GooglereviewController::class,'destroy'])->name('delete_google_review');

    Route::resource('system','App\Http\Controllers\admin\SystemController'); 

    Route::resource('cleaning_price','App\Http\Controllers\admin\Cleaning_PriceController'); 

    Route::resource('time_slot_price','App\Http\Controllers\admin\Time_Slot_PriceController'); 

    Route::resource('painting-price','App\Http\Controllers\admin\PaintingPriceController'); 

    Route::resource('/admin/enquiry-users', '\App\Http\Controllers\admin\EnquiryUsersController');
    Route::match (['get','post'],'/filter-enquiryusers','App\Http\Controllers\admin\EnquiryUsersController@index')->name('filter-enquiryusers');
    Route::get('filter_data_enquiryusers', '\App\Http\Controllers\admin\EnquiryUsersController@filter_data_enquiryusers');

    Route::get('delete-enquiry-users',[EnquiryUsersController::class,'destroy'])->name('delete-enquiry-users');



});

Route::get('auto_accept_package','App\Http\Controllers\admin\CronController@auto_accept_package');

    Route::get('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

require __DIR__.'/auth.php';