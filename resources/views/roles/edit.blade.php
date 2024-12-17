@extends('master')


@push('title')
    <title>Role Management!</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Role Management!</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                            <li class="breadcrumb-item active">Edit Role</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- end row -->
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="card-box">
                                <h1 class="d-flex justify-content-center mt-4">Edit Role</h1>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name" class="col-form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ $role->name }}" 
                                            placeholder="Enter Role Name">
                                        <span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name" class="col-form-label">Permission : </label>
                                        <br />
                                        @foreach ($permission as $value)
                                            <label><input type="checkbox" name="permission[{{ $value->id }}]"
                                                    value="{{ $value->id }}" class="name"
                                                    {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                                {{ $value->name }}</label>
                                            <br />
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection


