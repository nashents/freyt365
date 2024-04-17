<?php

namespace Database\Seeders;

use App\Models\Folder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $folders = ['Uncategorized'];
        foreach($folders as $folder){
            Folder::create([
                'user_id' => 1,
                'title' => $folder
            ]);
        }
    }
}
