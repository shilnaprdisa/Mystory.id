@extends('layout.site')

@push('title')
<title>Belajarin.Id</title>
@endpush

@push('content')
<!-- Home Banner -->
<section class="home-slide d-flex align-items-center">
    <div class="container">
        <div class="row ">
            <div class="col-md-7">
                <div class="home-slide-face aos" data-aos="fade-up">
                    <div class="home-slide-text ">
                        <h5>Belajarin.ID</h5>
                        <h1>Belajar Kapanpun Dan Dimanapun</h1>
                        <p>Tingkatkan skill untuk meraih masadepan</p>
                    </div>
                    <div class="banner-content">
                    <form class="form" action="/courses">
                        <div class="form-inner">
                            <div class="input-group">
                                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                <input type="text" name="search" class="form-control" placeholder="Cari Tentor, Kelas, atau Apapun">
                                <span class="drop-detail">
                                    <select class="form-select select" name="lesson">
                                        <option value="">Pelajaran</option>
                                        @foreach ($lessons as $lesson)
                                            <option value="{{$lesson->id}}">{{$lesson->name}}</option>                                            
                                        @endforeach
                                    </select>
                                </span>
                                <button class="btn btn-primary sub-btn" type="submit"><i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="trust-user">
                        <p>Nikmati sensasi belajar yang menyenangkan dengan tentor berpengalaman</p>
                        {{-- <div class="trust-rating d-flex align-items-center">
                            <div class="rate-head">
                                <h2><span>1000</span>+</h2>
                            </div>
                            <div class="rating d-flex align-items-center">	
                                <h2 class="d-inline-block average-rating">4.4</h2>	
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-5 d-flex align-items-center">
                <div class="girl-slide-img aos" data-aos="fade-up">
                    <img src="{{asset('assets/img/object.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Home Banner -->
<section class="section student-course">
    <div class="container">
        <div class="course-widget">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="course-full-width">
                        <div class="blur-border course-radius align-items-center aos" data-aos="fade-up">
                            <div class="online-course d-flex align-items-center">
                                <div class="course-img">
                                    <img src="{{asset('assets/img/pencil-icon.svg')}}" alt="">
                                </div>
                                <div class="course-inner-content">
                                    <h4><span>{{$lessons->count()}}</span></h4>
                                    <p>Mata Pelajaran</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="course-full-width">
                        <div class="blur-border course-radius aos" data-aos="fade-up">
                            <div class="online-course d-flex align-items-center">
                                <div class="course-img">
                                    <img src="{{asset('assets/img/cources-icon.svg')}}" alt="">
                                </div>
                                <div class="course-inner-content">
                                    <h4><span>{{$tentors->total()}}</span></h4>
                                    <p>Tentor</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="course-full-width">
                        <div class="blur-border course-radius aos" data-aos="fade-up">
                            <div class="online-course d-flex align-items-center">
                                <div class="course-img">
                                    <img src="{{asset('assets/img/certificate-icon.svg')}}" alt="">
                                </div>
                                <div class="course-inner-content">
                                    <h4><span>{{$tentors->total()}}</span></h4>
                                    <p>Kursus</p>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="course-full-width">
                        <div class="blur-border course-radius aos" data-aos="fade-up">
                            <div class="online-course d-flex align-items-center">
                                <div class="course-img">
                                    <img src="{{asset('assets/img/gratuate-icon.svg')}}" alt="">
                                </div>
                                <div class="course-inner-content">
                                    <h4><span>{{$students}}</span></h4>
                                    <p>Pelajar</p> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home Banner -->

<!-- Top Categories -->
<section class="section how-it-works">
    <div class="container">
        <div class="section-header aos" data-aos="fade-up">
            <div class="section-sub-head">
                <span>Mata Pelajaran Favorite</span>
                <h2>Mata Pelajaran Terbaik</h2>
            </div>
            {{-- <div class="all-btn all-category d-flex align-items-center">
                <a href="job-category.html" class="btn btn-primary">All Categories</a>
            </div> --}}
        </div>
        <div class="section-text aos" data-aos="fade-up">
            <p>Temukan kursus sesuai bakat dan minat berdasarkan mata pelajaran yang tersedia</p>
        </div>
        <div class="owl-carousel mentoring-course owl-theme aos" data-aos="fade-up">
            @foreach ($lessons as $lesson)
            <a href="/courses?lesson={{$lesson->id}}">
                <div class="feature-box text-center " >					
                    <div class="feature-bg" >					
                        <div class="feature-header">
                            <div class="feature-icon">
                                <img src="{{$lesson->getImage()}}" alt="">
                            </div>		
                            <div class="feature-cont">	
                                <div class="feature-text">{{$lesson->name}}</div>
                            </div>
                        </div>
                        <p>{{$lesson->courses->count()}} Tentor</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>	
<!-- /Top Categories -->	

<!-- Feature Course -->		
<section class="section new-course">
    <div class="container">
        <div class="section-header aos" data-aos="fade-up">
            <div class="section-sub-head">
                <span>Yang Terbaru Dari Kami</span>
                <h2>Kursus Unggulan</h2>
            </div>
            <div class="all-btn all-category d-flex align-items-center">
                <a href="/courses" class="btn btn-primary">Semua Kursus</a>
            </div>
        </div>
        <div class="section-text aos" data-aos="fade-up">
            <p class="mb-0">Temukan kursus unggulan dan mulailah belajar dengan kami, Pesan sekarang juga!</p>
        </div>
        <div class="course-feature">
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="course-box d-flex aos" data-aos="fade-up">
                            <div class="product">
                                <div class="product-img">
                                    <a href="/courses/{{$course->id}}">
                                        <img class="img-fluid" alt="" src="{{$course->getImage()}}">
                                    </a>
                                    <div class="price">
                                        <h3>{{rupiah($course->price)}}</h3>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="course-group d-flex">
                                        <div class="course-group-img d-flex">
                                            <a href="instructor-profile.html"><img src="{{$course->user->getImage()}}" alt="" class="img-fluid"></a>
                                            <div class="course-name">
                                                <h4><a href="instructor-profile.html">{{$course->user->name}}</a></h4>
                                                <p>{{$course->user->role}}</p>
                                            </div>
                                        </div>
                                        <div class="course-share d-flex align-items-center justify-content-center">
                                            <a href="#"><i class="fa-regular fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <h3 class="title instructor-text"><a href="/courses/{{$course->id}}">{{$course->lesson->name}} {{$course->level->name}}</a></h3>
                                    {{-- <div class="course-info d-flex align-items-center">
                                        <div class="rating-img d-flex align-items-center">
                                            <img src="{{asset('assets/img/icon/icon-01.svg')}}" alt="">
                                            <p>12+ Lesson</p>
                                        </div>
                                        <div class="course-view d-flex align-items-center">
                                            <img src="{{asset('assets/img/icon/icon-02.svg')}}" alt="">
                                            <p>9hr 30min</p>
                                        </div>
                                    </div> --}}
									{{rating($course->reviews->count(), $course->reviews->sum('rating'))}}
                                    <hr>
                                    <div class="all-btn all-category d-flex align-items-center">
                                        <a href="/courses/{{$course->id}}" class="btn btn-primary">Pesan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                @endforeach
            </div>
        </div>
    </div>
</section>	
<!-- /Feature Course -->	

<!-- Master Skill -->	
<section class="section master-skill">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <div class="section-header aos" data-aos="fade-up">
                    <div class="section-sub-head">
                        <span>Motivasi</span>
                        <h2>Kuasai keterampilan untuk meningkatkan prestasi dan karier Anda</h2>
                    </div>
                </div>
                <div class="section-text aos" data-aos="fade-up">
                    <p>Jangan malas untuk belajar karena ilmu adalah harta yang bisa kita bawa ke mana pun tanpa membebani kita.</p>
                </div>
                <div class="career-group aos" data-aos="fade-up">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 d-flex">
                            <div class="certified-group blur-border d-flex">
                                <div class="get-certified d-flex align-items-center">
                                    <div class="blur-box">
                                        <div class="certified-img ">
                                            <img src="{{asset('assets/img/icon/icon-1.svg')}}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                    <p>Tetap termotivasi dengan pembelajaran yang menarik</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 d-flex">
                            <div class="certified-group blur-border d-flex">
                                <div class="get-certified d-flex align-items-center">
                                    <div class="blur-box">
                                        <div class="certified-img ">
                                            <img src="{{asset('assets/img/icon/icon-2.svg')}}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                    <p>Ikuti perkembangan terbaru</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 d-flex">
                            <div class="certified-group blur-border d-flex">
                                <div class="get-certified d-flex align-items-center">
                                    <div class="blur-box">
                                        <div class="certified-img ">
                                            <img src="{{asset('assets/img/icon/icon-3.svg')}}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                    <p>Proses belajar mengajar yang fleksible</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 d-flex">
                            <div class="certified-group blur-border d-flex">
                                <div class="get-certified d-flex align-items-center">
                                    <div class="blur-box">
                                        <div class="certified-img ">
                                            <img src="{{asset('assets/img/icon/icon-4.svg')}}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                    <p>Prestasi anda merupakan suatu kebanggaan untuk kami</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 d-flex align-items-end">
                <div class="career-img aos" data-aos="fade-up">
                    <img src="{{asset('assets/img/join.png')}}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Master Skill -->			

<!-- Trending Course -->
<section class="section trend-course">
    <div class="container">
        <div class="section-header aos" data-aos="fade-up">
            <div class="section-sub-head">
                <span>Terbaru</span>
                <h2>KURSUS TERPOPULER</h2>
            </div>
            <div class="all-btn all-category d-flex align-items-center">
                <a href="course-list.html" class="btn btn-primary">Semua Kursus</a>
            </div>
        </div>
        <div class="section-text aos" data-aos="fade-up">
            <p class="mb-0">Temukan kursus yang paling banyak diminati, jangan sampai kalah dengan yang lain</p>
        </div>
        <div class="owl-carousel trending-course owl-theme aos" data-aos="fade-up">
            @foreach ($courses as $course)
                <div class="course-box trend-box">
                    <div class="product trend-product">
                        <div class="product-img">
                            <a href="/courses/{{$course->id}}">
                                <img class="img-fluid" alt="" src="{{$course->getImage()}}">
                            </a>
                            <div class="price">
                                <h3>{{rupiah($course->price)}}</h3>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="course-group d-flex">
                                <div class="course-group-img d-flex">
                                    <a href="instructor-profile.html"><img src="{{$course->user->getImage()}}" alt="" class="img-fluid"></a>
                                    <div class="course-name">
                                        <h4><a href="instructor-profile.html">{{$course->user->name}}</a></h4>
                                        <p>{{$course->user->role}}</p>
                                    </div>
                                </div>
                                <div class="course-share d-flex align-items-center justify-content-center">
                                    <a href="#"><i class="fa-regular fa-heart"></i></a>
                                </div>
                            </div>
                            <h3 class="title"><a href="/courses/{{$course->id}}">{{$course->lesson->name}} {{$course->level->name}}</a></h3>
                            {{-- <div class="course-info d-flex align-items-center">
                                <div class="rating-img d-flex align-items-center">
                                    <img src="{{asset('assets/img/icon/icon-01.svg')}}" alt="" class="img-fluid">
                                    <p>13+ Lesson</p>
                                </div>
                                <div class="course-view d-flex align-items-center">
                                    <img src="{{asset('assets/img/icon/icon-02.svg')}}" alt="" class="img-fluid">
                                    <p>10hr 30min</p>
                                </div>
                            </div> --}}
								{{rating($course->reviews->count(), $course->reviews->sum('rating'))}}
                            <div class="all-btn all-category d-flex align-items-center">
                                <a href="/courses/{{$course->id}}" class="btn btn-primary">Pesan</a>
                            </div>
                        </div>
                    </div>
                </div>                
            @endforeach
        </div>
        
        <!-- Feature Instructors -->
        <div class="feature-instructors">
            <div class="section-header aos" data-aos="fade-up">
                <div class="section-sub-head feature-head text-center">
                    <h2>Tentor Unggulan</h2>
                    <div class="section-text aos" data-aos="fade-up">
                        <p class="mb-0">Tentor berpengalaman dan berkompeten, siap membantu untuk meningkatkan prestasi</p>
                    </div>
                </div>
            </div>
            <div class="owl-carousel instructors-course owl-theme aos" data-aos="fade-up">
                @foreach ($tentors as $tentor)
                    <div class="instructors-widget">
                        <div class="instructors-img ">
                            <a href="instructor-list.html">
                                <img class="img-fluid" alt="" src="{{$tentor->getImage()}}">
                            </a>
                        </div>
                        <div class="instructors-content text-center">
                            <h5><a href="instructor-profile.html">{{$tentor->name}}</a></h5>
                            <p>{{$tentor->role}}</p>
                            <div class="student-count d-flex justify-content-center">
                                <i class="fa-solid fa-book"></i>
                                <span>{{$tentor->courses->count()}} Courses</span>
                            </div>
                        </div>
                    </div>                    
                @endforeach
            </div>
        </div>
        <!-- /Feature Instructors -->
        
    </div>
</section>
<!-- /Trending Course -->

<!-- Leading Companies -->
<section class="section lead-companies">
    <div class="container">
        <div class="section-header aos" data-aos="fade-up">
            <div class="section-sub-head feature-head text-center">
                <span>Metode Pembayaran</span>
                <h2>Pembayaran Mudah dan Cepat</h2>
            </div>
        </div>
        <div class="lead-group aos" data-aos="fade-up">
            <div class="lead-group-slider owl-carousel owl-theme">
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/gopay.png')}}">
                    </div>
                </div>
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/shopee.png')}}">
                    </div>
                </div>
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/qris.png')}}">
                    </div>
                </div>
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/visa.png')}}">
                    </div>
                </div>
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/mastercard.png')}}">
                    </div>
                </div>
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/jcb.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/bca.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/bni.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/briva.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/mandiri.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/permata.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/atmbersama.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/alto.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/prima.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/indomaret.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/alfamart.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/alfamidi.jpg')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/isaku.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/dandan.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/bcaklikpay.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/octo.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/brimo.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/danamon.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/uob.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/akulaku.png')}}">
                    </div>
                </div>							
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/payment/kredivo.png')}}">
                    </div>
                </div>							
            </div>
        </div>
    </div>
</section>
<!-- /Leading Companies -->

<!-- Share Knowledge -->
<section class="section share-knowledge">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="knowledge-img aos" data-aos="fade-up">
                    <img src="{{asset('assets/img/share.png')}}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center"> 
                <div class="join-mentor aos" data-aos="fade-up">
                    <h2>Ingin berbagi ilmu? Bergabunglah dengan kami sebagai Tentor</h2>
                    <p>Anda merasa jiwanya terpanggil untuk berbagi ilmu pengetahuan, mari bergabung bersama kami! Kami mengajak anda para tentor berpengalaman untuk menyalurkan ilmu serta mencerdaskan kehidupan bangsa, dan dapatkan penghasilan tambahan dari menjadi seorang tentor.</p>
                    <ul class="course-list">
                        <li><i class="fa-solid fa-circle-check"></i>Kursus Terbaik</li>
                        <li><i class="fa-solid fa-circle-check"></i>Tentor peringkat teratas</li>
                    </ul>
                    <div class="all-btn all-category d-flex align-items-center">
                        <a href="/register/Tentor" class="btn btn-primary">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Share Knowledge -->

@endpush