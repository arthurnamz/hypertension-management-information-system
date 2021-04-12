<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//routes for Contact

Route::get('contact', 'API\ContactController@index');
Route::get('contact/{id}', 'API\ContactController@show');
Route::post('contact', 'API\ContactController@store');
Route::put('contact/{id}', 'API\ContactController@update');
Route::delete('contact/{id}', 'API\ContactController@destroy');

//routes for Music

Route::get('music', 'API\MusicController@index');
Route::get('music/{id}', 'API\MusicController@show');
Route::post('music', 'API\MusicController@store');
Route::put('music/{id}', 'API\MusicController@update');
Route::put('music/{id}', 'API\MusicController@download');
Route::put('music/{id}', 'API\MusicController@stream');
Route::delete('music/{id}', 'API\MusicController@destroy');

//routes for Namartist

Route::get('namartist', 'API\NamartistController@index');
Route::get('namartist/{id}', 'API\NamartistController@show');
Route::post('namartist', 'API\NamartistController@store');
Route::put('namartist/{id}', 'API\NamartistController@update');
Route::delete('namartist/{id}', 'API\NamartistController@destroy');

//routes for Testmonies

Route::get('testmonies', 'API\TestmoniesController@index');
Route::get('testmonies/{id}', 'API\TestmoniesController@show');
Route::post('testmonies', 'API\TestmoniesController@store');
Route::put('testmonies/{id}', 'API\TestmoniesController@update');
Route::delete('testmonies/{id}', 'API\TestmoniesController@destroy');

//routes for Projects

Route::get('project', 'API\ProjectController@index');
Route::get('project/{id}', 'API\ProjectController@show');
Route::post('project', 'API\ProjectController@store');
Route::put('project/{id}', 'API\ProjectController@update');
Route::delete('project/{id}', 'API\ProjectController@destroy');


//routes for Albums

Route::get('album', 'API\AlbumController@index');
Route::get('album/{id}', 'API\AlbumController@show');
Route::post('album', 'API\AlbumController@store');
Route::put('album/{id}', 'API\AlbumController@update');
Route::delete('album/{id}', 'API\AlbumController@destroy');

//routes for Gallery Albums

Route::get('gallery_album', 'API\GalleryAlbumController@index');
Route::get('gallery_album/{id}', 'API\GalleryAlbumController@show');
Route::post('gallery_album', 'API\GalleryAlbumController@store');
Route::put('gallery_album/{id}', 'API\GalleryAlbumController@update');
Route::delete('gallery_album/{id}', 'API\GalleryAlbumController@destroy');

//routes for Gallery

Route::get('gallery', 'API\GalleryController@index');
Route::get('gallery/{id}', 'API\GalleryController@show');
Route::post('gallery', 'API\GalleryController@store');
Route::put('gallery/{id}', 'API\GalleryController@update');
Route::delete('gallery/{id}', 'API\GalleryController@destroy');

//routes for News

Route::get('news', 'API\NewsController@index');
Route::get('news/{id}', 'API\NewsController@show');
Route::post('news', 'API\NewsController@store');
Route::put('news/{id}', 'API\NewsController@update');
Route::delete('news/{id}', 'API\NewsController@destroy');

//routes for News Media

Route::get('news_media', 'API\NewsMediaController@index');
Route::get('news_media/{id}', 'API\NewsMediaController@show');
Route::post('news_media', 'API\NewsMediaController@store');
Route::put('news_media/{id}', 'API\NewsMediaController@update');
Route::delete('news_media/{id}', 'API\NewsMediaController@destroy');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
