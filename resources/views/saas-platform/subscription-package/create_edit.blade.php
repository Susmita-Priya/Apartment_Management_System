@extends('master')
@section('content')
    @php
        if (!empty($subscription_package->id)) {
            $route = route('subscription_package.update', $subscription_package->id);
            $page_title_prefix = 'Update';
        } else {
            $route = route('subscription_package.store');
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
                <div class="col-md-2"><a href="{{ route('subscription_package.index') }}"
                        class="btn btn-success text-capitalize"><i class="fa fa-list"></i> Go To {{ $page_title }}
                        List</a></div>
                <div class="col-md-8">
                    <form action="{{ $route }}" enctype="multipart/form-data" method="POST">
                        @if (!empty($subscription_package->id))
                            @method('PUT')
                        @endif

                        @csrf

                        <div class="card-box">
                            <h4 class="d-flex justify-content-center mt-4 text-capitalize">{{ $page_title_prefix }}
                                {{ $page_title }}</h4>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="sl_no" class="col-form-label">sl no *</label>
                                    <input type="text" class="form-control" name="sl_no" id="sl_no"
                                        value="{{ $subscription_package->sl_no ?? ($sl_no ?? '') }}"
                                        placeholder="Enter Serial Number" required>
                                    <span class="text-danger">
                                        @error('sl_no')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name" class="col-form-label">Package Name *</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $subscription_package->name ?? '' }}" placeholder="Enter Package Name"
                                        required>
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="subscription_package_duration_id" class="col-form-label">Package duration *</label>
                                    <select name="subscription_package_duration_id" class="form-control chosen" required>
                                        <option value="">Select One</option>
                                        @if (isset($subscription_package_durations) && count($subscription_package_durations) > 0)
                                            @foreach ($subscription_package_durations as $duration)
                                                <option value="{{ $duration->id }}" @isset($subscription_package) {{ $duration->id == $subscription_package->subscription_package_duration_id ? 'selected' : '' }} @endisset>
                                                    {{ $duration->value ?? '' }}
                                                    @if ($duration->type == 1)
                                                        Day
                                                    @elseif($duration->type == 2)
                                                        Week
                                                    @elseif($duration->type == 3)
                                                        Month
                                                    @elseif($duration->type == 4)
                                                        Year
                                                    @else
                                                        Not Found
                                                    @endif
                                                </option>
                                            @endforeach
                                            @endif
                                    </select>
                                    <span class="text-danger">
                                        @error('subscription_package_duration_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="price" class="col-form-label">price *</label>
                                    <input type="text" class="form-control" name="price" id="price"
                                        value="{{ $subscription_package->price ?? '' }}" placeholder="Enter Price"
                                        required>
                                    <span class="text-danger">
                                        @error('price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="discount_amount" class="col-form-label">discount amount</label>
                                    <input type="number" class="form-control" name="discount_amount" id="discount_amount"
                                        value="{{ $subscription_package->discount_amount ?? '' }}"
                                        placeholder="Enter Discount Amount">
                                    <span class="text-danger">
                                        @error('discount_amount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="short_description" class="col-form-label">Short Desciption *</label>
                                    <textarea name="short_description" id="" cols="15" rows="2" class="form-control ck_editor"
                                        placeholder="Enter Short Desciption" required>{{ $subscription_package->short_description ?? '' }}</textarea>
                                    <span class="text-danger">
                                        @error('short_description')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="description" class="col-form-label">Desciption *</label>
                                    <textarea name="description" id="" cols="15" rows="2" class="form-control ck_editor"
                                        placeholder="Enter Desciption" required>{{ $subscription_package->description ?? '' }}</textarea>
                                    <span class="text-danger">
                                        @error('description')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="role_id" class="col-form-label">role id *</label>
                                    <select name="role_id" class="form-control chosen" required>
                                        <option value="">Select User Role</option>
                                        @if (isset($roles) && count($roles) > 0)
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    @isset($subscription_package) {{ $role->id == $subscription_package->role_id ? 'selected' : '' }} @endisset>
                                                    {{ $role->name ?? '' }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger">
                                        @error('role_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="status" class="col-form-label">Status *</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="1"
                                            @isset($subscription_package->status) {{ $subscription_package->status == 1 ? 'selected' : '' }} @endisset>
                                            Active
                                        </option>
                                        <option value="0"
                                            @isset($subscription_package->status) {{ $subscription_package->status != 1 ? 'selected' : '' }} @endisset>
                                            Inactive</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('status')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

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

    <style>
        .cke_notifications_area {
            display: none;
        }
    </style>
@endsection



@push('js')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    @include('saas-platform.js/ckeditor-adapters-jquery')
    @include('saas-platform.js/stand-alone-button-js')
    @include('saas-platform.js/stand-alone-button-multiple-js')

    <script>
        var route_prefix = "";
        $('#lfm').filemanager('image', {
            prefix: route_prefix
        });

        // $(".select2").select2();

        var options = {
            filebrowserImageBrowseUrl: '/filemanager?type=Images',
            filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '/filemanager?type=Files',
            filebrowserUploadUrl: '/filemanager/upload?type=Files&_token={{ csrf_token() }}'
        };
        $('textarea.ck_editor').ckeditor(options);
    </script>
@endpush
