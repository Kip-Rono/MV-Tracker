<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MV\RegisterMVController;

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
    return view('auth/login');
});

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//login blade
Route::get('/login_user', [App\Http\Controllers\UserLoginController::class, 'loginUser'])->name('login');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\UserLoginController::class, 'register'])->name('register');
//register mv view
Route::get('/register_mv', [RegisterMVController::class, 'index'])->name('register_mv');
Route::get('/update_mv', [RegisterMVController::class, 'fetchMVDetails'])->name('update_mv');
//list all mvs view
Route::get('/list_mvs', [RegisterMVController::class, 'listAllMVs'])->name('list_mvs');
//save MV registration
Route::post('/save_register_mv', [RegisterMVController::class, 'saveRegisterMV'])->name('save_register_mv');
