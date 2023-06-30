<?php

use Illuminate\Support\Facades\Route;

Route::controller(App\Http\Controllers\ViewController::class)->group(function(){
    Route::post('/set-page', 'setPage');
    Route::get('/dashboard', 'redirectDefaultPage');
    Route::get('/fees', 'redirectDefaultPage');
    Route::get('/assessment', 'redirectDefaultPage');
    Route::get('/report', 'redirectDefaultPage');
    Route::get('/student', 'redirectDefaultPage');
    Route::get('/generate', 'redirectDefaultPage');
    Route::get('/automated-assessment', 'redirectDefaultPage');
});