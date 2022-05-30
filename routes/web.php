<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/*Class Routes */
Route::get('/addClass', 'ClassController@addClass')->name('addClass');
Route::post('/saveClass', 'ClassController@saveClass')->name('saveClass');
Route::get('/addClass', 'ClassController@addClass')->name('addClass');
Route::get('/classList', 'ClassController@classList')->name('classList');

/**Student Routes */
Route::get('/addStudent', 'StudentController@addStudent')->name('addStudent');
Route::post('/saveStudent', 'StudentController@saveStudent')->name('saveStudent');
Route::get('/students', 'StudentController@studentList')->name('students');
Route::get('/DeletStudent/{id}', 'StudentController@DeletStudent')->name('DeletStudent');

Route::get('/enrollStudents/{id}', 'ClassController@enrollStudents')->name('enrollStudents');
Route::post('/unenrollStudent', 'ClassController@unenrollStudent')->name('unenrollStudent');
