<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'thumbnail', 'name', 'slug', 'description', 'is_published'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function posts(){
        return $this->belongsToMany(Post::class, 'categories_posts');
    }

    public function galleries(){
        return $this->belongsToMany(Gallery::class, 'category_galleries');
    }
}
