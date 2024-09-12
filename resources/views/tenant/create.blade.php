@extends('master')

@php
    $page_titile = 'Tenant';
@endphp
@section('page_title', 'Tenant')

@section('content')
    <!--begin::Portlet-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left">{{ $page_titile }}</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ $page_titile }}</a></li>
                        <li class="breadcrumb-item active">{{ $page_titile }} list</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2"><a href="{{ route('tenant.index') }}" class="btn btn-success"><i class="fa fa-list"></i>
                    Go To {{ $page_titile }} List</a></div>

            <div class="col-md-8">
                <div class="card-box">
                    <div class="card-head">
                        <div class="kt-portlet__head-label">
                            <h4 class="text-center">
                                Add New {{ $page_titile }}
                            </h4>
                        </div>
                    </div>
                    <div>
                        <form action="{{ route('tenant.store') }}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                <!--renter photo-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        {{ $page_titile }} Photo
                                    </label>

                                    <div class="col-10">
                                        <input class="form-control" type="file" name="r_image">
                                    </div>
                                </div>
                                <!--renter name-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        {{ $page_titile }} Name <b style="color: red">*</b>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="r_name"
                                            value="{{ old('r_name') }}" required>
                                    </div>
                                </div>
                                <!--father name-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Father’s Name <b style="color: red">*</b>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="father"
                                            value="{{ old('father') }}" required>
                                    </div>
                                </div>
                                <!--birthday-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Date Of Birth <b style="color: red">*</b>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="date" name="birthday"
                                            value="{{ old('birthday') }}" required>
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
                                            &nbsp;&nbsp;&nbsp;<input type="radio" name="marital_status" value="Unmarried">
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
                                        <input class="form-control" type="address" name="per_address"
                                            value="{{ old('per_address') }}" required>
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
                                        <input class="form-control" type="text" name="company"
                                            value="{{ old('company') }}">
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
                                <!--phone number-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Phone Number <b style="color: red">*</b>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="r_phone"
                                            value="{{ old('r_phone') }}" required>
                                    </div>
                                </div>
                                <!--Email Address-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Email
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="email" name="r_email"
                                            value="{{ old('r_email') }}">
                                    </div>
                                </div>
                                <!--NID number-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        NID Number <b style="color: red">*</b>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" name="r_nid"
                                            value="{{ old('r_nid') }}" required>
                                    </div>
                                </div>
                                <!--passport number-->
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Passport Number
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" name="p"
                                            value="{{ old('p') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Total Family Member <b style="color: red">*</b>
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" name="total_family_member"
                                            value="{{ old('p') }}" required>
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
                                        <input class="form-control" type="text" name="e_full_name"
                                            value="{{ old('e_full_name') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Relation
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="e_rel"
                                            value="{{ old('e_rel') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Address
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="e_add"
                                            value="{{ old('e_add') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Mobile Number
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="e_phone"
                                            value="{{ old('e_phone') }}">
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
                                        <input class="form-control" type="text" name="member_name_one"
                                            value="{{ old('member_name_one') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Age
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" name="member_age_one"
                                            value="{{ old('member_age_one') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Occupation
                                    </label>
                                    <div class=" col-10">
                                        <select class="form-control" name="member_occupation_one">
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
                                        <input class="form-control" type="text" name="member_phone_one"
                                            value="{{ old('member_phone_one') }}">
                                    </div>
                                </div>
                                <!--member 2 -->
                                <h5 align="center">(2)</h5>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Full Name
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="member_name_two"
                                            value="{{ old('member_name_two') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Age
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" name="member_age_two"
                                            value="{{ old('member_age_two') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Occupation
                                    </label>
                                    <div class=" col-10">
                                        <select class="form-control" name="member_occupation_two">
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
                                        <input class="form-control" type="text" name="member_phone_two"
                                            value="{{ old('member_phone_two') }}">
                                    </div>
                                </div>
                                <!--member 3 -->
                                <h5 align="center">(3)</h5>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Full Name
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="member_name_three"
                                            value="{{ old('member_name_three') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Age
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" name="member_age_three"
                                            value="{{ old('member_age_three') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Occupation
                                    </label>
                                    <div class=" col-10">
                                        <select class="form-control" name="member_occupation_three">
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
                                        <input class="form-control" type="text" name="member_phone_three"
                                            value="{{ old('member_phone_three') }}">
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
                                        <input class="form-control" type="text" name="maid_name"
                                            value="{{ old('maid_name') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        NID
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" name="maid_nid"
                                            value="{{ old('maid_nid') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Phone Number
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="maid_phone"
                                            value="{{ old('maid_phone') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Permanent Address
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="maid_address"
                                            value="{{ old('maid_address') }}">
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
                                        <input class="form-control" type="text" name="driver_name"
                                            value="{{ old('driver_name') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        NID
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="number" name="driver_nid"
                                            value="{{ old('driver_nid') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Phone Number
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="driver_phone"
                                            value="{{ old('driver_phone') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Permanent Address
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="driver_address"
                                            value="{{ old('driver_address') }}">
                                    </div>
                                </div>
                                <!-- Previous House-Owner Information-->
                                <br>
                                <h5 align="center">Previous House-Owner Information <b style="color: red">***</b> </h5>
                                <br>
                                <br>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Full Name
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="pre_owner_name"
                                            value="{{ old('pre_owner_name') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Phone Number
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="pre_owner_phone"
                                            value="{{ old('pre_owner_phone') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Address
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="pre_owner_address"
                                            value="{{ old('pre_owner_address') }}">
                                    </div>
                                </div>
                                <!-- Why did you leave old house?-->
                                <br>
                                <h5 align="center">Reason for leaving previous House <b style="color: red">***</b> </h5>
                                <br>
                                <br>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Description
                                    </label>
                                    <div class="col-10">
                                        <textarea class="form-control" type="text" name="reason" value="{{ old('reason') }}"></textarea>
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
                                        <input class="form-control" type="text" name="new_owner_name"
                                            value="{{ old('new_owner_name') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">
                                        Phone Number
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="new_owner_phone"
                                            value="{{ old('new_owner_phone') }}">
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
                                            value="{{ old('new_house_start_date') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-2 ">
                                        <b>Status</b>
                                    </label>
                                    <div class="col-10">
                                        <div class="form-group">
                                            <input type="radio" name="renter_status" value="1" checked> Active
                                            &nbsp;&nbsp;&nbsp;<input type="radio" name="renter_status" value="0">
                                            Inactive
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-left">
                                    <input type="submit" class="btn btn-success">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
