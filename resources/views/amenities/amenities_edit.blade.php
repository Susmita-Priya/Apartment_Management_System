@extends('master')

@section('content')
    @push('title')
        <title>Edit Amenity</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Amenity</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('amenities.index') }}">Amenity List</a></li>
                            <li class="breadcrumb-item active">Edit Amenity</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- Amenity Form -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <form action="{{ route('amenities.update',$amenities->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="col-md-12">
                                <div class="card-box">
                                    <h1 class="d-flex justify-content-center mt-4">EDIT AMENITY</h1>
    
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="name" class="col-form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ $amenities->name }}">
                                            <span class="text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <input type="text" id="description" name="description" value="{{ $amenities->description }}"
                                               class="form-control" placeholder="Enter short description">
                                    </div>
    
                                    <!-- Display error messages if any -->
                              
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="image" class="col-form-label">Image</label>
                                            <input type="file" class="form-control" name="image" id="image"
                                                accept="image/*">
                                            <span class="text-danger">
                                                @error('image')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                            <div id="imagePreviewContainer" style="margin-top: 15px;">
                                                <!-- Show existing image if available -->
                                                <img id="imagePreview"
                                                    src="{{ $amenities->image ? asset($amenities->image) : '' }}"
                                                    alt="Image Preview"
                                                    style="max-width: 100%; height: auto; display: {{ $amenities->image ? 'block' : 'none' }};">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-primary">
                                        <ul>
                                            <li>{{ "Max file size allowed is 100KB" }}</li>
                                            <li>{{ "Upload only images of type jpg, png or webp" }}
                                        </ul>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="status" class="col-form-label">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="">Select Status</option>
                                                <option value="1" {{ $amenities->status == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $amenities->status == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            <span class="text-danger">
                                                @error('status')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
    
                                    <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">
                                        Edit Amenity
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
