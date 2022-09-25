@extends('layout.master')
@push('title')
<title>Belajarin.Id - Courses</title>
@endpush
@push('css')    
    <!-- Feather CSS -->
    <link rel="stylesheet" href="assets/css/feather.css">
    
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="settings-widget">
                            <div class="settings-inner-blk p-0">
                                <div class="sell-course-head comman-space">
                                    <h3>Courses</h3>
                                    <p>Manage your courses and its update like live, draft and insight.</p>
                                </div>
                                <div class="comman-space pb-0">
                                    <div class="instruct-search-blk">
                                        <div class="show-filter choose-search-blk">
                                            <form action="#">
                                                <div class="row gx-2 align-items-center">
                                                    <div class="col-md-6 col-item">
                                                        <div class=" search-group">
                                                            <i class="feather-search"></i>
                                                            <input type="text" class="form-control"
                                                                placeholder="Search our courses">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6 col-item">
                                                        <div class="form-group select-form mb-0">
                                                            <select class="form-select select" name="sellist1">
                                                                <option>Choose</option>
                                                                <option>Angular</option>
                                                                <option>React</option>
                                                                <option>Node</option>
                                                            </select>
                                                        </div>
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
                                                    <th>STUDENTS</th>
                                                    <th>STATUS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="sell-table-group d-flex align-items-center">
                                                            <div class="sell-group-img">
                                                                <a href="course-details.html">
                                                                    <img src="assets/img/course/course-10.jpg"
                                                                        class="img-fluid " alt="">
                                                                </a>
                                                            </div>
                                                            <div class="sell-tabel-info">
                                                                <p><a href="course-details.html">Information About UI/UX
                                                                        Design Degree</a></p>
                                                                <div
                                                                    class="course-info d-flex align-items-center border-bottom-0 pb-0">
                                                                    <div class="rating-img d-flex align-items-center">
                                                                        <img src="assets/img/icon/icon-01.svg" alt="">
                                                                        <p>10+ Lesson</p>
                                                                    </div>
                                                                    <div class="course-view d-flex align-items-center">
                                                                        <img src="assets/img/icon/timer-start.svg"
                                                                            alt="">
                                                                        <p>7hr 20min</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>3200</td>
                                                    <td><span class="badge info-low">Live</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="sell-table-group d-flex align-items-center">
                                                            <div class="sell-group-img">
                                                                <a href="course-details.html">
                                                                    <img src="assets/img/course/course-11.jpg"
                                                                        class="img-fluid " alt="">
                                                                </a>
                                                            </div>
                                                            <div class="sell-tabel-info">
                                                                <p><a href="course-details.html">Wordpress for Beginners
                                                                        - Master Wordpress Quickly</a></p>
                                                                <div
                                                                    class="course-info d-flex align-items-center border-bottom-0 pb-0">
                                                                    <div class="rating-img d-flex align-items-center">
                                                                        <img src="assets/img/icon/icon-01.svg" alt="">
                                                                        <p>10+ Lesson</p>
                                                                    </div>
                                                                    <div class="course-view d-flex align-items-center">
                                                                        <img src="assets/img/icon/timer-start.svg"
                                                                            alt="">
                                                                        <p>7hr 20min</p>
                                                                    </div>
                                                                </div>
                                                                <div class="course-stip progress-stip">
                                                                    <div
                                                                        class="progress-bar bg-success progress-bar-striped active-stip">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>0</td>
                                                    <td><span class="badge info-inter">Darft</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="sell-table-group d-flex align-items-center">
                                                            <div class="sell-group-img">
                                                                <a href="course-details.html">
                                                                    <img src="assets/img/course/course-12.jpg"
                                                                        class="img-fluid " alt="">
                                                                </a>
                                                            </div>
                                                            <div class="sell-tabel-info">
                                                                <p><a href="course-details.html">Sketch from A to Z
                                                                        (2022): Become an app designer</a></p>
                                                                <div
                                                                    class="course-info d-flex align-items-center border-bottom-0 pb-0">
                                                                    <div class="rating-img d-flex align-items-center">
                                                                        <img src="assets/img/icon/icon-01.svg" alt="">
                                                                        <p>10+ Lesson</p>
                                                                    </div>
                                                                    <div class="course-view d-flex align-items-center">
                                                                        <img src="assets/img/icon/timer-start.svg"
                                                                            alt="">
                                                                        <p>7hr 20min</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>1500</td>
                                                    <td><span class="badge info-low">Live</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="sell-table-group d-flex align-items-center">
                                                            <div class="sell-group-img">
                                                                <a href="course-details.html">
                                                                    <img src="assets/img/course/course-13.jpg"
                                                                        class="img-fluid " alt="">
                                                                </a>
                                                            </div>
                                                            <div class="sell-tabel-info">
                                                                <p><a href="course-details.html">C# Developers Double
                                                                        Your Coding Speed with Visual Studio</a></p>
                                                                <div
                                                                    class="course-info d-flex align-items-center border-bottom-0 pb-0">
                                                                    <div class="rating-img d-flex align-items-center">
                                                                        <img src="assets/img/icon/icon-01.svg" alt="">
                                                                        <p>10+ Lesson</p>
                                                                    </div>
                                                                    <div class="course-view d-flex align-items-center">
                                                                        <img src="assets/img/icon/timer-start.svg"
                                                                            alt="">
                                                                        <p>7hr 20min</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>0</td>
                                                    <td><span class="badge info-medium">Pending</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="sell-table-group d-flex align-items-center">
                                                            <div class="sell-group-img">
                                                                <a href="course-details.html">
                                                                    <img src="assets/img/course/course-14.jpg"
                                                                        class="img-fluid " alt="">
                                                                </a>
                                                            </div>
                                                            <div class="sell-tabel-info">
                                                                <p><a href="course-details.html">Build Responsive Real
                                                                        World Websites with HTML5 and CSS3</a></p>
                                                                <div
                                                                    class="course-info d-flex align-items-center border-bottom-0 pb-0">
                                                                    <div class="rating-img d-flex align-items-center">
                                                                        <img src="assets/img/icon/icon-01.svg" alt="">
                                                                        <p>10+ Lesson</p>
                                                                    </div>
                                                                    <div class="course-view d-flex align-items-center">
                                                                        <img src="assets/img/icon/timer-start.svg"
                                                                            alt="">
                                                                        <p>7hr 20min</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>0</td>
                                                    <td><span class="badge info-high">Deleted</span></td>
                                                </tr>
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

@endpush

@push('js')
<!-- Select2 JS -->
<script src="assets/plugins/select2/js/select2.min.js"></script>
<!-- Feature JS -->
<script src="assets/plugins/feather/feather.min.js"></script>
@endpush
