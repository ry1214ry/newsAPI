<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'content', 'category_id', 'author', 'image_url', 'source', 'published_at'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
