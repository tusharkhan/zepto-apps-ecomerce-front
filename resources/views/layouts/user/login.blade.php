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

    <link rel="stylesheet" href="{{asset('admin/bootstrap/dist/css/bootstrap.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('front/css/login.css')}}">--}}

</head>
<body
    style="background-image: url('{{ asset("admin/images/main/azzedine-rouichi-FEXF2hWSGA8-unsplash.jpg") }}'); background-position: unset; background-size: cover;background-repeat: no-repeat;">
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
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input required type="password" name="password" class="form-control" id="password"
                                       placeholder="Password">
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
</body>
</html>
