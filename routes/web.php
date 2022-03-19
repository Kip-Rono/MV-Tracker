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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//register mv view
Route::get('/register_mv', [RegisterMVController::class, 'index'])->name('register_mv');
//save MV registration
Route::post('/save_register_mv', [RegisterMVController::class, 'saveRegisterMV'])->name('save_register_mv');
