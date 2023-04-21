<?php

namespace ReesMcIvor\Forms;

use Illuminate\Support\ServiceProvider;

class FormsPackageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations/tanant' => database_path('migrations/tenant'),
                __DIR__ . '/../publish/tests' => base_path('tests/Forms'),
            ], 'reesmcivor-forms-tests');
        }
    }

    public function register()
    {
    }
}
