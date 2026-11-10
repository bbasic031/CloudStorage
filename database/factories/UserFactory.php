<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $first = fake('hr_HR')->unique()->firstName();
        $last = fake('hr_HR')->unique()->lastName();
        $slug = Str::slug("$first.$last", '.');

        return [
            'username' => $slug,
            'name' => $first,
            'last_name' => $last,
            'email' => $slug.'@example.com',
            'address' => fake('hr_HR')->address(),
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
            'storage_limit' => 3 * 1024 * 1024 * 1024,
        ];
    }
}
