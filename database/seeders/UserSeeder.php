<?php

namespace Database\Seeders;

use App\Actions\User\CreateUser;
use App\Enums\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => fake()->name(),
                'email' => 'admin@admin.com',
                'password' => 'password',
            ],
        ];

        foreach ($users as $user) {
            (new CreateUser($user))->execute();
        }
    }
}
