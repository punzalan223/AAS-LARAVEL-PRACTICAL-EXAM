<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\Report;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Bulk insert or update positions
        $positions = [
            ['name' => 'Developer 1'],
            ['name' => 'Developer 2'],
            ['name' => 'QA Tester 2'],
            ['name' => 'QA Tester 1'],
            ['name' => 'Developer 3'],
            ['name' => 'Senior QA Tester'],
            ['name' => 'QA Lead'],
            ['name' => 'Senior Developer 2'],
            ['name' => 'Senior Developer 1'],
            ['name' => 'Development Lead'],
            ['name' => 'Manager'],
            ['name' => 'CEO'],
        ];

        // Use `upsert` to bulk insert or update
        Position::upsert($positions, ['name']); // 'name' is the unique column to check for updates

        // Bulk insert or update reports
        $reports = [
            ['name' => 'Senior Developer 1'],
            ['name' => 'Senior Developer 1'],
            ['name' => 'Senior QA Tester'],
            ['name' => 'Senior QA Tester'],
            ['name' => 'Senior Developer 2'],
            ['name' => 'QA Lead'],
            ['name' => 'Manager'],
            ['name' => 'Development Lead'],
            ['name' => 'Development Lead'],
            ['name' => 'Manager'],
            ['name' => 'CEO'],
        ];

        Report::upsert($reports, ['name']); // 'name' is the unique column to check for updates
    }
}
