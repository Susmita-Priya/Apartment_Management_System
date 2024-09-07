@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box text-capitalize">
                        <h4 class="page-title float-left">{{ $page_title }}</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $page_title }}</a></li>
                            <li class="breadcrumb-item active">{{ $page_title }} list</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                       <a href="#" class="btn btn-primary rounded" id="click_print">
                                                <i class="fa fa-print"></i>
                                                Print
                                            </a>
                </div>
                <div class="col-12">
                    <div class="card-box" id="print_body">
                        @if (!empty($payroll))
                            @php
                                if ($submited_month == 1) {
                                    $payroll_month = 'January';
                                } elseif ($submited_month == 2) {
                                    $payroll_month = 'February';
                                } elseif ($submited_month == 3) {
                                    $payroll_month = 'March';
                                } elseif ($submited_month == 4) {
                                    $payroll_month = 'April';
                                } elseif ($submited_month == 5) {
                                    $payroll_month = 'May';
                                } elseif ($submited_month == 6) {
                                    $payroll_month = 'June';
                                } elseif ($submited_month == 7) {
                                    $payroll_month = 'July';
                                } elseif ($submited_month == 8) {
                                    $payroll_month = 'August';
                                } elseif ($submited_month == 9) {
                                    $payroll_month = 'September';
                                } elseif ($submited_month == 10) {
                                    $payroll_month = 'October';
                                } elseif ($submited_month == 11) {
                                    $payroll_month = 'November';
                                } elseif ($submited_month == 12) {
                                    $payroll_month = 'December';
                                } else {
                                    $payroll_month = 'Not Found';
                                }

                            @endphp

                                <div>
                                    <div>
                                        <div class="text-center">
                                            <h4>Byte Care Limited</h4>
                                            <p>Makka tower(7th floor), kakrail, dhaka, bangladesh</p>
                                            <h5 class=" text-capitalize">{{ $page_title }}</h5>
                                        </div>
                                        <p class="m-0 p-0">
                                            <strong> Year :</strong> {{ $submited_year ?? '' }}
                                        </p>
                                        <p class="m-0 p-0">
                                            <strong> Month :</strong> {{ $payroll_month }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <table
                                        class="table m-0 tickets-list table-actions-bar dt-responsive nowrap table-bordered"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Employee</th>
                                                <!-- salary head -->
                                                @if (!empty($salary_heads))
                                                    @foreach ($salary_heads as $salary_head)
                                                        <th class="{{ $salary_head->head_type == 2 ? 'text-danger' : '' }}">
                                                            {{ $salary_head->name ?? '' }}
                                                        </th>
                                                    @endforeach
                                                @endif

                                                <th>Net salary</th>
                                            </tr>
                                        </thead>

                                        @php
                                            $emp_counter = 0;
                                            $grand_total = 0;
                                        @endphp

                                        <tbody>
                                            @if (!empty($employees))
                                                @foreach ($employees as $employee)
                                                    @php
                                                        $column_counter = 0;
                                                        $total_salary = 0;
                                                    @endphp

                                                    <tr>
                                                        <td>{{ ++$emp_counter }}</td>
                                                        <td>{{ $employee->name }}</td>

                                                        {{-- salary calculation --}}
                                                        @if (!empty($salary_heads))
                                                            @foreach ($salary_heads as $salary_head)
                                                                @php
                                                                    ++$column_counter;

                                                                    if (!empty($employee)) {
                                                                        $employee_salary = \App\Models\Payroll\PayrollDetail::where(
                                                                            [
                                                                                'payroll_id' => $payroll->id,
                                                                                'employee_id' => $employee->id,
                                                                                'salary_head_id' => $salary_head->id,
                                                                            ],
                                                                        )->first();

                                                                        // class list for adding or subtracting al column
                                                                        if ($salary_head->head_type == 1) {
                                                                            $class_list =
                                                                                'addition ' .
                                                                                ('addition_column_' . $column_counter) .
                                                                                ' ' .
                                                                                ('addition_row_' . $emp_counter);

                                                                            $total_salary +=
                                                                                $employee_salary->amount ?? 0;
                                                                            $grand_total +=
                                                                                $employee_salary->amount ?? 0;
                                                                        } else {
                                                                            $class_list =
                                                                                'text-danger deduction ' .
                                                                                ('deduction_column_' .
                                                                                    $column_counter) .
                                                                                ' ' .
                                                                                ('deduction_row_' . $emp_counter);

                                                                            $total_salary -=
                                                                                $employee_salary->amount ?? 0;
                                                                            $grand_total -=
                                                                                $employee_salary->amount ?? 0;
                                                                        }
                                                                    }
                                                                @endphp

                                                                
                                                                <td>
                                                                    <!-- amount -->
                                                                    <input type="number" name="amount[]"
                                                                        row_number ="{{ $emp_counter }}"
                                                                        column_number ="{{ $column_counter }}"
                                                                        value="{{ $employee_salary->amount ?? '' }}"
                                                                        class="form-control {{ $class_list }} bg-white" readonly style="border-style:none">
                                                                </td>
                                                            @endforeach
                                                        @endif

                                                        <!-- total salary -->
                                                        <th>
                                                            <input type="number" value="{{ $total_salary }}"
                                                                class="bg-white form-control total_salary"
                                                                id="total_salary_{{ $emp_counter }}" readonly style="border-style:none">
                                                        </th>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2"> <strong class="d-flex justify-content-end mt-2"> Total:</strong> </th>
                                                @if (!empty($salary_heads))
                                                    @foreach ($salary_heads as $key => $salary_head)
                                                        @php
                                                            ++$key;
                                                        @endphp
                                                        <th>
                                                            <input type="number"
                                                                class="bg-white form-control {{ $salary_head->head_type == 2 ? 'text-danger deduction_sub_total' : 'addition_sub_total' }} "
                                                                id="sub_total_{{ $key }}"
                                                                column_number ="{{ $key }}" readonly  style="border-style:none">
                                                        </th>
                                                    @endforeach
                                                @endif

                                                <th>
                                                    <input type="number" name="grand_total"
                                                        value="{{ $grand_total ?? 0 }}"
                                                        class="form-control text-primary font-weight-bold bg-white" id="grand_total"
                                                        readonly style="border-style:none">
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                             
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')
    @include('payroll.print_js_code')

    <script type="text/javascript">
        $('#click_print').click(function() {
            $('#print_body').printThis();
        });
    </script>

   

    {{-- ------------------------ before trigger event - calculate sub-total amount --------------------- --}}
    <script>
        $(".addition_sub_total").each(function() {
            var column_number = parseFloat($(this).attr("column_number"));
            // console.log('column_number: ' + column_number);

            var total_addition = 0;
            $(".addition_column_" + column_number).each(function() {
                if ($(this).val() != '') {
                    total_addition += parseFloat($(this).val());
                }
            });
            $("#sub_total_" + column_number).val(total_addition);

        });

        $(".deduction_sub_total").each(function() {
            var column_number = parseFloat($(this).attr("column_number"));

            if (((".deduction_column_" + column_number))) {
                var total_deduction = 0;
                $(".deduction_column_" + column_number).each(function() {
                    if ($(this).val() != '') {
                        total_deduction += parseFloat($(this).val());
                    }
                });
                $("#sub_total_" + column_number).val(total_deduction);
            }
        });
    </script>

@endpush
