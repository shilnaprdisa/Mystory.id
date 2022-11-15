<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Earning;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EarningController extends Controller
{
    public function index(){
        $trans_income = Transaction::whereStatus('Paid')->whereYear('created_at', date('Y'))->sum('trans_fee');
        $wd_income = Withdrawal::whereYear('created_at', date('Y'))->sum('wd_fee');
        return view('admin.earning.index', compact('trans_income','wd_income'));
    }
}
