<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transaction_types = ['Deposit','Internal Transfer','Service Order','Withdrawal'];
        foreach($transaction_types as $transaction_type){
            TransactionType::create([
                'name' => $transaction_type
            ]);
        }
    }
}
