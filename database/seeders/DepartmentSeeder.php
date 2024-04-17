<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = ['Information Technology', 'Human Resources', 'Finance', 'Transport & Logistics', 'Stores', 'Workshop','Security'];
        foreach($departments as $department){
            Department::create([
                'name' => $department
            ]);
        }
    }
}
