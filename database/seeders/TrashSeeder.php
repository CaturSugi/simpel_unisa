<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trash;
use App\Models\Category;
use App\Models\Building;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class TrashSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = Category::all();
        $buildings = Building::all();

        if ($categories->isEmpty() || $buildings->isEmpty()) {
            $this->command->info('Category atau Building kosong. Isi dulu sebelum seeding.');
            return;
        }

        // Hapus semua data Trash dulu (optional supaya bersih)
        Trash::truncate();

        $dummyData = [];

        for ($i = 0; $i < 100; $i++) {
            $dummyData[] = [
                'category_id' => $categories->random()->id,
                'building_id' => $buildings->random()->id,
                'description' => 'Deskripsi sampah: ' . Str::random(10),
                'weight' => rand(5, 200), // Berat random antara 5kg sampai 200kg
                'name' => 'Sampah-' . Str::random(6),
                'collection_date' => Carbon::now()->subDays(rand(0, 365)), // tanggal 365 hari terakhir
                // 'collection_date' => now(),
                'created_at' => Carbon::now()->subDays(rand(0, 365)),
                'updated_at' => now(),
            ];
        }

        // Insert banyak sekaligus (lebih cepat)
        Trash::insert($dummyData);

        $this->command->info('Berhasil generate data dummy Trash!');
    }
}
