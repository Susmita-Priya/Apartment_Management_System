@extends('master')
@section('content')
    @php
        if (!empty($bank_transaction_type->id)) {
            $route = route('bank_transaction_type.update', $bank_transaction_type->id);
            $page_title_prefix = 'Update';
        } else {
            $route = route('bank_transaction_type.store');
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
                <div class="col-md-2"><a href="{{ route('bank_transaction_type.index') }}" class="btn btn-success text-capitalize"><i class="fa fa-list"></i> Go To {{ $page_title }} List</a></div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <form action="{{ $route }}" enctype="multipart/form-data" method="POST">
                        @if (!empty($bank_transaction_type->id))
                            @method('PUT')
                        @endif

                        @csrf

                        <div class="card-box">
                            <h4 class="d-flex justify-content-center mt-4 text-capitalize">{{ $page_title_prefix }} {{ $page_title }}</h4>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name" class="col-form-label">name *</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $bank_transaction_type->name ?? '' }}" required>
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label for="remarks" class="col-form-label">Remarks</label>
                                    <input type="text" class="form-control" name="remarks" id="remarks"
                                        value="{{ $bank_transaction_type->remarks ?? '' }}">
                                    <span class="text-danger">
                                        @error('remarks')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="type" class="col-form-label">type *</label>
                                    <select class="form-control" name="type" id="type" required>
                                        <option value="1"
                                            @isset($bank_transaction_type->type) {{ $bank_transaction_type->type == 1 ? 'selected' : '' }} @endisset>
                                            Debit
                                        </option>
                                        <option value="2"
                                            @isset($bank_transaction_type->type) {{ $bank_transaction_type->type == 2 ? 'selected' : '' }} @endisset>
                                            Credit</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="status" class="col-form-label">Status *</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="1"
                                            @isset($bank_transaction_type->status) {{ $bank_transaction_type->status == 1 ? 'selected' : '' }} @endisset>
                                            Active
                                        </option>
                                        <option value="0"
                                            @isset($bank_transaction_type->status) {{ $bank_transaction_type->status != 1 ? 'selected' : '' }} @endisset>
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

    </div>
@endsection
