<?php

use Illuminate\Support\Facades\Route;


$router->group(['prefix' => 'auth'], function () use ($router) {
    Route::get('/login', 'AuthController@login')->name('login');
    Route::post('/login', 'AuthController@login_process')->name('login_process');
    Route::post('/logout', 'AuthController@logout')->name('logout');
});

$router->group(['prefix' => 'dashboard'], function () use ($router) {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
});

$router->group(['prefix' => 'maindealer'], function () use ($router) {
    Route::get('/', 'MainDealerController@index')->name('maindealer.index');
});

$router->group(['prefix' => 'feature'], function () use ($router) {
    Route::get('/', 'FeatureController@index')->name('feature.index');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    Route::get('/md/{main_dealer_id}', 'ApiController@index')->name('api.index');
    Route::get('/md/{main_dealer_id}/upsert', 'ApiController@upsert')->name('api.upsert');
});

$router->group(['prefix' => 'log'], function () use ($router) {
    Route::get('/md/{id}', 'LogController@index')->name('log.index');
});