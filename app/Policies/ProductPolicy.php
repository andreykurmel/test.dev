<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function update (User $user, Product $product) {
        return $user->id == $product->userId;
    }

    /**
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function delete (User $user, Product $product) {
        return $user->id == $product->userId;
    }
}
