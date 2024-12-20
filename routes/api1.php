<?php

use Illuminate\Http\Request;
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

Route::post('/register', [App\Http\Controllers\API\RegisterController::class, 'register'])->name('register');
Route::post('/login', [App\Http\Controllers\API\RegisterController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/profiles', [App\Http\Controllers\API\RegisterController::class, 'profileUser'])->name('profileUser');
    Route::post('/profile/verify', [App\Http\Controllers\API\RegisterController::class, 'userVerify'])->name('userVerify');
    Route::post('/profile/update', [App\Http\Controllers\API\RegisterController::class, 'profileUpdate'])->name('profileUpdate');
    Route::post('/user/filter/{action}', [App\Http\Controllers\API\RegisterController::class, 'userFilter'])->name('userFilter');
    Route::get('/category/list', [App\Http\Controllers\API\Category::class, 'categoryList'])->name('categoryList');
    Route::get('/logout', [App\Http\Controllers\API\RegisterController::class, 'logout'])->name('logout');    
});
