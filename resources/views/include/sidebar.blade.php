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
                            <i class="fi-air-play"></i>
                            {{-- <span class="badge badge-success pull-right">2</span>  --}}
                            <span>
                                Dashboard </span>
                        </a>
                    </li>

                    <!-- New -->
                    {{-- @can('add-new')
                        <li>
                            <a href="javascript: void(0);">
                                <i class="fa fa-plus"></i>
                                <span>Add New </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level">

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

                                @can('room-type-create')
                                <li>
                                    <a href="{{ route('roomType.create') }}">
                                        <i class="fa fa-plus
                                        "></i>
                                        <span>Room Type</span>
                                    </a>
                                </li>
                                @endcan


                                @can('amenities-create')
                                <li>
                                    <a href="{{ route('amenities.create') }}">
                                        <i class="fa fa-plus"></i>
                                        <span>Assets</span>
                                        
                                    </a>
                                </li>
                                @endcan


                                @can('common-area-create')
                                <li>
                                    <a href="{{ route('commonArea.create') }}">
                                        <i class="fa fa-plus
                                        "></i>
                                        <span>Common Area</span>
                                    </a>
                                </li>
                                @endcan --}}


                               {{--  @can('landlord-management')

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
                                @endcan--}}

                                {{-- @can('parking-management')
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
                                            @can('parker-create')
                                                <li><a href="{{ route('parker.create') }}">New Parker</a></li>
                                            @endcan
                                            @can('vehicle-type-create')
                                                <li><a href="{{ route('vehicleType.create') }}">New Vehicle Type</a></li>
                                            @endcan
                                            @can('vehicle-create')
                                                <li><a href="{{ route('vehicle.create') }}">New Vehicle</a></li>
                                            @endcan

                                        </ul>
                                    </li>
                                @endcan 


                                @can('tenant-create')
                                <li>
                                    <a href="{{ route('tenant.create') }}">
                                        <i class="fa fa-plus"></i>
                                        <span>New Tenant</span>
                                    </a>
                                </li>
                                @endcan


                                @can('service-create')
                                <li>
                                    <a href="{{ route('service.create') }}">
                                        <i class="fa fa-plus"></i>
                                        <span>New Service</span>
                                    </a>
                                </li>
                                @endcan

                            </ul>
                        </li>
                    @endcan --}}

                    <!-- Property -->
                    @can('property-management')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-home"></i> <span> Property </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('building-list')
                                    <li><a href="{{ route('building') }}">View Buildings</a></li>
                                @endcan
                                {{-- @can('block-list')
                                    <li><a href="{{ route('block.index') }}">View Blocks</a></li>
                                @endcan --}}
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
                            <a href="javascript: void(0);"><i class="fa fa-clock-o"></i> <span> Pending Property </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('building-request')
                                    <li><a href="{{ route('building.pending') }}">Building Request</a></li>
                                @endcan
                                
                            </ul>
                        </li>
                    @endcan

                    {{-- rejected request --}}
                    @can('building-reject-list')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-close"></i> <span> Rejected Property </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('building-reject')
                                    <li><a href="{{ route('building.rejectList') }}">Rejected Buildings </a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    <!-- Amenities -->
                    @can('amenities-management')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-cube"></i> <span> Assets </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('amenities-list')
                                    <li><a href="{{ route('amenities.index') }}">Assets List</a></li>
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


                    {{-- parking  --}}
                     @can('parking-management')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-car"></i> <span>ParkEase</span>
                                <span class="menu-arrow
                                "></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                 @can('stall-list')
                                    <li><a href="{{ route('stall.index') }}">Stall List</a></li>
                                @endcan
                                @can('parker-list')
                                    <li><a href="{{ route('parker.index') }}">Parkers</a></li>
                                @endcan
                                @can('vehicle-type-list')
                                    <li><a href="{{ route('vehicleType.index') }}">Vehicle Types</a></li>
                                @endcan
                                @can('vehicle-list')
                                    <li><a href="{{ route('vehicle.index') }}">Vehicles</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan


                    {{-- tenant-registration --}}
                    @can('tenant-management')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-user"></i> <span> Tenants</span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('tenant-registration')
                                    <li><a href="{{ route('tenant.create') }}">Registration</a></li>
                                @endcan
                                @can('tenant-list')
                                    <li><a href="{{ route('tenants.index') }}">Tenant List</a></li>
                                @endcan
                                @can('tenant-agreement-create')
                                    <li><a href="{{ route('tenant.agreement.create') }}">Agreement Request</a></li>
                                    
                                @endcan
                                @can('tenant-agreement-list')
                                    <li><a href="{{ route('tenant.agreement.index') }}">Agreement List</a></li>
                                @endcan
                                @can('tenant-agreement-pending')
                                    <li><a href="{{ route('tenant.agreement.pending') }}">Pending Agreement List</a></li>
                                @endcan
                                @can('tenant-agreement-reject')
                                    <li><a href="{{ route('tenant.agreement.rejectList') }}">Rejected Agreement List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan


                    {{-- landlord --}}
                    @can('landlord-management')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-user"></i> <span> Landlords </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('landlord-list')
                                    <li><a href="{{ route('landlord.index') }}">Landlords List</a></li>
                                @endcan
                                @can('landlord-registration')
                                    <li><a href="{{ route('landlord.create') }}">Registration</a></li>
                                @endcan
                                @can('landlord-agreement-create')
                                    <li><a href="{{ route('landlord.agreement.create') }}">Agreement Request</a></li> 
                                @endcan
                                @can('landlord-agreement-list')
                                    <li><a href="{{ route('landlord.agreement.index') }}">Landlord Agreement</a></li>
                                    
                                @endcan
                            </ul>
                        </li>
                    @endcan




                    {{-- service --}}
                    @can('service-management')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-cogs"></i> <span> Services </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('service-list')
                                    <li><a href="{{ route('service.index') }}">Service List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan


                    {{-- service holder --}}
                    @can('service-holder-management')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-user"></i> <span> Service Holder </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('service-holder-list')
                                    <li><a href="{{ route('serviceHolder.index') }}">Service Holder List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan



                    {{-- maintenance --}}
                    @can('maintenance-management')
                        <li>
                            <a href="javascript: void(0);"><i class="fa fa-wrench"></i> <span> Maintenance </span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="nav-second-level " aria-expanded="false">
                                @can('maintenance-request')
                                <li><a href="{{ route('maintenance.create') }}">Maintenance Request</a></li>
                                @endcan
                                @can('maintenance-list')
                                    <li><a href="{{ route('maintenance.index') }}">Maintenance List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan



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
