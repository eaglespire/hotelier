<?php

use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('usr')->name('usr.')->group(function (){
    Route::controller(DashboardController::class)->group(function (){
        Route::get('home','index')->name('index');
        Route::get('/users/{user:slug}','editUser')->name('edit-user');
        Route::get('users','users')->name('users');
    });
});
