<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'category_id' => $this->category_id,
            'title'       => $this->title,
            'function'    => $this->function,
            'description' => $this->description,
            'steps'       => $this->steps,
            'image'       => $this->image ? url('storage/' . $this->image) : null,
            'created_at'  => $this->created_at->toDateTimeString(),
            'updated_at'  => $this->updated_at->toDateTimeString(),

            'category'    => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
