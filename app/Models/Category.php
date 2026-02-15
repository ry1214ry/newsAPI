<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Only allow these fields for mass assignment
    protected $fillable = ['name'];

    public function news() {
        return $this->hasMany(News::class);
    }
}
