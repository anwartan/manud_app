<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();


Route::middleware(['auth','role:ADMIN,SUPER_ADMIN'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin/user', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/admin/user/create', [App\Http\Controllers\UserController::class, 'create']);
    Route::post('/admin/user/create', [App\Http\Controllers\UserController::class, 'save']);
    Route::get('/admin/user/update/{user}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::put('/admin/user/update/{user}', [App\Http\Controllers\UserController::class, 'update']);
    Route::get('/admin/user/delete/{user}', [App\Http\Controllers\UserController::class, 'destroy']);


    Route::get('/press-release', [App\Http\Controllers\PressReleaseController::class, 'index']);
    Route::get('/press-release/create', [App\Http\Controllers\PressReleaseController::class, 'create']);
    Route::post('/press-release/create', [App\Http\Controllers\PressReleaseController::class, 'save']);
    Route::get('/press-release/update/{press_release}', [App\Http\Controllers\PressReleaseController::class, 'edit']);
    Route::put('/press-release/update/{press_release}', [App\Http\Controllers\PressReleaseController::class, 'update']);
    Route::get('/press-release/delete/{press_release}', [App\Http\Controllers\PressReleaseController::class, 'destroy']);

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index']);
    Route::put('/profile/{profile}', [App\Http\Controllers\ProfileController::class, 'update']);


    Route::resource('event', EventController::class);
    Route::get('/event/delete/{event}', [App\Http\Controllers\EventController::class, 'destroy']);

    Route::resource('/lowongan',LowonganController::class);
    Route::get('/lowongan/delete/{lowongan}', [App\Http\Controllers\LowonganController::class, 'destroy']);

});

Route::get('/', [App\Http\Controllers\Site\SiteController::class, 'index']);
Route::get('/organization', [App\Http\Controllers\Site\SiteController::class, 'profileOrganization']);
Route::get('/press-detail/{press_release}', [App\Http\Controllers\Site\SiteController::class, 'pressView']);

Route::get('/401', function(){
    return view('auth.401');
})->name('401');
