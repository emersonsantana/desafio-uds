# WebService API Rest

Esta API Rest permite utilizar recursos para trabalhar com Produtos, Pessoas e Pedidos. <br/>
É possível Inserir, Atualizar, Remover e Listar os Produtos, Pessoas e Pedidos.

## Começando

Clone este repositório para utilizar a API.
```
git@github.com:emersonsantana/desafio-uds.git
```

### Automatização Inicial
- Migrations
Criação e modelagem do Banco de Dados
```
php artisan migration
```
- Seeders
Popula o Banco com dados fictícios
```
php artisan db:seed
```
## Utilizando o Serviço Web na Prática
A API Rest utiliza termos do HTTP em seu funcionamento, siga as assinatura para utilizar todas funcionalidades do WebService. <br/>
O WebService trabalha com JSON para envio e retorno de dados.

### Produto (Product)

- Listar todos os Produtos
```
GET: /api/products
```
- Inserir novo Produto
É necessário enviar os seguintes atributos: **code, name, price**.
```
POST: /api/products
```
- Atualizar Produto Existente
É necessário enviar os seguintes atributos: **name, price**. <br/>
É necessário passar como parâmetro o código do produto: **{code}**.
```
PUT: /api/products/{code}
```
- Excluir novo Produto <br/>
É necessário passar como parâmetro o código do produto: **{code}**.
```
DELETE: /api/products/{code}
```
- Pesquisar <br/>
É possível realizar pesquisa de produto passando os seguintes atributos: **{name, price, code}**. <br/>

```
POST: /api/products/search
```
- Exemplo: Buscar um Produto que contenha no nome 'Exe', preço de 10.90 e com o código 71864 <br/>
Pode buscar passando apenas um atributo de seu interesse.
```json
{
    "name" : "Exe",
    "price" : "10.90",
    "code" : "71864"
}
```

### Pessoa (Consumer)

- Listar todas Pessoas
```
GET: /api/consumers
```
- Inserir nova Pessoa <br/>
É necessário enviar os seguintes atributos: **name, cpf, birth_date**.
```
POST: /api/consumers
```
- Atualizar Pessoa Existente
É necessário enviar os seguintes atributos: **name, birth_date**. <br/>
É necessário passar como parâmetro o CPF da Pessoa: **{cpf}**.
```
PUT: /api/consumers/{cpf}
```
- Excluir Produto <br/>
É necessário passar como parâmetro o CPF da Pessoa: **{cpf}**.
```
DELETE: /api/consumers/{cpf}
```
### Pedidos (Orders)

- Listar todos os Pedidos
```
GET: /api/orders
```
- Inserir novo Pedido <br/>
É necessário enviar os seguintes atributos: **cpf, product_code, qtd, discount_percentage**.
```
POST: /api/orders
```
- Exemplo:
```json
{
    "cpf" : "76878355222",
    "product_code" : "71864",
    "qtd" : "4",
    "discount_percentage":"10"
}
```

- Excluir um Pedido <br/>
É necessário passar como parâmetro o Número do Pedido: **{number}**.
```
DELETE: /api/orders/{number}
```
- Exemplo: <br/>
Excluir o Pedido de número 10
```
DELETE: /api/orders/10
```


## Executando os Testes

Para executar os Testes da API será necessário utilizar o PHPunit

```
vendor/bin/phpunit
```

## Dicas Externas
É recomendado utilizar o Postman, um software para simplificar o uso de APIs.

* [Postman](https://www.getpostman.com/) - Postman Makes API Development Simple.

## Autor

* **Emerson Santana Cunha** - *Initial work* - [Perfil](https://github.com/emersonsantana/)

## Conclusão

### Challenge Accepted

Projeto desenvolvido para participar do Desafio UDS - Backend
