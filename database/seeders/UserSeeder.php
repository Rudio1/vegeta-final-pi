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
                "name": "Admin",
                "email": "admin@codenapp.com",
                "password": "$2y$10$T.qxI7j4YnETDGk1gHEi3uRIROwGvNMrlvWVspNj3lhr1RobQ33aa"
            }
        ]';

        $users = json_decode($usersJson);

        foreach ($users as $user) {
            User::updateOrCreate(
                ['name' => $user->name],
                ['email' => $user->email, 'password' => $user->password],
            );
        }
    }
}