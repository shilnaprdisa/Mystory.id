<footer class="footer">

    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">

                    <!-- Footer Widget -->
                    <div class="footer-widget footer-about">
                        <div class="footer-logo">
                            <img src="{{config('belajarin.logo')}}" alt="logo">
                        </div>
                        <div class="footer-about-content">
                            <p>Belajar Kapanpun Dan Dimanapun, ayo raih prestasimu dengan mudah bersama <a href="https://belajarin.id">Belajarin.ID</a> Temukan pengalaman belajar baru dan menyenangkan bersama tentor berpengalaman untuk meningkatkan skill dan meraih masa depan! </p>
                        </div>
                    </div>
                    <!-- /Footer Widget -->

                </div>

                <div class="col-lg-2 col-md-6">

                    <!-- Footer Widget -->
                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">For Student</h2>
                        <ul>
                            <li><a href="#!">Panduan</a></li>
                            <li><a href="#!">FAQ</a></li>
                            @if (isRole('Student'))
                                <li><a href="/logout"> Logout</a></li>
                            @elseif(!auth()->user())
                                <li><a href="/login">Login</a></li>
                                <li><a href="/register/Student">Register</a></li>                                
                            @endif
                        </ul>
                    </div>
                    <!-- /Footer Widget -->

                </div>

                <div class="col-lg-2 col-md-6">

                    <!-- Footer Widget -->
                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">For Tentor</h2>
                        <ul>
                            <li><a href="#!">Panduan</a></li>
                            <li><a href="#!">FAQ</a></li>
                            @if (isRole('Tentor'))
                                <li><a href="/logout"> Logout</a></li>
                            @elseif(!auth()->user())
                                <li><a href="/login">Login</a></li>
                                <li><a href="/register/Tentor">Register</a></li>                                
                            @endif
                        </ul>
                    </div>
                    <!-- /Footer Widget -->

                </div>

                <div class="col-lg-4 col-md-6">

                    <!-- Footer Widget -->
                    <div class="footer-widget footer-contact">
                        <h2 class="footer-title">Contact</h2>
                        <div class="footer-contact-info">
                            <div class="footer-address">
                                <img src="{{asset('assets/img/icon/icon-20.svg')}}" alt="" class="img-fluid">
                                <p> Jl. Kenanga, Gang. Melinjo, No. 28, RT/RW: 02/02, Kelurahan Grendeng, kecamatan Purwokerto utara, Kabupten Banyumas, Jawa Tengah, kode pos 53122 </p>
                            </div>
                            <p>
                                <a href="mailto:belajarinunsoed@gmail.com">
                                    <img src="{{asset('assets/img/icon/icon-19.svg')}}" alt="" class="img-fluid">
                                    belajarinunsoed@gmail.com
                                </a>
                            </p>
                            <p class="mb-0">
                                <a href="https://wa.me/6283103112372">
                                    <img src="{{asset('assets/img/icon/icon-21.svg')}}" alt="" class="img-fluid">
                                    083103112372
                                </a>
                            </p>
                        </div>
                    </div>
                    <!-- /Footer Widget -->

                </div>

            </div>
        </div>
    </div>
    <!-- /Footer Top -->

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">

            <!-- Copyright -->
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6">
                        <div class="privacy-policy">
                            <ul>
                                <li><a href="term-condition.html">Terms</a></li>
                                <li><a href="privacy-policy.html">Privacy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="copyright-text">
                            <p class="mb-0">&copy; 2022 Belajarin.Id All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Copyright -->

        </div>
    </div>
    <!-- /Footer Bottom -->

</footer>
