
<!DOCTYPE html>
<html>

<!-- Mirrored from coderthemes.com/adminox/default/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2019 12:29:42 GMT -->

<head>
    <meta charset="utf-8" />
    @push('title')
        <title>Login</title>
    @endpush
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
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
</head>

<body style="background-color:rgb(100,197,177)">


    <!-- HOME -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="wrapper-page">
                        <div class="account-pages">
                            <div class="account-box">
                                <div class="account-logo-box">
                                    <h2 class="text-uppercase text-center">
                                        @if(!empty($general_setting->company_logo))
                                        <a href="{{ route('index') }}" class="text-success">
                                            <span><img src="{{ asset('setting/company_logo/' . $general_setting->company_logo) }}" alt=""
                                                    height="60"></span>
                                        </a>
                                        @endif
                                    </h2>
                                    <h5 class="text-uppercase font-bold m-b-5 m-t-50">Sign In</h5>
                                    <p class="m-b-0">Login to your Admin account</p>
                                </div>
                                <div class="account-content">
                                    <form class="form-horizontal" action="{{ route('do_login') }}" method="post">
                                        @csrf
                                        <div class="form-group m-b-20 row">
                                            <div class="col-12">
                                                <label for="emailaddress">Email address</label>
                                                <input class="form-control" name="email" type="email"
                                                    id="emailaddress" required="" placeholder="abc@gmail.com">
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <a href="page-recoverpw.html"
                                                    class="text-muted pull-right"><small>Forgot your
                                                        password?</small></a>
                                                <label for="password">Password</label>
                                                <input class="form-control" name="password" type="password"
                                                    required="" id="password" placeholder="Enter your password">
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-20">
                                            <div class="col-12">

                                                <div class="checkbox checkbox-success">
                                                    <input id="remember" type="checkbox" checked="">
                                                    <label for="remember">
                                                        Remember me
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group row text-center m-t-10">
                                            <div class="col-12">
                                                <button
                                                    class="btn btn-md btn-block btn-primary waves-effect waves-light"
                                                    type="submit">Sign In</button>
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
