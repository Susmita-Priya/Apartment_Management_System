@extends('master')

@section('content')
    @push('title')
        <title>Edit Block</title>
    @endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Blocks</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('building.show', $block->building_id) }}">Building</a></li>
                            <li class="breadcrumb-item active">Edit Block</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('block.update', $block->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="col-md-12">
                            <div class="card-box">
                                <h1 class="d-flex justify-content-center mt-4">EDIT BLOCK</h1>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name" class="col-form-label">Block Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name', $block->name) }}" placeholder="Enter Block Name">
                                        <span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="building_id" class="col-form-label">Building</label>
                                        <select class="form-control" name="building_id" id="building_id" onchange="showBuildingDetails()">
                                            @foreach($buildings as $building)
                                                <option value="{{ $building->id }}" {{ $block->building_id == $building->id ? 'selected' : '' }}>
                                                    {{ $building->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Display selected building details -->
                                    <div class="form-group col-md-12">
                                        <label class="col-form-label">Building Details</label>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Building ID</th>
                                                <td id="building_id_display">{{ $block->building->building_id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Building Type</th>
                                                <td id="building_type_display">{{ $typeFullForm[$block->building->type] ?? 'Other' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">        
                                    UPDATE
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
        function showBuildingDetails() {
            const buildings = @json($buildings);
            const selectedBuildingId = document.getElementById('building_id').value;
            const building = buildings.find(b => b.id == selectedBuildingId);

            document.getElementById('building_id_display').innerText = building.building_id;
            document.getElementById('building_type_display').innerText = building.type;
        }
    </script>
@endsection
