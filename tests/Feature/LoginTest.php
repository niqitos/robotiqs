<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Auth\AuthenticationException;

class LoginTest extends TestCase
{
    public function testUserCanWiewALoginForm()
    {
        $response = $this->get(route('login'));
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }
}