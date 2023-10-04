<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

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

Route::namespace('Web')->group(function () {
});



Route::get('/', 'App\Http\Controllers\SiteController@index')->name('home');

Auth::routes([
   'reset'  => true,



]);






Route::prefix('/tasks')->group(function () {

   Route::prefix('/tags')->group(function () {

      Route::get('/', 'App\Http\Controllers\TagController@index')->name('tags.index');

      Route::get('/add', 'App\Http\Controllers\TagController@add')->name('tags.add');

      Route::post('/store', 'App\Http\Controllers\TagController@store')->name('tags.store');

      Route::get('/{tag}/edit', 'App\Http\Controllers\TagController@edit')->name('tags.edit');

      Route::put('/{tag}', 'App\Http\Controllers\TagController@update')->name('tags.update');

      Route::delete('/{tag}', 'App\Http\Controllers\TagController@delete')->name('tags.delete');
   });

   Route::get('/', function () {
      return redirect()->route('tasks.index');
   });

   Route::get('/list/{type?}', 'App\Http\Controllers\TaskController@index')->name('tasks.index');

   Route::get('/add', 'App\Http\Controllers\TaskController@add')->name('tasks.add');

   Route::post('/store', 'App\Http\Controllers\TaskController@store')->name('tasks.store');

   Route::get('/{task}', 'App\Http\Controllers\TaskController@show')->name('tasks.show');

   Route::get('/{task}/edit', 'App\Http\Controllers\TaskController@edit')->name('tasks.edit');

   Route::put('/{task}', 'App\Http\Controllers\TaskController@update')->name('tasks.update');

   Route::delete('/{task}', 'App\Http\Controllers\TaskController@delete')->name('tasks.delete');
});
