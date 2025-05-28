<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buildings = Building::paginate(5);
        return view("layouts.pages.building.index", compact("buildings"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("layouts.pages.building.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'unique:buildings,name',
                'regex:/^[A-Za-z0-9\s]+$/'
            ],
        ], [
            'name.required' => 'Nama gedung wajib diisi.',
            'name.unique' => 'Nama gedung sudah ada.',
            'name.regex' => 'Nama gedung hanya boleh huruf, angka, dan spasi.',
        ]);

        Building::create($validated);

        return redirect('/building')->with('success', 'Data gedung berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $building = Building::findOrFail($id);
        return view('layouts.pages.building.edit', compact('building'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|unique:buildings,name',
            'name.unique' => 'Building name already exists',
        ]);
        $building = Building::findOrFail($id);
        $building->update($request->all());
        return redirect('/building');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $id)
    {
        $building = Building::findOrFail($id);
        $building->delete();
        return redirect()->to('/building');
    }
}
