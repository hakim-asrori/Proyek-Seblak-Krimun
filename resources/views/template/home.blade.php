<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" href="{{ url('assets/css/sb-admin-2.min.css') }}">
	<link rel="stylesheet" href="{{ url('assets/vendor/fontawesome-free/css/all.min.css') }}">

	<link rel="stylesheet" type="text/css" href="resources/css/style.css">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="{{ url('assets') }}/vendor/jquery/jquery.min.js"></script>

</head>
<body style="overflow-x: hidden;">
	@yield('home-content')
</body>

<script src="{{ url('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('assets') }}/js/sb-admin-2.min.js"></script>
</html>
