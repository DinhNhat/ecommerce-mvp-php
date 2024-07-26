<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price_in_cents', 'file_path', 'image_path'];

    public function orders(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
