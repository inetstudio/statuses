<?php

use InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesControllerContract;
use InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesDataControllerContract;
use InetStudio\Statuses\Contracts\Http\Controllers\Back\StatusesUtilityControllerContract;

Route::group([
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back',
], function () {
    Route::post('statuses/suggestions', StatusesUtilityControllerContract::class.'@getSuggestions')->name('back.statuses.getSuggestions');
    Route::any('statuses/data', StatusesDataControllerContract::class.'@index')->name('back.statuses.data.index');
    Route::resource('statuses', StatusesControllerContract::class, ['except' => [
        'show',
    ], 'as' => 'back']);
});
