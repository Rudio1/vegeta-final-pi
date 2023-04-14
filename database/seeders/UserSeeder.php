<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersJson = '[
            {
                "name": "guilherme",
                "email": "guilhermerudio@gmail.com",
                "password": "teste"
            }
        ]';

        $users = json_decode($usersJson);

        foreach ($users as $user) {
            User::updateOrCreate(
                ['name' => $user->name],
                ['email' => $user->email, 'password' => bcrypt($user->password)],
            );
        }
    }
}