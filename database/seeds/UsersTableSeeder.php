<?php

use App\User;
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
        User::firstOrCreate(['name' => 'user'], [
            'email' => 'alex.pantec@gmail.com',
            'password' => \Hash::make('pass123')]);

        User::firstOrCreate(['name' => 'user2'], [
            'email' => 'user2@gmail.com',
            'password' => \Hash::make('pass123')]);
    }
}
