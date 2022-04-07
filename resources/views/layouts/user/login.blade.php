<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 4/6/2022
 */
?>

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link href="{{ asset('admin/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

</head>
<body
    style="background-image: url('{{ asset("admin/images/main/azzedine-rouichi-FEXF2hWSGA8-unsplash.jpg") }}'); background-position: unset; background-size: cover;background-repeat: no-repeat;">

@php
    $errors = [];

    if( \Illuminate\Support\Facades\Session::has('errors') ){
        $errors = \Illuminate\Support\Facades\Session::get('errors');
        \Illuminate\Support\Facades\Session::forget('errors');
    }
@endphp

<section class="login-form">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 " style="margin-top: 70px">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">User Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('user.login.post')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input required type="email" name="email" class="form-control" id="email"
                                       placeholder="Enter email">

                                @if( isset($errors) && count($errors) > 0)
                                    <span class="error text-danger">{{ $errors[0] ?? null }}</span>
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input required type="password" name="password" class="form-control" id="password"
                                       placeholder="Password">

                                @if( isset($errors) && count($errors) > 0 )
                                    <span class="error text-danger">{{ $errors[1] ?? null }}</span>
                                @endif

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mt-5">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('admin/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('admin/js/custom.js') }}"></script>

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
    @if( \Illuminate\Support\Facades\Session::has('login.api.errors') )
    toastr.error('{{ \Illuminate\Support\Facades\Session::get('login.api.errors') }}');
    @php \Illuminate\Support\Facades\Session::forget('login.api.errors') @endphp
    @endif

</script>


</body>
</html>
