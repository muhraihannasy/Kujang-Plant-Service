<?php

use App\Http\Controllers\admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\admin\JobController as AdminJobController;
use App\Http\Controllers\admin\JobTypeController as AdminJobTypeController;
use App\Http\Controllers\admin\UserController as AdminUserController;
use App\Http\Controllers\ApplyJobController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', function () {
    return view('welcome');
});

// Auth
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'create');
    Route::post('/login', 'store');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'create');
    Route::post('/register', 'store');
});

// Pages
Route::get('/jobs', [JobController::class, '__invoke'])->name('jobs');

// Admin
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, '__invoke'])->name('admin.dashboard');
        Route::resource('users', AdminUserController::class);
        Route::resource('companies', AdminCompanyController::class);
        Route::resource('jobs_type', AdminJobTypeController::class);
        Route::resource('jobs', AdminJobController::class);
    });
});

// User
Route::middleware('auth')->group(function () {
    Route::resource('user_apply', ApplyJobController::class);
});