
@extends('master')
@section('content')
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
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $page_title }}</a></li>
                            <li class="breadcrumb-item active">Update {{ $page_title }}</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>



            <!-- end row -->
            <div class="row">
                <div class="col-md-2"><a href="{{ route('bank_transaction.index') }}" class="btn btn-success text-capitalize"><i
                            class="fa fa-list"></i> Go To {{ $page_title }} List</a></div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="row p-3 justify-content-center">
                            {{-- bank Transaction --}}
                            <div class="col-12 col-lg-12">
                                <h5 class="text-center p-2 text-success card_title_change">Update Bank Transaction Data</h5>
                                <div class="p-1 bank_transaction_edit">
                                    <form action="{{ route('bank_transaction.update', $bank_transaction->id) }}" method="POST" id="bank_transaction_form">
                                        @csrf
                                        @method('PUT')
                                    
                                    
                                        <input type="hidden" name="updated_by" value="{{ Auth::user()->id ?? 0 }}">
                                        <input type="hidden" class="preveous_transaction_type" value="{{ $bank_transaction->bank_transaction_type_id ?? 0 }}">
                                        <input type="hidden" class="preveous_account_id" value="{{ $bank_transaction->account_id ?? 0 }}">
                                        <input type="hidden" class="previous_transaction_amount" value="{{ $bank_transaction->transaction_amount ?? '' }}">
                                    
                                        <div class="form-group row">
                                            <label class="col-3">Date: </label>
                                            <div class="col-8">
                                                <input type="date" name="transaction_date" value="{{ $bank_transaction->transaction_date ?? date('Y-m-d') }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3">Accounts: </label>
                                            <div class="col-8">
                                                <select name="account_id" id="account_id" class="form-control" required>
                                                    <option value="">-- Select Here --</option>
                                                    @forelse ($accounts as $account)
                                                        <option value="{{ $account->id }}" @isset($bank_transaction->account_id) {{ $account->id == $bank_transaction->account_id ? 'selected' : '' }} @endisset>
                                                            {{ $account->account_title }}
                                                        </option>
                                                    @empty
                                                        <option value="">no data</option>
                                                    @endforelse
                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3">transaction type: </label>
                                            <div class="col-8">
                                                
                                                <select name="bank_transaction_type_id" id="bank_transaction_type"
                                                    class="form-control">
                                                    <option value="">-- Select Here --</option>
                                                    @if (isset($bank_transaction_types))
                                                        @foreach ($bank_transaction_types as $key => $transaction_type)
                                                            <option value="{{ $transaction_type->id }}"
                                                                @isset($bank_transaction->bank_transaction_type_id) {{ $bank_transaction->bank_transaction_type_id == $transaction_type->id ? 'selected' : '' }} @endisset>
                                                                {{ $transaction_type->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    
                                    
                                        <div class="form-group row">
                                            <label class="col-3">amount: </label>
                                            <div class="col-8">
                                                <input type="number" name="transaction_amount" value="{{ $bank_transaction->transaction_amount ?? '' }}"
                                                    class="form-control transaction_amount" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-3">Note: </label>
                                            <div class="col-8">
                                                <textarea name="note" cols="30" rows="3" class="form-control">{{ $bank_transaction->note ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 d-flex justify-content-end">
                                                <button class="btn btn-success btn-sm investment_submit_button">Submit &rarr; </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4"></div>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    </div>
@endsection
