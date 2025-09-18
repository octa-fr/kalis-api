<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        return response()->json(Exercise::with('category')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'function' => 'required|string|max:255',
            'description' => 'required|string',
            'steps' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $exercise = Exercise::create($request->all());

        return response()->json([
            'message' => 'Exercise created successfully',
            'exercise' => $exercise,
        ], 201);
    }

    public function show($id)
    {
        $exercise = Exercise::with('category')->findOrFail($id);
        return response()->json($exercise);
    }

    public function update(Request $request, $id)
    {
        $exercise = Exercise::findOrFail($id);

        $request->validate([
            'category_id' => 'sometimes|required|exists:categories,id',
            'title' => 'sometimes|required|string|max:255',
            'function' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'steps' => 'sometimes|required|string',
            'image' => 'nullable|string',
        ]);

        $exercise->update($request->all());

        return response()->json([
            'message' => 'Exercise updated successfully',
            'exercise' => $exercise,
        ]);
    }

    public function destroy($id)
    {
        $exercise = Exercise::findOrFail($id);
        $exercise->delete();

        return response()->json([
            'message' => 'Exercise deleted successfully',
        ]);
    }
}
