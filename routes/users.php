<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

Route::controller(UserController::class)->prefix('accounts')->name('account.')->group(function(){
    Route::post('/load-data', 'loadData')->name('load');
    Route::get('/employee-table', 'employees')->name('employees');
    Route::get('/create', 'create')->name('create');
    Route::post('/search', 'search')->name('search');
    Route::post('/store', 'store')->name('store');
    Route::post('/store', 'store')->name('store');
    Route::post('/set-status', 'setStatus')->name('set.status');
    Route::post('/delete', 'delete')->name('delete');
    Route::post('/update-status', 'updateStatus')->name('update.status');
});