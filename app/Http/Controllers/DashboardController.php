<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Charts\CollectTrashChart;
use App\Charts\UsersChart;
use App\Models\Trash;
use App\Models\User;
use App\Charts\TrashCategoryChart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(UsersChart $chart, CollectTrashChart $linechart, TrashCategoryChart $piechart, Request $request)
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $users = User::all();
            $perPage = $request->get('perPage', 25);

            if ($perPage == 'all') {
                $trashes = Trash::with('category')->get();
            } else {
                $perPage = is_numeric($perPage) ? (int)$perPage : 25;
                $trashes = Trash::with('category')->paginate($perPage)->appends($request->except('page'));
            }

            if ($request->has('search') && $request->search) {
                $trashes = Trash::with('category')
                    ->where('name', 'like', '%' . $request->search . '%');
            }

            $categories = Trash::select('category_id')->distinct()->get();

            return view('layouts.pages.dashboard.admin', [
                'users' => $users,
                'linechart' => $linechart->build(),
                'chart' => $chart->build(),
                'trashes' => $trashes,
                'categories' => $categories,
            ]);
        } elseif ($user->role === 'user') {
            $perPage = $request->get('perPage', 25);

            if ($perPage == 'all') {
                $trashes = Trash::with('category')->get();
            } else {
                $perPage = is_numeric($perPage) ? (int)$perPage : 25;
                $trashes = Trash::with('category')->paginate($perPage)->appends($request->except('page'));
            }

            if ($request->has('search') && $request->search) {
                $trashes = Trash::with('category')
                    ->where('name', 'like', '%' . $request->search . '%');
            }

            $categories = Trash::select('category_id')->distinct()->get();

            return view('layouts.pages.dashboard.user', [
                'linechart' => $linechart->build(),
                'piechart' => $piechart->build(),
                'trashes' => $trashes,
                'categories' => $categories
            ]);
        }

        abort(403, 'Unauthorized action.');
    }

}