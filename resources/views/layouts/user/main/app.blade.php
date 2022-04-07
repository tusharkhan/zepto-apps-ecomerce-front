<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 4/5/2022
 */

?>

    <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>{{ env('APP_NAME') }}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('admin/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/front.css') }}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    @stack('style')

</head>
<body>

<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <ul class="list-unstyled">
                        @if( ! checkLogin('user') )
                            <li><a href="{{ route('user.login.get') }}" class="text-white">Login</a></li>
                            <li><a href="#" class="text-white">Registration</a></li>
                        @else
                            <li><a href="{{ route('user.logout') }}" class="text-white">Logout</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">

                <strong>Zepto App</strong>
            </a>

            <form action="">

                <div class="input-group">
                    <input type="text" class="form-control" id="productNameField" placeholder="Product Name"
                           aria-label="Search product Name" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>

                    <div class="search-result d-none" id="searchResult">
                        <ul class="list-unstyled">
                            {{--                            <li class="list-group-item">--}}
                            {{--                                <div class="text-left">--}}
                            {{--                                    <a class="text-danger" id="closeResult" href="#"><i class="fa fa-1x fa-times"--}}
                            {{--                                                                                        aria-hidden="true"></i></a>--}}
                            {{--                                </div>--}}
                            {{--                            </li>--}}

                            <div id="resultList"></div>

                        </ul>
                    </div>

                    <div class="search-result d-none" id="searchLoading">
                        <ul class="list-unstyled">
                            <li class="list-group-item">
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>

            </form>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>


@yield('content')

<footer class="text-muted py-5">
    <div class="container">
        <p class="float-end mb-1">
            <a href="#">Back to top</a>
        </p>
        <p class="mb-1"> &copy; {{ date('Y') }} Lorem ipsum dolor sit amet, consectetur.</p>

    </div>
</footer>

<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('admin/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/js/frontCustom.js') }}"></script>

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
    @if( \Illuminate\Support\Facades\Session::has('login.api.success') )
    toastr.success("{{ \Illuminate\Support\Facades\Session::get('login.api.success') }}");
    @php \Illuminate\Support\Facades\Session::forget('login.api.success') @endphp
    @endif
</script>


<script>
    var productNameField = $('#productNameField');
    var searchResult = $('#searchResult');
    var closeResult = $('#closeResult');
    var searchLoading = $('#searchLoading');

    var typingTimer;                //timer identifier
    var doneTypingInterval = 500;


    closeResult.click(function () {
        searchResult.addClass('d-none');
    });


    $(document).on('click', function (e) {
        searchResult.addClass('d-none');
        searchLoading.addClass('d-none');
    });


    productNameField.on('keyup', function () {
        if (productNameField.val().length > 0) {
            searchResult.addClass('d-none');

            clearTimeout(typingTimer);
            typingTimer = setTimeout(searchProduct, doneTypingInterval);
        } else {
            searchResult.addClass('d-none');
        }
    });
    //on keydown, clear the countdown
    productNameField.on('keydown', function () {
        clearTimeout(typingTimer);
        searchLoading.removeClass('d-none');
    });

    //user is "finished typing," do something
    function searchProduct() {
        let formData = {name: productNameField.val(), _token: '{{ csrf_token() }}'};

        if (productNameField.val().length > 0) searchResult.removeClass('d-none');
        else searchResult.addClass('d-none');

        $.ajax({
            url: "{{ url('searchProductByName') }}",
            type: "POST",
            data: formData,
            async: false,
            success: function (response, textStatus, jqXHR) {

                if (response.status === true) {
                    searchResult.removeClass('d-none');
                    writeOnSearchResult(response.data);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                searchResult.addClass('d-none');
                searchLoading.addClass('d-none');
                toastr.error('Product not found');
            }
        });
    }

</script>

@stack('script')

</body>
</html>
