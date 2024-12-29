@extends('master')

@push('title')
    <title>Rejected Building List</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Rejected Building</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Admin</a></li>
                            <li class="breadcrumb-item active">Rejected Building List</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title m-b-15 m-t-0">Rejected Building List</h4>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                   <th>Image</th>
                                    <th>Building</th>
                                   
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp

                                @foreach ($buildings as $building)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            <img src="{{ asset($building->image) }}" alt="{{ $building->name }}" style="width: 80px; height: auto;">
                                        </td>
                                        <td>{{ $building->name }} ({{ $building->building_no }}) 

                                            <br>
                                            @if ($building->type == 'COMB')
                                                Commercial Building
                                            @elseif ($building->type == 'RESB')
                                                Residential Building
                                            @elseif ($building->type == 'RECB')
                                                Residential-Commercial Building
                                            @else
                                                {{ $building->type }}
                                            @endif
                                        </td>
                                       
                                        <td>{{ $building->note }}</td>
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
