<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Divisima | eCommerce Template</title>
	<meta charset="UTF-8">
	<meta name="description" content=" Divisima | eCommerce Template">
	<meta name="keywords" content="divisima, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="{{asset('img/favicon.ico')}}" rel="shortcut icon"/>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{asset('assets_front/css/bootstrap.min.cs')}}s"/>
	<link rel="stylesheet" href="{{asset('assets_front/css/font-awesome.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_front/css/flaticon.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_front/css/slicknav.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_front/css/jquery-ui.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_front/css/owl.carousel.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_front/css/animate.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_front/css/style.css')}}"/>


	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
    <!-- Start Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
    </div>
    <!-- End Page Preloder -->

    <!-- Start Header -->
    @include('partials_front._header')
    <!-- End Header -->




    <!-- Start Main Content -->
    @yield('content')
    <!-- End Main Content -->



    <!-- Start Footer -->
    @include('partials_front._footer')
    <!-- End Footer -->



	<!--====== Javascripts & Jquery ======-->
	<script src="{{asset('assets_front/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('assets_front/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets_front/js/jquery.slicknav.min.js')}}"></script>
	<script src="{{asset('assets_front/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('assets_front/js/jquery.nicescroll.min.js')}}"></script>
	<script src="{{asset('assets_front/js/jquery.zoom.min.js')}}"></script>
	<script src="{{asset('assets_front/js/jquery-ui.min.js')}}"></script>
	<script src="{{asset('assets_front/js/main.js')}}"></script>

	</body>
</html>
