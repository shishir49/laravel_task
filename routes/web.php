<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BlogController;
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

Route::get('/', [WebsiteController::class, 'landingPage']);
Route::get('/blog/{id}', [WebsiteController::class, 'blog']);

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('verifyUser', [AuthController::class, 'verifyUser'])->name('verifyUser');
Route::get('registration', [AuthController::class, 'registration'])->name('registration');
Route::post('register', [AuthController::class, 'register']);
Route::get('logout', [AuthController::class, 'logout']);

// User Routes
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user/dashboard/blog/list', [BlogController::class, 'index']);
    Route::get('/user/dashboard/blog/create', [BlogController::class, 'create']);
    Route::post('/create-blog', [BlogController::class, 'createBlog']);
    Route::get('/user/dashboard/blog/edit/{id}', [BlogController::class, 'edit']);
    Route::post('/blog/update', [BlogController::class, 'update']);
    Route::get('blog/delete/{id}', [BlogController::class, 'delete']);
    Route::get('/user/dashboard/blog/view/{id}', [BlogController::class, 'view']);
});

// Admin Routes

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/blog/list', [BlogController::class, 'index']);
    Route::get('/admin/dashboard/blog/edit/{id}', [BlogController::class, 'edit']);
    Route::post('/blog/update', [BlogController::class, 'update']);
    Route::get('blog/delete/{id}', [BlogController::class, 'delete']);
});  



// Route::get('/dashboard', [DashboardController::class, 'index']);





