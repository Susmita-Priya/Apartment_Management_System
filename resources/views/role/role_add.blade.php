@extends('master')

@section('content')
@push('title')
    <title>Add Role</title>
@endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Roles</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{url('/index') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/role') }}">Roles</a></li>
                            <li class="breadcrumb-item active">Add Role</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-md-12">

         <form action = "{{url('/')}}/role/create" enctype= "multipart/form-data" method = "POST">   
            @csrf
          <div class="col-md-12">
    <div class="card-box">
        <h1 class="d-flex justify-content-center mt-4">ADD ROLE</h1>
        
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="name" class="col-form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Role Name">
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
@php
            $groupCounter = 0; // Counter to track groups
        @endphp

        <div class="row">
            @foreach ($permissions as $groupby => $permissionGroup)
                @if ($groupCounter % 3 == 0 && $groupCounter > 0)
                    </div><div class="row"> <!-- Close the previous row and start a new row -->
                @endif

                <div class="col-md-4">
                    <h4>{{ $groupby }}</h4> <!-- This displays the groupby value -->
                    <ul>
                        @foreach ($permissionGroup as $permission)
                            <li>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                    {{ $permission->name }}
                                    {{-- - {{ $permission->slug }} --}}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @php
                    $groupCounter++; // Increment the group counter
                @endphp
            @endforeach
        </div>
    </div>
</div>

        
        {{-- <button type="submit" class="btn btn-primary">ADD</button> --}}
        {{-- <button type="submit" class="btn btn-primary waves-effect waves-light btn-sm" id="sa-success-adduser">ADD</button> --}}
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