@extends('master')

@section('content')
    @push('title')
        <title>Edit User</title>
    @endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Users</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ url('/index') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/user') }}">Users</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-md-12">

                    <form action = "{{ url('/user/edit/' . $user->id) }}" enctype="multipart/form-data" method = "POST">
                        @csrf
                        <div class="col-md-12">
                            <div class="card-box">
                                <h1 class="d-flex justify-content-center mt-4">EDIT USER</h1>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name" class="col-form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ $user->name }}">
                                        <span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="email" class="col-form-label">Email</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            value="{{ $user->email }}">
                                        <span class="text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="password" class="col-form-label">password</label>
                                        <input class="form-control" name="password" type="password" id="password">
                                        (Do you want to change password then add otherwise leave this field)
                                        <span class="text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="role_id">Role</label>
                                    <select class="form-control" id="role_id" name="role_id" required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ $role->id == $user->role_id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn waves-effect waves-light btn-sm"
                                    id="sa-success-updateuser"
                                    style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
                                    Update Users Details
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
