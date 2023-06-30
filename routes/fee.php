<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fee\FeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can 0register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(FeeController::class)->prefix('fees')->name('fee.')->group(function(){
     Route::post('/', 'filterData')->name('load.data');
     Route::get('/create', 'create')->name('create');
     Route::post('/validate-request', 'validateRequest')->name('validate');
     Route::post('/store', 'store')->name('store');
     Route::post('/delete', 'delete')->name('delete');
     Route::post('/edit', 'edit')->name('edit');
     Route::post('/update', 'update')->name('update');
     Route::post('/select-type', 'selectType')->name('select.type');
});