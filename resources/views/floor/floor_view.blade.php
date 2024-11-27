@extends('master')

@section('content')
    @push('title')
        <title>Block Details</title>
    @endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">{{ $floor->name }}</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('building.show', $block->building_id) }}">Building</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('block.show', $floor->block_id) }}">Block</a></li>
                            <li class="breadcrumb-item active">Floor Details</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="profile-bg-picture" style="background-image:url('{{ asset('image/floor.webp') }}')">
                        <span class="picture-bg-overlay"></span><!-- overlay -->
                    </div>
                    <!-- meta -->
                    <div class="profile-user-box">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="pull-left m-r-15"><img src="{{ asset($building->image) }}" alt=""
                                        class="thumb-lg rounded-circle"></span>
                                <div class="media-body">
                                    <h4 class="m-t-7 font-18">{{ $floor->name }}</h4>
                                    <p class="text-muted font-15">{{ $building->name }} Building</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-right">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        style=" position: absolute; "
                                        onclick="window.location.href='{{ route('floor.edit', $floor->id) }}'">
                                        <i class="mdi mdi-pencil m-r-5"></i> Edit Floor
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ meta -->
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-md-4">
                    <!-- Block-Information -->
                    <div class="card-box">
                        <h4 class="header-title mt-0 m-b-20">Floor Information</h4>
                        <div class="panel-body">
                            @php
                                $suffix = '';
                                if ($floor->floor_no === 1) {
                                    $suffix = 'st';
                                } elseif ($floor->floor_no === 2) {
                                    $suffix = 'nd';
                                } elseif ($floor->floor_no === 3) {
                                    $suffix = 'rd';
                                }
                                else{
                                    $suffix = 'th';
                                }
                            @endphp

                            <p class="text-muted font-15"><strong>Floor No:</strong> <span
                                    class="m-l-15">{{ $floor->floor_no }}<sup>{{ $suffix }}</sup> floor</p>
                            <p class="text-muted font-15"><strong>Type:</strong> <span
                                    class="m-l-15">{{ ucfirst($floor->type) }}</p>
                            <p class="text-muted font-15"><strong>Floor Name:</strong> <span
                                    class="m-l-15">{{ $floor->name }}</p>
                            <p class="text-muted font-15"><strong>Date Added:</strong> <span
                                    class="m-l-15">{{ $floor->created_at->format('d M, Y') }}</span></p>

                            <hr>

                            <p class="text-muted font-15"><strong>Block No:</strong> <span
                                    class="m-l-15">{{ $block->block_no }}</span></p>
                            <p class="text-muted font-15"><strong>Block:</strong> <span
                                    class="m-l-15">{{ $block->name }}</span></p>
                            <hr>

                            @php
                                $typeFullForm = [
                                    'RESB' => 'Residential',
                                    'COMB' => 'Commercial',
                                    'RECB' => 'Residential-Commercial',
                                ];
                            @endphp

                            <p class="text-muted font-15"><strong>Building:</strong> <span
                                    class="m-l-15">{{ $building->name }} </span></p>
                            <p class="text-muted font-15"><strong>Building No:</strong> <span
                                    class="m-l-15">{{ $building->building_no }}</span></p>
                            <p class="text-muted font-15"><strong>Building Type:</strong> <span
                                    class="m-l-15">{{ $typeFullForm[$building->type] ?? 'Other' }}</span></p>
                            <hr>


                            <h4 class="header-title mt-0 m-b-20">Features :</h4>
                            <p class="text-muted font-15"><strong>Residential Units exist ? </strong> <span
                                    class="m-l-15">{{ $floor->is_residential_unit_exist ? 'Yes' : 'No' }}</p>

                            <p class="text-muted font-15"><strong>Commercial Units exist ?</strong> <span
                                    class="m-l-15">{{ $floor->is_commercial_unit_exist ? 'Yes' : 'No' }}</p>

                            <p class="text-muted font-15"><strong>Supporting & Service Room exist ?</strong> <span
                                    class="m-l-15">{{ $floor->is_supporting_room_exist ? 'Yes' : 'No' }}</p>
                            <p class="text-muted font-15"><strong>Parking Lot exist ?</strong> <span
                                    class="m-l-15">{{ $floor->is_parking_lot_exist ? 'Yes' : 'No' }}</p>
                            <p class="text-muted font-15"><strong>Storage Lot exist ?</strong> <span
                                    class="m-l-15">{{ $floor->is_storage_lot_exist ? 'Yes' : 'No' }}</p>
                        </div>
                    </div>
                    <!-- Block-Information -->
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-right m-b-20">

                                @if ($floor->parking_lot)
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        style="position: absolute; "
                                        onclick="window.location.href='{{ route('stall_locker.create', ['floor_id' => $floor->id]) }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Stall
                                    @elseif($floor->storage_lot)
                                        <button type="button" class="btn waves-effect waves-light greenbtn"
                                            style="position: absolute; "
                                            onclick="window.location.href='{{ route('stall_locker.create', ['floor_id' => $floor->id]) }}'">
                                            <i class="mdi mdi-plus m-r-5"></i> Add Locker
                                        @elseif($floor->parking_lot || $floor->storage_lot)
                                            <button type="button" class="btn waves-effect waves-light greenbtn"
                                                style="position: absolute; "
                                                onclick="window.location.href='{{ route('stall_locker.create', ['floor_id' => $floor->id]) }}'">
                                                <i class="mdi mdi-plus m-r-5"></i> Add Stall / Locker
                                            @elseif($building->type === 'RESB')
                                                <button type="button" class="btn waves-effect waves-light greenbtn"
                                                    style="position: absolute; "
                                                    onclick="window.location.href='{{ route('unit.create', ['floor_id' => $floor->id]) }}'">
                                                    <i class="mdi mdi-plus m-r-5"></i> Add Suite
                                                @elseif($building->type === 'COMB')
                                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                                        style="position: absolute; "
                                                        onclick="window.location.href='{{ route('unit.create', ['floor_id' => $floor->id]) }}'">
                                                        <i class="mdi mdi-plus m-r-5"></i> Add Unit
                                                    @elseif($building->type === 'RECB')
                                                        <button type="button"
                                                            class="btn waves-effect waves-light greenbtn"
                                                            style="position: absolute; "
                                                            onclick="window.location.href='{{ route('unit.create', ['floor_id' => $floor->id]) }}'">
                                                            <i class="mdi mdi-plus m-r-5"></i> Add Suite / Unit
                                @endif

                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <!-- Units List -->
                    {{-- <div class="row">
                        @php
                            // Define unit types for categorization
                            $unitTypes = [
                                'Residential Suite' => 'Residential Suite',
                                'Commercial Unit' => 'Commercial Unit',
                                'Supporting and Servicing Unit' => 'Supporting and Servicing Unit',
                            ];
                        @endphp

                        @foreach ($unitTypes as $typeKey => $typeName)
                            @php
                                // Filter units by type and sort by the numeric part after "UNIT"
                                $unitsByType = $floor->units->where('type', $typeKey)->sortBy(function ($unit) {
                                    return (int) $unit->unit_no;
                                });
                            @endphp

                            @if ($unitsByType->isNotEmpty())
                                <div class="col-md-12">
                                    <h4 class="header-title mt-0 m-b-20">{{ $typeName }}</h4>

                                    @foreach ($unitsByType->chunk(3) as $chunk)
                                        <div class="row">
                                            @foreach ($chunk as $unit)
                                                <div class="col-md-4">
                                                    <div class="card-box">
                                                        <h4 class="header-title mt-0 m-b-20">UNIT-{{ $unit->unit_no }}
                                                        </h4>
                                                        <div class="panel-body">
                                                            <p class="text-muted font-15"><strong>Type:
                                                                </strong>{{ $unit->type }}</p>
                                                            <button type="button"
                                                                onclick="window.location.href='{{ route('unit.show', $unit->id) }}'"
                                                                class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                                                Enter
                                                            </button>
                                                            <button type="button"
                                                                class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                                                onclick="window.location.href='{{ route('unit.edit', $unit->id) }}'">
                                                                Edit
                                                            </button>
                                                            <button type="button"
                                                                class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                                                onclick="confirmDelete('{{ route('unit.delete', ['id' => $unit->id]) }}')">
                                                                Delete
                                                            </button>
                                                            <!-- Hidden form for deletion -->
                                                            <form id="delete-form"
                                                                action="{{ route('unit.delete', ['id' => $unit->id]) }}"
                                                                method="GET" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div> --}}

                    <!-- Stalls/Lockers List -->
                    {{-- <div class="row mt-4">
                        @php
                            // Define stall/locker types for categorization
                            $stallLockerTypes = [
                                'Car Parking Stall' => 'Car Parking Stall',
                                'Bike Parking Stall' => 'Bike Parking Stall',
                                'Storage Locker' => 'Storage Locker',
                            ];
                        @endphp

                        @foreach ($stallLockerTypes as $typeKey => $typeName)
                            @php
                                // Filter stalls/lockers by type and sort them by the numeric part of their number
                                $stallsLockersByType = $floor->stallsLockers
                                    ->where('type', $typeKey)
                                    ->sortBy(function ($stallLocker) {
                                        // Assuming stall_locker_no contains only numeric values or is formatted consistently
                                        return (int) $stallLocker->stall_locker_no;
                                    });
                            @endphp

                            @if ($stallsLockersByType->isNotEmpty())
                                <div class="col-md-12">
                                    <h4 class="header-title mt-0 m-b-20">{{ $typeName }}</h4>

                                    @foreach ($stallsLockersByType->chunk(3) as $chunk)
                                        <div class="row">
                                            @foreach ($chunk as $stallLocker)
                                                <div class="col-md-4">
                                                    <div class="card-box">
                                                        <h4 class="header-title mt-0 m-b-20">

                                                            @if ($stallLocker->type == 'Car Parking Stall' || $stallLocker->type == 'Bike Parking Stall')
                                                                Stall-
                                                            @elseif ($stallLocker->type == 'Storage Locker')
                                                                Locker-
                                                            @endif{{ $stallLocker->stall_locker_no }}
                                                        </h4>

                                                        <div class="panel-body">
                                                            <p class="text-muted font-15"><strong>Type:
                                                                </strong>{{ $stallLocker->type }}</p>
                                                            <button type="button"
                                                                onclick="window.location.href='{{ route('stall_locker.show', $stallLocker->id) }}'"
                                                                class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                                                Enter
                                                            </button>
                                                            <button type="button"
                                                                class="btn btn-success m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                                                onclick="window.location.href='{{ route('stall_locker.edit', $stallLocker->id) }}'">
                                                                Edit
                                                            </button>

                                                            <button type="button"
                                                                class="btn btn-danger m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm"
                                                                onclick="confirmDelete('{{ route('stall_locker.delete', ['id' => $stallLocker->id]) }}')">
                                                                Delete
                                                            </button>
                                                            <!-- Hidden form for deletion -->
                                                            <form id="delete-form"
                                                                action="{{ route('stall_locker.delete', ['id' => $stallLocker->id]) }}"
                                                                method="GET" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div> --}}

                </div>
            </div>
            <!-- end content -->
        @endsection
