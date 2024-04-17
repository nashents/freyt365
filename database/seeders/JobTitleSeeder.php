<?php

namespace Database\Seeders;

use App\Models\JobTitle;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transport_logistics = Department::where('name','Transport & Logistics ')->get()->first();
        $security = Department::where('name','Security')->get()->first();
        
        $titles = [
            ['user_id' => '1','department_id' => $transport_logistics->id, 'title' => 'Driver'],
            ['user_id' => '1','department_id' => $security->id, 'title' => 'Security Officer'],
           ];

           JobTitle::insert($titles);
    }
}
