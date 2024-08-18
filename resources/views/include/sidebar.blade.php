
<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                @php
                    $role_id = Auth::user()->role_id;
                @endphp

                <li class="menu-title">Navigation</li>
                
                <li>
                    <a href="{{url('/index') }}">
                        <i class="fi-air-play"></i><span class="badge badge-success pull-right">2</span> <span> Dashboard </span>
                    </a>
                </li>

                <!-- Tenants -->
                @if (App\Models\Permission::hasPermission('view_tenants', $role_id))
                <li>
                    <a href="javascript: void(0);"><i class="fa fa-user"></i> <span> Tenants </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level " aria-expanded="false">
                        @if (App\Models\Permission::hasPermission('add_tenants', $role_id))
                            <li><a href="{{ url('/tenants/create') }}">Add Tenants</a></li>
                        @endif
                        <li><a href="{{ url('/tenants') }}">View Tenants</a></li>
                    </ul>
                </li>
                @endif

                <!-- Landlords -->
                @if (App\Models\Permission::hasPermission('view_landlords', $role_id))
                <li>
                    <a href="javascript: void(0);"><i class="fa fa-user"></i> <span> Landlords </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level " aria-expanded="false">
                        @if (App\Models\Permission::hasPermission('add_landlords', $role_id))
                            <li><a href="{{ url('/landlord/create') }}">Add Landlords</a></li>
                        @endif
                        <li><a href="{{ url('/landlord') }}">View Landlords</a></li>
                    </ul>
                </li>
                @endif

                <!-- Property -->
                @if (App\Models\Permission::hasPermission('view_property', $role_id))
                <li>
                    <a href="javascript: void(0);"><i class="fa fa-home"></i> <span> Property </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level " aria-expanded="false">
                        @if (App\Models\Permission::hasPermission('add_property', $role_id))
                            <li><a href="{{ url('/property/create') }}">Add Property</a></li>
                        @endif
                        <li><a href="{{ url('/property') }}">View Property</a></li>
                    </ul>
                </li>
                @endif

                <!-- Leases / Tenancy -->
                @if (App\Models\Permission::hasPermission('view_lease', $role_id))
                <li>
                    <a href="javascript: void(0);"><i class="fa fa-home"></i> <span> Leases / Tenancy </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level " aria-expanded="false">
                        @if (App\Models\Permission::hasPermission('create_lease', $role_id))
                            <li><a href="{{ url('/Lease/create') }}">Create Lease</a></li>
                        @endif
                        <li><a href="{{ url('/Lease') }}">View Lease</a></li>
                    </ul>
                </li>
                @endif

                <!-- Access Management -->
                @if (App\Models\Permission::hasPermission('manage_access', $role_id))
                <li>
                    <a href="javascript: void(0);"><i class="mdi mdi-lock-open"></i> <span> Access </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level " aria-expanded="false">
                        <li><a href="{{ url('/user') }}">User Management</a></li>
                        <li><a href="{{ url('/role') }}">Role Management</a></li>
                        <li><a href="{{ url('/permission') }}">Permission Management</a></li>
                    </ul>
                </li>
                @endif
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
