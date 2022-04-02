<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 3/31/2022
 */

?>

    <!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ample Admin Lite Template by WrapPixel</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/plugins/images/favicon.png') }}">
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="{{ asset('admin/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>

<body>
@php
    $errors = [];

    if( \Illuminate\Support\Facades\Session::has('errors') ){
        $errors = \Illuminate\Support\Facades\Session::get('errors');
        \Illuminate\Support\Facades\Session::forget('errors');
    }
@endphp
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
     data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

    <div class="col-md-6 offset-3" style="margin-top: 100px">
        <div class="analytics-info bg-info p-25 mb-5">
            <h3 class="text-center  box-title">Admin Login</h3>

            <div class="mt-2 login-form">
                <form action="{{ route('admin.login.post') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">

                        @if( isset($errors) && count($errors) > 0)
                            <span class="error text-danger">{{ $errors[0] ?? null }}</span>
                        @endif


                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">

                        @if( isset($errors) && count($errors) > 0 )
                            <span class="error text-danger">{{ $errors[1] ?? null }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('admin/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('admin/js/custom.js') }}"></script>

{!! Toastr::message() !!}
</body>

</html>
