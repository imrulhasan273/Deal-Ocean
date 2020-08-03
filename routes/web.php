<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use phpDocumentor\Reflection\Types\Resource_;

Auth::routes();

# Start Home Controller
Route::get('/', 'HomeController@index')->name('home');
Route::get('/contact', 'HomeController@contact')->name('contact');
# End Home Controller



# Start Admin Routes | Dashboard
Route::get('admin', 'DashboardController@index')->name('dashboard.index')->middleware(['roleChecker:super_admin,admin,seller']);
Route::get('admin/regions', 'DashboardController@regions')->name('dashboard.regions')->middleware(['roleChecker:super_admin,admin,null']);
Route::get('admin/countries', 'DashboardController@countries')->name('dashboard.countries')->middleware(['roleChecker:super_admin,admin,null']);
Route::get('admin/locations', 'DashboardController@locations')->name('dashboard.locations')->middleware(['roleChecker:super_admin,admin,null']);
Route::get('admin/shops', 'DashboardController@shops')->name('dashboard.shops')->middleware(['roleChecker:super_admin,admin,seller']);
Route::get('admin/products', 'DashboardController@products')->name('dashboard.products')->middleware(['roleChecker:super_admin,admin,seller']);
Route::get('admin/coupons', 'DashboardController@coupons')->name('dashboard.coupons')->middleware(['roleChecker:super_admin,admin,null']);
Route::get('admin/orders', 'DashboardController@orders')->name('dashboard.orders')->middleware(['roleChecker:super_admin,admin,null']);
Route::get('admin/icons', 'DashboardController@icons')->name('dashboard.icons')->middleware(['roleChecker:super_admin,admin,seller']);
Route::get('admin/map', 'DashboardController@map')->name('dashboard.map')->middleware(['roleChecker:super_admin,admin,seller']);
Route::get('admin/notification', 'DashboardController@notification')->name('dashboard.notification')->middleware(['roleChecker:super_admin,admin,seller']);
Route::get('admin/profile', 'DashboardController@profile')->name('dashboard.profile')->middleware(['roleChecker:super_admin,admin,seller']);
Route::get('admin/typography', 'DashboardController@typography')->name('dashboard.typography')->middleware(['roleChecker:super_admin,admin,seller']);
# End Admin Routes | Dashboard


# Strat Region COntroller
// -- -- -- -- -- -- -- -- Below five routes in Dashboard
Route::get('/admin/regions/add', 'RegionController@add')->name('regions.add')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::post('/admin/regions/store', 'RegionController@store')->name('regions.store')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::get('/admin/regions/{region}/edit', 'RegionController@edit')->name('regions.edit')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::post('/admin/regions/update', 'RegionController@update')->name('regions.update')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::get('/admin/regions/{region}/destroy', 'RegionController@destroy')->name('regions.destroy')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
# End Region Controller

# Strat Country COntroller
// -- -- -- -- -- -- -- -- Below five routes in Dashboard
Route::get('/admin/countries/add', 'CountryController@add')->name('countries.add')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::post('/admin/countries/store', 'CountryController@store')->name('countries.store')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::get('/admin/countries/{country}/edit', 'CountryController@edit')->name('countries.edit')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::post('/admin/countries/update', 'CountryController@update')->name('countries.update')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::get('/admin/countries/{country}/destroy', 'CountryController@destroy')->name('countries.destroy')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
# End Country Controller


# Strat Location COntroller
// -- -- -- -- -- -- -- -- Below five routes in Dashboard
Route::get('/admin/locations/add', 'LocationController@add')->name('locations.add')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::post('/admin/locations/store', 'LocationController@store')->name('locations.store')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::get('/admin/locations/{location}/edit', 'LocationController@edit')->name('locations.edit')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::post('/admin/locations/update', 'LocationController@update')->name('locations.update')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::get('/admin/locations/{location}/destroy', 'LocationController@destroy')->name('locations.destroy')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
# End Location Controller


# Start Product Controller
Route::get('/details', 'ProductController@details')->name('product.details');
Route::get('/products', 'ProductController@products')->name('product.products');
// -- -- -- -- -- -- -- -- Below five routes in Dashboard
Route::get('/admin/products/add', 'ProductController@add')->name('products.add')->middleware('auth')->middleware(['roleChecker:super_admin,admin,seller']);  //admin
Route::post('/admin/products/store', 'ProductController@store')->name('products.store')->middleware('auth')->middleware(['roleChecker:super_admin,admin,seller']);  //admin
Route::get('/admin/products/{product}/edit', 'ProductController@edit')->name('products.edit')->middleware('auth')->middleware(['roleChecker:super_admin,admin,seller']);  //admin
Route::post('/admin/products/update', 'ProductController@update')->name('products.update')->middleware('auth')->middleware(['roleChecker:super_admin,admin,seller']);  //admin
Route::get('/admin/products/{product}/destroy', 'ProductController@destroy')->name('products.destroy')->middleware('auth')->middleware(['roleChecker:super_admin,admin,seller']);  //admin
# End Product Controller


# Start Cart Controller
Route::get('/add-to-cart/{product}', 'CartController@add')->name('cart.add')->middleware('auth');
Route::get('/cart', 'CartController@index')->name('cart.index')->middleware('auth');
Route::get('/cart/update{itemId}{itemOccur}', 'CartController@update')->name('cart.update')->middleware('auth');
Route::get('/cart/destroy{itemId}', 'CartController@destroy')->name('cart.destroy')->middleware('auth');
Route::get('/cart/coupon', 'CartController@coupon')->name('cart.coupon')->middleware('auth');
Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout')->middleware('auth');
# End Cart Controller



# Start Order Controller
Route::post('/order/store', 'OrderController@store')->name('orders.store')->middleware('auth');
// -- -- -- -- -- -- -- -- Below two routes in Dashboard
Route::get('/admin/orders/{order}/edit', 'OrderController@edit')->name('orders.edit')->middleware('auth')->middleware(['roleChecker:super_admin,admin,seller']);  //admin
Route::post('/admin/orders/update', 'OrderController@update')->name('orders.update')->middleware('auth')->middleware(['roleChecker:super_admin,admin,seller']);  //admin
Route::get('/admin/orders/{order}/destroy', 'OrderController@destroy')->name('orders.destroy')->middleware('auth')->middleware(['roleChecker:super_admin,admin,seller']);  //admin
# End Order Controller



# Start SSLCOMMERZ Start
Route::POST('/pay/{orderId}', 'SSLCommerzPaymentController@index')->name('payments.pay');
Route::POST('/success', 'SSLCommerzPaymentController@success');
Route::POST('/fail', 'SSLCommerzPaymentController@fail');
Route::POST('/cancel', 'SSLCommerzPaymentController@cancel');
Route::POST('/ipn', 'SSLCommerzPaymentController@ipn');
# End SSLCOMMERZ END


# Start Shop Controllers
Route::get('/shops/create', 'ShopController@create')->name('shops.create')->middleware('auth');         //auth
Route::post('/shops/store', 'ShopController@store')->name('shops.store')->middleware('auth');         //auth
// -- -- -- -- -- -- -- -- Below two routes in Dashboard
Route::get('/admin/shops/{shop}/edit', 'ShopController@edit')->name('shops.edit')->middleware('auth')->middleware(['roleChecker:super_admin,admin,seller']);  //admin
Route::post('/admin/shops/update', 'ShopController@update')->name('shops.update')->middleware('auth')->middleware(['roleChecker:super_admin,admin,seller']);  //admin
Route::get('/admin/shops/{shop}/destroy', 'ShopController@destroy')->name('shops.destroy')->middleware('auth')->middleware(['roleChecker:super_admin,admin,seller']);  //admin
# End Shop Controllers


# Start Coupon Controller
// -- -- -- -- -- -- -- -- Below five routes in Dashboard
Route::get('/admin/coupons/add', 'CouponController@add')->name('coupons.add')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::post('/admin/coupons/store', 'CouponController@store')->name('coupons.store')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::get('/admin/coupons/{coupon}/edit', 'CouponController@edit')->name('coupons.edit')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::post('/admin/coupons/update', 'CouponController@update')->name('coupons.update')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
Route::get('/admin/coupons/{coupon}/destroy', 'CouponController@destroy')->name('coupons.destroy')->middleware('auth')->middleware(['roleChecker:super_admin,admin,null']);  //admin
# End Coupon Controller
