<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        $transactions = Transaction::whereUserId(auth()->user()->id)->paginate(10);
        return view('student.transaction.index', compact('transactions'));
    }
    public function store(Request $request){
        dd($request->all());
        $transactions = Transaction::create($this->_trasactionRequest($request, 'Order'));
        $this->_createNotification($transactions);
        return redirect('/trasactions/'.$transactions->id)->with('success', 'Berhasil Memesan, mohon tunggu konfirmasi dari tentor!');
    }

    private function _trasactionRequest(Request $request, $status){
        $this->_validation($request);
        $course = Course::find($request->course_id);
        $sub_total = $request->time * $course->price;
        $trans_fee = transFee($sub_total);
        $request->request->add([
            'user_id' => auth()->user()->id,'course_id' => $request->course_id, 'course' => $course->course->name,
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
    private function _createNotification($transactions){
        
        $name = $transactions->user->name;
        $uri = '/transactions/'.$transactions->id;
        $uritentor = '/tentor/transactions/'.$transactions->id;
        
        if($transactions->status == 'Order'){
            $user_id = $transactions->course->user->id;
            $title = "Pesanan Baru";
            $description = "Ada pesanan baru dari $name,segera terima untuk membuat kesepakatan!";
            $status = 'Sended';
            $type = 'Order';
            $uri = $uritentor;
        }elseif($transactions->status == 'Agree'){
            $user_id = $transactions->user_id;
            $title = "Berhasil Menemukan Tentor";
            $description = "Kami berhasil menemukan tentor untuk anda, Segera panggil!";
            $status = 'Sended';
            $type = 'Agree';
        }elseif($transactions->status == 'Come'){
            $user_id = $transactions->course->user->id;
            $title = "Pelanggan Memanggil";
            $description = "Pelanggan dengan atas nama $name mengharapkan anda untuk datang ke lokasi, bersegeralah!";
            $status = 'Sended';
            $type = 'Come';
            $uri = $uritentor;
        }elseif($transactions->status == 'Process'){
            $user_id = $transactions->user_id;
            $title = "Selamat Belajar";
            $description = "Tentor sudah sampai di lokasi, belajarlah dengan giat!";
            $status = 'Sended';
            $type = 'Process';
        }elseif($transactions->status == 'Done'){
            $user_id = $transactions->user_id;
            $title = "Proses Belajar Selesai";
            $description = "Proses belajar telah selesai, silahkan lakukan pembayaran!";
            $status = 'Sended';
            $type = 'Done';
        }elseif($transactions->status == 'Paid'){
            $payment = $transactions->payment_code;
            $user_id = $transactions->user_id;
            $title = "Pembayaran Berhasil";
            $description = "Pembayaran dengan nomor id $payment telah berhasil. Terimaksih telah menggunakan jasa layanan kami";
            $status = 'Sended';
            $type = 'Paid';
            $notification = Notification::create([
                'user_id' => $transactions->course->user->id, 'title' => $title, 'description' => "$name berhasil melakukan pembayaran, mintalah untuk memberikan review terbaik!",
                'status' => $status, 'type' => 'Paid', 'uri' => $uritentor
            ]);
        }elseif($transactions->status == 'PaymentFailed'){
            $payment = $transactions->payment_code;
            $user_id = $transactions->user_id;
            $title = "Pembayaran Gagal";
            $description = "Pembayaran dengan nomor id $payment gagal. silahkan melakukan pembayaran ulang";
            $status = 'Sended';
            $type = 'NotFound';
        }elseif($transactions->status == 'NotFound'){
            $user_id = $transactions->user_id;
            $title = "Gagal Menemukan Tentor";
            $description = "Kami tidak berhasil menemukan tentor disekitar anda.";
            $status = 'Sended';
            $type = 'NotFound';
        }elseif($transactions->status == 'Cancel'){
            $id = $transactions->id;
            $user_id = $transactions->user_id;
            $title = "Pesanan dibatalkan";
            $description = "Pesanan dengan ID $id dibatalkan.";
            $status = 'Sended';
            $type = 'Cancel';
            $notification = Notification::create([
                'user_id' => $transactions->course->user->id, 'title' => $title, 'description' => "Pesanan dengan ID $id dibatalkan.",
                'status' => $status, 'type' => $type, 'uri' => $uritentor
            ]);
        }else{ //review
            $user_id = $transactions->user_id;
            $name = $transactions->user->name;
            $title = "Review Dari $name";
            $description = "INI BELUM KELAR";
            $status = 'Sended';
            $type = 'Cancel';
        }

        $notification = Notification::create([
            'user_id' => $user_id, 'title' => $title, 'description' => $description,
            'status' => $status, 'type' => $type, 'uri' => $uri
        ]);

        return $notification;
    }
}
