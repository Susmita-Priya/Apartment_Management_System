@extends('master')

@section('content')
    @push('title')
        <title>Add Permissions</title>
    @endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Permissions</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ url('/index') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/permission') }}">Permissions</a></li>
                            <li class="breadcrumb-item active">Add Permission</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-md-12">

                    <form action = "{{ url('/') }}/permission/create" enctype= "multipart/form-data" method = "POST">
                        @csrf
                        <div class="col-md-12">
                            <div class="card-box">
                                <h1 class="d-flex justify-content-center mt-4">ADD PERMISSION</h1>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name" class="col-form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter permission Name">
                                        <span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="slug" class="col-form-label">Slug</label>
                                        <input type="text" class="form-control" name="slug" id="slug"
                                            placeholder="Enter Slug">
                                        <span class="text-danger">
                                            @error('slug')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="groupby" class="col-form-label">Group</label>
                                        <input type="text" class="form-control" name="groupby" id="groupby"
                                            placeholder="Enter permission group">
                                        <span class="text-danger">
                                            @error('groupby')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                {{-- <button type="submit" class="btn btn-primary">ADD</button> --}}
                                {{-- <button type="submit" class="btn btn-primary waves-effect waves-light btn-sm" id="sa-success-adduser">ADD</button> --}}
                                <button type="submit" class="btn waves-effect waves-light btn-sm"
                                    style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
                                    ADD
                                </button>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    </div>
@endsection
