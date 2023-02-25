<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
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
        Route::get('users/{user:slug}','editUser')->name('edit-user');
        Route::get('users','users')->name('users');
        Route::get('roles','roles')->name('roles');
        Route::get('permissions','permissions')->name('permissions');
        Route::get('roles/{id}','editRole')->name('edit-role');
        Route::get('staff','allStaff')->name('all-staff');
        Route::get('staff/{id}','staff')->name('staff');
        Route::post('staff/update','updateStaff')->name('update-staff');
        Route::get('file-manager','OpenFileManager')->name('open-file-manager');
        Route::get('file-manager/{folder}','FileManager')->name('file-manager');
    });
    Route::controller(RoomController::class)->prefix('rooms')->name('room.')->group(function (){
        Route::get('categories','RoomCategories')->name('categories');
        Route::get('categories/{id}','RoomCategory')->name('category');
        Route::put('category/update','UpdateRoomCategory')->name('category-update');
        Route::get('/','AllRooms')->name('all');
        Route::get('tags','tags')->name('tags');
        Route::get('tags/{slug}','tag')->name('tag');
        Route::put('tag/update','UpdateTag')->name('tag-update');
        Route::get('features','features')->name('features');
        Route::get('features/{slug}','feature')->name('feature');
        Route::put('feature/update','UpdateFeature')->name('feature-update');
    });
});

