<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Trash;

class Trash6Chart
{
    protected $chart6;

    public function __construct(LarapexChart $chart6)
    {
        $this->chart6 = $chart6;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $trashes = Trash::where('category_id', 6)->get();
        $data = $trashes->groupBy(function ($item) {
            return $item->created_at->format('F');
        })->map(function ($group) {
            return $group->sum('weight');
        })->toArray();

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $formattedData = array_map(fn($month) => $data[$month] ?? 0, $months);

        return $this->chart6->areaChart()
            ->setTitle('Sampah Kaca.')
            ->setSubtitle('')
            ->addData('Berat Sampah Kaca (kg)', $formattedData)
            ->setXAxis($months);
    }
}
