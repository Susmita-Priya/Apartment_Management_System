@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Assign Vehicle and Parker</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title">Stall No: Stall-{{ $stall->stall_locker_no }}</h4>

                        <form action="{{ route('parking.store', $stall->id) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="vehicle_no">Select Vehicle</label>
                                <select name="vehicle_no" class="form-control">
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_no }} ({{ $vehicle->vehicle_name }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="parker_no">Select Parker</label>
                                <select name="parker_no" class="form-control">
                                    @foreach ($parkers as $parker)
                                        <option value="{{ $parker->id }}">{{ $parker->parker_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Assign</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
