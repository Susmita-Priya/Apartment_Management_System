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
                        <h4 class="page-title">Add Asset</h4>
                        <ol class="breadcrumb">
                            {{-- <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('unit.show', $unit->id) }}">Unit</a></li> --}}
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
                            <input type="hidden" name="room_no" value="{{ $resroom->id }}">

                            <!-- Room Section (appears only once) -->
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="room_id">Room</label>
                                    <select name="room_id" class="form-control" required>
                                        {{-- <option value="">Select Room</option>
                                        @foreach ($resrooms as $room)
                                            <option value="{{ $room->id }}">{{ $roomTypeLabel }} {{ $i }}</option>
                                        @endforeach --}}
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

        // // Remove asset row
        // document.addEventListener('click', function (e) {
        //     if (e.target.classList.contains('remove-asset')) {
        //         e.target.closest('.asset-item').remove();
        //     }
        // });
    </script>
@endsection
