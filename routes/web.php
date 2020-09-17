<?php

use Illuminate\Support\Facades\Route;

Route::get('/tags/{tag}', 'TagsController@index')->name('tags.index');


Route::resource('/posts', 'PostsController')->except(['index', 'store']);

Route::name('admin.')->middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::view('/', 'admin.index');

    Route::resource('posts', 'AdminPostsController');
    Route::resource('news', 'AdminNewsController')->except(['show']);

    Route::get('news', 'AdminNewsController@index')->name('news');

    Route::get('/reports', 'ReportsController@index')->name('reports');
    Route::post('/reports', 'ReportsController@send');

    Route::post('feedbacks', 'AppealsController@store')->name('feedbacks');
});


Route::get('/news', 'NewsController@index')->name('news');
Route::get('/news/{news}', 'NewsController@show')->name('news.show');

Route::get('/', 'PostsController@index')->name('main');
Route::post('/', 'PostsController@store');

Route::post('/posts/{post}/add-comment', 'PostsController@addComment')->name('post.comment.store')->middleware('auth');
Route::post('/news/{news}/add-comment', 'NewsController@addComment')->name('news.comment.store')->middleware('auth');

Route::get('/admin/feedbacks', 'AppealsController@index')->middleware('auth', 'admin');
Route::get('/contacts', 'AppealsController@create')->name('contacts');

Route::view('/about', 'about')->name('about');

Route::get('/statistics', 'StatisticController@index')->name('statistics');

Auth::routes();


