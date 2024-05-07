<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\RankSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\FolderSeeder;
use Database\Seeders\AccountSeeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\ExpenseSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\EmployeeSeeder;
use Database\Seeders\FuelTypeSeeder;
use Database\Seeders\TripTypeSeeder;
use Database\Seeders\HorseMakeSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\HorseModelSeeder;
use Database\Seeders\VendorTypeSeeder;
use Database\Seeders\AccountTypeSeeder;
use Database\Seeders\BankAccountSeeder;
use Database\Seeders\MeasurementSeeder;
use Database\Seeders\ExpenseCategorySeeder;
use Database\Seeders\AccountTypeGroupSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

           $this->call(RoleSeeder::class);
           $this->call(DepartmentSeeder::class);
           $this->call(RankSeeder::class);
           $this->call(CurrencySeeder::class);
           $this->call(CompanySeeder::class);
           $this->call(JobTitleSeeder::class);
           $this->call(BankAccountSeeder::class);
           $this->call(TripTypeSeeder::class);
           $this->call(FuelTypeSeeder::class);
           $this->call(ServiceSeeder::class);
           $this->call(VendorTypeSeeder::class);
           $this->call(AccountTypeGroupSeeder::class);
           $this->call(AccountTypeSeeder::class);
           $this->call(AccountSeeder::class);
           $this->call(ExpenseCategorySeeder::class);
           $this->call(ExpenseSeeder::class);
           $this->call(HorseMakeSeeder::class);
           $this->call(HorseModelSeeder::class);
           $this->call(CargoSeeder::class);
           $this->call(CountrySeeder::class);
           $this->call(MeasurementSeeder::class);
           $this->call(FolderSeeder::class);

    }
}
