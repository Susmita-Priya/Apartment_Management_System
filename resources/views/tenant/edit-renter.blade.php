@extends('Admin.layouts.app')
@php
    $page_titile = 'Tenant';
@endphp

@section('page_title', 'Tenant')
@section('page_tagline', 'Edit Tenant')

@section('content')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet" id="passport_page">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Edit {{ $page_titile }} Information
                </h3>
            </div>
        </div>
        <form id="passport-form" action="" method="POST" class="kt-form kt-form--label-right"
            enctype="multipart/form-data">
            <div class="kt-portlet__body">
                @csrf
                @foreach ($renters as $renter)
                    <img src="{{ $renter->r_image }}" alt="dg" width="100px">
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            {{ $page_titile }} Name
                        </label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="r_name" value="{{ $renter->r_name }}"
                                required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            {{ $page_titile }} Phone Number
                        </label>
                        <div class="col-10">
                            <input class="form-control" type="number" name="r_phone" value="{{ $renter->r_phone }}"
                                required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            {{ $page_titile }} Email
                        </label>
                        <div class="col-10">
                            <input class="form-control" type="email" name="r_email" value="{{ $renter->r_email }}"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            {{ $page_titile }} Permanent Address
                        </label>
                        <div class="col-10">
                            <input class="form-control" type="address" name="per_address"
                                value="{{ $renter->per_address }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            {{ $page_titile }} NID Number
                        </label>
                        <div class="col-10">
                            <input class="form-control" type="number" name="r_nid" value="{{ $renter->r_nid }}"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            {{ $page_titile }} Image
                        </label>
                        <!-- <div class="col-10">
                                <input class="form-control-file" type="file" name="r_image"
                                 required>
                            </div> -->
                    </div>
                    <div class="col-12">
                        <input type="submit" name="btn" class="btn btn-success pull-right">
                    </div>
                @endforeach
            </div>

        </form>
    </div>
@endsection

@push('scripts')
    @include('dashboard::scripts.delete')
    <!-- Datatables -->
    <script src="{{ asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#renter-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#renters-sm').addClass('kt-menu__item--active');

            $('.table').DataTable({
                responsive: true
            });
        });
    </script>
@endpush
