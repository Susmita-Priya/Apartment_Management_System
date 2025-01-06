
<!DOCTYPE html>
<html>

<!-- Mirrored from coderthemes.com/adminox/default/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2019 12:29:42 GMT -->

<head>
    <meta charset="utf-8" />
    @push('title')
        <title>Registration</title>
    @endpush
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    {{-- <link rel="icon" href="{{ asset('image/bytecarelogo-sm.png') }}" type="image/png"> --}}
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_dashboard') }}/assets/images/favicon.ico">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- App css -->
    <link href="{{ asset('admin_dashboard') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard') }}/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard') }}/assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_dashboard') }}/assets/css/style.css" rel="stylesheet" type="text/css" />

    <script src="{{ asset('admin_dashboard') }}/assets/js/modernizr.min.js"></script>

    <style>
        .submitbtn {
            background-color: rgb(100, 197, 177);
            color: white;
        }
        </style>
</head>

{{-- <body style="background-color:rgb(100,197,177)"> --}}
    <body style=" background-image: url('{{ asset('image/bg-building.jpg') }}'); background-size: cover; background-repeat: no-repeat;">


    <!-- HOME -->
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="wrapper-page">
                        <div class="account-pages">
                            <div class="account1-box">
                                <div class="account-logo-box">
                                    <h2 class="text-uppercase text-center">
                                        <p style="color: rgb(100, 197, 177);"> Apartment Management </p>
                                    </h2>
                                    <h5 class="text-uppercase font-bold m-b-5 m-t-50"></h5>
                                   {{--  <p class="m-b-0">Create A New Account</p> --}}
                                </div>
                                <div class="account-content">
                                    <form class="form-horizontal" action="{{ route('do_register') }}" method="post">
                                        @csrf

                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <label for="role">Select Account<span style="color: red;">*</span></label>
                                                <select class="form-control" name="role" id="role">
                                                    <option value="">Select Account</option>
                                                    <option value="Client">Master Account</option>
                                                    <option value="Company">Junior Account</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group m-b-30 row">
                                            <div class="col-md-6">
                                                <label for="name">Name<span style="color: red;">*</span></label>
                                                <input class="form-control" name="name" type="text"
                                                    id="name" required="" placeholder="Enter Name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email">Email address<span style="color: red;">*</span></label>
                                                <input class="form-control" name="email" type="email"
                                                    id="email" required="" placeholder="abc@gmail.com">
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-20">
                                            <div class="col-md-6">
                                                <label for="phone">Phone<span style="color: red;">*</span></label>
                                                <input class="form-control" name="phone" type="text"
                                                    id="phone" required="" placeholder="Enter Phone">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="address">Address<span style="color: red;">*</span></label>
                                                <input class="form-control" name="address" type="text"
                                                    id="address" required="" placeholder="Enter Address">
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-20">
                                            <div class="col-md-6">
                                                <label for="tread_licence">Tread Licence<span style="color: red;">*</span></label>
                                                <input class="form-control" name="tread_licence" type="text"
                                                    id="tread_licence" required="" placeholder="Enter Tread Licence">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password">Password<span style="color: red;">*</span></label>
                                                <input class="form-control" name="password" type="password"
                                                    required="" id="password" placeholder="Enter your password">
                                            </div>
                                            
                                        </div>

                                        

                                        <div class="form-group row text-center m-t-10">
                                            <div class="col-12">
                                                <button
                                                    class="btn btn-md btn-block submitbtn waves-effect waves-light"
                                                    
                                                    type="submit">Sign Up</button>
                                            </div>
                                        </div>

                                        <div class="form-group row m-t-30 m-b-0 text-center">
                                            <div class="col-12">Already have an account?
                                                <a href="{{ route('login') }}"
                                                    class="text-primary"> <u>login</u></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end card-box-->
                    </div>
                    <!-- end wrapper -->
                </div>
            </div>
        </div>
    </section>
    <!-- END HOME -->

    @include('message')

    <script>
        var resizefunc = [];
    </script>
    <!-- jQuery  -->
    <script src="{{ asset('admin_dashboard') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('admin_dashboard') }}/assets/js/popper.min.js"></script><!-- Popper for Bootstrap -->
    <script src="{{ asset('admin_dashboard') }}/assets/js/bootstrap.min.js"></script>
    <script src="{{ asset('admin_dashboard') }}/assets/js/metisMenu.min.js"></script>
    <script src="{{ asset('admin_dashboard') }}/assets/js/waves.js"></script>
    <script src="{{ asset('admin_dashboard') }}/assets/js/jquery.slimscroll.js"></script>

    <!-- App js -->
    <script src="{{ asset('admin_dashboard') }}/assets/js/jquery.core.js"></script>
    <script src="{{ asset('admin_dashboard') }}/assets/js/jquery.app.js"></script>

</body>

</html>