<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;


use App\Http\Resources\CustomerResource;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

	public function index()
	{
		$customers = CustomerResource::collection(Customer::orderBy('id', 'DESC')->get());

		return response(
			$customers,
			200
		);
	}


	public function store(Request $request)
	{
		$validator = Validator::make(
			$request->all(),
			[
			'first_name' => 'required|string|min:3',
			'last_name' => 'required|string|min:3',
			'email' => 'required|email|unique:customers,email'
			]
		);

		if($validator->fails()) {
			return response()->json($validator->errors(), 422);
		}

		$customer = Customer::create($validator->validated());

		return response(
			[
				'data' => new CustomerResource($customer),
				'message' => 'customer created successfully'
			],
			201
		);
	}


	public function show(Customer $customer)
	{
		return response(
			[$customer],
			200
		);
	}


	public function update(Request $request, Customer $customer)
	{
		$validator = Validator::make(
			$request->except('_method'),
			[
			'first_name' => 'required|string|min:3',
			'last_name' => 'required|string|min:3',
			'email' => 'required|email|unique:customers,email,'.$customer->id.',id'
			]
		);

		if($validator->fails()) {
			return response()->json($validator->errors(), 422);
		}

		$customer->update($validator->validated());

		return response(
			[
				'data' => new CustomerResource($customer),
				'message' => 'customer updated successfully'
			],
			201
		);
	}


	public function destroy($id)
	{
		if (! $customer = Customer::find($id)) {
			return response(
				['message' => 'This customer not exists'],
				404
			);
		}

		$customer->delete();

		return response(
			['message' => 'customer deleted successfully'],
			200
		);
	}
}
