<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory(3)->create();

        $user = User::first();
        $user->name = "Administrator";
        $user->email = "admin@gmail.com";
        $user->username = "admin";
        $user->password = bcrypt("123456");
        $user->username = "avatar.jpg";
        $user->role_id = 1;
        $user->save();
    }
}
