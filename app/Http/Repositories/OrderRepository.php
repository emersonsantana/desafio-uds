<?php

namespace App\Http\Repositories;

use App\Order;
use App\Http\Repositories\ConsumerRepository;

class OrderRepository
{
	private $model;

	public function __construct(Order $model)
	{
		$this->model = $model;
	}

	public function findAll()
	{
		return $this->model->all();
	}

	public function allOrders()
	{
		$data = $this->model->all();
		return response()->json($data);
	}

	public function deleteOrder($number = '')
	{
		$order = $this->model->where('number', $number);
		if(!$order){
			return response()->json([
					'message'   => 'Record not found',
			], 404);
		}
		$order->delete();
	}

	public function NewNumberOrder()
	{	/*
			Retorna um número para o pedido - que deve ser incremental
			Situações Possíveis
		  1° - já tem algum registro em ordem então pega o max e soma um, retornando para quem pediu;
		  2° - ainda não tem nenhum registro de pedido, retorna 1
		  Para verificar ir no banco.order e verificar: tem algum registro? se tive pega o max+1, senão retorna 1.
		*/
		$exist = $this->model->max('number');
		$number = 1;
		if($exist){
			$number += $exist;
			return $number;
		}
		return $number;
	}
	//Função para buscar o number para o TEST de excluir um Pedido
	public function NumberByCPF($cpf)
	{
		//primeiro busca a pessoa e o seu id do id busca
			$pessoaRep = new ConsumerRepository();
			$pessoa = $pessoaRep->where('cpf', $cpf);
			$exist = $this->model->where('id',$pessoa->id);
			return $exist->number;
	}
}
