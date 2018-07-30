<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Repositories\OrderRepository;
use App\Order;

class OrderTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */

use DatabaseTransactions;

private $code   = '4000';
private $cpf    = '40013494007';

     public function testStoreOrder()
     {
       $responseProduct = $this->json('Post','/api/products',
       [
         "code"  => $this->code,
         "name"  => "Product Test 10",
         "price" => "29.90"
       ]);

       $responseConsumer = $this->json('Post','/api/consumers',
         [
           "cpf"        => $this->cpf,
           "name"       => "Consumer Test OK",
           "birth_date" => "1980/01/01"
         ]);

       $responseOrder = $this->json('Post','/api/orders',
         [
            "cpf"  => $this->cpf,
            "product_code"  => $this->code,
            "qtd"  => "4",
            "discount_percentage" =>"10"
         ]);

         $responseOrder->assertStatus(200);
     }

     public function testGetConsumers()
     {
         $response = $this->get('/api/orders');
         $response->assertStatus(200);
     }

}
