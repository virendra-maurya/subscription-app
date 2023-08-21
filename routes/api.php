<?php

use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\SubscribeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::name('api.')->group(function (){
    Route::get('{website}/post/{post}',[PostController::class, 'show'])->name('post.show');
    Route::apiResource('{website}/post', PostController::class)->only('store');
    Route::post('{website}/subscribe', SubscribeController::class);
});


