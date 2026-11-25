<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;

/**
 * A product that belongs to a user (its author).
 * Fillable lists the columns that may be mass assigned with Product::create([...]).
 */
#[Fillable(['product', 'description', 'status', 'user_id'])]
class Product extends Model
{
    // Gives the model access to factories (used by seeders and tests).
    use HasFactory;
}
