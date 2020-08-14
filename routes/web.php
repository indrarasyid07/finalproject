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

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
