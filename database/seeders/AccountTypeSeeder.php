<?php

namespace Database\Seeders;

use App\Models\AccountType;
use Illuminate\Database\Seeder;
use App\Models\AccountTypeGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asset = AccountTypeGroup::where('name','Assets')->get()->first();
        $liabilities = AccountTypeGroup::where('name','Liabilities & Credit Cards')->get()->first();
        $income = AccountTypeGroup::where('name','Income')->get()->first();
        $expenses = AccountTypeGroup::where('name','Expenses')->get()->first();
        $equity = AccountTypeGroup::where('name','Equity')->get()->first();
        
        $account_types = [
            ['user_id' => '1','account_type_group_id' => $asset->id, 'name' => 'Cash & Bank'],
            ['user_id' => '1','account_type_group_id' => $asset->id, 'name' => 'Customer Payment Tracking Accounts'],
            ['user_id' => '1','account_type_group_id' => $asset->id, 'name' => 'Money in Transit'],
            ['user_id' => '1','account_type_group_id' => $asset->id, 'name' => 'Expected Payments from Customers'],
            ['user_id' => '1','account_type_group_id' => $asset->id, 'name' => 'Inventory'],
            ['user_id' => '1','account_type_group_id' => $asset->id, 'name' => 'Property, Plant, Equipment'],
            ['user_id' => '1','account_type_group_id' => $asset->id, 'name' => 'Depriciation & Amortization'],
            ['user_id' => '1','account_type_group_id' => $asset->id, 'name' => 'Vendor Prepayments or Vendor Credits'],
            ['user_id' => '1','account_type_group_id' => $asset->id, 'name' => 'Other Short-Term Asset'],
            ['user_id' => '1','account_type_group_id' => $asset->id,'name' => 'Taxes Recoverable/Refundable'],
            ['user_id' => '1','account_type_group_id' => $asset->id, 'name' => 'Other Long-Term Asset'],
            ['user_id' => '1','account_type_group_id' => $liabilities->id,'name' => 'Credit Cards'],
            ['user_id' => '1','account_type_group_id' => $liabilities->id,'name' => 'Taxes Payable'],
            ['user_id' => '1','account_type_group_id' => $liabilities->id,'name' => 'Shareholder Loan'],
            ['user_id' => '1','account_type_group_id' => $liabilities->id,'name' => 'Loan & Line of Credit'],
            ['user_id' => '1','account_type_group_id' => $liabilities->id,'name' => 'Expected Payment to Vendors'],
            ['user_id' => '1','account_type_group_id' => $liabilities->id,'name' => 'Due for Payroll'],
            ['user_id' => '1','account_type_group_id' => $liabilities->id,'name' => 'Due to You & Other Business Owners'],
            ['user_id' => '1','account_type_group_id' => $liabilities->id,'name' => 'Customer Prepayments & Customer Credits'],
            ['user_id' => '1','account_type_group_id' => $liabilities->id,'name' => 'Other Short-Term Liability'],
            ['user_id' => '1','account_type_group_id' => $liabilities->id,'name' => 'Other Long-Term Liability'],
            ['user_id' => '1','account_type_group_id' => $income->id,'name' => 'Income'],
            ['user_id' => '1','account_type_group_id' => $income->id,'name' => 'Discount'],
            ['user_id' => '1','account_type_group_id' => $income->id,'name' => 'Other Income'],
            ['user_id' => '1','account_type_group_id' => $expenses->id,'name' => 'Operating Expense'],
            ['user_id' => '1','account_type_group_id' => $expenses->id,'name' => 'Cost Of Goods Sold'],
            ['user_id' => '1','account_type_group_id' => $expenses->id,'name' => 'Payment Processing Fee'],
            ['user_id' => '1','account_type_group_id' => $expenses->id,'name' => 'Payroll Expense'],
            ['user_id' => '1','account_type_group_id' => $equity->id,'name' => 'Business Owner Contribution & Drawing'],
            ['user_id' => '1','account_type_group_id' => $equity->id,'name' => 'Retained Earnings: Profits'],
      
           ];

           AccountType::insert($account_types);
    }
}
