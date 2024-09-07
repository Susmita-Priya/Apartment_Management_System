@extends('master')
@section('content')
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
                            <li class="breadcrumb-item active"> {{ $page_title }}</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- end row -->
            <div class="row">
                <div class="col-md-2">
                    <a href="{{ route('employee.index') }}" class="btn btn-success text-capitalize"><i
                            class="fa fa-list"></i> Go To Employee List
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="card-box" id="print_body">

                        <style>
                            th {
                                text-transform: capitalize;
                                width: 80px;
                                white-space: nowrap;
                            }
                        </style>

                        <div class="d-flex justify-content-between">
                            <div>
                                <h4> Byte care limited </h4>
                                <p>Makka tower(7th floor), kakrail, dhaka, bangladesh</p>
                            </div>
                            <h4> {{ $page_title }} </h4>

                            @if (!empty($employee->image))
                                <div>
                                    <img src="{{ asset('/uploads/employee/image/' . $employee->image) }}"
                                        style="width:120px;">
                                </div>
                            @endif
                        </div>

                        {{-- Basic --}}
                        <div class="form-row mt-4">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>employee code :</th>
                                        <td>{{ $employee->employee_code ?? '' }}</td>

                                        <th>name :</th>
                                        <td>{{ $employee->name ?? '' }}</td>
                                    </tr>
                                    <tr>

                                        <th>phone :</th>
                                        <td>{{ $employee->phone ?? '' }}</td>

                                        <th>email :</th>
                                        <td>{{ $employee->email ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>address :</th>
                                        <td>{{ $employee->address ?? '' }}</td>
                                        <th>nid :</th>
                                        <td>{{ $employee->nid ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>father's name :</th>
                                        <td>{{ $employee->fathers_name ?? '' }}</td>
                                        <th>mother's name :</th>
                                        <td>{{ $employee->mothers_name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>department :</th>
                                        <td>{{ $employee->department->name ?? '' }}</td>
                                        <th>designaiton :</th>
                                        <td>{{ $employee->designaiton->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>employee type :</th>
                                        <td>{{ $employee->employee_type->name ?? '' }}</td>
                                        <th>job location :</th>
                                        <td>{{ $employee->job_location->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>joining date :</th>
                                        <td>{{ $employee->joining_date ?? '' }}</td>
                                        <th>daily working hour :</th>
                                        <td>{{ $employee->daily_working_hour ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>weekend :</th>
                                        <td>{{ $employee->weekend ?? '' }}</td>
                                        <th>emargency contact no :</th>
                                        <td>{{ $employee->emargency_contact_no ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>shifting type :</th>
                                        <td>{{ $employee->shifting_type == 1 ? 'Normal' : 'Rostering' }}</td>
                                        <th></th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>machine id :</th>
                                        <td>{{ $employee->machine_id ?? '' }}</td>
                                        <th>status :</th>
                                        <td>{{ $employee->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    </tr>
                                </table>
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
                                                        $employee_salary = \App\Models\Payroll\EmployeeSalary::where([
                                                            'employee_id' => $employee->id,
                                                            'salary_head_id' => $salary_head->id,
                                                        ])->first();
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <strong> {{ $salary_head->name ?? '' }} </strong>
                                                    </td>
                                                    <td>
                                                        {{ $employee_salary->amount ?? '' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-2">
                    <a href="#" class="btn btn-primary rounded" id="click_print">
                        <i class="fa fa-print"></i>
                        Print
                    </a>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    </div>
@endsection

@push('js')
    @include('payroll.print_js_code')

    <script type="text/javascript">
        $('#click_print').click(function() {
            $('#print_body').printThis();
        })
    </script>
@endpush
