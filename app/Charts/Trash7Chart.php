<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Trash;

class Trash7Chart
{
    protected $chart7;

    public function __construct(LarapexChart $chart7)
    {
        $this->chart7 = $chart7;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $trashes = Trash::where('category_id', 7)->get(); // Assuming category_id 2 is for plastic
        $data = $trashes->groupBy(function ($item) {
            return $item->created_at->format('F'); // Group by month
        })->map(function ($group) {
            return $group->sum('weight'); // Sum the weight of items in each month
        })->toArray();

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $formattedData = array_map(fn($month) => $data[$month] ?? 0, $months);

        return $this->chart7->areaChart()
            ->setTitle('Sampah Logam.')
            ->setSubtitle('')
            ->addData('Berat Sampah Logam (kg)', $formattedData)
            ->setXAxis($months);
    }
}
