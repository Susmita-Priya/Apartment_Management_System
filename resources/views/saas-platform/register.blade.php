<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Subscription </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<style>
    .radio-inline {
        margin-right: 15px;
    }

    .radio-inline input {
        margin-right: 10px;
        vertical-align: middle;
    }

    .p-10 {
        padding-top: 10px;
    }

    .form-group.row {
        padding: 0px 30px;
    }

    .btn-primary {
        color: #f2f2f2;
        background-color: #000000;
        border-color: #000000;
        padding: 5px 20px;
    }
</style>

<body class="hold-transition login-page bg-dark"
    style="background-image:url('image/login-bg.jpg');height: 100%!important;background-size: cover;">
    <div class="container">
        @php
            $subscription_package_text = $selected_package_data->name ?? '';
            $package_duration_text = '';
            if (!empty($selected_package_data->package_duration)) {
                $package_duration_text .= $selected_package_data->package_duration->value ?? '';
                if ($selected_package_data->package_duration->type == 1) {
                    $package_duration_text .= ' Day';
                } elseif ($selected_package_data->package_duration->type == 2) {
                    $package_duration_text .= ' Week';
                } elseif ($selected_package_data->package_duration->type == 3) {
                    $package_duration_text .= ' Month';
                } elseif ($selected_package_data->package_duration->type == 4) {
                    $package_duration_text .= ' Year';
                } else {
                    $package_duration_text .= ' Not Found';
                }
            }
        @endphp
        <!--begin::Form-->
        <form id="menu-form" action="{{ route('do_registration') }}" method="POST"
            class="kt-form kt-form--label-right">
            <div class="kt-portlet__body">
                @csrf

                {{-- hidden --}}
                <input type="hidden" name="subscription_package_duration_id"
                    value="{{ $selected_package_data->subscription_package_duration_id ?? 0 }}">

                <input type="hidden" name="subscription_package_id" value="{{ $selected_package_data->id ?? 0 }}">
                <input type="hidden" name="role_id" value="{{ $selected_package_data->role_id ?? 0 }}">
                <input type="hidden" name="registration_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="status" value="2">


                <div class="row">
                    <div class="col-md-8 offset-md-2"
                        style="background: #fff; padding:30px; 0px; border:1px solid #eee;">

                        <div class="text-center">
                            <h3>
                                {{-- <img src="{{ asset('public/logo') }}/{{ $general_setting->site_logo ?? '' }}" style="height: auto;width:100px"> --}}
                                <b> Byte Care Limited. </b>
                            </h3>
                            <p>Makka tower(7th floor), kakrail, dhaka, bangladesh</p>
                        </div>
                        <h4 class="text-center">
                            <b class="border-bottom border-dark"> New User Registration Form</b>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <label><strong>User Name:</strong> <span class="text-danger">*</span></label>
                                <input class="form-control username_validation" type="text" name="name"
                                    value="{{ old('name') }}" placeholder="User Name" required>
                                <div class="username_validation_error_message text-danger"></div>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Company Name:</strong> <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="company_name"
                                    value="{{ old('company_name') }}" placeholder="Company Name" required>
                            </div>
                            <div class="col-md-6 p-10">
                                <label><strong>Phone:</strong> <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="phone" value="{{ old('phone') }}"
                                    placeholder="01......." required>
                            </div>
                            <div class="col-md-6 p-10 ">
                                <label><strong>Email:</strong> <span class="text-danger">*</span></label>
                                <input class="form-control email" type="email" name="email"
                                    value="{{ old('email') }}" placeholder="abc@gmail.com" required>

                                <div class="errorMessage text-danger"></div>
                                {{-- <div class="successMessage text-success"></div> --}}
                            </div>
                            <div class="col-md-6 p-10 pass">
                                <label><strong>Password:</strong> <span class="text-danger">*</span></label>
                                <input id="pass" type="password" name="password" placeholder="Enter Password"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-6 p-10">
                                <label><strong>Confirm Password:</strong> <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" id="confirm_pass"
                                    onkeyup="validate_password()" placeholder="Confirm Password" class="form-control"
                                    required>
                            </div>
                            <span id="wrong_pass_alert"></span>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <label><strong>Package Name:</strong> <span class="text-danger">*</span></label>
                                <input type="text" value="{{ $subscription_package_text ?? '' }}"
                                    class="form-control bg-light" readonly>
                            </div>
                            <div class="col-md-6">
                                <label><strong>Package Amount:</strong></label>
                                <input type="number" name="package_price"
                                    value="{{ $selected_package_data->price ?? '' }}" placeholder="0"
                                    class="form-control  bg-light" required readonly>
                            </div>

                            <div class="col-md-6 p-10">
                                <label for=""><strong>Package Duration:</strong> <span
                                        class="text-danger">*</span></label>

                                <input type="text" value="{{ $package_duration_text ?? '' }}"
                                    class="form-control bg-light" readonly>
                            </div>
                            @if (!empty($selected_package_data->discount_amount))
                                <div class="col-md-6 p-10">
                                    <label for=""><strong>Discount Amount:</strong> <span
                                            class="text-danger">*</span></label>

                                    <input type="text" name="discount_amount"
                                        value="{{ $selected_package_data->discount_amount ?? '' }}"
                                        class="form-control bg-light" readonly>
                                </div>
                            @endif

                            <div class="col-md-6 p-10">
                                <label><strong>Total Amount:</strong> <span class="text-danger">*</span></label>
                                <input type="number" name="total_payable_amount"
                                    value="{{ ($selected_package_data->price ?? 0) - ($selected_package_data->discount_amount ?? 0) }}"
                                    placeholder="0" class="form-control  bg-light" readonly>
                            </div>
                            <div class="col-md-6 p-10">
                                <label><strong>Payment Method : <span class="text-danger">*</span></strong> </label>
                                <select class="form-control chosen payment_method_type" name="payment_method"
                                    required>
                                    <option value="1">Cash</option>
                                    <option value="2">Bank</option>
                                    <option value="3">Mobile Banking</option>
                                </select>
                            </div>
                            <div class="col-md-6 p-10 online_type">

                                <div class="mt-2" id="mobile_payment_card">
                                    <div class="form-group">
                                        <label for="payment_details">Payment Details</label>
                                        <textarea name="payment_details" id="payment_details" class="form-control" cols="10" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <div class="form-group text-center">
                                    <div class="buttons">
                                        <button id="create" class="submit_btn btn btn-primary"
                                            onclick="wrong_pass_alert()">
                                            Submit
                                        </button>
                                    </div>
                                    <br>
                                    <p>Click here to <a href="{{ route('login') }}">Login</a></p>
                                </div>
                            </div>
                            <p class="text-center">© 2023-{{ date('Y') }}
                                <a href="{{ $general_setting->company_website_link ?? '' }}"
                                    class="text-decoration-none"
                                    target="_blank">{{ $general_setting->company_name ?? '' }}.
                                </a>
                                All rights reserved.
                            </p>
                        </div>
                        <br>

                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>



    {{-- validation - username,email --}}
    <script>
        // $('.username_validation').on("keyup", function() {
        //     var username = $('.username_validation').val();
        //     $.ajax({
        //         type: "GET",
        //         url: '{{ route('username_validation_check_ajax') }}',
        //         data: {
        //             username: username
        //         },
        //         dataType: "json",
        //         success: function(data) {
        //             if (data.exists) {
        //                 $('.username_validation_error_message').html("Username already exist!");
        //                 document.getElementById('create').disabled = true;
        //             } else {
        //                 $('.username_validation_error_message').html("");
        //                 document.getElementById('create').disabled = false;
        //                 // console.log('false');
        //             }
        //         },
        //         error: function(jqXHR, exception) {

        //         }
        //     })
        // });

        $('.email').on("keyup", function() {
            var email = $('.email').val();
            // console.log('email:' +email);


            $.ajax({
                type: "GET",
                url: '{{ route('emailCheck') }}',
                data: {
                    email: email
                },
                dataType: "json",
                success: function(data) {
                    // console.log('data:' +data.exists);
                    if (data.exists) {
                        $('.errorMessage').html("Already Email Exist!");
                        document.getElementById('create').disabled = true;
                    } else {
                        $('.errorMessage').html("");
                        $('.successMessage').html("Email is valid!");
                        document.getElementById('create').disabled = false;
                        // console.log('false');
                    }
                },
                error: function(jqXHR, exception) {

                }
            })
        });

        // Payment Method Type

        $(document).ready(function() {
            $('.online_type').hide();
            $('.payment_method_type').on('change', function() {
                var paymentType = $(this).find('option:selected').val();
                // console.log(paymentType);

                if (paymentType == 1) {
                    $('.online_type').hide();
                } else {
                    $('.online_type').show();
                }
            });
        });

        $('.validatedForm').validate({
            rules: {
                password: {
                    minlength: 5,
                },
                password_confirm: {
                    minlength: 5,
                    equalTo: "#password"
                }
            }
        });

        function validate_password() {

            let pass = document.getElementById('pass').value;
            let confirm_pass = document.getElementById('confirm_pass').value;
            if (pass != confirm_pass) {
                document.getElementById('wrong_pass_alert').style.color = 'red';
                document.getElementById('wrong_pass_alert').innerHTML = '☒ Use same password';
                document.getElementById('create').disabled = true;
                document.getElementById('create').style.opacity = (0.4);
            } else {
                document.getElementById('wrong_pass_alert').style.color = 'green';
                document.getElementById('wrong_pass_alert').innerHTML =
                    '🗹 Password Matched';
                document.getElementById('create').disabled = false;
                document.getElementById('create').style.opacity = (1);
            }
        }

        function wrong_pass_alert() {
            if (document.getElementById('pass').value != "" &&
                document.getElementById('confirm_pass').value != "") {
                //alert("Your response is submitted");
            } else {
                // alert("Please fill all the fields");
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
