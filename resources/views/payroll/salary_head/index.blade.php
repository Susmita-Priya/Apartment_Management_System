@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left text-capitalize">{{ $page_title }}</h4>

                        <ol class="breadcrumb float-right text-capitalize">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $page_title }}</a></li>
                            <li class="breadcrumb-item active">{{ $page_title }} list</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div style="display:flex; justify-content:space-between;margin:0 14px; ">
                            <h4 class="header-title m-b-15 m-t-0">{{ $page_title }} List</h4>
                            <h4 class="header-title m-b-15 m-t-0">
                                <a href="{{ route('salary_head.create') }}" class="btn btn-success">Add data</a>
                            </h4>
                        </div>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap table-bordered"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr class="text-capitalize">
                                    <th>SL</th>
                                    <th>name</th>
                                    <th>Head Type</th>
                                    <th>Description</th>
                                    <th>status</th>
                                    <th class="hidden-sm">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (!empty($salary_heads))
                                    @foreach ($salary_heads as $key => $salary_head)
                                        <tr>
                                            <td scope="row">{{ ++$key }}</td>
                                            <td>{{ $salary_head->name ?? '' }}</td>

                                            <td class="{{ $salary_head->head_type == 2 ? 'text-primary' : '' }}">
                                                {{ $salary_head->head_type == 1 ? 'Addition' : 'Deduction' }}
                                            </td>


                                            <td>{{ $salary_head->remarks ?? '' }}</td>
                                            <td class="{{ $salary_head->status != 1 ? 'text-danger' : '' }}">
                                                {{ $salary_head->status == 1 ? 'Active' : 'Inactive' }}
                                            </td>
                                            <td>
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                        {{-- <a class="dropdown-item "
                                                            href="{{ route('salary_head.show', ['id' => $salary_head->id]) }}"
                                                            type="submit"><i
                                                                class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>
                                                            View
                                                        </a> --}}

                                                        <a class="dropdown-item "
                                                            href="{{ route('salary_head.edit', $salary_head->id) }}"
                                                            type="submit"><i
                                                                class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('salary_head.delete', $salary_head->id) }}"
                                                            onclick="return confirm('Are you sure to delete it ?')">
                                                            <i
                                                                class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
