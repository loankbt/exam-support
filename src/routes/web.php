<?php

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

Route::get('/', 'AuthenticateController@index')->name('index');
Route::post('/login', 'AuthenticateController@login')->name('login');

Route::get('/admin', 'AuthenticateController@indexAdmin')->name('admin');
Route::post('/admin/auth', 'AuthenticateController@authenticate')->name('authenticate');
Route::post('/admin/logout', 'AuthenticateController@logoutAdmin')->name('logoutAdmin');

Route::middleware('auth')->group(function () {
    Route::get('/homepage', 'HomeController@index')->name('homepage');
    Route::get('/test/{slug}', 'TestController@index')->name('test');
    Route::post('/create', 'TestController@store')->name('create');
    Route::post('/logout', 'AuthenticateController@logout')->name('logout');

    Route::get('/demo', 'DemoController@encryptRSA');
});

Route::group(['namespace' => 'Admin', 'middleware' => ['auth']], function () {
    
    Route::middleware('adminOnly')->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::post('/switchMode', 'ShiftController@switchMode')->name('switchMode');
        Route::post('/decrypt', 'ShiftController@decrypt')->name('decrypt');
        Route::post('/shift/search','ShiftController@search')->name('shift.search');
        Route::post('/subject/search','SubjectController@search')->name('subject.search');
        Route::post('/student/search','StudentController@search')->name('student.search');
        Route::post('/teacher/search','TeacherController@search')->name('teacher.search');
        Route::get('/summary', 'HomeController@summarize')->name('summary');
        Route::post('/deleteShift', 'ShiftController@destroy')->name('deleteShift');
        Route::post('/deleteSubject', 'SubjectController@destroy')->name('deleteSubject');
        Route::post('/deleteStudent', 'StudentController@destroy')->name('deleteStudent');
        Route::post('/deleteTeacher', 'TeacherController@destroy')->name('deleteTeacher');

        Route::resource('shifts', 'ShiftController');
        Route::resource('subjects', 'SubjectController');
        Route::resource('questions', 'QuestionController');
        Route::resource('options', 'OptionController');
        Route::resource('students', 'StudentController');
        Route::resource('teachers', 'TeacherController');
        Route::resource('tests', 'TestController');
    });

    Route::middleware(['teacherOnly'])->group(function () {
        Route::get('/assignment', 'HomeController@index_teacher')->name('assignment');
        Route::get('/my-assignment', 'AssignmentController@index')->name('my-assignment');
        Route::get('/mark/test/{id}', 'AssignmentController@show')->name('test.details')->middleware('isAssigned');
        Route::post('/mark', 'AssignmentController@mark')->name('mark');
    });
});