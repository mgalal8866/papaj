<?php

use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/view/sales',[SalesController::class,'index'])->name('sales');
Route::get('/new/sales',[SalesController::class,'newsales'])->name('sales');
Route::get('/', function () {
    return view('layouts.master');
});