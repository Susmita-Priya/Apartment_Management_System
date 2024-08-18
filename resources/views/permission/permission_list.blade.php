@extends('master')

@push('title')
    <title>Permissions</title>
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
                    <h4 class="page-title float-left">Permissions</h4>
                    
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{url('/index') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/permission') }}">Permissions</a></li>
                        <li class="breadcrumb-item active">Permission list</li>
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
                        Permissions List
                        <a href="{{ route('permission.create') }}" class="btn waves-effect waves-light btn-sm" 
                           style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                                  position: absolute; right: 10px; top: 50%; transform: translateY(-50%);  text-decoration: none;">
                            ADD PERMISSION
                        </a>
                    </h4>
                    
                <hr>
{{-- 
                    <div class="text-center m-b-30">
                        <div class="row">
                            <div class="col-xs-6 col-sm-4">
                                <div class="m-t-20 m-b-20">
                                
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-4">
                                <div class="m-t-20 m-b-20">
                                    
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-4">
                                <div class="m-t-20 m-b-20">
                                      
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <table style="margin-top: 20px;" class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap" cellspacing="0" width="100%" id="datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Permission</th>
                            <th>Slug</th>
                            <th>Group</th>
                            <th class="hidden-sm">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        
                            @foreach ($permissions as $permission)  
                        <tr>
                            <td scope="row">{{ $permission -> id }}</td>
                            <td>{{ $permission -> name }}</td>
                            <td>{{ $permission -> slug }}</td>
                            <td>{{ $permission -> groupby }}</td>
                            <td><div class="btn-group dropdown">
                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                    {{-- <a class="dropdown-item " href="{{ route('role.show',['id'=> $role->id]) }}" type="submit"><i class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>Full Information</a>           --}}
                                    <a class="dropdown-item " href="{{ route('permission.edit',['id'=> $permission->id]) }}" type="submit"><i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit Permission</a>
                                    <a class="dropdown-item " href="{{ route('permission.delete',['id'=> $permission->id]) }}" type="submit"><i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Delete Permission</a>                                  
                                </div>
                            </div>
                        </td>
                        @endforeach

                        </tr>  

                        </tbody>
                    </table>
                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->

@endsection
