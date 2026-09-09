<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_page_can_be_rendered(): void
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
    }

    public function test_product_can_be_created(): void
    {
        $response = $this->post('/products', [
            'name' => 'Test Product',
            'description' => 'Test description',
            'price' => 49.99,
            'stock' => 10,
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 49.99,
        ]);
    }

    public function test_api_products_returns_json(): void
    {
        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true
                 ]);
    }
}
