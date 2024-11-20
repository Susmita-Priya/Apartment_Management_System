@extends('master')

@section('content')
    @push('title')
        <title>Edit Role</title>
    @endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Roles</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ url('/index') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/role') }}">Roles</a></li>
                            <li class="breadcrumb-item active">Edit Role</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-md-12">

                    <form action = "{{ url('/role/edit/' . $role->id) }}" enctype="multipart/form-data" method = "POST">
                        @csrf
                        <div class="col-md-12">
                            <div class="card-box">
                                <h1 class="d-flex justify-content-center mt-4">EDIT ROLE</h1>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name" class="col-form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ $role->name }}">
                                        <span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="permission" class="col-form-label h5">Permissions</label>

                                
                                        <div class="row"> <!-- Close the previous row and start a new row -->
                                     

                                            <div class="col-md-4">
                                                
                                                <ul class="list-none"> <!-- Remove bullet points -->
                                                    @foreach ($permissions as $permission)
                                                        <li>
                                                            <label class="h6"> <!-- Apply larger text size -->
                                                                <input type="checkbox" name="permissions[]"
                                                                    value="{{ $permission->id }}"
                                                                    {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                                {{ $permission->name }}
                                                                {{-- - {{ $permission->slug }} --}}
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                            
                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{-- <button type="submit" class="btn btn-primary">ADD</button> --}}
                            <button type="submit" class="btn waves-effect waves-light btn-sm" id="sa-success-updateuser"
                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
                                Update
                            </button>


                        </div>

                </form>

            </div>
        </div>
        <!-- end row -->

    </div> <!-- container -->

    </div> <!-- content -->

    </div>
@endsection
