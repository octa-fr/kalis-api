<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'cate_image'];

    public function exercises()
    {
        return $this->hasMany(Exercise::class, 'category_id');
    }
}
