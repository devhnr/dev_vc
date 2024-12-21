    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">

            @php
                $userId = Auth::id();

                $get_user_data = Helper::get_user_data($userId);

                $get_permission_data = Helper::get_permission_data($get_user_data->role_id);

                $permission1 = [];

                if (
                    is_object($get_permission_data) &&
                    property_exists($get_permission_data, 'permission') &&
                    $get_permission_data->permission !== ''
                ) {
                    $permission1 = $get_permission_data->permission;
                    $permission1 = explode(',', $permission1);
                } else {
                    echo '';
                    // Handle the case where $get_permission_data is not an object or 'permission' property is empty.
                }
            @endphp

            <ul>
                <li class="menu-title"><span>Main</span></li>
                <li class="{{ request()->segment(1) == 'admin' && request()->segment(2) == '' ? 'active' : '' }}">
                    @if (Auth::user()->vendor != 1)
                        <a href="{{ url('/admin') }}"><i data-feather="home"></i> <span>Dashboard</span></a>
                    @else
                        <a href="{{ url('/vendors') }}"><i data-feather="home"></i> <span>Dashboard</span></a>
                    @endif
                </li>
                @if (Auth::user()->vendor != 1)
                    @if (in_array('1', $permission1) ||
                            in_array('2', $permission1) ||
                            in_array('3', $permission1) ||
                            in_array('4', $permission1) ||
                            in_array('5', $permission1))
                        <li class="submenu">
                            <a href="#"
                                class="{{ request()->segment(2) == 'country' || request()->segment(2) == 'state' || request()->segment(2) == 'city' || request()->segment(2) == 'service' || request()->segment(2) == 'subservice' || request()->segment(2) == 'bulk_upload_city' ? 'active' : '' }}">
                                <i data-feather="pie-chart"></i> <span> Master</span> <span class="menu-arrow"></span></a>
                            <ul>
                                @if (in_array('1', $permission1))
                                    <li><a href="{{ route('continent.index') }}"
                                            class="{{ request()->segment(2) == 'continent' ? 'active' : '' }}">Continent</a>
                                    </li>
                                @endif
                                @if (in_array('1', $permission1))
                                    <li><a href="{{ route('country.index') }}"
                                            class="{{ request()->segment(2) == 'country' ? 'active' : '' }}">Country</a>
                                    </li>
                                @endif
                                @if (in_array('2', $permission1))
                                    <li><a href="{{ route('state.index') }}"
                                            class="{{ request()->segment(2) == 'state' ? 'active' : '' }}">State</a>
                                    </li>
                                @endif
                                @if (in_array('3', $permission1))
                                    <li><a href="{{ route('city.index') }}"
                                            class="{{ request()->segment(2) == 'city' || request()->segment(2) == 'bulk_upload_city' ? 'active' : '' }}">City</a>
                                    </li>
                                @endif
                                @if (in_array('4', $permission1))
                                    <li><a href="{{ route('service.index') }}"
                                            class="{{ request()->segment(2) == 'service' ? 'active' : '' }}">Service</a>
                                    </li>
                                @endif
                                @if (in_array('5', $permission1))
                                    <li><a href="{{ route('subservice.index') }}"
                                            class="{{ request()->segment(2) == 'subservice' ? 'active' : '' }}">Sub
                                            Service</a>
                                    </li>
                                @endif

                            </ul>
                        </li>

                    @endif
                @endif

                @if (Auth::user()->vendor != 1)

                    @if (in_array('8', $permission1))
                        <li class="{{ request()->segment(2) == 'vendors' ? 'active' : '' }}"><a
                                href="{{ route('vendors.index') }}"
                                class="{{ request()->segment(2) == 'vendors' ? 'active' : '' }}">
                                <i class="fa fa-users"></i><span>Vendors</span></a>
                        </li>
                    @endif

                    @if (in_array('9', $permission1))
                        <li class="{{ request()->segment(2) == 'price' ? 'active' : '' }}"><a
                                href="{{ route('price.edit', 1) }}"
                                class="{{ request()->segment(2) == 'price' ? 'active' : '' }}">
                                <i data-feather="credit-card"></i><span>Vendor Listing Price</span></a>
                        </li>
                    @endif
                    @if (in_array('15', $permission1))
                        <li class="{{ request()->segment(2) == 'faq' ? 'active' : '' }}"><a
                                href="{{ route('faq.index') }}"
                                class="{{ request()->segment(2) == 'faq' ? 'active' : '' }}">
                                <i class="fa fa-file"></i><span>FAQ</span></a>
                        </li>
                    @endif
                    @if (in_array('10', $permission1))
                        <li class="{{ request()->segment(2) == 'cms' ? 'active' : '' }}"><a
                                href="{{ route('cms.index') }}"
                                class="{{ request()->segment(2) == 'cms' ? 'active' : '' }}">
                                <i class="fa fa-file"></i><span>CMS</span></a>
                        </li>
                    @endif

                    <li class="{{ request()->segment(2) == 'blog' ? 'active' : '' }}"><a href="{{ route('blog.index') }}"
                            class="{{ request()->segment(1) == 'blog' ? 'active' : '' }}">
                            <i class="fa fa-file"></i><span>Blogs</span></a>
                    </li>
                    @if (in_array('25', $permission1))
                    <li class="{{ request()->segment(2) == 'blog_category' ? 'active' : '' }}"><a
                            href="{{ route('blog_category.index') }}"
                            class="{{ request()->segment(2) == 'blog_category' ? 'active' : '' }}">
                            <i class="fa fa-file"></i><span>Blog Category</span></a>
                    </li>
                @endif
                    @if (in_array('24', $permission1))
                        <li class="{{ request()->segment(1) == 'system' ? 'active' : '' }}"><a
                                href="{{ route('system.edit', '1') }}">
                                <i class="fa fa-file"></i><span>System</span></a>
                        </li>
                    @endif
                

                    <li class="submenu">
                    <a href="#"
                            class="{{ request()->segment(1) == 'cleaning_price' || request()->segment(1) == 'time_slot_price' ? 'active' : '' }}">
                            <i data-feather="pie-chart"></i> <span> Price</span> <span class="menu-arrow"></span></a>
                    <ul>

                    @if (in_array('28', $permission1))
                        <li><a href="{{ route('cleaning_price.edit', '1') }}"
                            class="{{ request()->segment(1) == 'cleaning_price' ? 'active' : '' }}"><i class="fa fa-file"></i>Cleaning Price</a>
                        </li>
                    @endif

                    @if (in_array('29', $permission1))
                        <li><a href="{{ route('time_slot_price.edit', '1') }}"
                            class="{{ request()->segment(1) == 'time_slot_price' ? 'active' : '' }}"><i class="fa fa-file"></i>Time Slot Price</a>
                        </li>
                    @endif

                    @if (in_array('30', $permission1))
                        <li><a href="{{ route('painting-price.edit', '1') }}"
                            class="{{ request()->segment(1) == 'painting-price' ? 'active' : '' }}"><i class="fa fa-file"></i>Painting Price</a>
                        </li>
                    @endif

                    </ul>

                    </li>
                    @if (in_array('11', $permission1))
                        <li class="{{ request()->segment(2) == 'packagecategory' ? 'active' : '' }}"><a
                                href="{{ route('packagecategory.index') }}"
                                class="{{ request()->segment(2) == 'packagecategory' ? 'active' : '' }}">
                                <i class="fa fa-file"></i><span>Package Category</span></a>
                        </li>
                    @endif
                    @if (in_array('12', $permission1))
                        <li class="{{ request()->segment(2) == 'packages' ? 'active' : '' }}"><a
                                href="{{ route('packages.index') }}"
                                class="{{ request()->segment(2) == 'packages' ? 'active' : '' }}">
                                <i class="fa fa-file"></i><span>Packages</span></a>
                        </li>
                    @endif
                    @if (in_array('16', $permission1))
                        <li class="{{ request()->segment(2) == 'frontuser' ? 'active' : '' }}"><a
                                href="{{ route('frontuser.index') }}"
                                class="{{ request()->segment(2) == 'frontuser' ? 'active' : '' }}">
                                <i class="fa fa-file"></i><span>Register Users</span></a>
                        </li>
                    @endif
                    @if (in_array('14', $permission1))
                        <li class="{{ request()->segment(2) == 'adminwallet' ? 'active' : '' }}"><a
                                href="{{ route('adminwallet.index') }}"
                                class="{{ request()->segment(2) == 'adminwallet' ? 'active' : '' }}">
                                <i class="fa fa-file"></i><span>Admin Wallet</span></a>
                        </li>
                    @endif
                    @if (in_array('17', $permission1))
                        <li class="{{ request()->segment(1) == 'enquiry' ? 'active' : '' }}"><a
                                href="{{ route('enquiry.index') }}"
                                class="{{ request()->segment(1) == 'enquiry' ? 'active' : '' }}">
                                <i class="fa fa-file"></i><span>Leads Enquiry</span></a>
                        </li>
                    @endif

                    @if (in_array('26', $permission1))
                        <li class="{{ request()->segment(1) == 'enquiry_accept' ? 'active' : '' }}"><a
                                href="{{ route('enquiry_accept') }}"
                                class="{{ request()->segment(1) == 'enquiry_accept' ? 'active' : '' }}">
                                <i class="fa fa-file"></i><span>Accepted Leads Enquiry</span></a>
                        </li>
                    @endif

                    @if (in_array('27', $permission1))
                        <li class="{{ request()->segment(1) == 'enquiry_reject' ? 'active' : '' }}"><a
                                href="{{ route('enquiry_reject') }}"
                                class="{{ request()->segment(1) == 'enquiry_reject' ? 'active' : '' }}">
                                <i class="fa fa-file"></i><span>Rejected Leads Enquiry</span></a>
                        </li>
                    @endif

                    @if (in_array('32', $permission1))
                        <li class="{{ request()->segment(1) == 'painting-enquiry' || request()->segment(1) == 'painting-lead-detail' ? 'active' : '' }}"><a
                                href="{{ route('painting-enquiry') }}"
                                class="{{ request()->segment(1) == 'painting-enquiry' ? 'active' : '' }}">
                                <i class="fa fa-file"></i><span>Painting Leads Enquiry</span></a>
                        </li>
                    @endif
                    @if (in_array('18', $permission1))
                        <li class="{{ request()->segment(2) == 'form_field' ? 'active' : '' }}"><a
                                href="{{ route('form_field.index') }}"
                                class="{{ request()->segment(2) == 'form_field' ? 'active' : '' }}">
                                <i class="fa fa-file"></i><span>Form Field</span></a>
                        </li>
                    @endif

                    {{-- @if (in_array('19', $permission1))
                        <li class="{{ request()->segment(2) == 'order' ? 'active' : '' }}">
                            <a href="{{ route('order.index') }}"><i data-feather="clipboard"></i><span>Package Order</span></a>
                        </li>
                    @endif --}}
                        <li class="submenu">
                        <a href="#"
                                class="{{ request()->segment(2) == 'order' || request()->segment(1) == 'cleaning_package_order' || request()->segment(1) == 'painting-service-order' || request()->segment(3) == 'painting-detail'  || request()->segment(3) == 'moving-detail' || request()->segment(3) == 'cleaning-detail'? 'active' : '' }}">
                                <i data-feather="pie-chart"></i> <span>Package Orders</span> <span class="menu-arrow"></span></a>
                                <ul>
                                @if (in_array('19', $permission1))
                                    <li class="{{ Route::currentRouteName() === 'order.index' || Route::currentRouteName() === 'moving-detail' ? 'active' : '' }}">
                                        <a href="{{ route('order.index') }}"><i data-feather="clipboard"></i>Order - Moving</a>
                                    </li>
                                    <li class="{{ Route::currentRouteName() === 'cleaning_package_order' || Route::currentRouteName() === 'cleaning-detail' ? 'active' : '' }}">
                                        <a href="{{ route('cleaning_package_order') }}">
                                        <i data-feather="clipboard"></i>Order - Cleaning
                                        </a>
                                    </li>
                                    <li class="{{ Route::currentRouteName() === 'painting-service-order' || Route::currentRouteName() === 'painting-detail' ? 'active' : '' }}">
                                    <a href="{{ route('painting-service-order') }}">
                                    <i data-feather="clipboard"></i>Order - Painting</a>
                                    </li>
                                @endif
                                </ul>
                            </li>


                    @if (in_array('33', $permission1))
                        <li class="{{ request()->segment(2) == 'vendor-commission-report' || request()->segment(1) == 'vendors-filter' ? 'active' : '' }}">

                            <a href="{{ route('vendor-commission-report') }}">
                            <i data-feather="clipboard"></i>
                            <span>Vendor Commission Report</span>
                        </a>
                    </li>
                    @endif

                    @if (in_array('20', $permission1))
                        <li class="{{ request()->segment(2) == 'subscribe' ? 'active' : '' }}">

                            <a href="{{ route('subscribe.index') }}"><i class="fa fa-bell" aria-hidden="true"></i>

                                <span>Subscribe</span></a>

                        </li>
                    @endif

                    @if (in_array('31', $permission1))
                        <li class="{{ request()->segment(2) == 'enquiry-users' ? 'active' : '' }}">

                            <a href="{{ route('enquiry-users.index') }}"><i data-feather="clipboard"></i>

                                <span>Enquiry Users</span></a>

                        </li>
                    @endif

                    @if (in_array('22', $permission1))
                        <li
                            class="{{ request()->segment(2) == 'salesreport' || request()->segment(2) == 'sales-report' ? 'active' : '' }}">
                            <a href="{{ route('salesreport.index') }}"><i data-feather="clipboard"></i><span>Sales
                                    Report</span></a>

                        </li>
                    @endif



                    <!--
                    @if (in_array('13', $permission1))
    <li
                        class="{{ request()->segment(2) == 'subscription' || request()->segment(1) == 'base_on_service_lead' || request()->segment(1) == 'based_on_booking_services' || request()->segment(1) == 'based_on_listing_criteria' ? 'active' : '' }}">
                        <a href="{{ route('subscription.index') }}"
                            class="{{ request()->segment(2) == 'subscription' ? 'active' : '' }}">
                            <i class="fa fa-file"></i><span>Subscription</span></a>
                    </li>
    @endif -->


                    @if (in_array('23', $permission1))
                        <li class="{{ request()->segment(2) == 'google_review' ? 'active' : '' }}">

                            <a href="{{ route('google_review.index') }}"><i class="fa fa-star" aria-hidden="true"></i>

                                <span>Google Review</span></a>

                        </li>
                    @endif


                    @if (in_array('6', $permission1) || in_array('7', $permission1))
                        <li class="submenu">
                            <a href="#"
                                class="{{ request()->segment(2) == 'userpermission' || request()->segment(2) == 'adminuser' ? 'active' : '' }}"><i
                                    data-feather="user"></i> <span> User Management</span> <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                @if (in_array('6', $permission1))
                                    <li class="{{ request()->segment(2) == 'userpermission' ? 'active' : '' }}">
                                        <a href="{{ route('userpermission.index') }}">
                                            <i class="fa fa-hand-o-up"></i> User Permission
                                        </a>
                                    </li>
                                @endif
                                @if (in_array('7', $permission1))
                                    <li class="{{ request()->segment(2) == 'adminuser' ? 'active' : '' }}">
                                        <a href="{{ route('adminuser.index') }}"><i data-feather="lock"></i> Admin User
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif



                @endif

                @if (Auth::user()->vendor == 1)
                    <li class="{{ request()->segment(1) == 'vendorsprofile' ? 'active' : '' }}"><a
                            href="{{ route('vendorsprofile.index') }}"
                            class="{{ request()->segment(1) == 'vendorsprofile' ? 'active' : '' }}">
                            <i class="fa fa-user-plus"></i><span>Profile</span></a>
                    </li>

                    <li
                        class="{{ request()->segment(2) == 'subscription-details' || request()->segment(2) == 'vendor-invoice' ? 'active' : '' }}">
                        <a href="{{ route('subscription-details.index') }}"
                            class="{{ request()->segment(2) == 'subscription-details' || request()->segment(2) == 'vendor-invoice' ? 'active' : '' }}">
                            <i class="fa fa-file"></i><span>Subscription Details</span></a>
                    </li>

                    <li class="{{ request()->segment(2) == 'vendorinquiry' || request()->segment(1) == 'enquiry_detail' || request()->segment(1) == 'accpet_form' ? 'active' : '' }}"><a
                            href="{{ route('vendorinquiry.index') }}"
                            class="{{ request()->segment(1) == 'vendorinquiry'  ? 'active' : '' }}">
                            <i class="fa fa-file"></i><span>Inquiry</span></a>
                    </li>

                    
                    <li class="{{ request()->segment(2) == 'acceptleads' || request()->segment(1) == 'enquiry_details' ? 'active' : '' }}"><a
                            href="{{ route('acceptleads.index') }}"
                            class="{{ request()->segment(1) == 'acceptleads' ? 'active' : '' }}">
                            <i class="fa fa-file"></i><span>Accepted Leads</span></a>
                    </li>
                    <li class="{{ request()->segment(2) == 'rejectleads' ? 'active' : '' }}"><a
                            href="{{ route('rejectleads.index') }}"
                            class="{{ request()->segment(1) == 'rejectleads' ? 'active' : '' }}">
                            <i class="fa fa-file"></i><span>Rejected Leads</span></a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'painting-inquiry' || request()->segment(1) == 'painting-enquiry-detail') ? 'active' : '' }}">
                        <a href="{{ route('painting-inquiry.index') }}" class="{{ (request()->segment(2) == 'painting-inquiry' || request()->segment(1) == 'painting-enquiry-detail') ? 'active' : '' }}">
                            <i class="fa fa-file"></i><span>Painting Inquiry</span>
                        </a>
                    </li>
                    <li class="{{ request()->segment(2) == 'vendor-commission-report' || request()->segment(1) == 'vendors-filter' ? 'active' : '' }}">

                        <a href="{{ route('vendor-commission-report') }}">
                        <i data-feather="clipboard"></i>
                        <span>Vendor Commission Report</span>
                        </a>
                    </li>

                    <li class="{{ request()->segment(1) == 'wallet' ? 'active' : '' }}"><a
                            href="{{ route('wallet.index') }}"
                            class="{{ request()->segment(1) == 'wallet' ? 'active' : '' }}">
                            <i class="fa fa-file"></i><span>Wallet</span></a>
                    </li>
                    {{-- <li
                        class="{{ request()->segment(2) == 'vendororder' || request()->segment(2) == 'order/vendororderdetail/' ? 'active' : '' }}">
                        <a href="{{ route('vendororder.index') }}"
                            class="{{ request()->segment(2) == 'vendororder' ? 'active' : '' }}">
                            <i class="fa fa-file"></i><span>Order Details</span></a>
                    </li> --}}

                    <li
                        class="{{ request()->segment(2) == 'vendororder' || request()->segment(3) == 'vendororderdetail' ? 'active' : '' }}">
                        <a href="{{ route('vendororder.index') }}"
                            class="{{ request()->segment(2) == 'vendororder' || request()->segment(3) == 'vendororderdetail' ? 'active' : '' }}">
                            <i class="fa fa-file"></i><span>Order Details</span>
                        </a>
                    </li>
                    <li
                        class="{{ request()->segment(2) == 'painting-listing' || request()->segment(3) == 'vendor-painting-detail' ? 'active' : ''}}">
                        <a href="{{ route('painting-listing') }}"
                            class="{{ request()->segment(2) == 'painting-listing' || request()->segment(3) == 'vendor-painting-detail' ? 'active' : ''}}">
                            <i class="fa fa-file"></i><span>Painting Details</span>
                        </a>
                    </li>
                @endif


            </ul>
        </div>

    </div>
