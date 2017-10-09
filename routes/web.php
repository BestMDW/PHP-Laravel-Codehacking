<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::resource('/', 'PostsController');

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/post/{id}', ['as' => 'home.post', 'uses' => 'AdminPostsController@post']);

// Route group for the administration panel.
Route::group(['as' => 'admin.', 'middleware' => 'admin'], function() {
    Route::get('/admin', function() {
        return view('admin.index');
    });

    // Resource controller for the users section in the administrator panel.
    Route::resource('/admin/users', 'AdminUsersController');
    // Resource controller for the posts section in the administrator panel.
    Route::resource('/admin/posts', 'AdminPostsController');
    // Resource controller for the categories section in the administration panel.
    Route::resource('/admin/categories', 'AdminCategoriesController');
    // Resource controller for the media section in the administration panel.
    Route::resource('/admin/media', 'AdminMediasController');
    Route::delete('/admin/delete/media', 'AdminMediasController@deleteMedia');
    // Resource controller for the comments.
    Route::resource('/admin/comments', 'PostCommentsController');
    // Resource controller for the comments replies.
    Route::resource('/admin/comments/replies', 'CommentsRepliesController');
});

// Route group for the logged in users.
Route::group(['middleware' => 'auth'], function() {
    Route::post('/comments/reply', 'CommentsRepliesController@createReply');
});