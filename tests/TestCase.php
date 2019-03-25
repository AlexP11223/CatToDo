<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase {
        refreshDatabase as baseRefreshDatabase;
    }

    public function refreshDatabase()
    {
        $this->baseRefreshDatabase();

        // Seed the database on every database refresh.
        $this->artisan('db:seed');
    }

    /**
     * @return User
     */
    function user() {
        return User::whereName('user')->first();
    }

    /**
     * @return User
     */
    function user2() {
        return User::whereName('user2')->first();
    }
}
