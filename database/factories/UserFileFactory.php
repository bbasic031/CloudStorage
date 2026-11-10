<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserFile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserFileFactory extends Factory
{
    protected $model = UserFile::class;

    public function definition(): array
    {
        $ext = fake()->randomElement(['docx', 'xlsx', 'pptx', 'pdf', 'png', 'jpg', 'mp3', 'zip', 'txt']);

        return [
            'user_id' => User::factory(),
            'original_name' => fake()->slug(2).'.'.$ext,
            'path' => 'uploads/seed/'.Str::uuid().'.'.$ext,
            'extension' => $ext,
            'mime_type' => 'application/octet-stream',
            'size' => fake()->numberBetween(10_000, 50_000_000), // fake size, only for demo quota
        ];
    }

    public function configure(): static
    {
        // create a small placeholder so that "download" works for seeded rows
        return $this->afterCreating(function (UserFile $file) {
            Storage::put($file->path, 'Demo content for '.$file->original_name);
        });
    }
}
