<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'MainController@index');

Route::get('/toptrack', 'TrackController@toptrack');

Route::post('/find', 'TrackController@create');

Route::delete('/ParseNewTrackDelete/{id}', 'TrackController@destroy');

Route::get('/addnewtrack/', 'TrackController@ParseNewTrack');

Route::post('/addnewtrack/', 'TrackController@AddNewTrack');

Route::get('/home', 'HomeController@index');

Route::get('tracks/{id}/ChooseUploadFile/', 'TrackController@ChooseUploadFile');

Route::post('tracks/{id}/ChooseUploadFile/UploadFile/', 'TrackController@UploadFile');

Route::get('tracks/{id}/download', 'TrackController@download');

Route::auth();

Route::get('/home', 'HomeController@index');
