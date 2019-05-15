<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\StatusesPackage\Statuses\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back',
    ],
    function () {
        Route::post('statuses/suggestions', 'UtilityControllerContract@getSuggestions')
            ->name('back.statuses.getSuggestions');

        Route::any('statuses/data', 'DataControllerContract@index')
            ->name('back.statuses.data.index');

        Route::resource(
            'statuses', 'ResourceControllerContract',
            [
                'except' => [
                    'show',
                ],
                'as' => 'back',
            ]
        );
    }
);
