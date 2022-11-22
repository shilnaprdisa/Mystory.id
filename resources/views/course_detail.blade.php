@extends('layout.tentor')

@push('title')
<title>Belajarin.Id - Courses Detail</title>
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
                            <a href="/user/{{$course->user->username}}"><img src="{{$course->user->getImage()}}" alt="img" class="img-fluid"></a>
                        </div>
                        <div class="instructor-detail me-3">
                            <h5>
                                <a href="/user/{{$course->user->username}}">{{$course->user->name}}</a>
                            </h5>
                            <p>{{$course->user->role}}</p>
                        </div>
                        {{rating($tentor_reviews, $tentor_rating / $tentor_reviews)}}
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <a href="https://wa.me/{{$course->user->country_code}}{{$course->user->phone}}">
                                <span class="web-badge mb-3">0{{$course->user->phone}}</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="mailto:{{$course->user->email}}">
                                <span class="web-badge mb-3">{{$course->user->email}}</span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- <h2>The Complete Web Developer Course 2.0</h2> --}}
				<p>{{$course->user->address->detail}}</p>
                <div class="course-info d-flex align-items-center border-bottom-0 m-0 p-0">
                    <div class="cou-info">
                        <img src="{{asset('assets/img/icon/icon-01.svg')}}" alt="">
                        <p>{{$course->user->courses->count()}} Lesson</p>
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

<!-- Course Content -->
<section class="page-content course-sec">
    <div class="container">

        <div class="row">
            <div class="col-lg-8">
                @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif

                <!-- Instructor -->
                <div class="card instructor-sec">
                    <div class="card-body">
                        <h5 class="subs-title">Course Detail</h5>
                        <div class="instructor-wrap">
                            <div class="about-instructor">
                                <div class="abt-instructor-img">
                                    <a href="instructor-profile.html"><img src="{{$course->getImage()}}" alt="img"
                                            class="img-fluid"></a>
                                </div>
                                <div class="instructor-detail">
                                    <h5><a href="instructor-profile.html">{{$course->lesson->name}}</a></h5>
                                    <p>{{$course->level->name}}</p>
                                </div>
                            </div>
                            {{rating($course->reviews->count(), $course->reviews->sum('rating'))}}
                        </div>
                        <div class="course-info d-flex align-items-center">
                            <div class="cou-info">
                                <img src="{{asset('assets/img/icon/timer-icon.svg')}}" alt="">
                                <p>{{rupiah($course->price)}}/Jam</p>
                            </div>
                            <div class="cou-info">
                                <img src="{{asset('assets/img/icon/people.svg')}}" alt="">
                                <p>{{$course->transactions->count()}} Transactions</p>
                            </div>
                        </div>
                        <p>{{$course->description}}</p>
                        {{-- <p>Available for:</p>
                        <ul>
                            <li>1. Full Time Office Work</li>
                            <li>2. Remote Work</li>
                            <li>3. Freelance</li>
                            <li>4. Contract</li>
                            <li>5. Worldwide</li>
                        </ul> --}}
                    </div>
                </div>
                <!-- /Instructor -->

                <!-- Reviews -->

                @if (Session::has('review'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('review')}}
                </div>
                @endif

                <div class="card review-sec">
                    <div class="card-body">
                        <h5 class="subs-title">Reviews</h5>
                        @if (isRole('Student'))
                            @if (auth()->user()->transactions->where('course_id', $course->id)->first())
                                @php
                                    $studentReview = $reviews->where('user_id', auth()->user()->id)->first();
                                @endphp
                                @if ($reviews->where('user_id', auth()->user()->id))
                                <strong>Your Review</strong>
                                <p class="rev-info">“ {{$studentReview->comment}} “</p>
                                @endif
                                <form action="/reviews" method="post">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="type" value="comment">
                                    <input type="hidden" name="id" value="{{$studentReview->id}}">
                                    <div class="setRating rating">
                                        <input id="rating1" type="radio" name="rating" value="1" @if($studentReview->rating == '1') checked @endif>
                                        <label for="rating1" data-id="1" class="rate"><i class="rate1 fas fa-star filled"></i></label>
                                        <input id="rating2" type="radio" name="rating" value="2" @if($studentReview->rating == '2') checked @endif>
                                        <label for="rating2" data-id="2" class="rate"><i class="rate2 fas fa-star filled"></i></label>
                                        <input id="rating3" type="radio" name="rating" value="3" @if($studentReview->rating == '3') checked @elseif(!$studentReview->rating) checked @endif>
                                        <label for="rating3" data-id="3" class="rate"><i class="rate3 fas fa-star filled"></i></label>
                                        <input id="rating4" type="radio" name="rating" value="4" @if($studentReview->rating == '4') checked @endif>
                                        <label for="rating4" data-id="4" class="rate"><i class="rate4 fas fa-star filled"></i></label>
                                        <input id="rating5" type="radio" name="rating" value="5" @if($studentReview->rating == '5') checked @endif>
                                        <label for="rating5" data-id="5" class="rate"><i class="rate5 fas fa-star filled"></i></label>
                                      </div>
                                    <div class="form-group">
                                        <textarea rows="4" name="comment" class="form-control"
                                            placeholder="Your Comments">{{$studentReview->comment}}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-reply">
                                        <i class="feather-corner-up-left"></i>
                                        {{($studentReview->rating) ? 'Update' : 'Submit'}}
                                    </button>
                                </form>                                
                            @endif                            
                        @endif
                        <hr>
                        @foreach ($reviews as $review)
                            <div class="instructor-wrap">
                                <div class="about-instructor">
                                    <div class="abt-instructor-img">
                                        <a href="#!"><img src="{{$review->user->getImage()}}"
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
                        @endforeach                        
                    </div>
                </div>
                <!-- /Reviews -->
                {{pagi($reviews->currentPage(), $reviews->lastPage())}}
            </div>
            <div class="col-lg-4">
                <form action="/transactions" method="post">
                    @csrf
                    <div class="benefit-box">
                        <h5>Basic Info</h5>
                        <ul>
                            <li>{{$course->lesson->name}}</li>
                            <li>{{$course->level->name}}</li>
                            <li>{{rupiah($course->price)}}/Jam</li>
                        </ul>
                        <hr>
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        <div class="form-group">
                            <label class="form-control-label">Mau berapa jam?</label>
                            <input type="number" name="time" value="{{old('time')}}" class="form-control" placeholder="misal: 2" id="time">
                            @if ($errors->has('time'))
                                <span class="invalid-text">wajib diisi</span>
                            @endif
                        </div>
                        <div class="result" style="display: none">
                            <table>
                                <tr>
                                    <td>Admin Fee</td>
                                    <td> : {{transFee('withType')}}</td>
                                </tr>
                                <tr>
                                    <td>Sub total</td>
                                    <td id="subTotal"></td>
                                </tr>
                            </table>
                            <hr>
                            <table>
                                <tr>
                                    <td><strong>Total</strong></td>
                                    <td><strong id="total"></strong></td>
                                </tr>
                            </table>
                            <hr>
                        </div>
                        @if (isRole('Student'))
                            <button type="submit" class="btn btn-secondary w-100">Pesan</button>
                        @else
                            <a href="/login" class="btn btn-secondary w-100">Login</a>  
                            <small>anda harus login untuk memesan.</small>                      
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /Pricing Plan -->
@endpush

@push('js')
<script src="{{asset('assets/js/custom.js')}}"></script>
<script>
$(document).ready(function () {
    let price = {!! $course->price !!}
    setStar(false)
    $('.rate').hover(function(){
        setStar($(this).data('id'))
    },function(){
        setStar(false)
    })

    $('.rate').on('click', function(){
        $(`#rating${$(this).data('id')}`).prop('checked', true);
        setStar(false)
    })
    
    $('#time').keyup(function(){
        if(!$(this).val().length){
            $('.result').fadeOut();
        }else{
            let subTotal = price * $(this).val();
            $('#subTotal').text(' : '+ rupiah(subTotal.toString(), 'Rp '))
            $.ajax({
                url: '/fee/transFee/'+subTotal,
                type: "GET",
                dataType: "json",
                success: function (data) {
                     let total = subTotal + data;
                     total = rupiah(total.toString(), 'Rp ')
                    $('#total').text(' : '+ total)
                }
            });
            $('.result').fadeIn();
        }
    });
});

function setStar(hover){
    let rate = (hover) ? hover : $("input[type='radio'][name='rating']:checked").val();
    for(let i = 1; i<=5; i++){
        if(i <= rate){
            $('.rate'+i).attr('class', 'rate'+i+' fas fa-star filled')
        }else{
            $('.rate'+i).attr('class', 'rate'+i+' fas fa-star')
        }
    }
}
</script>
@endpush
