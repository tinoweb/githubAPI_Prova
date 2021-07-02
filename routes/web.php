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
Route::post('getRepo', 'App\Http\Controllers\GitserviceController@index');
Route::post('createTag', 'App\Http\Controllers\GitserviceController@createTag');
Route::get('getTags', 'App\Http\Controllers\GitserviceController@getTags');
Route::post('setTag', 'App\Http\Controllers\GitserviceController@setTag');
Route::get('getAllAtribTags', 'App\Http\Controllers\GitserviceController@getAttrTags');