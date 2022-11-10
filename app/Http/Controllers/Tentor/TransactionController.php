<?php

namespace App\Http\Controllers\Tentor;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request){
        $transactions = Transaction::whereIn('course_id', auth()->user()->courses->pluck('id'))->paginate(10);
        return view('tentor.transaction.index', compact('transactions'));
    }
}
