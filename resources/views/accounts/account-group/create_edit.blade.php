@extends('master')
@section('content')
    @php
        if (!empty($account_group->id)) {
            $route = route('account-group.update', $account_group->id);
            $page_title_prefix = 'Update';
        } else {
            $route = route('account-group.store');
            $page_title_prefix = 'Create';
        }
    @endphp
<style>
    label{
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
                <div class="col-md-2"><a href="{{ route('account-group.index') }}" class="btn btn-success"><i class="fa fa-list"></i> Go To {{ $page_title }} List</a></div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <form action="{{ $route }}" enctype="multipart/form-data" method="POST">
                        @if (!empty($account_group->id))
                            @method('PUT')
                        @endif

                        @csrf

                        <div class="card-box">
                            <h1 class="d-flex justify-content-center mt-4">{{ $page_title_prefix }} {{ $page_title }}</h1>

                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label for="name" class="col-form-label">Name *</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $account_group->name ?? '' }}" required>
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="group_type" class="col-form-label">Group Type *</label>
                                    <select class="form-control" name="group_type" id="group_type" required>
                                        <option value="1"
                                            @isset($account_group->group_type) {{ $account_group->group_type == 1 ? 'selected' : '' }} @endisset>
                                            Debit
                                        </option>
                                        <option value="2"
                                            @isset($account_group->group_type) {{ $account_group->group_type == 2 ? 'selected' : '' }} @endisset>
                                            Credit
                                        </option>
                                    </select>
                                    <span class="text-danger">
                                        @error('group_type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="remarks" class="col-form-label">Remarks</label>
                                    <input type="text" class="form-control" name="remarks" id="remarks"
                                        value="{{ $account_group->remarks ?? '' }}">
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
                                            @isset($account_group->status) {{ $account_group->status == 1 ? 'selected' : '' }} @endisset>
                                            Active
                                        </option>
                                        <option value="0"
                                            @isset($account_group->status) {{ $account_group->status != 1 ? 'selected' : '' }} @endisset>
                                            Inactive</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('status')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

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
