<?php

use Illuminate\Support\Facades\Route;

Route::get('/posts/tags/{tag}', 'TagsController@index')->name('tags.index');

Route::resource('/posts', 'PostsController')->except(['index', 'store']);

Route::name('admin.')->middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::view('/', 'admin.index');

    Route::resource('posts', 'PostsController');

    Route::post('feedbacks', 'AppealsController@store')->name('feedbacks');
});


Route::get('/', 'PostsController@index')->name('main');
Route::post('/', 'PostsController@store');

Route::get('/admin/feedbacks', 'AppealsController@index')->middleware('auth', 'admin');
Route::get('/contacts', 'AppealsController@create')->name('contacts');

Route::view('/about', 'about')->name('about');

Auth::routes();
