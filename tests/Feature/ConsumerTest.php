<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConsumerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     private $cpf = '60416272088';

    public function testGetConsumers()
    {
        $response = $this->get('/api/consumers');
        $response->assertStatus(200);
    }

    public function testStoreConsumer()
    {
      $response = $this->json('Post','/api/consumers',
      [
        "cpf" => $this->cpf,
        "name" => "Consumer Test",
        "birth_date" => "1980/01/01"
      ]
    );
    $response->assertStatus(201);
    }

    public function testRemoveConsumer()
    {
      $response = $this->json('Delete', 'api/consumers/'.$this->cpf);
      $response->assertStatus(200);
    }
}
