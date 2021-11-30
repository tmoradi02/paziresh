<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('user' , UserController::class)->except('search');
Route::get('user/search/s' , 'UserController@search')->name('user_search');

Route::resource('permission', PermissionController::class);
Route::resource('permission_user', PermissionUserController::class);

Route::resource('channel', ChannelController::class)->except(['edit','update']);
Route::get('channel/{id}/edit','ChannelController@create')->name('channel.edit');
Route::put('channel/{id}', 'ChannelController@store')->name('channel');

Route::resource('classes', ClassController::class)->except(['search']);
Route::get('classes/search/s' , 'ClassController@search')->name('classes_search');

Route::resource('arm_agahi', ArmAgahiController::class)->except(['search']);
Route::get('arm_agahi/search/s' , 'ArmAgahiController@search')->name('arm_agahi_search');

Route::resource('box_type', Box_TypeController::class);

Route::resource('box_prog_group', Box_Prog_GroupController::class)->except(['search']);
Route::get('box_prog_group/search/s' , 'Box_Prog_GroupController@search' )->name('box_prog_group_search');

Route::resource('cast', CastController::class)->except(['edit','update','search']);
Route::get('cast/search/s' , 'CastController@search')->name('cast_search');
Route::get('cast/{id}/edit','CastController@create')->name('cast.edit');
Route::put('cast/{id}' , 'CastController@store')->name('cast');

Route::resource('product' , ProductController::class)->except(['edit','update' , 'search']);
Route::get('product/search/s' , 'ProductController@search')->name('product_search');
Route::get('product/{id}/edit','ProductController@create')->name('product.edit');
Route::put('product/{id}','ProductController@store')->name('product');

Route::resource('title',TitleController::class)->except(['edit','update']);
Route::get('title/{id}/edit','TitleController@create')->name('title.edit');
Route::put('title/{id}','TitleController@store')->name('title');

Route::resource('owner',OwnerController::class)->except(['edit' , 'update' , 'search']);
Route::get('owner/{id}/edit' , 'OwnerController@create')->name('owner.edit');
Route::put('owner/{id}' , 'OwnerController@store')->name('owner');
Route::get('owner/search/s' , 'OwnerController@search')->name('owner_search');

Route::resource('adver_type' , Adver_TypeController::class)->except(['edit' , 'update' , 'search']);
Route::get('adver_type/{id}/edit' , 'Adver_TypeController@create')->name('adver_type.edit');
Route::put('adver_type/{id}' , 'Adver_TypeController@store')->name('adver_type');
Route::get('adver_type/search/s' , 'Adver_TypeController@search')->name('adver_type_search');

Route::resource('adver_type_coef' , Adver_Type_CoefController::class)->except(['edit' , 'update' , 'search']);
Route::get('adver_type_coef/{id}/edit' , 'Adver_Type_CoefController@create')->name('adver_type_coef.edit');
Route::put('adver_type_coef/{id}' , 'Adver_Type_CoefController@store')->name('adver_type_coef');
Route::get('adver_type_coef/search/s' , 'Adver_Type_CoefController@search')->name('adver_type_coef_search');

Route::resource('tariff',TariffController::class)->except(['edit' , 'update' , 'search']);
Route::get('tariff/{id}/edit' , 'TariffController@create')->name('tariff.edit');
Route::put('tariff/{id}' , 'TariffController@store')->name('tariff');
Route::get('tariff/search/s' , 'TariffController@search')->name('tariff_search');

// For Clear Cache With Roue-> /clear-cache
Route::get('/clear-cache', function() {  
    $configCache = Artisan::call('config:cache');
    $clearCache = Artisan::call('cache:clear');
    // return what you want
});

// ST DOC 1400-08-09 ajax response
Route::get('/get-users-json' , function(){
    $users =\App\User::all();
    return response()->json($users);
});

Route::get('/get-channels-json' , function (){
    $channels = \App\Channel::all();
    return response()->json($channels);
    // return response()->json(\App\Channel::all());
});

Route::get('/get-classes-json' , function(){
    $classes = \App\Classes::all();
    return response()->json($classes);
});

Route::get('/get-boxType-json' , function(){
    $boxTypes = \App\Box_Type::all();
    return response()->json($boxTypes);
});

Route::get('/get-casts-json' , function(){
    $casts = \App\Cast::all();
    return response()->json($casts);
});

Route::get('/get-adverType-json' , function(){
    $adverTypes = \App\Adver_Type::all();
    return response()->json($adverTypes);
});

// END DOC 1400-08-09 ajax response

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

