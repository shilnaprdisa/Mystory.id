<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach($users as $user){
            if($user->role == 'Student'){
                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Berhasil Menemukan Tentor',
                    'description' => 'Kami berhasil menemukan tentor untuk anda, Segera panggil!',
                    'status' => 'Sended',
                    'type' => 'Agree',
                    'uri' => '/transactions/1',
                ]);
                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Selamat Belajar',
                    'description' => 'Tentor sudah sampai di lokasi, belajarlah dengan giat!',
                    'status' => 'Sended',
                    'type' => 'Process',
                    'uri' => '/transactions/1',
                ]);
                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Proses Belajar Selesai',
                    'description' => 'Proses belajar telah selesai, silahkan lakukan pembayaran!',
                    'status' => 'Sended',
                    'type' => 'Done',
                    'uri' => '/transactions/1',
                ]);
                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Pembayaran Berhasil',
                    'description' => 'Terimaksih telah menggunakan jasa layanan kami',
                    'status' => 'Sended',
                    'type' => 'Paid',
                    'uri' => '/transactions/1',
                ]);
            }elseif($user->role == 'Tentor'){
                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Ada Pesanan Baru',
                    'description' => 'Ada pesanan baru untuk anda,segera terima untuk membuat kesepakatan!',
                    'status' => 'Sended',
                    'type' => 'Order',
                    'uri' => '/tentor/transactions/1',
                ]);
                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Pelanggan Memanggil',
                    'description' => 'Pelanggan mengharapkan anda untuk datang ke lokasi, bersegeralah!',
                    'status' => 'Sended',
                    'type' => 'Come',
                    'uri' => '/tentor/transactions/1',
                ]);
                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Pembayaran Berhasil',
                    'description' => 'Pelanggan berhasil melakukan pembayaran, mintalah untuk memberikan review terbaik!',
                    'status' => 'Sended',
                    'type' => 'Paid',
                    'uri' => '/tentor/transactions/1',
                ]);
            }
        }
    }
}
