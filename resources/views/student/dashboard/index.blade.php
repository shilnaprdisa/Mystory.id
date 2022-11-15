@extends('layout.tentor')
@push('title')
<title>Belajarin.Id - Student Dashboard</title>
@endpush
@push('content')
<div class="page-content">
    <div class="container">
        <div class="row">

            <!-- Profile Details -->
            <div class="col-xl-12 col-md-12">
                <div class="settings-top-widget student-deposit-blk">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="card stat-info ttl-tickets">
                                <div class="card-body">
                                    <div class="view-all-grp d-flex">
                                        <div class="student-ticket-view">
                                            <h3>{{$study_time}} Hours</h3>
                                            <p>study time</p>
                                            {{-- <a href="/student/courses">View All</a> --}}
                                        </div>
                                        <div class="img-deposit-ticket">
                                            <img src="assets/img/students/book.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="card stat-info open-tickets">
                                <div class="card-body">
                                    <div class="view-all-grp d-flex">
                                        <div class="student-ticket-view">
                                            <h3>{{$transactions}}</h3>
                                            <p>Total Transactions</p>
                                            <a href="/student/transactions">View All</a>
                                        </div>
                                        <div class="img-deposit-ticket">
                                            <img src="assets/img/students/receipt-text.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="card stat-info close-tickets">
                                <div class="card-body">
                                    <div class="view-all-grp d-flex">
                                        <div class="student-ticket-view">
                                            <h3>{{$lessons}}</h3>
                                            <p>lessons learned</p>
                                            <a href="/student/earnings">View All</a>
                                        </div>
                                        <div class="img-deposit-ticket">
                                            <img src="assets/img/students/book.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="settings-widget">
                    <div class="settings-inner-blk p-0">
                        <div class="comman-space pb-0">
                            <div class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                                <h3>Latest Transactions</h3>
                            </div>
                            <div class="settings-tickets-blk table-responsive">

                                <!-- Referred Users-->
                                <table class="table table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>Tentor</th>
                                            <th>Lesson</th>
                                            <th>Level</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($last_trans as $trans)
                                            <tr>
                                                <td>{{$trans->course->user->name}}</td>
                                                <td>{{$trans->lesson}}</td>
                                                <td>{{$trans->level}}</td>
                                                <td><span class="text-success">{{rupiah($trans->total_price)}}</span></td>
                                                <td>{{$trans->status}}</td>
                                                <td>{{tanggal($trans->created_at)}}</td>
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
            <!-- Profile Details -->

        </div>
    </div>
</div>
@endpush
