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

Route::get('/', 'HomeController@index');

Route::get('/article/{id}', 'ArticleController@index')->name('article');

Route::get('/category/{id}', 'CategoryController@index')->name('category');

Route::get('/tag/{id}', 'TagController@index')->name('tag');

Route::get('/search', 'SearchController@index')->name('search');

Route::get('/page/{alias}', 'PageController@index')->name('page.show');

Route::get('/about', 'PageController@about')->name('about');

Route::get('/rss', 'RssController@index')->name('rss');

Route::namespace('Backend')->prefix('backend')->group(function () {

    Route::get('/login', 'AuthController@showLoginForm')->name('backend.login');

    Route::post('/login', 'AuthController@login');

    Route::get('/logout', 'AuthController@logout');


    Route::group(['middleware' => ['auth', 'reject-null-values']], function(){

        Route::get('/', 'HomeController@index')->name('backend.home');

        Route::post('/upload/image', 'UploadController@image');

        Route::resource('article', 'ArticleController', ['as' => 'backend']);

        Route::resource('category', 'CategoryController', ['as' => 'backend']);

        Route::get('category/set-nav/{id}', ['as' => 'backend.category.set-nav', 'uses' => 'CategoryController@setNavigation']);

        Route::resource('user', 'UserController', ['as' => 'backend']);

        Route::resource('tag', 'TagController', ['as' => 'backend']);

        Route::resource('link', 'LinkController', ['as' => 'backend']);

        Route::resource('navigation', 'NavigationController', ['as' => 'backend']);

        Route::resource('page', 'PageController', ['as' => 'backend']);

        Route::get('system', 'SystemController@index')->name('backend.system.index');

        Route::post('system', 'SystemController@store')->name('backend.system.store');
    });
});
