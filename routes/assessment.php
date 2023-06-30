<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Assessment\AssessmentController;
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

Route::controller(AssessmentController::class)->prefix('assessment')->name('assessment.')->group(function(){
    Route::get('/', 'index');
    Route::get('/show-search', 'showSearch')->name('show.search');
    Route::get('/get-assessment-status', 'get_status')->name('get.status');
    Route::post('/search', 'search')->name('search');
    Route::post('/assess', 'assess')->name('assess');
    Route::post('/store', 'store')->name('store');
    Route::post('/reassess', 'reassess')->name('reassess');
    Route::get('/stream/{stud_id}', 'streamAssessment')->name('streamAssessment');
    Route::post('/run-assessmenmt', 'automatedAssessment')->name('assessment.run');
    Route::post('/generate', 'generate')->name('generate.run');
});