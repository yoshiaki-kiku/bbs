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
Route::post('/', "TopicController@store")->middleware('auth');

// 管理者権限、トピック操作
Route::group(['middleware' => ['auth', 'can:admin']], function () {
    // トピックの削除
    Route::get('topics/delete_confirm/{topic}', "TopicController@deleteConfirm")->name("topic.delete.confirm");
    Route::post('topics/delete', "TopicController@delete")->name("topic.delete");

    // トピックの更新
    Route::get('topics/update_form/{topic}', "TopicController@updateForm")->name("topic.update.form");
    Route::post('topics/update_confirm', "TopicController@updateConfirm")->name("topic.update.confirm");
    Route::post('topics/update', "TopicController@update")->name("topic.update");
});

// トピックページ
Route::get('topics/{topic}', "TopicController@show")->name("topic.page");
Route::post('topics/{topic}', "CommentController@store")->middleware('auth');

// 管理者権限、コメント操作
Route::group(['middleware' => ['auth', 'can:admin']], function () {
    // コメントの削除
    Route::get('comments/delete_confirm/{comment}', "CommentController@deleteConfirm")->name("comment.delete.confirm");
    Route::post('comments/delete', "CommentController@delete")->name("comment.delete");

    // コメントの更新
    Route::get('comments/update_form/{comment}', "CommentController@updateForm")->name("comment.update.form");
    Route::post('comments/update_confirm', "CommentController@updateConfirm")->name("comment.update.confirm");
    Route::post('comments/update', "CommentController@update")->name("comment.update");
});

// 検索
Route::get('search', "SearchController@show")->name("search.result");

// 投票
Route::post("comments/vote", "CommentController@vote")->middleware('auth')->name("comment.vote");

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
