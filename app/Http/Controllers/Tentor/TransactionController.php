<?php

namespace App\Http\Controllers\Tentor;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request){
        $transactions = Transaction::whereIn('course_id', auth()->user()->courses->pluck('id'))->orderBy('id', 'desc')->paginate(10);
        return view('tentor.transaction.index', compact('transactions'));
    }
    public function show($id){
        $transaction = Transaction::find($id);
        return view('transdetail', compact('transaction'));
    }
    public function destroy(Request $request, $id){
        $transaction = Transaction::find($id);
        $transaction->update(['status' => $request->status]);
        sendNotif($transaction);
        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }
}
