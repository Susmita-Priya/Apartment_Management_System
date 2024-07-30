<!DOCTYPE html>
<html>
    
<!-- Mirrored from coderthemes.com/adminox/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2019 12:24:13 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Adminox - Responsive Web App Kit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('admin_dashboard') }}/assets/images/favicon.ico">

<!-- C3 charts css -->
<link href="{{ asset('admin_dashboard') }}/plugins/c3/c3.min.css" rel="stylesheet" type="text/css"  />

<!-- App css -->
<link href="{{ asset('admin_dashboard') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin_dashboard') }}/assets/css/icons.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin_dashboard') }}/assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin_dashboard') }}/assets/css/style.css" rel="stylesheet" type="text/css" />

<script src="{{ asset('admin_dashboard') }}/assets/js/modernizr.min.js"></script>


    </head>

    <body>
        <!-- Begin page -->
        <div id="wrapper"> 

        @include('include.topbar')

        @include('include.sidebar')


        <div class="content-page">

        @yield('content')

        @include('include.footer')

        </div>

        </div>


<!-- jQuery  -->
<script src="{{ asset('admin_dashboard') }}/assets/js/jquery.min.js"></script>
<script src="{{ asset('admin_dashboard') }}/assets/js/popper.min.js"></script><!-- Popper for Bootstrap -->
<script src="{{ asset('admin_dashboard') }}/assets/js/bootstrap.min.js"></script>
<script src="{{ asset('admin_dashboard') }}/assets/js/metisMenu.min.js"></script>
<script src="{{ asset('admin_dashboard') }}/assets/js/waves.js"></script>
<script src="{{ asset('admin_dashboard') }}/assets/js/jquery.slimscroll.js"></script>

<!-- Counter js  -->
<script src="{{ asset('admin_dashboard') }}/plugins/waypoints/jquery.waypoints.min.js"></script>
<script src="{{ asset('admin_dashboard') }}/plugins/counterup/jquery.counterup.min.js"></script>

<!--C3 Chart-->
<script type="text/javascript" src="{{ asset('admin_dashboard') }}/plugins/d3/d3.min.js"></script>
<script type="text/javascript" src="{{ asset('admin_dashboard') }}/plugins/c3/c3.min.js"></script>

<!--Echart Chart-->
<script src="{{ asset('admin_dashboard') }}/plugins/echart/echarts-all.js"></script>

<!-- Dashboard init -->
<script src="{{ asset('admin_dashboard') }}/assets/pages/jquery.dashboard.js"></script>

<!-- App js -->
<script src="{{ asset('admin_dashboard') }}/assets/js/jquery.core.js"></script>
<script src="{{ asset('admin_dashboard') }}/assets/js/jquery.app.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-PhNU2NnNx0+bXw85z1zOHu+RmF/yhJ7gr/kpiURmcYF4ZBS0alMCi/YQHZjxovhz" crossorigin="anonymous">

</body>

</html>


