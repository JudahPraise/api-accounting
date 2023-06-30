<?php

use Illuminate\Support\Facades\Cache;
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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/config-cache', function() {
    $status = Artisan::call('config:cache');
    return '<h1>Configuration Cached</h1>';
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/students-table/idiot-board', [App\Http\Controllers\HomeController::class, 'students'])->name('students.idiot-board');

Route::get('/student-cache', function(){
    return Cache::get('students');
});

Route::get('/student-cache/forget', function(){
    return Cache::forget('students');
});