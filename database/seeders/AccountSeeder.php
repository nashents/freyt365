<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $cash_bank = AccountType::where('name','Cash & Bank')->get()->first();
        $short_term_asset = AccountType::where('name','Other Short-Term Asset')->get()->first();
        
        $accounts = [
            ['user_id' => '1','currency_id' => '1','account_type_id' => $cash_bank->id, 'name' => 'Cash on Hand','description' => "Cash you haven’t deposited in the bank. Add your bank and credit card accounts to accurately categorize transactions that aren`t cash."],
            ['user_id' => '1', 'currency_id' => '1','account_type_id' => $short_term_asset->id, 'name' => 'Taxes Recoverable/Refundable','description' => "A tax is recoverable if you can deduct the tax you've paid from the tax you've collected. Many sales taxes are considered recoverable."],
           ];

           Account::insert($accounts);
    }
}
