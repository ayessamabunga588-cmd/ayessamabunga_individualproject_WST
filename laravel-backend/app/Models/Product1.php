<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product1 extends Model
{
    use HasFactory;

    protected $table = 'products1';

    protected $fillable = [
    'category_id',
    'name',
    'description',
    'price',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'product_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'product_id');
    }
}