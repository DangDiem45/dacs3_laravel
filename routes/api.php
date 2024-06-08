<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\LectureController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\CourseTypeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::group(['namespace'=>'Api'], function(){
// 	Route::post('/login', 'UserController@login');
// 	// Route::post('/login', [UserController::class, 'login']);

// 	Route::group(['middleware'=>['auth:sanctum']], function(){
// 		// Route::any('/courseList', 'CourseController@courseList');
// 		Route::any('/courseList', [CourseController::class, 'courseList']);
// 	});
// });
Route::post('/login', [UserController::class, 'login']);
Route::any('/courseList', [CourseController::class, 'courseList']); 
Route::any('/courseDetail', [CourseController::class, 'courseDetail']);
Route::any('/courseSearchDefault', [CourseController::class, 'courseSearchDefault']);
Route::any('/courseFeature', [CourseController::class, 'courseFeature']);
Route::any('/courseSearch', [CourseController::class, 'courseSearch']);
Route::any('/lessonList', [LessonController::class, 'lessonList']);
Route::any('/lessonDetail', [LessonController::class, 'lessonDetail']);
Route::any('/courseTypeList', [CourseTypeController::class, 'courseTypeList']);
Route::any('/courseTypeFeature', [CourseTypeController::class, 'courseTypeFeature']);
Route::apiResource('/subjects', SubjectController::class)->only(['index', 'show']);
Route::get('/get_lecture_by_subject_id/{subjectId}', [LectureController::class,'index']);
Route::get('/get_question_by_lecture_id/{lectureId}', [QuestionController::class,'getAllQuestionByLectureId']);
Route::get('/lectures/{lectureId}/questions/count', [QuestionController::class, 'getQuestionCountByLecture']);
Route::post('/answer/{lectureId}', [AnswerController::class, 'answer']);