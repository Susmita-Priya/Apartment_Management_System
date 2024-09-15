{{-- @extends('master')

@section('content')
    @push('title')
        <title>Add Asset</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Asset</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('building.show', $room->unit->floor->block->building_id) }}">Building</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('block.show', $room->unit->floor->block_id) }}">Block</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.show', $room->unit->floor_id) }}">Floor</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('unit.show', $room->unit_id) }}">Unit</a></li>
                            <li class="breadcrumb-item"><a href="{{ route($room_type. '.show',['id' => $room->id, 'room_type' => $room_type]) }}">Room</a></li>
                            <li class="breadcrumb-item active">Add Asset</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- Asset Form -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title">Asset Information</h4>

                        <form action="{{ route('asset.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="room_no" value="{{ $room->id }}">
                            <input type="hidden" name="room_type" value="{{ $room_type }}">

                            <!-- Room Section (appears only once) -->
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="room_id">Room</label>
                                    <select name="room_id" class="form-control" required>
                                        @for ($i = 1; $i <= $count; $i++)
                                            @php
                                                $roomId = $room_type . $i;
                                            @endphp
                                            <option value="{{ $roomId }}">{{ $roomId }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Dynamic Asset Inputs -->
                            <div id="asset-list" class="mt-3">
                                <div class="row asset-item">
                                    <div class="col-md-5">
                                        <label for="asset_name">Asset Name</label>
                                        <input type="text" name="assets[0][name]" class="form-control"
                                            placeholder="Enter Asset Name" required>
                                    </div>

                                    <div class="col-md-5">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" name="assets[0][quantity]" class="form-control"
                                            placeholder="Enter Quantity" required>
                                    </div>

                                    <div class="col-md-2 text-right">
                                        <button type="button" class="btn btn-danger remove-asset mt-4">Remove</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Button to Add More Assets -->
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="button" id="add-asset" class="btn btn-success">Add Another Asset</button>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row mt-4">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">Save Assets</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript for Dynamic Asset Addition -->
    <script>
        let assetIndex = 1;

        document.getElementById('add-asset').addEventListener('click', function() {
            const assetList = document.getElementById('asset-list');

            const newAsset = `
                <div class="row asset-item">
                    <div class="col-md-5">
                        <label for="asset_name">Asset Name</label>
                        <input type="text" name="assets[${assetIndex}][name]" class="form-control" placeholder="Enter Asset Name" required>
                    </div>
                    
                    <div class="col-md-5">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="assets[${assetIndex}][quantity]" class="form-control" placeholder="Enter Quantity" required>
                    </div>
                    
                    <div class="col-md-2 text-right">
                        <button type="button" class="btn btn-danger remove-asset mt-4">Remove</button>
                    </div>
                </div>
            `;

            assetList.insertAdjacentHTML('beforeend', newAsset);
            assetIndex++;
        });

        // document.addEventListener('click', function(e) {
        //     if (e.target.classList.contains('remove-asset')) {
        //         e.target.closest('.asset-item').remove();
        //     }
        // });
    </script>
@endsection --}}




@extends('master')

@section('content')
    @push('title')
        <title>Add Asset</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Asset</h4>
                        {{-- <p> {{ $room }} --}}
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('building.show', $roominstance->unit->floor->block->building_id) }}">Building</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('block.show', $roominstance->unit->floor->block_id) }}">Block</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.show', $roominstance->unit->floor_id) }}">Floor</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('unit.show',['id' => $roominstance->unit->id] ) }}">Unit</a></li>
                            <li class="breadcrumb-item"><a href="{{ route($room . '.show', ['id' => $roomId, 'room_type' => $roomType]) }}">Room</a></li>  
                            <li class="breadcrumb-item active">Add Asset</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- Asset Form -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title">Asset Information</h4>

                        <form action="{{ route('asset.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="room_id" value="{{ $roomId }}">
                            <input type="hidden" name="room_type" value="{{ $roomType }}">
                            <input type="hidden" name="room" value="{{ $room }}">

                            <!-- Room Section (appears only once) -->
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="room_no">Room</label>
                                    <select name="room_no" class="form-control" required>

                                        @php
                                            // Set a maximum limit to prevent memory issues
                                            $maxCount = min($count, 100); // You can adjust 100 to the desired max limit
                                        @endphp

                                        @for ($i = 1; $i <= $count; $i++)
                                            @php
                                                $room = $roomType . $i;
                                            @endphp
                                            <option value="{{ $room }}">{{ $room }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Dynamic Asset Inputs -->
                            <div id="asset-list" class="mt-3">
                                <div class="row asset-item">
                                    <div class="col-md-5">
                                        <label for="asset_name">Asset Name</label>
                                        <input type="text" name="assets[0][name]" class="form-control"
                                            placeholder="Enter Asset Name" required>
                                    </div>

                                    <div class="col-md-5">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" name="assets[0][quantity]" class="form-control"
                                            placeholder="Enter Quantity" required>
                                    </div>

                                    <div class="col-md-2 text-right">
                                        <button type="button" class="btn btn-danger remove-asset mt-4">Remove</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Button to Add More Assets -->
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="button" id="add-asset" class="btn btn-success">Add Another Asset</button>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row mt-4">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">Save Assets</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript for Dynamic Asset Addition -->
    <script>
        let assetIndex = 1;

        document.getElementById('add-asset').addEventListener('click', function() {
            const assetList = document.getElementById('asset-list');

            const newAsset = `
                <div class="row asset-item">
                    <div class="col-md-5">
                        <label for="asset_name">Asset Name</label>
                        <input type="text" name="assets[${assetIndex}][name]" class="form-control" placeholder="Enter Asset Name" required>
                    </div>
                    
                    <div class="col-md-5">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="assets[${assetIndex}][quantity]" class="form-control" placeholder="Enter Quantity" required>
                    </div>
                    
                    <div class="col-md-2 text-right">
                        <button type="button" class="btn btn-danger remove-asset mt-4">Remove</button>
                    </div>
                </div>
            `;

            assetList.insertAdjacentHTML('beforeend', newAsset);
            assetIndex++;
        });

        // document.addEventListener('click', function (e) {
        //     if (e.target.classList.contains('remove-asset')) {
        //         e.target.closest('.asset-item').remove();
        //     }
        // });
    </script>
@endsection
