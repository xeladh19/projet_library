<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

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


// Route::get('/', function () {
//     return view('index');
// })->name("index");
// Route::get('/post', function (){
//     return view('post.index');
// })->name('post');

// Route::get('/user', function (){
//     return view('users.index');
// })->name('user');


// Route::get('/{any}', function () {
//     return view('index');
// })->where('any', '.*');


// require __DIR__ . '/auth.php';



// Route::get('/commu', function () {
//     return view('commu.pages.index');
// })->name('shop');
// Route::get('/', [PostController::class, 'index'])->name('post');

//Après la création de cette route on va réaliser un return dand le PostController et également en même temps réaliser une vue posts.blade.php




// Route::resource('posts', PostController::class)
//     ->except('index');
// Route::middleware(['auth'])->group(function () {                                                        // Il nécéssite l'authentification et ensuite on groupe les routes à l'intérieur

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });
// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/post', function () {
//     return view('post.view');
// })->name('post');
// Route::get('/post/{post:slug}',[PostController::class,'view'])->name('post.view');
// Route::get('/user/{user}', [UserController::class,'view'])->name('user.view');
// // Dashboard routes
// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })
// ->middleware('auth');

