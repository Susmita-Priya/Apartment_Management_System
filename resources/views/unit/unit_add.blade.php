@extends('master')

@section('content')
@push('title')
    <title>Add Unit/Suite</title>
@endpush

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Add Unit/Suite</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('block.show', $block->id) }}">Block</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('floor.show', $floor->id) }}">Floor</a></li>
                        <li class="breadcrumb-item active">Add Unit/Suite</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <form action="{{ route('unit.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" name="floor_id" value="{{ $floor->id }}">
                        
                        <div class="form-group">
                            <label for="unit_no">Unit/Suite NO</label>
                            <input type="text" name="unit_no" id="unit_no" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="type">Unit/Suite Type</label>
                            <select name="type" id="type" class="form-control" required>

                                @if($floor->residential_suite)
                                    <option value="Residential Suite">Residential Suite</option>
                                @endif

                                @if($floor->commercial_unit)
                                    <option value="Commercial Unit">Commercial Unit</option>
                                @endif

                                @if($floor->supporting_service_room)
                                    <option value="Supporting and Servicing Unit">Supporting & Service Unit</option>
                                @endif

                                @if($floor->parking_lot)
                                    <option value="Parking Lot">Parking Lot</option>
                                @endif

                                @if($floor->bike_lot)
                                    <option value="Bike Lot">Bike Lot</option>
                                @endif

                                @if($floor->storage_lot)
                                    <option value="Storage Lot">Storage Lot</option>
                                @endif

                                @if($floor->common_area)
                                    <option value="Common Area">Common Area</option>
                                @endif
                            </select>
                        </div>

                        <button type="submit" class="btn waves-effect waves-light btn-sm" style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
                            Add Unit/Suite</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

