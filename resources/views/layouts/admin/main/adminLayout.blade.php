<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 4/3/2022
 */

?>

    <!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
          content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
          content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title> Admin {{ env('APP_NAME') }}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/plugins/images/favicon.png') }}">
    <!-- Custom CSS -->
    <link href="{{ asset('admin/plugins/bower_components/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css') }}">
    <!-- Custom CSS -->
    <link href="{{ asset('admin/css/style.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('admin/css/dataTable.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/data_table_sty.css') }}">
</head>

<body>


<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
     data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

@include('layouts.admin.main.sidebar')

    @yield('adminContent')

</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->



<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('admin/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('admin/js/custom.js') }}"></script>

<script src="{{ asset('admin/js/dataTable.js') }}"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>

<script>
    $('.dropdown-toggle').click(function (){
        $('.dropdown-menu').toggle();
    });
</script>

{!! Toastr::message() !!}


@stack(('scripts'))

</body>

</html>
