<?php

use Illuminate\Support\Facades\Route;
use {pagePath}\Controllers\{class}Controller;

Route::middleware(['api'])->prefix('/api')->controller({class}Controller::class)->group(function () {
    Route::get('/{routesName}/get-all', 'getAll');
    Route::get('/{routesName}/get-paginated-list', 'getPaginatedList');
    Route::post('/{routesName}/store', 'store');
    Route::post('/{routesName}/show/{id}', 'show');
    Route::post('/{routesName}/update/{id}', 'update');
    Route::post('/{routesName}/delete/{id}', 'destroy');
});
