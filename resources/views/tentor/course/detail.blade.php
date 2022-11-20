@extends('layout.tentor')

@push('title')
<title>Belajarin.Id - Tentor Courses</title>
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
                            <a href="instructor-profile.html"><img src="{{$course->getImage()}}" alt="img" class="img-fluid"></a>
                        </div>
                        <div class="instructor-detail me-3">
                            <h5>
                                <a href="#!">{{$course->lesson->name}}</a>
                            </h5>
                            <p>{{$course->level->name}}</p>
                        </div>
                        {{rating($course->reviews->count(), $course->reviews->sum('rating'))}}
                    </div>
                    <span class="web-badge mb-3">{{$course->status}}</span>
                </div>
                <div class="course-info d-flex align-items-center border-bottom-0 m-0 p-0">
                    <div class="cou-info">
                        <img src="{{asset('assets/img/icon/timer-icon.svg')}}" alt="">
                        <p>{{rupiah($course->price)}}/Jam</p>
                    </div>
                    <div class="cou-info">
                        <img src="{{asset('assets/img/icon/people.svg')}}" alt="">
                        <p>{{$course->transactions->count()}} Transactions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Inner Banner -->

<!-- Course Content -->
<section class="page-content course-sec">
    <div class="container">

        <div class="row">            
            <div class="col-lg-12">
                
                @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif

                <!-- Overview -->
                <div class="card overview-sec">
                    <div class="card-body">
                        <h5 class="subs-title">Course Details</h5>
                        <form action="/tentor/courses/{{$course->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Lesson</label>
                                        <select class="form-select select country-select" name="lesson_id">
                                            @foreach ($lessons as $lesson)
                                            <option value="{{$lesson->id}}"
                                                {{($course->lesson_id == $lesson->id) ? 'selected' : ''}}>
                                                {{$lesson->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Class</label>
                                        <select class="form-select select country-select" name="level_id">
                                            @foreach ($levels as $level)
                                            <option value="{{$level->id}}"
                                                {{($course->level_id == $level->id) ? 'selected' : ''}}>{{$level->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select class="form-select select country-select" name="status">
                                            <option value="Enabled"
                                                {{($course->status == 'Enabled') ? 'selected' : ''}}>Enabled</option>
                                            <option value="Disabled"
                                                {{($course->status == 'Disabled') ? 'selected' : ''}}>Disabled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Price</label>
                                        <input type="number" name="price" value="{{$course->price}}"
                                            class="form-control" placeholder="Price">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea name="description" rows="4" class="form-control" id="description"
                                            placeholder="Masukan deskripsi..">{{old('description') ?? $course->description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">                                
                                        <label for="image">Gambar</label> <br>
                                        <input type="file" class="mb-2" name="image" id="image"> <br>
                                        <small class="text-danger">
                                            @if ($errors->has('image')) {{$errors->first('image')}} @endif                                                         
                                        </small> <br>
                                        <small>direkomendasikan ukuran 271 X 203</small>
                                    </div>
                                </div>
                            </div>
                            <div style="float: right">
                                <button type="submit" class="btn btn-dark">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Overview -->

                <!-- Reviews -->

                @if (Session::has('reply'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('reply')}}
                </div>
                @endif

                @foreach ($reviews as $review)
                <div class="card review-sec">
                    <div class="card-body">
                        <h5 class="subs-title">Review From</h5>
                        <div class="instructor-wrap">
                            <div class="about-instructor">
                                <div class="abt-instructor-img">
                                    <a href="instructor-profile.html"><img src="{{asset('assets/img/user/user1.jpg')}}"
                                            alt="img" class="img-fluid"></a>
                                </div>
                                <div class="instructor-detail">
                                    <h5><a href="#!">{{$review->user->name}}</a></h5>
                                    <p>{{$review->user->role}}</p>
                                </div>
                            </div>
                            {{star($review->rating)}}
                        </div>
                        <p class="rev-info">“ {{$review->comment}} “</p>
                        @if (isset($review->reply))
                        <strong>Your Reply</strong>
                        <p class="rev-info">“ {{$review->reply}} “</p>
                        @endif
                        <form action="/tentor/reviews/{{$review->id}}" method="post">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="type" value="reply">
                            <input type="hidden" name="id" value="{{$review->id}}">
                            <div class="form-group">
                                <textarea rows="4" name="reply" class="form-control"
                                    placeholder="Your Comments"></textarea>
                            </div>
                            <button type="submit" class="btn btn-reply">
                                <i class="feather-corner-up-left"></i>
                                {{(isset($review->reply)) ? 'Update Reply' : 'Reply'}}
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
                <!-- /Reviews -->
            </div>                
            {{pagi($reviews->currentPage(), $reviews->lastPage())}}
        </div>
    </div>
</section>
<!-- /Pricing Plan -->
@endpush
