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

Route::get('/home', 'HomeController@index');
Route::get('/create_meeting', 'MeetingController@index');
Route::get('/create_meeting_type', 'MeetingTypeController@index');
Route::get('/create_location', 'LocationController@index');
Route::get('/create_role', 'RoleController@index');
Route::get('/create_approver', 'UserRoleController@index');


Route::post('/save_meeting_type_name', 'MeetingTypeController@store');
Route::post('/save_location_name', 'LocationController@store');
Route::post('/save_role', 'RoleController@store');
Route::post('/save_approver', 'UserRoleController@store');
Route::post('/save_meeting', 'MeetingController@store');


Route::get('/edit_meeting/{id}', 'MeetingController@edit');
Route::post('/update_meeting/{id}', 'MeetingController@update');
Route::get('/delete_meeting/{id}', 'MeetingController@destroy');

