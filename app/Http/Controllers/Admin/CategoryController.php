<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories', $categories));
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
