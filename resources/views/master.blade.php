<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    @stack('title')
    <link rel="icon" href="{{ asset('image/bytecarelogo-sm.png') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style>
        .no-border {
            border: none !important;
            box-shadow: none !important;
            /* To remove any box shadow that might be adding a border effect */
        }

        .greenbtn {
            background-color: rgb(100, 197, 177);
            border-color: rgb(100, 197, 177);
            color: white;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            text-decoration: none;
            padding: 10px 20px;
        }

        .rotate-left-up {
  display: inline-block;
  transform: rotate(-45deg);
}
    </style>

    <!-- Sweet Alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_dashboard') }}/assets/images/favicon.ico" type="image/x-icon">

    <!-- C3 charts css -->
    <link href="{{ asset('admin_dashboard') }}/plugins/c3/c3.min.css" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ asset('admin_dashboard') }}/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin_dashboard') }}/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

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

        @include('message')

        @include('include.topbar')

        @include('include.sidebar')

        <div class="content-page">

            @yield('content')

        </div>
        
        @include('include.footer')

    </div>

    <!-- jQuery  -->
    <script src="{{ asset('admin_dashboard') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('admin_dashboard') }}/assets/js/popper.min.js"></script> <!-- Popper for Bootstrap -->
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


    @stack('js')

    <!-- custom js -->
    {{-- <script src="{{ asset('js/custom.js') }}"></script> --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').dataTable();
        });
    </script>

</body>

</html>
