<?php

namespace App\Http\Controllers;

use App\Charts\Trash7Chart;
use App\Charts\Trash6Chart;
use App\Charts\Trash5Chart;
use App\Charts\Trash4Chart;
use App\Charts\Trash3Chart;
use App\Charts\Trash2Chart;
use App\Charts\TrashChart;
use Illuminate\Routing\Controller;
use App\Models\Trash;

class HomeController extends Controller
{
    public function index(TrashChart $trashChart ,Trash2Chart $trash2Chart, Trash3Chart $trash3Chart, Trash4Chart $trash4Chart, Trash5Chart $trash5Chart, Trash6Chart $trash6Chart, Trash7Chart $trash7Chart) 

    {
        $chart7 = $trash7Chart->build();
        $chart6 = $trash6Chart->build();
        $chart5 = $trash5Chart->build();
        $chart4 = $trash4Chart->build();
        $chart3 = $trash3Chart->build();
        $chart2 = $trash2Chart->build();
        $chart = $trashChart->build();
        $trashes = Trash::with('category')->get();
        return view('index', compact(
            'trashes', 
            'chart', 
            'chart2', 
            'chart3',
            'chart4', 
            'chart5', 
            'chart6',
            'chart7') 
        );
    }
}
