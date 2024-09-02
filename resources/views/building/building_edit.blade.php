@extends('master')

@section('content')
@push('title')
    <title>Edit Building</title>
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
                        <li class="breadcrumb-item active">Edit Building</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('building.update', $building->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="card-box">
                            <h1 class="d-flex justify-content-center mt-4">EDIT BUILDING</h1>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name" class="col-form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $building->name) }}" placeholder="Enter Building Name">
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
                                        <option value="RESB" {{ $building->type == 'RESB' ? 'selected' : '' }}>Residential Building</option>
                                        <option value="COMB" {{ $building->type == 'COMB' ? 'selected' : '' }}>Commercial Building</option>
                                        <option value="RECB" {{ $building->type == 'RECB' ? 'selected' : '' }}>Residential-Commercial Building</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            
                            {{-- Uncomment and modify if property_id is applicable --}}
                            {{-- <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="property_id" class="col-form-label">Property</label>
                                    <select class="form-control" name="property_id" id="property_id">
                                        <option value="">Select Property</option>
                                        @foreach($properties as $property)
                                            <option value="{{ $property->id }}" {{ $building->property_id == $property->id ? 'selected' : '' }}>{{ $property->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('property_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div> --}}

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="image" class="col-form-label">Image</label>
                                    <input type="file" class="form-control" name="image" id="image" accept="image/*">
                                    <span class="text-danger">
                                        @error('image')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div id="imagePreviewContainer" style="margin-top: 15px;">
                                        <!-- Show existing image if available -->
                                        <img id="imagePreview" src="{{ $building->image ? asset($building->image) : '' }}" alt="Image Preview" style="max-width: 100%; height: auto; display: {{ $building->image ? 'block' : 'none' }};">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn waves-effect waves-light btn-sm" style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container -->
</div> <!-- content -->



{{-- for image istant image change --}}
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
