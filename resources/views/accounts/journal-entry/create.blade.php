@extends('master')
@section('content')
    @php
        $route = route('journal-entry.store');
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

            

            <!-- end row -->
            <div class="row">

                <div class="col-md-2"> <a href="{{ route('journal-entry.index') }}" class="btn btn-success"><i class="fa fa-list"></i> Go To {{ $page_title }} List</a> </div>

                <div class="col-md-8">
                    <form action="{{ $route }}" enctype="multipart/form-data" method="POST">
                        {{-- @method('PUT') --}}
                        @csrf

                        <div class="card-box">
                            <h4 class="d-flex justify-content-center my-2">{{ $page_title_prefix }} {{ $page_title }}</h4>

                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="journal_code" class="col-form-label">journal code *</label>
                                    <input type="text" class="form-control" name="journal_code" id="journal_code"
                                        value="{{  $journal_code ?? '' }}" required>
                                    <span class="text-danger">
                                        @error('journal_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="entry_date" class="col-form-label">entry date *</label>
                                    <input type="date" class="form-control" name="entry_date" id="entry_date"
                                        value="{{ date('Y-m-d') }}" required>
                                    <span class="text-danger">
                                        @error('entry_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="remarks" class="col-form-label">description</label>
                                    <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="10"></textarea>
                                    <span class="text-danger">
                                        @error('remarks')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Account *</th>
                                                <th>Account Group *</th>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody class="tbody">
                                            <tr>
                                                <td>
                                                    <select name="account_id[]" id="account_id" class="form-control" required>
                                                        <option value="">Slect One</option>
                                                        @if (!empty($accounts))
                                                            @foreach ($accounts as $key => $account)
                                                                <option value="{{ $account->id ?? '' }} ">
                                                                    {{ $account->account_title ?? '' }}
                                                                    ({{ $account->account_no ?? '' }})
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>

                                                <td>
                                                    <select name="account_group_id[]" class="form-control account_group_id"
                                                        index_no="1" required>
                                                        <option value="">Slect One</option>
                                                        @if (!empty($account_groups))
                                                            @foreach ($account_groups as $key => $account_group)
                                                                <option value="{{ $account_group->id ?? '' }}"
                                                                    group_type="{{ $account_group->group_type ?? 0 }}">
                                                                    {{ $account_group->name ?? '' }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="debit[]" class="form-control debit"
                                                        id="debit_1">
                                                </td>
                                                <td>
                                                    <input type="number" name="credit[]" class="form-control credit"
                                                        id="credit_1">
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="trial_balance_error_text text-danger text-center">
                                                </td>
                                                <td colspan="1">
                                                    <a href="#" class="btn btn-primary btn-sm rounded add_more_btn"><i
                                                            class="fa fa-plus"></i> Add More </a>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-right">Trial Balance:</td>
                                                <td colspan="2" class="text-center">
                                                    <input type="number" name="trial_balance"
                                                        class="form-control trial_balance" value="0" readonly>
                                                </td>
                                                <td></td>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <button type="submit" class="btn waves-effect waves-light btn-sm submit_btn"
                                id="sa-success-updateuser"
                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;"
                                disabled>
                                {{ $page_title_prefix }} Data
                            </button>


                        </div>
                    </form>

                </div>
                <div class="col-md-2"></div>
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->


    <input type="hidden" class="index_count" value="1">
@endsection


@push('js')
    {{-- trial balance --}}
    <script>
          /////// trial balance calculation ////////
        $('.credit,.debit').on('change', function() {
            //credit
            var credit = 0;
            $(".credit").each(function() {
                if ($(this).val() != '') {
                    credit += parseFloat($(this).val());
                }
            });
            credit = credit.toFixed(3);

            //debit
            var debit = 0;
            $(".debit").each(function() {
                if ($(this).val() != '') {
                    debit += parseFloat($(this).val());
                }
            });
            debit = debit.toFixed(3);

            var trial_balance = debit - credit;
            $('.trial_balance').val(trial_balance);

            if (trial_balance == 0) {
                $('.submit_btn').removeAttr('disabled');
                $('.trial_balance_error_text').text('');
            } else {
                $('.submit_btn').attr('disabled', true);
                $('.trial_balance_error_text').text('You can submit form if trial balance is zero.');
            }
            // console.log(group_type);
        });
    </script>

    {{-- account group --}}
    <script>
        $('.account_group_id').on('change', function() {
            var index_no = parseInt($(this).attr("index_no"));
            var group_type = parseInt($(this).find('option:selected').attr("group_type"));
            if (group_type == 1) {
                $('#credit_' + index_no).attr("readonly", true);
                $('#credit_' + index_no).val("");
                $('#debit_' + index_no).attr("readonly", false);
            } else if (group_type == 2) {
                $('#debit_' + index_no).attr("readonly", true);
                $('#debit_' + index_no).val("");
                $('#credit_' + index_no).attr("readonly", false);
            } else {
                $('#credit_' + index_no).val("");
                $('#debit_' + index_no).attr("readonly", false);
                $('#debit_' + index_no).val("");
                $('#credit_' + index_no).attr("readonly", false);
            }
            // console.log(group_type);
        });
    </script>

    {{-- add more --}}
    <script>
        $('.add_more_btn').on('click', function() {
            var index_count = parseInt($('.index_count').val());
            index_count = index_count + 1;
            $('.index_count').val(index_count);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'get',
                url: '{{ URL::to('journal-add-more-input') }}',
                data: {
                    index_count: index_count
                },
                success: function(data) {
                    $('.tbody').append(data);

                    // account_group_id
                    $('.account_group_id').on('change', function() {
                        var index_no = parseInt($(this).attr("index_no"));
                        var group_type = parseInt($(this).find('option:selected').attr(
                            "group_type"));
                        if (group_type == 1) {
                            $('#credit_' + index_no).attr("readonly", true);
                            $('#credit_' + index_no).val("");
                            $('#debit_' + index_no).attr("readonly", false);
                        } else if (group_type == 2) {
                            $('#debit_' + index_no).attr("readonly", true);
                            $('#debit_' + index_no).val("");
                            $('#credit_' + index_no).attr("readonly", false);
                        } else {
                            $('#credit_' + index_no).val("");
                            $('#debit_' + index_no).attr("readonly", false);
                            $('#debit_' + index_no).val("");
                            $('#credit_' + index_no).attr("readonly", false);
                        }
                        // console.log(group_type);
                    });

                    /////// trial balance calculation ////////
                    $('.credit,.debit').on('change', function() {
                        //credit
                        var credit = 0;
                        $(".credit").each(function() {
                            if ($(this).val() != '') {
                                credit += parseFloat($(this).val());
                            }
                        });
                        credit = credit.toFixed(3);

                        //debit
                        var debit = 0;
                        $(".debit").each(function() {
                            if ($(this).val() != '') {
                                debit += parseFloat($(this).val());
                            }
                        });
                        debit = debit.toFixed(3);

                        var trial_balance = debit - credit;
                        $('.trial_balance').val(trial_balance);

                        if (trial_balance == 0) {
                            $('.submit_btn').removeAttr('disabled');
                            $('.trial_balance_error_text').text('');
                        } else {
                            $('.submit_btn').attr('disabled', true);
                            $('.trial_balance_error_text').text(
                                'You can submit form if trial balance is zero.');
                        }
                        // console.log(group_type);
                    });
                    /////// end trial balance calculation ////////


                    $('.remove_button').on('click', function() {
                        $(this).parents('tr').remove();

                        /////// trial balance calculation ////////

                        //credit
                        var credit = 0;
                        $(".credit").each(function() {
                            if ($(this).val() != '') {
                                credit += parseFloat($(this).val());
                            }
                        });
                        credit = credit.toFixed(3);

                        //debit
                        var debit = 0;
                        $(".debit").each(function() {
                            if ($(this).val() != '') {
                                debit += parseFloat($(this).val());
                            }
                        });
                        debit = debit.toFixed(3);

                        var trial_balance = debit - credit;
                        $('.trial_balance').val(trial_balance);

                        if (trial_balance == 0) {
                            $('.submit_btn').removeAttr('disabled');
                            $('.trial_balance_error_text').text('');
                        } else {
                            $('.submit_btn').attr('disabled', true);
                            $('.trial_balance_error_text').text(
                                'You can submit form if trial balance is zero.');
                        }
                        /////// end trial balance calculation ////////
                    });

                },
            });
        });
    </script>
@endpush
