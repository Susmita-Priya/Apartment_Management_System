@extends('master')

@section('content')
    @push('title')
        <title>Add Tenant</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Tenant</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}">Tenants</a></li>
                            <li class="breadcrumb-item active">Add Tenant</li>
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
                                    Add New Tenant
                                </h1>
                            </div>
                        </div>

                        <div>
                            <div class="card-body">
                                <form action="{{ route('tenants.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Tenant Photo -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Photo
                                        </label>

                                        <div class="col-10">
                                            <input class="form-control" type="file" name="image">
                                        </div>
                                    </div>

                                    <!-- Tenant name -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Name <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="name" required>
                                        </div>
                                    </div>

                                    <!--father name-->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Father’s Name <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="father" required>
                                        </div>
                                    </div>

                                    <!--Mother name-->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Mother’s Name <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="mother" required>
                                        </div>
                                    </div>

                                    <!--phone number-->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Phone Number <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="phone" required>
                                        </div>
                                    </div>
                                    <!--Email Address-->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Email <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="email" name="email" required>
                                        </div>
                                    </div>
                                    <!--NID number-->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            NID Number <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="number" name="nid" required>
                                        </div>
                                    </div>
                                    <!--Tax ID-->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Tax ID <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="number" name="tax_id">
                                        </div>
                                    </div>
                                    <!--passport number-->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Passport Number
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="number" name="passport">
                                        </div>
                                    </div>
                                    <!--Driving License-->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Driving License
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="number" name="driving_license">
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

                                    <!--Marital Status-->
                                    <div class="form-group row">
                                        <label for="status" class="col-2 ">
                                            Marital Status
                                        </label>
                                        <div class="col-10">
                                            <div class="form-group">
                                                <input type="radio" name="marital_status" value="Married"> Married
                                                &nbsp;&nbsp;&nbsp;<input type="radio" name="marital_status"
                                                    value="Unmarried">
                                                Unmarried
                                            </div>
                                        </div>
                                    </div>

                                    <!--Permanent Address-->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Permanent Address <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="address" name="per_address" required>
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
                                                <option value="Businessman" id="busy">Businessman</option>
                                                <option value="Job Holder" id="job">Job Holder</option>
                                                <option value="Self Employed" id="self">Self Employed</option>
                                                <option value="Service Holder" id="service">Service Holder</option>
                                                <option value="Housewife" id="house">Housewife</option>
                                                <option value="Student" id="stu">Student</option>
                                                <option value="Unemployed" id="un">Unemployed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--company name-->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Company/Institution Name
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="company">
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
                                                <option value="Islam">Islam</option>
                                                <option value="Hinduism">Hinduism</option>
                                                <option value="Buddhism">Buddhism</option>
                                                <option value="Christianity">Christianity</option>
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
                                                <option value="N/A">N/A</option>
                                                <option value="SSC">SSC</option>
                                                <option value="HSC">HSC</option>
                                                <option value="Bachelors">Bachelor's</option>
                                                <option value="Honours">Honours</option>
                                                <option value="BBA">BBA</option>
                                                <option value="LLB">LLB</option>
                                                <option value="MBBS">MBBS</option>
                                                <option value="Masters">Master's</option>
                                                <option value="MBA">MBA</option>
                                                <option value="Ph.D">Ph.D</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!--family-->
                                    <br>
                                    <h5 align="center">Family Member’s Information</h5>
                                    <br>
                                    <br>

                                    <!-- Dynamic Fields for Family Members -->
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Number of Family Members </br>(excluding yourself) <b
                                                style="color: red">*</b></label>
                                        <div class="col-10">
                                            <input type="number" name="family_members" id="family_members"
                                                class="form-control" required>
                                        </div>
                                    </div>

                                    <div id="familyMemberDetails"></div>

                                    <!-- Emergency Contact -->
                                    <br>
                                    <h5 align="center">Emergency Contact</h5>
                                    <br>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Full Name
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="e_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Relation
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="e_rel">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Address
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="e_add">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Mobile Number
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="e_phone">
                                        </div>
                                    </div>

                                    <!-- Housemaid Information -->
                                    <br>
                                    <h5 align="center">Housemaid Information </h5>
                                    <br>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Full Name
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="housemaid_name"
                                                id="housemaid_name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            NID
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="housemaid_nid"
                                                id="housemaid_nid">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Phone Number
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="housemaid_phone"
                                                id="housemaid_phone">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Permanent Address
                                        </label>
                                        <div class="col-10">
                                            <textarea class="form-control" name="housemaid_address" id="housemaid_address"></textarea>
                                        </div>
                                    </div>

                                    <!-- Driver-->
                                    <br>
                                    <h5 align="center">Driver Information </h5>
                                    <br>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Full Name
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="driver_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            NID
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="number" name="driver_nid">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Phone Number
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="driver_phone">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Permanent Address
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="driver_address">
                                        </div>
                                    </div>

                                    <!-- Previous House-Owner Information-->
                                    <br>
                                    <h5 align="center">Previous House-Owner Information </h5>
                                    <br>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Full Name
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="pre_owner_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Phone Number
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="pre_owner_phone">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Address
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="pre_owner_address">
                                        </div>
                                    </div>

                                    <!-- Why did you leave old house?-->
                                    <br>
                                    <h5 align="center">Reason for leaving previous House </h5>
                                    <br>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Description
                                        </label>
                                        <div class="col-10">
                                            <textarea class="form-control" type="text" name="reason"></textarea>
                                        </div>
                                    </div>
                                    <!-- Present House-Owner Information-->
                                    <br>
                                    <h5 align="center">Present House-Owner Information </h5>
                                    <br>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Full Name
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="new_owner_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Phone Number
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="new_owner_phone">
                                        </div>
                                    </div>

                                    <!-- Start date in new house-->
                                    <br>
                                    <h5 align="center">Start Date of living in the house </h5>
                                    <br>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">
                                            Date <b style="color: red">*</b>
                                        </label>
                                        <div class="col-10">
                                            <input class="form-control" type="date" name="new_house_start_date"
                                                required>
                                        </div>
                                    </div>

                                     <!-- Password Confirmation -->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Password <b style="color: red">*</b></label>
                                    <div class="col-10">
                                        <input class="form-control" type="password" name="password" required>
                                    </div>
                                </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn" data-toggle="modal" data-target="#passwordModal">Add Tenant</button>
 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                // Handle Family Member Details
                document.getElementById('family_members').addEventListener('change', function() {
                    let familyCount = this.value;
                    let familyMemberDetails = document.getElementById('familyMemberDetails');
                    familyMemberDetails.innerHTML = '';

                    for (let i = 1; i <= familyCount; i++) {
                        familyMemberDetails.innerHTML += `

                    <h5 align="center">Family Member(${i})</h5>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Full Name
                        </label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="family_members[${i}][name]" value="{{ old('family_members[${i}][name]') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Age
                        </label>
                        <div class="col-10">
                            <input class="form-control" type="number" name="family_members[${i}][age]" value="{{ old('family_members[${i}][age]') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Occupation
                        </label>
                        <div class="col-10">
                            <select class="form-control" name="family_members[${i}][occupation]">
                                <option value="">-- Select One --</option>
                                <option value="Businessman" id="busy">Businessman</option>
                                <option value="Job Holder" id="job">Job Holder</option>
                                <option value="Self Employed" id="self">Self Employed</option>
                                <option value="Service Holder" id="service">Service Holder</option>
                                <option value="Housewife" id="house">Housewife</option>
                                <option value="Student" id="stu">Student</option>
                                <option value="Unemployed" id="un">Unemployed</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Phone Number
                        </label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="family_members[${i}][phone]" value="{{ old('family_members[${i}][phone]') }}">
                        </div>
                    </div>
                `;
                    }
                });
            </script>
        @endsection
