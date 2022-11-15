<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		@stack('title')
		
		<!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.svg')}}">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">

		<!-- Owl Carousel CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">
		
		<!-- Slick CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/slick/slick.css')}}">
		<link rel="stylesheet" href="{{asset('assets/plugins/slick/slick-theme.css')}}">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
		
		<!-- Aos CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/aos/aos.css')}}">

		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
            @include('layout.partials._header')
			<!-- /Header -->
			
			@stack('content')
			
			<!-- Footer -->
            @include('layout.partials._footer')
			<!-- /Footer -->
		   
		</div>
	   <!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="{{('assets/js/jquery-3.6.0.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{('assets/js/bootstrap.bundle.min.js')}}"></script>
		
		<!-- counterup JS -->
		<script src="{{('assets/js/jquery.waypoints.js')}}"></script>
		<script src="{{('assets/js/jquery.counterup.min.js')}}"></script>
		
		<!-- Select2 JS -->
		<script src="{{('assets/plugins/select2/js/select2.min.js')}}"></script>

		<!-- Owl Carousel -->
		<script src="{{('assets/js/owl.carousel.min.js')}}"></script>	

		<!-- Slick Slider -->
		<script src="{{('assets/plugins/slick/slick.js')}}"></script>
		
		<!-- Aos -->
		<script src="{{('assets/plugins/aos/aos.js')}}"></script>
		
		<!-- Custom JS -->
		<script src="{{('assets/js/script.js')}}"></script>
		
	</body>
</html>