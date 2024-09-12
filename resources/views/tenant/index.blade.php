@extends('master')
@php
    $page_titile = 'Tenant';
@endphp
@push('css')
    <!-- Datatables -->
    <link href="{{ asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endpush

@section('page_title', 'Tenant')
@section('page_tagline', 'Tenant List')

@section('content')

    <!--begin::Portlet-->
    <div class="content">
        <div class="card mt-4">
            <div class="card-head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                    <h3 class="kt-portlet__head-title">
                        {{ $page_titile }} List
                    </h3>
                </div>
                <div class="float-right mt-3">
                    <a href="{{ route('tenant.create') }}" class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i> Add New {{ $page_titile }}
                    </a>
                </div>
            </div>
            <div class="card-body" style="padding-bottom: 9rem !important;">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable dtr-inline" id="DataTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>NID</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($renters as $renter)
                            <tr id="tr-{{ $renter->r_id }}">
                                <td>
                                    @if (!empty($renter->r_image))
                                        <img src="{{ asset('uploads/tenant/' . $renter->r_image) }}" alt="no image"
                                            class="img-fluid img-thumbnail" style="width:120px;height:auto">
                                    @else
                                        <img src="{{ asset('default.png') }}" alt="no image" class="img-fluid img-thumbnail"
                                            style="width:120px;height:auto">
                                    @endif
                                </td>
                                <td scope="row">{{ $renter->r_name ?? '' }}</td>
                                <td scope="row">{{ $renter->r_phone ?? '' }}</td>
                                <td scope="row">{{ $renter->r_email ?? '' }}</td>
                                <td scope="row">{{ $renter->per_address ?? '' }}</td>
                                <td scope="row">{{ $renter->r_nid ?? '' }}</td>

                                <td class="text-center">
                                    <div class="btn-group dropdown">
                                        <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="false"><i
                                                class="mdi mdi-dots-horizontal"></i></a>
                                        <div class="dropdown-menu overflow-auto" aria-labelledby="btnGroupDrop1">

                                            <a href="{{ route('tenant.show', $renter->r_id) }}" class="dropdown-item"
                                                target="_blank">
                                                <i class="mdi mdi-eye m-r-10 text-muted font-18 vertical-middle"
                                                    title="view"></i>
                                                View
                                            </a>

                                            <a href="" class="dropdown-item" data-toggle="modal"
                                                data-target="#edit{{ $renter->r_id }}">
                                                <i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"
                                                    title="edit"></i>
                                                Edit
                                            </a>
                                            <a href="" class="dropdown-item" data-toggle="modal"
                                                data-target="#delete{{ $renter->r_id }}">
                                                <i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"
                                                    title="delete"></i>
                                                Delete
                                            </a>

                                            @if ($renter->renter_status == 1)
                                                <a href="{{ route('make-renter-in-active', $renter->r_id) }}"
                                                    type="button" class="dropdown-item"
                                                    onclick="return confirm('Are you sure to make in-active it.')">
                                                    <i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"
                                                        title="If this renter leave then click here"></i>
                                                    Make in-active
                                                </a>
                                            @else
                                                <a href="{{ route('make-renter-active', $renter->r_id) }}"
                                                    onclick="return confirm('Are you sure to make active it.')"
                                                    type="button" class="dropdown-item">
                                                    <i class="mdi mdi-check-mark m-r-10 text-muted font-18 vertical-middle"
                                                        title="If renter don't leave then click here"></i>
                                                    Make active
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal for Update -->
                            @include('tenant.update_modal')
                            @include('tenant.delete_modal')
                        @endforeach
                    </tbody>
                </table>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
    <!--modal-->
    <!--end::Portlet-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#renter-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#renters-sm').addClass('kt-menu__item--active');
        });
    </script>
@endpush
