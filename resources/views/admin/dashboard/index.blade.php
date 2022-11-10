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
                                    <h6>TRANSACTIONS</h6>
                                    <h4 class="instructor-text-success">{{$transactions}}</h4>
                                    <p>Transactions this year</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="card instructor-card w-100">
                            <div class="card-body">
                                <div class="instructor-inner">
                                    <h6>STUDENTS</h6>
                                    <h4 class="instructor-text-info">{{angka($students)}}</h4>
                                    <p>New Students this year</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="card instructor-card w-100">
                            <div class="card-body">
                                <div class="instructor-inner">
                                    <h6>TENTORS</h6>
                                    <h4 class="instructor-text-warning">{{angka($tentors)}}</h4>
                                    <p>New Tentors this year</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card instructor-card">
                            <div class="card-header">
                                <h4>Order</h4>
                            </div>
                            <div class="card-body">
                                <div id="order_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="settings-widget">
                            <div class="settings-inner-blk p-0">
                                <div class="sell-course-head comman-space">
                                    <h3>Best Selling</h3>
                                </div>
                                <div class="comman-space pb-0">
                                    <div class="settings-tickets-blk course-instruct-blk table-responsive">

                                        <!-- Referred Users-->
                                        <table class="table table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th>LESSON</th>
                                                    <th>SALES</th>
                                                    <th>AMOUNT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($best_sales as $sales)
                                                    <tr>
                                                        <td>
                                                            <div class="sell-table-group d-flex align-items-center">
                                                                {{-- <div class="sell-group-img">
                                                                    <a href="#!">
                                                                        <img src="{{asset('assets/img/course/course-10.jpg')}}"
                                                                            class="img-fluid " alt="">
                                                                    </a>
                                                                </div> --}}
                                                                <div class="sell-tabel-info">
                                                                    </p>
                                                                    <p><a href="#!">{{$sales->lesson}}</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{$sales->total_sales}}</td>
                                                        <td>{{rupiah($sales->total_price)}}</td>
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

@endpush

@push('js')
<!-- Chart JS -->
<script src="{{asset('assets/plugins/apexchart/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/plugins/apexchart/chart-data.js')}}"></script>    
@endpush
