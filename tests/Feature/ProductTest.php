<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     private $code = '10';

    public function testGetProducts()
    {
        $response = $this->get('/api/products');
        $response->assertStatus(200);
    }

    public function testStoreProduct()
    {
      $response = $this->json('Post','/api/products',
      [
        "code" => $this->code,
        "name" => "Product Test",
        "price" => "29.90"
      ]
    );
    $response->assertStatus(201);
    }

    public function testRemoveProduct()
    {
      $response = $this->json('Delete', 'api/products/'.$this->code);
      $response->assertStatus(200);
    }

}
