<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Klontong</title>
    <link rel="stylesheet" href="{{ url('assets/vendor/fontawesome-free/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/user.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body>

    @include('landing.nav')
    @include('landing.cart')

    <div class="wrapper">

        @include('landing.side')

        <div class="content" id="content">
            <div class="container">
                <div id="base-url" data-url="{{ url('') }}/"></div>
                @include('landing.banner')
            </div>
        </div>

    </div>

    </div>

    @include('landing.modal')

    <script src="{{ url('assets') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ url('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="{{ url('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets') }}/js/sb-admin-2.min.js"></script>

    <script src="{{ url('/assets/sweetalert2/dist/sweetalert2.all.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="{{ url('js/user.js') }}"></script>
    <script src="{{ url('js') }}/main.js"></script>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>
