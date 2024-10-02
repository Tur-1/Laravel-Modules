<?php

use Illuminate\Support\Facades\Route;
use {modulePath}\Controllers\{class}Controller;

Route::middleware(['api'])->prefix('/api')->controller({class}Controller::class)->group(function () {
    Route::get('/{routesName}/get-all', 'getAll');
    Route::get('/{routesName}/get-paginated-list', 'getPaginatedList');
    Route::post('/{routesName}/store', 'store{Model}');
    Route::post('/{routesName}/show/{id}', 'show{Model}');
    Route::post('/{routesName}/update/{id}', 'update{Model}');
    Route::post('/{routesName}/delete/{id}', 'destroy{Model}');
});
