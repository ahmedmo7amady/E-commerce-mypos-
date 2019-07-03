<?php


Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
function(){
	Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function(){
	Route::get('/index' ,  'AdminController@index')->name('index');

	// User Routes
	Route::resource('users' , 'UserController')->except(['show']);
	
	
	// category Routes
	Route::resource('categories' , 'CategoryController')->except(['show']);
	
	// Clients Routes
	Route::resource('clients' , 'ClientController')->except(['show']);

	// products Routes
	Route::resource('products' , 'ProductController')->except(['show']);
	
	});
});
