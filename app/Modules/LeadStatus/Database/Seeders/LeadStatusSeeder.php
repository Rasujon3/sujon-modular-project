<?php

namespace App\Modules\LeadStatus\Database\Seeders;

use App\Modules\LeadStatus\Models\LeadStatus;
use Illuminate\Database\Seeder;

class LeadStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input = [
            [
                'name' => 'Attempted',
                'color' => '#ff2d42',
                'order' => 1,
            ],
            [
                'name' => 'Not Attempted',
                'color' => '#84c529',
                'order' => 2,
            ],
            [
                'name' => 'Contacted',
                'color' => '#0000ff',
                'order' => 3,
            ],
            [
                'name' => 'New Opportunity',
                'color' => '#c0c0c0',
                'order' => 4,
            ],
            [
                'name' => 'Additional Contact',
                'color' => '#03a9f4',
                'order' => 5,
            ],
            [
                'name' => 'In Progress',
                'color' => '#9C27B0',
                'order' => 5,
            ],
        ];

        foreach ($input as $leadStatus) {
            LeadStatus::create($leadStatus);
        }
    }
}
