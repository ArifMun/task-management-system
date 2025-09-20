<?php

namespace Database\Seeders;

use App\Models\Severity;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SeveritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $severities = [
            [
                'name' => 'Low',
                'color' => 'success',
                'sort_order' => 1
            ],
            [
                'name' => 'Medium',
                'color' => 'warning',
                'sort_order' => 2
            ],
            [
                'name' => 'High',
                'color' => 'orange',
                'sort_order' => 3
            ],
            [
                'name' => 'Critical',
                'color' => 'danger',
                'sort_order' => 4
            ],
            [
                'name' => 'Info',
                'color' => 'primary',
                'sort_order' => 5
            ],
        ];
        foreach ($severities as $severity) {
            Severity::updateOrInsert(
                ['name' => $severity['name']],
                [
                    'color' => $severity['color'],
                    'sort_order' => $severity['sort_order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
