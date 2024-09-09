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
                            <h4 class="header-title m-b-15 m-t-0"></h4>
                        </div>

                        <table class="table table-hover table-bordered m-0 tickets-list table-actions-bar dt-responsive"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr class="text-capitalize nowrap">
                                    <th>SL</th>
                                    <th>registration date</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>company name</th>
                                    <th>paying method</th>
                                    <th>payment details</th>
                                    <th>package</th>
                                    <th>package duration</th>
                                    {{-- <th>package price</th>
                                    <th>package discount</th> --}}
                                    <th>total</th>
                                    <th>status</th>
                                    <th class="hidden-sm">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (!empty($customers))
                                    @foreach ($customers as $key => $customer)
                                        <tr>
                                            <td scope="row">{{ ++$key }}</td>
                                            <td>{{ $customer->registration_date ?? '' }}</td>
                                            <td>{{ $customer->name ?? '' }}</td>
                                            <td>{{ $customer->email ?? '' }}</td>
                                            <td>{{ $customer->phone ?? '' }}</td>
                                            <td>{{ $customer->company_name ?? '' }}</td>
                                            <td>
                                                @if ($customer->payment_method == 1)
                                                    Cash
                                                @elseif($customer->payment_method == 2)
                                                    Bank
                                                @elseif($customer->payment_method == 2)
                                                    Mobile Banking
                                                @endif
                                            </td>
                                            <td>{{ $customer->payment_details ?? '' }}</td>
                                            <td>{{ $customer->subscription_package->name ?? '' }}</td>
                                            <td>
                                                @if (!empty($customer->duration))
                                                    {{ $customer->duration->value ?? '' }}
                                                    @if ($customer->duration->type == 1)
                                                        Day
                                                    @elseif($customer->duration->type == 2)
                                                        Week
                                                    @elseif($customer->duration->type == 3)
                                                        Month
                                                    @elseif($customer->duration->type == 4)
                                                        Year
                                                    @else
                                                        Not Found
                                                    @endif
                                                @endif
                                            </td>
                                            {{-- <td>{{ $customer->package_price ?? '' }}</td>
                                            <td>{{ $customer->discount_amount ?? '' }}</td> --}}
                                            <td>
                                                {{ ($customer->package_price ?? 0) - ($customer->discount_amount ?? 0) }}
                                            </td>

                                            <td>
                                                @if ($customer->status == 1)
                                                    <span class="text-success"> Approved </span>
                                                @elseif($customer->status == 2)
                                                    <span class="text-primary"> Pending </span>
                                                @else
                                                    Reject
                                                @endif

                                            </td>
                                            <td>
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                        @if ($customer->status != 1)
                                                            <a class="dropdown-item "
                                                                href="{{ route('customer.approve', $customer->id) }}"
                                                                onclick="return confirm('Are you sure to approve it ?')"><i
                                                                    class="mdi mdi-check m-r-10 text-muted font-18 vertical-middle"></i>
                                                                Approve
                                                            </a>
                                                        @endif

                                                        @if ($customer->status != 0)
                                                            <a class="dropdown-item"
                                                                href="{{ route('customer.reject', $customer->id) }}"
                                                                onclick="return confirm('Are you sure to reject it ?')"><i
                                                                    class="mdi mdi-close m-r-10 text-muted font-18 vertical-middle"></i>
                                                                Reject
                                                            </a>
                                                        @endif

                                                        <a class="dropdown-item"
                                                            href="{{ route('customer.delete', $customer->id) }}"
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
