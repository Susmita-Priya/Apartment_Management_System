@extends('Admin.layouts.app')

@php
    $page_titile = 'Tenant';
@endphp

@section('page_title', 'Tenant')
@section('page_tagline', 'Add Tenant')


@push('css')
    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{ asset('vendor/dashboard/assets/css/pages/wizard/wizard-3.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Page Custom Styles -->
@endpush

@section('content')
    @include('dashboard::components.delete-modal')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet" id="customer_page">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Add New {{ $page_titile }}
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3"
                            data-ktwizard-state="step-first">
                            <div class="kt-grid__item">

                                <!--begin: Form Wizard Nav -->
                                <div class="kt-wizard-v3__nav">
                                    <div class="kt-wizard-v3__nav-items kt-wizard-v3__nav-items--clickable">

                                        <!--doc: Replace A tag with SPAN tag to disable the step link click -->
                                        <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step"
                                            data-ktwizard-state="current">
                                            <div class="kt-wizard-v3__nav-body">
                                                <div class="kt-wizard-v3__nav-label">
                                                    <span>1</span> General Information
                                                </div>
                                                <div class="kt-wizard-v3__nav-bar"></div>
                                            </div>
                                        </div>
                                        <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
                                            <div class="kt-wizard-v3__nav-body">
                                                <div class="kt-wizard-v3__nav-label">
                                                    <span>2</span> Address
                                                </div>
                                                <div class="kt-wizard-v3__nav-bar"></div>
                                            </div>
                                        </div>
                                        <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
                                            <div class="kt-wizard-v3__nav-body">
                                                <div class="kt-wizard-v3__nav-label">
                                                    <span>3</span> Others
                                                </div>
                                                <div class="kt-wizard-v3__nav-bar"></div>
                                            </div>
                                        </div>
                                        <!--  <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
                                                <div class="kt-wizard-v3__nav-body">
                                                    <div class="kt-wizard-v3__nav-label">
                                                        <span>4</span> Attachments
                                                    </div>
                                                    <div class="kt-wizard-v3__nav-bar"></div>
                                                </div>
                                            </div> -->
                                    </div>
                                </div>

                                <!--end: Form Wizard Nav -->
                            </div>
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                                <!--begin: Form Wizard Form-->
                                <form class="kt-form" id="kt_form" action="" method="post">

                                    @include('Admin.renter.form-includes.general-information')

                                    @include('Admin.renter.form-includes.address')

                                    @include('Admin.renter.form-includes.others')

                                    <!--  @include('Admin.renter.form-includes.attachments') -->

                                    <!--begin: Form Actions -->
                                    <div class="kt-form__actions">
                                        <button
                                            class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                            data-ktwizard-type="action-prev">
                                            Previous
                                        </button>
                                        <button
                                            class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                            data-ktwizard-type="action-submit">
                                            Submit
                                        </button>
                                        <button
                                            class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                            data-ktwizard-type="action-next">
                                            Next Step
                                        </button>
                                    </div>

                                    <!--end: Form Actions -->
                                </form>

                                <!--end: Form Wizard Form-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Portlet-->
@endsection

@push('scripts')
    @include('dashboard::scripts.delete')

    @include('Admin.renter.form-includes.scripts')

    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('js/pages/customer.js') }}" type="text/javascript"></script>

    <!--end::Page Scripts -->
@endpush
