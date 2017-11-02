<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Product;

class ExampleTest extends TestCase
{
    public function testGuestAccess() {
        $responce = $this->get('/');
        $responce->assertStatus(200);

        $responce = $this->get('/products');
        $responce->assertStatus(200);

        $responce = $this->get('/products/1/edit');
        $responce->assertRedirect('/login');

        $responce = $this->get('/products/create');
        $responce->assertRedirect('/login');

        $responce = $this->get('/user/products/1/edit');
        $responce->assertRedirect('/login');

        $responce = $this->get('/user/products/1');
        $responce->assertRedirect('/login');

        $responce = $this->get('/user/products');
        $responce->assertRedirect('/login');

        $responce = $this->get('/user/products/create');
        $responce->assertRedirect('/login');

        $responce = $this->put('/user/products/1', [
            'name' => 'name',
            'code' => 'code',
            'description' => 'descr',
            'inStock' => '1',
            'price' => '1'
        ]);
        $responce->assertStatus(302);
        $responce->assertRedirect('/login');

        $responce = $this->delete('/user/products/1');
        $responce->assertStatus(302);
        $responce->assertRedirect('/login');

        $responce = $this->post('/products', [
            'name' => 'name',
            'code' => 'code',
            'description' => 'descr',
            'inStock' => '1',
            'price' => '1',
            'userId' => '1'
        ]);
        $responce->assertStatus(302);
        $responce->assertRedirect('/login');
    }

    public function testUserAccessToProductindex () {
        $user = User::find(1);

        $responce = $this->actingAs($user)->get('/products');
        $responce->assertStatus(200);
    }

    public function testUserAccessToProductUpdate () {
        $user = User::find(1);
        $product = Product::where('userId', '=', $user->id)->first();

        $responce = $this->actingAs($user)->put('/products/'.$product->id, [
            'name' => 'user1',
            'code' => 'user1',
            'description' => 'descr',
            'inStock' => '1',
            'price' => '1'
        ]);
        $responce->assertStatus(302);
    }
}
