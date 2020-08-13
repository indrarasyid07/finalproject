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
    return view('adminlte.master');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//pertanyaan
Route::get('/pertanyaan/create','PertanyaanController@create');
Route::post('/pertanyaan','PertanyaanController@store');
Route::get('/pertanyaan', 'PertanyaanController@index')->name('pertanyaan.data');
Route::get('/pertanyaan/{id}', 'PertanyaanController@detail')->name('pertanyaan.detail');
