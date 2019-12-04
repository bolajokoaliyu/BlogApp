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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/{slug}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);

//Route::resource('admin/users', 'AdminUsersController');

/*Route::resource('admin/users', 'AdminUsersController')->names([
	    'create' => 'admin.users.create',
	    'edit' => 'admin.users.edit',
	    'index' => 'admin.users.index'
	]);*/
Route::group(['middleware'=>'admin'], function(){
	Route::get('/admin', function(){
	return view('admin.index');
	});

	Route::resource('admin/users', 'AdminUsersController', ['names' => [
	    'create' => 'admin.users.create',
		'edit' => 'admin.users.edit',
		'index' => 'admin.users.index'
	]]);

	Route::resource('admin/posts', 'AdminPostsController', ['names' => [
	    'create' => 'admin.posts.create',
		'edit' => 'admin.posts.edit',
		'index' => 'admin.posts.index'
	]]);

	Route::resource('admin/categories', 'AdminCategoriesController', ['names' => [	 
			'edit' => 'admin.categories.edit',
			'index' => 'admin.categories.index'
		]]);

	Route::resource('admin/media', 'AdminMediasController', ['names' => [	 
			'create' => 'admin.media.create',
			'index' => 'admin.media.index'
		]]);

	Route::resource('admin/comments', 'PostCommentsController', ['names' => [	 
			'create' => 'admin.comments.create',
			'show' => 'admin.comments.show',
			'index' => 'admin.comments.index'
		]]);

	Route::resource('admin/comment/replies', 'CommentRepliesController', ['names' => [	 
			'create' => 'admin.comment.replies.create',
			'edit' => 'admin.comment.replies.edit',
			'index' => 'admin.comment.replies.index',
			'show' => 'admin.comment.replies.show'
		]]);


});

Route::group(['middleware'=>'auth'], function(){
	Route::post('/comment/reply', 'CommentRepliesController@createReply');
});


//Route::get('/admin/media/upload', ['as' => 'admin.media.upload', 'uses' => 'AdminMediasController@store']);
