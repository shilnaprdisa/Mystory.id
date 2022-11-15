@extends('layout.master')
@push('title')
<title>Belajarin.Id - Dashboard</title>
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
                    <div class="col-md-4 d-flex">
                        <div class="card instructor-card w-100">
                            <div class="card-body">
                                <div class="instructor-inner">
                                    <h6>Total Income</h6>
                                    <h4 class="instructor-text-success">{{rupiah($trans_income + $wd_income)}}</h4>
                                    <p>Earning this year</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="card instructor-card w-100">
                            <div class="card-body">
                                <div class="instructor-inner">
                                    <h6>Trans Income</h6>
                                    <h4 class="instructor-text-info">{{rupiah($trans_income)}}</h4>
                                    <p>Income this year</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="card instructor-card w-100">
                            <div class="card-body">
                                <div class="instructor-inner">
                                    <h6>WD Income</h6>
                                    <h4 class="instructor-text-warning">{{rupiah($wd_income)}}</h4>
                                    <p>Income this year</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card instructor-card">
                            <div class="card-header">
                                <h4>Earnings</h4>
                            </div>
                            <div class="card-body">
                                <div id="instructor_chart"></div>
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
<!-- Chart JS -->
<script src="{{asset('assets/plugins/apexchart/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/plugins/apexchart/chart-data.js')}}"></script>    
@endpush
