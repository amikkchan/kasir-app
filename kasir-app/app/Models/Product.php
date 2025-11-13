<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Kolom yang bisa diisi mass assignment
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

    // Relasi ke tabel kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
