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

                                <!-- Building Selection -->
                                <div class="form-group col-md-12">
                                    <label for="building_id" class="col-form-label">Select Building</label>
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

                                <!-- Display Building ID and Type -->


                                <div class="form-group col-md-12">
                                    <label class="col-form-label">Building Details</label>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Building ID</th>
                                            <td id="building_id_display"></td>
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
                document.getElementById('building_id_display').innerText = building.building_id;
                document.getElementById('building_type_display').innerText = typeFullForm[building.type] || 'Other';
            } else {
                document.getElementById('building_id_display').innerText = '';
                document.getElementById('building_type_display').innerText = '';
            }
        }

        // Call the function on page load to show the initial building details if selected
        window.onload = showBuildingDetails;
    </script>
@endsection
