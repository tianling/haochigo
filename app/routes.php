<?php


Route::get('/', function()
{
	return View::make('hello');
});


Route::get('users', function()
{
    return 'Users!';
});



Route::post('register', 'UserAccessController@register');
Route::get('register', 'UserAccessController@register');


Route::post('login','UserAccessController@login');