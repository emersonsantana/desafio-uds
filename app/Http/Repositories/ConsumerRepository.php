<?php

namespace App\Http\Repositories;
use Illuminate\Http\Request;
use App\Http\Requests\StoreConsumer;
use App\Http\Requests\UpdateConsumer;
use App\Consumer;

class ConsumerRepository
{
	private $model;

	public function __construct(Consumer $model)
	{
		$this->model = $model;
	}

	public function allConsumers()
	{
		$data = $this->model->all();
		return response()->json($data);
	}

	public function show($cpf = '')
	{
		$data = $this->model->where('cpf', $cpf);
		if(!$data){
			return response()->json([
					'message'   => 'Record not found',
			], 404);
		}
		return response()->json($data->get()->first(), 200);
	}

	public function delete($cpf = '')
	{
		$data = $this->model->where('cpf',$cpf);
			if(!$data) {
					return response()->json([
							'message'   => 'Record not found',
					], 404);
			}
			if($data->delete()){
					return response()->json([
						'message'=>'Record deleted'
					],202);
			}
			return response()->json([
				'message'=>'Record not deleted'
			]);
	}

	public function update(UpdateConsumer $request, $cpf = '')
	{
		$data = $this->model->where('cpf', $cpf);
		 if(!$data) {
				 return response()->json([
						 'message'   => 'Record not found',
				 ], 404);
		 }
		 if($data->update($request->all())){
				 return response()->json([
					 'message'=>'Updated Record'
				 ],202);
		 }
		 return response()->json([
			 'message'=>'Record not Updated'
		 ]);
	}

	public function store(StoreConsumer $request)
	{
			 $consumer = new Consumer();

			 $consumer->name = $request->name;
			 $consumer->birth_date = $request->birth_date;
			 $consumer->cpf = $request->cpf;
			 $consumer->save();

			return response()->json($consumer, 201);
	}

	public function findByCPF($cpf)
	{
		$data = $this->model->where('cpf',$cpf)->get()->first();
		return $data;
	}

}
