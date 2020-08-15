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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'AboutController@index')->name('about');

//pertanyaan
Route::get('/pertanyaan/create','PertanyaanController@create');
Route::post('/pertanyaan','PertanyaanController@store');
Route::get('/pertanyaan', 'PertanyaanController@index')->name('pertanyaan.data');
Route::get('/pertanyaan/{id}', 'PertanyaanController@detail')->name('pertanyaan.detail');
Route::post('/pertanyaan/search','PertanyaanController@search')->name('pertanyaan.search');
Route::post('/pertanyaan/upvote','PertanyaanController@upvote')->name('pertanyaan.upvote');
Route::post('/pertanyaan/downvote','PertanyaanController@downvote')->name('pertanyaan.downvote');
Route::get('/pertanyaan/{id}/edit', 'PertanyaanController@edit')->name('pertanyaan.edit');
Route::put('/pertanyaan/{id}/edit', 'PertanyaanController@update')->name('pertanyaan.update');
Route::delete('/pertanyaan/{id}', 'PertanyaanController@destroy')->name('pertanyaan.delete');
//jawaban
Route::get('/pertanyaan/{id}/createAnswer','PertanyaanController@createAnswer');
Route::post('/pertanyaan/{id}','PertanyaanController@storeAnswer');
Route::post('/pertanyaan/upvoteAnswer','PertanyaanController@upvoteAnswer')->name('pertanyaan.upvoteAnswer');
Route::post('/pertanyaan/downvoteAnswer','PertanyaanController@downvoteAnswer')->name('pertanyaan.downvoteAnswer');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
