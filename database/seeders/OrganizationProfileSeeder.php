<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;

class OrganizationProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Organization::create([
            'org_name'  => 'Default Organization OIM',
            'language'  => 'English',
            'time_zone'  => '(GMT 5:30) India Standard Time (Asia/Calcutta)'
        ]);

    }
}
