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
						<div class="col-lg-4">
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
						<div class="col-lg-8">	
							<div class="show-filter add-course-info">
								<form action="" method="GET" id="formSearch">
									<input type="hidden" name="lesson" value="{{request('lesson')}}" id="lesson">
									<input type="hidden" name="level" value="{{request('level')}}" id="level">
									<div class="row gx-2 align-items-center">	
										<div class="col-md-4 col-item">
											<div class=" search-group">
												<i class="feather-search"></i>
												<input type="text" name="search" value="{{request('search')}}" class="form-control" placeholder="Search our courses" >
											</div>
										</div>
										<div class="col-md-3 col-item">	
											<div class="search-group">
												<select class="form-select select" name="province" id="province">
												</select>
											</div>										
										</div>
										<div class="col-md-3 col-item">		
											<div class="search-group">
												<img src="{{config('belajarin.loading')}}" alt="BelajarinId" width="35" id="loadcity" style="display:none;">												
												<select class="form-select select" name="city" id="city">
													<option value="">Kota</option>
												</select>
											</div>									
										</div>
										<div class="col-md-2 col-item">											
											<button type="submit" class="btn btn-warning text-white"><i class="fas fa-search"></i></button>
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
											<img class="img-fluid" alt="" src="{{$course->getImage()}}">
										</a>
										<div class="price">
											<h3>{{rupiah($course->price)}}</h3>
										</div>
									</div>
									<div class="product-content">
										<div class="course-group d-flex">
											<div class="course-group-img d-flex">
												<a href="/user/{{$course->user->username}}"><img src="{{asset('assets/img/user/user1.jpg')}}" alt="" class="img-fluid"></a>
												<div class="course-name">
													<h4><a href="/user/{{$course->user->username}}">{{$course->user->name}}</a></h4>
													<p>{{$course->user->address->city->name}}</p>
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
                {{pagi($courses->currentPage(), $courses->lastPage(), [
					'search' => request('search'), 'lesson' => request('lesson'),
					'province' => request('province'), 'city' => request('city')
					])}}
				
			</div>
			<div class="col-lg-3">
				<div class="filter-clear">
					<div class="clear-filter d-flex align-items-center">
						<h4><i class="feather-filter"></i>Filters</h4>
						<div class="clear-text">
							<p><a href="/courses">CLEAR</a></p>
						</div>
					</div>
					
					<!-- Search Filter -->
					<div class="card search-filter">
						<div class="card-body">
							<div class="filter-widget mb-0">
								<div class="categories-head d-flex align-items-center">
									<h4>Lessons</h4>
									<i class="fas fa-angle-down"></i>
								</div>
								@foreach ($lessons as $lesson)
									<div>
										<label class="custom_check custom_one">
											<input type="radio" value="{{$lesson->id}}" @if($lesson->id == request('lesson')) checked @endif name="lesson" >
											<span class="checkmark"></span> {{$lesson->name}} ({{$lesson->courses->where('status', 'Enabled')->count()}})
										</label>
									</div>									
								@endforeach
							</div>
						</div>
					</div>
					<!-- /Search Filter -->
					
					<!-- Search Filter -->
					<div class="card search-filter">
						<div class="card-body">
							<div class="filter-widget mb-0">
								<div class="categories-head d-flex align-items-center">
									<h4>Class</h4>
									<i class="fas fa-angle-down"></i>
								</div>
								@foreach ($levels as $level)
									<div>
										<label class="custom_check">
											<input type="radio" value="{{$level->id}}" @if($level->id == request('level')) checked @endif name="level" >
											<span class="checkmark"></span> {{$level->name}} ({{$level->courses->where('status', 'Enabled')->count()}})
										</label>
									</div>									
								@endforeach
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
												<img class="img-fluid" src="{{$popular->getImage()}}" alt="">
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

@push('js')
<script>
	$(document).ready(function () {
		$("input[type='radio'][name='lesson']").on('change', function(){
			searchForm()
		})
		$("input[type='radio'][name='level']").on('change', function(){
			searchForm()
		})

		//kota
		getProvince();

        $('#province').on('change', function () {
            getCity();
        });

		function getProvince() {
			$.ajax({
				url: '/getProvinces',
				type: "GET",
				dataType: "json",
				success: function (data) {
					let oldProvince = {!! request('province') !!}
					$('#province').empty();
					$('#province').append('<option value="">Provinsi</option>');
					$.each(data, function (key, value) {
						if (key == oldProvince) {
							$('#province').append('<option value="' + key + '" selected>' +
								value + '</option>');
						} else {
							$('#province').append('<option value="' + key + '">' + value +
								'</option>');
						}
					});
					$('#loadprovince').hide();
					getCity();
				}
			});
		}

		function getCity() {
			let province_id = $('#province').val();
			if (province_id) {
				$('#loadcity').show();
				$.ajax({
					url: '/getCities/' + province_id,
					type: "GET",
					dataType: "json",
					success: function (data) {
						let oldCity = {!! request('city') !!}
						$('#city').empty();
						$.each(data, function (key, value) {
							if (key == oldCity) {
								$('#city').append('<option value="' + key + '" selected>' +
									value + '</option>');
							} else {
								$('#city').append('<option value="' + key + '">' + value +
									'</option>');
							}
						});
						$('#loadcity').hide();
					}
				});
			} else {
				$('#city').empty();
				$('#city').append('<option value="">Kota</option>');
			}
		}
	});

	function searchForm(){
		$('#lesson').val($("input[type='radio'][name='lesson']:checked").val())
		$('#level').val($("input[type='radio'][name='level']:checked").val())
		$('#formSearch').submit()
	}
</script>
@endpush