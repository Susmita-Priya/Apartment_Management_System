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
                    <div class="card py-2">
                        <div class="card-head">
                            <form action="{{ route('bank_transaction.index') }}" method="GET">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input type="date" class="form-control" name="start_date"
                                                    value="{{ $start_date ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input type="date" class="form-control" name="end_date"
                                                    value="{{ $end_date ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Transaction Type </label>
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

                                        <div class="col-lg-2 mt-4">
                                            <button type="submit" class="mt-2 btn btn-primary">Show</button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-box">
                        <div style="display:flex; justify-content:space-between;margin:0 14px; ">
                            <h4 class="header-title m-b-15 m-t-0">{{ $page_title }} List</h4>
                            <h4 class="header-title m-b-15 m-t-0">
                                <a href="{{ route('bank_transaction.create') }}" class="btn btn-success">Add data</a>
                            </h4>
                        </div>

                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap"
                            cellspacing="0" width="100%" id="datatable">
                            <thead class="text-capitalize">
                                <tr>
                                    <th class="not-exported">SL</th>
                                    <th>Date</th>
                                    <th>account</th>
                                    <th>account number</th>
                                    <th>transaction type</th>
                                    <th>amount</th>
                                    <th>note</th>
                                    <th class="not-exported">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($bankTransactions))
                                    @forelse($bankTransactions as $key=>$bank_transaction)
                                        <tr class="{{ $bank_transaction->transaction_type->type == 1 ? 'text-danger' : '' }}">
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $bank_transaction->transaction_date ?? '' }}</td>
                                            <td>{{ $bank_transaction->account->account_title ?? '' }}</td>
                                            <td>{{ $bank_transaction->account->account_no ?? '' }}</td>
                                            <td>
                                                {{ $bank_transaction->transaction_type->name ?? '' }}
                                            </td>
                                            <td>{{ $bank_transaction->transaction_amount ?? 0 }}</td>
                                            <td>{{ $bank_transaction->note ?? '' }}</td>

                                            <td>
                                                <div class="btn-group dropdown">
                                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="mdi mdi-dots-horizontal"></i></a>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                        <a href="{{ route('bank_transaction.edit', $bank_transaction->id) }}"
                                                            class="dropdown-item btn btn-link">
                                                            <i class="dripicons-document-edit"></i>
                                                            Edit
                                                        </a>

                                                        <a href="{{ route('bank_transaction.delete', $bank_transaction->id) }}"
                                                            class="dropdown-item btn btn-link"
                                                            onclick="return confirm('Are You Sure To Delete It ? ')">
                                                            <i class="dripicons-trash"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center text-danger">
                                            <td colspan="8"> Data do not Found </td>
                                        </tr>
                                    @endforelse
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
