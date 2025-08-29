<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'steps', 'category_id', 'pro_category_id', 'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function proCategory()
    {
        return $this->belongsTo(ProCategory::class);
    }
}
