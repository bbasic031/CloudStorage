<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\UserFile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [];
        foreach (['super_admin' => 'Super Administrator', 'admin' => 'Administrator', 'user' => 'User'] as $name => $label) {
            $roles[$name] = Role::firstOrCreate(['name' => $name], ['label' => $label]);
        }

        User::factory()->create([
            'username' => 'superadmin', 'name' => 'Super', 'last_name' => 'Admin',
            'email' => 'superadmin@example.com',
        ])->roles()->attach($roles['super_admin']);

        User::factory()->create([
            'username' => 'admin', 'name' => 'Ana', 'last_name' => 'Admin',
            'email' => 'admin@example.com',
        ])->roles()->attach($roles['admin']);

        $demo = User::factory()->create([
            'username' => 'ivan.horvat', 'name' => 'Ivan', 'last_name' => 'Horvat',
            'email' => 'ivan.horvat@example.com',
        ]);
        $demo->roles()->attach($roles['user']);
        UserFile::factory(8)->create(['user_id' => $demo->id]);

        User::factory(5)->create()->each(function (User $u) use ($roles) {
            $u->roles()->attach($roles['user']);
            UserFile::factory(random_int(1, 7))->create(['user_id' => $u->id]);
        });
    }
}
