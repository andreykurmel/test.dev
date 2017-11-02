<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'description', 'inStock', 'price', 'userId'];

    public function getDescriptionAttribute() {
        return $this->description2;
    }

    public function setDescriptionAttribute($value) {
        $this->description2 = $value;
        $this->attributes['description'] = "";
    }

    protected $visible = ['name', 'description', 'price'];

    public function user() {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
