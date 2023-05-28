<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Role::factory()->create([
            'name' => 'admin',
        ]);
        \App\Models\Role::factory()->create([
            'name' => 'user',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'password' => Hash::make('admin'),
            'role_id' => '1'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'user2',
            'email' => 'user2@mail.ru',
            'password' => Hash::make('user'),
            'role_id' => '2'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'user3',
            'email' => 'user3@mail.ru',
            'password' => Hash::make('user'),
            'role_id' => '2'
        ]);

        \App\Models\Question::factory()->count(10)->create();

        \App\Models\Answer::factory()->count(10)->create();

    }
}
