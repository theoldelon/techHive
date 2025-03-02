<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //  \App\Models\Category::factory(8)->create();
        //  \App\Models\JobType::factory(9)->create();
        // \App\Models\Job::factory(30)->create();

        $this->call(CategorySeeder::class);
        $this->call(JobTypeSeeder::class);
    }
}
