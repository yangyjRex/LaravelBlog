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
Route::any('admin/login', 'Admin\AdminLoginController@login');
Route::get('admin/code', 'Admin\AdminLoginController@code');
	



Route::group(['middleware' => ['admin.login'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
	//admin 
	Route::get('index', 'IndexController@index');
	Route::get('info', 'IndexController@info');
	Route::get('quit', 'AdminLoginController@quit');
	Route::any('pass', 'IndexController@pass');

	Route::post('cate/changeorder', 'CategoryController@changeOrder');
	Route::resource('category', 'CategoryController');

})


?>