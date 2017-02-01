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

Route::get('/about', 'MainController@about');

Route::get('/top', 'MainController@top');

Route::get('/toptrack', 'TrackController@toptrack');

Route::post('/find', 'TrackController@create');

Route::delete('/ParseNewTrackDelete/{id}', 'TrackController@destroy');

Route::get('/addnewtrack/', 'TrackController@ParseNewTrack');

Route::post('/addnewtrack/', 'TrackController@AddNewTrack');

Route::get('/home', 'HomeController@index');

Route::get('/earnpoints', 'TrackController@earnpoints');

Route::get('/newtracks', 'TrackController@newtracks');

Route::get('/wrongtracks', 'TrackController@wrongtracks');

Route::get('/checktracks', 'TrackController@checktracks');

Route::get('tracks/{id}', 'TrackController@index');

Route::get('tracks/{id}/wrong', 'TrackController@wrong');

Route::get('tracks/{id}/delete', 'TrackController@deleteFile');

Route::get('tracks/{id}/accept', 'TrackController@acceptTrack');

Route::get('tracks/{id}/reaccept', 'TrackController@acceptTrack');

Route::get('tracks/{id}/ChooseUploadFile/', 'TrackController@ChooseUploadFile');

Route::post('tracks/{id}/ChooseUploadFile/UploadFile/', 'TrackController@UploadFile');

Route::get('tracks/{id}/download', 'TrackController@download');

Route::auth();

//Route::get('auth/logout', 'Auth\AuthController@logout');

Route::get('/home', 'HomeController@index');
