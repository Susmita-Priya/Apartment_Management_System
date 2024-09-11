@extends('master')

@push('title')
    <title>Users</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Subscription Users List</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Users</a></li>
                            <li class="breadcrumb-item active">Users list</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0" style="position: relative;">
                            Subscription Users List
                        </h4>

                        <hr>

                        <table
                            class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap table-bordered"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr class="text-capitalize">
                                    <th>SL</th>
                                    <th>Subscription Date</th>
                                    <th>Subscription Expire Date</th>
                                    <th>Package</th>
                                    <th>Duration</th>
                                    <th>price</th>
                                    <th>discount</th>
                                    <th>total payable</th>
                                    <th>total paid</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($subscription_infos))
                                    @foreach ($subscription_infos as $key => $subscription_info)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $subscription_info->subcription_date ?? '' }}</td>
                                            <td>{{ $subscription_info->expire_date ?? '' }}</td>
                                            <td>{{ $subscription_info->subscription_package->name ?? '' }}</td>
                                            <td>
                                                {{ $subscription_info->package_duration->value ?? '' }}
                                                @if ($subscription_info->package_duration->type == 1)
                                                    Day
                                                @elseif($subscription_info->package_duration->type == 2)
                                                    Week
                                                @elseif($subscription_info->package_duration->type == 3)
                                                    Month
                                                @elseif($subscription_info->package_duration->type == 4)
                                                    Year
                                                @else
                                                    Not Found
                                                @endif
                                            </td>
                                            <td>{{ $subscription_info->package_price ?? '' }}</td>
                                            <td>{{ $subscription_info->discount_amount ?? '' }}</td>
                                            <td>{{ ($subscription_info->total_payable_amount ?? 0) }}</td>
                                            <td>{{ $subscription_info->total_paid_amount ?? '' }}</td>
                                            <td>
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        <a class="dropdown-item"
                                                            href="{{ route('user_subscription.edit', ['id' => $subscription_info->id]) }}">
                                                            <i
                                                                class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('user_subscription.delete', ['id' => $subscription_info->id]) }}"
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
