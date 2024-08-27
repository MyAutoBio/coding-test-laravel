<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerController;
Route::middleware(['auth'])->group(function () {
Route::get('/list_customers', [CustomerController::class, 'index'])->name('customers.index');
});
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
