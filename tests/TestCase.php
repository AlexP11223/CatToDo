<?php

namespace Tests;

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

}
