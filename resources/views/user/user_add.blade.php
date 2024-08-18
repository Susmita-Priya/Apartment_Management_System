@extends('master')

@section('content')
@push('title')
    <title>Add User</title>
@endpush

<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Users</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{url('/index') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/user') }}">Users</a></li>
                        <li class="breadcrumb-item active">Add User</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-md-12">

     <form action = "{{url('/')}}/user/create" enctype= "multipart/form-data" method = "POST">   
        @csrf
      <div class="col-md-12">
<div class="card-box">
    <h1 class="d-flex justify-content-center mt-4">ADD USER</h1>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="name" class="col-form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter User Name">
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
            <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email">
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
            <input class="form-control" name="password" type="password" required="" id="password" placeholder="Enter password">
            <span class="text-danger">
                @error('password')
                    {{ $message }}
                @enderror
            </span>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="role_id">Role</label>
                <select class="form-control" id="role_id" name="role_id" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
        </div>
    </div>

    <button type="submit" class="btn waves-effect waves-light btn-sm" style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
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
