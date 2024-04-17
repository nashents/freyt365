<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccountTypeGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccountTypeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = ['Assets','Liabilities & Credit Cards', 'Income', 'Expenses', 'Equity'];
        foreach($groups as $group){
            AccountTypeGroup::create([
                'name' => $group
            ]);
        }
    }
}
