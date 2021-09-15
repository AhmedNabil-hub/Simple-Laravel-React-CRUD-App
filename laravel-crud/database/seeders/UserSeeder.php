<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

	public function run()
	{
		User::create([
			'name' => 'admin',
			'email' => 'admin@admin.com',
			'email_verified_at' => now(),
			'password' => Hash::make('admin'),
			'remember_token' => Str::random(10)
		]);

    User::factory()
			->count(10)
			->create();
	}
}
