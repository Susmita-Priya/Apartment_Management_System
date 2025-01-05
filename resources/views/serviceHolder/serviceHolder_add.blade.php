@extends('master')

@section('content')
    @push('title')
        <title>Serive Holder</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Service Holder</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('serviceHolder.index') }}">Service Holder</a></li>
                            <li class="breadcrumb-item active">Add Service Holder</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="{{ route('serviceHolder.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="container mt-5">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h1 class="d-flex justify-content-center mt-4">ADD SERVICE HOLDER</h1>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="name" class="col-form-label">Name</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Enter Name">
                                                <span class="text-danger">
                                                    @error('name')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group
                                                col-md-12">
                                                <label for="phone" class="col-form-label">Phone</label>
                                                <input type="text" class="form-control" name="phone" id="phone"
                                                    placeholder="Enter Phone">
                                                <span class="text-danger">
                                                    @error('phone')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group
                                                col-md-12">
                                                <label for="email" class="col-form-label">Email</label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Enter Email">
                                                <span class="text-danger">
                                                    @error('email')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="landlord_id" class="col-form-label">Landlord</label>
                                                <select class="form-control" name="landlord_id" id="landlord_id">
                                                    <option value="">Select Landlord</option>
                                                    @foreach ($landlords as $landlord)
                                                        <option value="{{ $landlord->id }}">
                                                            {{ $landlord->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                                    @error('landlord_id')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                            
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="services_id" class="form-label">Services</label>
                                                    <select name="services_id[]"
                                                        class="select2 form-control select2-multiple" data-toggle="select2"
                                                        multiple="multiple">
                                                        @foreach ($services as $service)
                                                            <option value="{{ $service->id }}">{{ $service->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger">
                                                        @error('services_id')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>
                                            </div>


                                            <!-- Note -->
                                            <div class="form-group col-md-12">
                                                <label for="note" class="col-form-label">Note</label>
                                                <input type="text" class="form-control" name="note" id="note"
                                                    placeholder="Enter Note">
                                                <span class="text-danger">
                                                    @error('note')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <!-- Submit Button -->
                                            <button type="submit"
                                                class="btn waves-effect waves-light btn-sm submitbtn">Done</button>
                                        </div>
                                    </div>
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
