@extends('master')

@push('title')
    <title>Role Info</title>
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Role Information</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ url('/index') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/role') }}">Roles</a></li>
                        <li class="breadcrumb-item active">Role Information</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <!-- Role Information -->
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mt-0 m-b-20">Role: {{ $role->name }}</h4>
                    <hr/>
                    <h5>Permissions:</h5>
                    <ul>
                        @forelse($role->permissions as $permission)
                            <li>{{ $permission->name }}</li>
                        @empty
                            <li>No permissions assigned to this role.</li>
                        @endforelse
                    </ul>
                    <hr/>
                    <a href="{{ url('/role') }}" class="btn waves-effect waves-light btn-sm" 
                    style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                            text-decoration: none;">Back to Roles</a>
                </div>
            </div>
        </div>

    </div> <!-- container -->
</div> <!-- content -->
@endsection
