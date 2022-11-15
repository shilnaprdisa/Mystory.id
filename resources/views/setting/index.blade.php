<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Belajarin.Id - Setting</title>
		
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
                @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                @if (Session::has('failed'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('failed')}}
                </div>
                @endif
                <a href="{{(auth()->user()->role == 'Customer') ? '/dashboard' : (auth()->user()->role == 'Tentor' ? '/tentor' : '/admin')}}"><i class="fa fa-arrow-left"></i> Dashboard</a>	
                <div class="row">
                    @if (auth()->user()->role == 'Admin' or auth()->user()->role == 'Super')
                    <div class="col-xl-6 col-md-6">
                        <div class="settings-widget profile-details mt-3">
                            <div class="settings-menu p-0">
                                <div class="profile-heading">
                                    <h3>Transaction Fee</h3>
                                    {{-- <p>You have full control to manage your own account setting.</p> --}}
                                </div>
                                <div class="checkout-form personal-address add-course-info">
                                    <form action="/admin/TransFee" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Transaction Fee</label>
                                                    <input type="text" name="TransFee" class="form-control pass-input" value="{{transFee()}}" placeholder="Enter fee">
                                                    <small class="text-danger">
                                                        @if ($errors->has('TransFee'))
                                                            {{$errors->first('TransFee')}}
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="" class="form-check-label">Type</label>
                                                <div class="mt-2">
                                                    <div class="form-check" style="float: left">
                                                        <input class="form-check-input" type="radio" name="TransFeeType"
                                                            value="Persen" @if(transFeeType() == 'Persen') checked @endif>
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Persen
                                                        </label>
                                                    </div>
                                                    <div class="form-check ms-3" style="float: left">
                                                        <input class="form-check-input" type="radio" name="TransFeeType"
                                                            value="Nominal" @if(transFeeType() == 'Nominal') checked @endif>
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            Nominal
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="update-profile">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="settings-widget profile-details mt-3">
                            <div class="settings-menu p-0">
                                <div class="profile-heading">
                                    <h3>Withdrawal Fee</h3>
                                    {{-- <p>You have full control to manage your own account setting.</p> --}}
                                </div>
                                <div class="checkout-form personal-address add-course-info">
                                    <form action="/admin/WidFee" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Withdrawal Fee</label>
                                                    <input type="text" name="WidFee" class="form-control pass-input" value="{{wdFee()}}" placeholder="Enter fee">
                                                    <small class="text-danger">
                                                        @if ($errors->has('WidFee'))
                                                            {{$errors->first('WidFee')}}
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="" class="form-check-label">Type</label>
                                                <div class="mt-2">
                                                    <div class="form-check" style="float: left">
                                                        <input class="form-check-input" type="radio" name="WidFeeType"
                                                            value="Persen" @if(wdFeeType() == 'Persen') checked @endif>
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Persen
                                                        </label>
                                                    </div>
                                                    <div class="form-check ms-3" style="float: left">
                                                        <input class="form-check-input" type="radio" name="WidFeeType"
                                                            value="Nominal" @if(wdFeeType() == 'Nominal') checked @endif>
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            Nominal
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="update-profile">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="settings-widget profile-details mt-3">
                            <div class="settings-menu p-0">
                                <div class="profile-heading">
                                    <h3>Minimal WD</h3>
                                    {{-- <p>You have full control to manage your own account setting.</p> --}}
                                </div>
                                <div class="checkout-form personal-address add-course-info">
                                    <form action="/admin/MinWD" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Minimal Withdrawal (rupiah)</label>
                                                    <input type="text" name="MinWD" class="form-control pass-input" value="{{minWD()}}" placeholder="Enter minimal of Withdrawal">
                                                    <small class="text-danger">
                                                        @if ($errors->has('MinWD'))
                                                            {{$errors->first('MinWD')}}
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="update-profile">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    @endif
						<!-- Change Password -->
						<div class="@if(auth()->user()->role == 'Admin' or auth()->user()->role == 'Super') col-xl-6 col-md-6 @else col-xl-12 col-md-12 @endif">
							<div class="settings-widget profile-details mt-3">
								<div class="settings-menu p-0">
									<div class="profile-heading">
										<h3>Change Password</h3>
										{{-- <p>You have full control to manage your own account setting.</p> --}}
									</div>
									<div class="checkout-form personal-address add-course-info">
										<form action="/updatePassword" method="POST" id="formPassword">
											@csrf
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
                                                        <label class="form-control-label">Current Password <span class="text-danger">*</span></label>
                                                        <div class="pass-group">
                                                            <input type="password" name="current_password" class="form-control pass-input" 
                                                                value="{{old('current_password')}}" id="currentPassword" placeholder="Enter current password">
                                                            <span class="toggle-password feather-eye"></span>
                                                            <span class="pass-checked"><i class="feather-check"></i></span>
                                                        </div>
                                                        <small class="text-danger" id="errorCurrentPassword">
                                                            @if ($errors->has('current_password'))
                                                                {{$errors->first('current_password')}}
                                                            @endif                                                         
                                                        </small>
                                                    </div>
												</div>
												<div class="col-lg-6">
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label class="form-control-label">New Password</label>
														<input type="password" name="password" class="form-control pass-input" value="{{old('password')}}" id="newPassword" placeholder="Enter new password">
                                                        <small class="text-danger" id="errorNewPassword">
                                                            @if ($errors->has('password'))
                                                                {{$errors->first('password')}}
                                                            @endif
                                                        </small>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label class="form-control-label">Confirm Password</label>
														<input type="password" name="confirm_password" class="form-control pass-input" value="{{old('confirm_password')}}" id="confirmPassword" placeholder="Enter confirm password">
                                                        <small class="text-danger" id="errorConfirmPassword">
                                                            @if ($errors->has('confirm_password'))
                                                                {{$errors->first('confirm_password')}}
                                                            @endif
                                                        </small>
													</div>
												</div>
												<div class="update-profile">
													<button type="submit" class="btn btn-primary">Update</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>	
						<!-- Change Password -->
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

        <script>
            $('#formPassword').on('submit', function () {
                $('#errorCurrentPassword').text('')
                $('#errorNewPassword').text('')
                $('#errorConfirmPassword').text('')
                if ($('#newPassword').val() != $('#confirmPassword').val()) {
                    event.preventDefault();
                    $('#errorConfirmPassword').text('Password does not match')
                }
                if ($('#newPassword').val().length < 8) {
                    event.preventDefault();
                    $('#errorNewPassword').text('Password minimum 8 characters')
                }
                if ($('#confirmPassword').val().length < 8) {
                    event.preventDefault();
                    $('#errorConfirmPassword').text('Password minimum 8 characters')
                }
                if ($('#newPassword').val().length < 1) {
                    event.preventDefault();
                    $('#errorNewPassword').text('Password must be filled')
                }
                if ($('#currentPassword').val().length < 1) {
                    event.preventDefault();
                    $('#errorCurrentPassword').text('Password must be filled')
                }
                if ($('#confirmPassword').val().length < 1) {
                    event.preventDefault();
                    $('#errorConfirmPassword').text('Password must be filled')
                }
            })
    
        </script>
		
	</body>
</html>