<?php

namespace ReesMcIvor\Forms\Http\LiveWire\Question;

use Livewire\Component;

class Text extends Component
{
    public $question;

    public function mount($question)
    {
        $this->question = $question;
    }

    public function render()
    {
        return view('reesmcivor-forms::livewire.question.question-text');
    }
}
