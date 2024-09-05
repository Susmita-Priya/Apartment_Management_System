@extends('master')
@section('content')
    @php
        $route = route('journal-entry.update', $journal_entry->id);
        $page_title_prefix = 'Create';
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
                    <div class="page-title-box">
                        <h4 class="page-title float-left">{{ $page_title }}</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $page_title }}</a></li>
                            <li class="breadcrumb-item active">{{ $page_title_prefix }} {{ $page_title }}</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            @include('accounts.alert_message')

            <!-- end row -->
            <div class="row">
                <div class="col-md-2"><a href="{{ route('journal-entry.index') }}" class="btn btn-success"><i
                            class="fa fa-list"></i> Go To {{ $page_title }} List</a></div>
                <div class="col-md-8">
                    <div class="card-box">
                        <div id="print_body" style="background-color:white">
                            <div class="text-center">
                                <div class="d-flex justify-content-center">
                                    {{-- <img src="#" alt="logo" style="width:120px"> --}}
                                    <h4>Byte Care Limited</h4>
                                </div>
                                <p>Makka tower(7th floor), kakrail, dhaka, bangladesh</p>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">

                                    <p> <strong class="text-capitalize">date: </strong>
                                        {{ $journal_entry->entry_date ?? '' }}

                                        <br>

                                        <strong class="text-capitalize">journal code: </strong>
                                        {{ $journal_entry->journal_code ?? '' }}

                                        
                                        <br>
                                        
                                        <strong class="text-capitalize">posted by: </strong>
                                        {{ $journal_entry->data_inputed_by->name ?? '' }}

                                        <br>

                                        <strong class="text-capitalize">description: </strong>
                                        {{ $journal_entry->remarks ?? '' }}

                                    </p>
                                </div>
                                <div class="form-group col-md-6"></div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5> Transactions: </h5>
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Account *</th>
                                                <th>Account Group *</th>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                            </tr>
                                        </thead>

                                        <tbody class="tbody">
                                            @if (!empty($journal_entry->journal_entry_details))
                                                @foreach ($journal_entry->journal_entry_details as $key => $journal_entry_detail)
                                                    <tr>
                                                        <td> {{ $journal_entry_detail->account->account_title ?? null }}
                                                        </td>

                                                        <td>{{ $journal_entry_detail->account_group->name ?? null }}</td>
                                                        <td>
                                                            {{ $journal_entry_detail->debit ?? null }}
                                                        </td>
                                                        <td>
                                                            {{ $journal_entry_detail->credit ?? null }}
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
                </div>

                <div class="col-md-2">
                    <a href="#" class="btn btn-primary" id="click_print">
                        <i class="fa fa-print"></i>
                        Print
                    </a>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection

@push('js')
    @include('accounts.print_js_code')

    <script type="text/javascript">
        $('#click_print').click(function() {
            $('#print_body').printThis();
        })
    </script>
@endpush
