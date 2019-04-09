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
Route::get('topics/{id}', "TopicController@show")->name("topic.page");
Route::post('/', "TopicController@store")->name("topic.store");

// コメントページ
Route::post('/comments', "CommentController@store")->name("comments.store");
Route::get('comments/{id}', "CommentController@show")->name("comments.page");
