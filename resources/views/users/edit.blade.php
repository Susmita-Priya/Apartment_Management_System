@extends('master')


@push('title')
    <title>User Management!</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">User Management!</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- end row -->
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="card-box">
                                <h1 class="d-flex justify-content-center mt-4">Edit User</h1>

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
                                        <input type="email" class="form-control" name="email" id="email"
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
                                        <label for="password" class="col-form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                        (Do you want to change password then add otherwise leave this field)
                                        <span class="text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="confirm-password" class="col-form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm-password"
                                            id="confirm-password" placeholder="Confirm Password">
                                            (Do you want to change password then add otherwise leave this field)
                                        <span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="roles" class="form-label">Roles </label>
                                        <select name="roles[]" class="form-control" multiple="multiple">
                                            @foreach ($roles as $value => $label)
                                                <option value="{{ $value }}" {{ isset($userRole[$value]) ? 'selected' : ''}}>
                                                    {{ $label }}
                                                </option>
                                             @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">
                                    Save
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection


