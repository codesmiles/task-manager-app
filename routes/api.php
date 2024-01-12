<?php

/*
|--------------------------------------------------------------------------
| Illuminate
|--------------------------------------------------------------------------
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| auth
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TasksController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(["prefix" => "/user", 'middleware' => ['auth:sanctum']],function(){
    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */
    Route::get("/", [UserController::class, "show"]);
    Route::post("/update", [UserController::class, "update"]);

    Route::post('/store', [TasksController::class, "store"]);
});
/*
|--------------------------------------------------------------------------
| tasks
|--------------------------------------------------------------------------
*/
Route::prefix('tasks')->group(function () {
    Route::get('/', [TasksController::class, "index"]);
    // Route::post('/store', [TasksController::class, "store"]);
    Route::get('/update/{id}', [TasksController::class, "update"]);
    Route::get('/delete/{id}', [TasksController::class, "destroy"]);
});


Route::group(["prefix"=>"/auth"],function(){
    Route::post('/sign_up', [AuthController::class, "sign_up_user"])->name("sign_up_user");
    Route::post('/login', [AuthController::class, "login_user"])->name("login_user");
    // login
    // forget password
    // reset password
});
