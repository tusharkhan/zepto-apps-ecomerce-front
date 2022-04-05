<?php

use App\Http\Controllers\Auth\User\LoginController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('single/{slug}', [HomeController::class, 'single'])->name('single.product');
Route::post('searchProductByName', [HomeController::class, 'searchProductByName'])->name('search.product');


Route::prefix('user')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('user.login.get');
    Route::post('/login', [LoginController::class, 'login'])->name('user.login.post');
});

