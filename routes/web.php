<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\ListAllCustomersController;
use App\Http\Controllers\Customer\ShowSingleCustomerController;
use App\Http\Controllers\UploadFileController;

Route::get('/file/upload', [UploadFileController::class, 'showUploadForm']);
Route::post('/file/upload', [UploadFileController::class, 'upload'])->name('file.upload');
Route::group(['as' => 'customers.'], function () {
    Route::get('/', ListAllCustomersController::class)
        ->name('index');
    Route::get('/{customer}', ShowSingleCustomerController::class)
        ->name('show');
});
