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
                    <div class="card-box">


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

                            <hr>

                            <form action="{{ route('payroll.update', $payroll->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <input type="hidden" name="submited_year" value="{{ $submited_year ?? '' }}">
                                <input type="hidden" name="submited_month" value="{{ $submited_month ?? '' }}">

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

                                <div>
                                    <table
                                        class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap table-bordered"
                                        cellspacing="0" width="100%" id="print_body">
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

                                                                {{-- hidden --}}
                                                                <input type="hidden" name="employee_id[]"
                                                                    value="{{ $employee->id }}" class="form-control">

                                                                <input type="hidden" name="salary_head_id[]"
                                                                    value="{{ $salary_head->id }}" class="form-control">


                                                                <td>
                                                                    <!-- amount -->
                                                                    <input type="number" name="amount[]"
                                                                        row_number ="{{ $emp_counter }}"
                                                                        column_number ="{{ $column_counter }}"
                                                                        value="{{ $employee_salary->amount ?? '' }}"
                                                                        class="form-control {{ $class_list }}">
                                                                </td>
                                                            @endforeach
                                                        @endif

                                                        <!-- total salary -->
                                                        <th>
                                                            <input type="number" value="{{ $total_salary }}"
                                                                class="form-control total_salary"
                                                                id="total_salary_{{ $emp_counter }}" readonly>
                                                        </th>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2" class="text-right"> Total: </th>
                                                @if (!empty($salary_heads))
                                                    @foreach ($salary_heads as $key => $salary_head)
                                                        @php
                                                            ++$key;
                                                        @endphp
                                                        <th>
                                                            <input type="number"
                                                                class="form-control {{ $salary_head->head_type == 2 ? 'text-danger deduction_sub_total' : 'addition_sub_total' }} "
                                                                id="sub_total_{{ $key }}"
                                                                column_number ="{{ $key }}" readonly>
                                                        </th>
                                                    @endforeach
                                                @endif

                                                <th>
                                                    <input type="number" name="grand_total"
                                                        value="{{ $grand_total ?? 0 }}"
                                                        class="form-control text-primary font-weight-bold" id="grand_total"
                                                        readonly>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')
    {{-- ------------------------ sub-total calculation --------------------- --}}
    <script>
        $('.addition,.deduction').on('change', function() {
            var amount = $(this).val();
            var row_number = $(this).attr("row_number");

            // console.log('row_number: ' + row_number);

            var total = 0;
            $(".addition_row_" + row_number).each(function() {
                if ($(this).val() != '') {
                    total += parseFloat($(this).val());
                }
            });
            $(".deduction_row_" + row_number).each(function() {
                if ($(this).val() != '') {
                    total -= parseFloat($(this).val());
                }
            });
            $("#total_salary_" + row_number).val(total);
        });
    </script>


    {{-- ------------------------ grand_total calculation --------------------- --}}
    <script>
        $('.addition,.deduction').on('change', function() {
            // grand-total
            var total_payable = 0;
            $(".total_salary").each(function() {
                // alert('ok');
                if ($(this).val() != '') {
                    total_payable += parseFloat($(this).val());
                }
            });
            $("#grand_total").val(total_payable);
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


    {{-- --------------------- after trigger event - calculate addition and deduction amount ------------------------ --}}
    <script>
        $('.addition').on('change', function() {
            var amount = $(this).val();
            var column_number = $(this).attr("column_number");

            var total = 0;
            $(".addition_column_" + column_number).each(function() {
                if ($(this).val() != '') {
                    total += parseFloat($(this).val());
                }
            });

            $("#sub_total_" + column_number).val(total);
        });
    </script>

    <script>
        $('.deduction').on('change', function() {
            var amount = $(this).val();
            var column_number = $(this).attr("column_number");

            var total = 0;
            $(".deduction_column_" + column_number).each(function() {
                if ($(this).val() != '') {
                    total += parseFloat($(this).val());
                }
            });

            $("#sub_total_" + column_number).val(total);

        });
    </script>
@endpush
