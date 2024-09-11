@extends('master')

@section('content')
    @push('title')
        <title>Edit Asset</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Asset</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ url('/index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('building.show', $resroom->unit->floor->block->building_id) }}">Building</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('block.show', $resroom->unit->floor->block_id) }}">Block</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.show', $resroom->unit->floor_id) }}">Floor</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('unit.show', $resroom->unit_id) }}">Unit</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('resroom.show',['id' => $resroom->id, 'room_type' => $room_type]) }}">Room</a></li>
                            <li class="breadcrumb-item active">Edit Asset</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- Asset Edit Form -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title">Asset Information</h4>

                        <form action="{{ route('asset.update', ['id' => $asset->id, 'room_type' => $room_type]) }}" enctype="multipart/form-data" method="POST">

                            @csrf
                         
                            <input type="hidden" name="room_no" value="{{ $resroom->id }}">
                            <input type="text" name="room_no" readonly value="{{ $asset->room_id }}">

                            {{-- <!-- Room Section -->
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="room_id">Room</label>
                                    <select name="room_id" class="form-control" required>
                                        @for ($i = 1; $i <= $count; $i++)
                                            @php
                                                $roomId = $room_type . $i;
                                            @endphp
                                            <option value="{{ $roomId }}" {{ $roomId == $asset->room_id ? 'selected' : '' }}>
                                                {{ $roomId }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div> --}}

                            <!-- Dynamic Asset Inputs -->
                            <div id="asset-list" class="mt-3">
                                @foreach ($asset->assets_details as $index => $detail)
                                    <div class="row asset-item">
                                        <div class="col-md-5">
                                            <label for="asset_name">Asset Name</label>
                                            <input type="text" name="assets[{{ $index }}][name]" class="form-control"
                                                   value="{{ $detail['asset_name'] }}" required>
                                        </div>

                                        <div class="col-md-5">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" name="assets[{{ $index }}][quantity]" class="form-control"
                                                   value="{{ $detail['quantity'] }}" required>
                                        </div>

                                        <div class="col-md-2 text-right">
                                            <button type="button" class="btn btn-danger remove-asset mt-4">Remove</button>
                                        </div>
                                    </div>
                                @endforeach
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
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
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
        let assetIndex = {{ count($asset->assets_details) }};

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

        // // Removing asset row
        // document.addEventListener('click', function(e) {
        //     if (e.target.classList.contains('remove-asset')) {
        //         e.target.closest('.asset-item').remove();
        //     }
        // });
    </script>
@endsection
