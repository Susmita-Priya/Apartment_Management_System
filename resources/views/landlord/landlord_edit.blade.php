@extends('master')

@section('content')
    @push('title')
        <title>Edit Landlord</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Landlord</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('landlord.index') }}">Landlords</a></li>
                            <li class="breadcrumb-item active">Edit Landlord</li>
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
                                    Update Landlord Information
                                </h1>
                            </div>
                        </div>

                        <div>
                            <div class="card-body">
                                <form action="{{ route('landlord.update', $landlord->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf


                                    <div class="row">
                                        <div class="col-12 col-md-12 mb-4">
                                            <label for="name">Full Name<span style="color: red;">*</span></label>
                                            <input type="text" placeholder="Enter your full name" name="name"
                                                value="{{ old('name', $landlord->name ?? '') }}" required="required"
                                                id="name" autocomplete="off"
                                                class="form-control bg-transparent @error('name') is-invalid @enderror" />
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-4">
                                            <label for="email">Email<span style="color: red;">*</span></label>
                                            <input type="text" placeholder="Enter your email" name="email"
                                                value="{{ old('email', $landlord->email ?? '') }}" required="required"
                                                id="email" autocomplete="off"
                                                class="form-control bg-transparent @error('email') is-invalid @enderror" />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <label for="phone">Mobile <span style="color: red;">*</span></label>
                                            <input type="text" placeholder="Enter Your Mobile Number" name="phone"
                                                value="{{ old('phone', $landlord->phone ?? '') }}" required="required"
                                                minlength="11" maxlength="11" id="mobileNumber" autocomplete="off"
                                                class="form-control bg-transparent @error('phone') is-invalid @enderror" />
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-6 mb-4">
                                            <label for="address">Address<span style="color: red;">*</span></label>
                                            <input type="text" placeholder="Enter your address" name="address"
                                                value="{{ old('address', $landlord->address ?? '') }}" required="required"
                                                id="address" autocomplete="off"
                                                class="form-control bg-transparent @error('address') is-invalid @enderror" />
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6 col-md-6 mb-4">
                                            <label for="nid">NID<span style="color: red;">*</span></label>
                                            <input type="text" placeholder="Enter your NID" name="nid"
                                                value="{{ old('nid', $landlord->nid ?? '') }}" required="required"
                                                id="nid" autocomplete="off"
                                                class="form-control bg-transparent @error('nid') is-invalid @enderror" />
                                            @error('nid')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-6 mb-4">
                                            <label for="tread_licence">Tread Licence<span style="color: red;">*</span></label>
                                            <input type="text" placeholder="Enter your Tread Licence" name="tread_licence"
                                                value="{{ old('tread_licence', $landlord->tread_licence ?? '') }}" required="required"
                                                id="tread_licence" autocomplete="off"
                                                class="form-control bg-transparent @error('tread_licence') is-invalid @enderror" />
                                            @error('tread_licence')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-6 col-md-6 mb-4">
                                            <label for="password">Password<span style="color: red;">*</span></label>
                                            <input type="password" placeholder="Enter password" name="password"
                                                id="password" autocomplete="off"
                                                class="form-control bg-transparent @error('password') is-invalid @enderror" />
                                            <small class="text-muted">Leave blank if you don't want to change the password.</small>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <button type="submit" class="btn submitbtn">Done</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
