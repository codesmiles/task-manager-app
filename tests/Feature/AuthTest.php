<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_error_login_endpoint(){
        $response = $this->post('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => '!Apassword123',

        ]);

        $response->assertStatus(406); // Assert the expected response status code
    }

    public function test_login_validation_endpoint()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'code@gmail.com',
            'password' => 'Aa1!2345678',
        ]);

       return $response->assertValid();
    }

    public function test_login_endpoint(){
        $response = $this->post('/api/auth/login',[
            'email' => 'code@gmail.com',
            'password' => 'Aa1!2345678',
        ]);

        $response->assertStatus(200);
    }
}
