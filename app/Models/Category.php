<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sub_title', 'category_image'];

    public function product()
    {
        return $this->HasMany(Product::class, 'category_id', 'id');
    }
}