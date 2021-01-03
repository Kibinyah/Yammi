<?php

use Illuminate\Support\Facades\Route;

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

#middleware('can:manage-users')
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::resource('/users','UsersController',['except' =>['create','store']]);
});
#Users
Route::get('users','UserController@index')->name('users.index');
Route::get('users/{user}','UserController@show')-> name('users.show');
Route::get('users/{user}/edit','UserController@edit')->name('users.edit');
Route::post('users/{user}','UserController@update')->name('users.update');
#Profiles
#Route::get('/profile','ProfileController@index')->name('profiles.index');

#Route::post('/profile/update/','ProfileController@update')->name('profiles.update');

#Posts
Route::get('posts', 'PostController@index')->name('posts.index');
Route::get('posts/create','PostController@create')->name('posts.create');

Route::post('posts','PostController@store')->name('posts.store');
Route::get('posts/{post}','PostController@show')-> name('posts.show');
Route::get('posts/{post}/edit','PostController@edit')->name('posts.edit');
Route::post('posts/{post}','PostController@update')->name('posts.update');
Route::delete('posts/{post}','PostController@destroy')->name('posts.destroy');

#Tags
Route::get('tags', 'TagController@index')->name('tags.index');
Route::post('tags','TagController@store')->name('tags.store');
Route::get('tags/{tag}','TagController@show')-> name('tags.show');
Route::get('tags/{tag}/edit','TagController@edit')->name('tags.edit');
Route::post('tags/{tag}','TagController@update')->name('tags.update');
Route::delete('tags/{tag}','TagController@destroy')->name('tags.destroy');
#Comments
Route::post('comment/{post}','CommentController@store')->name('comments.store');
Route::get('comment/{comment}/edit','CommentController@edit')->name('comments.edit');
Route::post('posts/comment/{comment}','CommentController@update')->name('comments.update');
Route::delete('comment/{comment}/','CommentController@destroy')->name('comments.destroy');

#Home
Route::get('/home', 'PostController@index')->name('home');


Route::post('posts/stat/{post}','PostController@addLike')->name('posts.like');
Route::post('comment/stat/{comment}','CommentController@addLike')->name('comments.like');

Route::post('save-comment','PostController@saveComment')->name('comments.add');
Route::get('/posts/{post}/comments', 'CommentController@index');