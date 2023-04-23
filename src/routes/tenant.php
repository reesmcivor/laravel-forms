<?php

use App\Http\Middleware\CheckSubscription;
use App\Http\Middleware\OwnerOnly;
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

    Route::middleware(['auth', CheckSubscription::class])->group(function () {
        Route::middleware(OwnerOnly::class)->group(function () {
            Route::resource('forms', Controllers\FormController::class);
            Route::post('forms/{form}/submit', [Controllers\FormController::class, 'submit'])->name('forms.entry.submit');
        });
    });

});
