<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$soCMjYlnUu2gV9qM1nD6D.bSjZVazYzsREbhNg0RAZIGIgGBU7vz.',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
