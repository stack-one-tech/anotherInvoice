<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route("home"));
//    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create-invoice', [App\Http\Controllers\HomeController::class, 'createInvoice'])
    ->name('create_invoice');
Route::get('/previewInvoice', [App\Http\Controllers\HomeController::class, 'previewInvoice'])
    ->name('previewInvoice');
Route::get('/settings', [App\Http\Controllers\HomeController::class, 'settings'])
    ->name('settings');
