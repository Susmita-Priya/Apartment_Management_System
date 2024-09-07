@extends('master')
@section('content')
    @php
        if (!empty($employee->id)) {
            $route = route('employee.update', $employee->id);
            $page_title_prefix = 'Update';
        } else {
            $route = route('employee.store');
            $page_title_prefix = 'Create';
        }
    @endphp
    <style>
        label {
            text-transform: capitalize;
        }
    </style>
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box text-capitalize">
                        <h4 class="page-title float-left">{{ $page_title }}</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ url('/index') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $page_title }}</a></li>
                            <li class="breadcrumb-item active">{{ $page_title_prefix }} {{ $page_title }}</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            

            <!-- end row -->
            <div class="row">
                <div class="col-md-2"><a href="{{ route('employee.index') }}" class="btn btn-success text-capitalize"><i
                            class="fa fa-list"></i> Go To {{ $page_title }} List</a></div>
                <div class="col-md-8">
                    <form action="{{ $route }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        @if (!empty($employee->id))
                            @method('PUT')
                        @endif


                        <div class="card-box">
                            <h4 class="d-flex justify-content-center mt-4 text-capitalize">{{ $page_title_prefix }}
                                {{ $page_title }}</h4>

                            {{-- Basic --}}
                            <div class="form-row">
                                <div class="col-md-12">
                                    <h4>Basic Information : </h4>
                                    <hr>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="employee_code" class="col-form-label">employee code * </label>
                                    <input type="text" class="form-control" name="employee_code" id="employee_code"
                                        value="{{ $employee->employee_code ?? ($employee_code ?? '') }}" required>
                                    <span class="text-danger">
                                        @error('employee_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="name" class="col-form-label">name *</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $employee->name ?? '' }}" placeholder="Enter name" required>
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group col-md-3">
                                    <label for="phone" class="col-form-label">phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                        value="{{ $employee->phone ?? '' }}" placeholder="Enter phone">
                                    <span class="text-danger">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group col-md-3">
                                    <label for="email" class="col-form-label">email</label>
                                    <input type="mail" class="form-control" name="email" placeholder="Enter email"
                                        id="email" value="{{ $employee->email ?? '' }}">
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="address" class="col-form-label">address</label>
                                    <input type="text" class="form-control" name="address" id="address"
                                        value="{{ $employee->address ?? '' }}" placeholder="Enter address">
                                    <span class="text-danger">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="nid" class="col-form-label text-uppercase">nid</label>
                                    <input type="text" class="form-control" name="nid" placeholder="Enter nid"
                                        id="nid" value="{{ $employee->nid ?? '' }}">
                                    <span class="text-danger">
                                        @error('nid')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="fathers_name" class="col-form-label">father's name</label>
                                    <input type="text" class="form-control" name="fathers_name" id="fathers_name"
                                        value="{{ $employee->fathers_name ?? '' }}" placeholder="Enter fathers name">
                                    <span class="text-danger">
                                        @error('fathers_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="mothers_name" class="col-form-label">mother's name</label>
                                    <input type="text" class="form-control" name="mothers_name" id="mothers_name"
                                        value="{{ $employee->mothers_name ?? '' }}" placeholder="Enter mothers name">
                                    <span class="text-danger">
                                        @error('mothers_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="blood_group" class="col-form-label">blood group</label>
                                    <select class="form-control" name="blood_group" id="blood_group">
                                        <option value="">Select One</option>
                                        <option value="B+"
                                            @isset($employee->blood_group) {{ $employee->blood_group == 'B+' ? 'selected' : '' }} @endisset>
                                            B+
                                        </option>
                                        <option value="B-"
                                            @isset($employee->blood_group) {{ $employee->blood_group == 'B-' ? 'selected' : '' }} @endisset>
                                            B-
                                        </option>
                                        <option value="A+"
                                            @isset($employee->blood_group) {{ $employee->blood_group == 'A+' ? 'selected' : '' }} @endisset>
                                            A+
                                        </option>
                                        <option value="A-"
                                            @isset($employee->blood_group) {{ $employee->blood_group == 'A-' ? 'selected' : '' }} @endisset>
                                            A-
                                        </option>
                                        <option value="O+"
                                            @isset($employee->blood_group) {{ $employee->blood_group == 'O+' ? 'selected' : '' }} @endisset>
                                            O+
                                        </option>
                                        <option value="O-"
                                            @isset($employee->blood_group) {{ $employee->blood_group == 'O-' ? 'selected' : '' }} @endisset>
                                            O-
                                        </option>
                                        <option value="AB+"
                                            @isset($employee->blood_group) {{ $employee->blood_group == 'AB+' ? 'selected' : '' }} @endisset>
                                            AB+
                                        </option>
                                        <option value="AB-"
                                            @isset($employee->blood_group) {{ $employee->blood_group == 'AB-' ? 'selected' : '' }} @endisset>
                                            AB-
                                        </option>
                                    </select>

                                    <span class="text-danger">
                                        @error('blood_group')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="educational_qualification" class="col-form-label">educational
                                        qualification</label>
                                    <input type="text" class="form-control" name="educational_qualification"
                                        id="educational_qualification"
                                        value="{{ $employee->educational_qualification ?? '' }}"
                                        placeholder="Enter educational qualification">
                                    <span class="text-danger">
                                        @error('educational_qualification')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                {{-- hidden --}}
                                <input type="hidden" name="image" value="{{ $employee->image ?? '' }}">
                                
                                <div class="form-group col-md-3">
                                    <label for="image" class="col-form-label">image</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                    <span class="text-danger">
                                        @error('image')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                
                                @if (!empty($employee->image))
                                    <div class="form-group col-md-3">
                                        <img src="{{ asset('/uploads/employee/image/' . $employee->image) }}"
                                            style="width:120px;">
                                    </div>
                                @endif

                            </div>

                            {{-- Employment --}}
                            <div class="form-row">
                                <div class="col-md-12">
                                    <h4>Employment Information : </h4>
                                    <hr>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="department_id" class="col-form-label">Department *</label>
                                    <select name="department_id" class="form-control" id="department_id" required>
                                        <option value="">Slect One</option>
                                        @if (!empty($departments))
                                            @foreach ($departments as $key => $department)
                                                <option value="{{ $department->id ?? '' }}"
                                                    @isset($employee->department_id) {{ $employee->department_id == $department->id ? 'selected' : '' }} @endisset>
                                                    {{ $department->name ?? '' }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>

                                    <span class="text-danger">
                                        @error('department_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="designation_id" class="col-form-label">designation *</label>
                                    <select name="designation_id" class="form-control" id="designation_id" required>
                                        <option value="">Slect One</option>
                                        @if (!empty($designaitons))
                                            @foreach ($designaitons as $key => $designaiton)
                                                <option value="{{ $designaiton->id ?? '' }}"
                                                    @isset($employee->designation_id) {{ $employee->designation_id == $designaiton->id ? 'selected' : '' }} @endisset>
                                                    {{ $designaiton->name ?? '' }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>

                                    <span class="text-danger">
                                        @error('designation_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="employee_type_id" class="col-form-label">employee type *</label>
                                    <select name="employee_type_id" class="form-control" id="employee_type_id" required>
                                        <option value="">Slect One</option>
                                        @if (!empty($employee_types))
                                            @foreach ($employee_types as $key => $employee_type)
                                                <option value="{{ $employee_type->id ?? '' }}"
                                                    @isset($employee->employee_type_id) {{ $employee->employee_type_id == $employee_type->id ? 'selected' : '' }} @endisset>
                                                    {{ $employee_type->name ?? '' }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>

                                    <span class="text-danger">
                                        @error('employee_type_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="job_location_id" class="col-form-label">job location *</label>
                                    <select name="job_location_id" class="form-control" id="job_location_id" required>
                                        <option value="">Slect One</option>
                                        @if (!empty($job_locations))
                                            @foreach ($job_locations as $key => $job_location)
                                                <option value="{{ $job_location->id ?? '' }}"
                                                    @isset($employee->job_location_id) {{ $employee->job_location_id == $job_location->id ? 'selected' : '' }} @endisset>
                                                    {{ $job_location->name ?? '' }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>

                                    <span class="text-danger">
                                        @error('job_location_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group col-md-3">
                                    <label for="joining_date" class="col-form-label">joining date *</label>
                                    <input type="date" class="form-control" name="joining_date" id="joining_date"
                                        value="{{ $employee->joining_date ?? '' }}" placeholder="Enter joining date"
                                        required>
                                    <span class="text-danger">
                                        @error('joining_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="daily_working_hour" class="col-form-label">daily working hour</label>
                                    <input type="number" class="form-control" name="daily_working_hour"
                                        id="daily_working_hour" value="{{ $employee->daily_working_hour ?? '' }}"
                                        placeholder="Enter daily working hour">
                                    <span class="text-danger">
                                        @error('daily_working_hour')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="weekend" class="col-form-label">weekend *</label>
                                    <select class="form-control" name="weekend" id="weekend" required>
                                        {{-- <option value="">Select One</option> --}}
                                        <option value="Friday"
                                            @isset($employee->weekend) {{ $employee->weekend == 'Friday' ? 'selected' : '' }} @endisset>
                                            Friday
                                        </option>

                                        <option value="Saturday"
                                            @isset($employee->weekend) {{ $employee->weekend == 'Saturday' ? 'selected' : '' }} @endisset>
                                            Saturday
                                        </option>
                                        <option value="Sunday"
                                            @isset($employee->weekend) {{ $employee->weekend == 'Sunday' ? 'selected' : '' }} @endisset>
                                            Sunday
                                        </option>
                                        <option value="Monday"
                                            @isset($employee->weekend) {{ $employee->weekend == 'Monday' ? 'selected' : '' }} @endisset>
                                            Monday
                                        </option>
                                        <option value="Tuesday"
                                            @isset($employee->weekend) {{ $employee->weekend == 'Tuesday' ? 'selected' : '' }} @endisset>
                                            Tuesday
                                        </option>
                                        <option value="Wednesday"
                                            @isset($employee->weekend) {{ $employee->weekend == 'Wednesday' ? 'selected' : '' }} @endisset>
                                            Wednesday
                                        </option>
                                        <option value="Thursday"
                                            @isset($employee->weekend) {{ $employee->weekend == 'Thursday' ? 'selected' : '' }} @endisset>
                                            Thursday
                                        </option>

                                    </select>
                                    <span class="text-danger">
                                        @error('weekend')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group col-md-3">
                                    <label for="emargency_contact_no" class="col-form-label">emargency contact no</label>
                                    <input type="text" class="form-control" name="emargency_contact_no"
                                        id="emargency_contact_no" value="{{ $employee->emargency_contact_no ?? '' }}"
                                        placeholder="Enter emargency contact no">
                                    <span class="text-danger">
                                        @error('emargency_contact_no')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="shifting_type" class="col-form-label">shifting type *</label>
                                    <select class="form-control" name="shifting_type" id="shifting_type" required>
                                        <option value="1"
                                            @isset($employee->shifting_type) {{ $employee->shifting_type == 1 ? 'selected' : '' }} @endisset>
                                            Normal
                                        </option>
                                        <option value="2"
                                            @isset($employee->shifting_type) {{ $employee->shifting_type == 2 ? 'selected' : '' }} @endisset>
                                            Rostering
                                        </option>
                                    </select>
                                    <span class="text-danger">
                                        @error('shifting_type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            {{-- Software Related --}}
                            <div class="form-row">
                                <div class="col-md-12">
                                    <h4>Software Related Information : </h4>
                                    <hr>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="machine_id" class="col-form-label">
                                        Machine id
                                    </label>
                                    <input type="number" class="form-control" name="machine_id" id="machine_id"
                                        value="{{ $employee->machine_id ?? '' }}"
                                        placeholder="empoyee id in attendance device ">
                                    <span class="text-danger">
                                        @error('machine_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="status" class="col-form-label">Status *</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="1"
                                            @isset($employee->status) {{ $employee->status == 1 ? 'selected' : '' }} @endisset>
                                            Active
                                        </option>
                                        <option value="0"
                                            @isset($employee->status) {{ $employee->status != 1 ? 'selected' : '' }} @endisset>
                                            Inactive</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('status')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>


                            {{-- Salary Information --}}
                            <div class="form-row">
                                <div class="col-md-12">
                                    <h4>Salary Information : </h4>
                                    <hr>
                                </div>
                                <div class="form-group col-md-12">


                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Head Name</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (!empty($salary_heads))
                                                @foreach ($salary_heads as $key => $salary_head)
                                                    @php
                                                        if (!empty($employee)) {
                                                            $employee_salary = \App\Models\Payroll\EmployeeSalary::where(
                                                                [
                                                                    'employee_id' => $employee->id,
                                                                    'salary_head_id' => $salary_head->id,
                                                                ],
                                                            )->first();
                                                        }
                                                    @endphp

                                                    {{-- hidden id --}}
                                                    <input type="hidden" name="salary_head_id[]"
                                                        value="{{ $salary_head->id }}" class="form-control">

                                                    <tr>
                                                        <td>
                                                            <strong> {{ $salary_head->name ?? '' }} </strong>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="amount[]"
                                                                value="{{ $employee_salary->amount ?? '' }}"
                                                                class="form-control">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>



                            {{-- <button type="submit" class="btn btn-primary">ADD</button> --}}
                            <button type="submit" class="btn waves-effect waves-light btn-sm" id="sa-success-updateuser"
                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
                                {{ $page_title_prefix }} Data
                            </button>


                        </div>
                    </form>

                </div>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    </div>
@endsection
