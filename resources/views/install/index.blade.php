<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Setup Aplikasi</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url('/assets/css/laravel.css') }}">

    <!-- Scripts -->
    <script src="{{ url('/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('/assets/js/laravel.js') }}"></script>
    <script src="{{ url('/assets/sweetalert2/dist/sweetalert2.all.js') }}"></script>
</head>

<body>
    @if (session('message'))
        <?= session('message') ?>
    @endif
    <div id="pesan"></div>
    <div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <form method="POST" action="{{ url('siteman') }}" onsubmit="return false;" id="form">
                    @csrf
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="email">
                            Email
                        </label>
                        <input
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full"
                            id="email" type="email" name="email" autofocus="autofocus" value="{{ old('email') }}">
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700" for="password">
                            Password
                        </label>
                        <input
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full"
                            id="password" type="password" name="password" autocomplete="current-password">
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700" for="password">
                            Password Konfirmasi
                        </label>
                        <input
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full"
                            id="password" type="password" name="password" autocomplete="current-password">
                    </div>

                    <div class="mt-4">
                        <input type="checkbox" onclick="lookPass()" id="look" style="cursor: pointer;">
                        <label for="look" style="cursor: pointer;">Lihat password</label>
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <button
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ml-4"
                            id="login">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#login").click(function() {
                let email = $("#email").val().trim();
                let password = $("#password").val().trim();
                if (email == "" && password == "") {
                    $("#pesan").html(Swal.fire('Ooops!', 'Email dan password tidak boleh kosong!',
                        'error'));
                } else if (email == "") {
                    $("#pesan").html(Swal.fire('Ooops!', 'Email tidak boleh kosong!', 'error'));
                } else if (password == "") {
                    $("#pesan").html(Swal.fire('Ooops!', 'Password tidak boleh kosong!', 'error'));
                } else {
                    document.getElementById('form').onsubmit = false;
                }
            })

        });

        function lookPass() {
            let pass = document.getElementById('password');
            if (pass.type === "password") {
                pass.type = "text";
            } else {
                pass.type = "password";
            }
        }
    </script>
</body>

</html>
