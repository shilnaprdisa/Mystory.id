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
                <div class="row">
                    <div class="col-md-12">
                        <div class="settings-widget">
                            <div class="settings-inner-blk p-0">
                                <div class="sell-course-head comman-space">
                                    <h3>Lessons</h3>
                                    {{-- <p>Manage your lessons and its update like live, draft and insight.</p> --}}
                                </div>
                                <div class="comman-space pb-0">
                                    <div class="instruct-search-blk">
                                        <div class="show-filter choose-search-blk">
                                            <form action="#">
                                                <div class="row gx-2 align-items-center">
                                                    <div class="col-6 col-item">
                                                        <div class=" search-group">
                                                            <i class="feather-search"></i>
                                                            <input type="text" class="form-control"
                                                                placeholder="Search our courses">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-lg-6 col-item text-end">
                                                        <a href="#!"
                                                            class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addLessonModal">New Lesson</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="settings-tickets-blk course-instruct-blk table-responsive">

                                        <!-- Referred Users-->
                                        <table class="table table-nowrap mb-2">
                                            <thead>
                                                <tr>
                                                    <th>GAMBAR</th>
                                                    <th>LESSONS</th>
                                                    <th>USED</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($lessons as $lesson)
                                                    <tr>
                                                        <td>
                                                            <div class="sell-table-group d-flex align-items-center">
                                                                <div class="sell-group-img">
                                                                    <a href="course-details.html">
                                                                        <img src="{{$lesson->getImage()}}" style="width: 300px; height: 100px" class="img-fluid " alt="">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="sell-table-group d-flex align-items-center">
                                                                <div class="sell-tabel-info">
                                                                    <p><a href="#!">{{$lesson->name}}</a></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{$lesson->courses->where('status', 'Enabled')->count()}}</td>
                                                        <td>
                                                            <div class="profile-share d-flex ">
                                                                <a href="/admin/lessons/{{$lesson->id}}/edit" class="btn btn-sm btn-success">Edit</a>
                                                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteConfirm('/tentor/lesson/'{{$lesson->id}})">Delete</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- /Referred Users-->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Instructor Dashboard -->

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addLessonModal" tabindex="-1" aria-labelledby="addLessonModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLessonModalLabel">Add New Lesson</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admin/lessons" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-control-label">Lesson Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter lesson name">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Gambar</label>
                        <input type="file" name="image">
                        <small class="text-danger">
                            @if ($errors->has('image')) {{$errors->first('image')}} @endif                                                         
                        </small>
                        <small>direkomendasikan ukuran 271 X 203</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endpush

@push('js')
<!-- Select2 JS -->
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endpush
