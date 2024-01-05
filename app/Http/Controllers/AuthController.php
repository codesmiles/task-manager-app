<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{
    public function render_sign_up(){
        return View::make("Auth/sign_up");
    }

    public function sign_up_user(Request $request){
        $validate_request = Validator::make($request->all(),[
            
        ]);

        if($validate_request->fails()){
            return Redirect::to(url()->previous())->with("error", $validate_request->errors());
        }
    }
}
