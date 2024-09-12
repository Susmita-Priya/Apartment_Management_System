@extends('master')
@section('content')
    @php
        if (!empty($account->id)) {
            $route = route('account.update', $account->id);
            $page_title_prefix = 'Update';
        } else {
            $route = route('account.store');
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
                    <div class="page-title-box">
                        <h4 class="page-title float-left">{{ $page_title }}</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ url('/index') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $page_title }}</a></li>
                            <li class="breadcrumb-item active">{{ $page_title_prefix }} {{ $page_title }}</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            

            <!-- end row -->
            <div class="row">
                <div class="col-md-2"><a href="{{ route('account.index') }}" class="btn btn-success"><i class="fa fa-list"></i> Go To {{ $page_title }} List</a></div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <form action="{{ $route }}" enctype="multipart/form-data" method="POST">
                        @if (!empty($account->id))
                            @method('PUT')
                        @endif

                        @csrf

                        <div class="card-box">
                            <h1 class="d-flex justify-content-center mt-4">{{ $page_title_prefix }} {{ $page_title }}</h1>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="account_no" class="col-form-label">Account Number *</label>
                                    <input type="text" class="form-control" name="account_no" id="account_no"
                                        value="{{ $account->account_no ?? '' }}" required>
                                    <span class="text-danger">
                                        @error('account_no')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="account_title" class="col-form-label">Account Title *</label>
                                    <input type="text" class="form-control" name="account_title" id="account_title"
                                        value="{{ $account->account_title ?? '' }}" required>
                                    <span class="text-danger">
                                        @error('account_title')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="remarks" class="col-form-label">Remarks</label>
                                    <input type="text" class="form-control" name="remarks" id="remarks"
                                        value="{{ $account->remarks ?? '' }}">
                                    <span class="text-danger">
                                        @error('remarks')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="opening_balance" class="col-form-label">opening balance</label>
                                    <input type="text" class="form-control" name="opening_balance" id="opening_balance"
                                        value="{{ $account->opening_balance ?? '' }}">
                                    <span class="text-danger">
                                        @error('opening_balance')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="status" class="col-form-label">Status *</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="1"
                                            @isset($account->status) {{ $account->status == 1 ? 'selected' : '' }} @endisset>
                                            Active
                                        </option>
                                        <option value="0"
                                            @isset($account->status) {{ $account->status != 1 ? 'selected' : '' }} @endisset>
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
