<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Trash;

class Trash2Chart
{
    protected $chart2;

    public function __construct(LarapexChart $chart2)
    {
        $this->chart2 = $chart2;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $trashes = Trash::where('category_id', 2)->get(); // Assuming category_id 2 is for plastic
        $data = $trashes->groupBy(function ($item) {
            return $item->created_at->format('F'); // Group by month
        })->map(function ($group) {
            return $group->sum('weight'); // Sum the weight of items in each month
        })->toArray();

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $formattedData = array_map(fn($month) => $data[$month] ?? 0, $months);

        return $this->chart2->areaChart()
            ->setTitle('Sampah Kertas.')
            ->setSubtitle('')
            ->addData('Berat Sampah Kertas (kg)', $formattedData)
            ->setXAxis($months);
    }
}
