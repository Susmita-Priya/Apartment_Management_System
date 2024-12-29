@extends('master')

@section('content')
    @push('title')
        <title>Edit Service</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Service</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Service</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- Asset Form -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <form action="{{ route('service.edit',$service->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="container mt-5">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h1 class="d-flex justify-content-center mt-4">EDIT SERVICE</h1>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="name" class="col-form-label">Name</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                value="{{ $service->name }}">
                                                <span class="text-danger">
                                                    @error('name')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="price" class="col-form-label">Price</label>
                                                <input type="number" class="form-control" name="price" id="price"
                                                value="{{ $service->price }}">
                                                <span class="text-danger">
                                                    @error('price')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="note" class="form-label">Note</label>
                                                <input type="text" id="note" name="note" class="form-control"
                                                value="{{ $service->note??'' }}">
                                                <span class="text-danger">
                                                    @error('duration')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="status" class="col-form-label">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1" {{ $service->status == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ $service->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                                <span class="text-danger">
                                                    @error('status')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">
                                            Done
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
