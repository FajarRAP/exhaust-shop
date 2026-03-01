<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image'
    ];

    public function priceDisplay(): string
    {
        return Number::currency($this->price, 'IDR', locale: 'id_ID', precision: 0);
    }

    public function isStockEmpty(): bool
    {
        return $this->stock <= 0;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
