   @extends('admin.includes.Template')

   @section('content')



       <div class="content container-fluid">

           <div class="success">

               @if ($message = Session::get('login_success'))
                   <div class="alert alert-success alert-dismissible fade show" style="text-align: center;">

                       {{ $message }}

                       <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                   </div>
               @endif

           </div>

           <!-- Page Header -->

           <div class="page-header">

               <div class="row align-items-center">

                   <div class="col">

                       <h2 class="page-title">Admin Dashboard</h2>

                   </div>

               </div>

           </div>
           @php
               $service_count = DB::table('services')->count();

           @endphp
           <div class="row">
               <div class="col-xl-3 col-sm-6 col-12">
                   <div class="card">
                       <div class="card-body">
                           <div class="dash-widget-header">
                               <span class="dash-widget-icon bg-1">
                                   <i class="fas fa-dollar-sign"></i>
                               </span>
                               <a href="{{ route('service.index') }}" style="color: #212529">
                                   <div class="dash-count">

                                       <div class="dash-title">Services</div>
                                       <div class="dash-counts">
                                           <p>{{ $service_count }}</p>
                                       </div>

                                   </div>
                               </a>
                           </div>
                           
                           <!--<p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>1.15%</span> since last week</p>-->
                       </div>
                   </div>
               </div>
               @php
                   $vendors_count = DB::table('users')
                       ->where('vendor', 1)
                       ->count();
               @endphp

               <div class="col-xl-3 col-sm-6 col-12">
                   <div class="card">
                       <div class="card-body">
                           <div class="dash-widget-header">
                               <span class="dash-widget-icon bg-2">
                                   <i class="fas fa-users"></i>
                               </span>
                               <a href="{{ route('vendors.index') }}" style="color: #212529">
                                   <div class="dash-count">
                                       <div class="dash-title">Vendors</div>
                                       <div class="dash-counts">
                                           <p>{{ $vendors_count }}</p>
                                       </div>
                                   </div>
                               </a>
                           </div>
                           
                           <!--<p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="fas fa-arrow-up me-1"></i>2.37%</span> since last week</p>-->
                       </div>
                   </div>
               </div>
               @php
                   $customers_count = DB::table('frontloginregisters')->count();
               @endphp
               <div class="col-xl-3 col-sm-6 col-12">
                   <div class="card">
                       <div class="card-body">
                           <div class="dash-widget-header">
                               <span class="dash-widget-icon bg-3">
                                   <i class="fas fa-file-alt"></i>
                               </span>
                               <a href="{{ route('frontuser.index') }}" style="color: #212529">
                                   <div class="dash-count">
                                       <div class="dash-title">Customers</div>
                                       <div class="dash-counts">
                                           <p>{{ $customers_count }}</p>
                                       </div>
                                   </div>
                               </a>
                           </div>
                           
                           <!--<p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="fas fa-arrow-up me-1"></i>3.77%</span> since last week</p>-->
                       </div>
                   </div>
               </div>
               @php
                   $leads_count = DB::table('packages_enquiry')->count();
               @endphp
               <div class="col-xl-3 col-sm-6 col-12">
                   <div class="card">
                       <div class="card-body">
                           <div class="dash-widget-header">
                               <span class="dash-widget-icon bg-4">
                                   <i class="far fa-file"></i>
                               </span>
                               <a href="{{ route('enquiry.index') }}" style="color: #212529">
                                   <div class="dash-count">
                                       <div class="dash-title">Total Leads
                                           <div class="dash-counts">
                                               <p>{{ $leads_count }}</p>
                                           </div>
                                       </div>
                                   </div>
                               </a>
                               <div class="progress progress-sm mt-3">
                                   <div class="progress-bar bg-8" role="progressbar" style="width: 45%" aria-valuenow="75"
                                       aria-valuemin="0" aria-valuemax="100"></div>
                               </div>
                               <!--<p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="fas fa-arrow-down me-1"></i>8.68%</span> since last week</p>-->
                           </div>
                       </div>
                   </div>
               </div>

           </div>

       @stop
