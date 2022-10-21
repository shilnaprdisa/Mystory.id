<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Earning;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EarningController extends Controller
{
    public function index(){
        $income = Transaction::whereStatus('Paid')->whereYear('created_at', date('Y'))->sum('admin_fee');
        $tentors_income = Earning::whereYear('created_at', date('Y'))->sum('amount');
        $revenue = Transaction::whereStatus('Paid')->whereYear('created_at', date('Y'))->sum('total_price');
        $students = User::whereYear('created_at', date('Y'))->whereRole('Student')->count();
        $tentors = User::whereYear('created_at', date('Y'))->whereRole('Tentor')->count();
        $best_sales = DB::table('transactions')
            ->select('lesson', DB::raw('count(*) as total_sales'),DB::raw('sum(price) as total_price'))
            ->groupBy('lesson')
            ->orderBy('total_price', 'desc')
            ->get();
        return view('admin.earning.index', compact('income','tentors_income','revenue', 'students', 'tentors', 'best_sales'));
    }
}
