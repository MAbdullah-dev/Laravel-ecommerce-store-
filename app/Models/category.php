<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    use SoftDeletes;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
