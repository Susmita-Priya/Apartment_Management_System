@extends('master')

@push('title')
    <title>Tenants</title>
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
                    <h4 class="page-title float-left">Tenants</h4>
                    
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{url('/index') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="#">Tenants</a></li>
                        <li class="breadcrumb-item active">Tenants list</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="header-title m-b-15 m-t-0">Tenants List</h4>

                    <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap" cellspacing="0" width="100%" id="datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th class="hidden-sm">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        
                            @foreach ($tenants as $tenant)  
                        <tr>
                            <td scope="row">{{ $tenant -> id }}</td>
                            <td>{{ $tenant -> fullname }}</td>
                            <td>{{ $tenant -> email }}</td>
                            <td>{{ $tenant -> address }}</td>
                            <td><div class="btn-group dropdown">
                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    
                                    {{-- <a class="dropdown-item" id="view" 
                                        data-fullname="{{ $user->fullname }}" 
                                        data-email="{{ $user->email }}" 
                                        data-phn="{{ $user->phn }}" 
                                        data-idno="{{ $user->idno }}" 
                                        data-address="{{ $user->address }}" 
                                        data-occ-status="{{ $user->occ_status }}" 
                                        data-occ-place="{{ $user->occ_place }}" 
                                        data-emname="{{ $user->emname }}" 
                                        data-emphn="{{ $user->emphn }}">
                                        <i class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>Full Information
                                    </a>                          --}}

                                    <a class="dropdown-item " href="{{ route('tenants.show',['id'=> $tenant->id]) }}" type="submit"><i class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>Full Information</a>          
                                    <a class="dropdown-item " href="{{ route('tenants.edit',['id'=> $tenant->id]) }}" type="submit"><i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit Tenant</a>
                                    <a class="dropdown-item" href="{{ route('tenants.delete',['id'=> $tenant->id]) }}" type="submit"><i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Delete Tenant</a>                                  
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
