<?php

use Illuminate\Support\Facades\Route;

use ReesMcIvor\Forms\Http\Controllers as Controllers;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

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

Route::middleware('tenant', PreventAccessFromCentralDomains::class)->name('tenant.')->group(function () {

    Route::get('forms', [Controllers\FormController::class, 'index'])->name('forms.index');
    Route::post('forms', [Controllers\FormController::class, 'store'])->name('forms.store');
    Route::get('forms/create', [Controllers\FormController::class, 'create'])->name('forms.create');
    Route::get('forms/edit/{id}', [Controllers\FormController::class, 'create'])->name('forms.create');

});
