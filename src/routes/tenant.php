<?php

use Illuminate\Support\Facades\Route;

use ReesMcIvor\Forms\Http\Controllers as Controllers;

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

    Route::get('forms', [Controllers\FormController::class, 'inde'])->name('forms.index');

});
