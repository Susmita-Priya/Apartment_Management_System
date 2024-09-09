@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left text-capitalize">{{ $page_title }}</h4>

                        <ol class="breadcrumb float-right text-capitalize">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $page_title }}</a></li>
                            <li class="breadcrumb-item active">{{ $page_title }} list</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div style="display:flex; justify-content:space-between;margin:0 14px; ">
                            <h4 class="header-title m-b-15 m-t-0">{{ $page_title }} List</h4>
                            <h4 class="header-title m-b-15 m-t-0">
                                <a href="{{ route('subscription_package.create') }}" class="btn btn-success">Add data</a>
                            </h4>
                        </div>

                        <table
                            class="table table-hover table-bordered m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr class="text-capitalize">
                                    <th>Package Name</th>
                                    <th>Short Description</th>
                                    <th>package duration</th>
                                    <th>Price</th>
                                    <th>User Role</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (!empty($subscription_packages))
                                    @foreach ($subscription_packages as $key => $subscription_package)
                                        <tr>
                                            <td>{{ $subscription_package->name ?? '' }}</td>
                                            <td>{!! $subscription_package->short_description ?? '' !!}</td>

                                            <td>
                                                @if (!empty($subscription_package->package_duration))
                                                    {{ $subscription_package->package_duration->value ?? '' }}
                                                    @if ($subscription_package->package_duration->type == 1)
                                                        Day
                                                    @elseif($subscription_package->package_duration->type == 2)
                                                        Week
                                                    @elseif($subscription_package->package_duration->type == 3)
                                                        Month
                                                    @elseif($subscription_package->package_duration->type == 4)
                                                        Year
                                                    @else
                                                        Not Found
                                                    @endif
                                                @endif
                                            </td>

                                            <td>{{ $subscription_package->price ?? '' }}</td>
                                            <td class=" text-center">{{ $subscription_package->role->name ?? '' }}
                                            <td>{!! $subscription_package->description ?? '' !!}</td>

                                            <td class="text-center">
                                                @if ($subscription_package->status == 1)
                                                    <span>Active</span>
                                                @else
                                                    <span class="text-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        <a class="dropdown-item "
                                                            href="{{ route('subscription_package.edit', $subscription_package->id) }}"
                                                            type="submit"><i
                                                                class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('subscription_package.delete', $subscription_package->id) }}"
                                                            onclick="return confirm('Are you sure to delete it ?')">
                                                            <i
                                                                class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
