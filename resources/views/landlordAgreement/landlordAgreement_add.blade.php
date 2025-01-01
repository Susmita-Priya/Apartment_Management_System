@extends('master')

@section('content')
    @push('title')
        <title>Landlord Agreement</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Landlord Agreement</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Landlord Agreement</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="{{ route('landlordAgreement.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="container mt-5">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h1 class="d-flex justify-content-center mt-4">LANDLORD AGREEMENT</h1>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="landlord_id" class="col-form-label">Landlord</label>
                                                <select class="form-control" name="landlord_id" id="landlord_id">
                                                    <option value="">Select Landlord</option>
                                                    <!-- Add options here -->
                                                </select>
                                                <span class="text-danger">
                                                    @error('landlord_id')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="company_id" class="col-form-label">Company</label>
                                                <select class="form-control" name="company_id" id="company_id">
                                                    <option value="">Select Company</option>
                                                    <!-- Add options here -->
                                                    
                                                </select>
                                                <span class="text-danger">
                                                    @error('company_id')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="building_id" class="col-form-label">Building</label>
                                                <select class="form-control" name="building_id" id="building_id">
                                                    <option value="">Select Building</option>
                                                    <!-- Add options here -->
                                                </select>
                                                <span class="text-danger">
                                                    @error('building_id')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="floor_id" class="col-form-label">Floor</label>
                                                <select class="form-control" name="floor_id" id="floor_id">
                                                    <option value="">Select Floor</option>
                                                    <!-- Add options here -->
                                                </select>
                                                <span class="text-danger">
                                                    @error('floor_id')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="unit_id" class="col-form-label">Unit</label>
                                                <select class="form-control" name="unit_id" id="unit_id">
                                                    <option value="">Select Unit</option>
                                                    <!-- Add options here -->
                                                </select>
                                                <span class="text-danger">
                                                    @error('unit_id')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="document" class="col-form-label">Document</label>
                                                <input type="file" class="form-control" name="document" id="document">
                                                <span class="text-danger">
                                                    @error('document')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="amount" class="col-form-label">Amount</label>
                                                <input type="text" class="form-control" name="amount" id="amount"
                                                    placeholder="Enter Amount">
                                                <span class="text-danger">
                                                    @error('amount')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">
                                            Add Vehicle Type
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
    