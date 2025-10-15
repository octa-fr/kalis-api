<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
    {
        public function index()
    {
        $categories = Category::with('exercises')->get();

        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::with('exercises')->findOrFail($id);

        return response()->json($category);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'cate_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('cate_image')) {
            $path = $request->file('cate_image')->store('categories', 'public');
            $validated['cate_image'] = $path;
        }

        $category = Category::create($validated);

        return response()->json([
            'message' => 'Category created successfully',
            'data' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'sometimes|required|string|max:255',
            'type'       => 'sometimes|required|in:training,program',
            'cate_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $category = Category::findOrFail($id);

        if ($request->hasFile('cate_image')) {
            if ($category->cate_image && str_contains($category->cate_image, '/storage/')) {
                $oldPath = str_replace(asset('storage') . '/', '', $category->cate_image);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('cate_image')->store('categories', 'public');
            $category->cate_image = asset('storage/' . $path);
        }


        if ($request->filled('name')) {
            $category->name = $request->name;
        }
        if ($request->filled('type')) {
            $category->type = $request->type;
        }

        $category->save();

        return response()->json([
            'message' => 'Category updated successfully',
            'data'    => $category
        ]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->cate_image && str_contains($category->cate_image, '/storage/')) {
            $oldPath = str_replace(asset('storage') . '/', '', $category->cate_image);
            Storage::disk('public')->delete($oldPath);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
