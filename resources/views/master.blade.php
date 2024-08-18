<!DOCTYPE html>
<html>
    
<!-- Mirrored from coderthemes.com/adminox/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2019 12:24:13 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <style>
        .no-border {
            border: none!important;
            box-shadow: none!important; /* To remove any box shadow that might be adding a border effect */
        }
        </style>


        <!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('admin_dashboard') }}/assets/images/favicon.ico">

<!-- C3 charts css -->
<link href="{{ asset('admin_dashboard') }}/plugins/c3/c3.min.css" rel="stylesheet" type="text/css"  />

<!-- Sweet Alert -->
<link href="{{ asset('admin_dashboard') }}/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

<!-- DataTables -->
<link href="{{ asset('admin_dashboard') }}/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
<link href="{{ asset('admin_dashboard') }}/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>

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
        
        {{-- @include('auth.message') --}}
        
        @include('include.topbar')

        @include('include.sidebar')


        <div class="content-page">

        @yield('content')

        @include('include.footer')

        </div>

        </div>


<!-- jQuery  -->
<script src="{{ asset('admin_dashboard') }}/assets/js/jquery.min.js"></script>
<script src="{{ asset('admin_dashboard') }}/assets/js/popper.min.js"></script>  <!-- Popper for Bootstrap -->
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

<script src="{{ asset('admin_dashboard') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin_dashboard') }}/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('admin_dashboard') }}/plugins/datatables/dataTables.responsive.min.js"></script>

<!-- App js -->
<script src="{{ asset('admin_dashboard') }}/assets/js/jquery.core.js"></script>
<script src="{{ asset('admin_dashboard') }}/assets/js/jquery.app.js"></script>

<!-- Sweet-Alert  -->
<script src="{{ asset('admin_dashboard') }}/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script src="{{ asset('admin_dashboard') }}/assets/pages/jquery.sweet-alert.init.js"></script>
{{-- 
<!-- Sweet-Alert  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

<!-- Font-awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-PhNU2NnNx0+bXw85z1zOHu+RmF/yhJ7gr/kpiURmcYF4ZBS0alMCi/YQHZjxovhz" crossorigin="anonymous">

{{-- <!-- custom js -->
<script src="{{ asset('js/custom.js') }}"></script> --}}

<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable();
    });
</script>

</body>

</html>


