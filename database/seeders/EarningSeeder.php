<?php

namespace Database\Seeders;

use App\Models\Earning;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EarningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = Transaction::where('status', 'Paid')->get();
        foreach($transactions as $transaction){
            $amount = $transaction->price * $transaction->time;
            Earning::create([
                'user_id' => $transaction->skill->user->id,
                'transaction_id' => $transaction->id,
                'amount' => $amount,
            ]);
            $transaction->skill->user->update(['balance' => $transaction->skill->user->balance + $amount]);
        }
    }
}
