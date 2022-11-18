<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Earning;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $transactions = Transaction::whereUserId(auth()->user()->id)->whereStatus('Paid')->count();
        $study_time = Transaction::whereUserId(auth()->user()->id)->whereStatus('Paid')->sum('time');
        $last_trans = Transaction::whereUserId(auth()->user()->id)->orderBy('id', 'desc')->paginate(5);
        $lessons = DB::table('transactions')
                ->whereUserId(auth()->user()->id)
                ->whereStatus('Paid')
                ->select('lesson', DB::raw('count(*) as total'))
                ->groupBy('lesson')
                ->get()->count();
        return view('student.dashboard.index', compact('transactions', 'study_time', 'lessons', 'last_trans'));
    }
    public function tentor(){
        $transactions = Transaction::whereIn('course_id', auth()->user()->courses->pluck('id'))->whereStatus('Paid')->count();
        $reviews = Review::whereIn('course_id', auth()->user()->courses->pluck('id'))->count();
        $rating = Review::whereIn('course_id', auth()->user()->courses->pluck('id'))->sum('rating') ?? null / $reviews;
        $last_trans = Transaction::whereIn('course_id', auth()->user()->courses->pluck('id'))->orderBy('id', 'desc')->paginate(5);
        return view('tentor.dashboard.index', compact('transactions', 'reviews', 'rating', 'last_trans'));
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
