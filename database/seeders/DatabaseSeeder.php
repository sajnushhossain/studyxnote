<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Note;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'kowshiksingha555@gmail.com'],
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'password' => bcrypt('exyonimous555'),
                'is_admin' => true,
            ]
        );

        $grade10 = Category::firstOrCreate([
            'slug' => 'grade-10',
        ], [
            'name' => 'Grade 10',
            'type' => 'grade',
        ]);

        $semester1 = Category::firstOrCreate([
            'slug' => 'semester-1',
        ], [
            'name' => 'Semester 1',
            'type' => 'semester',
        ]);

        Note::create([
            'category_id' => $grade10->id,
            'title' => 'Biology: The Cell Structure',
            'content' => 'The cell is the basic structural, functional, and biological unit of all known organisms. Cells are the smallest units of life, and hence are often called the "building blocks of life". This note covers mitosis, meiosis, and the various organelles within eukaryotic cells.',
            'type' => 'text',
            'view_count' => 124,
        ]);

        Note::create([
            'category_id' => $semester1->id,
            'title' => 'World History: Industrial Revolution',
            'content' => 'The Industrial Revolution was the transition to new manufacturing processes in Great Britain, continental Europe, and the United States, in the period from about 1760 to sometime between 1820 and 1840. This note details the social and economic changes that occurred during this pivotal era.',
            'type' => 'text',
            'view_count' => 89,
        ]);
    }
}
