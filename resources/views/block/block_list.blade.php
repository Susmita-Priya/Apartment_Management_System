@extends('master')

@push('title')
    <title>Blocks List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Blocks List</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ url('/index') }}">Admin</a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Blocks</a></li> --}}
                            <li class="breadcrumb-item active">Blocks List</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Blocks List</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('block.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Block
                                    </button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-hover m-0 table-actions-bar dt-responsive nowrap" cellspacing="0"
                            width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Block ID</th>
                                    <th>Block Name</th>
                                    <th>Building Name</th>
                                    <th>Building ID</th>
                                    <th>Building Type</th>
                                    {{-- <th>Building Status</th> --}}
                                    <th class="hidden-sm">Action</th>
                                </tr>
                            </thead>
                            @php
                                $typeFullForm = [
                                    'RESB' => 'Residential',
                                    'COMB' => 'Commercial',
                                    'RECB' => 'Residential-Commercial',
                                ];
                            @endphp
                            <tbody>
                                @foreach ($blocks as $block)
                                    <tr>
                                        <td scope="row">{{ $block->block_id }}</td>
                                        <td>{{ $block->name }}</td>
                                        <td>{{ $block->building->name }}</td>
                                        <td>{{ $block->building->building_id }}</td>
                                        <td>{{ $typeFullForm[$block->building->type] ?? 'Other' }}</td>
                                        {{-- <td>{{ $block->building->status }}</td> --}}
                                        <td>
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item"
                                                        href="{{ route('block.show', ['id' => $block->id]) }}"><i
                                                            class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>View
                                                        Details</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('block.edit', ['id' => $block->id]) }}"><i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                        Block</a>

                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete('{{ route('block.delete', ['id' => $block->id]) }}')"><i
                                                            class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Delete
                                                    </a>
                                                    <!-- Hidden form for deletion -->
                                                    <form id="delete-form"
                                                        action="{{ route('block.delete', ['id' => $block->id]) }}"
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
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
