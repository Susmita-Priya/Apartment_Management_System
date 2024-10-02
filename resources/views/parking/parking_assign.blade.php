@extends('master')

@section('content')
@push('title')
<title>Assign Vehicle and Parker</title>
@endpush
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Assign Vehicle and Parker</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('parking.list') }}">Stalls list</a></li>
                            <li class="breadcrumb-item active">Assign</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title">Stall No: Stall-{{ $stall->stall_locker_no }}</h4>

                        <!-- Form to assign vehicles and parker -->
                        <form action="{{ route('parking.store', $stall->id) }}" method="POST">
                            @csrf

                            <!-- Assigned Vehicles and Parker Table -->
                            <h5>Assigned Vehicles</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Vehicle No</th>
                                        <th>Vehicle Name</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stall->vehicles as $vehicle)
                                        <tr>
                                            <td>{{ $vehicle->vehicle_no }}</td>
                                            <td>{{ $vehicle->vehicle_name }}</td>
                                            <td><img src="{{ asset($vehicle->vehicle_image) }}" alt="Vehicle Image"
                                                style="max-width: 100px; max-height: 100px;"></td>
                                            <td>
                                                <!-- Remove vehicle form -->
                                                <form action="{{ route('vehicle.remove', $vehicle->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="mdi mdi-delete font-18"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Assigned Parker -->
                            <h5>Assigned Parker</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Parker No</th>
                                        <th>Parker Name</th>
                                        <th>Contact No</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($stall->parkers->isNotEmpty())
                                        <tr>
                                            <td>{{ $stall->parkers->first()->parker_no }}</td>
                                            <td name="parker_no">{{ $stall->parkers->first()->parker_name }}</td>
                                            <td>{{ $stall->parkers->first()->phn }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>N/A</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <!-- Vehicles Selection (Not Assigned) -->
                            <div class="form-group">
                                <label for="vehicle_no">Select Vehicles</label>
                                <div>
                                    @foreach ($vehicles as $vehicle)
                                        @if (!$vehicle->stall_no)
                                            <div class="form-check">
                                                <input type="checkbox" name="vehicle_no[]" value="{{ $vehicle->id }}"
                                                    id="vehicle_{{ $vehicle->id }}" class="form-check-input">
                                                <label class="form-check-label" for="vehicle_{{ $vehicle->id }}">
                                                    {{ $vehicle->vehicle_no }} ({{ $vehicle->vehicle_name }})
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- Assigned Parker (If exists) -->
                            <div class="form-group">
                                @if ($stall->parkers->isNotEmpty())
                                    {{-- <label>Assigned Parker: {{ $stall->parkers->first()->parker_name }}</label>
                                    <br> --}}
                                    <label for="parker_no">Change Parker</label>
                                @else
                                    <label for="parker_no">Select Parker</label>
                                @endif

                                <!-- Parker Selection -->
                                <select name="parker_no" class="form-control">
                                    <option value="" disabled selected>Select Parker</option>
                                    @foreach ($parkers as $parker)
                                        <option value="{{ $parker->id }}">{{ $parker->parker_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <button type="submit" class="btn submitbtn">Assign</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
