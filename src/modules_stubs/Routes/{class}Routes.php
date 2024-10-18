<?php

use Illuminate\Support\Facades\Route;
use {modulePath}\Controllers\{class}Controller;

Route::middleware(['api'])->prefix('/api/{routesName}/')->controller({class}Controller::class)->group(function () {
    Route::get('get-all', 'getAll');
    Route::get('get-paginated-list', 'getPaginatedList');
    Route::post('store', 'store');
    Route::post('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::post('delete/{id}', 'destroy');
});
