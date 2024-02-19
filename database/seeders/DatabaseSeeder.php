<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CreateAdminUserSeeder;
use Database\Seeders\PermissionTableSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\GST_TreatmentSeeder;
use Database\Seeders\OrganizationProfileSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call([
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            GST_TreatmentSeeder::class,
            CurrencySeeder::class,
            OrganizationProfileSeeder::class,
        ]);
    }
}
