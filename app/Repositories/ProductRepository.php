<?php

namespace App\Repositories;

use App\Models\Product;
use Carbon\Carbon;

/**
 *
 */
class ProductRepository
{
    /**
     * Create new Product in database
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($data) {
        return Product::create($data);
    }

    /**
     * Update Product in the database
     *
     * @param int $id
     * @return bool
     */
    public function update($id, $data) {
        $pdc = Product::findOrFail($id);

        $pdc->name = $data['name'];
        $pdc->code = $data['code'];
        $pdc->description = $data['description'];
        $pdc->inStock = $data['inStock'];
        $pdc->price = $data['price'];
        $pdc->updated_at = Carbon::now();

        return $pdc->save();
    }

    /**
     * Delete selected Products
     *
     * @param int $id
     * @return int
     */
    public function delete($id) {
        return Product::destroy($id);
    }

    /**
     * Get all products
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll() {
        return Product::all();
    }

    /**
     * Get Products which are belongs to user
     *
     * @param int $id
     * @return \Illuminate\Support\Collection
     */
    public function getByUserId($id) {
        return Product::where('userId', '=', $id)->get();
    }
}