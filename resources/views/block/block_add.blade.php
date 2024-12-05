@extends('master')

@section('content')
    @push('title')
        <title>Add Block</title>
    @endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Blocks</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('block.index') }}">Blocks</a></li>
                            <li class="breadcrumb-item active">Add Block</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('block.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="col-md-12">
                            <div class="card-box">
                                <h1 class="d-flex justify-content-center mt-4">ADD BLOCK</h1>

                                <!-- Building Selection -->
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="building_id" class="col-form-label">Building</label>
                                    <select name="building_id" id="building_id" class="form-control"
                                        onchange="showBuildingDetails()">
                                        <option value="">Select Building</option>
                                        @foreach ($buildings as $bldg)
                                            <option value="{{ $bldg->id }}"
                                                {{ $building && $building->id == $bldg->id ? 'selected' : '' }}>
                                                {{ $bldg->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('building_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name" class="col-form-label">Block Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter Block Name">
                                        <span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="total_upper_floors" class="col-form-label">Total Upper Floors</label>
                                        <input type="number" class="form-control" name="total_upper_floors" id="total_upper_floors"
                                            placeholder="Enter Total Upper Floor Count">
                                        <span class="text-danger">
                                            @error('total_upper_floors')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="total_underground_floors" class="col-form-label">Total Underground Floors</label>
                                        <input type="number" class="form-control" name="total_underground_floors" id="total_underground_floors"
                                            placeholder="Total Underground Floors Count">
                                        <span class="text-danger">
                                            @error('total_underground_floors')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <!-- Display Building ID and Type -->


                                <div class="form-group col-md-12">
                                    <label class="col-form-label">Details Information</label>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Building No</th>
                                            <td id="building_no_display"></td>
                                        </tr>
                                        <tr>
                                            <th>Building Type</th>
                                            <td id="building_type_display"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">
                                Add Block
                            </button>
                        </div>
                </div>
                </form>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container -->
    </div> <!-- content -->

    <script>
        const typeFullForm = @json($typeFullForm); // Encode PHP array to JSON

        function showBuildingDetails() {
            const buildings = @json($buildings);
            const selectedBuildingId = document.getElementById('building_id').value;
            const building = buildings.find(b => b.id == selectedBuildingId);

            if (building) {
                document.getElementById('building_no_display').innerText = building.building_no;
                document.getElementById('building_type_display').innerText = typeFullForm[building.type] || 'Other';
            } else {
                document.getElementById('building_no_display').innerText = '';
                document.getElementById('building_type_display').innerText = '';
            }
        }

        // Call the function on page load to show the initial building details if selected
        window.onload = showBuildingDetails;
    </script>
@endsection
