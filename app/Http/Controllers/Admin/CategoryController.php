<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Console\Presets\React;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories', $categories));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data = $request->only([
            'name',
            'description',
        ]);

        $category = Category::findOrFail($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found.'], 200);
        }

        $category->update($data);

        $category->save();

        return response()->json(['success' => 'Category updated successfully.'], 200);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return response()->json(['success' => 'Category deleted successfully.'], 200);
    }
}
