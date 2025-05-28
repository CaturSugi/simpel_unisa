<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {   
        $categories = Category::paginate(5);
        return view('layouts.pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('layouts.pages.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'name.unique' => 'Category name already exists',
        ]);

        Category::create($request->all());

        return redirect('/category');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'name.unique' => 'Category name already exists',
        ]);

        $category = Category::find($id);
        $category->update($request->all());

        return redirect('/category');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('layouts.pages.category.edit', compact('category'));
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->to('/category');
    }
}
