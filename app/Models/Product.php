<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'image', 'price', 'stock','store_id'];

    use SoftDeletes;

    public function categories()
    {
        return $this->belongsToMany(category::class);
    }
    public function carts()
    {
        return $this->hasMany(cart::class);
    }
}
