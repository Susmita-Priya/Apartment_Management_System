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
                        <h4 class="page-title float-left">Add Asset</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('amenities.index') }}">Asset List</a></li>
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
                        <form action="{{ route('amenities.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                        <div class="container mt-5">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h1 class="d-flex justify-content-center mt-4">ADD ASSET</h1>
    
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="name" class="col-form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Enter Asset Name">
                                            <span class="text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <input type="text" id="description" name="description"
                                               class="form-control" placeholder="Enter short description">
                                    </div>
    
                                    <!-- Display error messages if any -->
                              
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="image" class="col-form-label">Image</label>
                                            <input type="file" class="form-control" name="image" id="image"
                                                accept="image/*">
                                            <div id="imagePreviewContainer" style="margin-top: 15px;">
                                                <!-- Show image preview here -->
                                                <img id="imagePreview" src="" alt="Image Preview"
                                                    style="max-width: 100%; height: auto; display: none;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-primary">
                                        <ul>
                                            <li>{{ "Max file size allowed is 100KB" }}</li>
                                            {{-- <li>{{ "Upload only images of type jpg, png or webp" }} --}}
                                        </ul>
                                    </div>
    
                                    <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">
                                        Add Asset
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
