<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

//------------------ Start Home Controller
Route::get('/', 'HomeController@index')->name('home');
Route::get('/contact', 'HomeController@contact')->name('contact');
//------------------ End Home Controller


//----Start Admin Routes | Dashboard ------- //
Route::get('admin', 'DashboardController@index')->name('dashboard.index');
Route::get('admin/icons', 'DashboardController@icons')->name('dashboard.icons');
Route::get('admin/map', 'DashboardController@map')->name('dashboard.map');
Route::get('admin/notification', 'DashboardController@notification')->name('dashboard.notification');
Route::get('admin/profile', 'DashboardController@profile')->name('dashboard.profile');
Route::get('admin/typography', 'DashboardController@typography')->name('dashboard.typography');
Route::get('admin/tables', 'DashboardController@tables')->name('dashboard.tables');
//----End Admin Routes | Dashboard ------- //


// ------Start Product Controller -----------
Route::get('/details', 'ProductController@details')->name('product.details');
Route::get('/products', 'ProductController@products')->name('product.products');
// ------End Product Controller -------------

//------- Start Cart Controller
Route::get('/cart', 'CartController@index')->name('cart.index')->middleware('auth');
Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout')->middleware('auth');
//---------- End Cart Controller
