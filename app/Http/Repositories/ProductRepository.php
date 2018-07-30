<?php

namespace App\Http\Repositories;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Product;

class ProductRepository
{
	private $model;

	public function __construct(Product $model)
	{
		$this->model = $model;
	}

	public function allProducts()
	{
		$data = $this->model->all();
		return response()->json($data);
	}

	public function show($code = '')
	{
		$data = $this->model->where('code', $code);
		if(!$data){
			return response()->json([
					'message'   => 'Record not found',
			], 404);
		}
		return response()->json($data->get()->first(), 200);
	}

	public function delete($code = '')
	{
		$data = $this->model->where('code',$code);
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

	public function update(UpdateProduct $request, $code = '')
	{
		$data = $this->model->where('code', $code);
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

	public function store(StoreProduct $request)
	{
		$code_http = 400;
			 $product = new Product();

			 $product->name = $request->name;
			 $product->code = $request->code;
			 $product->price = $request->price;

			 if($product->save())
			 		$code_http = 201;

			return response()->json($product, $code_http);
	}
}
