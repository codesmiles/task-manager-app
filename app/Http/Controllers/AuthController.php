<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use HttpResponses;



    public function render_sign_up()
    {
        return View::make("Auth.sign_up");
    }

    public function sign_up_user(RegisterRequest $request)
    {
        /*
        |--------------------------------------------------------------------------
        | validate request
        |--------------------------------------------------------------------------
        */
        $request->validated($request->all());

        /*
        |--------------------------------------------------------------------------
        | save user
        |--------------------------------------------------------------------------
        */
        $createUser = User::create($request->only(["name", "email", "role", "password", "password_confirmation"]));

        /*
        |--------------------------------------------------------------------------
        | retuen response
        |--------------------------------------------------------------------------
        */
        return $this->sendResponse(
            [
                "user" => $createUser,
                "token" => $createUser->createToken("API Token of" . $createUser->name)->plainTextToken
            ],
            true,
            Response::HTTP_CREATED,
        );
    }

    public function render_login()
    {
        return View::make("Auth.login");
    }

    public function login_user(LoginRequest $request)
    {
        /*
        |--------------------------------------------------------------------------
        | validate request
        |--------------------------------------------------------------------------
        */
        $request->validated($request->all());

        /*
        |--------------------------------------------------------------------------
        | login
        |--------------------------------------------------------------------------
        */
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->sendResponse(null,false,Response::HTTP_NOT_ACCEPTABLE, "Invalid credentials");
        }

        $user = Auth::user();


        return $this->sendResponse(
            [
                "user" => $user,
                "token" => $user->createToken("API Token of" . $user->name)->plainTextToken
            ],
            true,
            Response::HTTP_OK,
            "USER LOGGED IN"
        );
    }

    public function logout(){

    }
}
