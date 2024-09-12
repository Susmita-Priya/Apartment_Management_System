@extends('master')
@section('content')
    <style>
        b {
            text-transform: capitalize;
        }

        @media print {
            .hidden-print {
                display: none !important;
            }
        }
    </style>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">{{ $page_title }}</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $page_title }}</a></li>
                            <li class="breadcrumb-item active">{{ $page_title }} Report</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="forms p-4">
        <div class="container-fluid">
            <div class="card p-4">
                <div class="card-body mt-2">
                    <h3 class="text-center">Bank Transactions Report</h3>
                </div>
                <form action="{{ route('bank_transaction_report') }}" method="GET">
                    <div class="row mb-3">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label class="d-tc mt-2"><strong>{{ trans('Choose Date') }}</strong> &nbsp;</label>
                                <div class="d-tc">
                                    <div class="input-group">
                                        <input class="form-control" type="date" name="start_date"
                                            value="{{ $start_date ?? '' }}" />
                                        <input class="form-control" type="date" name="end_date"
                                            value="{{ $end_date ?? '' }}" />

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 mt-4">
                            <div class="form-group">
                                <label class="d-tc mt-2"><strong>Transaction Type</strong> &nbsp;</label>
                                <div class="d-tc">
                                    <div class="input-group">

                                        <select name="bank_transaction_type_id" id="bank_transaction_type"
                                            class="form-control">
                                            <option value="">-- Select Here --</option>
                                            @if (isset($bank_transaction_types))
                                                @foreach ($bank_transaction_types as $key => $transaction_type)
                                                    <option value="{{ $transaction_type->id }}"
                                                        @isset($searched_transaction_type_id) {{ $searched_transaction_type_id == $transaction_type->id ? 'selected' : '' }} @endisset>
                                                        {{ $transaction_type->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 mt-4">
                            <div class="form-group">
                                <label class="d-tc mt-2"><strong>{{ trans('Choose Account') }}</strong> &nbsp;</label>
                                <div class="d-tc">
                                    <select id="account_id" name="account_id" class="selectpicker form-control"
                                        data-live-search="true" data-live-search-style="begins">
                                        <option value="0">{{ trans('All account') }}</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                {{ $account->id == $searched_account_id ? 'selected' : '' }}>
                                                {{ $account->account_title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <label for=""></label>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Submit</button>

                                <p class="btn btn-success mt-3" id="click_print" style="color: #fff;">Print</p>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container-fluid">
            <div class="card p-4">
                <div id="print_body">
                    <div class="card-body text-center">
                        {{-- <img src="{{ asset('public/logo') }}/{{ $general_setting->site_logo ?? '' }}" width="100"> --}}
                        <h4 class="text-center">Byte Care Limited</h4>
                        <p>Makka tower(7th floor), kakrail, dhaka, bangladesh</p>

                        <div>
                            <h5 class="text-center text-capitalize">
                                Bank Transaction Report
                            </h5>
                        </div>
                    </div>

                    <div class="mt-3">
                        <b> Transaction Type: </b>
                        {{ $searched_transaction_type->name ?? 'All' }}
                    </div>
                    <div>
                        <b> Account: </b>
                        {{ $searched_account->account_title ?? 'All' }}
                    </div>
                    <div>
                        @if (!empty($start_date) && !empty($end_date) && $start_date == $end_date)
                            <p class="m-0 p-0">
                                <strong>Date:</strong> {{ $start_date }}
                            </p>
                        @elseif (!empty($start_date) && !empty($end_date))
                            <p class="m-0 p-0">
                                <strong>Date:</strong> {{ $start_date }} to {{ $end_date }}
                            </p>
                        @elseif(!empty($start_date))
                            <p class="m-0 p-0">
                                <strong>Date:</strong> {{ $start_date }} to {{ date('Y-m-d') }}
                            </p>
                        @endif
                    </div>


                    <div class="mt-2">
                        <table
                            class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap table-bordered"
                            id="investment-table">
                            <thead>
                                <tr class="text-capitalize">
                                    <th>Date</th>
                                    <th>Account Name</th>
                                    <th>Account Code</th>
                                    <th>Transaction Type</th>
                                    <th>Note</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            @php
                                $total_debit = 0;
                                $total_credit = 0;
                                $balance = 0;
                            @endphp

                            <tbody>
                                @if (!empty($bankTransactions))
                                    @foreach ($bankTransactions as $key => $bank_transaction)
                                        @php
                                            if ($bank_transaction->transaction_type->type == 1) {
                                                $total_debit = $bank_transaction->transaction_amount ?? 0;
                                                $balance -= $bank_transaction->transaction_amount ?? 0;
                                            } else {
                                                $total_credit = $bank_transaction->transaction_amount ?? 0;
                                                $balance += $bank_transaction->transaction_amount ?? 0;
                                            }
                                        @endphp

                                        <tr>
                                            <td>{{ $bank_transaction->transaction_date ?? '' }}</td>
                                            <td>{{ $bank_transaction->account->account_title ?? '' }}</td>
                                            <td>{{ $bank_transaction->account->account_no ?? '' }}</td>
                                            <td>{{ $bank_transaction->transaction_type->name ?? '' }}</td>
                                            <td>{{ $bank_transaction->note ?? '' }}</td>

                                            @if ($bank_transaction->transaction_type->type == 1)
                                                <td>{{ $bank_transaction->transaction_amount ?? 0 }}</td>
                                                <td></td>
                                            @else
                                                <td></td>
                                                <td>{{ $bank_transaction->transaction_amount ?? 0 }}</td>
                                            @endif

                                            <td>{{ $balance }}</td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                            <tfoot>
                                @php
                                    $balance = $total_credit - $total_debit;
                                @endphp
                                <tr class="font-weight-bold">
                                    <td class="text-right" colspan="5">Total: </td>
                                    <td>{{ $total_debit }}</td>
                                    <td>{{ $total_credit }}</td>
                                    <td>{{ $balance }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('js')
    @include('accounts.print_js_code')

    <script type="text/javascript">
        $('#click_print').click(function() {
            $('#print_body').printThis();
        })
    </script>
@endpush
