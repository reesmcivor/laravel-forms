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

/*
Route::middleware('tenant', PreventAccessFromCentralDomains::class)->name('tenant.')->group(function () {

    Route::middleware(['auth', CheckSubscription::class])->group(function () {
        Route::middleware(OwnerOnly::class)->group(function () {

            Route::resource('form-entry', Controllers\FormEntryController::class);
            Route::post('form-entry/{formEntry}/submit', [Controllers\FormEntryController::class, 'submit'])->name('form-entry.submit');
            Route::get('forms/demo/create', [Controllers\DemoController::class, 'create'])->name('forms.demo.create');

        });
    });

});
*/

Route::middleware(['web'])->group(function () {
    Route::resource('form-entry', Controllers\FormEntryController::class);
    Route::any('form-entry/{formEntry}/submit', [\ReesMcIvor\Forms\Http\Controllers\FormEntryController::class, 'submit'])->name('form-entry.submit');
    //Route::any('form-entry/{formEntry:id}/submit', [\ReesMcIvor\Forms\Http\Controllers\FormEntryController::class, 'submit'])->name('form-entry.submit');
    Route::get('forms/demo/create', [Controllers\DemoController::class, 'create'])->name('forms.demo.create');
});
