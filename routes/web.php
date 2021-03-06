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
Route::get('/pertanyaan/create', 'PertanyaanController@create');
Route::post('/pertanyaan', 'PertanyaanController@store');
Route::get('/pertanyaan', 'PertanyaanController@index')->name('pertanyaan.data');
Route::get('/pertanyaan/{id}', 'PertanyaanController@detail')->name('pertanyaan.detail');
Route::post('/pertanyaan/search', 'PertanyaanController@search')->name('pertanyaan.search');
Route::post('/komentar/{id}/storekomentarpertanyaan', 'KomentarController@store');
Route::post('komentar/input', 'KomentarController@show');
Route::post('/pertanyaan/search', 'PertanyaanController@search')->name('pertanyaan.search');
Route::post('/pertanyaan/upvote', 'PertanyaanController@upvote')->name('pertanyaan.upvote');
Route::post('/pertanyaan/downvote', 'PertanyaanController@downvote')->name('pertanyaan.downvote');
Route::get('/pertanyaan/{id}/edit', 'PertanyaanController@edit')->name('pertanyaan.edit');
Route::put('/pertanyaan/{id}/edit', 'PertanyaanController@update')->name('pertanyaan.update');
Route::delete('/pertanyaan/{id}', 'PertanyaanController@destroy')->name('pertanyaan.delete');

//komentar pertanyaan
Route::post('/komentar/{id}/storekomentarpertanyaan', 'KomentarController@storekomentarpertanyaan')->name('komentar.pertanyaan.store');
Route::delete('/komentar/{id}/hapuskomentarpertanyaan', 'KomentarController@destroykomentarpertanyaan')->name('komentar.pertanyaan.destroy');


//jawaban
Route::get('/pertanyaan/{id}/createAnswer','PertanyaanController@createAnswer');
Route::post('/pertanyaan/{id}','PertanyaanController@storeAnswer');
Route::post('/jawaban/upvote','PertanyaanController@upvotejawaban')->name('jawaban.upvote');
Route::post('/jawaban/downvote','PertanyaanController@downvotejawaban')->name('jawaban.downvote');
Route::post('/komentar/{id}/storekomentarjawaban', 'KomentarController@storekomentarjawaban')->name('komentar.jawaban.store');
Route::delete('/komentar/{id}/hapuskomentarjawaban', 'KomentarController@destroykomentarjawaban')->name('komentar.jawaban.destroy');
Route::delete('/jawaban/{id}', 'PertanyaanController@destroyjawaban')->name('jawaban.delete');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});