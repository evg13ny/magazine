<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use HasFactory;

    public $timestamps = true;

    public function category()
    {

        return $this->hasMany(Category::class, 'id', 'category_id');
    }
}
