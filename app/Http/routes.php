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


Route::get('/', 'PageController@index');

Route::get('/about', 'PageController@about');

Route::get('/top', 'PageController@top');

Route::get('/analytics', 'PageController@analytics');

Route::get('/users', 'PageController@GetUsers');

Route::get('/toptrack', 'TrackController@toptrack');

Route::post('/find', 'TrackController@create');

Route::delete('/ParseNewTrackDelete/{id}', 'TrackController@destroy');

Route::get('/addnewtrack/', 'TrackController@ParseNewTrack');

Route::post('/addnewtrack/', 'TrackController@AddNewTrack');

Route::get('/customtracks/create', 'TrackController@CreateCustomTrack');

Route::get('/customtracks', 'PageController@AllCustomTracks');

Route::post('/customtracks', 'TrackController@CustomTracksStore');

Route::get('/home', 'HomeController@index');

Route::get('/earnpoints', 'TrackController@earnpoints');

Route::get('/newtracks', 'TrackController@newtracks');

//Soundcloud tracks
Route::get('/soundcloudtracks', 'SoundcloudController@AllTracks');
Route::get('/soundcloudtracks/addnewtrack/', 'SoundcloudController@InputSoundcloudParserLink');
Route::get('/soundcloudtracks/{id}', 'SoundcloudController@TrackPage');
Route::get('/soundcloudtracks/{id}/edit', 'SoundcloudController@EditTrack');
Route::put('/soundcloudtracks/{id}', 'SoundcloudController@update');
Route::post('/soundcloudtracks', 'SoundcloudController@SoundcloudTrackCreate');
//Route::get('soundcloudtracks/{id}/ChooseUploadFile/', 'SoundcloudController@ChooseUploadFile');
Route::get('soundcloudtracks/{id}/download', 'SoundcloudController@download');
Route::post('soundcloudtracks/{id}/UploadFile/', 'SoundcloudController@Upload');
Route::get('soundcloudtracks/{id}/accept', 'SoundcloudController@acceptTrack');
Route::get('soundcloudtracks/{id}/delete', 'SoundcloudController@deleteFile');
Route::get('/checksoundcloudtracks', 'SoundcloudController@CheckTracks');
//

Route::get('tracks/{id}/updateimage', 'TrackController@UpdateImage');

Route::get('/wrongtracks', 'TrackController@wrongtracks');

Route::get('/checktracks', 'TrackController@checktracks');

Route::get('tracks/{id}', 'TrackController@index');

Route::get('genres/{genre_alias}', 'PageController@genre');

Route::get('genre/indie-dance-nu-disco', 'PageController@IndieDanceNuDisco');

Route::get('genre/electronica-downtempo', 'PageController@ElectronicaDowntempo');

Route::get('genre/hardcore-hard-techno', 'PageController@HardcoreHardTechno');

Route::get('genre/drum-bass', 'PageController@DrumBass');

Route::get('labels/{label}', 'PageController@label');

Route::get('label/spinnin', 'PageController@Spinnin');

Route::get('label/who-is-afraid-of-138', 'PageController@AfraidOf138');

Route::get('tracks/{id}/info', 'TrackController@info');

//Route::get('tracks/{id}/changes', 'TrackController@changes');

Route::get('tracks/{id}/wrong', 'TrackController@wrong');

Route::get('tracks/{id}/delete', 'TrackController@deleteFile');

Route::get('tracks/{id}/accept', 'TrackController@acceptTrack');

Route::get('tracks/{id}/reaccept', 'TrackController@acceptTrack');

//Route::get('tracks/{id}/ChooseUploadFile/', 'TrackController@ChooseUploadFile');

Route::post('tracks/{id}/ChooseUploadFile/UploadFile/', 'TrackController@UploadFile');

Route::get('tracks/{id}/download', 'TrackController@download');

Route::auth();

//Route::get('auth/logout', 'Auth\AuthController@logout');

Route::get('/home', 'HomeController@index');

//Donation
Route::get('/donate', 'PageController@donate');

//ARparts
Route::get('/arparts', 'PageController@arparts');
Route::get('/arparts/autodoc', 'PageController@arpartsAutodoc');
Route::post('/arparts/autodoc', 'PageController@arpartsAutodocParser');
Route::get('/arparts/drom', 'PageController@arpartsDrom');
Route::post('/arparts/drom', 'PageController@arpartsDromParser');
