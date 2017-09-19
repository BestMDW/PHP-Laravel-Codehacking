<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/post/{id}', ['as' => 'home.post', 'uses' => 'AdminPostsController@post']);

// Route group for the administration panel.
Route::group(['middleware' => 'admin'], function() {
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
    // Resource controller for the comments.
    Route::resource('/admin/comments', 'PostCommentsController');
    // Resource controller for the comments replies.
    Route::resource('/admin/comments/replies', 'CommentsRepliesController');
});

// Route group for the logged in users.
Route::group(['middleware' => 'auth'], function() {
    Route::post('/comments/reply', 'CommentsRepliesController@createReply');
});