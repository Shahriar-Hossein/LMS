<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Web Development',
            'Data Structures & Algorithms',
            'Competitive Programming',
            'DevOps',
            'Mobile Development',
            'Machine Learning',
            'Cloud Computing',
            'Software Engineering',
            'Databases',
            'Frontend Development',
            'Backend Development',
            'Security',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate([
                'name' => $name,
            ]);
        }
    }
}
