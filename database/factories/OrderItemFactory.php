<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// random float randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL)
use \App\OrderItem;
use \App\Product;
use \App\Order;

$factory->define(App\OrderItem::class, function (Faker\Generator $faker) {
//pegar a ordem para atualizar o total;
    $order = Order::all()->random();
    //repetição para inserir alguns produtos no pedido
    $qtdItems = rand(1, 10);

   for ($i=0; $i < $qtdItems; $i++) {
    $product = Product::all()->random();//busca um produto aleatório
    $unit_price = $product->price;
    $qtd = $faker->randomNumber(2);
    $discount_percentage = $faker->randomFloat(2, 0, 100);
     $total_qtd = $qtd * $unit_price;
    $discount = ( $total_qtd/100) * $discount_percentage;
     $total_qtd = round( $total_qtd - $discount, 2 );
//Atualiza valor do pedido
      $order->total = $order->total +  $total_qtd;
      $order->update();
    return [
        'id' => $faker->unique()->uuid,
        'order_id' => $order->id,
        'product_id' => $product->id,
        'qtd' => $qtd,
        'discount_percentage' => $discount_percentage,
        'unit_price' => $unit_price,//deve vir do product
        'total' =>  $total_qtd //valor * qtd

    ];
  }

});
