@extends('layout.tentor')

@push('title')
<title>Belajarin.Id - Student Transactions</title>
@endpush

@push('content')			
<!--Dashbord Student -->
<div class="page-content">
    <div class="container">
        <div class="row">
            
            <!-- Profile Details -->
            <div class="col-xl-12 col-md-12">	
                <div class="settings-widget">
                    <div class="settings-inner-blk p-0">
                        <div class="comman-space pb-0">
                            <div class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                                <h3>Transactions</h3>
                            </div>
                            {{-- <form action="" method="get" id="search">
                                <div class="instruct-search-blk">
                                    <div class="show-filter choose-search-blk">
                                        <div class="row gx-2 align-items-center">	
                                            <div class="col-md-6 col-item">
                                                <div class=" search-group">
                                                    <i class="feather-search"></i>
                                                    <input type="text" name="search" class="form-control" placeholder="Search our courses" >
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-item">
                                                <div class="form-group select-form mb-0">
                                                    <select class="form-select select" name="status">
                                                        <option>All</option>
                                                        <option value="Order">Order</option>
                                                        <option value="Agree">Agree</option>
                                                        <option value="Come">Come</option>
                                                        <option value="Process">Process</option>
                                                        <option value="Done">Done</option>
                                                        <option value="PaymentFailed">PaymentFailed</option>
                                                        <option value="Paid">Paid</option>
                                                        <option value="Cancel">Cancel</option>
                                                    </select>
                                                </div>
                                            </div>						
                                        </div>
                                    </div>
                                </div>
                            </form> --}}
                            <div class="settings-tickets-blk table-responsive">

                                <!-- Referred Users-->
                                <table class="table table-nowrap mb-0">
                                    <thead>
                                      <tr>
                                        <th>Tentor</th>
                                        <th>Lesson</th>
                                        <th>Level</th>
                                        <th>Time</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td><a href="/transactions/{{$transaction->id}}">{{$transaction->course->user->name}}</a></td>
                                                <td><a href="/transactions/{{$transaction->id}}">{{$transaction->lesson}}</a></td>
                                                <td><a href="/transactions/{{$transaction->id}}">{{$transaction->level}}</a></td>
                                                <td><a href="/transactions/{{$transaction->id}}">{{$transaction->time}} Jam</a></td>
                                                <td><a href="/transactions/{{$transaction->id}}"><span class="text-success">{{rupiah($transaction->total_price)}}</span></a></td>
                                                <td><a href="/transactions/{{$transaction->id}}">{{$transaction->status}}</a></td>
                                                <td><a href="/transactions/{{$transaction->id}}">{{tgltime($transaction->created_at)}}</a></td>
                                                <td>
                                                    <a href="/transactions/{{$transaction->id}}" class="btn btn-primary me-1">Detail</a>
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
                {{pagi($transactions->currentPage(), $transactions->lastPage())}}
            </div>	
            <!-- Profile Details -->
            
        </div>
    </div>
</div>	
<!-- /Dashbord Student -->    
@endpush