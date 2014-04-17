<?php


Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);

Route::get('login', ['as' => 'login', 'uses' => 'SessionsController@create']);

Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);

Route::get('register', ['as' => 'register', 'uses' => 'PagesController@register']);

Route::post('sessions/store', 'SessionsController@store');

Route::get('members', ['before'=>'auth','as'=>'members.index', 'uses' => 'PagesController@members']);

Route::get('admin', ['before'=>'auth','as'=>'admin.index', 'uses' => 'PagesController@admin']);

Route::post('search', ['as'=>'search', 'uses'=>'PagesController@search']);

Route::get('tags/search/{name}',['as'=>'tags.search', 'uses'=>'PagesController@searchByTag']);

Route::post('images/delete/{id}', 'ImagesController@destroy');

Route::post('images/sort', 'ImagesController@sortImages');

Route::resource('users','UsersController');

Route::get('galleries/all', ['as'=>'galleries.all', 'uses' => 'GalleriesController@all']);

Route::resource('users.galleries', 'GalleriesController');

Route::resource('users.sharings', 'UserSharesController');

Route::controller('password','RemindersController');

Route::get('test', function()
{
	
	var_dump( ini_get('upload_max_filesize') );
	var_dump( ini_get('post_max_size') );
});
