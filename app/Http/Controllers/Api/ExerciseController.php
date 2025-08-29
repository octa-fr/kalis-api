<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;
use App\Http\Resources\ExerciseResource;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::with(['category', 'proCategory'])->get();

        return response()->json([
            'status' => 'success',
            'data' => ExerciseResource::collection($exercises)
        ]);
    }

    public function show($id)
    {
        $exercise = Exercise::with(['category', 'proCategory'])->find($id);

        if (!$exercise) {
            return response()->json([
                'status' => 'error',
                'message' => 'Exercise not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => new ExerciseResource($exercise)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'steps' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'pro_category_id' => 'nullable|exists:pro_categories,id',
            'image' => 'nullable|string'
        ]);

        $exercise = Exercise::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Exercise created',
            'data' => new ExerciseResource($exercise->load(['category','proCategory']))
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json([
                'status' => 'error',
                'message' => 'Exercise not found'
            ], 404);
        }

        $exercise->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Exercise updated',
            'data' => new ExerciseResource($exercise->load(['category','proCategory']))
        ]);
    }

    public function destroy($id)
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return response()->json([
                'status' => 'error',
                'message' => 'Exercise not found'
            ], 404);
        }

        $exercise->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Exercise deleted'
        ]);
    }
}
