<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here is where you can register tenant-specific routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "tenant" middleware group. Now create something great!
|
*/

Route::middleware(['tenant'])->group(function () {

    die('go');
    Route::get('forms', 'FormsController@index')->name('forms.index');

});
