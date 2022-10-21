<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Earning;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        return '<h2>halaman dashboard student sedang dalam pengembangan </h2>';
    }
    public function tentor(){
        return view('tentor.dashboard.index');
    }
    public function admin(){
        $transactions = Transaction::whereStatus('Paid')->whereYear('created_at', date('Y'))->count();
        $students = User::whereYear('created_at', date('Y'))->whereRole('Student')->count();
        $tentors = User::whereYear('created_at', date('Y'))->whereRole('Tentor')->count();
        $best_sales = DB::table('transactions')
            ->whereStatus('Paid')
            ->select('lesson', DB::raw('count(*) as total_sales'),DB::raw('sum(price) as total_price'))
            ->groupBy('lesson')
            ->orderBy('total_price', 'desc')
            ->get();
        return view('admin.dashboard.index', compact('transactions', 'students', 'tentors', 'best_sales'));
    }
}
