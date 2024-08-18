@extends('master')

@push('title')
    <title>User Info</title>
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">User Information</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ url('/index') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/user') }}">Users</a></li>
                        <li class="breadcrumb-item active">User Information</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <!-- User Information -->
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <h4 class="header-title mt-0 m-b-20">User: {{ $user->name }}</h4>
                    <hr/>
                    <h5>Email:</h5>
                    <p>{{ $user->email }}</p>

                    <h5>Role:</h5>
                    <p>{{ $user->role->name }}</p>
                    
                    <h5>Permissions:</h5>
                    <ul>
                        @forelse($user->role->permissions as $permission)
                            <li>{{ $permission->name }}</li>
                        @empty
                            <li>No permissions assigned to this role.</li>
                        @endforelse
                    </ul>
                    <hr/>
                    <a href="{{ url('/user') }}" class="btn waves-effect waves-light btn-sm" 
                           style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                                   text-decoration: none;">Back to Users</a>
                </div>
            </div>
        </div>

    </div> <!-- container -->
</div> <!-- content -->
@endsection
