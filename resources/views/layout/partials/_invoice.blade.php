<!--Dashbord Student -->
<div class="page-content">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Profile Details -->
            <div class="col-xl-9 col-md-8">	
                @if (!request()->is('invoice/*'))
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('success')}}
                        </div>                    
                    @endif
                @endif
                <div class="settings-widget profile-details">
                    <div class="settings-menu invoice-list-blk p-0 ">
                        <div class="card pro-post border-0 mb-0">
                            <div class="card-body">
                                <div class="invoice-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="invoice-logo">
                                                <img src="{{config('belajarin.logo')}}" alt="logo">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @if (!request()->is('invoice/*') && $transaction->status == 'Paid')
                                                <div class="download-widra mb-3">
                                                    <a href="/invoice/{{$transaction->id}}" target="_blank"><i class="feather-download"></i></a>
                                                </div>                                                
                                            @endif
                                            <p class="invoice-details">
                                                <strong>Order:</strong> #{{$transaction->id}} <br>
                                                <strong>Issued:</strong> {{tanggal($transaction->created_at)}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Invoice Item -->
                                <div class="invoice-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="invoice-info">
                                                <strong class="customer-text">Invoice From</strong>
                                                <p class="invoice-details invoice-details-two">
                                                    {{$transaction->course->user->name}} <br>
                                                    <small>{{$transaction->course->user->address->detail}}</small> <br>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="invoice-info invoice-info2">
                                                <strong class="customer-text">Invoice To</strong>
                                                <p class="invoice-details">
                                                    {{$transaction->user->name}} <br>
                                                    <small>{{$transaction->user->address->detail}}</small> <br>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Invoice Item -->
                                
                                <!-- Invoice Item -->
                                <div class="invoice-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="invoice-info">
                                                <strong class="customer-text">Status</strong>
                                                {{tranStatus($transaction, (isRole('Student') ? 'Student': (isRole('Tentor') ? 'Tentor' : 'Admin')))}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Invoice Item -->
                                
                                <!-- Invoice Item -->
                                <div class="invoice-item invoice-table-wrap">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="invoice-table table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Course</th>
                                                            <th>Time</th>
                                                            <th class="text-center">Price</th>
                                                            <th class="text-end">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{$transaction->lesson}} {{$transaction->level}}</td>
                                                            <td>{{$transaction->time}} Jam</td>
                                                            <td>{{angka($transaction->price)}}/jam</td>
                                                            <td class="text-end">{{angka($transaction->price * $transaction->time)}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-4 ms-auto">
                                            <div class="table-responsive">
                                                <table class="invoice-table-two table table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <th>Admin Fee:</th>
                                                            <td><span>{{angka($transaction->trans_fee)}}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Total Price:</th>
                                                            <td><span>{{rupiah($transaction->total_price)}}</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Invoice Item -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
            <!-- Profile Details -->
            
        </div>
    </div>
</div>	
<!-- /Dashbord Student -->