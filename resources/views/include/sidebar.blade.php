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
                        <a href="{{ route('index') }}">
                            <i class="fi-air-play"></i><span class="badge badge-success pull-right">2</span> <span>
                                Dashboard </span>
                        </a>
                    </li>

                    <!-- New -->
                    @can('add-new')
                        <li>
                            <a href="javascript: void(0);">
                                <i class="fa fa-plus"></i>
                                <span>Add New </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level">

                                @can('amenities-create')
                                <li>
                                    <a href="{{ route('amenities.create') }}">
                                        <i class="fa fa-plus"></i>
                                        <span>New Amenity</span>
                                        
                                    </a>
                                </li>
                                @endcan

                                @can('room-type-create')
                                <li>
                                    <a href="{{ route('roomType.create') }}">
                                        <i class="fa fa-plus
                                        "></i>
                                        <span>New Room Type</span>
                                    </a>
                                </li>
                                @endcan

                                @can('common-area-create')
                                <li>
                                    <a href="{{ route('commonArea.create') }}">
                                        <i class="fa fa-plus"></i>
                                        <span>Common Area</span>
                                    </a>
                                </li>
                                @endcan

                                @can('property-management')
                                    <li>
                                        <a href="javascript: void(0);">
                                            <i class="fa fa-plus"></i>
                                            <span> Property </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-third-level" aria-expanded="false">
                                            @can('building-create')
                                                <li><a href="{{ route('building.create') }}">New Building</a></li>
                                            @endcan
                                            @can('block-create')
                                                <li><a href="{{ route('block.create') }}">New Block</a></li>
                                            @endcan
                                            @can('floor-create')
                                                <li><a href="{{ route('floor.create') }}">New Floor</a></li>
                                            @endcan 
                                            @can('unit-create')
                                                <li><a href="{{ route('unit.create') }}">New Unit</a></li>
                                            @endcan
                                            @can('room-create')
                                                <li><a href="{{ route('room.create') }}">New Room</a></li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endcan

                                {{-- @can('tenant-management')
                                    <li>
                                        <a href="javascript: void(0);">
                                            <i class="fa fa-plus"></i>
                                            <span> Tenant </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        @can('tenant-create')
                                            <ul class="nav-third-level" aria-expanded="false">
                                                <li><a href="{{ route('tenants.create') }}">New Tenant</a></li>
                                            </ul>
                                        @endcan
                                    </li>
                                @endcan


                                @can('landlord-management')

                                    <li>
                                        <a href="javascript: void(0);">
                                            <i class="fa fa-plus"></i>
                                            <span> Landlord </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        @can('landlord-create')
                                            <ul class="nav-third-level" aria-expanded="false">
                                                <li><a href="{{ route('landlord.create') }}">New Landlord</a></li>
                                            </ul>

                                        @endcan
                                    </li>
                                @endcan

                                @can('parking-management')
                                    <li>
                                        <a href="javascript: void(0);">
                                            <i class="fa fa-plus"></i>
                                            <span> Parking </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-third-level" aria-expanded="false">
                                            @can('stall-create')
                                                <li><a href="{{ route('stall.create') }}">New Stall</a></li>
                                            @endcan
                                            @can('vehicle-create')
                                                <li><a href="{{ route('vehicle.create') }}">New Vehicle</a></li>
                                            @endcan
                                            @can('parker-create')
                                                <li><a href="{{ route('parker.create') }}">New Parker</a></li>
                                            @endcan

                                        </ul>
                                    </li>
                                @endcan --}}
                            </ul>
                        </li>
                    @endcan

                    <!-- Amenities -->
                    @can('amenities-management')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-cube"></i> <span> Amenities </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('amenities-list')
                                    <li><a href="{{ route('amenities.index') }}">Amenities List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan


                    {{-- Room Type --}}
                    @can('room-type-management')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-bed"></i> <span> Room Type </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                            @can('room-type-list')
                                <li><a href="{{ route('roomType.index') }}">Room Type List</a></li>
                            @endcan
                            </ul>
                        </li>
                    @endcan


                    <!-- Common Area -->
                    @can('common-area-management')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-object-group"></i> <span> Common Area </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('common-area-list')
                                    <li><a href="{{ route('commonArea.index') }}">Common Area List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan


                    <!-- Property -->
                    @can('property-management')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-home"></i> <span> Property </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('building-list')
                                    <li><a href="{{ route('building') }}">View Buildings</a></li>
                                @endcan
                                @can('block-list')
                                    <li><a href="{{ route('block.index') }}">View Blocks</a></li>
                                @endcan
                                @can('floor-list')
                                    <li><a href="{{ route('floor.index') }}">View Floors</a></li>
                                @endcan
                                @can('unit-list')
                                    <li><a href="{{ route('unit.index') }}">View Units</a></li>
                                @endcan
                                @can('room-list')
                                    <li><a href="{{ route('room.index') }}">View Rooms</a></li>
                                @endcan
                                
                            </ul>
                        </li>
                    @endif


                    {{-- pending request --}}
                    @can('pending-request-list')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-clock-o"></i> <span> Pending Request </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('building-request')
                                    <li><a href="{{ route('building.pending') }}">Building Request</a></li>
                                @endcan
                                
                            </ul>
                        </li>
                    @endcan


                    {{-- <!-- Tenants -->
                    @can('tenant-management')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-user"></i> <span> Tenants </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('tenant-list')
                                    <li><a href="{{ route('tenants.index') }}">Tenants List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan


                    <!-- Landlords -->
                    @can('landlord-management')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-user"></i> <span> Landlords </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('landlord-list')
                                    <li><a href="{{ route('landlord.index') }}">Landlords List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan --}}



                    <!-- lease -->
{{-- 
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-user"></i> <span> Leases </span> <span
                                class="menu-arrow"></span></a>
                        <ul class="nav-second-level " aria-expanded="false">

                            <li><a href="{{ route('lease.index') }}">Leases Request</a></li>

                            <li><a href="{{ route('lease.agreement') }}">Agreement</a></li>


                        </ul>
                    </li>


                    @can('parking-management')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-car"></i> <span>Parking Management</span>
                                <span class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('vehicle-list')
                                    <li><a href="{{ route('vehicle.index') }}">Vehicles</a></li>
                                @endcan
                                @can('parker-list')
                                    <li><a href="{{ route('parker.index') }}">Parkers</a></li>
                                @endcan
                                @can('stall-list')
                                    <li><a href="{{ route('parking.list') }}">Stall List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan --}}

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
                    {{-- <li>
                        <a href="javascript: void(0);"><i class="fa fa-money"></i> <span> Bank Management </span>
                            <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level " aria-expanded="false">
                            <li><a href="{{ route('bank_transaction_type.index') }}">Bank Transaction Type</a></li>
                            <li><a href="{{ route('bank_transaction.index') }}">Bank Transaction</a></li>
                            <li><a href="{{ route('bank_transaction_report') }}">Bank Transaction Report</a></li>
                        </ul>
                    </li> --}}


                    <!------------------ Payroll Management -------------------->
                    {{-- <li>
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
                    </li> --}}

                    <!------------------ accounts Management -------------------->
                    {{-- <li>
                        <a href="javascript: void(0);"><i class="fa fa-book"></i> <span> Accounts </span> <span
                                class="menu-arrow"></span></a>
                        <ul class="nav-second-level " aria-expanded="false">
                            <li><a href="{{ route('account.index') }}">Account List</a></li>
                            <li><a href="{{ route('account-group.index') }}">Account Group List</a></li>
                            <li><a href="{{ route('journal-entry.index') }}">Journal Entries</a></li>
                            <li><a href="{{ route('general-ledger-report') }}">General Ledger</a></li>
                            <li><a href="{{ route('balance_sheet') }}">Balance Sheet</a></li>
                        </ul>
                    </li> --}}

                    {{-- 
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
                        </li> --}}


                    <!-- Access Management -->
                    @can('access-control')
                        <li>
                            <a href="javascript: void(0);"><i class="mdi mdi-lock-open"></i> <span> Access </span>
                                <span class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('user-list')
                                    <li><a href="{{ route('users.index') }}">User Management</a></li>
                                @endcan
                                @can('role-list')
                                    <li><a href="{{ route('roles.index') }}">Role Management</a></li>
                                @endcan
                            </ul>
                        </li>

                    @endcan
                    @endif
                </ul>

            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->
