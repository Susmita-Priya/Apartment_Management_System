@extends('master')

@section('content')
@push('title')
    <title>Edit Unit/Suite</title>
@endpush

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Edit Unit/Suite</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('block.show', $block->id) }}">Block</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('floor.show', $floor->id) }}">Floor</a></li>
                        <li class="breadcrumb-item active">Edit Unit/Suite</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <form action="{{ route('unit.update', $unit->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" name="floor_id" value="{{ $floor->id }}">

                        @php
                            // Correctly extract the numeric part of the unit ID after "UNIT"
                            $unitString = $unit->unit_id;
                            $position = strpos($unitString, 'UNIT');
                            if ($position !== false) {
                                $unitId = (int) substr($unitString, $position + 4);
                            } else {
                                $unitId = null; // Handle the case where "UNIT" is not found
                            }
                        @endphp

                        <div class="form-group">
                            <label for="unit_no">Unit/Suite NO</label>
                            <input type="text" name="unit_no" id="unit_no" class="form-control" value="{{ old('unit_no', $unitId) }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="type">Unit/Suite Type</label>
                            <select name="type" id="type" class="form-control" required>
                                @if($floor->residential_suite)
                                    <option value="Residential Suite" {{ old('type', $unit->type) === 'Residential Suite' ? 'selected' : '' }}>Residential Suite</option>
                                @endif

                                @if($floor->commercial_unit)
                                    <option value="Commercial Unit" {{ old('type', $unit->type) === 'Commercial Unit' ? 'selected' : '' }}>Commercial Unit</option>
                                @endif

                                @if($floor->supporting_service_room)
                                    <option value="Supporting and Servicing Unit" {{ old('type', $unit->type) === 'Supporting and Servicing Unit' ? 'selected' : '' }}>Supporting & Service Room</option>
                                @endif

                                @if($floor->parking_lot)
                                    <option value="Parking Lot" {{ old('type', $unit->type) === 'Parking Lot' ? 'selected' : '' }}>Parking Lot</option>
                                @endif

                                @if($floor->bike_lot)
                                    <option value="Bike Lot" {{ old('type', $unit->type) === 'Bike Lot' ? 'selected' : '' }}>Bike Lot</option>
                                @endif

                                @if($floor->storage_lot)
                                    <option value="Storage Lot" {{ old('type', $unit->type) === 'Storage Lot' ? 'selected' : '' }}>Storage Lot</option>
                                @endif

                                @if($floor->common_area)
                                    <option value="Common Area" {{ old('type', $unit->type) === 'Common Area' ? 'selected' : '' }}>Common Area</option>
                                @endif
                            </select>
                        </div>

                        <button type="submit" class="btn waves-effect waves-light btn-sm" style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
                            Update Unit/Suite
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
