<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    protected static function booted()
    {
        static::creating(function ($category) {
            if ($category->name == '' || $category->name == null) {
                throw new \InvalidArgumentException('Name cannot be empty');
            }
        });

        static::saving(function ($category) {
            if ($category->name == '' || $category->name == null) {
                throw new \InvalidArgumentException('Name cannot be empty');
            }
        });

        static::updating(function ($category) {
            if ($category->name == '' || $category->name == null) {
                throw new \InvalidArgumentException('Name cannot be empty');
            }
        });
    }
}
