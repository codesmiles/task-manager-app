<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('/')->group( fn() => (
    Route::get("sign_up",[AuthController::class, "render_sign_up"])->name("render_sign_up")),
    Route::post('sign_up', [AuthController::class, "sign_up_user"])->name("sign_up_user")
);

