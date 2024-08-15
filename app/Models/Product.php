<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected function imagePathWithoutStorage(): Attribute
    {
        return Attribute::make(get: fn ($value) => str_replace('storage/', '', $this->image_path));
    }

    protected function filePathWithoutStorage(): Attribute
    {
        return Attribute::make(get: fn ($value) => str_replace('storage/', '', $this->file_path));
    }

    // get the last image name in image_path
    protected function lastImageName(): Attribute
    {
        return Attribute::make(get: fn ($value) => collect(explode('/', $this->image_path))->last());
    }

    // get the last file name in file_path
    protected function lastFileName(): Attribute
    {
        return Attribute::make(get: fn ($value) => collect(explode('/', $this->file_path))->last());
    }
}
