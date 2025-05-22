<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Trash;

class TrashController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $buildings = Building::all();

        $perPage = $request->get('perPage', 25);

        if ($perPage == 'all') {
            $trashes = Trash::with('category')->orderByDesc('id')->get();
        } else {
            $perPage = is_numeric($perPage) ? (int)$perPage : 25;
            $trashes = Trash::with('category')->orderByDesc('id')->paginate($perPage)->appends($request->except('page'));
        }

        return view('layouts.pages.limbah.index', compact('trashes', 'categories', 'buildings'));
    }

    public function create()
    {
        $buildings = Building::all();
        $categories = Category::all(); 
        return view('layouts.pages.limbah', [
            'categories' => $categories,
            'building'=> $buildings,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', 
            'category_id' => 'required',
            'description',
            'weight' => 'required',
            'building_id' => 'required',
            'collection_date',
        ]);

        // dd($request->all());

        Trash::create(array_merge($request->all(), [
            'create_by' => Auth::user()->name,
        ]));

        return redirect('/limbah');
    }

    public function edit($id)
    {
        $trashes = Trash::find($id);
        $categories = Category::all();
        $buildings = Building::all();
        return view('layouts.pages.limbah.edit', compact('trashes', 'categories','buildings'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description',
            'weight' => 'required',
            'collection_date',
            'building_id' => 'required',
        ]);
        // dd($request->all());

        $trashes = Trash::find($id);
        $trashes->update(array_merge($request->all(), [
            'update_by' => Auth::user()->name,
        ]));

        return redirect('/limbah');
    }

    public function delete($id)
    {
        $trashes = Trash::find($id);
        $trashes->delete();

        return redirect()->to('/limbah');
    }

    public function softdelete()
    {
        $trashes = Trash::onlyTrashed()->paginate(10);
        return view('layouts.pages.limbah.softdelete', compact('trashes'));
    }

    public function restore($id)
    {
        $trashes = Trash::withTrashed()->find($id);
        $trashes->restore();
        return redirect()->to('/limbah');
    }

    public function forceDelete($id)
    {
        $trashes = Trash::onlyTrashed()->find($id);
        $trashes->forceDelete();
        return redirect()->to('/limbah');
    }
}
