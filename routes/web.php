<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CustomerController::class, 'index'])
    ->name('customers.index')
    ->middleware('sanitize-input');

Route::get('/customers', [CustomerController::class, 'index'])
    ->name('customers.index')
    ->middleware('sanitize-input');
