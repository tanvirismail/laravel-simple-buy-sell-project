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

Route::get('/', 'FrontendController@index')->name('homepage');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/category', 'CategoryController@index')->middleware(['auth', 'permission:admin'])->name('category');
Route::get('/category/create', 'CategoryController@create')->middleware(['auth', 'permission:admin'])->name('category.create');
Route::post('/category/create', 'CategoryController@store')->middleware(['auth', 'permission:admin'])->name('category.store');
Route::get('/category/{id}/edit', 'CategoryController@edit')->middleware(['auth', 'permission:admin'])->name('category.edit');
Route::put('/category/{id}/edit', 'CategoryController@update')->middleware(['auth', 'permission:admin'])->name('category.update');
Route::delete('/category/{id}', 'CategoryController@destroy')->middleware(['auth', 'permission:admin'])->name('category.destroy');

Route::get('/product', 'ProductController@index')->middleware('auth')->name('product.index');
Route::get('/product/create', 'ProductController@create')->middleware(['auth', 'permission:user'])->name('product.create');
Route::post('/product/create', 'ProductController@store')->middleware(['auth', 'permission:user'])->name('product.store');
Route::get('product/{id}/edit', 'ProductController@edit')->middleware(['auth', 'permission:user'])->name('product.edit');
Route::put('product/{id}/edit', 'ProductController@update')->middleware(['auth', 'permission:user'])->name('product.update');
Route::delete('product/{id}', 'ProductController@destroy')->middleware('auth')->name('product.destroy');

Route::get('/product/{id}/show', 'ProductController@show')->name('product.show');
Route::post('/product/{id}/buy', 'ProductController@buy')->middleware(['auth', 'permission:user'])->name('product.buy');

Route::get('/buyers', 'UserController@buyers')->middleware('auth')->name('admin.buyers');
Route::get('/buyers/{id}/products', 'UserController@buyerProduct')->middleware('auth')->name('admin.buyers.products');

Route::get('/sellers', 'UserController@sellers')->middleware('auth')->name('admin.sellers');
Route::get('/sellers/{id}/products', 'UserController@sellersProduct')->middleware('auth')->name('admin.sellers.products');




// Route::get('profile', function () {
  //  Only verified users may enter...
// })->middleware('verified');
