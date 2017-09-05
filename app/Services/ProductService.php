<?php

namespace App\Services;

use App\Models\Product;

/**
* 
*/
class ProductService
{
    /**
    *   Create new product
    *
    *   @return Responce
    */
    public function create($data) {
        return Product::create($data);
    }
}