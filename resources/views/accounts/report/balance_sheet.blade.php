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
            @include('accounts.alert_message')
            <div class="row">
                <div class="col-12">
                    <div class="card-header bg-white d-flex justify-content-end mb-3">
                        <a href="#" class="btn btn-primary rounded" id="click_print">
                            <i class="fa fa-print"></i>
                            Print
                        </a>
                    </div>
                    <div class="card-box">
                        <table
                            class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap table-bordered"
                            cellspacing="0" width="100%" id="print_body">
                            <thead>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <h4>Byte Care Limited</h4>
                                        <p>Makka tower(7th floor), kakrail, dhaka, bangladesh</p>
                                        
                                        <h5>{{ $page_title }}</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <th>SL</th>
                                    <th>Account</th>
                                    <th>Account Number</th>
                                    {{-- <th>Debit</th>
                                    <th>Credit</th> --}}
                                    <th>Balance</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (!empty($accounts))
                                    @foreach ($accounts as $key => $account)
                                        @php
                                            $total_debit = App\Models\Accounts\JournalEntryDetail::where([
                                                'account_id' => $account->id,
                                            ]) ->sum('debit');

                                            $total_credit = App\Models\Accounts\JournalEntryDetail::where([
                                                'account_id' => $account->id,
                                            ])->sum('credit');

                                            $balance = $total_credit - $total_debit;
                                        @endphp
                                        <tr>
                                            <td scope="row">{{ ++$key }}</td>
                                            <td>{{ $account->account_title ?? '' }}</td>
                                            <td>{{ $account->account_no ?? '' }}</td>
                                            {{-- <td>{{ $total_debit }}</td>
                                            <td>{{ $total_credit }}</td> --}}
                                            <td>{{ $balance }}</td>
                                    @endforeach
                                @endif

                                </tr>

                            </tbody>
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