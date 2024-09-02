@extends('master')

@section('content')
@push('title')
    <title>Add Floor</title>
@endpush

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">Add Floor</h4>

                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('block.show', $block->id) }}">Block</a></li>
                        <li class="breadcrumb-item active">Add Floor</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <form action="{{ route('floor.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" name="block_id" value="{{ $block->id }}">
                        
                        <div class="form-group">
                            <label for="floor_no">Floor Number</label>
                            <input type="number" name="floor_no" id="floor_no" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Floor Name</label>
                            <input type="text" name="name" id="name" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label for="type">Floor Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="rooftop">Rooftop</option>
                                <option value="upper">Upper</option>
                                <option value="ground">Ground</option>
                                <option value="underground">Underground</option>
                            </select>
                        </div>

                        @if ($building->type === 'RESB')
                        <div class="form-group">
                            <label><input type="checkbox" name="residential_suite"> Residential Suite</label>
                        </div>
                        @elseif ($building->type === 'COMB')
                            <div class="form-group">
                                <label><input type="checkbox" name="commercial_unit"> Commercial Unit</label>
                            </div>
                        @elseif ($building->type === 'RECB')
                            <div class="form-group">
                                <label><input type="checkbox" name="residential_suite"> Residential Suite</label>
                            </div>
                            <div class="form-group">
                                <label><input type="checkbox" name="commercial_unit"> Commercial Unit</label>
                            </div>
                        @endif

                        <div class="form-group">
                            <label><input type="checkbox" name="supporting_service_room"> Supporting & Service Room</label>
                        </div>

                        <div class="form-group">
                            <label><input type="checkbox" name="parking_lot"> Parking Lot</label>
                        </div>

                        <div class="form-group">
                            <label><input type="checkbox" name="bike_lot"> Bike Lot</label>
                        </div>

                        <div class="form-group">
                            <label><input type="checkbox" name="storage_lot"> Storage Lot</label>
                        </div>

                        <div class="form-group">
                            <label><input type="checkbox" name="common_area"> Common Area</label>
                        </div>

                        <button type="submit" class="btn waves-effect waves-light btn-sm" style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
                            Add Floor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
