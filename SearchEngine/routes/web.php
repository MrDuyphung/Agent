<?php

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

Route::middleware(['accountMiddleware'])->get('/', function (){
    return view('welcome');
});

Route::middleware(['accountMiddleware'])->get('/', [\App\Http\Controllers\PersonController::class, 'index2'])->name('layout.sidebar');

    Route::get('/search', [\App\Http\Controllers\PersonController::class, 'index'])->name('person.search');
//Route::post('/save-search', [\App\Http\Controllers\NewSearchController::class, 'store'])->name('search.save');
Route::get('/search/{id}', [\App\Http\Controllers\NewSearchController::class, 'searchById'])->name('search.byId');



Route::get('/login-account', [\App\Http\Controllers\AccountController::class, 'login'])-> name('account.login');
Route::post('/login-account', [\App\Http\Controllers\AccountController::class, 'loginProcess'])-> name('account.loginProcess');
Route::get('/logout-account', [\App\Http\Controllers\AccountController::class, 'logout'])-> name('account.logout');
