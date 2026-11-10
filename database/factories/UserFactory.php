<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'username' => fake()->unique()->userName(),
            'name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
            'email_verified_at' => now(),
            'password' => 'password', // hashed by the model cast
            'remember_token' => Str::random(10),
            'storage_limit' => 3 * 1024 * 1024 * 1024,
        ];
    }
}
