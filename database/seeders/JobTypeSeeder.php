<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobType::create([
            'id' => 1,
            'name' => 'Full-time On-site ',
            'status' => 1,
        ]);

        JobType::create([
            'id' => 2,
            'name' => 'Full-time Remote ',
            'status' => 1,
        ]);

        JobType::create([
            'id' => 3,
            'name' => 'Full-time Hybrid ',
            'status' => 1,
        ]);

        JobType::create([
            'id' => 4,
            'name' => 'Part-time On-site ',
            'status' => 1,
        ]);

        JobType::create([
            'id' => 5,
            'name' => 'Part-time Rmote ',
            'status' => 1,
        ]);

        JobType::create([
            'id' => 6,
            'name' => 'Part-time Hybrid ',
            'status' => 1,
        ]);

        JobType::create([
            'id' => 7,
            'name' => 'Project-based On-site ',
            'status' => 1,
        ]);

        JobType::create([
            'id' => 8,
            'name' => 'Project-based Remote ',
            'status' => 1,
        ]);

        JobType::create([
            'id' => 9,
            'name' => 'Project-based Hybrid ',
            'status' => 1,
        ]);
    }
}
