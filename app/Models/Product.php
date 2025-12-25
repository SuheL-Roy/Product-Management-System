<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'api_id',
        'title',
        'price',
        'description',
        'category',
        'image',
        'rating_rate',
        'rating_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating_rate' => 'decimal:2',
        'rating_count' => 'integer'
    ];
}
