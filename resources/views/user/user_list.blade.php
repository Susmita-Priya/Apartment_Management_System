@extends('master')

@push('title')
    <title>Users</title>
@endpush

@section('content')

@if(session('success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('update'))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session('update') }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('delete'))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session('delete') }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif 

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Users</h4>
                    
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{url('/index') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/user') }}">Users</a></li>
                        <li class="breadcrumb-item active">Users list</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="header-title m-b-15 m-t-0" style="position: relative;">
                        Users List
                        <a href="{{ route('user.create') }}" class="btn waves-effect waves-light btn-sm" 
                           style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                                  position: absolute; right: 10px; top: 50%; transform: translateY(-50%);  text-decoration: none;">
                            ADD USER
                        </a>
                    </h4>
                    
                <hr>

                    <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap" cellspacing="0" width="100%" id="datatable">
                        <thead>
                        <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge badge-success">{{ $user->role->name }}</span>
                                </td>
                                <td><div class="btn-group dropdown">
                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        
                                        <a class="dropdown-item " href="{{ route('user.show',['id'=> $user->id]) }}" type="submit"><i class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>Full Information</a>          
                                        <a class="dropdown-item " href="{{ route('user.edit',['id'=> $user->id]) }}" type="submit"><i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit User</a>
                                        <a class="dropdown-item" href="{{ route('user.delete',['id'=> $user->id]) }}" type="submit"><i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Delete User</a>                                  
                                    </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
