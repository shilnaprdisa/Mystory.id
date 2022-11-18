<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Belajarin.Id - Register</title>

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
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
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
                            <img src="{{asset('assets/img/login-img.png')}}" class="img-fluid" alt="Logo">
                        </div>
                        <div class="mentor-course text-center">
                            <h2>Selamat datang di <br>Belajarin.Id</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Login Banner -->

            <div class="col-md-6 login-wrap-bg">

                <!-- Login -->
                <div class="login-wrapper">
                    <div class="loginbox">
                        <div class="img-logo">
                            <img src="{{config('belajarin.logo')}}" class="img-fluid" alt="Logo">
                            <div class="back-home">
                                <a href="/">Kembali ke Beranda</a>
                            </div>
                        </div>
                        <h1>
                            {{($type == 'Tentor') ? 'Daftar Tentor' : 'Daftar'}}
                        </h1>
                        <form action="/register" id="form-register" method="post">
                            @csrf
                            <input type="hidden" name="iso_code" value="ID">
                            <input type="hidden" name="country_code" value="62">
                            <input type="hidden" name="role" value="{{$type}}">
                            <div class="form-group">
                                <label class="form-control-label">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Masukan nama lengkap">
                                @if ($errors->has('name'))
                                <span class="invalid-text">nama wajib diisi</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" class="form-control" value="{{old('username')}}" placeholder="Masukan Username">
                                @if ($errors->has('username'))
                                <span class="invalid-text">username wajib diisi</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="Masukan Email">
                                @if ($errors->has('email'))
                                <span class="invalid-text">email wajib diisi</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" value="{{old('phone')}}" placeholder="Masukan Phone">
                                @if ($errors->has('phone'))
                                <span class="invalid-text">phone wajib diisi</span>
                                @endif
                            </div>
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1"
                                    value="Male">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2"
                                    value="Female" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Perempuan
                                </label>
                            </div>
                            @include('layout.partials._create_address')
                            <div class="form-group">
                                <label class="form-control-label">Password <span class="text-danger">*</span></label>
                                <div class="pass-group">
                                    <input type="password" name="password" id="passwordInput"
                                        class="form-control pass-input" value="{{old('password')}}" placeholder="Masukan password">
                                    <span class="toggle-password feather-eye"></span>
                                    <span class="pass-checked"><i class="feather-check"></i></span>
                                </div>
                                <span class="invalid-text" id="errorPassword"></span>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Konfirmasi Password <span
                                        class="text-danger">*</span></label>
                                        <input type="password" id="confirmPassword" class="form-control pass-input"
                                            placeholder="Konfirmasi password">
                                <span class="invalid-text" id="errorConfirmPassword"></span>
                            </div>

                            <div class="form-check remember-me">
                                <label class="form-check-label mb-0">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember"> Saya
                                    menyetujui <a href="#!">Ketentuan layanan</a> and <a href="#!">Privacy Policy.</a>
                                </label>
                                <span class="invalid-text" id="errorRemember"></span>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-start" type="submit">Daftar</button>
                            </div>
                        </form>
                    </div>
                    <div class="google-bg text-center">
                        {{-- <span><a href="#">Or sign in with</a></span>
                        <div class="sign-google">
                            <ul>
                                <li><a href="#"><img src="{{asset('assets/img/net-icon-01.png')}}" class="img-fluid"
                                            alt="Logo"> Sign In using Google</a></li>
                                <li><a href="#"><img src="{{asset('assets/img/net-icon-02.png')}}" class="img-fluid"
                                            alt="Logo">Sign In using Facebook</a></li>
                            </ul>
                        </div> --}}
                        <p class="mb-0">Sudah punya akun? <a href="/login">Masuk</a></p>
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

    @stack('js')

    <script>
        $('#form-register').on('submit', function () {
            $('#errorPassword').text('')
            $('#errorConfirmPassword').text('')
            $('#errorRemember').text('')
            if (!$('#remember').is(":checked")) {
                event.preventDefault();
                $('#errorRemember').text('pastikan anda sudah menyetujui kebijakan kami')
            }
            if ($('#passwordInput').val() != $('#confirmPassword').val()) {
                event.preventDefault();
                $('#errorConfirmPassword').text('Password tidak sesuai')
            }
            if ($('#passwordInput').val() == '') {
                event.preventDefault();
                $('#errorPassword').text('Password tidak boleh kosong')
            }
            if ($('#passwordInput').val().length < 8) {
                event.preventDefault();
                $('#errorPassword').text('Password minimal 8 huruf')
            }
        })

    </script>


</body>

</html>
