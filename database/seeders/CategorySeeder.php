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
            'name' => 'Sampah Plastik',
        ]);
        Category::create([
            'id' => 2,
            'name' => 'Sampah Kertas',
        ]);
        Category::create([
            'id' => 3,
            'name' => 'Sampah Basah',
        ]);
        Category::create([
            'id' => 4,
            'name' => 'Sampah Tisu',
        ]);
        Category::create([
            'id' => 5,
            'name' => 'Sampah Elektronik',
        ]);
        Category::create([
            'id' => 6,
            'name' => 'Sampah Kaca',
        ]);
        Category::create([
            'id' => 7,
            'name' => 'Sampah Logam',
        ]);
    }
}
