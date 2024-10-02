@extends('master')

@push('title')
    <title>Users</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Users</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Users</a></li>
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

                        <table
                            class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap table-bordered"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr class="text-capitalize">
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    {{--<th>phone</th>
                                     <th>company name</th>
                                    <th>Package</th>
                                    <th>Role</th>
                                    <th>Expire Date</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        {{--<td>{{ $user->phone ?? '' }}</td>
                                         <td>{{ $user->company_name ?? '' }}</td>
                                        <td>{{ $user->subscription_package->name ?? '' }}</td> --}}
                                        <td>
                                            <span class="badge badge-success">{{ $user->role->name }}</span>
                                        </td>
                                        {{-- <td>{{ $user->expire_date ?? '' }}</td> --}}
                                        <td>
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    {{-- <a class="dropdown-item"
                                                        href="{{ route('user_subscription.add', $user->id) }}">
                                                        <i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Add Subscription
                                                    </a>

                                                    <a href="{{ route('user_subscription.view', $user->id) }}" class="dropdown-item">
                                                        <i
                                                            class="mdi mdi-eye m-r-10 text-muted font-18 vertical-middle"></i>
                                                        View Subscription
                                                    </a> --}}

                                                    <a class="dropdown-item"
                                                        href="{{ route('user.show', ['id' => $user->id]) }}">
                                                        <i
                                                            class="mdi mdi-book m-r-10 font-18 text-muted vertical-middle"></i>
                                                        Full Information
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('user.edit', ['id' => $user->id]) }}">
                                                        <i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Edit
                                                    </a>
                                                    {{-- <a class="dropdown-item"
                                                        href="{{ route('user.delete', ['id' => $user->id]) }}"
                                                        onclick="return confirm('Are you sure to delete it ?')">
                                                        <i
                                                            class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Delete
                                                    </a> --}}


                                                    <a class="dropdown-item"
                                                    href="#"
                                                        onclick="confirmDelete('{{ route('user.delete', ['id' => $user->id]) }}')"><i
                                                            class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Delete
                                                    </a>
                                                    <!-- Hidden form for deletion -->
                                                    <form id="delete-form"
                                                        action="{{ route('user.delete', ['id' => $user->id]) }}"
                                                        method="GET" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
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
