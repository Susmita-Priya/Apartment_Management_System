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
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Admin</a></li>
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

                                {{-- <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="property_id" class="col-form-label">Property</label>
                                    <select class="form-control" name="property_id" id="property_id">
                                        <option value="">Select Property</option>
                                        <!-- Assuming you have a collection of properties available -->
                                        @foreach ($properties as $property)
                                            <option value="{{ $property->id }}">{{ $property->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('property_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div> --}}

                                <!-- Display error messages if any -->
                                
                                    <div class="alert alert-primary">
                                        <ul>
                                            <li>{{ "Max file size allowed is 100KB" }}</li>
                                            <li>{{ "Upload only images of type jpg, png or webp" }}
                                        </ul>
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

                                <button type="submit" class="btn waves-effect waves-light btn-sm"
                                    style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
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


    {{-- this portion for image instant change --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');

            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block'; // Show the image
                    };

                    reader.readAsDataURL(file);
                } else {
                    imagePreview.src = '';
                    imagePreview.style.display = 'none'; // Hide the image if no file is selected
                }
            });
        });
    </script>
@endsection
