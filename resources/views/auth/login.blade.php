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
		
			<div class="row">
			
				<!-- Login Banner -->
				<div class="col-md-6 login-bg">
					<div class="owl-carousel login-slide owl-theme">
						<div class="welcome-login">
							<div class="login-banner">
								<img src="{{config('belajarin.logo')}}" class="img-fluid" alt="Logo">
							</div>
							<div class="mentor-course text-center">
								<h2>Selamat datang di <br>Belajarin.Id</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
							</div>
						</div>
						<div class="welcome-login">
							<div class="login-banner">
								<img src="{{config('belajarin.logo')}}" class="img-fluid" alt="Logo">
							</div>
							<div class="mentor-course text-center">
								<h2>Selamat datang di <br>Belajarin.Id</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
							</div>
						</div>
						<div class="welcome-login">
							<div class="login-banner">
								<img src="{{config('belajarin.logo')}}" class="img-fluid" alt="Logo">
							</div>
							<div class="mentor-course text-center">
								<h2>Selamat datang di <br>Belajarin.Id</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
							</div>
						</div>
					</div>
				</div>
				<!-- /Login Banner -->
				
				<div class="col-md-6 login-wrap-bg">		
				
					<!-- Login -->
					<div class="login-wrapper">
						<div class="loginbox">
							<div class="w-100">
								<div class="img-logo">
									<img src="{{config('belajarin.logo')}}" class="img-fluid" alt="Logo">
									<div class="back-home">
										<a href="/">Kembali ke Beranda</a>
									</div>
								</div>
								<h1>Login</h1>
                                @if (Session::has('failed'))
                                <div class="alert alert-warning" role="alert">
                                    {{Session::get('failed')}}
                                </div>
                                @endif
								<form action="/login" method="POST">
                                    @csrf
									<div class="form-group">
										<label class="form-control-label">Email</label>
										<input type="text" name="email" class="form-control" placeholder="Email/Username/Phone">
									</div>
									<div class="form-group">
										<label class="form-control-label">Password</label>
										<div class="pass-group">
											<input type="password" name="password" class="form-control pass-input" placeholder="Masukan password">
											<span class="feather-eye toggle-password"></span>
										</div>
									</div>
									<div class="forgot">
										<span><a class="forgot-link" href="/forgot-password">Lupa Password ?</a></span>
									</div>
									{{-- <div class="remember-me">
										<label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me  
											<input type="checkbox" name="radio">
											<span class="checkmark"></span>
										</label>
									</div> --}}
									<div class="d-grid">
										<button class="btn btn-primary btn-start" type="submit">Masuk</button>
									</div>
								</form>
							</div>
						</div>
						<div class="google-bg text-center">
							{{-- <span><a href="#">Or sign in with</a></span>
							<div class="sign-google">
								<ul>
									<li><a href="#"><img src="{{asset('assets/img/net-icon-01.png')}}" class="img-fluid" alt="Logo"> Sign In using Google</a></li>
									<li><a href="#"><img src="{{asset('assets/img/net-icon-02.png')}}" class="img-fluid" alt="Logo">Sign In using Facebook</a></li>
								</ul>
							</div> --}}
							<p class="mb-0">Belum punya akun? <a href="/register/Customer">Daftar</a></p>
							<p class="mb-0">Anda seorang tentor? <a href="/register/Tentor">Daftar Sebagai Tentor</a></p>
						</div>
					</div>
					<!-- /Login -->
					
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