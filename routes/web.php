<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [CustomerController::class, 'userDetail'])->name('customers.index');
Route::get('/search/customers', [CustomerController::class, 'userSearch'])->name('customers.search');
