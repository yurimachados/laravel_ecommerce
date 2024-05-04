<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    protected static function booted(){
        static::creating(function($product){
            if ($product->price < 0) {
                throw new \InvalidArgumentException('Price cannot be negative');
            }

            if ($product->categories->count() > 3) {
                throw new \InvalidArgumentException('A product can have a maximum of 3 categories');
            }

            if ($product->description == '' || $product->description == null) {
                throw new \InvalidArgumentException('Description cannot be empty');
            }

            if ($product->name == '' || $product->name == null) {
                throw new \InvalidArgumentException('Name cannot be empty');
            }

            if ($product->price < 0) {
                throw new \InvalidArgumentException('Price cannot be negative');
            }

            if ($product->price == '' || $product->price == null) {
                throw new \InvalidArgumentException('Price cannot be empty');
            }
        });
        
        static::saving(function($product){
            if ($product->price < 0) {
                throw new \InvalidArgumentException('Price cannot be negative');
            }

            if ($product->categories->count() > 3) {
                throw new \InvalidArgumentException('A product can have a maximum of 3 categories');
            }

            if ($product->description == '' || $product->description == null) {
                throw new \InvalidArgumentException('Description cannot be empty');
            }

            if ($product->name == '' || $product->name == null) {
                throw new \InvalidArgumentException('Name cannot be empty');
            }

            if ($product->price < 0) {
                throw new \InvalidArgumentException('Price cannot be negative');
            }

            if ($product->price == '' || $product->price == null) {
                throw new \InvalidArgumentException('Price cannot be empty');
            }
        });

        static::updating(function($product){
            if ($product->price < 0) {
                throw new \InvalidArgumentException('Price cannot be negative');
            }

            if ($product->categories->count() > 3) {
                throw new \InvalidArgumentException('A product can have a maximum of 3 categories');
            }

            if ($product->description == '' || $product->description == null) {
                throw new \InvalidArgumentException('Description cannot be empty');
            }

            if ($product->name == '' || $product->name == null) {
                throw new \InvalidArgumentException('Name cannot be empty');
            }

            if ($product->price < 0) {
                throw new \InvalidArgumentException('Price cannot be negative');
            }

            if ($product->price == '' || $product->price == null) {
                throw new \InvalidArgumentException('Price cannot be empty');
            }
        });
    }
}
