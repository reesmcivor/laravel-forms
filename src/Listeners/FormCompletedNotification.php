<?php

namespace ReesMcIvor\Forms\Listeners;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use ReesMcIvor\Forms\Http\Controllers\FormEntryController;
use ReesMcIvor\Forms\View\Components\Completed;

class FormCompletedNotification
{
    public function handle(object $event): void
    {
        $event->formEntry->user->notify(
            new \ReesMcIvor\Forms\Notifications\FormCompletedNotification($event->formEntry)
        );
    }
}
