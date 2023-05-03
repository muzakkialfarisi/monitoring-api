<?php

use Illuminate\Support\Facades\Route;

// if (env('APP_ENV') === 'production') {
//     \URL::forceScheme('https');
// }

Route::get('/', 'AuthController@login')->name('login');

$router->group(['prefix' => 'auth'], function () use ($router) {
    Route::post('/login', 'AuthController@login_process')->name('login_process');
    Route::post('/logout', 'AuthController@logout')->name('logout');
});

$router->group(['prefix' => 'dashboard'], function () use ($router) {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
});

$router->group(['prefix' => 'user'], function () use ($router) {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('/upsert/{id?}', 'UserController@upsert')->name('user.upsert');
    Route::post('/upsert/{id?}', 'UserController@upsert_process')->name('user.upsert_process');
});

$router->group(['prefix' => 'maindealer'], function () use ($router) {
    Route::get('/', 'MainDealerController@index')->name('maindealer.index');
    Route::post('/upsert', 'MainDealerController@upsert_process')->name('maindealer.upsert_process');
});

$router->group(['prefix' => 'feature'], function () use ($router) {
    Route::get('/', 'FeatureController@index')->name('feature.index');
    Route::post('/upsert', 'FeatureController@upsert_process')->name('feature.upsert_process');
});

$router->group(['prefix' => 'application'], function () use ($router) {
    Route::get('/md/{main_dealer_id}', 'BackEndController@index')->name('application.index');
    Route::post('/md/{main_dealer_id}/upsert', 'BackEndController@upsert_process')->name('application.upsert_process');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    Route::get('/alert/{main_dealer_id?}', 'ApiController@alert')->name('api.alert');
    Route::get('/alert/{main_dealer_id?}/detail/{id}', 'ApiController@detail')->name('api.detail');

    Route::get('/md/{main_dealer_id}', 'ApiController@index')->name('api.index');
    Route::get('/md/{main_dealer_id}/upsert/{id?}', 'ApiController@upsert')->name('api.upsert');
    Route::post('/md/{main_dealer_id}/upsert_process/{id?}', 'ApiController@upsert_process')->name('api.upsert.process');
    Route::post('/md/{main_dealer_id}/delete/{id}', 'ApiController@delete_process')->name('api.delete_process');
});

$router->group(['prefix' => 'log'], function () use ($router) {
    Route::get('/md/{main_delaer_id?}', 'LogController@index')->name('log.index');
});
