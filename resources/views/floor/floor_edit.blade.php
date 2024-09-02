@extends('master')

@section('content')
@push('title')
    <title>Edit Floor</title>
@endpush

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Edit Floor</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('block.show', $floor->block_id) }}">Block</a></li>
                        <li class="breadcrumb-item active">Edit Floor</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <form action="{{ route('floor.update', $floor->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        
                        <input type="hidden" name="block_id" value="{{ $floor->block_id }}">
                        
                        <div class="form-group">
                            <label for="floor_no">Floor Number</label>
                            <input type="number" name="floor_no" id="floor_no" class="form-control" value="{{ old('floor_no', $floor->floor_no) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Floor Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $floor->name) }}">
                        </div>

                        <div class="form-group">
                            <label for="type">Floor Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="rooftop" {{ $floor->type == 'rooftop' ? 'selected' : '' }}>Rooftop</option>
                                <option value="upper" {{ $floor->type == 'upper' ? 'selected' : '' }}>Upper</option>
                                <option value="ground" {{ $floor->type == 'ground' ? 'selected' : '' }}>Ground</option>
                                <option value="underground" {{ $floor->type == 'underground' ? 'selected' : '' }}>Underground</option>
                            </select>
                        </div>

                        @if ($building->type === 'RESB')
                            <div class="form-group">
                                <label><input type="checkbox" name="residential_suite" {{ old('residential_suite', $floor->residential_suite) ? 'checked' : '' }}> Residential Suite</label>
                            </div>
                        @elseif ($building->type === 'COMB')
                            <div class="form-group">
                                <label><input type="checkbox" name="commercial_unit" {{ old('commercial_unit', $floor->commercial_unit) ? 'checked' : '' }}> Commercial Unit</label>
                            </div>
                        @elseif ($building->type === 'RECB')
                            <div class="form-group">
                                <label><input type="checkbox" name="residential_suite" {{ old('residential_suite', $floor->residential_suite) ? 'checked' : '' }}> Residential Suite</label>
                            </div>
                            <div class="form-group">
                                <label><input type="checkbox" name="commercial_unit" {{ old('commercial_unit', $floor->commercial_unit) ? 'checked' : '' }}> Commercial Unit</label>
                            </div>
                        @endif

                        <div class="form-group">
                            <label><input type="checkbox" name="supporting_service_room" {{ old('supporting_service_room', $floor->supporting_service_room) ? 'checked' : '' }}> Supporting & Service Room</label>
                        </div>

                        <div class="form-group">
                            <label><input type="checkbox" name="parking_lot" {{ old('parking_lot', $floor->parking_lot) ? 'checked' : '' }}> Parking Lot</label>
                        </div>

                        <div class="form-group">
                            <label><input type="checkbox" name="bike_lot" {{ old('bike_lot', $floor->bike_lot) ? 'checked' : '' }}> Bike Lot</label>
                        </div>

                        <div class="form-group">
                            <label><input type="checkbox" name="storage_lot" {{ old('storage_lot', $floor->storage_lot) ? 'checked' : '' }}> Storage Lot</label>
                        </div>

                        <div class="form-group">
                            <label><input type="checkbox" name="common_area" {{ old('common_area', $floor->common_area) ? 'checked' : '' }}> Common Area</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Floor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
