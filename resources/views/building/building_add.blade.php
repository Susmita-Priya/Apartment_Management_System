@extends('master')

@section('content')
    @push('title')
        <title>Add Building</title>
    @endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Buildings</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('building') }}">Buildings</a></li>
                            <li class="breadcrumb-item active">Add Building</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('building.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="col-md-12">
                            <div class="card-box">
                                <h1 class="d-flex justify-content-center mt-4">ADD BUILDING</h1>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name" class="col-form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter Building Name">
                                        <span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="type" class="col-form-label">Type</label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="">Select Building Type</option>
                                            <option value="RESB">Residential Building</option>
                                            <option value="COMB">Commercial Building</option>
                                            <option value="RECB">Residential-Commercial Building</option>
                                        </select>
                                        <span class="text-danger">
                                            @error('type')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <!-- Display error messages if any -->

                                <div class="alert alert-primary">
                                    <ul>
                                        <li>{{ 'Max file size allowed is 100KB' }}</li>
                                        <li>{{ 'Upload only images of type jpg, png or webp' }}
                                    </ul>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="total_upper_floors" class="col-form-label">Total Upper Floors</label>
                                        <input type="number" class="form-control" name="total_upper_floors"
                                            id="total_upper_floors" placeholder="Enter Total Upper Floor Count">
                                        <span class="text-danger">
                                            @error('total_upper_floors')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="total_underground_floors" class="col-form-label">Total Underground
                                            Floors</label>
                                        <input type="number" class="form-control" name="total_underground_floors"
                                            id="total_underground_floors" placeholder="Total Underground Floors Count">
                                        <span class="text-danger">
                                            @error('total_underground_floors')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="common_area_id" class="form-label">Common Area</label>
                                        <select name="common_area_id[]" class="select2 form-control select2-multiple"
                                            data-toggle="select2" multiple="multiple">
                                            @foreach ($commonAreas as $commonArea)
                                                <option value="{{ $commonArea->id }}">{{ $commonArea->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('common_area_id')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="image" class="col-form-label">Image</label>
                                        <input type="file" class="form-control" name="image" id="image"
                                            accept="image/*">
                                        {{-- <span class="text-danger">
                                            @error('image')
                                                {{ $message }}
                                            @enderror
                                        </span> --}}
                                        <div id="imagePreviewContainer" style="margin-top: 15px;">
                                            <!-- Show image preview here -->
                                            <img id="imagePreview" src="" alt="Image Preview"
                                                style="max-width: 100%; height: auto; display: none;">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">
                                    Add Building
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection
