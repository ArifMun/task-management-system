<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'pending', 'is_active' => true, 'sort_order' => 1],
            ['name' => 'in_progress', 'is_active' => true, 'sort_order' => 2],
            ['name' => 'completed', 'is_active' => true, 'sort_order' => 3],
            ['name' => 'on_hold', 'is_active' => true, 'sort_order' => 4],
            ['name' => 'cancelled', 'is_active' => true, 'sort_order' => 5],
            ['name' => 'rejected', 'is_active' => true, 'sort_order' => 6],
            ['name' => 'approved', 'is_active' => true, 'sort_order' => 7],
        ];

        foreach ($statuses as $status) {
            Status::updateOrInsert(
                ['name' => $status['name']],
                [
                    'is_active' => $status['is_active'],
                    'sort_order' => $status['sort_order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
