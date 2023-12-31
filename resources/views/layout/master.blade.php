<!DOCTYPE html>
<html lang="id">

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

    @stack('css')

    <!-- Feather CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/feather.css')}}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        @include('layout.partials._header')
        <!-- /Header -->

        <!-- Page Wrapper -->
        @stack('content')
        <!-- /Page Wrapper -->

        <!-- Footer -->
        @include('layout.partials._footer')
        <!-- /Footer -->

    </div>
    <!-- /Main Wrapper -->

    {{-- modal --}}
    {{-- @include('layout.partials._modal') --}}
    
    <!-- Modal Delete-->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" value="" name="id">
                    <div class="modal-body">
                        <p>Yakin ingin menghapus data?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/ajax-jquery.min.js')}}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Feature JS -->
    <script src="{{asset('assets/plugins/feather/feather.min.js')}}"></script>

    @stack('js')

    <!-- Custom JS -->
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script>
        function deleteConfirm(url){
            alert('aaa')
            $('#deleteForm').action('action', url);
            $('#deleteModal').modal();
        }
    </script>

</body>

</html>
