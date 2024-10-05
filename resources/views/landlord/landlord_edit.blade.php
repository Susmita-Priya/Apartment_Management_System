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
                                    Edit Landlord
                                </h1>
                            </div>
                        </div>
                        
                        <div>
                            <div class="card-body">
                                <form action="{{ route('landlord.update', $landlord->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Landlord Photo -->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Photo
                                    </label>

                                    <div class="col-10">
                                        <div class="form-group">
                                            <label for="image">Previous Image</label>
                                            @if ($landlord->image)
                                                <div>
                                                    <img src="{{ asset($landlord->image) }}" alt="Tenant Image"
                                                        style="max-width: 200px; max-height: 200px;">
                                                </div>
                                            @else
                                                <p>No image uploaded.</p>
                                            @endif
                                        </div>
            
                                        <!-- New Image Upload -->
                                        <div class="form-group">
                                            <label for="image">Change Landlord Image</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                            <span class="text-danger">
                                                @error('image')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        {{-- <input class="form-control" type="file" name="image" value="{{ old('image', $tenant->image) }}">   --}}
                                        
                                        {{-- value="{{ old('image', $tenant->image) }}"  =  If the form is submitted and validation fails, the input field will display the previously entered value (old('housemaid_address')).
                                        If the form is not submitted yet (or no previous value exists), it will display the current value from the $tenant->housemaid_address field. --}}
                                    
                                    
                                    </div>
                                </div>

                                    <!-- Landlord Name -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Name <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="name" value="{{ $landlord->name }}" required>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Phone <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="phone" value="{{ $landlord->phone }}" required>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Email <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="email" name="email" value="{{ $landlord->email }}" required readonly>
                                        </div>
                                    </div>

                                    <!-- NID -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            NID <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="nid" value="{{ $landlord->nid }}" required>
                                        </div>
                                    </div>

                                    <!-- Tax ID -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Tax ID <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="tax_id" value="{{ $landlord->tax_id }}" required>
                                        </div>
                                    </div>

                                    <!-- Passport -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Passport
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="passport" value="{{ $landlord->passport }}">
                                        </div>
                                    </div>

                                    <!-- Driving License -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Driving License
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="driving_license" value="{{ $landlord->driving_license }}">
                                        </div>
                                    </div>

                                    <!-- Date of Birth -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Date of Birth <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="date" name="dob" value="{{ $landlord->dob }}" required>
                                        </div>
                                    </div>

                                    <!--Marital Status-->
                                <div class="form-group row">
                                    <label for="status" class="col-2 ">
                                        Marital Status
                                    </label>
                                    <div class="col-10">
                                        <div class="form-group">
                                            <input type="radio" name="marital_status" value="Married" {{ old('marital_status', $landlord->marital_status) == 'Married' ? 'checked' : '' }}> Married
                                            &nbsp;&nbsp;&nbsp;<input type="radio" name="marital_status" value="Unmarried" {{ old('marital_status', $landlord->marital_status) == 'Unmarried' ? 'checked' : '' }}> Unmarried
                                        </div>
                                    </div>
                                </div>

                                    <!-- Permanent Address -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Permanent Address <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="per_address" value="{{ $landlord->per_address }}" required>
                                        </div>
                                    </div>

                                   <!--Occupation-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Occupation <b style="color: red">*</b>
                                    </label>
                                    <div class=" col-10">
                                        <select class="form-control" name="occupation" required="">
                                            <option value="">-- Select One --</option>
                                            <option value="Businessman" id="busy" {{ old('occupation', $landlord->occupation) == 'Businessman' ? 'selected' : '' }}>Businessman</option>
                                            <option value="Job Holder" id="job" {{ old('occupation', $landlord->occupation) == 'Job Holder' ? 'selected' : '' }}>Job Holder</option>
                                            <option value="Self Employed" id="self" {{ old('occupation', $landlord->occupation) == 'Self Employed' ? 'selected' : '' }}>Self Employed</option>
                                            <option value="Service Holder" id="service" {{ old('occupation', $landlord->occupation) == 'Service Holder' ? 'selected' : '' }}>Service Holder</option>
                                            <option value="Housewife" id="house" {{ old('occupation', $landlord->occupation) == 'Housewife' ? 'selected' : '' }}>Housewife</option>
                                            <option value="Student" id="stu" {{ old('occupation', $landlord->occupation) == 'Student' ? 'selected' : '' }}>Student</option>
                                            <option value="Unemployed" id="un" {{ old('occupation', $landlord->occupation) == 'Unemployed' ? 'selected' : '' }}>Unemployed</option>
                                        </select>
                                    </div>
                                </div>

                                    <!-- Company -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Company
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="company" value="{{ $landlord->company }}">
                                        </div>
                                    </div>

                                    <!--religion-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Religion <b style="color: red">*</b>
                                    </label>
                                    <div class=" col-10">
                                        <select class="form-control" name="religion" required="">
                                            <option value="">-- Select One --</option>
                                            <option value="Islam" {{ old('religion', $landlord->religion) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Hinduism" {{ old('religion', $landlord->religion) == 'Hinduism' ? 'selected' : '' }}>Hinduism</option>
                                            <option value="Buddhism" {{ old('religion', $landlord->religion) == 'Buddhism' ? 'selected' : '' }}>Buddhism</option>
                                            <option value="Christianity" {{ old('religion', $landlord->religion) == 'Christianity' ? 'selected' : '' }}>Christianity</option>
                                        </select>
                                    </div>
                                </div>

                                    <!--Qualification-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Qualification
                                    </label>
                                    <div class=" col-10">
                                        <select class="form-control" name="qualification">
                                            <option value="N/A" {{ old('qualification', $landlord->qualification) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                            <option value="SSC" {{ old('qualification', $landlord->qualification) == 'SSC' ? 'selected' : '' }}>SSC</option>
                                            <option value="HSC" {{ old('qualification', $landlord->qualification) == 'HSC' ? 'selected' : '' }}>HSC</option>
                                            <option value="Bachelors" {{ old('qualification', $landlord->qualification) == 'Bachelors' ? 'selected' : '' }}>Bachelor's</option>
                                            <option value="Honours" {{ old('qualification', $landlord->qualification) == 'Honours' ? 'selected' : '' }}>Honours</option>
                                            <option value="BBA" {{ old('qualification', $landlord->qualification) == 'BBA' ? 'selected' : '' }}>BBA</option>
                                            <option value="LLB" {{ old('qualification', $landlord->qualification) == 'LLB' ? 'selected' : '' }}>LLB</option>
                                            <option value="MBBS" {{ old('qualification', $landlord->qualification) == 'MBBS' ? 'selected' : '' }}>MBBS</option>
                                            <option value="Masters" {{ old('qualification', $landlord->qualification) == 'Masters' ? 'selected' : '' }}>Master's</option>
                                            <option value="MBA" {{ old('qualification', $landlord->qualification) == 'MBA' ? 'selected' : '' }}>MBA</option>
                                            <option value="Ph.D" {{ old('qualification', $landlord->qualification) == 'Ph.D' ? 'selected' : '' }}>Ph.D</option>
                                        </select>
                                    </div>
                                </div>

                                    <button type="submit" class="btn submitbtn">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection