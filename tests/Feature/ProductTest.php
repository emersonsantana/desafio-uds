<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Repositories\ProductRepository;


class ProductTest extends TestCase
{
    /**
     *   Teste Produto (product)
     * @return void
     */
     private $code = '10';
/*
*  Afirme que a resposta tem um determinado código:
*/
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
      $response->assertStatus(202);
    }
/*
 *  Afirme que uma tabela no banco de dados não contém os dados fornecidos.
 *  É passado um Valor inválido pois é negativo. A aplicação não pode inserir tal registro.
 */
    public function testStoreProductPriceFail()
    {
        $response = $this->json('Post','/api/products',
          [
            "code" => $this->code,
            "name" => "Product Test Price",
            "price" => "-10"
          ]
        );
          $this->assertDatabaseMissing('products', [
            'name' => 'Product Test Price'
        ]);
    }
/*
 *  Afirme que uma tabela no banco de dados contém os dados fornecidos.
 *  Todos os dados são válidos. A aplicação deve persistir tal registro.
 */
    public function testStoreProductBD()
    {
        $response = $this->json('Post','/api/products',
          [
            "code" => $this->code,
            "name" => "Product Test Best",
            "price" => "100"
          ]
        );
          $this->assertDatabaseHas('products', [
            'name' => 'Product Test Best'
        ]);
    }
/*
 *  Afirme que uma tabela no banco de dados não contém os dados fornecidos.
 *  Faz a Remoção de um registro recém inserido. A aplicação deve remover o Registro com sucesso.
 */
    public function testRemoveProductBD()
    {
      $response = $this->json('Delete', 'api/products/'.$this->code);
          $this->assertDatabaseMissing('products', [
            'name' => 'Product Test Best'
        ]);
    }


}
