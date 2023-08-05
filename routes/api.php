<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::POST('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::GET('/news', [NewsController::class, 'index'])->middleware('role:super-admin');
    Route::POST('/news', [NewsController::class, 'create'])->middleware('role:super-admin');
    Route::post('/news_update', [NewsController::class, 'update'])->middleware('role:super-admin');
    Route::delete('/news', [NewsController::class, 'delete'])->middleware('role:super-admin');
    Route::get('/news_byid', [NewsController::class, 'getid'])->middleware('role:super-admin|user');
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
