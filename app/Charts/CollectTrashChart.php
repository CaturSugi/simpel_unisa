<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Trash;

class CollectTrashChart
{

    protected $linechart;

    public function __construct(LarapexChart $linechart)
    {
        $this->linechart = $linechart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $trashes = Trash::get();
        // Ambil semua kategori yang ada di tabel Trash
        $categories = $trashes->pluck('category_id')->unique()->sort()->values();

        // Hitung jumlah data per kategori
        $data = $categories->map(function ($categoryId) use ($trashes) {
            return $trashes->where('category_id', $categoryId)->count();
        })->toArray();

        $weights = [
            $trashes->where('category_id', 1)->sum('weight') ?: 0,
            $trashes->where('category_id', 2)->sum('weight') ?: 0,
            $trashes->where('category_id', 3)->sum('weight') ?: 0,
            $trashes->where('category_id', 4)->sum('weight') ?: 0,
            $trashes->where('category_id', 5)->sum('weight') ?: 0,
            $trashes->where('category_id', 6)->sum('weight') ?: 0,
            $trashes->where('category_id', 7)->sum('weight') ?: 0,
        ];
        $label = [

            'Sampah Plastik',
            'Sampah Kertas',
            'Sampah basah',
            'Sampah Tisu',
            'Sampah Elektronik',
            'Sampah Kaca',
            'Sampah Logam'
        ];
        return $this->linechart->lineChart()
            ->setTitle('')
            ->setSubtitle('(Satuan Kg)')
            ->addData('Sampah Terkumpul', $weights, 'Kg')
            ->setHeight(300)
            ->setXAxis($label);
    }


}
