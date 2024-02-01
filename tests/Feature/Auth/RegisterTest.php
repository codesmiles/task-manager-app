<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_signUpUser_payload_validation(){
        $response = $this->post("/api/auth/signup",[
            "name" => "mistake smiles",
            "role" => "member",
            "email" => "smiles@example.com",
            "password" =>"Aa!12345678",
            "password_confirmation" => "Aa!12345678"
        ]);

        // $user = factory(User::class)->make();

        $response->assertValid();
    }
    // public function test_signUpUser_payload_validation(){

    // }

}
