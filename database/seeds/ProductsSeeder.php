<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'test product',
            'code' => 'tp123',
            'description' => 'some text here',
            'inStock' => 5,
            'price' => 20.57
        ]);
        DB::table('products')->insert([
            'name' => 'some more',
            'code' => 'sm098',
            'description' => 'description of the product',
            'inStock' => 0,
            'price' => 14.5
        ]);
        DB::table('products')->insert([
            'name' => 'name test',
            'code' => 'nt567',
            'description' => 'you can buy this product!',
            'inStock' => 99,
            'price' => 0.12
        ]);
    }
}
