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

Route::group(['middleware' => 'admin'], function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('admin-users', 'AdminUserController');
    Route::resource('categories','CategoriesController');
    Route::resource('/subcategory', 'SubcategoriesController');
    Route::resource('/productsss', 'ProductsController');
// ajax route to get subcategory in change category
    Route::get('/sub_category/ajax/{id}','ProductsController@sub_category_ajax');

    Route::resource('customers','AdminCustomersController');
// ajax route to change user statue
    Route::get('/changeStatus', 'AdminCustomersController@changeStatus');


    Route::resource('offers','AdminOfferController');
});