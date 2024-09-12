<div class="modal fade" id="edit{{ $renter->r_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Update {{ $page_titile }} Information
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tenant.update',$renter->r_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-10">
                            <img src="{{ asset('uploads/renter-images/' . $renter->r_image) }}" alt="no image"
                                class="img-fluid img-thumbnail" width="80px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="passport_no" class="col-2 col-form-label">
                            Update Photo
                        </label>
                        <div class="col-10">
                            <input type="file" class="form-control" name="r_image">
                        </div>
                    </div>
                    <!--renter name-->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            {{ $page_titile }} Name
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="r_name" value="{{ $renter->r_name }}">
                            <input type="hidden" class="form-control" name="r_id" value="{{ $renter->r_id }}">
                        </div>
                    </div>
                    <!--father name-->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Father’s Name
                        </label>
                        <div class="col-10">
                            <!-- <input class="form-control" type="text" name="father" value="{{ old('father') }}" required> -->
                            <input type="text" class="form-control" name="father" value="{{ $renter->father }}">
                        </div>
                    </div>
                    <!--birthday-->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Date Of Birth
                        </label>
                        <div class="col-10">
                            <!-- <input class="form-control" type="date" name="birthday" value="{{ old('birthday') }}" required> -->
                            <input type="date" class="form-control" name="birthday" value="{{ $renter->birthday }}">
                        </div>
                    </div>
                    <!--Marital Status-->
                    <div class="form-group row">
                        <label for="status" class="col-2 ">
                            Marital Status
                        </label>
                        <select class="form-control col-10" name="marital_status">
                            <option value="Married"
                                @if (isset($renter->marital_status)) {{ $renter->marital_status == 'Married' ? 'selected' : '' }} @endif>
                                Married</option>
                            <option value="Unmarried"
                                @if (isset($renter->marital_status)) {{ $renter->marital_status == 'Unmarried' ? 'selected' : '' }} @endif>
                                Unmarried</option>
                        </select>
                    </div>
                    <!--Permanent Address-->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Permanent Address
                        </label>
                        <div class="col-10">
                            <!-- <input class="form-control" type="address" name="per_address" value="{{ old('per_address') }}" required> -->
                            <input type="text" class="form-control" name="per_address"
                                value="{{ $renter->per_address }}">
                        </div>
                    </div>
                    <!--Occupation-->
                    <div class="form-group row">
                        <label for="" class="col-2 ">
                            Occupation
                        </label>
                        <select class="form-control col-10" name="occupation">
                            <option value="{{ $renter->occupation }}">{{ $renter->occupation }}
                            </option>
                            <option value="Businessman">Businessman</option>
                            <option value="Job Holder">Job Holder</option>
                            <option value="Self Employed">Self Employed</option>
                            <option value="Service Holder">Service Holder</option>
                            <option value="Housewife">Housewife</option>
                            <option value="Student">Student</option>
                            <option value="Unemployed">Unemployed</option>
                        </select>
                    </div>
                    <!--company name-->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Company/Inst. Name
                        </label>

                        <div class="col-10">
                            <input type="text" class="form-control" name="company"
                                value="{{ $renter->company }}">
                        </div>
                    </div>
                    <!--religion-->
                    <div class="form-group row">
                        <label class="col-2 ">
                            Religion
                        </label>
                        <select class="form-control col-10" name="religion">
                            <option value="{{ $renter->religion }}">{{ $renter->religion }}
                            </option>
                            <option value="Islam">Islam</option>
                            <option value="Hinduism">Hinduism</option>
                            <option value="Buddhism">Buddhism</option>
                            <option value="Christianity">Christianity</option>
                        </select>
                    </div>
                    <!--Qualification-->
                    <div class="form-group row">
                        <label class="col-2 ">
                            Qualification
                        </label>
                        <select class="form-control col-10" name="qualification">
                            <option value="{{ $renter->qualification }}">
                                {{ $renter->qualification }}</option>
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
                    <!--phone number-->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Phone Number
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="r_phone"
                                value="{{ $renter->r_phone }}">
                        </div>
                    </div>
                    <!--Email Address-->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Email
                        </label>
                        <div class="col-10">
                            <input type="email" class="form-control" name="r_email"
                                value="{{ $renter->r_email }}">
                        </div>
                    </div>
                    <!--NID number-->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            NID Number
                        </label>

                        <div class="col-10">
                            <input type="number" class="form-control" name="r_nid" value="{{ $renter->r_nid }}">
                        </div>
                    </div>
                    <!--passport number-->
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Passport Number
                        </label>
                        <div class="col-10">
                            <input type="number" class="form-control" name="p" value="{{ $renter->p }}">
                        </div>
                    </div>
                    <!--Emergency -->
                    <br>
                    <h5 align="center">Emergency Contact</h5>
                    <br>
                    <br>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Full Name
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="e_full_name"
                                value="{{ $renter->e_full_name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Relation
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="e_rel" value="{{ $renter->e_rel }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Address
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="e_add" value="{{ $renter->e_add }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Mobile Number
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="e_phone"
                                value="{{ $renter->e_phone }}">
                        </div>
                    </div>
                    <!--family-->
                    <br>
                    <h5 align="center">Family Member/Room Partner’s Information</h5>
                    <br>
                    <br>
                    <!--member 1 -->
                    <h5 align="center">(1)</h5>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Full Name
                        </label>

                        <div class="col-10">
                            <input type="text" class="form-control" name="member_name_one"
                                value="{{ $renter->member_name_one }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Age
                        </label>
                        <div class="col-10">
                            <input type="number" class="form-control" name="member_age_one"
                                value="{{ $renter->member_age_one }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-2 ">
                            Occupation
                        </label>
                        <select class="form-control col-10" name="member_occupation_one">
                            <option value="{{ $renter->member_occupation_one }}">
                                {{ $renter->member_occupation_one }}</option>
                            <option value="Businessman" id="busy">Businessman</option>
                            <option value="Job Holder" id="job">Job Holder</option>
                            <option value="Self Employed" id="self">Self Employed</option>
                            <option value="Service Holder" id="service">Service Holder</option>
                            <option value="Housewife" id="house">Housewife</option>
                            <option value="Student" id="stu">Student</option>
                            <option value="Unemployed" id="un">Unemployed</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Phone Number
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="member_phone_one"
                                value="{{ $renter->member_phone_one }}">
                        </div>
                    </div>
                    <!--member 2 -->
                    <h5 align="center">(2)</h5>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Full Name
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="member_name_two"
                                value="{{ $renter->member_name_two }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Age
                        </label>
                        <div class="col-10">
                            <input type="number" class="form-control" name="member_age_two"
                                value="{{ $renter->member_age_two }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-2 ">
                            Occupation
                        </label>
                        <select class="form-control col-10" name="member_occupation_two">
                            <option value="{{ $renter->member_occupation_two }}">
                                {{ $renter->member_occupation_two }}</option>
                            <option value="Businessman" id="busy">Businessman</option>
                            <option value="Job Holder" id="job">Job Holder</option>
                            <option value="Self Employed" id="self">Self Employed</option>
                            <option value="Service Holder" id="service">Service Holder</option>
                            <option value="Housewife" id="house">Housewife</option>
                            <option value="Student" id="stu">Student</option>
                            <option value="Unemployed" id="un">Unemployed</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Phone Number
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="member_phone_two"
                                value="{{ $renter->member_phone_two }}">
                        </div>
                    </div>
                    <!--member 3 -->
                    <h5 align="center">(3)</h5>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Full Name
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="member_name_three"
                                value="{{ $renter->member_name_three }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Age
                        </label>
                        <div class="col-10">
                            <input type="number" class="form-control" name="member_age_three"
                                value="{{ $renter->member_age_three }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-2 ">
                            Occupation
                        </label>
                        <select class="form-control col-10" name="member_occupation_three">
                            <option value="{{ $renter->member_occupation_three }}">
                                {{ $renter->member_occupation_three }}</option>
                            <option value="Businessman" id="busy">Businessman</option>
                            <option value="Job Holder" id="job">Job Holder</option>
                            <option value="Self Employed" id="self">Self Employed</option>
                            <option value="Service Holder" id="service">Service Holder</option>
                            <option value="Housewife" id="house">Housewife</option>
                            <option value="Student" id="stu">Student</option>
                            <option value="Unemployed" id="un">Unemployed</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Phone Number
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="member_phone_three"
                                value="{{ $renter->member_phone_three }}">
                        </div>
                    </div>
                    <!-- House Maid-->
                    <br>
                    <h5 align="center">Housemaid Information </h5>
                    <br>
                    <br>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Full Name
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="maid_name"
                                value="{{ $renter->maid_name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            NID
                        </label>
                        <div class="col-10">
                            <input type="number" class="form-control" name="maid_nid"
                                value="{{ $renter->maid_nid }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Phone Number
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="maid_phone"
                                value="{{ $renter->maid_phone }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Permanent Address
                        </label>

                        <div class="col-10">
                            <input type="text" class="form-control" name="maid_address"
                                value="{{ $renter->maid_address }}">
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
                            <input type="text" class="form-control" name="driver_name"
                                value="{{ $renter->driver_name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            NID
                        </label>
                        <div class="col-10">
                            <input type="number" class="form-control" name="driver_nid"
                                value="{{ $renter->driver_nid }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Phone Number
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="driver_phone"
                                value="{{ $renter->driver_phone }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Permanent Address
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="driver_address"
                                value="{{ $renter->driver_address }}">
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
                            <input type="text" class="form-control" name="pre_owner_name"
                                value="{{ $renter->pre_owner_name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Phone Number
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="pre_owner_phone"
                                value="{{ $renter->pre_owner_phone }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Permanent Address
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="pre_owner_address"
                                value="{{ $renter->pre_owner_address }}">
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
                            <textarea type="text" class="form-control" name="reason" value="">{{ $renter->reason }}</textarea>
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
                            <input type="text" class="form-control" name="new_owner_name"
                                value="{{ $renter->new_owner_name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Phone Number
                        </label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="new_owner_phone"
                                value="{{ $renter->new_owner_phone }}">
                        </div>
                    </div>
                    <!-- Start date in new house-->
                    <br>
                    <h5 align="center">Start Date of living in the house </h5>
                    <br>
                    <br>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">
                            Date
                        </label>
                        <div class="col-10">
                            <input type="date" class="form-control" name="new_house_start_date"
                                value="{{ $renter->new_house_start_date }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-11">
                            <input type="submit" class="btn pull-right btn-primary" value="update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
