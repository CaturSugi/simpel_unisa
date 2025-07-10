<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Building;
use App\Models\Category;
use App\Models\Trash;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


class ReportController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Trash::with('category');

        // Filter berdasarkan rentang tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Filter berdasarkan kategori sampah
        if ($request->filled('category_id') && $request->category_id !== 'all') {
            $query->where('category_id', $request->category_id);
        }

        // Filter berdasarkan gedung
        if ($request->filled('building_id') && $request->building_id !== 'all') {
            $query->where('building_id', $request->building_id);
        }

        $categories = Category::all();
        $buildings = Building::all();

        // Pagination logic
        $perPage = $request->input('perPage', 25);
        $query->orderBy('created_at', 'desc'); // Urutkan dari terbaru ke terlama
        if ($perPage === 'all') {
            $trashes = $query->get();
        } else {
            $perPage = is_numeric($perPage) ? (int)$perPage : 25;
            $trashes = $query->paginate($perPage)->appends($request->except('page'));
        }

        return view('layouts.pages.laporan.index', compact('trashes', 'categories', 'buildings'));
    }

    public function reportchart(Request $request)
    {
        $buildings = Building::all();
        $categories = Category::all();

        $chartData = [];

        foreach ($categories as $category) {
            $dataBuilding = [];

            foreach ($buildings as $building) {
                $weight = Trash::where('category_id', $category->id)
                    ->where('building_id', $building->id)
                    ->sum('weight');

                $dataBuilding[] = $weight ?: 0; // Jika null, jadikan 0
            }

            $chartData[] = [
                'label' => $category->name,
                'data' => $dataBuilding,
                'borderColor' => $this->randomColor(1),
                'backgroundColor' => $this->randomColor(0.5),
                'fill' => false,
                'tension' => 0.4,
            ];
        }

        // dd([
        //     'buildings' => $buildings->pluck('name'),
        //     'chartData' => $chartData,
        // ]);
        

        return view('layouts.pages.laporan.chart', [
            'buildings' => $buildings,
            'chartData' => $chartData,
        ]);
    }

    public function chartbuilding(Request $request)
    {
        $buildings = Building::all();
        $categories = Category::all();

        // Ambil filter gedung jika ada
        $buildingId = $request->input('building_id');

        $chartData = [];

        foreach ($categories as $category) {
            $data = [];

            if ($buildingId && $buildingId !== 'all') {
            // Filter satu gedung saja
            $weight = Trash::where('category_id', $category->id)
                ->where('building_id', $buildingId)
                ->sum('weight');
            $data[] = $weight ?: 0;
            } else {
            // Semua gedung, tampilkan berat per gedung
            foreach ($buildings as $building) {
                $weight = Trash::where('category_id', $category->id)
                ->where('building_id', $building->id)
                ->sum('weight');
                $data[] = $weight ?: 0;
            }
            }

            $chartData[] = [
            'label' => $category->name,
            'data' => $data
            ];
        }

        // dd($chartData);

        return view('layouts.pages.laporan.chart.chartbuilding', [
            'buildings' => $buildings,
            'chartData' => $chartData
        ]);
    }

    public function printPdf(Request $request)
    {
        $query = Trash::with('category');

        // Filter berdasarkan rentang tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Filter berdasarkan kategori sampah
        if ($request->filled('category_id') && $request->category_id !== 'all') {
            $query->where('category_id', $request->category_id);
        }

        // Filter berdasarkan gedung
        if ($request->filled('building_id') && $request->building_id !== 'all') {
            $query->where('building_id', $request->building_id);
        }

        $trashes = $query->get();
        $categories = Category::all();
        $buildings = Building::all();

        // Pilihan file type
        $fileType = $request->input('file_type', 'pdf');
        if ($fileType === 'csv') {
            // Export CSV
            $filename = 'laporan.csv';
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
            ];

            $callback = function() use ($trashes) {
                $handle = fopen('php://output', 'w');
                // Header CSV
                fputcsv($handle, ['Tanggal', 'Kategori', 'Gedung', 'Berat']);
                foreach ($trashes as $trash) {
                    fputcsv($handle, [
                        $trash->created_at,
                        $trash->category->name ?? '',
                        $trash->building->name ?? '',
                        $trash->weight,
                    ]);
                }
                fclose($handle);
            };

            return response()->stream($callback, 200, $headers);
        }

        // dd($trashes);
        // Default PDF
        $pdf = PDF::loadView('layouts.pages.laporan.pdf', compact('trashes', 'categories', 'buildings'));
        return $pdf->download('laporan.pdf');
    }

    // Helper warna random
    private function randomColor($opacity = 1)
    {
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);
        return "rgba($r, $g, $b, $opacity)";
    }
        
}

