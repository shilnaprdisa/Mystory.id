@extends('layout.tentor')

@push('title')
<title>Belajarin.Id - Tentor Earnings</title>
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
                                <h3>Earnings</h3>
                            </div>
                            <div class="settings-tickets-blk table-responsive">

                                <!-- Referred Users-->
                                <table class="table table-nowrap mb-0">
                                    <thead>
                                      <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Course</th>
                                        <th>Time</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($earnings as $earning)
                                            <tr>
                                                <td><a href="#!">{{tanggal($earning->created_at)}}</a></td>
                                                <td><a href="#!">{{$earning->amount}}</a></td>
                                                <td><a href="#!">{{$earning->transaction->lesson}} {{$earning->transaction->level}}</a></td>
                                                <td><a href="#!">{{$earning->transaction->time}} Jam</a></td>
                                            </tr>                                            
                                        @endforeach
                                    </tbody>
                                  </table>
                                <!-- /Referred Users-->	

                            </div>									
                        </div>
                    </div>
                </div>                
                {{pagi($earnings->currentPage(), $earnings->lastPage())}}
            </div>	
            <!-- Profile Details -->
            
        </div>
    </div>
</div>	
<!-- /Dashbord Student -->    
@endpush