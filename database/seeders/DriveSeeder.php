<?php

namespace Database\Seeders;

use App\Models\Drive;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DriveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Drive::factory()->count(20)->create();
    }
}
