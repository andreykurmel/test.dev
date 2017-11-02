<?php

namespace App\Repositories;

use App\Models\Product;
use Carbon\Carbon;

/**
 *
 */
class ProductRepository implements ProductInterface
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
        $pdc = Product::find($id);
        return ($pdc ? $pdc->update($data) : false);
    }

    /**
     * Delete selected Product
     *
     * @param int $id
     * @return int
     */
    public function delete($id) {
        $pdc = Product::find($id);
        return ($pdc ? $pdc->delete() : false);
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

    /**
     * Get Product by id
     *
     * @param int $id
     * @return \Illuminate\Support\Collection
     */
    public function getById($id) {
        return Product::find($id);
    }

    /**
     * Get Product by name
     * @param $name
     * @return \Illuminate\Support\Collection
     */
    public function getByName($name) {
        return Product::where('name', 'LIKE', "%$name%")->first();
    }

    /**
     * Get Product by code
     * @param $code
     * @return \Illuminate\Support\Collection
     */
    public function getByCode($code) {
        return Product::where('code', '=', "$code")->first();
    }
}