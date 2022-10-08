<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Earning;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        return '<h2>halaman dashboard student sedang dalam pengembangan </h2>';
    }
    public function tentor(){
        return '<h2>halaman dashboard tentor sedang dalam pengembangan </h2>';
    }
    public function admin(){
        $revenue = Earning::whereYear('created_at', date('Y'))->sum('amount');
        $students = User::whereYear('created_at', date('Y'))->whereRole('Student')->count();
        $tentors = User::whereYear('created_at', date('Y'))->whereRole('Tentor')->count();
        $best_sales = DB::table('transactions')
            ->select('course', DB::raw('count(*) as total_sales'),DB::raw('sum(price) as total_price'))
            ->groupBy('course')
            ->orderBy('total_price', 'desc')
            ->get();
        return view('admin.dashboard.index', compact('revenue', 'students', 'tentors', 'best_sales'));
    }
}
