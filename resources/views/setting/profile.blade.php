<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Belajarin.Id - Profile</title>
		
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

		<div class="page-content">
            <div class="container">
                <div class="row">
						<!-- Profile Details -->
						<div class="col-xl-12 col-md-12">
							@if (Session::has('success'))
							<div class="alert alert-success" role="alert">
								{{Session::get('success')}}
							</div>
							@endif
                            <a href="{{(auth()->user()->role == 'Customer') ? '/dashboard' : (auth()->user()->role == 'Tentor' ? '/tentor' : '/admin')}}"><i class="fa fa-arrow-left"></i> Dashboard</a>	
							<div class="settings-widget profile-details mt-3">
								<div class="settings-menu p-0">
									<div class="profile-heading">
										<h3>Profile Details</h3>
										{{-- <p>You have full control to manage your own account setting.</p> --}}
									</div>
									<div class="course-group mb-0 d-flex">
										<div class="course-group-img d-flex align-items-center">
											<a href="instructor-profile.html"><img src="assets/img/user/user11.jpg" alt="" class="img-fluid"></a>
											<div class="course-name">
												<h4><a href="instructor-profile.html">Your avatar</a></h4>
												<p>PNG or JPG no bigger than 800px wide and tall.</p>
											</div>
										</div>
										<div class="profile-share d-flex align-items-center justify-content-center">
											<form action="#!" method="post" enctype="multipart/form-data">
												@csrf
												<input type="file" class="mb-2" name="profile_picture">
												<button type="button" class="btn btn-success mb-2">Upload</button>
											</form>
										</div>
									</div>
									<div class="checkout-form personal-address add-course-info">
										<div class="personal-info-head">
											<h4>Personal Details</h4>
											<p>Edit your personal information and address.</p>
										</div>
										<form action="/updateProfile" method="POST">
											@csrf
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label class="form-control-label">Name</label>
														<input type="text" name="name" class="form-control" value="{{old('name') ?? auth()->user()->name}}" placeholder="Enter your Name">
                                                        <small class="text-danger">
                                                            @if ($errors->has('name'))
                                                                {{$errors->first('name')}}
                                                            @endif                                                         
                                                        </small>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label class="form-control-label">Phone</label>
														<input type="text" name="phone" class="form-control" value="{{'0'.(old('phone') ?? auth()->user()->phone)}}" placeholder="Enter your Phone">
                                                        <small class="text-danger" id="errorCurrentPassword">
                                                            @if ($errors->has('phone'))
                                                                {{$errors->first('phone')}}
                                                            @endif                                                         
                                                        </small>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label class="form-control-label">Email</label>
														<input type="text" class="form-control" name="email" value="{{old('email') ?? auth()->user()->email}}" placeholder="Enter your Email">
                                                        <small class="text-danger" id="errorCurrentPassword">
                                                            @if ($errors->has('email'))
                                                                {{$errors->first('email')}}
                                                            @endif                                                         
                                                        </small>
													</div>
												</div>
												<div class="col-lg-6">
													<label for="" class="form-check-label mt-2">Gender</label>
													<div class="">
														<div class="form-check" style="float: left">
															<input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1"
																value="Male" @if((old('gender') ?? auth()->user()->gender) == 'Male') checked @endif>
															<label class="form-check-label" for="flexRadioDefault1">
																Laki-laki
															</label>
														</div>
														<div class="form-check ms-3" style="float: left">
															<input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2"
																value="Female" @if((old('gender') ?? auth()->user()->gender) == 'Female') checked @endif>
															<label class="form-check-label" for="flexRadioDefault2">
																Perempuan
															</label>
														</div>
													</div>												
												</div>
												@include('layout.partials._edit_address')
												<div class="update-profile">
													<button type="submit" class="btn btn-primary">Update</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>	
						<!-- Profile Details -->
                </div>
            </div>
        </div>
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

		<!-- Owl Carousel -->
		<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>	
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js')}}"></script>

		@stack('js')
		
	</body>
</html>