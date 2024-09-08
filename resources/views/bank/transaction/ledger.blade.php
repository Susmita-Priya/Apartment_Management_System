@extends('layout.main')
@section('content')
    @if (session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}
        </div>
    @endif
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

    <section class="forms p-4">
        <div class="container-fluid">
            <div class="card p-4">
                <div class="card-header mt-2">
                    <h3 class="text-center">Bank Ledger</h3>
                </div>
                {!! Form::open(['route' => 'bank-ledger-search', 'method' => 'post']) !!}
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
                            <label class="d-tc mt-2"><strong>{{ trans('Choose Account') }}</strong> &nbsp;</label>
                            <div class="d-tc">
                                <select id="account_id" name="account_id" class="selectpicker form-control"
                                    data-live-search="true" data-live-search-style="begins">
                                    <option value="0">{{ trans('All account') }}</option>
                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->id }}"
                                            {{ $account->id == $searched_account_id ? 'selected' : '' }}>
                                            {{ $account->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <label for=""></label>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">{{ trans('file.submit') }}</button>
                            <button
                                class="btn btn-warning"onclick='exportTableToCSV("ledger_report_{{ date('Y_m_d') }}.csv")'>
                                Export To CSV
                            </button>
                            <p class="btn btn-success mt-3" id="click_print" style="color: #fff;">Print</p>

                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="container-fluid" id="print_page">
            <div class="card p-4">
                <div class="card-header text-center">
                    <img src="{{ asset('public/logo') }}/{{ $general_setting->site_logo ?? '' }}" width="100">
                    <div class="text-center">{{ $general_setting->site_title ?? '' }}</div>
                    <div>{{ $general_setting->phone ?? '' }}</div>
                    <div>{{ $general_setting->email ?? '' }}</div>
                    <div>({{ $general_setting->address ?? '' }})</div>
                    <div>
                        @if (isset($start_date) || isset($end_date))
                            ({{ $start_date . ' - ' . $end_date ?? '' }})
                        @else
                            {{ $today }}
                        @endif

                    </div> <br>
                    <div>
                        <h3 class="text-center">
                            {{ $searched_account->name ?? 'All' }}
                            - Bank Ledger
                        </h3>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-sm table-striped  text-center" id="investment-table">
                        <thead>
                            <tr class="text-capitalize">
                                <th>Date </th>
                                <th>Account</th>
                                <th>Transaction details</th>
                                <th>credit</th>
                                <th>debit</th>
                                <th>balance</th>
                            </tr>
                        </thead>
                        @php
                            $credit = 0;
                            $debit = 0;
                            $balance = $previous_balance ?? 0;
                        @endphp
                        <tbody>
                            <tr>
                                <td colspan="5" class="text-left">Previous balance </td>
                                <td class="text-right">{{ number_format($previous_balance ?? 0) }}</td>
                            </tr>
                            {{-- sales --}}
                            @if (isset($sales_by_bank))
                                @php
                                    $sale_amount = 0;
                                @endphp
                                @foreach ($sales_by_bank as $data)
                                    @php
                                        $date = substr($data->created_at, 0, 11) ?? '';
                                        $account = ($data->account->name ?? '') . '-' . ($data->account->account_no ?? '');
                                        $tansaction_details = ('Reference: ' . $data->payment_reference ?? '-') . (', ' . $data->sale->customer->name ?? '') . (', Note: ' . $data->payment_note ?? '-');
                                        $sale_amount += $data->amount;
                                        $balance += $data->amount;
                                    @endphp

                                    <tr>
                                        <td>{{ $date }}</td>
                                        <td>
                                            {{ $account }}
                                        </td>
                                        <td class="text-left">{{ $tansaction_details }}</td>
                                        <td>{{ $data->amount ?? 0 }}</td>
                                        <td>0</td>

                                        <td class="text-right">{{ number_format($balance ?? 0) }}</td>
                                    </tr>
                                @endforeach
                                @php
                                    $credit += $sale_amount;
                                    $debit += 0;
                                @endphp
                            @endif

                            {{-- purchase --}}
                            @if (isset($purchases_by_bank))
                                @foreach ($purchases_by_bank as $data)
                                    @php
                                        $purchase_amount = 0;
                                    @endphp
                                    @php
                                        $account = ($data->account->name ?? '') . '-' . ($data->account->account_no ?? '');

                                        $tansaction_details = ('Reference: ' . $data->payment_reference ?? '-') . (' ,' . $data->purchase->supplier->name ?? '') . (', Note: ' . $data->payment_note ?? '-');

                                        $purchase_amount += $data->amount;
                                        $balance -= $data->amount;
                                    @endphp

                                    <tr>
                                        <td>{{ substr($data->created_at, 0, 11) ?? '' }}</td>
                                        <td>
                                            {{ $account }}
                                        </td>
                                        <td class="text-left">{{ $tansaction_details }}</td>
                                        <td>0</td>
                                        <td>{{ $data->amount ?? 0 }}</td>

                                        <td class="text-right">{{ number_format($balance ?? 0) }}</td>
                                    </tr>

                                    @php
                                        $credit += 0;
                                        $debit += $purchase_amount;
                                    @endphp
                                @endforeach
                            @endif

                            {{-- cash_transaction --}}
                            @if (isset($cash_transaction_by_bank))
                                @php
                                    $receive_amount = 0;
                                    $payment_amount = 0;
                                    $total_cash_tran_by_bank = 0;
                                @endphp

                                @foreach ($cash_transaction_by_bank as $data)
                                    @php
                                        $account = ($data->account->name ?? '') . '-' . ($data->account->account_no ?? '');

                                        $tansaction_details = ($data->accountHead->account_name ?? '') . (' , ' . $data->description ?? '-');
                                    @endphp

                                    <tr>
                                        <td>{{ $data->transaction_date ?? '' }}</td>
                                        <td>
                                            {{ $account }}
                                        </td>
                                        <td class="text-left">Cash Transact : {{ $tansaction_details }}</td>
                                        @if ($data->transaction_type == 1)
                                            @php
                                                $receive_amount += $data->transaction_amount;
                                                $total_cash_tran_by_bank += $data->transaction_amount;
                                            @endphp
                                            <td>{{ $data->transaction_amount }}</td>
                                            <td></td>
                                        @else
                                            @php
                                                $payment_amount += $data->transaction_amount;
                                                $total_cash_tran_by_bank -= $data->transaction_amount;
                                            @endphp
                                            <td></td>
                                            <td>{{ $data->transaction_amount }}</td>
                                        @endif
                                        @php
                                            $transect_balance = $receive_amount - $payment_amount;
                                        @endphp
                                        <td class="text-right">
                                            {{ number_format($balance + $total_cash_tran_by_bank) }}
                                        </td>
                                    </tr>
                                @endforeach
                                @php
                                    $credit += $receive_amount;
                                    $debit += $payment_amount;
                                    $balance += $total_cash_tran_by_bank;
                                @endphp
                            @endif

                            {{-- bank transaction --}}
                            @if (isset($bankTransactions))
                                @php
                                    $deposit = 0;
                                    $withdraw = 0;
                                    $total_bank_transection = 0;
                                @endphp
                                @foreach ($bankTransactions as $bank)
                                    @php
                                        $date = $bank->transaction_date ?? '';

                                        $account = ($bank->account->name ?? '') . '-' . ($bank->account->account_no ?? '');

                                        $tansaction_details = $bank->note ?? '-';

                                    @endphp

                                    <tr>
                                        <td>{{ $date }}</td>
                                        <td>
                                            {{ $account }}
                                        </td>
                                        <td class="text-left">Bank Transact : {{ $tansaction_details }}</td>

                                        @if ($bank->transaction_type == 1)
                                            @php
                                                $deposit += $bank->transaction_amount;
                                                $total_bank_transection += $bank->transaction_amount;

                                            @endphp
                                            <td>{{ $bank->transaction_amount }}
                                            </td>
                                            <td></td>
                                        @elseif ($bank->transaction_type == 2)
                                            @php
                                                $total_bank_transection -= $bank->transaction_amount;
                                                $withdraw += $bank->transaction_amount;

                                            @endphp
                                            <td></td>
                                            <td>{{ $bank->transaction_amount }}</td>
                                        @endif


                                        <td class="text-right">{{ number_format($balance + $total_bank_transection) }}
                                        </td>
                                    </tr>
                                @endforeach
                                @php
                                    $credit += $deposit;
                                    $debit += $withdraw;
                                    $balance += $total_bank_transection;

                                @endphp
                            @endif

                            {{-- investment --}}
                            @if (isset($investments_by_bank))
                                @php
                                    $profit = 0;
                                    $receive = 0;
                                    $payment = 0;
                                    $total_investment_balance = 0;
                                @endphp
                                @foreach ($investments_by_bank as $data)
                                    <tr>
                                        <td>{{ $data->investment_date ?? '' }}</td>
                                        <td>
                                            {{ ($data->account->name ?? '') . '-' . ($data->account->account_no ?? '') }}
                                        </td>
                                        <td class="text-left">invest : {{ $data->investor->name ?? '' }}
                                            ,{{ $data->investment_note ?? '-' }}</td>

                                        @if ($data->transaction_type == 1)
                                            @php
                                                $profit += $data->investment_amount;
                                                $total_investment_balance += $data->investment_amount;
                                            @endphp
                                            <td>{{ $data->investment_amount }}</td>
                                            <td></td>
                                        @elseif ($data->transaction_type == 2)
                                            @php
                                                $receive += $data->investment_amount;
                                                $total_investment_balance += $data->investment_amount;
                                            @endphp
                                            <td>{{ $data->investment_amount }}</td>
                                            <td></td>
                                        @else
                                            @php
                                                $payment += $data->investment_amount;
                                                $total_investment_balance -= $data->investment_amount;
                                            @endphp
                                            <td></td>
                                            <td>{{ $data->investment_amount }}</td>
                                        @endif

                                        <td class="text-right">{{ number_format($balance + $total_investment_balance) }}
                                        </td>
                                    </tr>
                                @endforeach
                                @php
                                    $credit += $profit + $receive;
                                    $debit += $payment;
                                    $balance += $total_investment_balance;
                                @endphp
                            @endif

                            {{-- asset entry --}}
                            @if (isset($asset_entry_by_bank))
                                @php
                                    $asset_entry_amount = 0;
                                    $asset_sale_amount = 0;
                                    $total_asset_balance = 0;
                                @endphp
                                @foreach ($asset_entry_by_bank as $data)
                                    <tr>
                                        <td>{{ $data->date ?? '' }}</td>
                                        <td>
                                            {{ ($data->account->name ?? '') . '-' . ($data->account->account_no ?? '') }}
                                        </td>
                                        <td class="text-left">Asset : {{ $data->asset_name ?? '' }} ,
                                            {{ $data->asset_note ?? '-' }}</td>
                                        @if ($data->asset_type == 2)
                                            @php
                                                $asset_sale_amount += $data->asset_amount;
                                                $total_asset_balance += $data->asset_amount;
                                            @endphp
                                            <td>{{ $data->asset_amount }}</td>
                                            <td></td>
                                        @elseif ($data->asset_type == 1)
                                            @php
                                                $asset_entry_amount += $data->asset_amount;
                                                $total_asset_balance -= $data->asset_amount;
                                            @endphp
                                            <td></td>
                                            <td>{{ $data->asset_amount }}</td>
                                        @endif

                                        <td class="text-right">{{ number_format($balance + $total_asset_balance) }}</td>
                                    </tr>
                                @endforeach
                                @php
                                    $credit += $asset_sale_amount;
                                    $debit += $asset_entry_amount;
                                    $balance += $total_asset_balance;
                                @endphp
                            @endif

                            {{-- payrolls --}}
                            @if (isset($payrolls_by_bank))
                                @php
                                    $payroll_amount = 0;
                                @endphp
                                @foreach ($payrolls_by_bank as $data)
                                    @php
                                        $payroll_amount += $data->amount;
                                    @endphp
                                    <tr>
                                        <td>{{ substr($data->created_at, 0, 11) ?? '' }}</td>
                                        <td>
                                            {{ ($data->account->name ?? '') . '-' . ($data->account->account_no ?? '') }}
                                        </td>
                                        <td class="text-left">Payroll :
                                            {{ 'Ref: ' . ($data->reference_no ?? '-') . (' , ' . $data->employee->name ?? '') . ', Note:' . ($data->note ?? '-') }}
                                        </td>
                                        <td></td>
                                        <td>{{ $data->amount }}</td>
                                        @php
                                            $balance -= $data->amount;
                                        @endphp

                                        <td class="text-right">{{ number_format($balance) }}</td>
                                    </tr>
                                @endforeach
                                @php
                                    $credit += 0;
                                    $debit += $payroll_amount;
                                @endphp
                            @endif

                            {{-- customer_deposits_by_bank --}}
                            @if (isset($customer_deposits_by_bank))
                                @php
                                    $deposit_amount = 0;
                                @endphp
                                @foreach ($customer_deposits_by_bank as $data)
                                    @php
                                        $deposit_amount += $data->amount;
                                    @endphp
                                    <tr>
                                        <td>{{ substr($data->created_at, 0, 11) ?? '' }}</td>
                                        <td>
                                            {{ ($data->account->name ?? '') . '-' . ($data->account->account_no ?? '') }}
                                        </td>
                                        <td class="text-left">Deposit : {{ $data->customer->name ?? '' }} ,
                                            {{ $data->note ?? '-' }}
                                        </td>
                                        <td>{{ $data->amount }}</td>
                                        <td></td>
                                        @php
                                            $balance += $data->amount;
                                        @endphp
                                        <td class="text-right">{{ number_format($balance) }}</td>
                                    </tr>
                                @endforeach
                                @php
                                    $credit += $deposit_amount;
                                    $debit += 0;
                                @endphp
                            @endif

                            {{-- supplier_advance_by_bank --}}
                            @if (isset($supplier_advance_by_bank))
                                @php
                                    $supp_advance_amount = 0;
                                @endphp
                                @foreach ($supplier_advance_by_bank as $data)
                                    @php
                                        $supp_advance_amount += $data->amount;
                                    @endphp
                                    <tr>
                                        <td>{{ substr($data->created_at, 0, 11) ?? '' }}</td>

                                        <td class="text-left">
                                            {{ ($data->account->name ?? '') . '-' . ($data->account->account_no ?? '') }}
                                        </td>
                                        <td>Advance : {{ $data->supplier->name ?? '' }} ,
                                            {{ $data->note ?? '-' }}</td>
                                        <td></td>
                                        <td>{{ $data->amount }}</td>
                                        @php
                                            $balance -= $data->amount;
                                        @endphp
                                        <td class="text-right">{{ number_format($balance) }}</td>
                                    </tr>
                                @endforeach
                                @php
                                    $credit += 0;
                                    $debit += $supp_advance_amount;
                                @endphp
                            @endif

                            {{-- sale_returns --}}
                            @if (isset($sale_returns))
                                @php
                                    $sale_return_amount = 0;
                                @endphp
                                @foreach ($sale_returns as $data)
                                    @php
                                        $sale_return_amount += $data->grand_total;
                                    @endphp
                                    <tr>
                                        <td>{{ substr($data->created_at, 0, 11) ?? '' }}</td>
                                        <td>
                                            {{ ($data->account->name ?? '') . '-' . ($data->account->account_no ?? '') }}
                                        </td>
                                        <td class="text-left">
                                            Sale Return :
                                            {{ 'Ref: ' . ($data->reference_no ?? '-') . (' ,' . $data->customer->name ?? '') . ', Note:' . ($data->return_note ?? '-') }}
                                        </td>
                                        <td></td>
                                        <td>{{ $data->grand_total }}</td>

                                        @php
                                            $balance -= $data->grand_total;
                                        @endphp
                                        <td class="text-right">{{ number_format($balance) }}</td>
                                    </tr>
                                @endforeach
                                @php
                                    $credit += 0;
                                    $debit += $sale_return_amount;
                                @endphp
                            @endif

                            {{-- purchase_returns --}}
                            @if (isset($purchase_returns))
                                @php
                                    $purchase_return_amount = 0;
                                @endphp
                                @foreach ($purchase_returns as $data)
                                    @php
                                        $purchase_return_amount += $data->grand_total;
                                    @endphp
                                    <tr>
                                        <td>{{ substr($data->created_at, 0, 11) ?? '' }}</td>
                                        <td>
                                            {{ ($data->account->name ?? '') . '-' . ($data->account->account_no ?? '') }}
                                        </td>
                                        <td class="text-left">
                                            Purchase Return :
                                            {{ 'Ref: ' . ($data->reference_no ?? '-') . (',' . $data->supplier->name ?? '') . ', Note:' . ($data->return_note ?? '-') }}
                                        </td>
                                        <td>{{ $data->grand_total }}</td>
                                        <td></td>
                                        @php
                                            $balance += $data->grand_total;
                                        @endphp
                                        <td class="text-right">{{ number_format($balance) }}</td>
                                    </tr>
                                @endforeach
                                @php
                                    $credit += $purchase_return_amount;
                                    $debit += 0;
                                @endphp
                            @endif
                            {{-- ------------------- new added below at 24 january 2024 ---------------- --}}
                            {{-- sent_money_via_transfer --}}
                            @if (isset($sent_money_via_transfer))
                                @php
                                    $sended_amount = 0;
                                @endphp
                                @foreach ($sent_money_via_transfer as $data)
                                    @php
                                        $sended_amount += $data->amount;
                                    @endphp
                                    <tr>
                                        <td>{{ substr($data->created_at, 0, 11) ?? '' }}</td>
                                        <td>
                                            {{ ($data->account->name ?? '') . '-' . ($data->account->account_no ?? '') }}
                                        </td>
                                        <td class="text-left">
                                            Money Transfer From :
                                            {{ 'Ref: ' . ($data->reference_no ?? '-') . ' Note:' . ($data->return_note ?? '-') }}
                                        </td>
                                        <td></td>
                                        <td>{{ $data->amount }}</td>
                                        @php
                                            $balance -= $data->amount;
                                        @endphp
                                        <td class="text-right">{{ number_format($balance) }}</td>
                                    </tr>
                                @endforeach
                                @php
                                    $credit += 0;
                                    $debit += $sended_amount;
                                @endphp
                            @endif

                            {{-- recieved_money_via_transfer --}}
                            @if (isset($recieved_money_via_transfer))
                                @php
                                    $received_amount = 0;
                                @endphp
                                @foreach ($recieved_money_via_transfer as $data)
                                    @php
                                        $received_amount += $data->amount;
                                    @endphp
                                    <tr>
                                        <td>{{ substr($data->created_at, 0, 11) ?? '' }}</td>
                                        <td>
                                            {{ ($data->account->name ?? '') . '-' . ($data->account->account_no ?? '') }}
                                        </td>
                                        <td class="text-left">
                                            Money Transfer To :
                                            {{ 'Ref: ' . ($data->reference_no ?? '-') . ' Note:' . ($data->return_note ?? '-') }}
                                        </td>
                                        <td>{{ $data->amount }}</td>
                                        <td></td>
                                        @php
                                            $balance += $data->amount;
                                        @endphp
                                        <td class="text-right">{{ number_format($balance) }}</td>
                                    </tr>
                                @endforeach
                                @php
                                    $credit += $received_amount;
                                    $debit += 0;
                                @endphp
                            @endif


                        </tbody>

                        <tfoot>
                            <tr>
                                <td class="text-right" colspan="3">Total Amount: </td>
                                <td>{{ number_format($credit ?? 0) }}</td>
                                <td>{{ number_format($debit ?? 0) }}</td>
                                <td class="text-right">{{ number_format($balance ?? 0) }}</td>
                            </tr>

                            {{--  @php
                                $number = $balance;
                                $digit = new NumberFormatter('en', NumberFormatter::SPELLOUT);
                                $word = $digit->format($number);
                            @endphp
                           <tr>
                                <td style="border-style: none;"></td>
                            </tr>

                            <tr>
                                <td colspan="6" class="text-capitalize border">
                                    Total Balance: {{ $balance ?? 0 }} <br>
                                    In Word: {{ $word }} Taka Only
                                    <br>
                                </td>
                            </tr> --}}
                        </tfoot>
                    </table>
                    <table style="width: 50%; float: right">
                        <thead>

                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $("ul#account").siblings('a').attr('aria-expanded', 'true');
            $("ul#account").addClass("show");
            $("#bank-transaction-ledger-menu").addClass("active");
        });
    </script>


    <script src="{{ asset('public/js/printThis.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $('#click_print').click(function() {
            $('#print_page').printThis();
        });

        function downloadCSV(csv, filename) {
            var csvFile;
            var downloadLink;

            // CSV file
            csvFile = new Blob([csv], {
                type: "text/csv"
            });

            // Download link
            downloadLink = document.createElement("a");

            // File name
            downloadLink.download = filename;

            // Create a link to the file
            downloadLink.href = window.URL.createObjectURL(csvFile);

            // Hide download link
            downloadLink.style.display = "none";

            // Add the link to DOM
            document.body.appendChild(downloadLink);

            // Click download link
            downloadLink.click();
        }

        function exportTableToCSV(filename) {
            var csv = [];
            var rows = document.querySelectorAll("table tr");

            for (var i = 0; i < rows.length; i++) {
                var row = [],
                    cols = rows[i].querySelectorAll("td, th");

                for (var j = 0; j < cols.length; j++)
                    row.push("\"" + cols[j].innerText + "\"");

                csv.push(row.join(","));
            }

            // Download CSV file
            downloadCSV(csv.join("\n"), filename);
        };
    </script>
@endsection
