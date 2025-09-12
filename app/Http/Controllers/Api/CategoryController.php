<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }

    public function show($id)
    {
        return response()->json(Category::with('exercises')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }
}   