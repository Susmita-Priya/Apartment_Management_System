@extends('master')

@section('content')
    @push('title')
        <title>Add Landlord</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Landlord</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('landlord.index') }}">Landlords</a></li>
                            <li class="breadcrumb-item active">Add Landlord</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <div class="card-head">
                            <div class="kt-portlet__head-label">
                                <h1 class="text-center">
                                    Add New Landlord
                                </h1>
                            </div>
                        </div>

                        <div>
                            <div class="card-body">
                                <form action="{{ route('landlord.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Landlord Photo -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Photo
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="file" name="image">
                                        </div>
                                    </div>

                                    <!-- Landlord Name -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Name <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="name" required>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Phone <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="phone" required>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Email <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="email" name="email" required>
                                        </div>
                                    </div>

                                    <!-- NID -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            NID <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="nid" required>
                                        </div>
                                    </div>

                                    <!-- Tax ID -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Tax ID <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="tax_id" required>
                                        </div>
                                    </div>

                                    <!-- Passport -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Passport
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="passport">
                                        </div>
                                    </div>

                                    <!-- Driving License -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Driving License
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="driving_license">
                                        </div>
                                    </div>

                                    <!-- Date of Birth -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Date of Birth <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="date" name="dob" required>
                                        </div>
                                    </div>

                                    <!-- Marital Status -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Marital Status <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="marital_status" required>
                                        </div>
                                    </div>

                                    <!-- Permanent Address -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Permanent Address <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="per_address" required>
                                        </div>
                                    </div>

                                    <!-- Occupation -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Occupation <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="occupation" required>
                                        </div>
                                    </div>

                                    <!-- Company -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Company
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="company">
                                        </div>
                                    </div>

                                    <!-- Religion -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Religion <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="religion" required>
                                        </div>
                                    </div>

                                    <!-- Qualification -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Qualification
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="qualification">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection