<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">

        <a href="{{ route('index') }}" class="logo">
            <span>
                {{-- @if (!empty($general_setting->company_logo))
                    <img src="{{ asset('setting/company_logo/' . $general_setting->company_logo) }}" style="width:120px">
                @else
                    <img src="{{ asset('image') }}/bytecarelogodark.png" alt="" height="45">
                @endif --}}
                <p style="color: rgb(100, 197, 177);"> Apartment Management </p>
            </span>
            {{-- <i>
                <img src="{{ asset('image') }}/bytecarelogo_sm.png" alt="" height="28">
            </i> --}}
        </a>
    </div>

    <nav class="navbar-custom">

        <ul class="list-inline float-right mb-0">
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="dripicons-bell noti-icon"></i>
                    <span class="badge badge-pink noti-icon-badge">4</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5><span class="badge badge-danger float-right">5</span>Notification</h5>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
                        <p class="notify-details">Robert S. Taylor commented on Admin<small class="text-muted">1 min
                                ago</small></p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-info"><i class="icon-user"></i></div>
                        <p class="notify-details">New user registered.<small class="text-muted">1 min ago</small></p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-danger"><i class="icon-like"></i></div>
                        <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">1 min
                                ago</small></p>
                    </a>

                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                        View All
                    </a>

                </div>
            </li>

            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('image') }}/person-man.jpg" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        @if (Auth::check() && Auth::user()->name)
                            <h5 class="text-overflow"><small>Welcome {{ Auth::user()->name }}</small></h5>
                        @else
                            <script>
                                swal("Sorry!!", "You need to log in to access this page", 'error', {
                                    button: "OK",
                                }).then(() => {
                                    window.location.href = '{{ route('login') }}'; // Redirect to the login page after alert
                                });
                            </script>
                        @endif
                    </div>


                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-circle"></i> <span>Profile</span>
                    </a>
                    {{-- 
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="mdi mdi-settings"></i> <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="mdi mdi-lock-open"></i> <span>Lock Screen</span>
                    </a> --}}

                    <!-- item-->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <a href="#" class="dropdown-item notify-item" id="logoutBtn">
                        <i class="mdi mdi-power"></i> <span>Logout</span>
                    </a>

                    <script type="text/javascript">
                        document.getElementById('logoutBtn').addEventListener('click', function(event) {
                            event.preventDefault();
                            swal({
                                title: "Are you sure?",
                                text: "You will be logged out!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            }).then((willLogout) => {
                                if (willLogout) {

                                    document.getElementById('logout-form').submit();

                                } else {
                                    swal("You are still logged in!");
                                }
                            });
                        });
                    </script>


                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="dripicons-menu"></i>
                </button>
            </li>
            <li class="hide-phone app-search">
                <form role="search" class="">
                    <input type="text" placeholder="Search..." class="form-control">
                    <a href="#"><i class="fa fa-search"></i></a>
                </form>
            </li>
        </ul>

    </nav>

</div>
<!-- Top Bar End -->
