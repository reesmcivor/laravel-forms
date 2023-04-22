<?php

namespace ReesMcIvor\Forms;

use Illuminate\Support\ServiceProvider;

class FormsPackageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations/tenant' => database_path('migrations/tenant'),
                //__DIR__ . '/../database/factories' => database_path('factories'),
                __DIR__ . '/../publish/tests' => base_path('tests/Forms'),
            ], 'reesmcivor-forms');
        }
    }

    public function register()
    {
    }
}
