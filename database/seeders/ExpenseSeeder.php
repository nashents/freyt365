<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fuel = ExpenseCategory::where('name','Fuel')->get()->first();
        $creditor_payment = ExpenseCategory::where('name','Creditor Payment')->get()->first();
        $taxes_payable = ExpenseCategory::where('name','Taxes Payable')->get()->first();
        
        $expenses = [
            ['user_id' => '1','expense_category_id' => $fuel->id, 'name' => 'Fuel Topup','type' => 'Direct'],
            ['user_id' => '1','expense_category_id' => $creditor_payment->id, 'name' => 'Transporter Payment','type' => 'Direct'],
            ['user_id' => '1','expense_category_id' => $taxes_payable->id, 'name' => 'VAT','type' => 'Direct'],
           ];

           Expense::insert($expenses);
    }
}
