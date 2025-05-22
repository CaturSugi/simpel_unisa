<?php

namespace App\Charts;

use App\Models\Category;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TrashCategoryChart
{
    protected $piechart;

    public function __construct(LarapexChart $piechart)
    {
        $this->piechart = $piechart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $categories = Category::get();
        $data = [
            $categories->where('id', 1)->count(),
            $categories->where('id', 2)->count(),
            $categories->where('id', 3)->count(),
            $categories->where('id', 4)->count(),
            $categories->where('id', 5)->count(),
            $categories->where('id', 6)->count(),
            $categories->where('id', 7)->count(),
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
        return $this->piechart->pieChart()
            ->setDataset($data)
            ->setLabels($label);
    }
}
