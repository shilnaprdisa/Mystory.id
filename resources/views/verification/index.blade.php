<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Belajarin.Id</title>
		
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
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="{{asset('assets/plugins/feather/feather.css')}}">

		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper log-wrap">		
            <div class="welcome-login">
                <div class="login-banner">
                    <img src="{{asset('assets/img/login-img.png')}}" class="img-fluid" alt="Logo">
                </div>
                <div class="mentor-course text-center">
                    <h2>Verifikasi akun anda</h2>
                    <p>kami akan mengirim 6 digit kode berupa angka ke email anda, kode tersebut digunakan untuk memverifikasi bahwa akun ini benar-benar milik anda.</p>
                    <form action="/get-otp-register" method="post">
						@csrf
                        <input type="hidden" name="type" value="{{$type}}">
                        @if ($type == 'ResetPassword')
                        <div class="row">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-2">
                                <input type="email" name="email" class="form-control mt-4" placeholder="Masukan email akun anda">
                            </div>
                        </div>
                        @else
                        <input type="hidden" name="send_via" value="Email">                            
                        @endif

                        <button class="btn btn-primary btn-start mt-4" type="submit">Lanjutkan</button>
                    </form>
                </div>
            </div>
	   </div>
	   <!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

		<!-- Owl Carousel -->
		<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>	
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js')}}"></script>
		
	</body>
</html>