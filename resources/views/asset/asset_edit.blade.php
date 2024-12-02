@extends('master')

@section('content')
    @push('title')
        <title>Edit Asset</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Asset</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('asset.index') }}">Asset List</a></li>
                            <li class="breadcrumb-item active">Edit Asset</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- Asset Form -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <form action="{{ route('asset.update',$asset->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="col-md-12">
                                <div class="card-box">
                                    <h1 class="d-flex justify-content-center mt-4">EDIT ASSET</h1>
    
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="name" class="col-form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ $asset->name }}">
                                            <span class="text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="short_description" class="form-label">Short Details</label>
                                        <input type="text" id="short_description" name="short_description" value="{{ $asset->short_description }}"
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
                                                    src="{{ $asset->image ? asset($asset->image) : '' }}"
                                                    alt="Image Preview"
                                                    style="max-width: 100%; height: auto; display: {{ $asset->image ? 'block' : 'none' }};">
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
                                                <option value="1" {{ $asset->status == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $asset->status == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            <span class="text-danger">
                                                @error('status')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
    
                                    <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">
                                        Edit Asset
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
