<?php

use App\Http\Controllers\Api\PublicationsController;
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
Route::get('/publications',[PublicationsController::class,'index']);
Route::post('/publications',[PublicationsController::class,'store']);
Route::get('/publications/{id}',[PublicationsController::class,'show']);
Route::get('/publications/{id}/edit',[PublicationsController::class,'edit']);
Route::put('/publications/{id}/edit',[PublicationsController::class,'update']);
Route::delete('/publications/{id}/',[PublicationsController::class,'destroy']);