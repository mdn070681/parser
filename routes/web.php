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


Route::get('/', 'IndexController@show')->name('promotions');
Route::get('/about', 'AboutController@show')->name('about');

Route::get('/contact', 'ContactController@show')->name('contact');
Route::match(['get', 'post'], '/contact/formHandler', 'ContactController@formHandler')->name('formHandler');
Route::match(['get', 'post'], 'sendMail', 'MailSetting@sendForm')->name('sendForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('catalog', 'CatalogController@catalog')->name('catalog');
Route::match(['get', 'post'], 'search', 'SearchController@search')->name('search');
Route::match(['get', 'post'], 'shops', 'ShopsParserController@shopsParser')->name('shops');

Route::get('/atb', 'ShopPageController@showAtb')->name('atb');
Route::get('/silpo', 'ShopPageController@showSilpo')->name('silpo');
Route::get('/klass', 'ShopPageController@showKlass')->name('klass');
Route::get('/posad', 'ShopPageController@showPosad')->name('posad');
Route::get('/brusnichka', 'ShopPageController@showBrusnichka')->name('brusnichka');
Route::get('/velmarket', 'ShopPageController@showVelmarket')->name('velmarket');
Route::get('/tavria', 'ShopPageController@showTavria')->name('tavria');
Route::get('/okwine', 'ShopPageController@showOkwine')->name('okwine');
Route::get('/antoshka', 'ShopPageController@showAntoshka')->name('antoshka');
