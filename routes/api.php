<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;

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

Route::get('/siswa',[SiswaController::class,'index']);
Route::post('/siswa/create',[SiswaController::class,'store']);
Route::get('/siswa/show/{id}',[SiswaController::class,'show']);
Route::post('/siswa/update/{id}',[SiswaController::class,'update']);
Route::get('/siswa/delete/{id}',[SiswaController::class,'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
