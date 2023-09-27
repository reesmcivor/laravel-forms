<?php

namespace ReesMcIvor\Forms\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use ReesMcIvor\Forms\Models\FormEntry;

class FormEntryComplete
{
    use InteractsWithSockets, SerializesModels;

    public FormEntry $formEntry;

    public function __construct( $formEntry )
    {
        $this->formEntry = $formEntry;
    }
}
