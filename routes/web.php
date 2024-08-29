<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/', [CustomerController::class, 'index'])->name('customer_list');
Route::get('/customers/getData', [CustomerController::class, 'getData'])->name('customer.getData');
