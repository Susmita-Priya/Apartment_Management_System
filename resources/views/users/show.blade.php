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
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                            <li class="breadcrumb-item active">User Information</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- user Information -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mt-0 m-b-20">User:  {{ $user->name }}</h4>
                        <h4 class="header-title mt-0 m-b-20">Email:  {{ $user->email }}</h4>
                        <hr />
                        <h4>Roles:</h5>
                        <ul>
                            @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <li><label >{{ $v }}</label></li>
                            @endforeach
                            @endif
                        </ul>
                        <hr />
                        <a href="{{ route('roles.index') }}" class="btn waves-effect waves-light btn-sm"
                            style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                            text-decoration: none;">Back
                        </a>
                    </div>
                </div>
            </div>

        </div> <!-- container -->
    </div> <!-- content -->
@endsection






