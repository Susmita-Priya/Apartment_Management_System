<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                @if (Auth::check())
                    @php
                        $role_id = Auth::user()->role_id;
                    @endphp

                    <li class="menu-title">Navigation</li>

                    <li>
                        <a href="{{ url('/index') }}">
                            <i class="fi-air-play"></i><span class="badge badge-success pull-right">2</span> <span>
                                Dashboard </span>
                        </a>
                    </li>

                    <!-- New -->
                    @if (App\Models\Permission::hasPermission('add_new', $role_id))
                        <li>
                            <a href="javascript: void(0);">
                                <i class="fa fa-plus"></i>
                                <span> New </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level">
                                <li>
                                    <a href="javascript: void(0);">
                                        <i class="fa fa-plus"></i>
                                        <span> Property </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul class="nav-third-level" aria-expanded="false">
                                        <li><a href="{{ route('building.create') }}" >New Building</a></li>
                                        <li><a href="{{ route('block.create') }}" >New Block</a></li>
                                        <li><a href="{{ route('floor.create') }}" >New Floor</a></li>
                                        <li><a href="{{ route('comarea.create') }}" >New Common Area</a></li>
                                        <li><a href="{{ route('unit.create') }}" >New Unit</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <!-- Tenants -->
                    @if (App\Models\Permission::hasPermission('view_tenants', $role_id))
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-user"></i> <span> Tenants </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                {{-- @if (App\Models\Permission::hasPermission('add_tenants', $role_id))
                                    <li><a href="{{ url('/tenants/create') }}">Add Tenants</a></li>
                                @endif --}}
                                <li><a href="{{ route('tenant.index') }}">Tenant List</a></li>
                            </ul>
                        </li>
                    @endif

                    <!-- Landlords -->
                    {{-- @if (App\Models\Permission::hasPermission('view_landlords', $role_id))
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-user"></i> <span> Landlords </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @if (App\Models\Permission::hasPermission('add_landlords', $role_id))
                                    <li><a href="{{ url('/landlord/create') }}">Add Landlords</a></li>
                                @endif
                                <li><a href="{{ url('/landlord') }}">View Landlords</a></li>
                            </ul>
                        </li>
                    @endif --}}

                    <!-- Property -->
                    @if (App\Models\Permission::hasPermission('view_property', $role_id))
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-home"></i> <span> Property </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                {{-- @if (App\Models\Permission::hasPermission('add_property', $role_id))
                            <li><a href="{{ url('/building/create') }}">Add Property</a></li>
                            @endif --}}
                                <li><a href="{{ route('building') }}">View Buildings</a></li>
                                <li><a href="{{ route('block.index') }}">View blocks</a></li>
                                <li><a href="{{ route('floor.index') }}">View floors</a></li>
                                <li><a href="{{ route('comarea.index') }}">View Common Areas</a></li>
                                <li><a href="{{ route('unit.index') }}">View units</a></li>
                            </ul>
                        </li>
                    @endif

                    @if (App\Models\Permission::hasPermission('view_parking', $role_id))
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-car"></i> <span>Parking Management</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="nav-second-level " aria-expanded="false">
                            {{-- @if (App\Models\Permission::hasPermission('add_property', $role_id))
                        <li><a href="{{ url('/building/create') }}">Add Property</a></li>
                    @endif --}}
                            <li><a href="{{ route('stall_locker.create') }}">New Stall</a></li>
                            <li><a href="{{ route('vehicle.index') }}">Vehicles</a></li>
                            <li><a href="{{ route('parker.index') }}">Parkers</a></li>
                            <li><a href="{{ route('parking.list') }}">Parking List</a></li>
                            
                            {{-- <li><a href="{{ route('unit.index') }}">View unit</a></li> --}}
                        </ul>
                    </li>
                @endif

                    <!-- Leases / Tenancy -->
                    {{-- @if (App\Models\Permission::hasPermission('view_lease', $role_id))
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-home"></i> <span> Leases / Tenancy </span>
                                <span class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @if (App\Models\Permission::hasPermission('create_lease', $role_id))
                                    <li><a href="{{ url('/Lease/create') }}">Create Lease</a></li>
                                @endif
                                <li><a href="{{ url('/Lease') }}">View Lease</a></li>
                            </ul>
                        </li>
                    @endif --}}



                    <!------------------ bank management -------------------->
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-money"></i> <span> Bank Management </span>
                            <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level " aria-expanded="false">
                            <li><a href="{{ route('bank_transaction_type.index') }}">Bank Transaction Type</a></li>
                            <li><a href="{{ route('bank_transaction.index') }}">Bank Transaction</a></li>
                            <li><a href="{{ route('bank_transaction_report') }}">Bank Transaction Report</a></li>
                        </ul>
                    </li>


                    <!------------------ Payroll Management -------------------->
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-money"></i> <span> Payroll Management </span>
                            <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level " aria-expanded="false">
                            <li><a href="{{ route('department.index') }}">Department</a></li>
                            <li><a href="{{ route('designaiton.index') }}">Designaiton</a></li>
                            <li><a href="{{ route('employee_type.index') }}">Employee Type</a></li>
                            <li><a href="{{ route('job_location.index') }}">Job Location</a></li>
                            <li><a href="{{ route('employee.index') }}">Employee</a></li>
                            <li><a href="{{ route('salary_head.index') }}" class="text-capitalize">salary head</a></li>
                            <li><a href="{{ route('payroll.generate') }}" class="text-capitalize">generate payroll</a>
                            </li>
                            <li><a href="{{ route('payroll.index') }}" class="text-capitalize">payroll list</a></li>
                        </ul>
                    </li>

                    <!------------------ accounts Management -------------------->
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-book"></i> <span> Accounts </span> <span
                                class="menu-arrow"></span></a>
                        <ul class="nav-second-level " aria-expanded="false">
                            <li><a href="{{ route('account.index') }}">Account List</a></li>
                            <li><a href="{{ route('account-group.index') }}">Account Group List</a></li>
                            <li><a href="{{ route('journal-entry.index') }}">Journal Entries</a></li>
                            <li><a href="{{ route('general-ledger-report') }}">General Ledger</a></li>
                            <li><a href="{{ route('balance_sheet') }}">Balance Sheet</a></li>
                        </ul>
                    </li>


                    <!------------------ SAAS Management -------------------->
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-book"></i> <span> SAAS Management </span> <span
                                class="menu-arrow"></span></a>
                        <ul class="nav-second-level " aria-expanded="false">
                            <li><a href="{{ route('subscription_package.index') }}">Package List</a></li>
                            <li><a href="{{ route('subscription_package_duration.index') }}">Package Duration List</a>
                            </li>
                            <li><a href="{{ route('customer.index') }}">Customer List</a></li>
                        </ul>
                    </li>


                    <!-- Access Management -->
                    @if (App\Models\Permission::hasPermission('manage_access', $role_id))
                        <li>
                            <a href="javascript: void(0);"><i class="mdi mdi-lock-open"></i> <span> Access </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                <li><a href="{{ route('setting.create_edit') }}">Setting</a></li>
                                <li><a href="{{ url('/user') }}">User Management</a></li>
                                <li><a href="{{ url('/role') }}">Role Management</a></li>
                                <li><a href="{{ url('/permission') }}">Permission Management</a></li>
                            </ul>
                        </li>
                    @endif
            </ul>
            @endif
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
