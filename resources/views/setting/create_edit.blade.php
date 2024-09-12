@extends('master')
@section('content')
    @php
        if (!empty($setting->id)) {
            $route = route('setting.update', $setting->id);
            $page_title_prefix = 'Update';
        } else {
            $route = route('setting.store');
            $page_title_prefix = 'Create';
        }
    @endphp
    <style>
        label {
            text-transform: capitalize;
        }
    </style>
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box text-capitalize">
                        <h4 class="page-title float-left">{{ $page_title }}</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $page_title }}</a></li>
                            <li class="breadcrumb-item active">{{ $page_title_prefix }} {{ $page_title }}</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>



            <!-- end row -->
            <div class="row">
                <div class="col-md-2"><a href="#" class="btn btn-success text-capitalize"><i class="fa fa-list"></i>
                        Go To {{ $page_title }} List</a></div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-box">
                            <h4 class="d-flex justify-content-center mt-4 text-capitalize">{{ $page_title_prefix }}
                                {{ $page_title }}</h4>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="company_name" class="col-form-label">company name *</label>
                                    <input type="text" class="form-control" name="company_name" id="company_name"
                                        value="{{ $setting->company_name ?? '' }}" required>
                                    <span class="text-danger">
                                        @error('company_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="address" class="col-form-label">address</label>
                                    <input type="text" class="form-control" name="address" id="address"
                                        value="{{ $setting->address ?? '' }}">
                                    <span class="text-danger">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="phone" class="col-form-label">phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                        value="{{ $setting->phone ?? '' }}">
                                    <span class="text-danger">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="email" class="col-form-label">email</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        value="{{ $setting->email ?? '' }}">
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="company_website_link" class="col-form-label">company website link</label>
                                    <input type="text" class="form-control" name="company_website_link" id="company_website_link"
                                        value="{{ $setting->company_website_link ?? '' }}">
                                    <span class="text-danger">
                                        @error('company_website_link')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                {{-- hidden --}}
                                <input type="hidden" name="company_logo" value="{{ $setting->company_logo ?? '' }}">
                                <div class="form-group col-md-6">
                                    <label for="company_logo" class="col-form-label">company logo</label>
                                    <input type="file" class="form-control" name="company_logo" id="company_logo"
                                        value="{{ $setting->company_logo ?? '' }}">
                                    <span class="text-danger">
                                        @error('company_logo')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                @if (!empty($setting->company_logo))
                                    <div class="form-group col-md-6">
                                        <img src="{{ asset('setting/company_logo/' . $setting->company_logo) }}"
                                            style="width:120px">
                                    </div>
                                @endif
                            </div>


                            {{-- <button type="submit" class="btn btn-primary">ADD</button> --}}
                            <button type="submit" class="btn waves-effect waves-light btn-sm" id="sa-success-updateuser"
                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
                                {{ $page_title_prefix }} Data
                            </button>


                        </div>
                    </form>

                </div>
                <div class="col-md-4"></div>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    </div>
@endsection
