<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return response()->json([
            "successful" => true,
            "payload" => $request->user()
        ],Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | validate request
        |--------------------------------------------------------------------------
        */
        $validate_request = Validator::make(
            $payload,
            [
                "name" => "string|required",
                "role" => "string|required|in:member,admin",
                "email" => "string|required|email|unique:users,email",
                "password" => "string|required|confirmed|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}$/"
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
        | if incoming request is a password hash it
        |--------------------------------------------------------------------------
        */

         /*
        |--------------------------------------------------------------------------
        | If request is empty return an empty response
        |--------------------------------------------------------------------------
        */

        // $user = User::find($request->user()->id)->update($request->only(["name","email","role","password"]));

        // return response()->json([
        //     "successful" => true,
        //     "payload" => $user
        // ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
