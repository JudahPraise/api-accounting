<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AssessmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api.auth')->controller(AssessmentController::class)->prefix('accounting')->group(function(){
    Route::post('/student-config', 'student_config');
    Route::post('/student-assessment-template', 'student_assessment_template');
    Route::post('/assess-student', 'assess_student');
    Route::post('/reassess-student', 'reassess_student');
    Route::get('/get-reg-form/{enrolment_id}', 'generate_reg_form');
    Route::get('/view-reg-form/{enrolment_id}', 'view_reg_form');
    Route::get('/test/{enrolment_id}', 'test');
});