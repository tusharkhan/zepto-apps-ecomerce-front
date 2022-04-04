<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Admin\LoginController;

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

Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('product/create', [AdminController::class, 'createProductView'])->name('admin.product.create.get');
    Route::post('product/create', [AdminController::class, 'createProduct'])->name('admin.product.create.post');

    Route::get('product/edit/{id}', [AdminController::class, 'editProductView'])->name('admin.product.edit.get');
    Route::post('/product/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.product.edit.post');
    Route::get('/product/{id}/delete', [AdminController::class, 'deleteProduct'])->name('admin.product.delete');
});
