@extends('layout.master')
@push('title')
<title>Belajarin.Id - Users</title>
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
                <div class="tak-instruct-group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="settings-widget">
                                <div class="settings-inner-blk p-0">
                                    <div class="sell-course-head student-meet-head comman-space border-0">
                                        <div class="tak-head d-flex align-items-center">
                                            <div>
                                                <h3>Users</h3>
                                                {{-- <p>Meet people taking your course.</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="instruct-search-blk">
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
                                                    class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">New User</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}
                        </div>
                        @foreach ($users as $user)                            
                            <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                                <div class="student-box flex-fill">
                                    <div class="student-box-blks">
                                        <div class="student-img">
                                            <a href="/admin/users/{{$user->id}}">
                                                <img class="img-fluid" alt="Students Info" src="{{asset('assets/img/user/user1.jpg')}}">
                                            </a>
                                        </div>
                                        <div class="student-content pb-0">
                                            <h5><a href="/admin/users/{{$user->id}}">{{$user->name}}</a></h5>
                                            <div class="loc-blk d-flex align-items-center justify-content-center">                                                
                                                <p>{{$user->role}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="enrol-student-foot">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-9">
                                                        Enrolled {{tanggal($user->created_at)}}
                                                    </div>
                                                    <div class="col-2">
                                                        <span class="badge rounded-pill bg-{{($user->status == 'Active') ? 'primary' : ($user->status == 'Pending' ? 'warning' : ($user->status == 'Banned' ? 'dark' : 'danger'))}}">
                                                            {{$user->status}}
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li><i class="feather-map-pin me-2"></i>{{$user->address->city->name}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach                        
                    </div>

                    <!-- /pagination -->
                    @if ($users->lastPage() > 1)
                        @php
                            $currentPage = $users->currentPage();
                            $prevous = $currentPage - 1;
                            $next = $currentPage + 1;
                        @endphp
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="pagination lms-page mt-0">
                                    <li class="page-item prev">
                                        <form action="" method="get">
                                            <input type="hidden" name="page" value="{{$prevous}}">
                                            <button type="submit" @if($currentPage <= 1) disabled @endif class="page-link" tabindex="-1"><i class="fas fa-angle-left"></i></button>
                                        </form>
                                    </li>
                                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                                        <li class="page-item @if($currentPage == $i) first-page active @endif">
                                            <form action="" method="get">
                                                <input type="hidden" name="page" value="{{$i}}">
                                                <button type="submit" class="page-link">{{$i}}</button>
                                            </form>
                                        </li>
                                    @endfor
                                    <li class="page-item next">
                                        <form action="" method="get">
                                            <input type="hidden" name="page" value="{{$next}}">
                                            <button type="submit" @if($currentPage >= $users->lastPage()) disabled @endif class="page-link"><i class="fas fa-angle-right"></i></button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>                        
                    @endif
                    <!-- /pagination -->

                </div>
            </div>
            <!-- /Instructor Dashboard -->

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admin/users" method="post">
                @csrf
                <div class="modal-body">
                    {{-- <div class="form-group">
                        <label class="form-control-label">Class</label>
                        <input type="number" name="number" class="form-control" placeholder="Enter class number">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Roman</label>
                        <input type="text" name="roman" class="form-control" placeholder="Enter roman numeral">
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save</button>
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
