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
 
Auth::routes();

// Socialite
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('socialite.redirect');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('socialite.callback');

// Terms
Route::get('terms', 'TermsController@service')->name('terms.service');
Route::get('privacy', 'TermsController@privacy')->name('terms.privacy');

// Profile
Route::get('p/{user}/articles', 'ProfilesController@show')->name('profile.articles');
Route::get('p/{user}/comments', 'ProfilesController@show')->name('profile.comments');
Route::get('p/{user}/liked', 'ProfilesController@show')->name('profile.likes');
Route::get('p/{user}/liked-comments', 'ProfilesController@show')->name('profile.likes.comments');
Route::get('p/{user}/liked-articles', 'ProfilesController@show')->name('profile.likes.articles');

// Filters
Route::get('/', 'ArticlesController@index')->name('index');
Route::get('/today', 'ArticlesController@index')->name('articles.today');
Route::get('/week', 'ArticlesController@index')->name('articles.week');
Route::get('/month', 'ArticlesController@index')->name('articles.month');
Route::get('/year', 'ArticlesController@index')->name('articles.year');
Route::get('/alltime', 'ArticlesController@index')->name('articles.alltime');
Route::get('/latest', 'ArticlesController@index')->name('articles.latest');

Route::get('write', 'ArticlesController@create')->name('article.create');
Route::post('/', 'ArticlesController@store')->name('article.store');
Route::get('{topic}/{article}', 'ArticlesController@show')->name('article.show');
// Route::get('article/{article}/edit', 'ArticlesController@edit')->name('article.edit');
Route::patch('article/{article}', 'ArticlesController@update')->name('article.update');
Route::delete('article/{article}', 'ArticlesController@destroy')->name('article.destroy');

Route::get('article/{article}/comments', 'CommentsController@index')->name('comments.index');
Route::post('article/{article}/comment', 'CommentsController@store')->name('comment.store');
Route::patch('comment/{comment}', 'CommentsController@update')->name('comment.update');
Route::delete('comment/{comment}', 'CommentsController@destroy')->name('comment.destroy');

Route::post('like/{likeableType}/{likeable}', 'LikesController@store')->name('like');
Route::delete('like/{likeableType}/{likeable}', 'LikesController@destroy')->name('unlike');

// Route::get('/', 'TopicsController@index')->name('index');
// Route::get('topic/create', 'TopicsController@create')->name('topic.create');
// Route::post('topic', 'TopicsController@store')->name('topic.store');
Route::get('{topic}', 'TopicsController@show')->name('topic.show');
// Route::get('topic/{topic}/edit', 'TopicsController@edit')->name('topic.edit');
// Route::patch('topic/{topic}', 'TopicsController@update')->name('topic.update');
// Route::delete('topic/{topic}', 'TopicsController@destroy')->name('topic.destroy');

Route::post('theme', 'ThemesController@update')->name('theme.update');

