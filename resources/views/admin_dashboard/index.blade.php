@extends('master')

@section('content')
    @push('title')
        <title>Homepage</title>
    @endpush


    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Admin Dashboard</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">

                <div class="col-xl-3 col-sm-6">
                    <div class="card-box widget-box-three">
                        <div class="bg-icon pull-left">
                            <img src="{{ asset('admin_dashboard') }}/assets/images/icons/timeline.svg" title="timeline.svg">
                        </div>
                        <div class="text-right">
                            <p class="m-t-5 text-uppercase font-14 font-600">Total Building</p>
                            <h2 class="m-b-5"><i class="mdi mdi-arrow-up"></i><span
                                    data-plugin="counterup">{{ $building }}</span></h2>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-xl-3 col-sm-6">
                    <div class="card-box widget-box-three">
                        <div class="bg-icon pull-left">
                            <img src="{{ asset('admin_dashboard') }}/assets/images/icons/timeline.svg" title="timeline.svg">
                        </div>
                        <div class="text-right">
                            <p class="m-t-5 text-uppercase font-14 font-600">Total Floor</p>
                            <h2 class="m-b-5"><i class="mdi mdi-arrow-up"></i><span
                                    data-plugin="counterup">{{ $floor }}</span></h2>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-xl-3 col-sm-6">
                    <div class="card-box widget-box-three">
                        <div class="bg-icon pull-left">
                            <img src="{{ asset('admin_dashboard') }}/assets/images/icons/timeline.svg" title="timeline.svg">
                        </div>
                        <div class="text-right">
                            <p class="m-t-5 text-uppercase font-14 font-600">Total Unit</p>
                            <h2 class="m-b-5"><i class="mdi mdi-arrow-up"></i><span
                                    data-plugin="counterup">{{ $unit }}</span></h2>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-xl-3 col-sm-6">
                    <div class="card-box widget-box-three">
                        <div class="bg-icon pull-left">
                            <img src="{{ asset('admin_dashboard') }}/assets/images/icons/timeline.svg" title="timeline.svg">
                        </div>
                        <div class="text-right">
                            <p class="m-t-5 text-uppercase font-14 font-600">Total Room</p>
                            <h2 class="m-b-5"><i class="mdi mdi-arrow-up"></i><span
                                    data-plugin="counterup">{{ $room }}</span></h2>
                        </div>
                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->

            {{-- <div class="row">
                <div class="col-xl-4">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Revenue Comparison</h4>

                        <div class="text-center">
                            <h5 class="font-normal text-muted">You have to pay</h5>
                            <h3 class="m-b-30"><i class="mdi mdi-arrow-up-bold-hexagon-outline text-success"></i> 25643
                                <small>USD</small>
                            </h3>
                        </div>

                        <div class="chart-container">
                            <div class="" style="height:280px" id="platform_type_dates_donut"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Visitors Overview</h4>

                        <div class="text-center">
                            <h5 class="font-normal text-muted">You have to pay</h5>
                            <h3 class="m-b-30"><i class="mdi mdi-arrow-down-bold-hexagon-outline text-danger"></i> 5623
                                <small>USD</small>
                            </h3>
                        </div>

                        <div class="chart-container">
                            <div class="" style="height:280px" id="user_type_bar"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Goal Completion</h4>

                        <div class="text-center">
                            <h5 class="font-normal text-muted">You have to pay</h5>
                            <h3 class="m-b-30"><i class="mdi mdi-arrow-up-bold-hexagon-outline text-success"></i> 12548
                                <small>USD</small>
                            </h3>
                        </div>

                        <div class="chart-container">
                            <div class="chart has-fixed-height" style="height:280px" id="page_views_today"></div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- end row -->

            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title"><b>Recent Candidates</b></h4>
                        <p class="text-muted font-14 m-b-20">

                        </p>

                        <div class="table-responsive">
                            <table class="table table-hover m-0 table-actions-bar">

                                <thead>
                                    <tr>

                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Location</th>
                                        <th>Roles</th>
                                        <th>Create Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <i class="mdi mdi-account-circle text-primary"></i> {{ $user->name }}
                                            </td>

                                            <td>
                                                <i class="mdi mdi-email text-pink"></i> {{ $user->email }}
                                            </td>

                                            <td>
                                                <i class="mdi mdi-phone text-primary"></i> {{ $user->phone ?? 'N/A' }}
                                            </td>

                                            <td>
                                                <i class="mdi mdi-map-marker text-primary"></i>
                                                {{ $user->address ?? 'N/A' }}
                                            </td>

                                            <td>
                                                {{-- <i class="mdi mdi-account text-primary"></i>  --}}
                                                @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $v)
                                                        <label class="badge bg-success">{{ $v }}</label>
                                                    @endforeach
                                                @endif

                                            </td>

                                            <td>
                                                <i class="mdi mdi-clock text-success"></i> {{ $user->created_at }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--- end row -->
                    </div> <!-- container -->
                </div>
            @endsection
