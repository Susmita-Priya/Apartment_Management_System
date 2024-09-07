@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
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
            <!-- end row -->
            
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div style="margin:0 14px; ">
                            <form action="{{ route('general-ledger-report') }}" method="GET">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" name="start_date" value="{{ $start_date ?? '' }}"
                                                class="form-control" id="start_date">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="end_date">End Date</label>
                                            <input type="date" name="end_date" value="{{ $end_date ?? '' }}"
                                                class="form-control" id="end_date">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="account_group_id">Account Group</label>
                                            <select name="account_group_id" class="form-control" id="account_group_id">
                                                <option value="">Slect One</option>
                                                @if (!empty($account_groups))
                                                    @foreach ($account_groups as $key => $account_group)
                                                        <option value="{{ $account_group->id ?? '' }}"
                                                            group_type="{{ $account_group->group_type ?? 0 }}"
                                                            @isset($searched_account_group_id) {{ $searched_account_group_id == $account_group->id ? 'selected' : '' }} @endisset>
                                                            {{ $account_group->name ?? '' }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <label class="text-white">dd</label>
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-info mr-2 rounded">Submit</button>
                                            <a href="#" class="btn btn-primary rounded" id="click_print">
                                                <i class="fa fa-print"></i>
                                                Print
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <table
                            class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap table-bordered"
                            cellspacing="0" width="100%" id="print_body">
                            <thead>
                                <tr>
                                    <td colspan="7">
                                        <div class="text-center">
                                            <h4>Byte Care Limited</h4>
                                            <p>Makka tower(7th floor), kakrail, dhaka, bangladesh</p>
                                            <h5>{{ $page_title }}</h5>
                                        </div>
                                        @if (!empty($searched_account_group))
                                            <p class="m-0 p-0">
                                                <strong> Account Group:</strong> {{ $searched_account_group->name ?? '' }}
                                            </p>
                                        @else
                                            <p class="m-0 p-0">
                                                <strong> Account Group:</strong> All
                                            </p>
                                        @endif


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
                                    </td>
                                </tr>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Particulars</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            @php
                                $total_debit = 0;
                                $total_credit = 0;
                                $balance = 0 + ($previous_balance ?? 0);
                            @endphp
                            <tbody>
                                {{-- <tr>
                                    <td colspan="5" class="text-right font-weight-bold">Previous Balance: </td>
                                    <td>{{ $previous_balance ?? 0 }}</td>
                                </tr> --}}
                                @if (!empty($journal_entry_details))
                                    @foreach ($journal_entry_details as $key => $journal_entry_detail)
                                        @php
                                            $total_debit += $journal_entry_detail->debit ?? 0;
                                            $total_credit += $journal_entry_detail->credit ?? 0;
                                            if (!empty($journal_entry_detail->credit)) {
                                                $balance += $journal_entry_detail->credit ?? 0;
                                            } else {
                                                $balance -= $journal_entry_detail->debit ?? 0;
                                            }
                                        @endphp
                                        <tr>
                                            <td scope="row">{{ ++$key }}</td>
                                            <td scope="row">{{ $journal_entry_detail->entry_date ?? '' }}</td>
                                            <td>
                                                <strong> Account: </strong>
                                                {{ $journal_entry_detail->account->account_title ?? '' }}
                                                ({{ $journal_entry_detail->account->account_no ?? '' }})
                                                ,

                                                <strong> Account Group: </strong>
                                                {{ $journal_entry_detail->account_group->name ?? '' }}


                                            </td>

                                            <td>{{ $journal_entry_detail->debit ?? '' }}</td>
                                            <td>{{ $journal_entry_detail->credit ?? '' }}</td>
                                            <td>{{ $balance }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right"> Total: </th>
                                    <th>{{ number_format($total_debit) }}</th>
                                    <th>{{ number_format($total_credit) }}</th>
                                    <th>{{ number_format($balance) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')
    @include('accounts.print_js_code')

    <script type="text/javascript">
        $('#click_print').click(function() {
            $('#print_body').printThis();
        })
    </script>
@endpush
