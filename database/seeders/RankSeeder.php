<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = ['Management', 'Director', 'Employee'];
        foreach($ranks as $rank){
            Rank::create([
                'name' => $rank
            ]);
        }
    }
}
