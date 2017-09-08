<?php

namespace App\Services;

use App\Repositories\ProductRepository;

/**
* 
*/
class ProductService
{
    private $productRepository;

    /**
     * Create instance of ProductService
     *
     * @param \App\Repositories\ProductRepository $repo
     * @return void
     */
    public function __construct(ProductRepository $repo) {
        $this->productRepository = $repo;
    }

    /**
     * Create new Product
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($data) {
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
}