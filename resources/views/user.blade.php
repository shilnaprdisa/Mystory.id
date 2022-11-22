@extends('layout.tentor')

@push('title')
<title>Belajarin.Id - User Detail</title>
@endpush

@push('content')
<!-- Inner Banner -->
<div class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="instructor-wrap border-bottom-0 m-0">
                    <div class="about-instructor align-items-center">
                        <div class="abt-instructor-img">
                            <a href="#!"><img src="{{$user->getImage()}}" alt="img" class="img-fluid"></a>
                        </div>
                        <div class="instructor-detail me-3">
                            <h5>
                                <a href="#!">{{$user->name}}</a>
                            </h5>
                            <p>{{$user->role}}</p>
                        </div>
                        {{rating($tentor_reviews, $tentor_rating / $tentor_reviews)}}
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <a href="https://wa.me/{{$user->country_code}}{{$user->phone}}">
                                <span class="web-badge mb-3">0{{$user->phone}}</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="mailto:{{$user->email}}">
                                <span class="web-badge mb-3">{{$user->email}}</span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- <h2>The Complete Web Developer Course 2.0</h2> --}}
				<p>{{$user->address->detail}}</p>
                <div class="course-info d-flex align-items-center border-bottom-0 m-0 p-0">
                    <div class="cou-info">
                        <img src="{{asset('assets/img/icon/icon-01.svg')}}" alt="">
                        <p>{{$user->courses->count()}} Lesson</p>
                    </div>
                    {{-- <div class="cou-info">
                        <img src="{{asset('assets/img/icon/timer-icon.svg')}}" alt="">
                        <p>{{$course->transactions->where('status','Paid')->sum('time')}} Jam</p>
                    </div> --}}
                    {{-- <div class="cou-info">
                        <img src="{{asset('assets/img/icon/people.svg')}}" alt="">
                        <p>{{$course->transactions->where('status','Paid')->count()}} Transactions</p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Inner Banner -->
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-12">
				<div class="breadcrumb-list">
					<nav aria-label="breadcrumb" class="page-breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Home</a></li>
							<li class="breadcrumb-item" aria-current="page">User</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Breadcrumb -->

<!-- Course -->
<section class="course-content">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">				
				<div class="row">
					@foreach ($user->courses as $course)
						<div class="col-lg-3 col-md-4 d-flex">
							<div class="course-box course-design d-flex " >
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
												<a href="/user/{{$user->username}}"><img src="{{asset('assets/img/user/user1.jpg')}}" alt="" class="img-fluid"></a>
												<div class="course-name">
													<h4><a href="/user/{{$user->username}}">{{$user->name}}</a></h4>
													<p>{{$user->address->city->name}}</p>
												</div>
											</div>
											<div class="course-share d-flex align-items-center justify-content-center">
												<a href="#rate"><i class="fa-regular fa-heart"></i></a>
											</div>
										</div>
										<h3 class="title"><a href="/courses/{{$course->id}}">{{$course->lesson->name}} {{$course->level->name}}</a></h3>
										<div class="course-info d-flex align-items-center">
											<div class="rating-img d-flex align-items-center">
												<img src="{{asset('assets/img/icon/icon-01.svg')}}" alt="">
												<p>{{$course->transactions->where('status', 'Paid')->count()}} Ordered</p>
											</div>
											<div class="course-view d-flex align-items-center">
												<img src="{{asset('assets/img/icon/icon-02.svg')}}" alt="">
												<p>{{$course->transactions->where('status', 'Paid')->sum('time')}} Hours</p>
											</div>
										</div>
										{{rating($course->reviews->count(), $course->reviews->sum('rating'))}}
										<div class="all-btn all-category d-flex align-items-center mt-2">
											<a href="/courses/{{$course->id}}" class="btn btn-primary">Pesan Sekarang</a>
										</div>
									</div>
								</div>
							</div>
						</div>						
					@endforeach
				</div>				
			</div>
		</div>
	</div>
</section>
<!-- /Course -->
@endpush

