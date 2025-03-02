<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'id' => 1,
            'name' => 'Software Designing ',
            'status' => 1,
        ]);

        Category::create([
            'id' => 2,
            'name' => 'Software Development ',
            'status' => 1,
        ]);

        Category::create([
            'id' => 3,
            'name' => 'Web Designing ',
            'status' => 1,
        ]);

        Category::create([
            'id' => 4,
            'name' => 'Web Development ',
            'status' => 1, 
        ]);

        Category::create([
            'id' => 5,
            'name' => 'Cybersecurity ',
            'status' => 1,
        ]);

        Category::create([
            'id' => 6,
            'name' => 'Graphics Designing ',
            'status' => 1,
        ]);

        Category::create([
            'id' => 7,
            'name' => 'Networking and Troubleshooting ',
            'status' => 1,
        ]);

        Category::create([
            'id' => 8,
            'name' => 'CAD ',
            'status' => 1,
        ]);
    }
}
