@extends('layout.tentor')

@push('title')
<title>Belajarin.Id - Tentor Courses</title>
@endpush

@push('content')
<section class="page-content course-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>                    
                @endif
                <div class="card instructor-card">
                    <div class="card-header">
                        <h4>My Courses</h4>
                        <a href="#!" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addModal">Create New Course</a>
                    </div>
                    <div class="card-body">
                        @foreach ($courses as $course)
                        <div class="instructor-grid">
                            <div class="product-img">
                                <a href="/tentor/courses/{{$course->id}}">
                                    <img src="{{$course->getImage()}}" class="img-fluid" alt="">
                                </a>
                            </div>
                            <div class="instructor-product-content">
                                <div class="head-course-title">
                                    <h3 class="title">
                                        <a href="/tentor/courses/{{$course->id}}">
                                            {{$course->lesson->name}}
                                        </a>
                                    </h3>
                                </div>
                                <div class="course-info d-flex align-items-center border-bottom-0 pb-0">
                                    <div class="rating-img d-flex align-items-center">
                                        <img src="{{asset('assets/img/icon/icon-01.svg')}}" alt="">
                                        <p>{{$course->level->name}}</p>
                                    </div>
                                    <div class="course-view d-flex align-items-center">
                                        <img src="{{asset('assets/img/icon/icon-02.svg')}}" alt="">
                                        <p>{{rupiah($course->price)}}/Jam</p>
                                    </div>
                                </div>
                                {{rating($course->reviews->count(), $course->reviews->sum('rating'))}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                {{pagi($courses->currentPage(), $courses->lastPage())}}
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/tentor/courses" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <input type="hidden" name="force" value="0">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label  class="form-label">Lesson</label>
                                <select class="form-select select country-select" name="lesson_id">
                                    @foreach ($lessons as $lesson)
                                        <option value="{{$lesson->id}}">{{$lesson->name}}</option>                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label  class="form-label">Class</label>
                                <select class="form-select select country-select" name="level_id">
                                    @foreach ($levels as $level)
                                        <option value="{{$level->id}}">{{$level->name}}</option>                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label  class="form-label">Status</label>
                                <select class="form-select select country-select" name="status">
                                    <option value="Enabled">Enabled</option>   
                                    <option value="Disabled">Disabled</option>   
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Price</label>
                                <input type="number" name="price" class="form-control" placeholder="Price" value="{{old('description')}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" rows="4" class="form-control" id="description"
                                    placeholder="Masukan deskripsi..">{{old('description')}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">                                
                                <label for="image">Gambar</label>
                                <input type="file" class="mb-2" name="image" id="image">
                                <small class="text-danger">
                                    @if ($errors->has('image')) {{$errors->first('image')}} @endif                                                         
                                </small>
                                <small>direkomendasikan ukuran 369 X 271</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush

@push('js')
    
<script>

</script>

@endpush
