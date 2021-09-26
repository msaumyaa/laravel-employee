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
    // return view('welcome');
    return redirect(route('login'));
});

Auth::routes(['register' => false, 'verify' => true]);

Route::middleware(['auth','admin'])->group(function(){
    Route::resource('employee', 'EmployeeController');
    Route::resource('companies', 'CompaniesController');
});


Route::get('/home', 'HomeController@index')->name('home');
