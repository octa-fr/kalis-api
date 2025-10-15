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
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['category_id', 'title', 'function', 'description', 'steps']);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('exercises', 'public');
        $data['image'] = $path;
    }

    $exercise = Exercise::create($data);

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

    $exercise->update([
        'category_id' => $request->category_id,
        'title' => $request->title,
        'description' => $request->description,
        'function' => $request->function,
        'steps' => $request->steps,
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('exercises', 'public');
        $exercise->image = $imagePath;
        $exercise->save();
    }

    return response()->json([
        'message' => 'Exercise updated successfully',
        'data' => $exercise,
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
