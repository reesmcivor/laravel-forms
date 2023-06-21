<?php

namespace ReesMcIvor\Forms\View\Components;


use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{

    public $formEntry = null;

    public function __construct( $formEntry )
    {
        $this->formEntry = $formEntry;
    }

    public function render(): View|Closure|string
    {
        return view('forms::components.form.stepped', [
            'formEntry' => $this->formEntry,
        ]);
    }
}
