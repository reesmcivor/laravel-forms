<?php

namespace ReesMcIvor\Forms;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use ReesMcIvor\Forms\Http\LiveWire\Question\Text;
use ReesMcIvor\Forms\View\Components\Completed;
use ReesMcIvor\Forms\View\Components\Stepped;

class FormsPackageServiceProvider extends ServiceProvider
{

    protected $namespace = 'ReesMcIvor\Forms\Http\Controllers';

    public function boot()
    {
        if($this->app->runningInConsole()) {
            $migrationPath = function_exists('tenancy') ? 'migrations/tenant' : 'migrations';
            $this->publishes([
                __DIR__ . '/../database/migrations/tenant' => database_path($migrationPath),
                __DIR__ . '/../publish/tests' => base_path('tests/Forms'),
                __DIR__ . '/../publish/config' => base_path('config'),
            ], 'reesmcivor-forms');
        }

        $this->commands([
            \ReesMcIvor\Forms\Console\Commands\SeedForms::class,
        ]);

        $this->loadRoutesFrom(__DIR__.'/routes/tenant.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'forms');
        $this->loadViewComponentsAs('forms', [
            Stepped::class,
            Completed::class
        ]);

        Livewire::component('forms.form', \ReesMcIvor\Forms\Http\Livewire\Form::class);
        Livewire::component('forms.question.varchar', \ReesMcIvor\Forms\Http\Livewire\Question\VarChar::class);
        Livewire::component('forms.question.text', \ReesMcIvor\Forms\Http\Livewire\Question\Text::class);
        Livewire::component('forms.question.date', \ReesMcIvor\Forms\Http\Livewire\Question\Date::class);
        Livewire::component('forms.question.select', \ReesMcIvor\Forms\Http\Livewire\Question\Select::class);
        Livewire::component('forms.step', \ReesMcIvor\Forms\Http\Livewire\Step::class);
    }

    public function map()
    {
        $this->mapTenantRoutes();
    }

    protected function mapTenantRoutes()
    {
        Route::middleware(['web', 'tenant'])
            ->namespace($this->namespace)
            ->group($this->modulePath('routes/tenant.php'));
    }

    private function modulePath($path)
    {
        return __DIR__ . '/../../' . $path;
    }
}
