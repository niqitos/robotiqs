<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,
        DatabaseMigrations,
        InteractsWithExceptionHandling;

    public function create($class, $attributes = [], $times = null)
    {
        return factory($class, $times)->create($attributes);
    }

    public function make($class, $attributes = [], $times = null)
    {
        return factory($class, $times)->make($attributes);
    }
}
