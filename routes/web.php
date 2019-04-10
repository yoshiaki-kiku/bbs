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

// トップページ
Route::get('/', "TopicController@index")->name("home");
Route::post('/', "TopicController@store");

// トピックページ
Route::get('topics/{topic}', "TopicController@show")->name("topic.page");
Route::post('topics/{topic}', "CommentController@store");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
