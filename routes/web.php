<?php

Route::group([
    'namespace' => 'InetStudio\Statuses\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back',
], function () {
    Route::post('statuses/suggestions', 'StatusesUtilityControllerContract@getSuggestions')->name('back.statuses.getSuggestions');
    Route::any('statuses/data', 'StatusesDataControllerContract@index')->name('back.statuses.data.index');
    Route::resource('statuses', 'StatusesControllerContract', ['except' => [
        'show',
    ], 'as' => 'back']);
});
