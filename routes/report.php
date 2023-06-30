<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Report\ReportController;
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

Route::controller(ReportController::class)->prefix('report')->name('report.')->group(function(){
    Route::get('/get-excel', 'form2')->name('get.excel');
});