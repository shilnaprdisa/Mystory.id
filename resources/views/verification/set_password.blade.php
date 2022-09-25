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
                <h2>Ubah Password</h2>
                <p>Silahkan masukan kata sandi baru anda!</p>
                <form action="/prank" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user_id}}">
                    <div class="form-group">
                        <label class="form-control-label">Password <span class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" name="password" id="passwordInput" class="form-control pass-input"
                                value="{{old('password')}}" placeholder="Masukan password">
                            <span class="toggle-password feather-eye"></span>
                            <span class="pass-checked"><i class="feather-check"></i></span>
                        </div>
                        <span class="invalid-text" id="errorPassword"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" id="confirmPassword" class="form-control pass-input"
                                placeholder="Konfirmasi password">
                            <span class="toggle-password feather-eye"></span>
                            <span class="pass-checked"><i class="feather-check"></i></span>
                        </div>
                        <span class="invalid-text" id="errorConfirmPassword"></span>
                    </div>
                    <button class="btn btn-primary btn-start mt-4" type="submit">Kirim</button>
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
