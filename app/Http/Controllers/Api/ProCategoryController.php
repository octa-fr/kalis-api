<?php

namespace App\Http\Controllers\Api;

use App\Models\ProCategory;
use Illuminate\Http\Request;

class ProCategoryController extends Controller
{
    public function index()
    {
        return response()->json(ProCategory::all());
    }

    public function show($id)
    {
        return response()->json(ProCategory::with('exercises')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        $proCategory = ProCategory::create($request->all());
        return response()->json($proCategory, 201);
    }
}
    