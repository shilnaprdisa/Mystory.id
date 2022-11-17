@extends('layout.tentor')
@push('title')
<title>Belajarin.Id - Tentor Dashboard</title>
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
                                            <h3>{{auth()->user()->courses->count()}}</h3>
                                            <p>Courses</p>
                                            <a href="/tentor/courses">View All</a>
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
                                            <a href="/tentor/transactions">View All</a>
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
                                            <h3>{{rupiah(auth()->user()->balance)}}</h3>
                                            <p>Balance</p>
                                            <a href="/tentor/earnings">View All</a>
                                        </div>
                                        <div class="img-deposit-ticket">
                                            <img src="assets/img/students/empty-wallet-tick.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="card stat-info medium-tickets">
                                <div class="card-body">
                                    <div class="view-all-grp d-flex">
                                        <div class="student-ticket-view">
                                            <h3>{{rupiah(auth()->user()->withdrawals->sum('amount'))}}</h3>
                                            <p>Total Withdraw</p>
                                            <a href="/tentor/withdrawals">View All</a>
                                        </div>
                                        <div class="img-deposit-ticket">
                                            <img src="assets/img/students/empty-wallet-change.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="card stat-info blue-tickets">
                                <div class="card-body">
                                    <div class="view-all-grp d-flex">
                                        <div class="student-ticket-view">
                                            <h3>{{$reviews}}</h3>
                                            <p>Review</p>
                                            <a href="/tentor/reviews">View All</a>
                                        </div>
                                        <div class="img-deposit-ticket">
                                            <img src="assets/img/students/profile-user.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="card stat-info ttl-tickets">
                                <div class="card-body">
                                    <div class="view-all-grp d-flex">
                                        <div class="student-ticket-view">
                                            <h3>{{$rating}}</h3>
                                            <p>Rating</p>
                                        </div>
                                        <div class="img-deposit-ticket">
                                            <img src="assets/img/students/receipt-text.svg" alt="">
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
                                            <th>Student</th>
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
                                                <td><a href="/tentor/transactions/{{$trans->id}}">{{$trans->user->name}}</a></td>
                                                <td><a href="/tentor/transactions/{{$trans->id}}">{{$trans->lesson}}</a></td>
                                                <td><a href="/tentor/transactions/{{$trans->id}}">{{$trans->level}}</a></td>
                                                <td><span class="text-success"><a href="/tentor/transactions/{{$trans->id}}">{{rupiah($trans->total_price)}}</a></span></td>
                                                <td><a href="/tentor/transactions/{{$trans->id}}">{{$trans->status}}</a></td>
                                                <td><a href="/tentor/transactions/{{$trans->id}}">{{tanggal($trans->created_at)}}</a></td>
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
