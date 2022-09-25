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
                <img src="{{asset('assets/img/come-soon.png')}}" class="img-fluid" alt="Logo">
            </div>
            <div class="mentor-course text-center">
                <h2>Akun Telah Aktif</h2>
                <p>Selamat akun anda berhasil di aktivasi...</p>
                @if (!auth()->user())
                <a href="/login"
                    class="btn btn-primary btn-start mt-4">Login Sekarang</a>                    
                @else
                <a href="{{($role == 'Customer') ? '/dashboard' : ( $role == 'Tentor' ? '/tentor' : '/admin' )}}"
                    class="btn btn-primary btn-start mt-4">Ke Halaman Dashboard</a>                    
                @endif
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
