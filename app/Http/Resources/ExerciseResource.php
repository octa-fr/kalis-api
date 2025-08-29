<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'steps' => $this->steps,
            'image' => $this->image,
            'category' => $this->whenLoaded('category', function () {
                return [
                    'id' => $this->category->id,
                    'name' => $this->category->name,
                ];
            }),
            'pro_category' => $this->whenLoaded('proCategory', function () {
                return [
                    'id' => $this->proCategory->id,
                    'name' => $this->proCategory->name,
                ];
            }),
            'created_at' => $this->created_at->toDateString(),
        ];
    }
}
