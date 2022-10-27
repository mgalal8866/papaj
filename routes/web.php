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
Route::get('/view/sales',[SalesController::class,'index'])->name('viewsales');
Route::get('/new/sales',[SalesController::class,'newsales'])->name('newsales');
Route::Post('/insert/sales',[SalesController::class,'insertsales'])->name('insertsales');
Route::get('/', function () {
    return view('layouts.master');
});
