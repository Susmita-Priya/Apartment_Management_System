@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Stalls</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title">List of Stalls/Lockers</h4>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Stall No</th>
                                    <th>Type</th>
                                    <th>Vehicles</th>
                                    <th>Parkers</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stalls as $stall)
                                    <tr>
                                        <td>Stall-{{ $stall->stall_locker_no }}</td>
                                        <td>{{ $stall->type }}</td>
                                        <td>
                                            @if ($stall->vehicles->isNotEmpty())
                                                <ul>
                                                    @foreach ($stall->vehicles as $vehicle)
                                                        <li>{{ $vehicle->vehicle_no }} ({{ $vehicle->vehicle_name }})</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span>No vehicles assigned</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($stall->parkers->isNotEmpty())
                                                <ul>
                                                    @foreach ($stall->parkers as $parker)
                                                        <li>{{ $parker->parker_name }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span>No parkers assigned</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('parking.create', $stall->id) }}"
                                               class="btn btn-sm btn-primary">Assign Vehicle / Parker</a>
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
