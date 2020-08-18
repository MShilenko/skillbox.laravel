<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PostsController@index')->name('main');
Route::get('/posts/create', 'PostsController@create')->name('posts.create');
Route::get('/posts/{post}', 'PostsController@show')->name('post.show');
Route::get('/about', function() {
    return view('about');
})->name('about');
Route::get('/admin/feedbacks', 'AppealsController@index');
Route::get('/contacts', 'AppealsController@create')->name('contacts');

Route::post('/', 'PostsController@store');
Route::post('/admin/feedbacks', 'AppealsController@store')->name('admin.feedbacks');