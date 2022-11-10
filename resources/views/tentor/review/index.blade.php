@extends('layout.tentor')

@push('title')
<title>Belajarin.Id - Tentor Reviews</title>
@endpush

@push('content')
<!-- Instructor Dashboard -->
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">

                @if (Session::has('reply'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('reply')}}
                </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="settings-widget">
                            <div class="settings-inner-blk p-0">
                                <div class="sell-course-head comman-space">
                                    <h3>Reviews</h3>
                                    {{-- <p>You have full control to manage your own account setting.</p> --}}
                                </div>
                                @foreach ($reviews as $review)
                                <div class="comman-space bdr-bottom-line">
                                    <div class="instruct-review-blk ">
                                        <div class="review-item">
                                            <div class="instructor-wrap border-0 m-0">
                                                <div class="about-instructor">
                                                    <div class="abt-instructor-img">
                                                        <a href="#!"><img src="{{asset('assets/img/user/user1.jpg')}}"
                                                                alt="img" class="img-fluid"></a>
                                                    </div>
                                                    <div class="instructor-detail">
                                                        <h5><a href="#!">{{$review->user->name}}</a></h5>
                                                        <p>{{$review->course->lesson->name}}
                                                            {{$review->course->level->name}}</p>
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
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>                
            {{pagi($reviews->currentPage(), $reviews->lastPage())}}
        </div>
    </div>
</div>
<!-- /Instructor Dashboard -->
@endpush
