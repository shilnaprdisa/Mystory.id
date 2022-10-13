@extends('layout.master')
@push('title')
<title>Belajarin.Id - Courses</title>
@endpush
@push('css')
<!-- Feather CSS -->
<link rel="stylesheet" href="{{asset('assets/css/feather.css')}}">

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
                                    <h3>Courses</h3>
                                    {{-- <p>Manage your courses and its update like live, draft and insight.</p> --}}
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
                                                            class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">New Course</a>
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
                                                    <th>COURSES</th>
                                                    <th>USED</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($courses as $course)
                                                    <tr>
                                                        <td>
                                                            <div class="sell-table-group d-flex align-items-center">
                                                                <div class="sell-tabel-info">
                                                                    <p><a href="#!">{{$course->name}}</a></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{$course->skills->count()}}</td>
                                                        <td>
                                                            <div class="profile-share d-flex ">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-success">Edit</button>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger">Delete</button>
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
<div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCourseModalLabel">Add New Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admin/courses" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-control-label">Course Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter course name">
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
<!-- Feature JS -->
<script src="{{asset('assets/plugins/feather/feather.min.js')}}"></script>
@endpush
