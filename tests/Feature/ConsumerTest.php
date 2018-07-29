<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConsumerTest extends TestCase
{
    /**
     * Teste Pessoa - Consumer.
     *
     * @return void
     */
     private $cpf = '60416272088';
 /*
 *  Afirme que a resposta tem um determinado código:
 */
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
      $response->assertStatus(202);
    }

/*
 *  Afirme que uma tabela no banco de dados não contém os dados fornecidos.
 *  É passado um CPF inválido '123'. A aplicação não pode inserir tal registro.
 */
    public function testStoreConsumerCPFFail()
    {
        $response = $this->json('Post','/api/consumers',
          [
            "cpf" => 123,
            "name" => "Consumer Test CPF ERROR",
            "birth_date" => "1980/01/01"
          ]
        );
          $this->assertDatabaseMissing('consumers', [
            'name' => 'Consumer Test CPF ERROR'
        ]);
    }

/*
 *  Afirme que uma tabela no banco de dados contém os dados fornecidos.
 *  Todos os dados são válidos. A aplicação deve persistir tal registro.
 */
    public function testStoreConsumerBD()
    {
      $response = $this->json('Post','/api/consumers',
        [
          "cpf" => $this->cpf,
          "name" => "Consumer Test OK",
          "birth_date" => "1980/01/01"
        ]
      );
          $this->assertDatabaseHas('consumers', [
            'name' => 'Consumer Test OK'
        ]);
    }
/*
*  Afirme que uma tabela no banco de dados não contém os dados fornecidos.
*  Faz a Remoção de um registro recém inserido. A aplicação deve remover o Registro com sucesso.
*/
    public function testRemoveConsumerBD()
    {
      $response = $this->json('Delete', 'api/consumers/'.$this->cpf);
          $this->assertDatabaseMissing('consumers', [
            'name' => 'Consumer Test OK'
        ]);
    }
}
