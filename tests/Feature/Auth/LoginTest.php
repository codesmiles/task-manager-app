<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Factory;

class LoginTest extends TestCase
{

    public function test_error_login_endpoint()
    {

        $response = $this->post('/api/auth/login', [
            'email' => 'smiles@example.com',
            'password' => 'Aa!12345678',

        ]);

        $response->assertStatus(406); // Assert the expected response status code
    }

    public function test_login_validation_success_endpoint()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'code@gmail.com',
            'password' => 'Aa1!2345678',
        ]);

        $response->assertValid();
    }

    public function test_login_validation_error_endpoint()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'code@gmail.com',
        ]);
        $response->assertInvalid();
    }

    public function testUserLoginWithValidCredentials()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'smiles@example.com',
            'password' => 'Aa!12345678',
        ]);

    
        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonStructure([
            "successful",
            "message",
            "payload" => [
                "user" => [
                    "id",
                    "name",
                    "email",
                    "email_verified_at",
                    "role",
                    "created_at",
                    "updated_at"
                ],
                "token"
            ]

        ]);
    }

    // public function testUserLoginWithInvalidCredentials()
    // {
    //     $response = $this->post('/api/auth/login', [
    //         'email' => 'code@gmail.com',
    //         // 'password' => 'Aa1!2345678',
    //     ]);

    //     $response->assertStatus(Response::HTTP_NOT_ACCEPTABLE); // Assert the expected response status code

    //     // $response->assertJsonStructure([
    //     //     'message',
    //     //     'errors' => [
    //     //         '*' => function ($error) {
    //     //             $this->assertNotEmpty($error);
    //     //         },
    //     //     ],
    //     // ]);

    // }
}
