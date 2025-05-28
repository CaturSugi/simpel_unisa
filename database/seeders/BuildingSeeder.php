<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Building::create([
            'id' => 1,
            'name' => 'Gedung A Siti Walidah',
        ]);
        Building::create([
            'id' => 2,
            'name' => 'Gedung B Siti Bariyah',
        ]);
        Building::create([
            'id' => 3,
            'name' => 'Gedung C Siti Moendjijah',
        ]);
        Building::create([
            'id' => 4,
            'name' => 'Kampus 1 UNISA Yogyakarta',
        ]);
        Building::create([
            'id' => 5,
            'name' => 'Masjid Walidah Dahlan UNISA Yogyakarta',
        ]);
        Building::create([
            'id' => 6,
            'name' => 'Asrama Mahasiswa UNISA Yogyakarta',
        ]);
    }
}
