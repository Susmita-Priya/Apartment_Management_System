@extends('master')


@push('title')
    <title>User Management!</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">User Management!</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item active">User Management!</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">User Management!</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">

                                    @can('user-create')
                                        <button type="button" class="btn waves-effect waves-light greenbtn"
                                            onclick="window.location.href='{{ route('users.create') }}'">
                                            <i class="mdi mdi-plus m-r-5"></i> Create New User
                                        </button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <table class="table table-hover m-0 table-actions-bar dt-responsive nowrap" cellspacing="0"
                            width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th class="hidden-sm">Action</th>
                                </tr>
                            </thead>

                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $v)
                                            <label class="badge bg-success">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                        <div class="btn-group dropdown">
                                            <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false"><i
                                                    class="mdi mdi-dots-horizontal"></i></a>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                @can('user-list')
                                                    <a class="dropdown-item" href="{{ route('users.show', $user->id) }}"><i
                                                            class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>Show
                                                        Details</a>
                                                @endcan
                                                @can('user-edit')
                                                    <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}"><i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                        Role</a>
                                                @endcan

                                                @can('user-delete')
                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete('{{ route('users.destroy', $user->id) }}')"><i
                                                            class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Delete
                                                    </a>
                                                    <!-- Hidden form for deletion -->
                                                    <form id="delete-form" action="{{ route('users.destroy', $user->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endcan

                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection


