<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Trash;

class Trash4Chart
{
    protected $chart4;

    public function __construct(LarapexChart $chart4)
    {
        $this->chart4 = $chart4;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $trashes = Trash::where('category_id', 4)->get(); // Assuming category_id 2 is for plastic
        $data = $trashes->groupBy(function ($item) {
            return $item->created_at->format('F'); // Group by month
        })->map(function ($group) {
            return $group->sum('weight'); // Sum the weight of items in each month
        })->toArray();

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $formattedData = array_map(fn($month) => $data[$month] ?? 0, $months);

        return $this->chart4->areaChart()
            ->setTitle('Sampah Tisu.')
            ->setSubtitle('')
            ->addData('Berat Sampah Tisu (kg)', $formattedData)
            ->setXAxis($months);
    }
}
