<?php

namespace App\Services;

use App\Repositories\ProductInterface;

/**
* 
*/
class ProductService
{
    private $productRepository;

    /**
     * Create instance of ProductService
     *
     * @param \App\Repositories\ProductInterface $repo
     * @return void
     */
    public function __construct(ProductInterface $repo) {
        $this->productRepository = $repo;
    }

    /**
     * Create new Product
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($data) {
        /*Validator::make($data, [
            'name' => 'required',
            'code' => 'required|unique:products,code',
            'description' => 'required',
            'inStock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0'
        ])->validate();*/

        return $this->productRepository->create($data);
    }

    /**
     * Update Product by id
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        return $this->productRepository->update($id, $data);
    }

    /**
     * Delete Product by id
     *
     * @param $id
     * @return bool
     */
    public function delete($id) {
        return $this->productRepository->delete($id);
    }

    /**
     * Get all Products
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public function getAll() {
        return $this->productRepository->getAll();
    }

    /**
     * Get Products which are belongs to user
     *
     * @param int $id
     * @return \Illuminate\Support\Collection
     */
    public function getByUserId($id) {
        return $this->productRepository->getByUserId($id);
    }

    /**
     * Get Product
     *
     * @param mixed $product
     * @return \Illuminate\Support\Collection
     */
    public function getProduct($product) {
        if (is_numeric($product)) {
            return $this->productRepository->getById($product);
        } else {
            return $this->productRepository->getByCode($product);
        }
    }
}