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
                            <li class="breadcrumb-item active"> {{ $page_title }}</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>


            @php
            $subscription_package_text = $latest_user_subscription->subscription_package->name ?? '';
            $package_duration_text = '';
            if (!empty($latest_user_subscription->package_duration)) {
                $package_duration_text .= $latest_user_subscription->package_duration->value ?? '';
                if ($latest_user_subscription->package_duration->type == 1) {
                    $package_duration_text .= ' Day';
                } elseif ($latest_user_subscription->package_duration->type == 2) {
                    $package_duration_text .= ' Week';
                } elseif ($latest_user_subscription->package_duration->type == 3) {
                    $package_duration_text .= ' Month';
                } elseif ($latest_user_subscription->package_duration->type == 4) {
                    $package_duration_text .= ' Year';
                } else {
                    $package_duration_text .= ' Not Found';
                }
            }
        @endphp


            <!-- end row -->
            <div class="row">
                <div class="col-md-2"><a href="{{ route('user.index') }}" class="btn btn-success text-capitalize"><i class="fa fa-list"></i>
                        Go To User List</a></div>
                <div class="col-md-6">
                    <form action="{{ route('user_subscription.store', $user->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        {{-- hidden --}}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="card-box">
                            <h4 class="d-flex justify-content-center mt-4 text-capitalize"> {{ $page_title }}</h4>

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="subcription_date" class="col-form-label">subcription date *</label>
                                    <input type="date" class="form-control" name="subcription_date" id="subcription_date"
                                        value="{{ $latest_user_subscription->expire_date ?? '' }}" required>
                                    <span class="text-danger">
                                        @error('subcription_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                
                                <div class="form-group col-md-6">
                                    <label for="subscription_package_id" class="col-form-label">Package *</label>
                                    <select class="form-control package" name="subscription_package_id"
                                        id="subscription_package_id" required>
                                        <option value="">Select One</option>
                                        @if (!empty($subscription_packages))
                                            @foreach ($subscription_packages as $package)
                                                <option value="{{ $package->id }}"
                                                    @isset($latest_user_subscription->subscription_package_id) {{ $latest_user_subscription->subscription_package_id == $package->id ? 'selected' : '' }} @endisset
                                                    price={{ $package->price ?? 0 }}
                                                    discount_amount={{ $package->discount_amount ?? 0 }}>
                                                    {{ $package->name ?? '' }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger">
                                        @error('subscription_package_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="package_price" class="col-form-label">price *</label>
                                    <input type="text" class="form-control price" name="package_price" id="package_price"
                                        value="{{ $latest_user_subscription->package_price ?? '' }}" required readonly>
                                    <span class="text-danger">
                                        @error('package_price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="discount_amount" class="col-form-label">discount amount *</label>
                                    <input type="text" class="form-control discount_amount" name="discount_amount"
                                        id="discount_amount" value="{{ $latest_user_subscription->discount_amount ?? '' }}"
                                        required readonly>
                                    <span class="text-danger">
                                        @error('discount_amount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="total_payable_amount" class="col-form-label">total payable amount *</label>
                                    <input type="text" class="form-control total_amount" name="total_payable_amount"
                                        id="total_payable_amount"
                                        value="{{ ($latest_user_subscription->package_price ?? 0) - ($latest_user_subscription->discount_amount ?? 0) }}"
                                        required readonly>
                                    <span class="text-danger">
                                        @error('total_payable_amount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="total_paid_amount" class="col-form-label">Total paid amount *</label>
                                    <input type="text" class="form-control total_paid_amount" name="total_paid_amount"
                                        id="total_paid_amount"
                                        value="{{ $latest_user_subscription->total_paid_amount ?? '' }}" required>
                                    <span class="text-danger">
                                        @error('total_paid_amount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                
                                <div class="form-group  col-md-6">
                                    <label><strong>Payment Method : <span class="text-danger">*</span></strong> </label>
                                    <select class="form-control chosen payment_method_type" name="payment_method" required>
                                        <option value="1">Cash</option>
                                        <option value="2">Bank</option>
                                        <option value="3">Mobile Banking</option>
                                    </select>
                                </div>
                                <div class="form-group  col-md-6 online_type" style="display: none;">

                                    <div class="mt-2" id="mobile_payment_card">
                                        <div class="form-group">
                                            <label for="payment_details">Payment Details</label>
                                            <textarea name="payment_details" id="payment_details" class="form-control" cols="10" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn waves-effect waves-light btn-sm" id="sa-success-updateuser"
                                style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white;">
                                Save Data
                            </button>
                        </div>
                    </form>

                </div>
                <div class="col-md-4"></div>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    </div>
@endsection

@push('js')
    <script>
        $('.payment_method_type').on('change', function() {
            var paymentType = $(this).find('option:selected').val();
            // console.log(paymentType);

            if (paymentType == 1) {
                $('.online_type').hide();
            } else {
                $('.online_type').show();
            }
        });
    </script>


    <script>
        $('.package').on('change', function() {
            // alert('ok')
            var discount_amount = parseFloat($(this).find(':selected').attr('discount_amount'));
            var price = parseFloat($(this).find(':selected').attr('price'));

            var total_amount = price - discount_amount;

            $(".price").val(price);
            $(".discount_amount").val(discount_amount);



            $(".total_amount").val(total_amount);
        });
    </script>
@endpush
