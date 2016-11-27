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

Route::get('/', 'HomeController@index');
Route::get('/article/{id}', ['as' => 'article', 'uses' => 'ArticleController@index']);
Route::get('/category/{id}', ['as' => 'category', 'uses' => 'CategoryController@index']);
Route::get('/tag/{id}', ['as' => 'tag', 'uses' => 'TagController@index']);
Route::get('/search', ['as' => 'search', 'uses' => 'SearchController@index']);
Route::get('/page/{alias}', ['as' => 'page.show', 'uses' => 'PageController@index']);
Route::get('/about', ['as' => 'about', 'uses' => 'PageController@about']);
Route::get('/rss', ['as' => 'rss', 'uses'=>'RssController@index']);

Route::group(['prefix'=>'backend'], function(){

    Route::get('/login', 'Backend\AuthController@showLoginForm');
    Route::post('/login', 'Backend\AuthController@login');
    Route::get('/logout', 'Backend\AuthController@logout');
    /*Route::get('/register', 'Backend\AuthController@getRegister');
    Route::post('/register', 'Backend\AuthController@postRegister');*/

    Route::group(['middleware' => ['auth']], function(){
        Route::get('/', ['as' => 'backend.home', 'uses' =>'Backend\HomeController@index']);
        Route::resource('article', 'Backend\ArticleController');
        Route::resource('category', 'Backend\CategoryController');
        Route::get('category/set-nav/{id}', ['as' => 'backend.category.set-nav', 'uses' => 'Backend\CategoryController@setNavigation']);
        Route::resource('user', 'Backend\UserController');
        Route::resource('tag', 'Backend\TagController');
        Route::resource('link', 'Backend\LinkController');
        Route::resource('navigation', 'Backend\NavigationController');
        Route::resource('page', 'Backend\PageController');
        Route::get('system', ['as' => 'backend.system.index', 'uses' => 'Backend\SystemController@index']);
        Route::post('system', ['as' => 'backend.system.store', 'uses' => 'Backend\SystemController@store']);
        Route::get('upload', ['as' => 'backend.upload.index', 'uses' => 'Backend\UploadController@index']);
        Route::delete('file-del', ['as' => 'backend.upload.file-del', 'uses' => 'Backend\UploadController@fileDelete']);
        Route::delete('dir-del', ['as' => 'backend.upload.dir-del', 'uses' => 'Backend\UploadController@dirDelete']);
        Route::post('mkdir', ['as' => 'backend.upload.mkdir', 'uses' => 'Backend\UploadController@makeDir']);
        Route::get('file-upload', ['as' => 'backend.upload.file-upload', 'uses' => 'Backend\UploadController@fileUpload']);
        Route::post('file-stroe', ['as' => 'backend.upload.file-store', 'uses' => 'Backend\UploadController@fileStore']);
    });
});
