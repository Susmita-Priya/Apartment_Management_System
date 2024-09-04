@extends('master')

@section('content')
    @push('title')
        <title>Add Stall/Locker</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Stall/Locker</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('block.show', $block->id) }}">Block</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('floor.show', $floor->id) }}">Floor</a></li>
                            <li class="breadcrumb-item active">Add Stall/Locker</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="{{ route('stall_locker.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="floor_id" value="{{ $floor->id }}">

                            <div class="form-group">
                                <label for="stall_locker_no">
                                    @if (($floor->parking_lot && $floor->storage_lot) || ($floor->bike_lot && $floor->storage_lot))
                                        Stall/Locker NO
                                    @elseif($floor->parking_lot || $floor->bike_lot)
                                        Stall NO
                                    @elseif($floor->storage_lot)
                                        Locker NO
                                    @endif

                                </label>
                                <input type="text" name="stall_locker_no" id="stall_locker_no" class="form-control"
                                    required>
                            </div>

                            {{-- <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="Bike Parking Stall">Bike Parking Stall</option>
                                <option value="Parking Stall">Parking Stall</option>
                                <option value="Storage Locker">Storage Locker</option>
                            </select>
                        </div> --}}

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control" required>

                                    @if ($floor->parking_lot)
                                        <option value="Car Parking Stall">Car Parking Stall</option>
                                    @endif

                                    @if ($floor->bike_lot)
                                        <option value="Bike Parking Stall">Bike Parking Stall</option>
                                    @endif

                                    @if ($floor->storage_lot)
                                        <option value="Storage Locker">Storage Locker</option>
                                    @endif

                                </select>
                            </div>

                            <button type="submit" class="btn waves-effect waves-light btn-sm"
                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
                                @if (
                                    ($floor->parking_lot && $floor->storage_lot) ||
                                        ($floor->bike_lot && $floor->storage_lot) ||
                                        ($floor->parking_lot && $floor->bike_lot))
                                    Add Stall/Locker
                                @elseif($floor->parking_lot || $floor->bike_lot)
                                    Add Stall
                                @elseif($floor->storage_lot)
                                    Add Locker
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
