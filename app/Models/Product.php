<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'features', // New JSON field for features
        'price',
        'discount_price',
        'thumbnail',
        'category_id',
        'store_id',
        'quantity',
        'status', // e.g., active, inactive, out_of_stock
    ];


    protected $casts = [
        'features' => 'array', // Cast features JSON to array
    ];

     public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
