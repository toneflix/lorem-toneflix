<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/images', [ImageController::class, 'index']);
Route::get('/images/{category}', [ImageController::class, 'category']);
Route::get('/images/image/{image}', [ImageController::class, 'show']);