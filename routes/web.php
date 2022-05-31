<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name('posts.index'); //On souhaite un PostController et ce sera la méthode index du PostController et on lui donne le nom posts.index
//Après la création de cette route on va réaliser un return dand le PostController et également en même temps réaliser une vue posts.blade.php
Route::middleware(['auth'])->group(function () { // Il nécéssite l'authentification et ensuite on groupe les routes à l'intérieur

    Route::resource('posts', PostController::class)
    ->except('index');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__ . '/auth.php';
