<?php

Route::group(['namespace' => 'InetStudio\Statuses\Controllers'], function () {
    Route::group(['middleware' => 'web', 'prefix' => 'back'], function () {
        Route::group(['middleware' => 'back.auth'], function () {
            Route::post('statuses/suggestions', 'StatusesController@getSuggestions')->name('back.statuses.getSuggestions');
            Route::any('statuses/data', 'StatusesController@data')->name('back.statuses.data');
            Route::resource('statuses', 'StatusesController', ['except' => [
                'show',
            ], 'as' => 'back']);
        });
    });
});
