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
                @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                @if (Session::has('failed'))
                <div class="alert alert-warning" role="alert">
                    {{Session::get('failed')}}
                </div>
                @endif
                <div class="settings-widget">
                    <div class="settings-inner-blk p-0">
                        <div class="comman-space pb-0">
                            <div class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
                                <h3>Withdrawals</h3>
                                <a href="#!" class="btn btn-dark" data-bs-toggle="modal"
                                    data-bs-target="#wdModal">Withdraw</a>
                            </div>
                            <div class="settings-tickets-blk table-responsive">

                                <!-- Referred Users-->
                                <table class="table table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>WD Fee</th>
                                            <th>Received</th>
                                            <th>Account Number</th>
                                            <th>Account Name</th>
                                            <th>Bank Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wd as $w)
                                        <tr>
                                            <td><a href="#!">{{$w->id}}</a></td>
                                            <td><a href="#!">{{tanggal($w->created_at)}}</a></td>
                                            <td><a href="#!">{{angka($w->amount)}}</a></td>
                                            <td><a href="#!">{{angka($w->wd_fee)}}</a></td>
                                            <td><a href="#!">{{angka($w->received)}}</a></td>
                                            <td><a href="#!">{{$w->account_number}}</a></td>
                                            <td><a href="#!">{{$w->account_name}}</a></td>
                                            <td><a href="#!">{{$w->bank_name}}</a></td>
                                            <td><a href="#!">{{$w->status}}</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- /Referred Users-->

                            </div>
                        </div>
                    </div>
                </div>
                {{pagi($wd->currentPage(), $wd->lastPage())}}
            </div>
            <!-- Profile Details -->

        </div>
    </div>
</div>
<!-- /Dashbord Student -->

<!-- Modal -->
<div class="modal fade" id="wdModal" tabindex="-1" aria-labelledby="wdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/tentor/withdrawals" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="wdModalLabel">Withdraw</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="field">
                        <p>
                            My Balance: {{rupiah(auth()->user()->balance)}}
                        </p>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Account Number</label>
                                    <input type="text" name="account_number" class="form-control" id="a_num"
                                        placeholder="Account Number">
                                    <small id="err_a_num" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Account Name</label>
                                    <input type="text" name="account_name" class="form-control" id="a_name"
                                        placeholder="Account Name">
                                    <small id="err_a_name" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Bank Name</label>
                                    <input type="text" name="bank_name" class="form-control" id="b_name" placeholder="Bank Name">
                                    <small id="err_b_name" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Amount</label>
                                    <input type="number" name="amount" class="form-control" id="amount" placeholder="Amount">
                                    <small id="err_amount" class="text-danger"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="confirm" style="display: none">
                        <p id="det_acc_num">Account Number: </p>
                        <p id="det_acc_name">Account Name: </p>
                        <p id="det_b_name">Bank Name: </p>
                        <p id="det_amount">Amount: </p>
                        <hr>
                        <p id="wdFee">WD Fee: </p>
                        <strong id="received">Total Received: </strong>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancel" class="btn btn-dark confirm" style="display: none; background: grey">Cancel</button>
                    <button type="button" id="check" class="btn btn-dark check">Check</button>
                    <button type="submit" id="submit" class="btn btn-dark confirm" style="display: none">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush

@push('js')
<!-- Custom JS -->
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>

<script>
    let balance = {!! auth()->user()->balance !!}
    let received = 0;
    $('#check').on('click', function () {
        if(check()){
            $.ajax({
                url: '/tentor/fee/wdFee/'+$('#amount').val(),
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('.check').hide()            
                    $('#field').hide()            
                    $('#det_acc_num').text(`Account Number: ${$('#a_num').val()}`)
                    $('#det_acc_name').text(`Account Name: ${$('#a_name').val()}`)
                    $('#det_b_name').text(`Bank Name: ${$('#b_name').val()}`)
                    $('#det_amount').text(`Amount: ${rupiah($('#amount').val().toString())}`)
                    $('#wdFee').text(`WD Fee: ${rupiah(data.toString())}`)
                    received = $('#amount').val() - data;
                    $('#received').text(`Total Received: ${rupiah(received.toString(), 'Rp ')}`)
                    $('.confirm').show()
                }
            });
        }
    })

    $('#cancel').on('click', function(){
        $('.confirm').hide()            
        $('.check').show()
        $('#field').show()
    })

    function check(){
        let minWD = {!! minWD() !!}
        let error = 0;
        if (!$('#a_num').val().length) {
            $('#err_a_num').show().text('Account Number is required');
            error++
        } else {
            $('#err_a_num').hide();
        }
        
        if (!$('#a_name').val().length) {
            $('#err_a_name').show().text('Account Name is required');
            error++
        } else {
            $('#err_a_name').hide();
        }
        
        if (!$('#b_name').val().length) {
            $('#err_b_name').show().text('Bank Name is required');
            error++
        } else {
            $('#err_b_name').hide();
        }
        
        if (!$('#amount').val().length) {
            $('#err_amount').show().text('Amount is required');
            error++
        } else if($('#amount').val() < minWD) {
            $('#err_amount').show().text('Minimum Amount is ' + minWD);
            error++
        } else if($('#amount').val() > balance) {
            $('#err_amount').show().text('Maximum Amount is ' + balance);
            error++
        } else {
            $('#err_amount').hide();
        }

        return !error
    }

</script>

@endpush
