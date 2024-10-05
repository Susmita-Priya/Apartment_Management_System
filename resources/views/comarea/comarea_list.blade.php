@extends('master')

@push('title')
    <title>Common Areas List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Common Areas List</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ url('/index') }}">Admin</a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">Common Areas</a></li> --}}
                            <li class="breadcrumb-item active">Common Areas List</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Common Areas List</h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('comarea.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Common Area
                                    </button>
                                </div>
                            </div>
                        </div>
                        @php
                            $count = 1;
                        @endphp
                        
                        <table class="table table-hover m-0 table-actions-bar dt-responsive nowrap" cellspacing="0"
                            width="100%" id="datatable">
                            
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Building </th>
                                    <th>Block </th>
                                    <th>Details</th>
                                    <th class="hidden-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($commonAreas as $comarea)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $comarea->block->building->name }} </br> ID : {{ $comarea->block->building->building_id }}</td>
                                        <td>{{ $comarea->block->name }} </br> ID: {{ $comarea->block->block_id }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($comarea->getAttributes() as $key => $value)
                                                    @if ($value && in_array($key, ['firelane', 'building_entrance', 'corridors', 'driveways', 'emergency_stairways', 'garden', 'hallway', 'loading_dock', 'lobby', 'parking_entrance', 'patio', 'rooftop', 'stairways', 'walkways']))
                                                        <li>{{ ucfirst(str_replace('_', ' ', $key)) }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="mdi mdi-dots-horizontal"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item"
                                                        href="{{ route('block.show', ['id' => $comarea->block->id]) }}"><i
                                                            class="mdi mdi-eye m-r-10 font-18 text-muted vertical-middle"></i>View
                                                        Details</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('comarea.edit', ['id' => $comarea->id]) }}"><i
                                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit
                                                        Common Area</a>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete('{{ route('comarea.delete', ['id' => $comarea->id]) }}')"><i
                                                            class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                        Delete
                                                    </a>
                                                    <!-- Hidden form for deletion -->
                                                    <form id="delete-form-{{ $comarea->id }}"
                                                        action="{{ route('comarea.delete', ['id' => $comarea->id]) }}"
                                                        method="POST" style="display: none;">
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
