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
                        <h5>The Leader in Online Learning</h5>
                        <h1>Engaging &  Accessible Online Courses For All</h1>
                        <p>Own your future learning new skills online</p>
                    </div>
                    <div class="banner-content">
                    <form class="form" action="/courses">
                        <div class="form-inner">
                            <div class="input-group">
                                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                <input type="text" name="search" class="form-control" placeholder="Search Tentor, Class, etc">
                                <span class="drop-detail">
                                    <select class="form-select select" name="lesson">
                                        <option value="">Lesson</option>
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
                        <p>Trusted by over 15K Users <br>worldwide since 2022</p>
                        <div class="trust-rating d-flex align-items-center">
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
                        </div>
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
                                    <p>Lessons</p>
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
                                    <p>Expert Tentors</p>
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
                                    <p>Courses</p>
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
                                    <p>Online Students</p> 
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
                <span>Favourite Lesson</span>
                <h2>Top Lesson</h2>
            </div>
            {{-- <div class="all-btn all-category d-flex align-items-center">
                <a href="job-category.html" class="btn btn-primary">All Categories</a>
            </div> --}}
        </div>
        <div class="section-text aos" data-aos="fade-up">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>
        </div>
        <div class="owl-carousel mentoring-course owl-theme aos" data-aos="fade-up">
            @foreach ($lessons as $lesson)
            <a href="/courses?lesson={{$lesson->id}}">
                <div class="feature-box text-center " >					
                    <div class="feature-bg" >					
                        <div class="feature-header">
                            <div class="feature-icon">
                                <img src="{{asset('assets/img/categories-icon.png')}}" alt="">
                            </div>		
                            <div class="feature-cont">	
                                <div class="feature-text">{{$lesson->name}}</div>
                            </div>
                        </div>
                        <p>{{$lesson->courses->count()}} Tentors</p>
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
                <span>What’s New</span>
                <h2>Featured Courses</h2>
            </div>
            <div class="all-btn all-category d-flex align-items-center">
                <a href="/courses" class="btn btn-primary">All Courses</a>
            </div>
        </div>
        <div class="section-text aos" data-aos="fade-up">
            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>
        </div>
        <div class="course-feature">
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="course-box d-flex aos" data-aos="fade-up">
                            <div class="product">
                                <div class="product-img">
                                    <a href="/courses/{{$course->id}}">
                                        <img class="img-fluid" alt="" src="{{asset('assets/img/course/course-01.jpg')}}">
                                    </a>
                                    <div class="price">
                                        <h3>{{rupiah($course->price)}}</h3>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="course-group d-flex">
                                        <div class="course-group-img d-flex">
                                            <a href="instructor-profile.html"><img src="{{asset('assets/img/user/user1.jpg')}}" alt="" class="img-fluid"></a>
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
                        <span>What’s New</span>
                        <h2>Master the skills to drive your career</h2>
                    </div>
                </div>
                <div class="section-text aos" data-aos="fade-up">
                    <p>Get certified, master modern tech skills, and level up your career — whether you’re starting out or a seasoned pro. 95% of eLearning learners report our hands-on content directly helped their careers.</p>
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
                                    <p>Stay motivated with engaging instructors</p>
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
                                    <p>Keep up with in the latest in cloud</p>
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
                                    <p>Get certified with 100+ certification courses</p>
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
                                    <p>Build skills your way, from labs to courses</p>
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
                <span>What’s New</span>
                <h2>TRENDING COURSES</h2>
            </div>
            <div class="all-btn all-category d-flex align-items-center">
                <a href="course-list.html" class="btn btn-primary">All Courses</a>
            </div>
        </div>
        <div class="section-text aos" data-aos="fade-up">
            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>
        </div>
        <div class="owl-carousel trending-course owl-theme aos" data-aos="fade-up">
            @foreach ($courses as $course)
                <div class="course-box trend-box">
                    <div class="product trend-product">
                        <div class="product-img">
                            <a href="/courses/{{$course->id}}">
                                <img class="img-fluid" alt="" src="{{asset('assets/img/course/course-07.jpg')}}">
                            </a>
                            <div class="price">
                                <h3>{{rupiah($course->price)}}</h3>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="course-group d-flex">
                                <div class="course-group-img d-flex">
                                    <a href="instructor-profile.html"><img src="{{asset('assets/img/user/user.jpg')}}" alt="" class="img-fluid"></a>
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
                    <h2>Featured Tentor</h2>
                    <div class="section-text aos" data-aos="fade-up">
                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>
                    </div>
                </div>
            </div>
            <div class="owl-carousel instructors-course owl-theme aos" data-aos="fade-up">
                @foreach ($tentors as $tentor)
                    <div class="instructors-widget">
                        <div class="instructors-img ">
                            <a href="instructor-list.html">
                                <img class="img-fluid" alt="" src="{{asset('assets/img/user/user7.jpg')}}">
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
                <span>Trusted By</span>
                <h2>500+ Leading Universities And Companies</h2>
            </div>
        </div>
        <div class="lead-group aos" data-aos="fade-up">
            <div class="lead-group-slider owl-carousel owl-theme">
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/lead-01.png')}}">
                    </div>
                </div>
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/lead-02.png')}}">
                    </div>
                </div>
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/lead-03.png')}}">
                    </div>
                </div>
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/lead-04.png')}}">
                    </div>
                </div>
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/lead-05.png')}}">
                    </div>
                </div>
                <div class="item">
                    <div class="lead-img">
                        <img class="img-fluid" alt="" src="{{asset('assets/img/lead-06.png')}}">
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
                    <h2>Want to share your knowledge? Join us a Tentor</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum necessitatibus sunt explicabo! Facere magni a rem unde ducimus, dolore nemo expedita autem cupiditate explicabo dolor necessitatibus voluptatem nesciunt eos quibusdam.</p>
                    <ul class="course-list">
                        <li><i class="fa-solid fa-circle-check"></i>Best Courses</li>
                        <li><i class="fa-solid fa-circle-check"></i>Top rated Tentors</li>
                    </ul>
                    <div class="all-btn all-category d-flex align-items-center">
                        <a href="instructor-list.html" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Share Knowledge -->

@endpush