@extends('master')

@section('content')
    @push('title')
        <title>Tenant</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Tenant Info</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}">Tenants</a></li>
                            <li class="breadcrumb-item active">Tenant Info</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="card-box">
                        <div class="container mt-5">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <div class="card-head">
                                        <div class="kt-portlet__head-label">
                                            <h1 class="text-center">
                                                Tenant Registration Form
                                            </h1>
                                        </div>
                                    </div>
                                    <div class="container mt-5">
                                        <div class="text-center mb-4">
                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                <!-- Step Indicators -->
                                                <div
                                                    class="step {{ $type === 'contact-info' ? 'active' : (in_array($type, ['personal-info', 'driver-info', 'emergency-contact']) ? 'completed' : '') }}">
                                                    1</div>
                                                <div
                                                    class="progress-bar flex-grow-1 mx-2 {{ in_array($type, ['personal-info', 'driver-info', 'emergency-contact']) ? 'completed' : '' }}">
                                                </div>

                                                <div
                                                    class="step {{ $type === 'personal-info' ? 'active' : (in_array($type, ['driver-info', 'emergency-contact']) ? 'completed' : '') }}">
                                                    2</div>
                                                <div
                                                    class="progress-bar flex-grow-1 mx-2 {{ in_array($type, ['driver-info', 'emergency-contact']) ? 'completed' : '' }}">
                                                </div>

                                                <div
                                                    class="step {{ $type === 'driver-info' ? 'active' : ($type === 'emergency-contact' ? 'completed' : '') }}">
                                                    3</div>
                                                <div
                                                    class="progress-bar flex-grow-1 mx-2 {{ $type === 'emergency-contact' ? 'completed' : '' }}">
                                                </div>

                                                <div class="step {{ $type === 'emergency-contact' ? 'active ' : '' }}">4
                                                </div>
                                            </div>

                                            <!-- Step Labels -->
                                            <div class="d-flex justify-content-between">
                                                <!-- Contact Info -->
                                                <span
                                                    class="step-label 
                                        {{ $type === 'contact-info' ? 'active' : '' }} 
                                        {{ in_array($type, ['personal-info', 'driver-info', 'emergency-contact']) ? 'completed' : '' }}">
                                                    Contact Info
                                                </span>

                                                <!-- Personal Info -->
                                                <span
                                                    class="step-label 
                                        {{ $type === 'personal-info' ? 'active' : '' }} 
                                        {{ in_array($type, ['driver-info', 'emergency-contact']) ? 'completed' : '' }}">
                                                    Personal Info
                                                </span>

                                                <!-- Driver Info -->
                                                <span
                                                    class="step-label 
                                        {{ $type === 'driver-info' ? 'active' : '' }} 
                                        {{ $type === 'emergency-contact' ? 'completed' : '' }}">
                                                    Driver Info
                                                </span>

                                                <!-- Emergency Contact -->
                                                <span
                                                    class="step-label {{ $type === 'emergency-contact' ? 'active completed' : '' }}">
                                                    Emergency Contact
                                                </span>
                                            </div>

                                        </div>

                                        <div class="tab-content">

                                            <!-- Step 1: Contact Info -->
                                            <div class="tab-pane fade {{ $type === 'contact-info' ? 'in active show' : '' }}"
                                                id="tab-1st">
                                                <form method="post"
                                                    action="{{ route('tenant.store', ['id' => $id, 'type' => 'contact-info']) }}">
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-12 col-md-12 mb-4">
                                                            <label for="name">Full Name<span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" placeholder="Enter your full name"
                                                                name="full_name"
                                                                value="{{ old('full_name', $contactInfo->full_name ?? '') }}"
                                                                required="required" id="name" autocomplete="off"
                                                                class="form-control bg-transparent @error('full_name') is-invalid @enderror" />

                                                            @error('full_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 mb-4">
                                                            <label for="email">Email<span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" placeholder="Enter your email"
                                                                name="email"
                                                                value="{{ old('email', $contactInfo->email ?? '') }}"
                                                                required="required" id="email" autocomplete="off"
                                                                class="form-control bg-transparent @error('email') is-invalid @enderror" />
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-12 col-md-6 mb-4">
                                                            <label for="phone">Mobile <span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" placeholder="Enter Your Mobile Number"
                                                                name="phone"
                                                                value="{{ old('phone', $contactInfo->phone ?? '') }}"
                                                                required="required" minlength="11" maxlength="11"
                                                                id="mobileNumber" autocomplete="off"
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
                                                            <label for="address">Address<span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" placeholder="Enter your address"
                                                                name="address"
                                                                value="{{ old('address', $contactInfo->address ?? '') }}"
                                                                required="required" id="address" autocomplete="off"
                                                                class="form-control bg-transparent @error('address') is-invalid @enderror" />
                                                            @error('address')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-md-6 mb-4">
                                                            <label for="password">Password<span
                                                                    style="color: red;">*</span></label>
                                                            <input type="password" placeholder="Enter password"
                                                                name="password" id="password" autocomplete="off"
                                                                class="form-control bg-transparent @error('password') is-invalid @enderror" />
                                                            <small class="text-muted">Leave blank if you don't want to
                                                                change the password.</small>
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-end">
                                                        <a
                                                            href="{{ route('tenant.store', ['id' => $id, 'type' => 'contact-info']) }}">
                                                            <button type="submit" class="btn btn-reg">
                                                                Next
                                                            </button>
                                                        </a>

                                                        {{-- <button type="submit" class="btn btn-reg">Next</button> --}}
                                                    </div>
                                                </form>
                                            </div>

                                            <!-- Step 2: Personal Info -->
                                            <div class="tab-pane fade {{ $type === 'personal-info' ? 'in active show' : '' }}"
                                                id="tab-2nd">
                                                <form method="post"
                                                    action="{{ route('tenant.store', ['id' => $id, 'type' => 'personal-info']) }}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 mb-4">
                                                            <label for="fathers_name">Father's Name<span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" placeholder="Enter your father's name"
                                                                name="fathers_name"
                                                                value="{{ old('fathers_name', $personalInfo->fathers_name ?? '') }}"
                                                                required="required" id="fathers_name" autocomplete="off"
                                                                class="form-control bg-transparent  @error('fathers_name') is-invalid @enderror" />

                                                            @error('fathers_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-12 col-md-6 mb-4">
                                                            <label for="mothers_name">Mother's Name <span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" placeholder="Enter your mother's name"
                                                                name="mothers_name"
                                                                value="{{ old('mothers_name', $personalInfo->mothers_name ?? '') }}"
                                                                required="required" id="mothers_name" autocomplete="off"
                                                                class="form-control bg-transparent @error('mothers_name') is-invalid @enderror" />

                                                            @error('mothers_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 col-md-6 mb-4">
                                                            <label for="nid">National ID <span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" placeholder="Enter national id"
                                                                name="nid"
                                                                value="{{ old('nid', $personalInfo->nid ?? '') }}"
                                                                required="required" id="nid" autocomplete="off"
                                                                class="form-control bg-transparent @error('nid') is-invalid @enderror" />

                                                            @error('nid')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-md-6 mb-4">
                                                            <label for="passport_no">Passport No </label>
                                                            <input type="text" placeholder="Enter passport no"
                                                                name="passport_no"
                                                                value="{{ old('passport_no', $personalInfo->passport_no ?? '') }}"
                                                                id="passport_no" autocomplete="off"
                                                                class="form-control bg-transparent @error('passport_no') is-invalid @enderror" />

                                                            @error('passport_no')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 col-md-6 mb-4">
                                                            <label for="tax_id">Tax Id <span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" placeholder="Entertax Id"
                                                                name="tax_id"
                                                                value="{{ old('tax_id', $personalInfo->tax_id ?? '') }}"
                                                                required="required" id="tax_id" autocomplete="off"
                                                                class="form-control bg-transparent @error('tax_id') is-invalid @enderror" />

                                                            @error('tax_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-md-6 mb-4">
                                                            <label for="driving_license">Driving License</label>
                                                            <input type="text" placeholder="Enter Driving License"
                                                                name="driving_license"
                                                                value="{{ old('driving_license', $personalInfo->driving_license ?? '') }}"
                                                                id="driving_license" autocomplete="off"
                                                                class="form-control bg-transparent @error('driving_license') is-invalid @enderror" />

                                                            @error('driving_license')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 mb-4">
                                                            <label for="date_of_birth">Date of birth<span
                                                                    style="color: red;">*</span></label>
                                                            <input type="date" name="dob"
                                                                value="{{ old('dob', $personalInfo->dob ?? '') }}"
                                                                required="required" id="date_of_birth"
                                                                placeholder="Date of birth"
                                                                class="form-control bg-transparent @error('dob') is-invalid @enderror" />

                                                            @error('dob')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-12 col-md-6 mb-4">
                                                            <label for="total_family_members">Total Family
                                                                Member<span style="color: red;">*</span></label>
                                                            <input type="number" placeholder="Enter Total Family Member"
                                                                name="total_family_members"
                                                                value="{{ old('total_family_members', $personalInfo->total_family_members ?? '') }}"
                                                                required="required" id="total_family_members"
                                                                class="form-control bg-transparent" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 mb-4">
                                                            <label for="religion">Religion <span
                                                                    style="color: red;">*</span></label>
                                                            <select id="religion" name="religion"
                                                                class="form-select bg-transparent @error('religion') is-invalid @enderror"
                                                                data-hide-search="true">
                                                                <option value="">Select</option>
                                                                <option value="Islam"
                                                                    {{ old('religion', isset($personalInfo) ? $personalInfo->religion : '') == 'Islam' ? 'selected' : '' }}>
                                                                    Islam</option>
                                                                <option value="Hinduism"
                                                                    {{ old('religion', isset($personalInfo) ? $personalInfo->religion : '') == 'Hinduism' ? 'selected' : '' }}>
                                                                    Hinduism</option>
                                                                <option value="Christianity"
                                                                    {{ old('religion', isset($personalInfo) ? $personalInfo->religion : '') == 'Christianity' ? 'selected' : '' }}>
                                                                    Christianity</option>
                                                                <option value="Buddhism"
                                                                    {{ old('religion', isset($personalInfo) ? $personalInfo->religion : '') == 'Buddhism' ? 'selected' : '' }}>
                                                                    Buddhism</option>
                                                                <option value="Others"
                                                                    {{ old('religion', isset($personalInfo) ? $personalInfo->religion : '') == 'Others' ? 'selected' : '' }}>
                                                                    Others</option>
                                                            </select>
                                                            @error('religion_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-12 col-md-6 mb-4">
                                                            <label for="marital_status">Marital Status <span
                                                                    style="color: red;">*</span></label>
                                                            <select id="marital_status" name="marital_status"
                                                                data-control="select2" required="required"
                                                                class="form-select bg-transparent @error('marital_status') is-invalid @enderror"
                                                                data-hide-search="true">
                                                                <option value="">Select</option>
                                                                <option value="Unmarried"
                                                                    {{ old('marital_status', isset($personalInfo) ? $personalInfo->marital_status : '') == 'Unmarried' ? 'selected' : '' }}>
                                                                    Unmarried</option>
                                                                <option value="Married"
                                                                    {{ old('marital_status', isset($personalInfo) ? $personalInfo->marital_status : '') == 'Married' ? 'selected' : '' }}>
                                                                    Married</option>
                                                            </select>

                                                            @error('marital_status')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12 col-md-6 mb-4">
                                                            <div class="form-group">
                                                                <div class="form-group gender">
                                                                    <label>Gender <span
                                                                            class="text-danger">*</span></label>
                                                                    <div
                                                                        class="row @error('gender') is-invalid @enderror">
                                                                        <div class="col-sm-4">

                                                                            <div class="button">
                                                                                <input name="gender" value="Male"
                                                                                    {{ old('gender', $personalInfo->gender ?? '') == 'Male' ? 'checked' : '' }}
                                                                                    required type="radio"
                                                                                    id="male">
                                                                                <label for="male" class="btn">
                                                                                    Male </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <div class="button">
                                                                                <input name="gender" value="Female"
                                                                                    {{ old('gender', $personalInfo->gender ?? '') == 'Female' ? 'checked' : '' }}
                                                                                    required type="radio"
                                                                                    id="female">
                                                                                <label for="female" class="btn">
                                                                                    Female </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <div class="button">
                                                                                <input name="gender" value="3"
                                                                                    {{ old('gender', $personalInfo->gender ?? '') == 'Others' ? 'checked' : '' }}
                                                                                    required type="radio"
                                                                                    id="others">
                                                                                <label for="others" class="btn">
                                                                                    Others </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @error('gender')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-6 col-md-6 mb-4">
                                                            <label for="occupation">Occupation <span
                                                                    style="color: red;">*</span></label>
                                                            <select id="occupation" name="occupation" required=""
                                                                data-control="select2"
                                                                class="form-select bg-transparent @error('marital_status') is-invalid @enderror"
                                                                data-hide-search="true">
                                                                <option value="">Select</option>
                                                                <option value="Businessman" id="busy"
                                                                    {{ old('occupation', $personalInfo->occupation ?? '') == 'Businessman' ? 'selected' : '' }}>
                                                                    Businessman</option>
                                                                <option value="Job Holder" id="job"
                                                                    {{ old('occupation', $personalInfo->occupation ?? '') == 'Job Holder' ? 'selected' : '' }}>
                                                                    Job Holder</option>
                                                                <option value="Self Employed" id="self"
                                                                    {{ old('occupation', $personalInfo->occupation ?? '') == 'Self Employed' ? 'selected' : '' }}>
                                                                    Self Employed</option>
                                                                <option value="Service Holder" id="service"
                                                                    {{ old('occupation', $personalInfo->occupation ?? '') == 'Service Holder' ? 'selected' : '' }}>
                                                                    Service Holder</option>
                                                                <option value="Housewife" id="house"
                                                                    {{ old('occupation', $personalInfo->occupation ?? '') == 'Housewife' ? 'selected' : '' }}>
                                                                    Housewife</option>
                                                                <option value="Student" id="stu"
                                                                    {{ old('occupation', $personalInfo->occupation ?? '') == 'Student' ? 'selected' : '' }}>
                                                                    Student</option>
                                                                <option value="Unemployed" id="un"
                                                                    {{ old('occupation', $personalInfo->occupation ?? '') == 'Unemployed' ? 'selected' : '' }}>
                                                                    Unemployed</option>
                                                            </select>
                                                            @error('occupation')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{ route('tenant.store', ['id' => $id, 'type' => 'contact-info']) }}"
                                                            class="btn btn-light previous_btn_style">Back</a>
                                                        <a
                                                            href="{{ route('tenant.store', ['id' => $id, 'type' => 'driver-info']) }}">
                                                            <button type="submit" class="btn btn-reg">
                                                                Next
                                                            </button>
                                                        </a>
                                                    </div>
                                                </form>
                                            </div>

                                            <!-- Step 3: Driver Info -->
                                            <div class="tab-pane fade {{ $type === 'driver-info' ? 'in active show' : '' }}"
                                                id="tab-3rd">
                                                <form method="post"
                                                    action="{{ route('tenant.store', ['id' => $id, 'type' => 'driver-info']) }}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-6 col-md-6 mb-4">
                                                            <label for="name">Full Name</label>
                                                            <input type="text" placeholder="Enter your full name"
                                                                name="full_name"
                                                                value="{{ old('full_name', $driverInfo->full_name ?? '') }}"
                                                                id="name" autocomplete="off"
                                                                class="form-control bg-transparent @error('full_name') is-invalid @enderror" />

                                                            @error('full_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-12 col-md-6 mb-4">
                                                            <label for="email">Email</label>
                                                            <input type="text" placeholder="Enter your email"
                                                                name="email"
                                                                value="{{ old('email', $driverInfo->email ?? '') }}"
                                                                id="email" autocomplete="off"
                                                                class="form-control bg-transparent @error('email') is-invalid @enderror" />
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-12 col-md-6 mb-4">
                                                            <label for="phone">Mobile</label>
                                                            <input type="text" placeholder="Enter Your Mobile Number"
                                                                name="phone"
                                                                value="{{ old('phone', $driverInfo->phone ?? '') }}"
                                                                minlength="11" maxlength="11" id="mobileNumber"
                                                                autocomplete="on"
                                                                class="form-control bg-transparent @error('phone') is-invalid @enderror" />

                                                            @error('phone')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-md-6 mb-4">
                                                            <label for="driving_license">Driving License</label>
                                                            <input type="text" placeholder="Enter Driving License"
                                                                name="driving_license"
                                                                value="{{ old('driving_license', $driverInfo->driving_license ?? '') }}"
                                                                id="driving_license" autocomplete="off"
                                                                class="form-control bg-transparent @error('driving_license') is-invalid @enderror" />

                                                            @error('driving_license')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-12 mb-4">
                                                            <label for="address">Address</label>
                                                            <input type="text" placeholder="Enter your address"
                                                                name="address"
                                                                value="{{ old('address', $driverInfo->address ?? '') }}"
                                                                id="address" autocomplete="off"
                                                                class="form-control bg-transparent @error('address') is-invalid @enderror" />
                                                            @error('address')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{ route('tenant.store', ['id' => $id, 'type' => 'personal-info']) }}"
                                                            class="btn btn-light previous_btn_style">Back</a>
                                                        <a
                                                            href="{{ route('tenant.store', ['id' => $id, 'type' => 'emergency-contact']) }}">
                                                            <button type="submit" class="btn btn-reg">
                                                                Next
                                                            </button>
                                                        </a>
                                                        {{-- <button type="submit" class="btn btn-reg">Next</button> --}}
                                                    </div>
                                                </form>
                                            </div>

                                            <!-- Step 4: Emergency Contact -->
                                            <div class="tab-pane fade {{ $type === 'emergency-contact' ? 'in active show' : '' }}"
                                                id="tab-4th">
                                                <form method="post"
                                                    action="{{ route('tenant.store', ['id' => $id, 'type' => 'emergency-contact']) }}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-6 col-md-6 mb-4">
                                                            <label for="name">Full Name<span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" placeholder="Enter your full name"
                                                                name="full_name"
                                                                value="{{ old('full_name', $emergencyContact->full_name ?? '') }}"
                                                                required="required" id="name" autocomplete="off"
                                                                class="form-control bg-transparent @error('full_name') is-invalid @enderror" />

                                                            @error('full_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-md-6 mb-4">
                                                            <label for="relationship">Relationship<span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" placeholder="Enter your relationship"
                                                                name="relationship"
                                                                value="{{ old('relationship', $emergencyContact->relationship ?? '') }}"
                                                                required="required" id="relationship" autocomplete="off"
                                                                class="form-control bg-transparent @error('relationship') is-invalid @enderror" />
                                                            @error('relationship')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 mb-4">
                                                            <label for="email">Email<span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" placeholder="Enter your email"
                                                                name="email"
                                                                value="{{ old('email', $emergencyContact->email ?? '') }}"
                                                                required="required" id="email" autocomplete="off"
                                                                class="form-control bg-transparent @error('email') is-invalid @enderror" />
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-12 col-md-6 mb-4">
                                                            <label for="phone">Mobile <span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" placeholder="Enter Your Mobile Number"
                                                                name="phone"
                                                                value="{{ old('phone', $emergencyContact->phone ?? '') }}"
                                                                required="required" minlength="11" maxlength="11"
                                                                id="mobileNumber" autocomplete="off"
                                                                class="form-control bg-transparent @error('phone') is-invalid @enderror" />

                                                            @error('phone')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-12 mb-4">
                                                            <label for="address">Address<span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" placeholder="Enter your address"
                                                                name="address"
                                                                value="{{ old('address', $emergencyContact->address ?? '') }}"
                                                                required="required" id="address" autocomplete="off"
                                                                class="form-control bg-transparent @error('address') is-invalid @enderror" />
                                                            @error('address')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{ route('tenant.store', ['id' => $id, 'type' => 'driver-info']) }}"
                                                            class="btn btn-light previous_btn_style">Back</a>
                                                        <button type="submit" class="btn btn-reg">Finish</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
