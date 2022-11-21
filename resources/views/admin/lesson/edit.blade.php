@extends('layout.master')
@push('title')
<title>Belajarin.Id - Lessons</title>
@endpush
@push('css')
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush
@push('content')
<div class="page-content instructor-page-content">
    <div class="container">
        <div class="row">

            <!-- Sidebar -->
            @include('layout.partials._sidebar')
            <!-- /Sidebar -->

            <!-- Instructor Dashboard -->
            <div class="col-xl-9 col-lg-8 col-md-12">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>                    
                @endif
                <div class="card overview-sec">
                    <div class="card-body">
                        <h5 class="subs-title">Edit Lesson</h5>
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <img src="{{$lesson->getImage()}}" style="width: 250px" alt="">
                            </div>
                            <div class="col-lg-8">
                                <form action="/admin/lessons/{{$lesson->id}}" method="post" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="old_name" value="{{$lesson->name}}">
                                    <div class="form-group">
                                        <label class="form-control-label">Lesson Name</label>
                                        <input type="text" name="name" class="form-control" value="{{old('name') ?? $lesson->name}}" placeholder="Enter lesson name">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Gambar</label>
                                        <input type="file" name="image">
                                        <small class="text-danger">
                                            @if ($errors->has('image')) {{$errors->first('image')}} @endif                                                         
                                        </small>
                                        <small>direkomendasikan ukuran 271 X 203</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Instructor Dashboard -->

        </div>
    </div>
</div>

@endpush

@push('js')
<!-- Select2 JS -->
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endpush
