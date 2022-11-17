<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Notification;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        $transactions = Transaction::whereUserId(auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
        return view('student.transaction.index', compact('transactions'));
    }
    public function store(Request $request){
        $transaction = Transaction::create($this->_trasactionRequest($request, 'Order'));
        sendNotif($transaction);
        return redirect('/transactions/'.$transaction->id)->with('success', 'Berhasil Memesan, mohon tunggu konfirmasi dari tentor!');
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

    private function _trasactionRequest(Request $request, $status){
        $this->_validation($request);
        $course = Course::find($request->course_id);
        $sub_total = $request->time * $course->price;
        $trans_fee = transFee($sub_total);
        $request->request->add([
            'user_id' => auth()->user()->id,'course_id' => $request->course_id, 'lesson' => $course->lesson->name,
            'level' => $course->level->name, 'price' => $course->price,
            'time' => $request->time, 'trans_fee' => $trans_fee, 'total_price' => $sub_total + $trans_fee,
            'status' => $status
        ]);
        return $request->all();
    }

    private function _validation(Request $request){
        return $this->validate($request, [
            'course_id' => 'required|numeric|max:200000000',
            'time' => 'required|numeric|max:200000000',
        ]);
    }
}
