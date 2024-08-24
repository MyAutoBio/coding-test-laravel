<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\ListAllCustomersController;
use App\Http\Controllers\Customer\ShowSingleCustomerController;

Route::group(['as' => 'customers.'], function () {
    Route::get('/', ListAllCustomersController::class)
        ->name('index');
    Route::get('/{customer}', ShowSingleCustomerController::class)
        ->name('show');
});
