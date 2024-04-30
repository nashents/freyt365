<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bank_accounts = [
            ['company_id' => '1','name' => 'NMB', 'account_name'=>'Raysun Capital Pvt Ltd', 'account_number'=>'84593212', 'currency_id' => '1', 'branch'=>'Borrowdale','status' => '1'],
            ];
            BankAccount::insert($bank_accounts);
    }
}
