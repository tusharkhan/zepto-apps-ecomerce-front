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

    @stack('style')

</head>
<body>

<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">

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
                    <input type="text" class="form-control" id="productNameField" placeholder="Recipient's username"
                           aria-label="Search product Name" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>

                    <div class="search-result d-none" id="searchResult">
                        <ul class="list-unstyled">
                            <li class="list-group-item">
                                <div class="text-left">
                                    <a class="text-danger" id="closeResult" href="#"><i class="fa fa-1x fa-times"
                                                                                        aria-hidden="true"></i></a>
                                </div>
                            </li>

                            <div id="resultList"></div>

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

{!! Toastr::message() !!}

<script>
    let productNameField = $('#productNameField');
    let searchResult = $('#searchResult');
    let closeResult = $('#closeResult');
    var typingTimer;                //timer identifier
    var doneTypingInterval = 500;


    function writeOnSearchResult(data) {
        let resultList = $('#resultList');
        resultList.empty();

        data.forEach((value, index) => {

            let link = window.location.origin + '/single/' + value.slug;
            let image = value.image;
            let divToAppend = '<li class="list-group-item" style="z-index: 1">\n' +
                '                                                <div class="d-flex">\n' +
                '                                                    <div class="text-center col-md-4 float-left">\n' +
                '                                                        <a href="' + link + '"><img class="img-search" src="' + image + '" alt="' + value.name + '"></a>\n' +
                '                                                    </div>\n' +
                '                                                    <div class="search-Text text-center col-md-8 float-left">\n' +
                '                                                        <a class="text-dark text-decoration-none" href="' + link + '"><p>' + value.name + '</p></a>\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                            </li>';

            resultList.append(divToAppend);

        });
    }


    closeResult.click(function () {
        searchResult.addClass('d-none');
    });
    $(document).on('click', function (e) {
        searchResult.addClass('d-none');
    });
    productNameField.on('keyup', function () {
        if (productNameField.val() == "") searchResult.addClass('d-none');
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });
    //on keydown, clear the countdown
    productNameField.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function doneTyping() {
        let formData = {name: productNameField.val(), _token: '{{ csrf_token() }}'};
        console.log(productNameField.val())
        if (productNameField.val() != '') searchResult.removeClass('d-none');
        else searchResult.addClass('d-none');
        $.ajax({
            url: "{{ url('searchProductByName') }}", // Url of backend (can be python, php, etc..)
            type: "POST", // data type (can be get, post, put, delete)
            data: formData, // data in json format
            async: false, // enable or disable async (optional, but suggested as false if you need to populate data afterwards)
            success: function (response, textStatus, jqXHR) {
                console.log(response, response.data.length);
                if (response.status == true) {
                    if (response.data.length <= 0) searchResult.addClass('d-none');
                    else searchResult.removeClass('d-none');
                    writeOnSearchResult(response.data);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                toastr.error(jqXHR);
                //toastr.error(textStatus);
                toastr.error(errorThrown);
            }
        });
    }

</script>

@stack('script')

</body>
</html>
