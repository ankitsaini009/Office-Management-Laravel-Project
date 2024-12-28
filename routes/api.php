<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user-create', [ApiController::class, 'create']);
Route::get('get-user', [ApiController::class, 'getuser']);
Route::get('get-user-detals/{id}', [ApiController::class, 'userdeteals']);
Route::post('user-update/{id}', [ApiController::class, 'update']);
Route::get('user-delet/{id}', [ApiController::class, 'destroy']);
