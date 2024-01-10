<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function render_sign_up(){
        return View::make("Auth.sign_up");
    }

    public function sign_up_user(Request $request){

        /*
        |--------------------------------------------------------------------------
        | set payload
        |--------------------------------------------------------------------------
        */
        $payload = $request->only(["name","email","role","password","password_confirmation"]);

        /*
        |--------------------------------------------------------------------------
        | validate request
        |--------------------------------------------------------------------------
        */
        $validate_request = Validator::make($payload,
        [
            "name" => "string|required",
            "role" => "string|required|in:member,admin",
            "email" => "string|required|email|unique:users,email",
            "password" => "string|required|confirmed|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}$/"
        ]);

        if($validate_request->fails()){
            return response()->json([
                "successful" => false,
                "message" => $validate_request->errors()
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | save user
        |--------------------------------------------------------------------------
        */
        $createUser = User::create($payload);

        return response()->json(
            [
                "successful" => true,
                "payload" => $createUser
        ],
        Response::HTTP_CREATED);
    }

    public function render_login(){
        return View::make("Auth.login");
    }

    public function login_user(Request $request){
        /*
        |--------------------------------------------------------------------------
        | validate request
        |--------------------------------------------------------------------------
        */
        $validate_request = Validator::make(
            $request->only(["email","password"]),
            [
                "email" => "string|required|email",
                "password" => "string|required"
            ]
        );

        if ($validate_request->fails()) {
            return response()->json([
                "successful" => false,
                "message" => $validate_request->errors()
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | login
        |--------------------------------------------------------------------------
        */
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
