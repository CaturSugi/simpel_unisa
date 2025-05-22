<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\User;

class UsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\donutChart
    {
        $users = User::get();
        $data = [
            $users->where('role', 'admin')->count(),
            $users->where('role', 'user')->count(),
        ];
        $label = [
            'Admin',
            'User'
        ];

        return $this->chart->donutChart()
            ->setTitle('')
            ->setSubtitle('')
            ->addData($data)
            ->setLabels($label)
            ->setHeight(320);
    }
}
