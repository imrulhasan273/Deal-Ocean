<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use phpDocumentor\Reflection\Types\Resource_;

Auth::routes();

//------------------ Start Home Controller
Route::get('/', 'HomeController@index')->name('home');
Route::get('/contact', 'HomeController@contact')->name('contact');
//------------------ End Home Controller

//----Start Admin Routes | Dashboard ------- //
Route::get('admin', 'DashboardController@index')->name('dashboard.index');
Route::get('admin/shops', 'DashboardController@shops')->name('dashboard.shops');
Route::get('admin/icons', 'DashboardController@icons')->name('dashboard.icons');
Route::get('admin/map', 'DashboardController@map')->name('dashboard.map');
Route::get('admin/notification', 'DashboardController@notification')->name('dashboard.notification');
Route::get('admin/profile', 'DashboardController@profile')->name('dashboard.profile');
Route::get('admin/typography', 'DashboardController@typography')->name('dashboard.typography');
// ----End Admin Routes | Dashboard ------- //


// ------Start Product Controller -----------
Route::get('/details', 'ProductController@details')->name('product.details');
Route::get('/products', 'ProductController@products')->name('product.products');
// ------End Product Controller -------------


//------- Start Cart Controller
Route::get('/add-to-cart/{product}', 'CartController@add')->name('cart.add')->middleware('auth');
Route::get('/cart', 'CartController@index')->name('cart.index')->middleware('auth');
Route::get('/cart/update{itemId}{itemOccur}', 'CartController@update')->name('cart.update')->middleware('auth');
Route::get('/cart/destroy{itemId}', 'CartController@destroy')->name('cart.destroy')->middleware('auth');
Route::get('/cart/coupon', 'CartController@coupon')->name('cart.coupon')->middleware('auth');
Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout')->middleware('auth');
//---------- End Cart Controller

//Order Controller----
// Route::resource('orders', 'OrderController')->middleware('auth');
Route::post('/order/store', 'OrderController@store')->name('orders.store')->middleware('auth');


// SSLCOMMERZ Start
Route::POST('/pay/{orderId}', 'SSLCommerzPaymentController@index')->name('payments.pay');
Route::POST('/success', 'SSLCommerzPaymentController@success');
Route::POST('/fail', 'SSLCommerzPaymentController@fail');
Route::POST('/cancel', 'SSLCommerzPaymentController@cancel');
Route::POST('/ipn', 'SSLCommerzPaymentController@ipn');
// SSLCOMMERZ END


# Shop Controllers
// Route::resource('shops', 'ShopController')->middleware('auth');
Route::get('/shops/create', 'ShopController@create')->name('shops.create')->middleware('auth');         //auth
Route::post('/shops/store', 'ShopController@store')->name('shops.store')->middleware('auth');         //auth

Route::get('/admin/shops/{shop}/edit', 'ShopController@edit')->name('shops.edit')->middleware('auth');  //admin
Route::post('/admin/shops/update', 'ShopController@update')->name('shops.update')->middleware('auth');  //admin
