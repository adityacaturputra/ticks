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
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'Dashboard\DashboardController@index');
//Users
Route::get('/dashboard/users', 'Dashboard\UserController@index')->name('dashboard.users');
Route::get('/dashboard/user/edit/{id}', 'Dashboard\UserController@edit')->name('dashboard.user.edit');
Route::put('/dashboard/user/update/{id}', 'Dashboard\UserController@update')->name('dashboard.user.update');
Route::delete('/dashboard/user/delete/{id}', 'Dashboard\UserController@destroy')->name('dashboard.user.delete');

