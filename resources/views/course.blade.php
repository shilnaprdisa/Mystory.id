@extends('layout.catalog')

@push('title')
<title>Belajarin.Id - Courses</title>
@endpush

@push('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-12">
				<div class="breadcrumb-list">
					<nav aria-label="breadcrumb" class="page-breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Home</a></li>
							<li class="breadcrumb-item" aria-current="page">Courses</li>
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
			<div class="col-lg-9">
			
				<!-- Filter -->
				<div class="showing-list">
					<div class="row">
						<div class="col-lg-6">
							<div class="d-flex align-items-center">
								<div class="view-icons">
									<a href="#!" class="grid-view active"><i class="feather-grid"></i></a>
									{{-- <a href="course-list.html" class="list-view"><i class="feather-list"></i></a> --}}
								</div>
								<div class="show-result">
									<h4>Showing {{$courses->perPage() * $courses->currentPage() - $courses->perPage() + 1}}-{{($courses->total() < $courses->perPage() * $courses->currentPage()) ? $courses->total() : $courses->perPage() * $courses->currentPage()}} of {{$courses->total()}} results</h4>
								</div>
							</div>
						</div>
						<div class="col-lg-6">	
							<div class="show-filter add-course-info">
								<form action="#">
									<div class="row gx-2 align-items-center">	
										<div class="col-md-12 col-item">
											<div class=" search-group">
												<i class="feather-search"></i>
												<input type="text" name="search" value="{{request('search') ?? null}}" class="form-control" placeholder="Search our courses" >
											</div>
										</div>
									</div>
								</form>
							</div>	
						</div>
					</div>
				</div>
				<!-- /Filter -->
				
				<div class="row">
					@foreach ($courses as $course)
						<div class="col-lg-4 col-md-6 d-flex">
							<div class="course-box course-design d-flex " >
								<div class="product">
									<div class="product-img">
										<a href="/courses/{{$course->id}}">
											<img class="img-fluid" alt="" src="{{asset('assets/img/course/course-10.jpg')}}">
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
										<div class="all-btn all-category d-flex align-items-center">
											<a href="checkout.html" class="btn btn-primary">ORDER NOW</a>
										</div>
									</div>
								</div>
							</div>
						</div>						
					@endforeach
				</div>
                {{pagi($courses->currentPage(), $courses->lastPage(), ['search' => request('search'), 'lesson' => request('lesson')])}}
				
			</div>
			<div class="col-lg-3 theiaStickySidebar">
				<div class="filter-clear">
					<div class="clear-filter d-flex align-items-center">
						<h4><i class="feather-filter"></i>Filters</h4>
						<div class="clear-text">
							<p>CLEAR</p>
						</div>
					</div>
					
					<!-- Search Filter -->
					<div class="card search-filter">
						<div class="card-body">
							<div class="filter-widget mb-0">
								<div class="categories-head d-flex align-items-center">
									<h4>Course categories</h4>
									<i class="fas fa-angle-down"></i>
								</div>
								<div>
									<label class="custom_check">
										<input type="checkbox" name="select_specialist" >
										<span class="checkmark"></span> Backend (3)

									</label>
								</div>
								<div>
									<label class="custom_check">
										<input type="checkbox" name="select_specialist" >
										<span class="checkmark"></span>  CSS (2)
									</label>
								</div>
								<div>
									<label class="custom_check">
										<input type="checkbox" name="select_specialist">
										<span class="checkmark"></span>  Frontend (2)
									</label>
								</div>
								<div>
									<label class="custom_check">
										<input type="checkbox" name="select_specialist" checked>
										<span class="checkmark"></span> General (2)
									</label>
								</div>
								<div>
									<label class="custom_check">
										<input type="checkbox" name="select_specialist" checked>
										<span class="checkmark"></span> IT & Software (2)
									</label>
								</div>
								<div>
									<label class="custom_check">
										<input type="checkbox" name="select_specialist">
										<span class="checkmark"></span> Photography (2)
									</label>
								</div>
								<div>
									<label class="custom_check">
										<input type="checkbox" name="select_specialist">
										<span class="checkmark"></span>  Programming Language (3)
									</label>
								</div>
								<div>
									<label class="custom_check mb-0">
										<input type="checkbox" name="select_specialist">
										<span class="checkmark"></span>  Technology (2)
									</label>
								</div>
							</div>
						</div>
					</div>
					<!-- /Search Filter -->
					
					<!-- Search Filter -->
					<div class="card search-filter">
						<div class="card-body">
							<div class="filter-widget mb-0">
								<div class="categories-head d-flex align-items-center">
									<h4>Instructors</h4>
									<i class="fas fa-angle-down"></i>
								</div>
								<div>
									<label class="custom_check">
										<input type="checkbox" name="select_specialist" >
										<span class="checkmark"></span> Keny White (10)

									</label>
								</div>
								<div>
									<label class="custom_check">
										<input type="checkbox" name="select_specialist" >
										<span class="checkmark"></span>  Hinata Hyuga (5)
									</label>
								</div>
								<div>
									<label class="custom_check">
										<input type="checkbox" name="select_specialist">
										<span class="checkmark"></span>  John Doe (3)
									</label>
								</div>
								<div>
									<label class="custom_check mb-0">
										<input type="checkbox" name="select_specialist" checked>
										<span class="checkmark"></span> Nicole Brown
									</label>
								</div>
							</div>
						</div>
					</div>
					<!-- /Search Filter -->
					
					<!-- Search Filter -->
					<div class="card search-filter ">
						<div class="card-body">
							<div class="filter-widget mb-0">
								<div class="categories-head d-flex align-items-center">
									<h4>Price</h4>
									<i class="fas fa-angle-down"></i>
								</div>
								<div>
									<label class="custom_check custom_one">
										<input type="radio" name="select_specialist" >
										<span class="checkmark"></span> All (18)

									</label>
								</div>
								<div>
									<label class="custom_check custom_one">
										<input type="radio" name="select_specialist" >
										<span class="checkmark"></span>  Free (3) 

									</label>
								</div>
								<div>
									<label class="custom_check custom_one mb-0">
										<input type="radio" name="select_specialist" checked>
										<span class="checkmark"></span>  Paid (15)
									</label>
								</div>
							</div>
						</div>
					</div>
					<!-- /Search Filter -->
					
					<!-- Latest Posts -->
					<div class="card post-widget ">
						<div class="card-body">
							<div class="latest-head">
								<h4 class="card-title">Popular Courses</h4>
							</div>
							<ul class="latest-posts">
								@foreach ($populars as $popular)
									<li>
										<div class="post-thumb">
											<a href="/courses/{{$popular->id}}">
												<img class="img-fluid" src="{{asset('assets/img/blog/blog-01.jpg')}}" alt="">
											</a>
										</div>
										<div class="post-info free-color">
											<h4>
												<a href="/courses/{{$popular->id}}">
													<strong>{{$popular->user->name}}</strong> <br>
													{{$popular->lesson->name}} {{$popular->level->name}}
												</a>
											</h4>
											<p>{{rupiah($popular->price)}}</p>
										</div>
									</li>									
								@endforeach
							</ul>
						</div>
					</div>
					<!-- /Latest Posts -->
				
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /Course -->
@endpush