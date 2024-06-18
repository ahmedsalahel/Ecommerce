<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class cart extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected static function booted()
    {
        static::creating(function (Cart $cart) {
            $cart->id = Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'not added yet'
        ]);
    }

    public function product()
    {
        return $this->belongsTo(product::class)->withDefault([
            'name' => 'not added yet'
        ]);
    }
}
