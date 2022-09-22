<?php

use App\Http\Controllers\Api\HelloController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\PostController;


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


//All routes for the API

//Posts routes
Route::get('/posts',                     [PostController::class, 'index']);                                 //On souhaite un PostController et ce sera la méthode index du PostController et on lui donne le nom posts.index
Route::get('/posts/show/{post}',         [PostController::class, 'show']);   
// Route::post('/posts/create/{post}',      [PostController::class, 'create'])->middleware('auth:sanctum');                           
// Route::post('/posts/update/{post}',      [PostController::class, 'update'])->middleware('auth:sanctum');                              
// Route::post('/posts/destroy/{post}',     [PostController::class, 'destroy'])->middleware('auth:sanctum');                       

// Route::post('/login', [AuthController::class, 'login']);

//Auth routes
// Route::post('/register', [AuthController::class, 'register'])->name('register');
// Route::post('/login', [AuthController::class, 'login'])->name('login');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
// Route::post('/me', [AuthController::class, 'me'])->name('me');



