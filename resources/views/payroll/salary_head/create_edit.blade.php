@extends('master')
@section('content')
    @php
        if (!empty($salary_head->id)) {
            $route = route('salary_head.update', $salary_head->id);
            $page_title_prefix = 'Update';
        } else {
            $route = route('salary_head.store');
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
                <div class="col-md-2"><a href="{{ route('salary_head.index') }}" class="btn btn-success text-capitalize"><i
                            class="fa fa-list"></i> Go To {{ $page_title }} List</a></div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <form action="{{ $route }}" enctype="multipart/form-data" method="POST">
                        @if (!empty($salary_head->id))
                            @method('PUT')
                        @endif

                        @csrf

                        <div class="card-box">
                            <h4 class="d-flex justify-content-center mt-4 text-capitalize">{{ $page_title_prefix }}
                                {{ $page_title }}</h4>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name" class="col-form-label">name *</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $salary_head->name ?? '' }}" required>
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="head_type" class="col-form-label">head type *</label>
                                    <select class="form-control" name="head_type" id="head_type" required>
                                        <option value="1"
                                            @isset($salary_head->head_type) {{ $salary_head->head_type == 1 ? 'selected' : '' }} @endisset>
                                            Addition
                                        </option>
                                        <option value="2"
                                            @isset($salary_head->head_type) {{ $salary_head->head_type == 2 ? 'selected' : '' }} @endisset>
                                            Deduction
                                        </option>
                                    </select>
                                    <span class="text-danger">
                                        @error('head_type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="remarks" class="col-form-label">Remarks</label>
                                    <input type="text" class="form-control" name="remarks" id="remarks"
                                        value="{{ $salary_head->remarks ?? '' }}">
                                    <span class="text-danger">
                                        @error('remarks')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="status" class="col-form-label">Status *</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="1"
                                            @isset($salary_head->status) {{ $salary_head->status == 1 ? 'selected' : '' }} @endisset>
                                            Active
                                        </option>
                                        <option value="0"
                                            @isset($salary_head->status) {{ $salary_head->status != 1 ? 'selected' : '' }} @endisset>
                                            Inactive</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('status')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="emp_create_status" class="col-form-label">Show this head when adding
                                        employee *</label>
                                    <select class="form-control" name="emp_create_status" id="emp_create_status" required>
                                        <option value="1"
                                            @isset($salary_head->emp_create_status) {{ $salary_head->emp_create_status == 1 ? 'selected' : '' }} @endisset>
                                            Show
                                        </option>
                                        <option value="2"
                                            @isset($salary_head->emp_create_status) {{ $salary_head->emp_create_status == 2 ? 'selected' : '' }} @endisset>
                                            Not Show
                                        </option>
                                    </select>
                                    <span class="text-danger">
                                        @error('emp_create_status')
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

    </div>
@endsection
