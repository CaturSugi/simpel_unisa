<?php

namespace App\Charts;

use App\Models\Trash;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TrashChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\areaChart
    {
        

        $trashes = Trash::where('category_id', 1)->get();
        $data = $trashes->groupBy(function ($item) {
            return $item->created_at ? $item->created_at->format('F') : 'Unknown';
        })->map(function ($group) {
            return $group->sum('weight');
        })->toArray();

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $formattedData = array_map(fn($month) => $data[$month] ?? 0, $months);

        return $this->chart->areaChart()
            ->setTitle('Sampah Plastik.')
            ->setSubtitle('')
            ->addData('Berat Sampah Plastik (kg)', $formattedData)
            ->setXAxis($months);

        // $trashes = Trash::where('category_id', 1)->get();
        // $data = $trashes->groupBy(function ($item) {
        //     return $item->created_at->format('F'); // Group by month
        // })->map(function ($group) {
        //     return $group->count(); // Count items in each month
        // })->toArray();

        // $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        // $formattedData = array_map(fn($month) => $data[$month] ?? 0, $months);

        // return $this->chart->areaChart()
        //     ->setTitle('Data Sampah Plastik.')
        //     ->setSubtitle('Tahun 2023')
        //     ->addData('Sampah Plastik', $formattedData)
        //     ->setXAxis($months);
        
        // $trashes = Trash::get();
        // $data = [
        //     $trashes->where('category_id', 1)->count(),
        //     $trashes->where('category_id', 2)->count(),
        //     $trashes->where('category_id', 3)->count(),
        //     $trashes->where('category_id', 4)->count(),
        //     $trashes->where('category_id', 5)->count(),
        //     $trashes->where('category_id', 6)->count(),
        //     $trashes->where('category_id', 7)->count(),
        // ];
        // $label = [
        //     'Sampah Plastik',
        //     'Sampah Kertas',
        //     'Sampah basah',
        //     'Sampah Tisu',
        //     'Sampah Elektronik',
        //     'Sampah Kaca',
        //     'Sampah Logam'
        // ];
        
        // return $this->chart->areaChart()
        // ->setTitle('Data Sampah.')
        // ->setSubtitle('Tahun 2023')
        // ->addData('Sampah Plastik', array_map(fn() => rand(10, 100), range(1, 12)))
        // ->addData('Sampah Kertas', array_map(fn() => rand(10, 100), range(1, 12)))
        // ->addData('Sampah Basah', array_map(fn() => rand(10, 100), range(1, 12)))
        // ->addData('Sampah Tisu', array_map(fn() => rand(10, 100), range(1, 12)))
        // ->addData('Sampah Elektronik', array_map(fn() => rand(10, 100), range(1, 12)))
        // ->addData('Sampah Kaca', array_map(fn() => rand(10, 100), range(1, 12)))
        // ->addData('Sampah Logam', array_map(fn() => rand(10, 100), range(1, 12)))
        // ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']);
    }
}
