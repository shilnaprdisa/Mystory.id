@extends('layout.master')
@push('title')
<title>Belajarin.Id - Class Edit</title>
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
                <a href="/admin/levels"><i class="fa fa-arrow-left mb-2"></i> Back</a>
                <div class="card overview-sec">
                    <div class="card-body">
                        <h5 class="subs-title">Edit Class</h5>
                        <form action="/admin/levels/{{$level->id}}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="old_name" value="{{$level->name}}">
                            <div class="form-group">
                                <label class="form-control-label">Lesson Number</label>
                                <input type="text" name="number" class="form-control" value="{{old('umber') ?? $level->number}}" placeholder="Enter umber">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Lesson Name</label>
                                <input type="text" name="name" class="form-control" value="{{old('name') ?? $level->name}}" placeholder="Enter class name">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
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
