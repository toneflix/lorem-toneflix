<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\File;
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
    return str(File::get(public_path('index.html')))
        ->replace(
            '</head>',
            '<meta name="csrf-token" content="' . csrf_token() . '">
            </head>'
        )
        ->toString();
});

Route::get('/images', [ImageController::class, 'index']);
Route::get('/images/{category}', [ImageController::class, 'category']);
Route::get('/images/image/{image}', [ImageController::class, 'show']);
