<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Trash;

class Trash5Chart
{
    protected $chart5;

    public function __construct(LarapexChart $chart5)
    {
        $this->chart5 = $chart5;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $trashes = Trash::where('category_id', 5)->get();
        $data = $trashes->groupBy(function ($item) {
            return $item->created_at->format('F');
        })->map(function ($group) {
            return $group->sum('weight');
        })->toArray();

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $formattedData = array_map(fn($month) => $data[$month] ?? 0, $months);

        return $this->chart5->areaChart()
            ->setTitle('Sampah Elektronik.')
            ->setSubtitle('')
            ->addData('Berat Sampah Elektronik (kg)', $formattedData)
            ->setXAxis($months);
    }
}
