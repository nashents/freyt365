<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['fullname'=>'United States Dollar', 'name'=>'USD','symbol' => '$'],
            ['fullname'=>'Zimbabwean Dollar','name'=>'ZWL','symbol' => '$'],
            ['fullname'=>'South African Rand','name'=>'ZAR', 'symbol' => 'R'],
        ];
        Currency::insert($currencies);
    }
}
