<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'admin@gmail.com',
            'avatar' => '/avatars/avatar.png',
            'admin' => 1
        ]);

        App\User::create([
            'name' => 'Shamsul Huda',
            'password' => bcrypt('password'),
            'email' => 'shamsulhuda@gmail.com',
            'avatar' => '/avatars/avatar.png',
        ]);
    }
}
