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
Route::get('/user/logout', 'Auth\LoginController@userlogout')->name('user.logout');
Route::prefix('receptions')->group(function(){

    Route::resource('/patients', 'Patients\PatientsController');
});
Route::prefix('admin')->group(function(){

    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});
Route::prefix('nurse')->group(function(){

    Route::get('/', 'NursesController@index')->name('nurse.dashboard');
    Route::get('/login', 'Auth\NursesLoginController@showLoginForm')->name('nurse.login');
    Route::post('/login', 'Auth\NursesLoginController@login')->name('nurse.login.submit');
    Route::get('/logout', 'Auth\NursesLoginController@logout')->name('nurse.logout');
});
Route::prefix('laboratory')->group(function(){

    Route::get('/', 'LaboratoriesController@index')->name('laboratory.dashboard');
    Route::get('/login', 'Auth\LaboratoriesLoginController@showLoginForm')->name('laboratory.login');
    Route::post('/login', 'Auth\LaboratoriesLoginController@login')->name('laboratory.login.submit');
    Route::get('/logout', 'Auth\LaboratoriesLoginController@logout')->name('laboratory.logout');
});

Route::resource('admin/medications','Doctors\MedicationsController');
Route::resource('admin/reports','Doctors\ReportsController');
Route::resource('admin/records','Doctors\RecordsController');

Route::resource('nurse/weights','Nurses\WeightsController');
Route::resource('nurse/weists','Nurses\WeistsController');
Route::resource('nurse/foods','Nurses\FoodsController');
Route::resource('nurse/glucose','Nurses\GlucosesController');
Route::resource('nurse/excercise','Nurses\ExercisesController');

Route::resource('laboratory/feets','Laboratories\FeetsController');
