<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{

	protected $model = Customer::class;


	public function definition()
	{
		return [
			'first_name' => $this->faker->name(),
			'last_name' => $this->faker->name(),
			'email' => $this->faker->unique()->safeEmail()
		];
	}
}
