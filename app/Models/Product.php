<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'description', 'inStock', 'price', 'userId'];

    public function user() {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
