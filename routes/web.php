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
    return view('hotels');
});

Auth::routes();

Route::get('/home', 'PageController@index')->name('home');

Route::get('/', 'PageController@index');
Route::get('hotels', 'PageController@hotels')->name('hotels');
Route::get('hotel/{id?}', 'PageController@hotel')->name('hotel');
Route::post('savereservation', 'PageController@savereservation')->name('savereservation');
Route::get('reservations', 'PageController@reservations')->name('reservations');
Route::get('confirmreservation/{id_reservation?}', 'PageController@confirmreservation')->name('confirmreservation');
Route::get('rejectedreservation/{id_reservation?}', 'PageController@rejectedreservation')->name('rejectedreservation');

Route::get('template', function () {
    return view('template');
});

