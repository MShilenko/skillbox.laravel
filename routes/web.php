<?php

use Illuminate\Support\Facades\Route;

Route::get('/posts/tags/{tag}', 'TagsController@index')->name('tags.index');

Route::resource('/posts', 'PostsController')->except(['index', 'store']);

Route::get('/', 'PostsController@index')->name('main');
Route::post('/', 'PostsController@store');

Route::get('/admin/feedbacks', 'AppealsController@index');
Route::get('/contacts', 'AppealsController@create')->name('contacts');
Route::post('/admin/feedbacks', 'AppealsController@store')->name('admin.feedbacks');

Route::view('/about', 'about')->name('about');

Auth::routes();
