<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use App\Consumer;
use App\Product;
use App\Http\Repositories\OrderRepository;
use App\Http\Repositories\ProductRepository;
use App\Http\Repositories\ConsumerRepository;
use App\Http\Requests\StoreOrder;
use App\Search\OrderSearch;

class OrdersController extends Controller
{
    private $orderRepository;
    private $productRepository;
    private $consumerRepository;

    public function __construct(OrderRepository $orderRepository,
                                ProductRepository $productRepository,
                                ConsumerRepository $consumerRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->consumerRepository = $consumerRepository;
    }

    public function index()
    {
      return $this->orderRepository->allOrders();
    }

    public function store(StoreOrder $request, $number = '')
    {
      $consumer = $this->consumerRepository->findByCPF($request->cpf);
      $product  = $this->productRepository->findByCode($request->product_code);

      if(isset($consumer) && isset($product))
      {
        $order    = new Order();
        $total_item = $product->price * $request->qtd;
        $discount = ( $total_item/100 ) * $request->discount_percentage;
        $total_item = round( $total_item - $discount, 2 );
          if($number){
            $order =  $this->orderRepository->findByNumber($number);
              if(!isset($order)){
                return response()->json(['message'   => 'Record not found',], 404);
              }
            $total_item = $order->total + $total_item;
          }
        //Função NewNumberOrder trata o number correto
        $order->number        = $this->orderRepository->NewNumberOrder();
        $order->emission_date = date('Y-m-d');//$request->emission_date;
        $order->consumer_id   = $consumer->id;
        $order->total         = $total_item;
        //Item do pedido
        $item = new OrderItem();
        $item->product_id = $product->id;
        $item->qtd = $request->qtd;
        $item->unit_price = $product->price;
        $item->discount_percentage = $request->discount_percentage;
        $item->total = $total_item;
            $order->save();
        $item->order_id = $order->id;
            $item->save();
        return response()->json($item);
      }

      return response()->json([
					'message'   => 'Record not found',
			], 404);
    }

    public function destroy($number)
    {
      return $this->orderRepository->deleteOrder($number);
    }

    public function search(Request $request)
    {
       return OrderSearch::apply($request);
    }

}
