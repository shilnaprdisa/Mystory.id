<?php

use App\Models\Notification;
use App\Models\Setting;
use Midtrans\Config;
use Midtrans\Snap;

function rupiah($amount){
    return 'Rp '.number_format($amount, 0, ',', '.');
}
function tanggal($tanggal){
    return date('d M Y', strtotime($tanggal));
}
function tgltime($tanggal){
    return date('d M Y - H:i', strtotime($tanggal));
}
function angka($amount){
    return number_format($amount, 0, ',', '.');
}
function pagi($currentPage, $lastPage, $params = []){
    return view('layout.partials._paginate', compact('currentPage', 'lastPage', 'params'));
}
function rating($countReview, $sumRating){ 
    $rating = $sumRating ?? 0 / $countReview;
    return view('layout.partials._rating', compact('rating', 'countReview'));
}
function star($rating){
    return view('layout.partials._star', compact('rating'));
}
function wdFee($total = null){
    $wdFee = Setting::whereName('WDFee')->first();
    if($total == 'withType'){
        if($wdFee->type == 'Nominal'){
            return $wdFee->value;
        }
        return $wdFee->value. '%';
    }
    if($wdFee->type == 'Nominal' or $total == null){
        return $wdFee->value;
    }
    return $total * $wdFee->value / 100;
}
function transFee($total = null){
    $transFee = Setting::whereName('TransFee')->first();
    if($total == 'withType'){
        if($transFee->type == 'Nominal'){
            return $transFee->value;
        }
        return $transFee->value. '%';
    }
    if($transFee->type == 'Nominal' or $total == null){
        return $transFee->value;
    }
    return $total * $transFee->value / 100;
}
function wdFeeType(){
    $wdFee = Setting::whereName('WDFee')->first();
    return $wdFee->type;
}
function transFeeType(){
    $transFee = Setting::whereName('TransFee')->first();
    return $transFee->type;
}
function minWD(){
    return Setting::whereName('MinWD')->value('value');
}
function isRole($role){
    if(!auth()->user()){
        return false;
    }elseif(auth()->user()->role == $role){
        return true;
    }
    return false;
}
function tranStatus($transaction, $type){
    return view('layout.partials._transtatus', compact('transaction', 'type'));
}
function payment($transaction){
    if($transaction->status != 'Done' && $transaction->status != 'PaymentFailed'){
        return redirect()->back()->with('failed', 'Status transaksi adalah'. $transaction->status. '. Pembayaran ditolak');
    }
    $uid = uniqid();
    $transaction->update(['payment_code' => $uid]);
    // Set your Merchant Server Key
    Config::$serverKey = config('app.midtrans_server_key');
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    Config::$isProduction = false;
    // Set sanitization on (default)
    Config::$isSanitized = true;
    // Set 3DS transaction for credit card to true
    Config::$is3ds = true;

    $params = array(
        'transaction_details' => array(
            'order_id' => $uid,
            'gross_amount' => $transaction->total_price,
        ),
        'customer_details' => array(
            'first_name' => $transaction->user->name,
            'last_name' => '',
            'email' => $transaction->user->email,
            'phone' => $transaction->user->country_code.$transaction->user->phone,
        ),
    );
    $snapToken = Snap::getSnapToken($params);
    return view('layout.partials._payment', compact('snapToken'));
}

function formatPhone($phone){
    // kadang ada penulisan no hp 0811 239 345
    $phone = str_replace(" ","",$phone);
    // kadang ada penulisan no hp (0274) 778787
    $phone = str_replace("(","",$phone);
    // kadang ada penulisan no hp (0274) 778787
    $phone = str_replace(")","",$phone);
    // kadang ada penulisan no hp 0811.239.345
    $phone = str_replace(".","",$phone);

    $hp = $phone;

    // cek apakah no hp mengandung karakter + dan 0-9
    if(!preg_match('/[^+0-9]/',trim($phone))){
        // cek apakah no hp karakter 1-3 adalah +62
        if(substr(trim($phone), 0, 3)=='+62'){
            // $hp = trim($phone);
            $hp = substr(trim($phone), 3);
        }
        // cek apakah no hp karakter 1-2 adalah 62
        elseif(substr(trim($phone), 0, 2)=='62'){
            // $hp = '+62'.substr(trim($phone), 1);
            $hp = substr(trim($phone), 2);
        }
        // cek apakah no hp karakter 1 adalah 0
        elseif(substr(trim($phone), 0, 1)=='0'){
            // $hp = '+62'.substr(trim($phone), 1);
            $hp = substr(trim($phone), 1);
        }
    }
    return $hp;
}

function terbilang($angka)
{
    $angka = abs($angka);
    $baca = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");

    $terbilang = "";
    if ($angka < 12) {
        $terbilang = " " . $baca[$angka];
    } else if ($angka < 20) {
        $terbilang = terbilang($angka - 10) . " belas";
    } else if ($angka < 100) {
        $terbilang = terbilang($angka / 10) . " puluh" . terbilang($angka % 10);
    } else if ($angka < 200) {
        $terbilang = " seratus" . terbilang($angka - 100);
    } else if ($angka < 1000) {
        $terbilang = terbilang($angka / 100) . " ratus" . terbilang($angka % 100);
    } else if ($angka < 2000) {
        $terbilang = " seribu" . terbilang($angka - 1000);
    } else if ($angka < 1000000) {
        $terbilang = terbilang($angka / 1000) . " ribu" . terbilang($angka % 1000);
    } else if ($angka < 1000000000) {
        $terbilang = terbilang($angka / 1000000) . " juta" . terbilang($angka % 1000000);
    }
    return $terbilang;
}
function sendNotif($transaction){        
    $name = $transaction->user->name;
    $uri = '/transactions/'.$transaction->id;
    $uritentor = '/tentor/transactions/'.$transaction->id;
    
    if($transaction->status == 'Order'){
        $user_id = $transaction->course->user->id;//tentor
        $title = "Pesanan Baru";
        $description = "Ada pesanan baru dari $name,segera terima untuk membuat kesepakatan!";
        $status = 'Sended';
        $type = 'Order';
        $uri = $uritentor;
    }elseif($transaction->status == 'Agree'){
        $user_id = $transaction->user_id;//student
        $title = "Berhasil Menemukan Tentor";
        $description = "Kami berhasil menemukan tentor untuk anda, Segera panggil!";
        $status = 'Sended';
        $type = 'Agree';
    }elseif($transaction->status == 'Come'){
        $user_id = $transaction->course->user->id;//tentor
        $title = "Pelanggan Memanggil";
        $description = "Pelanggan dengan atas nama $name mengharapkan anda untuk datang ke lokasi, bersegeralah!";
        $status = 'Sended';
        $type = 'Come';
        $uri = $uritentor;
    }elseif($transaction->status == 'Process'){
        $user_id = $transaction->course->user->id;//tentor
        $title = "Selamat Mengajar";
        $description = "Proses belajar dimulai!";
        $status = 'Sended';
        $type = 'Process';
    }elseif($transaction->status == 'Done'){
        $user_id = $transaction->user_id;//student
        $title = "Proses Belajar Selesai";
        $description = "Proses belajar telah selesai, silahkan lakukan pembayaran!";
        $status = 'Sended';
        $type = 'Done';
    }elseif($transaction->status == 'Paid'){
        $payment = $transaction->payment_code;
        $user_id = $transaction->user_id;
        $title = "Pembayaran Berhasil";
        $description = "Pembayaran dengan nomor id $payment telah berhasil. Terimaksih telah menggunakan jasa layanan kami";
        $status = 'Sended';
        $type = 'Paid';
        $notification = Notification::create([
            'user_id' => $transaction->course->user->id, 'title' => $title, 'description' => "$name berhasil melakukan pembayaran, mintalah untuk memberikan review terbaik!",
            'status' => $status, 'type' => 'Paid', 'uri' => $uritentor
        ]);
    }elseif($transaction->status == 'PaymentFailed'){
        $payment = $transaction->payment_code;
        $user_id = $transaction->user_id;
        $title = "Pembayaran Gagal";
        $description = "Pembayaran dengan nomor id $payment gagal. silahkan melakukan pembayaran ulang";
        $status = 'Sended';
        $type = 'NotFound';
    }elseif($transaction->status == 'NotFound'){
        $user_id = $transaction->user_id;
        $title = "Gagal Menemukan Tentor";
        $description = "Kami tidak berhasil menemukan tentor disekitar anda.";
        $status = 'Sended';
        $type = 'NotFound';
    }elseif($transaction->status == 'Cancel'){
        $id = $transaction->id;
        $user_id = $transaction->user_id;
        $title = "Pesanan dibatalkan";
        $description = "Pesanan dengan ID $id dibatalkan.";
        $status = 'Sended';
        $type = 'Cancel';
        $notification = Notification::create([
            'user_id' => $transaction->course->user->id, 'title' => $title, 'description' => "Pesanan dengan ID $id dibatalkan.",
            'status' => $status, 'type' => $type, 'uri' => $uritentor
        ]);
    }else{ //review
        $user_id = $transaction->user_id;
        $name = $transaction->user->name;
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