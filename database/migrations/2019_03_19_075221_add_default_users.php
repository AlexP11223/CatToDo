<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = new User;
        $user->name = 'user';
        $user->email = 'alex.pantec@gmail.com';
        $user->password = \Hash::make('pass123');
        $user->save();

        $user = new User;
        $user->name = 'user2';
        $user->email = 'user2@gmail.com';
        $user->password = \Hash::make('pass123');
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->delete();
    }
}
