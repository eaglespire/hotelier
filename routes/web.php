<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileInformationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Carbon;
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
    //$date1 = Carbon::createFromFormat('Y-m-d H:i:s', auth()->user()->created_at->addMinutes(60));
    //$date2 = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->addMinutes(3));
    //$result = $date1->gt($date2);

    return view('welcome');
});
Route::get('test-email', function (){
    return view('admin.emails.test');
});
Route::post('test-email', [MailController::class,'ComposeTestEmail'])->name('compose-email');


Route::prefix('usr')->name('usr.')->middleware(['not-a-visitor'])->group(function (){
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
        Route::get('log','log')->name('log');
    });
    Route::controller(RoomController::class)->prefix('rooms')->name('room.')->group(function (){
        Route::get('categories','RoomCategories')->name('categories');
        Route::get('categories/{id}','RoomCategory')->name('category');
        Route::put('category/update','UpdateRoomCategory')->name('category-update');
        Route::get('/','AllRooms')->name('all');
        Route::get('/create','CreateRoom')->name('create-room');
        Route::get('{room:slug}','EditRoom')->name('edit-room');
        Route::put('{id}/update-room','UpdateRoom')->name('update-room');
        Route::post('store','StoreRoom')->name('store-room');
        Route::get('tags','tags')->name('tags');
        Route::get('tags/{slug}','tag')->name('tag');
        Route::put('tag/update','UpdateTag')->name('tag-update');
        Route::get('features','features')->name('features');
        Route::get('features/{slug}','feature')->name('feature');
        Route::put('feature/update','UpdateFeature')->name('feature-update');
    });
    Route::controller(BookingController::class)->prefix('booking')->name('booking.')->group(function (){
        Route::get('/','index')->name('index');
        Route::get('create','create')->name('create');
        Route::get('process-payment/{slug}','ProcessPayment')->name('process-payment');
        Route::get('successful-payment/{reference}','SuccessfulPayment')->name('successful-payment');
        Route::get('get-bookings','GetBookings')->name('get-bookings');
        Route::get('records','BookingRecords')->name('booking-records');
        Route::get('record/{phone}','BookingRecord')->name('booking-record');
    });
    Route::get('guests', [BookingController::class,'guests'])->name('booking.guests');
    Route::controller(ProfileInformationController::class)->prefix('profile')->name('profile.')->group(function (){
        Route::get('/','index')->name('index');
    });
});


Route::view('jobs', 'front.career', ['title'=>'Career','titleDesc'=> 'Career','description'=>'Career'])->name('jobs');

Route::middleware(['a-visitor'])->group(function (){
    Route::view('career','front.build-career',['title'=>'Career','titleDesc'=> 'Career','description'=>'Career'] )->name('career');
});

Route::controller(VerificationController::class)->prefix('auth/verify')->name('auth.')->group(function (){
    Route::get('/','show')->name('verify');
    Route::post('/', 'SubmitOTP')->name('submit');
    Route::post('resend', 'ResendOTP')->name('resend');
});


Auth::routes();

