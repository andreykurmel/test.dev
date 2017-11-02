<?php

namespace App\Services;

use App\Models\User;
use App\Services\ProductService;


class OrderService
{
    private $productService;

    public function __construct(ProductService $service) {
        $this->productService = $service;
    }

    /**
     * Create order (it means that we create User and Product for this User)
     *
     * @param array $data
     * @example {
     *      user_name,
     *      user_pass,
     *      user_email,
     *      product_name,
     *      product_code,
     *      product_description,
     *      product_inStock,
     *      product_price
     * }
     *
     * @return array [
     *      bool result,
     *      string message
     * ]
     */
    public function store($data) {
        $user_data = [
            'name' => $data['user_name'],
            'password' => bcrypt($data['user_pass']),
            'email' => $data['user_email']
        ];
        $product_data = [
            'name' => $data['product_name'],
            'code' => $data['product_code'],
            'description' => $data['product_description'],
            'inStock' => $data['product_inStock'],
            'price' => $data['product_price']
        ];

        $user = User::where('email', '=', $data['user_email'])->first();

        if ($user) {
            if ($user->password != bcrypt($data['user_pass'])) {
                return [
                    'status' => false,
                    'message' => 'Error. User already exists and inputted password is incorrect.'
                ];
            }
        } else {
            $user = User::create($user_data);
        }

        $product = $this->productService->getProduct($data['code']);

        if ($product) {
            $product = $this->productService->update($product->id, $product_data);
        } else {
            $product = $this->productService->create($product_data);
        }

        return [
            'status' => (bool)$product,
            'message' => 'Order successfully stored!'
        ];
    }
}