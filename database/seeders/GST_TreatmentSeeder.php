<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GST_Treatment;

class GST_TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
                'title' => 'Registered Business - Regular',
                'desc' => 'Business that is registered under GST',
                'active' => true,
            ],
            [
                'title' => 'Registered Business - Composition',
                'desc' => 'Business that is registered under Composition scheme in GST',
                'active' => true,
            ],
            [
                'title' => 'Unregistered Business',
                'desc' => 'Business that has not been registered under GST',
                'active' => true,
            ],
            [
                'title' => 'Consumer',
                'desc' => 'A customer who is a regular consumer',
                'active' => true,
            ],
            [
                'title' => 'Overseas',
                'desc' => 'Persons with whom you do import or export of supplies outside india',
                'active' => false,
            ],
            [
                'title' => 'Special Economic Zone',
                'desc' => '',
                'active' => false,
            ],
            [
                'title' => 'Deemed Export',
                'desc' => '',
                'active' => false,
            ],
            [
                'title' => 'Tax Deductor',
                'desc' => '',
                'active' => false,
            ],
            [
                'title' => 'SEZ Developer',
                'desc' => '',
                'active' => false,
            ],
        ];

        foreach ($records as $record) {
            GST_Treatment::create($record);
        }
    
    }
}
