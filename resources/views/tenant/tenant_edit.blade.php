@extends('master')

@section('content')
    @push('title')
        <title>Edit Tenant</title>
    @endpush

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Tenant</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}">Tenants</a></li>
                            <li class="breadcrumb-item active">Edit Tenant</li>
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
                                <h4 class="text-center">
                                     Edit Tenant
                                </h4>
                            </div>
                        </div>
                        <div>
                           
                            <div class="card-body">
                                 <form action="{{ route('tenants.update', ['id' => $tenant->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Tenant Photo -->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Photo
                                    </label>

                                    <div class="col-10">
                                        <div class="form-group">
                                            <label for="image">Previous Image</label>
                                            @if ($tenant->image)
                                                <div>
                                                    <img src="{{ asset($tenant->image) }}" alt="Tenant Image"
                                                        style="max-width: 200px; max-height: 200px;">
                                                </div>
                                            @else
                                                <p>No image uploaded.</p>
                                            @endif
                                        </div>
            
                                        <!-- New Image Upload -->
                                        <div class="form-group">
                                            <label for="image">Change Tenant Image</label>
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

                                <!-- Tenant name -->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Name <b style="color: red">*</b>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="name" value="{{ old('name', $tenant->name) }}" required>
                                    </div>
                                </div>

                                <!--father name-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Father’s Name <b style="color: red">*</b>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="father" value="{{ old('father', $tenant->father) }}" required>
                                    </div>
                                </div>

                                <!--Mother name-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Mother’s Name <b style="color: red">*</b>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="mother" value="{{ old('mother', $tenant->mother) }}" required>
                                    </div>
                                </div>

                                <!--phone number-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Phone Number <b style="color: red">*</b>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="phone" value="{{ old('phone', $tenant->phone) }}" required>
                                    </div>
                                </div>
                                <!--Email Address-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Email <b style="color: red">*</b>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="email" name="email" value="{{ old('email', $tenant->email) }}" required readonly>
                                    </div>
                                </div>
                                <!--NID number-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        NID Number <b style="color: red">*</b>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" name="nid" value="{{ old('nid', $tenant->nid) }}" required>
                                    </div>
                                </div>
                                <!--Tax ID-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Tax ID <b style="color: red">*</b>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" name="tax_id" value="{{ old('tax_id', $tenant->tax_id) }}">
                                    </div>
                                </div>
                                <!--passport number-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Passport Number
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" name="passport" value="{{ old('passport', $tenant->passport) }}">
                                    </div>
                                </div>
                                <!--Driving License-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Driving License
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" name="driving_license" value="{{ old('driving_license', $tenant->driving_license) }}">
                                    </div>
                                </div>

                                <!-- Date of Birth -->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Date of Birth <b style="color: red">*</b>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="date" name="dob" value="{{ old('dob', $tenant->dob) }}" required>
                                    </div>
                                </div>

                                <!--Marital Status-->
                                <div class="form-group row">
                                    <label for="status" class="col-2 ">
                                        Marital Status
                                    </label>
                                    <div class="col-10">
                                        <div class="form-group">
                                            <input type="radio" name="marital_status" value="Married" {{ old('marital_status', $tenant->marital_status) == 'Married' ? 'checked' : '' }}> Married
                                            &nbsp;&nbsp;&nbsp;<input type="radio" name="marital_status" value="Unmarried" {{ old('marital_status', $tenant->marital_status) == 'Unmarried' ? 'checked' : '' }}> Unmarried
                                        </div>
                                    </div>
                                </div>

                                <!--Permanent Address-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Permanent Address <b style="color: red">*</b>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="address" name="per_address" value="{{ old('per_address', $tenant->per_address) }}" required>
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
                                            <option value="Businessman" id="busy" {{ old('occupation', $tenant->occupation) == 'Businessman' ? 'selected' : '' }}>Businessman</option>
                                            <option value="Job Holder" id="job" {{ old('occupation', $tenant->occupation) == 'Job Holder' ? 'selected' : '' }}>Job Holder</option>
                                            <option value="Self Employed" id="self" {{ old('occupation', $tenant->occupation) == 'Self Employed' ? 'selected' : '' }}>Self Employed</option>
                                            <option value="Service Holder" id="service" {{ old('occupation', $tenant->occupation) == 'Service Holder' ? 'selected' : '' }}>Service Holder</option>
                                            <option value="Housewife" id="house" {{ old('occupation', $tenant->occupation) == 'Housewife' ? 'selected' : '' }}>Housewife</option>
                                            <option value="Student" id="stu" {{ old('occupation', $tenant->occupation) == 'Student' ? 'selected' : '' }}>Student</option>
                                            <option value="Unemployed" id="un" {{ old('occupation', $tenant->occupation) == 'Unemployed' ? 'selected' : '' }}>Unemployed</option>
                                        </select>
                                    </div>
                                </div>
                                <!--company name-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Company/Institution Name
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="company" value="{{ old('company', $tenant->company) }}">
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
                                            <option value="Islam" {{ old('religion', $tenant->religion) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Hinduism" {{ old('religion', $tenant->religion) == 'Hinduism' ? 'selected' : '' }}>Hinduism</option>
                                            <option value="Buddhism" {{ old('religion', $tenant->religion) == 'Buddhism' ? 'selected' : '' }}>Buddhism</option>
                                            <option value="Christianity" {{ old('religion', $tenant->religion) == 'Christianity' ? 'selected' : '' }}>Christianity</option>
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
                                            <option value="N/A" {{ old('qualification', $tenant->qualification) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                            <option value="SSC" {{ old('qualification', $tenant->qualification) == 'SSC' ? 'selected' : '' }}>SSC</option>
                                            <option value="HSC" {{ old('qualification', $tenant->qualification) == 'HSC' ? 'selected' : '' }}>HSC</option>
                                            <option value="Bachelors" {{ old('qualification', $tenant->qualification) == 'Bachelors' ? 'selected' : '' }}>Bachelor's</option>
                                            <option value="Honours" {{ old('qualification', $tenant->qualification) == 'Honours' ? 'selected' : '' }}>Honours</option>
                                            <option value="BBA" {{ old('qualification', $tenant->qualification) == 'BBA' ? 'selected' : '' }}>BBA</option>
                                            <option value="LLB" {{ old('qualification', $tenant->qualification) == 'LLB' ? 'selected' : '' }}>LLB</option>
                                            <option value="MBBS" {{ old('qualification', $tenant->qualification) == 'MBBS' ? 'selected' : '' }}>MBBS</option>
                                            <option value="Masters" {{ old('qualification', $tenant->qualification) == 'Masters' ? 'selected' : '' }}>Master's</option>
                                            <option value="MBA" {{ old('qualification', $tenant->qualification) == 'MBA' ? 'selected' : '' }}>MBA</option>
                                            <option value="Ph.D" {{ old('qualification', $tenant->qualification) == 'Ph.D' ? 'selected' : '' }}>Ph.D</option>
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
                                    <label class="col-2 col-form-label">Number of Family Members </br>(excluding yourself) <b style="color: red">*</b></label>
                                    <div class="col-10">
                                        <input type="number" name="family_members" id="family_members" class="form-control" value="{{ old('family_members', $tenant->family_members) }}" required>
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
                                        <input class="form-control" type="text" name="e_name" value="{{ old('e_name', $tenant->e_name) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Relation
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="e_rel" value="{{ old('e_rel', $tenant->e_rel) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Address
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="e_add" value="{{ old('e_add', $tenant->e_add) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Mobile Number
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="e_phone" value="{{ old('e_phone', $tenant->e_phone) }}">
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
                                        <input class="form-control" type="text" name="housemaid_name" id="housemaid_name" value="{{ old('housemaid_name', $tenant->housemaid_name) }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        NID
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="housemaid_nid" id="housemaid_nid" value="{{ old('housemaid_nid', $tenant->housemaid_nid) }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Phone Number
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="housemaid_phone" id="housemaid_phone" value="{{ old('housemaid_phone', $tenant->housemaid_phone) }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Permanent Address
                                    </label>
                                    <div class="col-10">
                                        <textarea class="form-control" name="housemaid_address" id="housemaid_address">{{ old('housemaid_address', $tenant->housemaid_address) }}</textarea>
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
                                        <input class="form-control" type="text" name="driver_name" value="{{ old('driver_name', $tenant->driver_name) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        NID
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" name="driver_nid" value="{{ old('driver_nid', $tenant->driver_nid) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Phone Number
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="driver_phone" value="{{ old('driver_phone', $tenant->driver_phone) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Permanent Address
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="driver_address" value="{{ old('driver_address', $tenant->driver_address) }}">
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
                                        <input class="form-control" type="text" name="pre_owner_name" value="{{ old('pre_owner_name', $tenant->pre_owner_name) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Phone Number
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="pre_owner_phone" value="{{ old('pre_owner_phone', $tenant->pre_owner_phone) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Address
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="pre_owner_address" value="{{ old('pre_owner_address', $tenant->pre_owner_address) }}">
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
                                        <textarea class="form-control" type="text" name="reason">{{ old('reason', $tenant->reason) }}</textarea>
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
                                        <input class="form-control" type="text" name="new_owner_name" value="{{ old('new_owner_name', $tenant->new_owner_name) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Phone Number
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="new_owner_phone" value="{{ old('new_owner_phone', $tenant->new_owner_phone) }}">
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
                                        <input class="form-control" type="date" name="new_house_start_date" value="{{ old('new_house_start_date', $tenant->new_house_start_date) }}" required>
                                    </div>
                                </div>

                                <!-- Password (optional) -->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">New Password (Optional)</label>
                                    <div class="col-10">
                                        <input class="form-control" type="password" name="password" placeholder="Leave blank if not changing">
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn waves-effect waves-light btn-sm submitbtn">Edit Tenant</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               
            <script>
                // Handle Family Member Details
                document.addEventListener('DOMContentLoaded', function() {
                    let familyCount = document.getElementById('family_members').value;
                    let familyMemberDetails = document.getElementById('familyMemberDetails');
                    let familyMembersDetails = @json($familyMembersDetails);
    
                    function renderFamilyMembers(count) {
                        familyMemberDetails.innerHTML = '';
    
                        for (let i = 1; i <= count; i++) {
                            let member = familyMembersDetails[i - 1] || {};
    
                            familyMemberDetails.innerHTML += `
                                <h5 align="center">Family Member(${i})</h5>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Full Name</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="family_members[${i}][name]" value="${member.name || ''}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Age</label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" name="family_members[${i}][age]" value="${member.age || ''}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Occupation</label>
                                    <div class="col-10">
                                        <select class="form-control" name="family_members[${i}][occupation]">
                                            <option value="">-- Select One --</option>
                                            <option value="Businessman" ${member.occupation === 'Businessman' ? 'selected' : ''}>Businessman</option>
                                            <option value="Job Holder" ${member.occupation === 'Job Holder' ? 'selected' : ''}>Job Holder</option>
                                            <option value="Self Employed" ${member.occupation === 'Self Employed' ? 'selected' : ''}>Self Employed</option>
                                            <option value="Service Holder" ${member.occupation === 'Service Holder' ? 'selected' : ''}>Service Holder</option>
                                            <option value="Housewife" ${member.occupation === 'Housewife' ? 'selected' : ''}>Housewife</option>
                                            <option value="Student" ${member.occupation === 'Student' ? 'selected' : ''}>Student</option>
                                            <option value="Unemployed" ${member.occupation === 'Unemployed' ? 'selected' : ''}>Unemployed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Phone Number</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="family_members[${i}][phone]" value="${member.phone || ''}">
                                    </div>
                                </div>
                            `;
                        }
                    }
    
                    renderFamilyMembers(familyCount);
    
                    document.getElementById('family_members').addEventListener('change', function() {
                        renderFamilyMembers(this.value);
                    });
                });            
                </script>
            
        @endsection
