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

            <!-- Profile Privacy -->
            <div class="col-xl-9 col-md-8">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>                    
                @endif
                <div class="settings-widget profile-details">
                    <div class="settings-menu p-0">
                        <div class="profile-heading">
                            <h3>Profile</h3>
                            {{-- <p>Making your profile public allow other users to see what you have been learning on Geeks.
                            </p> --}}
                        </div>
                        <div class="checkout-form personal-address add-course-info border-line">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="personal-info-head">
                                        <h4>{{$user->name}}</h4>
                                        <p>As {{$user->role}}</p>
                                    </div>
                                    <form action="/admin/users/status" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$user->id}}">
                                        <div class="new-address">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-0">
                                                        <label class="form-label">Status</label>
                                                        <select class="form-select select country-select" name="status">
                                                            <option value="Pending" @if($user->status == 'Pending') selected @endif>Pending</option>
                                                            <option value="Active" @if($user->status == 'Active') selected @endif>Active</option>
                                                            <option value="Banned" @if($user->status == 'Banned') selected @endif>Banned</option>
                                                            <option value="Deleted" @if($user->status == 'Deleted') selected @endif>Deleted</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-dark mt-3">Update Status</button>
                                    </form>
                                </div>
                                <div class="col-lg-6">
                                    <div class="student-img">
                                        <a href="/admin/users/{{$user->id}}">
                                            <img class="img-fluid" alt="Students Info" src="{{asset('assets/img/user/user1.jpg')}}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="checkout-form personal-address secure-alert">
                                    <div class="personal-info-head">
                                        <h4>Profile detail</h4>
                                        {{-- <p>These controls give you the ability to customize what areas of your profile others
                                            are able to see.</p> --}}
                                    </div>
                                    <table>
                                        <tr>
                                            <td>Name</td>
                                            <td> : {{$user->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td> : {{$user->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td> : 0{{$user->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td> : {{$user->gender}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="checkout-form personal-address secure-alert">
                                    <div class="personal-info-head">
                                        <h4>Courses</h4>  
                                        @php
                                            $colors = ['primary','danger','warning','dark','success','secondary','info'];
                                        @endphp                                      
                                        @foreach ($user->courses as $key => $course)
                                            <span class="badge rounded-pill bg-{{$colors[array_rand($colors)]}}">
                                                {{$course->lesson->name}} {{$course->level->name}}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">                                
                                <div class="checkout-form personal-address secure-alert">
                                    <div class="personal-info-head">
                                        <h4>Address</h4>
                                        <p>{{$user->address->detail}}</p>
                                    </div>                                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Profile Privacy -->

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
