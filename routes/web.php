<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FcmController;
use App\Http\Controllers\SalesController;

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
Route::Post('/fcm-token', [FcmController::class, 'updateToken'])->name('fcmToken');

Route::get('/', function () {
    return view('layouts.master');
});
